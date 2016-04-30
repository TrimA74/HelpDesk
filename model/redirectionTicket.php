<?php 
include_once("db.php");

if(isset($_GET["id_user"])){
$query = $db->prepare("select t.id_ticket,t.statut_ticket,c.nom_client,c.prenom_client,t.date_resolution_prevue_ticket,u.nom_urgence
	                   from ticket t
	                   join intervient i on i.id_ticket=t.id_ticket
	                   join client c on c.id_client=t.id_client
	                   join urgence u on u.id_urgence=t.id_urgence
	                   where i.id_employe=:id
						");
$query->bindValue(":id",$_GET["id_user"]);
$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);	
$results = array_map(function($result) {
    return array(
        'statut' => $result['STATUT_TICKET'],
        'nom' => $result['NOM_CLIENT'],
        'prenom' => $result['PRENOM_CLIENT'],
        'date' => $result['DATE_RESOLUTION_PREVUE_TICKET'],
        'urgence' => $result['NOM_URGENCE'],
        'id' => $result['ID_TICKET'],
    );
	},$result);
}else{
	$results = array (
		'error' => 'Pas d\'id mon petit ');
}
// var_dump($results);
echo json_encode($results);