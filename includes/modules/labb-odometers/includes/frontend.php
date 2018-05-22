<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<div class="labb-odometers labb-grid-container <?php echo labb_get_grid_classes($settings); ?>">

    <?php foreach ($settings->odometers as $odometer): ?>

        <?php if (!is_object($odometer))
            continue; ?>

        <?php

        $prefix = (!empty ($odometer->prefix)) ? '<span class="prefix">' . $odometer->prefix . '</span>' : '';
        $suffix = (!empty ($odometer->suffix)) ? '<span class="suffix">' . $odometer->suffix . '</span>' : '';

        ?>

        <div class="labb-grid-item labb-odometer">

            <?php echo (!empty ($odometer->prefix)) ? '<span class="labb-prefix">' . $odometer->prefix . '</span>' : ''; ?>

            <div class="labb-number odometer" data-stop="<?php echo intval($odometer->stop_value); ?>">

                <?php echo intval($odometer->start_value); ?>

            </div>

            <?php echo (!empty ($odometer->suffix)) ? '<span class="labb-suffix">' . $odometer->suffix . '</span>' : ''; ?>

            <?php $icon_type = esc_html($odometer->icon_type); ?>

            <?php if ($icon_type == 'icon_image') : ?>

                <?php $icon_image = $odometer->icon_image; ?>

                <?php if (!empty($icon_image)): ?>

                    <?php $icon_html = '<span class="labb-image-wrapper">' . wp_get_attachment_image($icon_image, 'full', false, array('class' => 'labb-image full')) . '</span>'; ?>

                <?php endif; ?>


            <?php else : ?>

                <?php $icon_html = '<span class="labb-icon-wrapper"><i class="' . esc_attr($odometer->font_icon) . '"></i></span>'; ?>

            <?php endif; ?>

            <div class="labb-stats-title-wrap">

                <div class="labb-stats-title"><?php echo $icon_html . esc_html($odometer->stats_title); ?></div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>