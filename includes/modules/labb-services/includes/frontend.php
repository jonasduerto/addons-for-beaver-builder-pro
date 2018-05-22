<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<div class="labb-services labb-<?php echo $settings->style; ?> labb-grid-container <?php echo labb_get_grid_classes($settings); ?>">

    <?php foreach ($settings->services as $service): ?>

        <?php if (!is_object($service))
            continue; ?>

        <?php list($animate_class, $animation_attr) = labb_get_animation_atts($service->service_animation); ?>

        <div class="labb-grid-item labb-service-wrapper">

            <div class="labb-service <?php echo $animate_class; ?>" <?php echo $animation_attr; ?>>

                <?php if ($service->icon_type == 'icon_image') : ?>

                    <?php $icon_image = $service->icon_image; ?>

                    <?php if (!empty($icon_image)): ?>

                        <div class="labb-image-wrapper">

                            <?php echo wp_get_attachment_image($icon_image, 'full', false, array('class' => 'labb-image full')); ?>

                        </div>

                    <?php endif; ?>

                <?php else : ?>

                    <div class="labb-icon-wrapper">

                        <span class="<?php echo esc_attr($service->font_icon); ?>"></span>

                    </div>

                <?php endif; ?>

                <div class="labb-service-text">

                    <<?php echo $settings->title_tag; ?> class="labb-title"><?php echo esc_html($service->service_title) ?></<?php echo $settings->title_tag; ?>>

                    <div class="labb-service-details"><?php echo do_shortcode(wp_kses_post($service->service_excerpt)); ?></div>

                </div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>