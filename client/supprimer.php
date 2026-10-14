<?php
    require_once("../connexion.php");
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = $_GET["id"];
    $st = $db->exec("DELETE  FROM client WHERE id_client=$id");
    header("Location: afficher.php?delete");
    exit();
}
?>