<?php 
include_once("db.php");

if(isset($_GET["id_ticket"])){
	$query = $db->prepare("select * 
			               from intervient int
			                    join date_intervention di on int.intervient_date = di.id_date
			               		join type_intervention ty on int.id_intervention = ty.id_intervention
			               		join employe emp on int.id_employe=emp.id_employe
			               where int.id_ticket=:id
						");
	$query->bindValue(":id",$_GET["id_ticket"]);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	$results = array_map(function($result) {
			return array(
				'id_intervention' => $result['ID_INTERVIENT'],
				'nom_emp' => $result['NOM_EMPLOYE'],
				'prenom_emp' => $result['PRENOM_EMPLOYE'],
				'date_interv' => $result['LIBELLE_DATE'],
				'libelle_int' => $result['LIBELLE_INTERVENTION'],
				'statut_inter' => $result['STATUT_INTERVENTION'],
				'com_inter' => $result['COMMENTAIRE_INTERVENTION'],
				);
		},$result);	
	echo json_encode($results);
}else{
	echo json_encode("errorGetTicket");
}