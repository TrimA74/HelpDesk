<?php
include_once("db.php");

if(isset($_GET["login_user"]) && isset($_GET["mdp_user"])){

	$query = $db->prepare("select * 
		                   from client 
		                   where LOGIN_CLIENT =:login and MDP_CLIENT =:mdp");
		$query->bindValue(":login",$_GET["login_user"]);  
		$query->bindValue(":mdp",$_GET["mdp_user"]);      
		$query->execute();
		$client= $query->fetchAll(PDO::FETCH_ASSOC);
		$clients = array_map(function($client) {
			return array(
				'id' => $client['ID_CLIENT'],
				'nom' => $client['NOM_CLIENT'],
				'prenom' => $client['PRENOM_CLIENT'],
				'statut' => "client"
				);
		},$client);
		if(empty($client[0])){
			$query2 = $db->prepare("select * 
		                   from employe emp
		                   		join statut_employe stemp on emp.id_employe = stemp.id_employe
		                   		join statut st on stemp.id_statut = st.id_statut
		                   where LOGIN_EMPLOYE =:login and MDP_EMPLOYE=:mdp");
			$query2->bindValue(":login",$_GET["login_user"]);  
		    $query2->bindValue(":mdp",$_GET["mdp_user"]); 
		    $query2->execute();
		    $client= $query2->fetchAll(PDO::FETCH_ASSOC);
		    $clients = array_map(function($client) {
				return array(
					'id' => $client['ID_EMPLOYE'],
					'nom' => $client['NOM_EMPLOYE'],
					'prenom' => $client['PRENOM_EMPLOYE'],
					'statut' => $client['LIBELLE_STATUT']
					);
		    },$client);
		}
		echo json_encode($clients);
}else{
	echo json_encode("Error");
}