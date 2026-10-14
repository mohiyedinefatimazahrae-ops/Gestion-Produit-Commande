<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>commande CRUD</title>
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
require_once("../connexion.php");
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: ../login.php");
}

$st = $db->query("select * from client,command where client.id_client = command.id_client");
$data = $st->fetchAll(PDO::FETCH_OBJ);
// var_dump($data);

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

    <?php if (isset($_GET['update'])): ?>
        <p style="color: blue;">Commande modifier avec succès !</p>
    <?php endif; ?>
    <?php if (isset($_GET['delete'])): ?>
        <p style="color: red;">Commande supprimer avec succès !</p>
    <?php endif; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Commande Details
                            <a href="ajouter.php" class="btn btn-primary float-end">Add Commande</a>
                        </h4>
                    </div>


                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id de Commande</th>
                                <th>Date de Commande</th>
                                <th>Statut</th>
                                <th>Mantant total</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $commande) : ?>
                                <tr>
                                    <td><?= $commande->id_commande ?></td>
                                    <td><?= $commande->date_commande ?></td>
                                    <td><?= $commande->statut ?></td>
                                    <td><?= $commande->mantant_total ?></td>
                                    <td><?= $commande->nom." ".$commande->prenom ?></td>
                                    <td>
                                        <a href="modifier.php?id=<?= $commande->id_commande; ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a onclick="return confirm('voulez-vous vraiment supprimer ce Commande?')" href="supprimer.php?id=<?= $commande->id_commande; ?>" class="btn btn-danger btn-sm">Delete</a>
                                        <a href="../ligneCommande/afficher.php?id=<?= $commande->id_commande; ?>" class="btn btn-info btn-sm">Details</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></scrip> -->

</body>

</html>