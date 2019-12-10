<?php
$db = new PDO('mysql:host=localhost;dbname=minicrm', 'root', 'plop');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$client = [
    "nom"=> "",
    "prenom"=>"",
    "adresse_client"=>"",
    "description"=>"",
    "entreprise"=>"",
];


if($_POST != false && $_GET == false){

    $newline = $db->prepare("INSERT INTO client (nom, prenom, adresse_client, description) VALUES (?, ?, ?, ?)");
        
    $newline->execute([$_POST["lastname"], $_POST["firstname"], $_POST["adress"], $_POST["description"]]);
    
    $newline2 = $db->prepare("INSERT INTO appartient (entreprise_id, client_id) VALUES (?, ?)");

    $idEnt = str_replace("choice-", "", $_POST["entreprise"]);
    
    var_dump($idEnt);

    $lastClientId = $db->query("SELECT * FROM client WHERE id=LAST_INSERT_ID()");
    $lastClientId = $lastClientId->fetch();

    $newline2->execute([$idEnt, $lastClientId["id"]]);
    
}

if($_GET != false){
    
    
    if($_POST != false){
        $upline = $db->prepare("UPDATE client SET nom = ?, prenom = ?, adresse_client = ?, description = ? WHERE id = ? ");
        
        $upline->execute([$_POST["lastname"], $_POST["firstname"], $_POST["adress"], $_POST["description"], $_GET["id"]]);
        
        $upline2 = $db->prepare("INSERT INTO appartient (entreprise_id, client_id) VALUES (?, ?)");

        $idEnt = str_replace("choice-", "", $_POST["entreprise"]);

        $upline2->execute([$idEnt, $_GET["id"]]);

        
    }
    
    $client = $db->query("SELECT * FROM client WHERE id =".$_GET["id"]);
    $client = $client->fetch();

}


?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="./static/style.css">
    <title>Document</title>
</head>

<body>
    <header class="d-flex bg-secondary text-light p-3">
        <div class="row no-gutters text-left w-100">
            <div class="col-6">
                <h1 class="m-0 h5">My mini CRM</h1>
            </div>
            <div class="col-6 d-flex  align-items-center">
                <nav class="">
                    <ul class="d-flex m-0 list-unstyled  ">
                        <li class="ml-4 ">
                            <a class="" href="./index.php">Listings</a>
                        </li>
                        <li class="ml-4">
                            <a href="./client.php">Ajouter Client</a>
                        </li>
                        <li class="ml-4">
                            <a href="./entreprise.php">Ajouter Entreprise</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>


    </header>
    <div class="container m-auto p-0">
        <h2 class="text-center"><?php if($_GET != false){echo "Mise à jour de ".$client["prenom"]." ".$client["nom"];} else{echo "Ajout d'un client";} ?></h2>
        <form action="" method="POST">
            <div class="row no-gutters">
                <div class="col-6 pr-5">
                    <input type="text" name="firstname" id="firstname" value="<?php echo $client["prenom"] ?>" placeholder="Prénom" class="w-100">
                </div>
                <div class="col-6">
                    <input type="text" name="lastname" id="lastname" value="<?php echo $client["nom"] ?>" placeholder="Nom" class="w-100">
                </div>
                <div class="col-12">
                    <input type="text" name="adress" id="adress" value="<?php echo $client["adresse_client"] ?>" placeholder="Adresse" class="w-100">
                </div>
                <div class="col-12 mb-2">
                    <textarea name="description" id="description" cols="30" rows="10" class="w-100"><?php echo $client["description"] ?></textarea>
                </div>
                <div class="col-6 pr-5">
                    <select name="entreprise" id="entreprise" class="w-100">
                        <?php 

                        $job_list = $db->query("SELECT * FROM entreprise");
                        foreach ($job_list as $row){
                        ?>
                        <option value="choice-<?php echo $row["id"]; ?>"><?php echo $row["nom"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary" type="submit">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="./node_modules/jquery/dist/jquery.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

</html>