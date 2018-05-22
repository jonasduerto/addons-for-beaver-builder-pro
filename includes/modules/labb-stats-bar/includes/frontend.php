<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<div class="labb-stats-bars">

    <?php foreach ($settings->stats_bars as $stats_bar) : ?>

        <?php if (!is_object($stats_bar))
            continue; ?>

        <?php

        $bar_color = $stats_bar->bar_color;
        if(preg_match('/^[a-f0-9]{6}$/i', $bar_color))
            $bar_color = '#' . $bar_color;

        $color_style = '';
        if (!empty($bar_color))
            $color_style = ' style="background:' . esc_attr($bar_color) . ';"';

        ?>

        <div class="labb-stats-bar">

            <div class="labb-stats-title">
                <?php echo esc_html($stats_bar->stats_title) ?><span><?php echo esc_attr($stats_bar->percentage); ?>%</span>
            </div>

            <div class="labb-stats-bar-wrap">

                <div <?php echo $color_style; ?> class="labb-stats-bar-content"
                                                 data-perc="<?php echo esc_attr($stats_bar->percentage); ?>"></div>

                <div class="labb-stats-bar-bg"></div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>