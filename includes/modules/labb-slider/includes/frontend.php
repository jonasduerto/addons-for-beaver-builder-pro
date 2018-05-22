<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

$slider_settings = [
    'slide_animation' => $settings->slide_animation,
    'direction' => $settings->direction,
    'control_nav' => ('yes' === $settings->control_nav),
    'direction_nav' => ('yes' === $settings->direction_nav),
    'randomize' => ('yes' === $settings->randomize),
    'loop' => ('yes' === $settings->loop),
    'pause_on_hover' => ('yes' === $settings->pause_on_hover),
    'pause_on_action' => ('yes' === $settings->pause_on_action),
    'slideshow' => ('yes' === $settings->slideshow),
    'slideshow_speed' => absint($settings->slideshow_speed),
    'animation_speed' => absint($settings->animation_speed),
];
?>

<div class="labb-slider labb-container <?php echo esc_attr($settings->class); ?>"
     data-settings='<?php echo wp_json_encode($slider_settings); ?>'>

    <div class="labb-flexslider">

        <div class="labb-slides">

            <?php foreach ($settings->slides as $slide): ?>

                <?php if (!is_object($slide))
                    continue; ?>

                <?php if (!empty($slide->slide_text)): ?>

                    <div class="labb-slide">

                        <?php echo do_shortcode(wp_kses_post($slide->slide_text)); ?>

                    </div>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

    </div>

</div>