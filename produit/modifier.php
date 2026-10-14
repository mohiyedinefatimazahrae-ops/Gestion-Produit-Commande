<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <title>Produit Edit</title>
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
if(isset($_POST['update_produit']) && isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["prix"]) && isset($_POST["stock"])){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $stock = $_POST["stock"];
    $id = $_POST["id"];

$stm = $db->exec("UPDATE produit SET nom_produit='$name', description='$description', prix_unitaire=$prix , stock='$stock' WHERE id_produit=$id");
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
                        <h4>Produit Edit 
                            <a href="afficher.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                            if (isset($_GET['id'])){
                            $produit_id = $_GET['id'];
                            $st = $db->query("select * from produit where id_produit=$produit_id");
                            $data = $st->fetch(PDO::FETCH_OBJ);
                            // var_dump($data);
                            // $st = $db->query("SELECT * FROM parking WHERE idPark=$parking_id");
                            // $data = $st->fetch(PDO::FETCH_OBJ);
                            }
                        ?>
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?= $produit_id; ?>">

                                    <div class="mb-3">
                                    <label>Nom Produit</label>
                                    <input type="text" name="name" class="form-control" value="<?= (isset($_GET['id']))?$data->nom_produit : '' ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>description</label>
                                        <input type="text" name="description" class="form-control" value="<?= (isset($_GET['id']))?$data->description : '' ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Prix unitaire</label>
                                        <input type="text" name="prix" class="form-control" value="<?= (isset($_GET['id']))?$data->prix_unitaire : '' ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Stock</label>
                                        <input type="text" name="stock" class="form-control" value="<?= (isset($_GET['id']))?$data->stock : '' ?>">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_produit" class="btn btn-primary">
                                            Update Produit
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