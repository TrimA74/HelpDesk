<?php
include_once("db.php");
if(isset($_GET["id_user"])){
$message="";
$test = 0;
		$query = $db->prepare("select *
			from ticket t
			join ticket_a_un_etat taue on t.id_ticket = taue.id_ticket
			join etat e on taue.id_etat = e.id_etat
			join urgence u on t.id_urgence = u.id_urgence
			join probleme p on t.id_probleme = p.id_probleme
			join specialite spe on p.id_specialite = spe.id_specialite	
			where ID_CLIENT=:id and t.id_ticket= (select max(id_ticket) from ticket)");
		$query->bindValue(":id",$_GET["id_user"]);          
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		if(empty($result)){
			$message .="pas de ticket récupéré";
		}
		$query2 = $db->prepare("select e.id_employe from employe e
		join specialite_employer sp on sp.id_employe=e.id_employe
		where sp.id_specialite=:id");
		$query2->bindValue(":id",$result[0]['ID_SPECIALITE']);          
		$query2->execute();
		$result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(count($result2)>=1){
			$id_employe = $result2[0]['ID_EMPLOYE'];
			if(count($result2)==1){
				$message .="1 seul employe";
			}else if(count($result2)>1) {
				$message .="plusieurs employes";
				foreach ($result2 as $key => $value) {
				$query = $db->prepare("select * from ticket_a_employe
				where id_employe=:id");
				$query->bindValue(":id",$value['ID_EMPLOYE']);
				$query->execute();
				if(empty($query->fetchAll(PDO::FETCH_ASSOC))){
					$id_find = true;
					$id_employe=$value['ID_EMPLOYE'];
					break;
				}else {$id_find=false;}     
				}
				if(!$id_find) {
				$query = $db->prepare("select te.id_employe from ticket_a_employe te
				join specialite_employer se on se.id_employe= te.id_employe
				where se.id_specialite=:id
				having count(te.id_employe) = (select min(count(id_employe)) from ticket_a_employe group by id_employe )
				group by te.id_employe");
				$query->bindValue(":id",$result[0]['ID_SPECIALITE']);          
				$query->execute();
				$result3 = $query->fetchAll(PDO::FETCH_ASSOC);
				if(!empty($result3)){
					$id_employe = $result3[0]['ID_EMPLOYE'];
					// var_dump($id_employe);
				}
				}
			}
		$query3 = $db->prepare("insert into 
			ticket_a_employe (id_ticket,id_employe) values 
			(".$result[0]['ID_TICKET'].",".$id_employe.")");
		$query3->bindValue(":id",$result[0]['ID_SPECIALITE']);          
		if($query3->execute()){
			$message .= "insert succeed";
			$result3 = $query3->fetchAll(PDO::FETCH_ASSOC);
			if(isset($_GET["test"])){
				$query = $db->prepare("delete from ticket where id_ticket=(select max(id_ticket) from ticket)");         
				if($query->execute()){$message .=" delete done"; $test=1;};
			}
			$result = $query->fetchAll(PDO::FETCH_ASSOC);

		}else {
			$message .= " no insert";
		}	
		}
		// print_r($db->errorInfo());

	echo json_encode(array(
		"message"=>$message,
		"test"=>$test));
	};

