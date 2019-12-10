<?php
$db = new PDO('mysql:host=localhost;dbname=minicrm', 'root', 'plop');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./node_modules/@fortawesome/fontawesome-free/css/all.css">
    <link rel="stylesheet" href="./static/style.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid p-0">
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
        <main>
            <div class="container p-0 m-auto ">
                <h2 class="text-center">Listing clients/entreprises</h2>
                <div class="row no-gutters mb-4 nav-page">
                    <ul class="nav nav-tabs w-100">
                        <li class="nav-item w-50">
                            <a class="nav-link active btn px-0" href="#" id="btn-client"> Clients</a>
                        </li>
                        <li class="nav-item w-50">
                            <a class="nav-link btn w-100" href="#" id="btn-entreprise">Entreprises</a>
                        </li>

                    </ul>
                </div>
                <div class="row no-gutters mb-4 search">
                    <div class="col-10">
                        <input class="w-100 h-100" type="text" name="search" id="search" placeholder="Recherche..">
                    </div>
                    <div class="col-2 d-flex w-100">
                        <div class="flex-grow-1 text-center"><i class="fas fa-search btn"></i></div>
                        <div class="flex-grow-1 text-right"><i class="fas fa-ban btn"></i></div>
                    </div>
                </div>


                 <!-- DEBUT CLIENTS -->
                <div class="accordion" id="accordionExample">
                <?php
                    $req = $db->query('SELECT * FROM client');
                    $req = $req->fetchAll();
                    foreach($req as $row) {
                ?>
                <div id="card-<?php echo $row["id"]?>" class="card">
                        <div class="card-header" id="heading-<?php echo $row["id"]?>">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapse-<?php echo $row["id"]?>" aria-expanded="true" aria-controls="collapse-<?php echo $row["id"]?>">
                                    <?php echo utf8_encode($row["prenom"]." ".$row["nom"]) ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse-<?php echo $row["id"]?>" class="collapse " aria-labelledby="heading-<?php echo $row["id"]?>"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-md-2">
                                            <img src="<?php echo $row["photo"] ?>" class="card-img w-100"
                                                alt="...">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <div class="row text-right">

                                                    <div class="col-6">
                                                        <h5 class="card-title m-0 text-left"><?php echo $row["prenom"]." ".$row["nom"] ?></h5>
                                                    </div>
                                                    <div class="col-6"> 
                                                        <a href="./client.php?id=<?php echo $row["id"] ?>"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="delete" id="delete-<?php echo $row["id"] ?>"><i class="fas fa-trash-alt"></a></i>
                                                    </div>
                                                    

                                                </div>
                                                <p class="card-text m-0 mr-5"><?php echo $row["description"]."</br>".$row["adresse_client"];?></p>
                                                <ul class="card-text m-0">
                                                <?php
                                                    $reqEntreprise = $db->query('SELECT * FROM appartient WHERE client_id ='.$row["id"]);
                                                    foreach($reqEntreprise as $row2) {
                                                        // $reqEntreprise = $reqEntreprise->fetchAll();
                                                        $reqNomEnt = $db->query('SELECT * FROM entreprise WHERE id ='.$row2["entreprise_id"]);
                                                        $reqNomEnt = $reqNomEnt->fetch();
                                                ?>
                                                    <li>
                                                        <small class="text-muted">
                                                            <a href="#"><?php echo $reqNomEnt['nom'] ?></a>
                                                        </small>

                                                    </li>
                                                <?php
                                                }

                                                ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }

                    ?>
                </div>
                

                <!-- DEBUT ENTREPRISES -->

                <div class="accordion" id="accordionExample-2">

                <?php
                        $req = $db->query('SELECT * FROM entreprise');
                        $req = $req->fetchAll();
                        foreach($req as $row) {
                    ?>
                    <div id="cardEnt-<?php echo $row["id"]?>" class="card">
                        <div class="card-header" id="heading2-<?php echo $row["id"]?>">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapse2-<?php echo $row["id"]?>" aria-expanded="true" aria-controls="collapse2-<?php echo $row["id"]?>">
                                    <?php echo $row["nom"]?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse2-<?php echo $row["id"]?>" class="collapse " aria-labelledby="heading2-<?php echo $row["id"]?>"
                            data-parent="#accordionExample-2">
                            <div class="card-body">
                                <div class="card">
                                    <div class="row no-gutters">
                                        <div class="col-md-2">
                                            <img src="<?php echo $row["photo"]?>" class="card-img w-100"
                                                alt="...">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <div class="row text-right">

                                                    <div class="col-6">
                                                        <h5 class="card-title m-0 text-left"><?php echo $row["nom"]?></h5>
                                                    </div>
                                                    <div class="col-6"><a href="./entreprise.php?id=<?php echo $row["id"]; ?>"><i class="fas fa-edit"></i></a>
                                                    <a href="#" class="deleteEnt" id="deleteEnt-<?php echo $row["id"] ?>"><i class="fas fa-trash-alt"></a></i>
                                                    </div>
                                                </div>
                                                <p class="card-text m-0 mr-5"><?php echo $row["description"]."</br>".$row["adresse"];?></p>
                                                <ul class="card-text m-0">
                                                    <?php
                                                        $reqEntreprise = $db->query('SELECT * FROM appartient WHERE entreprise_id ='.$row["id"]);
                                                        foreach($reqEntreprise as $row2) {
                                                            
                                                            $reqNomEnt = $db->query('SELECT * FROM client WHERE id ='.$row2["client_id"]);
                                                            $reqNomEnt = $reqNomEnt->fetch();
                                                    ?>
                                                        <li>
                                                            <small class="text-muted">
                                                                <a href="#"><?php echo $reqNomEnt["prenom"]." ".$reqNomEnt['nom'] ?></a>
                                                            </small>

                                                        </li>
                                                    <?php
                                                    }

                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    
            </div>


        </main>
    </div>
</body>
<script src="./node_modules/jquery/dist/jquery.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="./static/js/script.js"></script>

</html>

<!-- <script>
    $(".delete").click(function(){
            var thisId = {"id_client" : parseInt($(this).attr("id").replace("delete-",""))}
            $.post("delete.php",thisId,function(){})
            console.log(thisId);
            $("#card-"+thisId["id_client"]).remove()


            
    })

</script> -->
<script>
    $(".delete").click(function(){
            var thisId = {"id_client" : parseInt($(this).attr("id").replace("delete-",""))}
            $.post("delete.php",thisId,function(){})
            console.log(thisId);
            $("#card-"+thisId["id_client"]).remove()


            
    })
    $(".deleteEnt").click(function(){
            var thisId = {"id_entreprise" : parseInt($(this).attr("id").replace("deleteEnt-",""))}
            $.post("delete.php",thisId,function(){})
            console.log(thisId);
            $("#cardEnt-"+thisId["id_entreprise"]).remove()


            
    })

</script>