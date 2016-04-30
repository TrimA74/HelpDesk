<?php

$tns = "  
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = srv-oracle.iut-acy.local)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = info2)
    )
  )
       ";
$db_username = "M4103G8";
$db_password = "info";
try{
    $db = new PDO("oci:dbname=".$tns,$db_username,$db_password);
}catch(PDOException $e){
    echo ($e->getMessage());
}