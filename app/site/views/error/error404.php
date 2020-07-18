<?php

if (!defined('URL')){
    header("location: /");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Error - 404</title>
    <link rel="icon" href="<?= URL; ?>assets/img/icon/favicon.ico" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 
</head>
<body>

<main role="main">
    <hr class="featurette-divider">
    <div class="row">
            <div class="col-lg-12 text-center">
                <img src="<?=URL .'assets/img/error/alerta.png' ?>" width="230px" heigth="200px">
                <h1>ERROR 404 - Página não encontrada.</h1>
            </div>
        </div>
    <hr class="featurette-divider">
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="<?= URL; ?>assets/js/holder.min.js"></script>

</body>
</html>