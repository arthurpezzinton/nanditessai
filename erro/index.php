<?php
require_once "../base_connection.php";
require_once "../base_functions.php";

$blog = crudBlog::getInstance(Conexao::getInstance());

function get_error_request_message($code){
    switch($code) {
        case 400:
            return "Erro na requisição";
        case 401:
            return "Não autorizado";
        case 403:
            return "Acesso restrito";
        case 404:
            return "Página não encontrada";
        case 500:
            return "Erro no servidor";
        case 505:
            return "Sistema indisponível no momento";
        default:
            return "Erro na requisição";
    }
}
?>
<!DOCTYPE html>
<html lang="<?= get_language_cookie(); ?>">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $GLOBALS['project']; ?></title>
    <?= get_base_css(true); ?>
</head>

<body>
    <?= get_base_js(true); ?>
    <img src="../images/bg_planet.png" class="bg-planet">
    <?php include("../generate_stars.php"); ?>
    <img src="../images/bg_planet2.png" class="planet-cover">
    <div class="front-context">
        <div class="container mt-5">
            <div class="d-flex">
                <a href="../"><button class="btn btn-sm btn-dark rounded rounded-circle"><i class="bi bi-arrow-left"></i></button></a>
                <h4 class="ms-3"><?= $GLOBALS['project']; ?></h4>
            </div>
            <div class="areas-card p-5 mt-3 text-center">
                <div class="behinder-blur"></div>
                <h1 class="my-3 text-white"><?= !isset($_GET['code']) ? 400 : $_GET['code']; ?> <i class="bi bi-exclamation-triangle-fill text-danger"></i></h1>
                <h2 class="my-3 text-white"><?= !isset($_GET['code']) ? get_error_request_message(400) : get_error_request_message($_GET['code']); ?></h2>
            </div>
        </div>
    </div>
    <br>
</body>

</html>