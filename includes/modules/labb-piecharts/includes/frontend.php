<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */


?>

<?php

$bar_color = $settings->bar_color;
if(preg_match('/^[a-f0-9]{6}$/i', $bar_color))
    $bar_color = '#' . $bar_color;

$track_color = $settings->track_color;
if(preg_match('/^[a-f0-9]{6}$/i', $track_color))
    $track_color = '#' . $track_color;

$bar_color = ' data-bar-color="' . esc_attr($bar_color) . '"';
$track_color = ' data-track-color="' . esc_attr($track_color) . '"';

?>

<div class="labb-piecharts labb-grid-container <?php echo labb_get_grid_classes($settings); ?>">

    <?php foreach ($settings->piecharts as $piechart): ?>

        <?php if (!is_object($piechart))
            continue; ?>

        <div class="labb-grid-item labb-piechart">

            <?php if (isset($piechart->chart_title)): ?>

                <div class="labb-chart-title"><?php echo esc_html($piechart->chart_title); ?></div>

            <?php endif; ?>

            <div class="labb-percentage" <?php echo $bar_color; ?> <?php echo $track_color; ?>
                 data-percent="<?php echo round($piechart->percentage); ?>">

                <div class="labb-percentage-value">

                    <span><?php echo round($piechart->percentage); ?><sup><?php echo $settings->percent_symbol; ?></sup></span>

                    <div class="labb-label"><?php echo esc_html($piechart->stats_title); ?></div>

                </div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>