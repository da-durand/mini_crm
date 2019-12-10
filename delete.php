<?php
$db = new PDO('mysql:host=localhost;dbname=minicrm', 'root', 'plop');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


var_dump($_POST);
if($_POST["id_client"]!=false){
    
    // $db->query("SELECT * FROM client WHERE id = ".$_POST["id_client"]);
    // $db = $db->fetch();
    $deleteClient = $db->prepare("DELETE FROM client WHERE id = ?");
            
    $deleteClient->execute([$_POST["id_client"]]);
}
if($_POST["id_entreprise"]!=false){
    
    // $db->query("SELECT * FROM client WHERE id = ".$_POST["id_client"]);
    // $db = $db->fetch();
    $deleteEntreprise = $db->prepare("DELETE FROM entreprise WHERE id = ?");
            
    $deleteEntreprise->execute([$_POST["id_entreprise"]]);
}


?>
<!-- DELETE FROM table_name
WHERE some_column = some_value  -->