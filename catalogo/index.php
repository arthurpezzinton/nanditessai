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
        <div class="container text-center mt-5">
            <div class="d-flex">
                <a href="../"><button class="btn btn-sm btn-dark rounded rounded-circle"><i class="bi bi-arrow-left"></i></button></a>
                <h4 class="ms-3"><?= $GLOBALS['project']; ?></h4>
            </div>
            <div class="areas-card p-5 mt-3">
                <div class="behinder-blur-dark"></div>
                <div class="input-group">
                    <span class="input-group-text" id="search-icon"><i class="bi bi-search"></i></span>
                    <input id="search" type="text" class="form-control" placeholder="<?= get_translation('name'); ?>" aria-label="<?= get_translation('name'); ?>" aria-describedby="search-icon" oninput="get_stars()">
                </div>
            </div>
            <div class="areas-card p-5 mt-3">
                <div class="behinder-blur-dark"></div>
                <div class="text-center">
                    <h4><i class="bi bi-star-fill text-warning icon-card-areas me-4"></i><?= get_translation('stellar_catalog'); ?></h4>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <small class="small text-light"><?= get_translation('click_on_a_star_to_see_its_planets'); ?></small>
                        <div class="table-responsive table-planet-owner mt-2">
                            <table class="table table-hover table-sm table-planet">
                                <thead>
                                    <tr>
                                        <th class="text-start"><?= get_translation('name'); ?></th>
                                        <th><?= get_translation('class'); ?></th>
                                        <th><?= get_translation('teff'); ?></th>
                                        <th><?= get_translation('mag'); ?></th>
                                        <th><?= get_translation('dist'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="table_body" class="table-group-divider">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border border-dark rounded rounded-3 p-4 text-start">
                            <h5><i class="bi bi-star me-2"></i><span id="nome"></span></h5>
                            <small class="small text-light"><?= get_translation('details_of_the_Solar_System'); ?></small>
                            <div class="row g-3 mt-4">
                                <div class="col-sm-6">
                                    <label for="temperatura" class="small text-light"><?= get_translation('temperature'); ?></label>
                                    <h6 id="temperatura"><span id="valor_temperatura"></span> K</h6>
                                </div>
                                <div class="col-sm-6">
                                    <label for="raio" class="small text-light"><?= get_translation('ray'); ?></label>
                                    <h6 id="raio"><span id="valor_raio"></span> R☉</h6>
                                </div>
                                <div class="col-sm-6">
                                    <label for="distancia" class="small text-light"><?= get_translation('distance'); ?></label>
                                    <h6 id="distancia"><span id="valor_distancia"></span> pc</h6>
                                </div>
                                <div class="col-sm-6">
                                    <label for="magnitude" class="small text-light"><?= get_translation('magnitude'); ?></label>
                                    <h6 id="magnitude"><span id="valor_magnitude"></span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="border border-dark rounded rounded-3 p-4 text-start mt-3">
                            <h5><i class="bi bi-globe-americas me-2"></i><?= get_translation('planets_detected'); ?></h5>
                            <div class="text-center"><span id="quantidade"></span> <?= get_translation('planet_s_in_the_system'); ?> <span id="nome_2"></span></div>
                            <div id="planetas">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        function get_stars() {
            $('#table_body').html("<tr><td colspan='5'><div class='p-5 m-5 text-center'><div class='spinner-border'></div></div></td></tr>")
            $.ajax({
                type: "POST",
                url: "api.php",
                dataType: 'json',
                data: {
                    action: 'get_stars',
                    search: $("#search").val()
                },
                success: function(result) {
                    var text_return = ""
                    for (var ind = 0; ind < result.data.length; ind++) {
                        var element = result.data[ind]
                        text_return += "<tr id='estrela_" + element.id + "' class='estrelas cursor-pointer' onclick=\"escolher_estrela('" + element.id + "','" + element.teff + "','" + element.raio + "','" + element.dist + "','" + element.mag + "','" + element.nome + "')\">" +
                            "<td class='p-3 text-start'>" + element.nome + "</td>" +
                            "<td class='p-3'><span class='border border-dark rounded rounded-circle py-1 px-2 " + (element.classe == "G" ? "text-warning fw-bold" : "") + "'>" + element.classe + "</span></td>" +
                            "<td class='p-3'>" + element.teff + "</td>" +
                            "<td class='p-3'>" + element.mag + "</td>" +
                            "<td class='p-3'>" + element.dist + "</td>" +
                            "</tr>"
                    }
                    $("#table_body").html(text_return)
                    $('#valor_temperatura').html('-')
                    $('#valor_raio').html('-')
                    $('#valor_distancia').html('-')
                    $('#valor_magnitude').html('-')
                    $('#nome').html('-')
                    $('#nome_2').html('-')
                    $('#quantidade').html(0)
                    $("#planetas").html('')
                },
                error: function(error) {
                    manage_error_response(error)
                }
            });
        }

        function escolher_estrela(id, teff, raio, dist, mag, nome) {
            $('.estrelas').removeClass('active')
            $('#estrela_' + id).addClass('active')
            $('#valor_temperatura').html(teff)
            $('#valor_raio').html(raio)
            $('#valor_distancia').html(dist)
            $('#valor_magnitude').html(mag)
            $('#nome').html(nome)
            $('#nome_2').html(nome)
            $.ajax({
                type: "POST",
                url: "api.php",
                dataType: 'json',
                data: {
                    action: 'get_planets',
                    star: id
                },
                success: function(result) {
                    var text_return = ""
                    for (var ind = 0; ind < result.data.length; ind++) {
                        var element = result.data[ind]
                        console.log(element)
                        text_return += "<div class='border border-warning rounded rounded-4 py-2 px-3 mt-3 text-start'>" +
                            "<h6>" + element.nome + "</h6>" +
                            "<div class='d-flex justify-content-between'>" +
                            "<small class='small text-light'>" +
                            "<span>P: " + element.p + " d</span>" +
                            "<span class='ms-2'>a: " + element.a + " AU</span>" +
                            "<span class='ms-2'>M: " + element.m + " M⊕</span>" +
                            "</small>" +
                            (element.descricao != null && element.descricao != "" ? "<span class='badge bg-purple'>" + element.descricao + "</span>" : "") +
                            "</div>" +
                            "</div>"
                    }
                    $("#planetas").html(text_return)
                    $('#quantidade').html(result.data.length)
                    reset_tooltips()
                    reset_popovers()
                },
                error: function(error) {
                    manage_error_response(error)
                }
            });
        }

        $(document).ready(function() {
            get_stars()
        })
    </script>
    <?php include("../nandibot_.php"); ?>
</body>

</html>