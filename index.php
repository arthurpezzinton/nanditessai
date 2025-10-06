<?php
require_once "base_connection.php";
require_once "base_functions.php";

$blog = crudBlog::getInstance(Conexao::getInstance());
?>
<!DOCTYPE html>
<html lang="<?= get_language_cookie(); ?>">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $GLOBALS['project']; ?></title>
    <?= get_base_css(); ?>
</head>

<body>
    <?= get_base_js(); ?>
    <img src="images/bg_planet.png" class="bg-planet">
    <?php include("generate_stars.php"); ?>
    <img src="images/bg_planet2.png" class="planet-cover">
    <div class="front-context">
        <div class="text-center mt-4">
            <?php
            foreach ($GLOBALS['languages'] as $key => $value) {
            ?>
                <span class="purple-text-button mx-2 <?= $key == get_language_cookie() ? "active" : ""; ?>" <?= $key != get_language_cookie() ? "onclick=\"change_language('" . $key . "')\"" : ""; ?>><?= strtoupper($key); ?></span>
            <?php
            }
            ?>
        </div>
        <div class="container text-center mt-5">
            <h4 class="fw-bold"><?= get_translation("project_team"); ?></h4>
            <div class="text-light"><?= get_translation("meet_the_researchers_behind_the"); ?> <?= $project; ?></div>
            <div class="row col-lg-6 mx-auto mt-4 mb-5 g-3">
                <?php
                foreach ($GLOBALS['team'] as $member):
                ?>
                    <div class="col-6 col-md-4">
                        <div class="p-3 team-card">
                            <div class="behinder-blur"></div>
                            <div><span class="text-white"><?= $member['nome']; ?></span></div>
                            <small class="small text-light"><?= $member['funcao']; ?></small>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
            <h1 class="logo-name my-5 pt-5"><?= $project; ?></h1>
            <div class="col-lg-8 mx-auto mt-5 py-5">
                <h4 class="mt-5 text-white"><?= get_translation("mapping_worlds_by"); ?></h4>
                <h6 class="mt-4 small text-light"><?= get_translation("discover_the_possibility"); ?></h6>
            </div>
            <div class="row g-4 mb-5">
                <div class="col-md-6 col-lg-4">
                    <div class="areas-card hovered px-3 py-5">
                        <div class="behinder-blur"></div>
                        <div>
                            <i class="bi bi-openai text-success icon-card-areas"></i>
                        </div>
                        <div class="mt-5">
                            <h6><?= get_translation('ai_machine_learning'); ?></h6>
                            <small class="text-light small"><?= get_translation('complete_ai_powered_exoplanet_classification_system'); ?></small>
                        </div>
                        <div class="mt-4 px-5">
                            <button class="btn btn-sm btn-info w-100 p-2 rounded rounded-pill" onclick="window.open('analise','_self')"><i class="bi bi-filetype-ai"></i> <?= get_translation('toi_analysis'); ?></button>
                        </div>
                        <div class="px-3">
                            <button class="btn btn-primary bg-purple shadow w-100 p-2 rounded rounded-pill mt-2" onclick="window.open('grafico','_self')"><i class="bi bi-badge-3d-fill"></i> <?= get_translation('graphic_simulation'); ?></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="areas-card hovered px-3 py-5">
                        <div class="behinder-blur"></div>
                        <div>
                            <i class="bi bi-database text-warning icon-card-areas"></i>
                        </div>
                        <div class="mt-5">
                            <h6><?= get_translation('theoretical_repository'); ?></h6>
                            <small class="text-light small"><?= get_translation('space_for_the_creation_and_storage_of_theories'); ?></small>
                        </div>
                        <div class="mt-4 px-5">
                            <button class="btn btn-sm btn-light w-100 p-2 rounded rounded-pill" onclick="window.open('repositorio','_self')"><i class="bi bi-database-add"></i> <?= get_translation('create_your_theory'); ?></button>
                            <button class="btn btn-sm btn-dark w-100 p-2 rounded rounded-pill mt-2" onclick="window.open('catalogo','_self')"><i class="bi bi-clipboard-check"></i> <?= get_translation('catalog'); ?></button>
                            <!--<button class="btn btn-sm btn-danger w-100 p-2 rounded rounded-pill mt-2" onclick="window.open('quiz','_self')"><i class="bi bi-controller"></i> <?= get_translation('spatial_quiz'); ?></button>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="areas-card hovered px-3 py-5">
                        <div class="behinder-blur"></div>
                        <div>
                            <i class="bi bi-graph-up-arrow text-info icon-card-areas"></i>
                        </div>
                        <div class="mt-5">
                            <h6><?= get_translation('next_steps'); ?></h6>
                            <small class="text-light small"><?= get_translation('how_did_we_get_here'); ?></small>
                        </div>
                        <div class="mt-4 px-5">
                            <button class="btn btn-sm btn-primary w-100 p-2 rounded rounded-pill" onclick="window.open('informacoes','_self')"><i class="bi bi-gear"></i> <?= get_translation('ai_training'); ?></button>
                            <button class="btn btn-sm btn-success w-100 p-2 rounded rounded-pill mt-2" onclick="window.open('futuro','_self')"><i class="bi bi-hourglass-top"></i> <?= get_translation('from_now_on'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <span class="text-light small"><?= get_translation('conceptual_simulation_for_exoplanet'); ?></span><br>
            <span class="text-light small"><?= get_translation('powered_by'); ?> <a href="https://collfy.com/" class="text-light">Collfy</a> & <a href="https://carryonconsultoria.com.br/" class="text-light">Carry On</a></span>
        </div>
    </div>
    <br>
    <script>
        function change_language(language) {
            $.ajax({
                type: "POST",
                url: "api.php",
                dataType: 'json',
                data: {
                    action: 'change_language',
                    language: language,
                },
                success: function(result) {
                    location.reload(true);
                },
                error: function(error) {
                    manage_error_response(error)
                }
            });
        }
    </script>
    <?php include("nandibot.php"); ?>
</body>

</html>