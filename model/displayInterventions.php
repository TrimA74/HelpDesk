<?php
/* Evan */
include_once("db.php");
include_once("tools.php");
if(isset($_GET["id_user"])){
	$query = $db->prepare("select * 
						   from intervient int 
						   		join date_intervention di on int.intervient_date = di.id_date
						   		join type_intervention ti on int.id_intervention = ti.id_intervention
						   		join ticket t on int.id_ticket = t.id_ticket
						   		join client cli on t.id_client = cli.id_client
						   where ID_EMPLOYE=:id");
		$query->bindValue(":id",$_GET["id_user"]);          
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$results = array_map(function($result) {
			return array(
				'id_intervention' => $result['ID_INTERVIENT'],
				'id_ticket' => $result['ID_TICKET'],
				'nom_client' => $result['NOM_CLIENT'],
				'date_interv' => convertDate($result['LIBELLE_DATE']),
				'libelle_int' => $result['LIBELLE_INTERVENTION'],
				'com_inter' => $result['COMMENTAIRE_INTERVENTION']
				);
		},$result);
		echo json_encode($results);

}else{ 
	echo json_encode("Error");
}