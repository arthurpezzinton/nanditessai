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
                    <input id="search" type="text" class="form-control" placeholder="TOI" aria-label="TOI" aria-describedby="search-icon" oninput="get_data()">
                </div>
                <div class="mt-3 text-start">
                    <?php
                    foreach ($GLOBALS['type_labels'] as $label_type):
                    ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="filter" id="filter_<?= $label_type['value']; ?>" value="<?= $label_type['value']; ?>" <?= $label_type['value'] == "all" ? "checked" : ""; ?> onchange="get_data()">
                            <label class="form-check-label" for="filter_<?= $label_type['value']; ?>"><?= $label_type['nick']; ?></label>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
                <div class="mt-3 text-start small">
                    <div class="row g-1">
                        <?php
                        foreach ($GLOBALS['type_labels'] as $label_type):
                            if ($label_type['value'] != "all") {
                        ?>
                                <div class="col-md-6 col-lg"><small class="small bg-dark px-2 py-1 text-nowrap rounded rounded-3"><?= $label_type['nick']; ?> - <?= $label_type['text']; ?></small></div>
                        <?php
                            }
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
            <div class="areas-card p-5 mt-3">
                <div class="behinder-blur-dark"></div>
                <div class="d-flex justify-content-between">
                    <h4><span class="badge text-white bg-dark" data-bs-toggle="tooltip" title="<?= get_translation('average_correct_percentage_of_validated_planets'); ?>"><i class="bi bi bi-sliders2-vertical me-1"></i><span id="avg">0</span></span></h4>
                    <h4>
                        <span class="badge text-white bg-purple" data-bs-toggle="tooltip" title="<?= get_translation('amount_of_items_found'); ?>"><i class="bi bi-database me-1"></i><span id="amount">0</span></span>
                        <span class="badge text-white bg-success" data-bs-toggle="tooltip" title="<?= get_translation('above_average_number_of_items'); ?>"><i class="bi bi-database-check me-1"></i><span id="amount_over_avg">0</span></span>
                    </h4>
                </div>
                <div class="table-responsive table-planet-owner scroll-table mt-2">
                    <table class="table table-hover table-sm table-planet">
                        <thead>
                            <tr>
                                <th data-bs-toggle="tooltip" data-bs-placement="bottom" title="TESS Object of Interest">TOI</th>
                                <th>Status</th>
                                <th><?= get_translation('percentage'); ?></th>
                                <th><?= get_translation('validation'); ?></th>
                                <th data-bs-toggle="tooltip" data-bs-placement="bottom" title="TESS Input Catalog">TIC ID</th>
                                <th><?= get_translation('stars_surface_gravity'); ?></th>
                                <th><?= get_translation('transit_duration'); ?></th>
                                <th><?= get_translation('stellar_radius'); ?></th>
                                <th><?= get_translation('own_movement_in_dec_'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="table_body" class="table-group-divider">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        function get_data() {
            $('#table_body').html("<tr><td colspan='9'><div class='p-5 m-5 text-center'><div class='spinner-border'></div></div></td></tr>")
            $.ajax({
                type: "POST",
                url: "api.php",
                dataType: 'json',
                data: {
                    action: 'get_data',
                    search: $("#search").val(),
                    filter: $('input[name="filter"]:checked').val()
                },
                success: function(result) {
                    var text_return = ""
                    for (var ind = 0; ind < result.data.length; ind++) {
                        var element = result.data[ind]
                        var validation = ""
                        if (element.tfopwg_disp == "PC" && Number(element.over_avg) == 1) validation = "<i class='bi bi-exclamation-circle-fill text-success' data-bs-toggle='tooltip' title='<?= get_translation('likely_candidate'); ?>'></i>"
                        else if ((element.tfopwg_disp == "CP" || element.tfopwg_disp == "KP") && Number(element.over_avg) != 1) validation = "<i class='bi bi-exclamation-triangle-fill text-danger' data-bs-toggle='tooltip' title='<?= get_translation('known_confirmed_below_average'); ?>'></i>"
                        text_return += "<tr>" +
                            "<td>" + element.toi + "</td>" +
                            "<td>" + element.tfopwg_disp + "</td>" +
                            "<td class='" + (Number(element.over_avg) == 1 && element.tfopwg_disp != "FP" && element.tfopwg_disp != "FA" ? "text-success fw-bold" : "") + "'>" + element.percentual + "</td>" +
                            "<td>" + validation + "</td>" +
                            "<td>" + element.tid + "</td>" +
                            "<td>" + check_empty_value(element.st_logg) + "</td>" +
                            "<td>" + check_empty_value(element.pl_trandurh) + "</td>" +
                            "<td>" + check_empty_value(element.st_rad) + "</td>" +
                            "<td>" + check_empty_value(element.st_pmdec) + "</td>" +
                            "</tr>"
                    }
                    $("#table_body").html(text_return)
                    $('#amount').html(result.amount)
                    $('#amount_over_avg').html(result.amount_over_avg + "<small class='small'><small class='small fw-normal ms-1'>(" + result.amount_percentual + "%)</small></small>")
                    $('#avg').html(result.avg + "<small class='small'><small class='small'>%</small></small>")
                    reset_tooltips()
                    reset_popovers()
                },
                error: function(error) {
                    manage_error_response(error)
                }
            });
        }

        $(document).ready(function() {
            get_data()
        })
    </script>
    <?php include("../nandibot_.php"); ?>
</body>

</html>