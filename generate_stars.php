<div class="background-animated">
    <?php
    $starts = rand(250,300);
    $colors = array(
        "rgb(255, 255, 255)",
        "rgb(255, 255, 210)",
        "rgb(255, 210, 210)",
        "rgb(210, 210, 255)",
    );
    $colors_matrix = array(0,0,0,0,0,1,0,0,0,1,2,0,0,3,0,2,0,0,3,1,0,0,0,0,0,0,0,0,3,0,0,1,0,0,2,0,0,0,0,2,0,3,1,0,0,0,0,0,0,0);
    $signal = array("","-");

    for ($ind = 0; $ind < $starts; $ind++) {
    ?>
        <span class="bubble"></span>
    <?php
    }
    ?>
    <style>
        @keyframes move {
            100% {
                transform: translate3d(0, 0, 1px) rotate(360deg);
            }
        }

        .background-animated {
            height: 80vh !important;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 5;
        }

        .background-animated .bubble {
            backface-visibility: hidden;
            position: absolute;
            animation: move;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        <?php
        for ($ind = 0; $ind < $starts; $ind++) {
            $bubble_size = rand(3, 12) . "px";
            $duration = rand(20, 30)*10 . "s";
            $color = $colors[$colors_matrix[rand(0,sizeof($colors_matrix))]];
            $top = rand(20,80) . "%";
            $left = rand(20,80) . "%";
            $delay = "-" . rand(10,230) . "s";
            $origin = $signal[rand(0,1)] . rand(20,80) . "vw " . $signal[rand(0,1)] . rand(20,80) . "vh";
        ?>
        .background-animated .bubble:nth-child(<?= $ind; ?>) {
            width: <?= $bubble_size; ?>;
            height: <?= $bubble_size; ?>;
            border-radius: <?= $bubble_size; ?>;
            color: <?= $color; ?>;
            top: <?= $top; ?>;
            left: <?= $left; ?>;
            animation-duration: <?= $duration; ?>;
            animation-delay: <?= $delay; ?>;
            transform-origin: <?= $origin; ?>;
            box-shadow: calc(<?= $bubble_size; ?>*2) 0 calc(<?= $bubble_size; ?>/2.5) currentColor;
        }
        <?php
        }
        ?>
    </style>
</div>