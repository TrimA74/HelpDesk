<?php
/* Evan */
include_once("db.php");
include_once("tools.php");
if(isset($_GET["id_user"]) && isset($_GET["statut_user"])){

	if($_GET["statut_user"] == "client"){
		$query = $db->prepare("select * 
			from ticket t
			join ticket_a_un_etat taue on t.id_ticket = taue.id_ticket
			join etat e on taue.id_etat = e.id_etat
			join urgence u on t.id_urgence = u.id_urgence
			join probleme p on t.id_probleme = p.id_probleme
			join specialite spe on p.id_specialite = spe.id_specialite	
			where ID_CLIENT=:id");
		$query->bindValue(":id",$_GET["id_user"]);          
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$results = array_map(function($result) {
			return array(
				'com_ticket' => $result['COMMENTAIRE_TICKET'],
				'date_rez_prevue' => convertDate($result['DATE_RESOLUTION_PREVUE_TICKET']),
				'description' => $result['DESCRIPTION_TICKET'],
				'specialite' => $result['NOM_SPECIALITE'],
				'id_client' => $result['ID_CLIENT'],
				'id_etat' => $result['ID_ETAT'],
				'id_poste' => $result['ID_POSTE'],
				'pb' => $result['LIBELLE_PROBLEME'],
				'id_ticket' => $result['ID_TICKET'],
				'id_ticket_etat' => $result['ID_TICKET_A_UN_ETAT'],
				'libelle_etat' => $result['LIBELLE_ETAT'],
				'piece_jointe' => $result['PIECE_JOINTE'],
				'statut_ticket' => $result['STATUT_TICKET'],
				'urgence' => $result['NOM_URGENCE']
				);
		},$result);
		echo json_encode($results);
	}else if($_GET["statut_user"] == "responsable"){
		$query =  $db->prepare("select * 
			                    from ticket t 
								join urgence u on t.id_urgence = u.id_urgence
								join intervient i on t.id_ticket = i.id_ticket
                                join employe emp on i.id_employe = emp.id_employe
								join probleme p on t.id_probleme = p.id_probleme
								join specialite spe on p.id_specialite = spe.id_specialite
								join ticket_a_un_etat taue on t.id_ticket = taue.id_ticket
								join etat e on taue.id_etat = e.id_etat
								join client cli on cli.id_client = t.id_client");
		
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$results = array_map(function($result) {
			return array(
				'com_ticket' => $result['COMMENTAIRE_TICKET'],
				'date_rez_prevue' => convertDate($result['DATE_RESOLUTION_PREVUE_TICKET']),
				'description' => $result['DESCRIPTION_TICKET'],
				'nom_client' => $result['NOM_CLIENT'],
				'nom_ope' => $result['NOM_EMPLOYE'],
				'specialite' => $result['NOM_SPECIALITE'],
				'date_der_inter' => $result['INTERVIENT_DATE'],
				'id_ticket' => $result['ID_TICKET'],
				'pb' => $result['LIBELLE_PROBLEME'],
				'libelle_etat' => $result['LIBELLE_ETAT'],
				'piece_jointe' => $result['PIECE_JOINTE'],
				'statut_ticket' => $result['STATUT_TICKET'],
				'urgence' => $result['NOM_URGENCE']
				);
		},$result);
		echo json_encode($results);
		// var_dump($results);
	}else if($_GET["statut_user"] == "operateur"){
		$query =  $db->prepare("select * 
			                    from ticket t 
									join ticket_a_un_etat taue on t.id_ticket = taue.id_ticket
									join etat e on taue.id_etat = e.id_etat
									join urgence u on t.id_urgence = u.id_urgence
									join probleme p on t.id_probleme = p.id_probleme
									join ticket_a_employe te on te.id_ticket=t.id_ticket 
									join specialite spe on p.id_specialite = spe.id_specialite
									join client cli on cli.id_client = t.id_client
								where ID_EMPLOYE=:id");
		$query->bindValue(":id",$_GET["id_user"]);   
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$results = array_map(function($result) {
			return array(
				'com_ticket' => $result['COMMENTAIRE_TICKET'],
				'date_rez_prevue' => convertDate($result['DATE_RESOLUTION_PREVUE_TICKET']),
				'description' => $result['DESCRIPTION_TICKET'],
				'nom_client' => $result['NOM_CLIENT'],
				'id_etat' => $result['ID_ETAT'],
				'id_poste' => $result['ID_POSTE'],
				'specialite' => $result['NOM_SPECIALITE'],
				//'date_der_inter' => $result['INTERVIENT_DATE'],
				'id_ticket' => $result['ID_TICKET'],
				'pb' => $result['LIBELLE_PROBLEME'],
				'libelle_etat' => $result['LIBELLE_ETAT'],
				'piece_jointe' => $result['PIECE_JOINTE'],
				'statut_ticket' => $result['STATUT_TICKET'],
				'urgence' => $result['NOM_URGENCE']
				);
		},$result);
		echo json_encode($results);
	}
}else{ 
	echo json_encode("Error");
}

