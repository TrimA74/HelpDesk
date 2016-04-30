<?php
// Anthony
include_once("db.php");

if(isset($_GET["id_user"]) && isset($_GET["statut_user"]) && isset($_GET["issue_type"])){
	    $query = $db->prepare("select * from specialite where type_specialite=:type");
		$query->bindValue(":type",$_GET["issue_type"]);          
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$results = array_map(function($result) {
			return array(
				'id_specialite' => $result['ID_SPECIALITE'],
				'nom_specialite' => $result['NOM_SPECIALITE'],
				'type_specialite' => $result['TYPE_SPECIALITE']
				);
		},$result);
		echo json_encode($results);
}