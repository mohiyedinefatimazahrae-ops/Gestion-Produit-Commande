<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* background: linear-gradient(135deg, rgb(127, 82, 187), rgb(66, 133, 160));*/
            background: linear-gradient(135deg, rgb(250, 249, 185), rgb(197, 236, 253));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            background-color: rgb(211, 202, 202);
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .login-icon {
            font-size: 3rem;
            color: rgb(120, 85, 177);
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<?php
require_once("connexion.php");
$msg = "";
if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];
    $stmt = $db->query("select * from user where login='$login' and password='$password'");
    $user = $stmt->fetch();
    if ($user != false) {
        $_SESSION["user_id"] = $user["id"];
        header("Location: client/afficher.php");
    } else {
        $msg = " Login or password incorrect !! ";
    }
}
?>

<body>
    <!-- <form action="" method="post">
        <label for="">Login :</label>
        <input type="text" name="login" id="">
        <label for="">Password :</label>
        <input type="pasword" name="password" id="">
        <input type="submit" value="Login">
        <span style="color: red;"><?= $msg ?> </span>
    </form> -->

    <div class="card text-center">
        <div class="mb-4">
            <i class="bi bi-person-circle login-icon"></i>
        </div>
        <h4 class="mb-4">Connexion</h4>
        <form action="" method="post">
            <div class="mb-3 text-start">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" name="login" id="login">
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <input type="submit" class="btn btn-primary w-100 mb-3" value="login">
            <span style="color: red;"><?= $msg ?> </span>
        </form>
    </div>
</body>

</html>