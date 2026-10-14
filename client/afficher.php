<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Client CRUD</title>
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
$st = $db->query("select * from client");
$data = $st->fetchAll(PDO::FETCH_OBJ);
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
    <p style="color: blue;">Client modifier avec succès !</p>
    <?php endif; ?>
    <?php if (isset($_GET['delete'])): ?>
    <p style="color: red;">Client supprimer avec succès !</p>
    <?php endif; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h4>Client Details
                            <a href="ajouter.php" class="btn btn-primary float-end">Add Client</a>
                        </h4>
                    </div>
                    <div class="card-body ">
                        <table class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Id Client</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Adresse</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $client) : ?>
                                    <tr>
                                        <td><?= $client->id_client ?></td>
                                        <td><?= $client->nom ?></td>
                                        <td><?= $client->prenom ?></td>
                                        <td><?= $client->email ?></td>
                                        <td><?= $client->telephone ?></td>
                                        <td><?= $client->adresse ?></td>
                                        <td>
                                            <a href="modifier.php?id=<?= $client->id_client; ?>" class="btn btn-success btn-sm">Edit</a>
                                            <a onclick="return confirm('voulez-vous vraiment supprimer ce Client?')" href="supprimer.php?id=<?= $client->id_client; ?>" class="btn btn-danger btn-sm">Delete</a>
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