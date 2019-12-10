<?php
$db = new PDO('mysql:host=localhost;dbname=minicrm', 'root', 'plop');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$entreprise = [
    "nom"=> "",
    "adresse"=>"",
    "description"=>"",
];


if($_POST != false && $_GET == false){

    $newline = $db->prepare("INSERT INTO entreprise (nom,adresse,description) VALUES (?, ?, ?)");
        
    $newline->execute([$_POST["name"], $_POST["adresse"], $_POST["description"]]);
    
    
}

if($_GET != false){
    
    
    if($_POST != false){
        $upline = $db->prepare("UPDATE entreprise SET nom = ?, adresse= ?, description = ? WHERE id = ? ");
        
        $upline->execute([$_POST["name"], $_POST["adresse"], $_POST["description"], $_GET["id"]]);
        
        
    }
    
    $entreprise = $db->query("SELECT * FROM entreprise WHERE id =".$_GET["id"]);
    $entreprise = $entreprise->fetch();

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
        <h2 class="text-center"><?php if($_GET != false){echo "Mise à jour de ".$entreprise["nom"];} else{echo "Ajout d'une entreprise";} ?></h2>
        <form action="" method="POST">
            <div>
                <input type="text" name="name" id="name" value="<?php echo $entreprise["nom"] ?>" placeholder="Dénomination" class="w-100">
            </div>
            <div class="mb-2">
                <textarea name="description" id="description" cols="30" rows="5" class="w-100"><?php echo $entreprise["description"] ;?></textarea>
            </div>
            <div>
                <input type="text" name="adresse" id="adresse" value="<?php echo $entreprise["adresse"];?>" placeholder="Adresse complète" class="w-100">


                <button class="btn btn-primary" type="submit">Enregistrer</button>

            </div>
        </form>
    </div>
</body>
<script src="./node_modules/jquery/dist/jquery.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

</html>