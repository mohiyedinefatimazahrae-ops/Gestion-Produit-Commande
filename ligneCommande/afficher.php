<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Ligne Commande CRUD</title>
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
            color: rgb(236, 159, 44) !important;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Alerte centrale */
        .custom-alert {
            min-width: 350px;
            max-width: 500px;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<?php
require_once("../connexion.php");
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    header("Location: ../login.php");
}
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = $_GET["id"];
    $st = $db->query("select * from produit,command,lignecommande where lignecommande.id_commande = command.id_commande and produit.id_produit=lignecommande.id_produit and command.id_commande=$id");
    $data = $st->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($data);
}


//ajouter un commande remplir de produit
if (isset($_GET["id"]) && isset($_POST["produit"]) && !empty($_POST["qte"])) {
    $produit = $_POST["produit"];
    $qte = $_POST["qte"];
    $statment = $db->query("select prix_unitaire from produit where id_produit=$produit");
    $pr = $statment->fetch();
    $p = $pr["prix_unitaire"];
    $prix_total = $p * $qte;
    $stm = $db->exec("INSERT INTO lignecommande(id_commande,id_produit,quantite,prix_total) VALUES($id,$produit,$qte,$prix_total)");

    $m = $db->query("select id_commande,sum(prix_total) as sum from lignecommande group by id_commande having id_commande=$id");
    $d = $m->fetch();
    $mt = $d["sum"];

    $stment = $db->exec("UPDATE command SET mantant_total=$mt WHERE id_commande=$id");

    header("Location: afficher.php?success=1&id=$id");
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

    <?php if (isset($_GET['update'])): ?>
        <p style="color: blue;">Commande modifier avec succès !</p>
    <?php endif; ?>
    <?php if (isset($_GET['delete'])): ?>
        <p style="color: red;">Commande supprimer avec succès !</p>
    <?php endif; ?>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <p style="color: green;">Commande ajouté avec succès !</p>
    <?php endif; ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form method="post">
                            <button type="submit" name="com" class="btn btn-info">Détails de Commande</button>
                            <button type="submit" name="cl" class="btn btn-info">Détails de client</button>
                        </form>
                        <a href="../commande/afficher.php" class="btn btn-danger float-end">BACK</a>
                    </div>
                    <?php
                    $st = $db->query("select * from produit");
                    $select = $st->fetchAll();
                    // $produitDejaUtilises=array_column($data,'nom_produit');
                    // var_dump($produitDejaUtilises);
                    ?>
                    <div class="card-body">
                        <div class="d-flex gap-3 mb-3">
                            <form action="" method="post" class="d-flex gap-3">
                                <label class="fw-bold">Produit</label>
                                <select name="produit" class="form-select">
                                    <?php foreach ($select as $produit) {
                                        $stock=$produit["stock"];
                                        if (!in_array($produit["nom_produit"], array_column($data, 'nom_produit')) && $stock>0) { ?>
                                            <option value="<?= $produit["id_produit"] ?>"><?= $produit["nom_produit"] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <label class="fw-bold">Quantité</label>
                                <input type="text" name="qte" class="form-control">
                                <button type="submit" name="add" class="btn btn-secondary me-3">Add</button>
                            </form>
                            <?php
                            $result = $db->query("select id_commande,sum(prix_total) as sum from lignecommande group by id_commande having id_commande=$id");
                            if ($result) {
                                $row = $result->fetch(PDO::FETCH_ASSOC);
                        
                                if ($row != null) {
                                    echo "<h4>Mantant Totale: ".$row['sum']." DH</h4>";
                                } else {
                                    echo "<h4>Mantant Totale: 0 DH</h4>";
                                }
                            }
                            ?>
                        </div>


                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>quantité</th>
                                    <th>Prix_totale</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_GET['id'])) {
                                    foreach ($data as $details) : ?>
                                        <tr>
                                            <td><?= $details['nom_produit'] ?></td>
                                            <td><?= $details["quantite"] ?></td>
                                            <td><?= $details["prix_total"] ?></td>
                                            <td>
                                                <a href="modifier.php?id=<?= $details["id_produit"]; ?>&c=<?= $_GET["id"] ?>" class="btn btn-success btn-sm">Edit</a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('voulez-vous vraiment supprimer ce ligne de commande?')" href="supprimer.php?id=<?= $details["id_produit"]; ?>&c=<?= $_GET["id"] ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                <?php endforeach;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        $Stee = $db->query("select * from command where id_commande = $id");
        $D = $Stee->fetch();
        $date_commande=$D['date_commande'];
        $statut=$D['statut'];
        $mantant_total=$D['mantant_total'];
        $id_client=$D['id_client'];

        $Stm = $db->query("select * from client where id_client = $id_client");
        $Dt = $Stm->fetch();
        $nom=$Dt['nom'];
        $prenom=$Dt['prenom'];
        $email=$Dt['email'];
        $telephone=$Dt['telephone'];
        $adresse=$Dt['adresse'];
    ?>


    <?php
    if (isset($_POST['com'])) {
        echo '
    <div class="overlay">
      <div class="custom-alert alert alert-success text-center">
        <h5 class="alert-heading">Commande ' . $id . '</h5>
        <hr>
        <p><strong>Date_commande :</strong> ' . $date_commande . '</p>
        <p><strong>Statut :</strong> ' . $statut . '</p>
        <p><strong>Mantant Totale :</strong> ' . $mantant_total . '</p>
        <form method="post">
          <button type="submit" name="fermer" class="btn btn-outline-success mt-3">Fermer</button>
        </form>
      </div>
    </div>';
    }
    ?>

    <?php
    if (isset($_POST['cl'])) {

        echo '
    <div class="overlay">
      <div class="custom-alert alert alert-success text-center">
        <h5 class="alert-heading">Client ' . $id_client . '</h5>
        <hr>
        <p><strong>Nom :</strong> ' . $nom . '</p>
        <p><strong>Prénom :</strong> ' . $prenom . '</p>
        <p><strong>Email :</strong> ' . $email . '</p>
        <p><strong>Telephone :</strong> ' . $telephone . '</p>
        <p><strong>Adresse :</strong> ' . $adresse . '</p>
        <form method="post">
          <button type="submit" name="fermer" class="btn btn-outline-success mt-3">Fermer</button>
        </form>
      </div>
    </div>';
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>