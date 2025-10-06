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
                <div class="text-center">
                    <h4><i class="bi bi-lightbulb-fill text-warning icon-card-areas me-4"></i><?= get_translation('develop_your_own_theories'); ?></h4>
                </div>
                <div class="mt-5">
                    <label for="nome" class="form-label d-flex justify-content-between"><span><?= get_translation('authors_name'); ?></span><small class="small text-light" id="counter_nome">255</small></label>
                    <input type="text" class="form-control" id="nome" placeholder="<?= get_translation('you_can_leave_your_name_as_the_author_of_the_theory'); ?>" maxlength="255" oninput="counter_characters(this.id)">
                </div>
                <div class="mt-5">
                    <label for="titulo" class="form-label d-flex justify-content-between"><span><?= get_translation('theory_title'); ?></span><small class="small text-light" id="counter_titulo">500</small></label>
                    <input type="text" class="form-control" id="titulo" placeholder="<?= get_translation('ex_new_methodology'); ?>" maxlength="500" oninput="counter_characters(this.id)" onfocus="remove_wrong_validation(this.id)">
                </div>
                <div class="mt-5">
                    <label for="descricao" class="form-label d-flex justify-content-between"><span><?= get_translation('general_description'); ?></span><small class="small text-light" id="counter_descricao">3000</small></label>
                    <textarea class="form-control" rows="5" placeholder="<?= get_translation('describe_your_theory_in_general_terms'); ?>" id="descricao" maxlength="3000" oninput="counter_characters(this.id)" onfocus="remove_wrong_validation(this.id)"></textarea>
                </div>
                <div class="mt-5">
                    <label for="hipotese" class="form-label d-flex justify-content-between"><span><?= get_translation('main_hypothesis'); ?></span><small class="small text-light" id="counter_hipotese">5000</small></label>
                    <textarea class="form-control" rows="7" placeholder="<?= get_translation('what_is_your_main_hypothesis'); ?>" id="hipotese" maxlength="5000" oninput="counter_characters(this.id)" onfocus="remove_wrong_validation(this.id)"></textarea>
                </div>
                <div class="mt-5">
                    <label for="metodologia" class="form-label d-flex justify-content-between"><span><?= get_translation('parameters_and_methodology'); ?></span><small class="small text-light" id="counter_metodologia">3000</small></label>
                    <textarea class="form-control" rows="5" placeholder="<?= get_translation('what_parameters_will_you_use'); ?>" id="metodologia" maxlength="3000" oninput="counter_characters(this.id)" onfocus="remove_wrong_validation(this.id)"></textarea>
                </div>
                <div class="mt-5">
                    <label for="resultados" class="form-label d-flex justify-content-between"><span><?= get_translation('expected_results'); ?></span><small class="small text-light" id="counter_resultados">3000</small></label>
                    <textarea class="form-control" rows="5" placeholder="<?= get_translation('what_kind_of_results_do_you_hope_to_obtain_with_your_theory'); ?>" id="resultados" maxlength="3000" oninput="counter_characters(this.id)" onfocus="remove_wrong_validation(this.id)"></textarea>
                </div>
                <button class="btn btn-sm btn-info py-2 px-5 rounded rounded-pill mt-5" onclick="submit_theory()"><i class="bi bi-cloud-arrow-up-fill"></i> <?= get_translation('submit_theory'); ?></button>
            </div>
            <?php
            $teorias = $blog->execute_search("SELECT *, DATE_FORMAT(t.registro,'%d/%m/%Y') AS data_registro FROM teorias t ORDER BY t.registro DESC ", array());

            if(!empty($teorias)){
            ?>
            <div class="areas-card p-5 mt-3">
                <div class="behinder-blur-dark"></div>
                <div class="text-center">
                    <h4><i class="bi bi-database-fill-check text-success icon-card-areas me-4"></i>Teorias Enviadas</h4>
                </div>
                <div class="accordion mt-5" id="teorias">
                    <?php
                    foreach($teorias as $teoria):
                    ?>
                    <div class="accordion-item border border-dark mt-2">
                        <div class="accordion-header p-3 repositorio-collapse rounded rounded-1 cursor-pointer collapsed" data-bs-toggle="collapse" data-bs-target="#area_collapsed_<?= $teoria->id; ?>" aria-expanded="false" aria-controls="area_collapsed_<?= $teoria->id; ?>">
                            <div class="d-flex justify-content-between"><h5><?= $teoria->titulo; ?></h5><small class="small text-light"><?= $teoria->data_registro; ?></small></div>
                        </div>
                        <div id="area_collapsed_<?= $teoria->id; ?>" class="accordion-collapse collapse" data-bs-parent="#teorias">
                            <div class="accordion-body">
                                <label class="small text-light" for="descricao_enviada_<?= $teoria->id; ?>"><?= get_translation('general_description'); ?></label>
                                <p id="descricao_enviada_<?= $teoria->id; ?>"><?= $teoria->descricao; ?></p>

                                <label class="small text-light" for="hipotese_enviada_<?= $teoria->id; ?>"><?= get_translation('main_hypothesis'); ?></label>
                                <p id="hipotese_enviada_<?= $teoria->id; ?>"><?= $teoria->hipotese; ?></p>

                                <label class="small text-light" for="metodologia_enviada_<?= $teoria->id; ?>"><?= get_translation('parameters_and_methodology'); ?></label>
                                <p id="metodologia_enviada_<?= $teoria->id; ?>"><?= $teoria->metodologia; ?></p>

                                <label class="small text-light" for="resultados_enviada_<?= $teoria->id; ?>"><?= get_translation('expected_results'); ?></label>
                                <p id="resultados_enviada_<?= $teoria->id; ?>"><?= $teoria->resultados; ?></p>
                                <p class="text-end"><?= $teoria->nome; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <br>
    <script>
        function reload_page(){
            window.location.reload()
        }
        function submit_theory() {
            var wrong = false
            if ($("#titulo").val().trim() == "") {
                wrong = true
                notification("bi bi-x-circle", null, "<?= get_translation('theory_title'); ?> <?= get_translation('can_not_be_empty'); ?>!", "danger")
                $("#titulo").addClass('is-invalid')
            }
            if ($("#descricao").val().trim() == "") {
                wrong = true
                notification("bi bi-x-circle", null, "<?= get_translation('general_description'); ?> <?= get_translation('can_not_be_empty'); ?>!", "danger")
                $("#descricao").addClass('is-invalid')
            }
            if ($("#hipotese").val().trim() == "") {
                wrong = true
                notification("bi bi-x-circle", null, "<?= get_translation('main_hypothesis'); ?> <?= get_translation('can_not_be_empty'); ?>!", "danger")
                $("#hipotese").addClass('is-invalid')
            }
            if ($("#metodologia").val().trim() == "") {
                wrong = true
                notification("bi bi-x-circle", null, "<?= get_translation('parameters_and_methodology'); ?> <?= get_translation('can_not_be_empty'); ?>!", "danger")
                $("#metodologia").addClass('is-invalid')
            }
            if ($("#resultados").val().trim() == "") {
                wrong = true
                notification("bi bi-x-circle", null, "<?= get_translation('expected_results'); ?> <?= get_translation('can_not_be_empty'); ?>!", "danger")
                $("#resultados").addClass('is-invalid')
            }
            if (!wrong) {
                $.ajax({
                    type: "POST",
                    url: "api.php",
                    dataType: 'json',
                    data: {
                        action: 'submit_theory',
                        nome: $("#nome").val(),
                        titulo: $("#titulo").val(),
                        descricao: $("#descricao").val(),
                        hipotese: $("#hipotese").val(),
                        metodologia: $("#metodologia").val(),
                        resultados: $("#resultados").val()
                    },
                    success: function(result) {
                        notification("bi bi-check2-circle", "<?= get_translation('theory_sent_successfully'); ?>!", "<?= get_translation('the_page_will_reload'); ?>.", "success")
                        setTimeout(reload_page, 3000)
                    },
                    error: function(error) {
                        manage_error_response(error)
                    }
                });
            }
        }
    </script>
    <?php include("../nandibot_.php"); ?>
</body>

</html>