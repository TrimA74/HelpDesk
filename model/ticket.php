<?php 
include_once("db.php");

if(isset($_GET["id_ticket"])){
	$query = $db->prepare("select * 
			                    from ticket t 
			                        join poste pos on t.id_poste = pos.id_poste
									join ticket_a_un_etat taue on t.id_ticket = taue.id_ticket
									join etat e on taue.id_etat = e.id_etat
									join urgence u on t.id_urgence = u.id_urgence
									join probleme p on t.id_probleme = p.id_probleme
									join specialite spe on p.id_specialite = spe.id_specialite
									join client cli on cli.id_client = t.id_client
			               where t.id_ticket=:id
						");
	$query->bindValue(":id",$_GET["id_ticket"]);
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);	
	echo json_encode($result);
}else{
	echo json_encode("error");
}