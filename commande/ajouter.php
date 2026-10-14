<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Commande Add</title>
    <style>
        body {
            background: linear-gradient(135deg, rgb(250, 249, 185), rgb(197, 236, 253));
            min-height: 100vh;
        }
        .nav-link {
            color: rgb(54, 54, 27) !important;
            font-weight: bold;
        }
        .nav-link:hover {
            color:rgb(236, 159, 44) !important;
        }
    </style>
</head>
<?php
//Intégrer le fichier de connexion:
require_once("../connexion.php");
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: ../login.php");
}
if (isset($_POST['save_commande']) && isset($_POST["date"]) && isset($_POST["statut"]) && isset($_POST["client"])) {
$date = $_POST["date"];
$statut = $_POST["statut"];
// $mantant = $_POST["mantant"];
$client = $_POST["client"];
$stm = $db->exec("INSERT INTO command(date_commande,statut,mantant_total,id_client) VALUES('$date','$statut',default,$client)");



header("Location: ajouter.php?success=1");
exit();
}
?>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../client/afficher.php">Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../produit/afficher.php">Produit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../commande/afficher.php">Commande</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">LogOut</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p style="color: green;">Commande ajouté avec succès !</p>
    <?php endif; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Park Add 
                            <a href="afficher.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="form" action="" method="POST">

                            <div class="mb-3">
                                <label>Date Commande</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Statut</label>
                                <select name="statut" class="form-select">
                                    <option value="en cours">En cours</option>
                                    <option value="livrée">Livrée</option>
                                    <option value="terminée">Terminée</option>
                                    <option value="annulée">Annulée</option>
                                </select>
                            </div>
                            <!-- <div class="mb-3">
                                <label>Mantant total</label>
                                <input type="text" name="mantant" class="form-control">
                            </div> -->
                            <?php
                            $st = $db->query("SELECT * FROM client");
                            $data = $st->fetchAll();
                            // var_dump($data) ;
                            ?>
                            <div class="mb-3">
                                <label>Client</label>
                                <select name="client" class="form-select">
                                    <!-- <option value="" id="vide">--Choisir un Responsable--</option> -->
                                    <?php foreach ($data as $client) { ?>
                                        <option value="<?= $client["id_client"] ?>"><?= $client["nom"]." ".$client["prenom"] ?></option>
                                    <?php } ?>    
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="save_commande" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>