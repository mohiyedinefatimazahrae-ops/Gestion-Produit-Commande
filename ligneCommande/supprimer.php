<?php
    require_once("../connexion.php");
    if (isset($_GET["id"]) && !empty($_GET["id"]) && isset($_GET["c"]) && !empty($_GET["c"])) {
    $id = $_GET["id"];
    $c= $_GET["c"];
    $st = $db->exec("DELETE  FROM lignecommande WHERE id_commande=$c and id_produit=$id");
    $m=$db->query("select id_commande,sum(prix_total) as sum from lignecommande group by id_commande having id_commande=$id");
    $d=$m->fetch();
    $mt=$d["sum"];
    $stment = $db->exec("UPDATE command SET mantant_total=$mt WHERE id_commande=$c");
    header("Location: afficher.php?delete&id=$c");
    exit();
    }
?>