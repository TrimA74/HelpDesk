<?php
// Anthony
include_once("db.php");
$message = "no error";
if(isset($_GET["id_user"]) 
	&& isset($_GET["statut_user"])){
	if($_GET["statut_user"] == "client"){
			if(isset($_GET["emergency_status"]) 
				&& isset($_GET["issue_type"]) 
				&& isset($_GET["ticket_description"]) 
				&& isset($_GET["computer_number"]) 
	           	&& isset($_GET["issue_type_specification"])){
				$query = $db->prepare ("select id_poste from poste where libelle_poste =:computer");
				$query->bindValue(":computer",$_GET["computer_number"]);
				$query->execute();
				$idPoste = $query->fetchAll(PDO::FETCH_ASSOC);
			if(count($idPoste) != 1){
				$message .="Erreur d'id_poste";
			}else{
				$query = $db->prepare("
					insert into PROBLEME (
						libelle_probleme,
						id_specialite
					)
					values (
						:issueType,
						:issueTypeSpecification
					)
				");
				$query->bindValue(":issueType",$_GET["issue_type"]); 
				$query->bindValue(":issueTypeSpecification",$_GET["issue_type_specification"]);
				if(!$query->execute()) {
					$message .= "erreur d'execution table probleme";
				}
				else {
					$query = $db->prepare("select max(id_probleme) from probleme");
					$query->execute();
					$idProbleme = $query->fetchAll(PDO::FETCH_ASSOC);
					$query = $db->prepare("
						insert into TICKET (
							id_poste,
							id_urgence,
							id_client,
							id_probleme,
							description_ticket,
							commentaire_ticket,
							date_resolution_prevue_ticket,
							piece_jointe,
							statut_ticket
						)
						values (
							:idPoste,
							:idUrgence,
							:idClient,
							:idProbleme,
							:descriptionTicket,
							:commentaireTicket,
							sysdate,
							'',
							:statutTicket
						)
					");
					$query->bindValue(":idPoste",$idPoste['0']['ID_POSTE']);
					$query->bindValue(":idUrgence",$_GET["emergency_status"]); 
					$query->bindValue(":idClient",$_GET["id_user"]); 
					$query->bindValue(":idProbleme",$idProbleme['0']['MAX(ID_PROBLEME)']); 
					$query->bindValue(":descriptionTicket",$_GET["ticket_description"]); 
					$query->bindValue(":commentaireTicket",null);
					$query->bindValue(":statutTicket",'Ouvert');	
					if(!$query->execute()) {
						$message .= "erreur d'execution table ticket";
					}else {
						$query = $db->prepare("select max(id_ticket) from ticket");
						$query->execute();
						$id_ticket = $query->fetchAll(PDO::FETCH_ASSOC);
						/*
						* INSERTION TABLE TICKET_A_UN_ETAT
						*/
						$query = $db->prepare("
						insert into ticket_a_un_etat (
							id_etat,
							id_ticket
						)
						values (
							:id_etat,
							:id_ticket
						)
						");
						$query->bindValue(":id_etat",2); 
						$query->bindValue(":id_ticket",$id_ticket['0']['MAX(ID_TICKET)']);
						if(!$query->execute()) {
							$message .="erreur table etat";
						}
					}
					
				}
			}
		}else{
			$message .="error1";
	    }
	}else{
		$message .= "error2" ;
	}
}else{
	$message .="error3" ;
}
echo json_encode($message);