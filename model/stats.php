<?php
/* Evan */
include_once("db.php");
include_once("tools.php");

$query = $db->prepare("select count(id_ticket) as \"tickets\",c.nom_client as Nom from ticket t
join client c on c.id_client=t.id_client
group by t.id_client,c.nom_client");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);