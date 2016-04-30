<?php
// Anthony
include_once("db.php");

if(isset($_GET["id_user"])) {
		if(isset($_GET["intervention_date"])) {
			$date = $_GET["intervention_date"];
			echo $date;
			$query = $db->prepare("
				insert into DATE_INTERVENTION (
					LIBELLE_DATE
				)
				values (
					to_date('$date','dd-mm-YY')
				)
			");
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			
				// $query = $db->prepare("select max(id_date) from date_intervention");
				// $idDate = $query->execute();
				// var_dump($idDate);
				// $query = $db->prepare("
				// 	insert into INTERVIENT (
				// 		ID_EMPLOYE,
				// 		ID_TICKET,
				// 		INTERVIENT_DATE,
				// 		COMMENTAIRE_INTERVENTION,
				// 		ID_INTERVENTION,
				// 		STATUT_INTERVENTION
				// 	)
				// 	values (
				// 		:idEmploye,
				// 		:idTicket,
				// 		:intervientDate,
				// 		:commentaireIntervention,
				// 		:idIntervention,
				// 		:statutIntervention
				// 	)
				// ");
				// $query->bindValue(":idEmploye",$);
				// $query->bindValue(":idTicket",$); 
				// $query->bindValue(":intervientDate",$idDate[]); 
				// $query->bindValue(":commentaireIntervention",$); 
				// $query->bindValue(":idIntervention",$); 
				// $query->bindValue(":statutIntervention",$);	
			
		
	}
}