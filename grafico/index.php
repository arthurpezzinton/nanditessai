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
            <div class="row">
                <div class="col-12 col-sm-6 d-flex">
                    <a href="../"><button class="btn btn-sm btn-dark rounded rounded-circle"><i class="bi bi-arrow-left"></i></button></a>
                    <h4 class="ms-3"><?= $GLOBALS['project']; ?></h4>
                </div>
                <div class="col-12 col-sm-6 text-end">
                    <a href="../grafico/"><button class="btn btn-sm btn-dark rounded rounded-2 me-1 <?= !isset($_GET['scale']) ? "bg-purple" : ""; ?>" data-bs-toggle="tooltip" title="<?= get_translation('scale_defined_in_the_information'); ?>"><?= get_translation('scale'); ?> 1</button></a>
                    <a href="../grafico/?scale=1"><button class="btn btn-sm btn-dark rounded rounded-2 me-5 <?= isset($_GET['scale']) ? "bg-purple" : ""; ?>" data-bs-toggle="tooltip" title="<?= get_translation('smaller_scale_for_better_external_viewing'); ?>"><?= get_translation('scale'); ?> 2</button></a>
                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal_grafico"><?= get_translation('informations'); ?></button>
                </div>
            </div>
            <div class="areas-card p-5 mt-3">
                <div class="behinder-blur-dark"></div>
                <div id="graphic_amount" class="echart-graphic"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_grafico" tabindex="-1" aria-labelledby="label_modal_grafico" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="label_modal_grafico"><?= get_translation('chart_information'); ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?= get_translation('this_graph_aims_to_show'); ?></p>
                    <p><?= get_translation('all_positions_and_scales_were_initially_reduced'); ?></p>
                    <p><?= get_translation('all_categories_have_specific_colors'); ?></p>
                    <p class="mt-5"><?= get_translation('analyzing_the_graph'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        var graphic_amount = echarts.init(document.getElementById('graphic_amount'));

        var option_graphic_amount = {
            /*tooltip: {
                formatter: function(params) {
                    return (
                        'Category: ' + params.seriesName + '<br/>' +
                        'x: ' + params.value[0] + '<br/>' +
                        'y: ' + params.value[1] + '<br/>' +
                        'z: ' + params.value[2]
                    );
                }
            },*/
            legend: {
                top: 10,
                textStyle: {
                    color: '#fff'
                }
            },
            xAxis3D: {
                type: 'value',
                splitLine: {
                    show: false
                },
                axisLine: {
                    show: true
                },
                axisTick: {
                    show: false
                }
            },
            yAxis3D: {
                type: 'value',
                splitLine: {
                    show: false
                },
                axisLine: {
                    show: true
                },
                axisTick: {
                    show: false
                }
            },
            zAxis3D: {
                type: 'value',
                splitLine: {
                    show: false
                },
                axisLine: {
                    show: true
                },
                axisTick: {
                    show: false
                }
            },
            grid3D: {
                axisLine: {
                    show: false
                },
                splitLine: {
                    show: false
                },
                viewControl: {
                    projection: 'perspective',
                    autoRotate: false
                }
            },
            series: [{
                    name: 'PC',
                    type: 'scatter3D',
                    itemStyle: {
                        color: "#00BC8C"
                    },
                    data: [
                        <?php
                        $divisor = !isset($_GET['scale']) ? 10000000 : 100000000;
                        $avg = $blog->execute_search("SELECT AVG(td.percentual) AS avg_calculated FROM toi_data td WHERE td.tfopwg_disp = 'CP' OR td.tfopwg_disp = 'KP' ", array(), true);

                        $rows = $blog->execute_search("SELECT * FROM toi_data td WHERE tfopwg_disp = 'PC' ORDER BY td.id ", array());

                        foreach ($rows as $row):
                            $position = toi_row_to_xyz($row);
                            $x = number_format(floatval($position[0]) / $divisor, 2);
                            $y = number_format(floatval($position[1]) / $divisor, 2);
                            $z = number_format(floatval($position[1]) / $divisor, 2);
                            $raio = number_format(floatval($row->pl_rade) / $divisor, 2);
                        ?> {
                                value: [Number("<?= $x; ?>"), Number("<?= $y; ?>"), Number("<?= $z; ?>")],
                                itemStyle: {
                                    color: "<?= floatval($row->percentual) >= floatval($avg->avg_calculated) ? "#00BC8C" : "#E74C3C"; ?>"
                                },
                                symbolSize: Number("<?= $raio; ?>")
                            },
                        <?php
                        endforeach;
                        ?>
                    ]
                },
                {
                    name: 'CP',
                    type: 'scatter3D',
                    itemStyle: {
                        color: "#7CFC00"
                    },
                    data: [
                        <?php
                        $rows = $blog->execute_search("SELECT * FROM toi_data td WHERE tfopwg_disp = 'CP' ORDER BY td.id ", array());

                        foreach ($rows as $row):
                            $position = toi_row_to_xyz($row);
                            $x = number_format(floatval($position[0]) / $divisor, 2);
                            $y = number_format(floatval($position[1]) / $divisor, 2);
                            $z = number_format(floatval($position[1]) / $divisor, 2);
                            $raio = number_format(floatval($row->pl_rade) / $divisor, 2);
                        ?> {
                                value: [Number("<?= $x; ?>"), Number("<?= $y; ?>"), Number("<?= $z; ?>")],
                                itemStyle: {
                                    color: '#7CFC00'
                                },
                                symbolSize: Number("<?= $raio; ?>")
                            },
                        <?php
                        endforeach;
                        ?>
                    ]
                },
                {
                    name: 'KP',
                    type: 'scatter3D',
                    itemStyle: {
                        color: "#8A2BE2"
                    },
                    data: [
                        <?php
                        $rows = $blog->execute_search("SELECT * FROM toi_data td WHERE tfopwg_disp = 'KP' ORDER BY td.id ", array());

                        foreach ($rows as $row):
                            $position = toi_row_to_xyz($row);
                            $x = number_format(floatval($position[0]) / $divisor, 2);
                            $y = number_format(floatval($position[1]) / $divisor, 2);
                            $z = number_format(floatval($position[1]) / $divisor, 2);
                            $raio = number_format(floatval($row->pl_rade) / $divisor, 2);
                        ?> {
                                value: [Number("<?= $x; ?>"), Number("<?= $y; ?>"), Number("<?= $z; ?>")],
                                itemStyle: {
                                    color: '#8A2BE2'
                                },
                                symbolSize: Number("<?= $raio; ?>")
                            },
                        <?php
                        endforeach;
                        ?>
                    ]
                },
                {
                    name: 'FP',
                    type: 'scatter3D',
                    itemStyle: {
                        color: "red"
                    },
                    data: [
                        <?php
                        $rows = $blog->execute_search("SELECT * FROM toi_data td WHERE tfopwg_disp = 'FP' ORDER BY td.id ", array());

                        foreach ($rows as $row):
                            $position = toi_row_to_xyz($row);
                            $x = number_format(floatval($position[0]) / $divisor, 2);
                            $y = number_format(floatval($position[1]) / $divisor, 2);
                            $z = number_format(floatval($position[1]) / $divisor, 2);
                            $raio = number_format(floatval($row->pl_rade) / $divisor, 2);
                        ?> {
                                value: [Number("<?= $x; ?>"), Number("<?= $y; ?>"), Number("<?= $z; ?>")],
                                itemStyle: {
                                    color: 'red'
                                },
                                symbolSize: Number("<?= $raio; ?>")
                            },
                        <?php
                        endforeach;
                        ?>
                    ]
                },
                {
                    name: 'FA',
                    type: 'scatter3D',
                    itemStyle: {
                        color: "orange"
                    },
                    data: [
                        <?php
                        $rows = $blog->execute_search("SELECT * FROM toi_data td WHERE tfopwg_disp = 'FA' ORDER BY td.id ", array());

                        foreach ($rows as $row):
                            $position = toi_row_to_xyz($row);
                            $x = number_format(floatval($position[0]) / $divisor, 2);
                            $y = number_format(floatval($position[1]) / $divisor, 2);
                            $z = number_format(floatval($position[1]) / $divisor, 2);
                            $raio = number_format(floatval($row->pl_rade) / $divisor, 2);
                        ?> {
                                value: [Number("<?= $x; ?>"), Number("<?= $y; ?>"), Number("<?= $z; ?>")],
                                itemStyle: {
                                    color: 'orange'
                                },
                                symbolSize: Number("<?= $raio; ?>")
                            },
                        <?php
                        endforeach;
                        ?>
                    ]
                },
                {
                    name: 'ACP',
                    type: 'scatter3D',
                    itemStyle: {
                        color: "yellow"
                    },
                    data: [
                        <?php
                        $rows = $blog->execute_search("SELECT * FROM toi_data td WHERE tfopwg_disp = 'ACP' ORDER BY td.id ", array());

                        foreach ($rows as $row):
                            $position = toi_row_to_xyz($row);
                            $x = number_format(floatval($position[0]) / $divisor, 2);
                            $y = number_format(floatval($position[1]) / $divisor, 2);
                            $z = number_format(floatval($position[1]) / $divisor, 2);
                            $raio = number_format(floatval($row->pl_rade) / $divisor, 2);
                        ?> {
                                value: [Number("<?= $x; ?>"), Number("<?= $y; ?>"), Number("<?= $z; ?>")],
                                itemStyle: {
                                    color: 'yellow'
                                },
                                symbolSize: Number("<?= $raio; ?>")
                            },
                        <?php
                        endforeach;
                        ?>
                    ]
                }
            ]
        };

        window.addEventListener('resize', function() {
            graphic_amount.resize();
        });

        $(document).ready(function() {
            graphic_amount.setOption(option_graphic_amount);
        })
    </script>
    <?php include("../nandibot_.php"); ?>
</body>

</html>