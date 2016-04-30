<?php
// Pépito
/*

Insertion ticket : 

insert into ticket(id_poste,id_urgence,id_client,id_probleme,description_ticket,commentaire_ticket,date_resolution_prevue_ticket,piece_jointe,statut_ticket)
values(8,22,2,27,'Mon ordinateur est tout bleu','j ai allumé mon ordi a coup de batte et il est tout bleu maintenant',sysdate,'ordibleu.jpg','Ouvert')

----------------------------------------------------------------

Requète chef de service:

select t.id_ticket,t.id_poste,q.nom_qualification,c.login_client,t.id_probleme,t.description_ticket,t.commentaire_ticket,t.DATE_RESOLUTION_PREVUE_TICKET,t.PIECE_JOINTE,t.urgence
from ticket t
join qualification q on q.id_qualification = t.id_qualification
join client c on c.id_client = t.id_client
join probleme p on p.id_probleme = t.id_probleme
left join probleme_logiciel pl on p.id_probleme = pl.id_probleme
left join probleme_materiel pm on p.id_probleme = pm.id_probleme

----------------------------------------------------------------

Requète employer : 

select t.id_ticket,t.id_poste,u.nom_urgence,c.login_client,t.id_probleme,t.commentaire_ticket,t.DATE_RESOLUTION_PREVUE_TICKET,t.PIECE_JOINTE,t.STATUT_TICKET
from ticket t
join urgence u on u.id_urgence = t.id_urgence
join client c on c.id_client = t.id_client
join probleme p on p.id_probleme = t.id_probleme
join intervient i on i.id_ticket = t.id_ticket
join employe e on e.id_employe = i.id_employe
where e.id_employe = 1

----------------------------------------------------------------

Insertion client : 

insert into TICKET (id_poste,ID_QUALIFICATION,id_client,id_probleme,description_ticket,commentaire_ticket,date_resolution_prevue_ticket,piece_jointe,urgence,statut_ticket)
values(1,21,3,9,'le clavier a du café dessus lol','c est moi l ai renversé',sysdate,'cafe.png','Forte','En Traitement')


----------------------------------------------------------------

Insetion intervention :

insert into intervient(id_intervient,id_employe,id_ticket,intervient_date,statut_intervention,commentaire_intervention,id_intervention)
values(1,21,15,1,0,'La déprime',3)

----------------------------------------------------------------

include_once("db.php");

$stm = $pdo->prepare $pdo->prepare("select * from client");
$stm->bindValue(":login", $_GET["login"]);
$stm->bindValue(":password", $_GET["password"]);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

echo(json_encode($result));


------------------------------------------------------------------

include_once("db.php");

$query = $pdo->prepare("select * from client");
$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);
echo json_encode($result);

*/


