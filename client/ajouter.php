<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Client Add</title>
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
if (isset($_POST['save_client']) && isset($_POST["name"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["tel"]) && isset($_POST["adresse"])) {
$name = $_POST["name"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$adresse = $_POST["adresse"];
$stm = $db->exec("INSERT INTO client(nom,prenom,email,telephone,adresse) VALUES('$name','$prenom','$email','$tel','$adresse')");



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
    <p style="color: green;">Client ajouté avec succès !</p>
    <?php endif; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Client Add 
                            <a href="afficher.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="form" action="" method="POST">

                            <div class="mb-3">
                                <label>Nom</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Prenom</label>
                                <input type="text" name="prenom" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Téléphone</label>
                                <input type="text" name="tel" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Adresse</label>
                                <input type="text" name="adresse" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="save_client" class="btn btn-primary">Save</button>
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