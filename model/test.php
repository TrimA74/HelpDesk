<?php
include_once("db.php");
$query = $db->prepare("select max(id_ticket) from ticket");
					$query->execute();
					$id_ticket = $query->fetchAll(PDO::FETCH_ASSOC);
					var_dump($id_ticket['0']['MAX(ID_TICKET)']);
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
					$query->bindValue(":id_ticket",$id_ticket['0']['MAX(id_ticket)']);
					if(!$query->execute()) {
						echo json_encode("erreur table etat");
					}