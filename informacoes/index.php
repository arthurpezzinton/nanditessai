<?php
require_once "../base_connection.php";
require_once "../base_functions.php";

$blog = crudBlog::getInstance(Conexao::getInstance());
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
            <div class="areas-card p-5 mt-3">
                <div class="behinder-blur-dark"></div>
                <?php include("../informacoes_" . get_language_cookie() . ".php"); ?>
                <a href="informacoes_<?= get_language_cookie(); ?>.pdf" download="<?= str_replace(" ", "", $project); ?>.pdf">
                    <button class="btn btn-sm btn-info py-2 px-5 rounded rounded-pill mt-4"><i class="bi bi-filetype-pdf"></i> <?= get_translation('pdf_version'); ?></button>
                </a>
            </div>
        </div>
    </div>
    <br>
    <?php include("../nandibot_.php"); ?>
</body>

</html>