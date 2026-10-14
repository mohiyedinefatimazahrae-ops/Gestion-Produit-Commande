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
if (isset($_POST['update_commande']) && isset($_POST['qte'])) {
    $qte = $_POST["qte"];
    $idP = $_POST["id"];
    $c = $_POST["c"];
    $statment = $db->query("select prix_unitaire from produit where id_produit=$idP");
    $pr = $statment->fetch();
    $p=$pr["prix_unitaire"];
    $prix_total=$p*$qte;
    $stm = $db->exec("UPDATE lignecommande SET quantite=$qte, prix_total=$prix_total WHERE id_commande=$c and id_produit=$idP");

    $m=$db->query("select id_commande,sum(prix_total) as sum from lignecommande group by id_commande having id_commande=$c");
    $d=$m->fetch();
    $mt=$d["sum"];
    $stment = $db->exec("UPDATE command SET mantant_total=$mt WHERE id_commande=$c");

    header("Location: afficher.php?update&id=$c");
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
                        <h4>Détails Commande Edit
                            <a href="afficher.php?id=<?= $_GET['c'] ?>" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id']) && isset($_GET['c'])) {
                            $commande_id = $_GET['c'];
                            $produit_id = $_GET['id'];
                            $st = $db->query("select * from lignecommande where id_commande=$commande_id and id_produit=$produit_id");
                            $data = $st->fetch(PDO::FETCH_OBJ);
                            // var_dump($data);
                            // $st = $db->query("SELECT * FROM parking WHERE idPark=$parking_id");
                            // $data = $st->fetch(PDO::FETCH_OBJ);
                        }
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" name="c" value="<?= $commande_id; ?>">
                            <input type="hidden" name="id" value="<?= $produit_id; ?>">

                            <div class="mb-3">
                                <label>Quantité</label>
                                <input type="text" name="qte" class="form-control" value="<?= (isset($_GET['id'])) ? $data->quantite : '' ?>">
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="update_commande" class="btn btn-primary">
                                    Update details Commande
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