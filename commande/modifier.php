<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Commande Edit</title>
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
require("../connexion.php");
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: ../login.php");
}
if (isset($_POST['update_commanse']) && isset($_POST["date"]) && isset($_POST["statut"]) && isset($_POST["mantant"]) && isset($_POST["client"])) {
    $date = $_POST["date"];
    $statut = $_POST["statut"];
    $mantant = $_POST["mantant"];
    $client = $_POST["client"];
    $id = $_POST["id"];
    if (!empty($_POST["mantant"])) {
        $stm = $db->exec("UPDATE command SET date_commande='$date', statut='$statut', mantant_total=$mantant, id_client=$client WHERE id_commande=$id");
    } else {
        $stm = $db->exec("UPDATE command SET date_commande='$date', statut='$statut', mantant_total=default, id_client=$client WHERE id_commande=$id");
    }
    header("Location: afficher.php?update");
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Commande Edit
                            <a href="afficher.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $commande_id = $_GET['id'];
                            $st = $db->query("select * from command where id_commande=$commande_id");
                            $data = $st->fetch(PDO::FETCH_OBJ);
                            // var_dump($data);
                            // $st = $db->query("SELECT * FROM parking WHERE idPark=$parking_id");
                            // $data = $st->fetch(PDO::FETCH_OBJ);
                        }
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $commande_id; ?>">

                            <div class="mb-3">
                                <label>Date de Commande</label>
                                <input type="date" name="date" class="form-control" value="<?= (isset($_GET['id'])) ? $data->date_commande : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label>Statut</label>
                                <input type="text" name="statut" class="form-control" value="<?= (isset($_GET['id'])) ? $data->statut : '' ?>">
                            </div>

                            <input type="hidden" name="mantant" value="<?= (isset($_GET['id'])) ? $data->mantant_total : '' ?>">

                            <?php
                            $st = $db->query("SELECT * FROM client");
                            $dat = $st->fetchAll();
                            // var_dump($data) ;
                            ?>
                            <div class="mb-3">
                                <label>Client</label>
                                <select name="client" class="form-select">
                                    <!-- <option value="" id="vide">--Choisir un Responsable--</option> -->
                                    <?php foreach ($dat as $client) { ?>
                                        <option value="<?= $client["id_client"] ?>" <?= $client["id_client"]== $data->id_client ? 'selected':'' ?>><?= $client["nom"] . " " . $client["prenom"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_commanse" class="btn btn-primary">
                                    Update Commande
                                </button>
                            </div>

                        </form>
                        <?php
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>