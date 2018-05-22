<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */


$elements = $settings->elements;

$carousel_settings = [
    'arrows' => ('yes' === $settings->arrows),
    'dots' => ('yes' === $settings->dots),
    'autoplay' => ('yes' === $settings->autoplay),
    'autoplay_speed' => absint($settings->autoplay_speed),
    'animation_speed' => absint($settings->animation_speed),
    'pause_on_hover' => ('yes' === $settings->pause_on_hover),
];

$responsive_settings = [
    'display_columns' => $settings->display_columns,
    'scroll_columns' => $settings->scroll_columns,
    'gutter' => $settings->gutter,
    'tablet_width' => $settings->tablet_width,
    'tablet_display_columns' => $settings->tablet_display_columns,
    'tablet_scroll_columns' => $settings->tablet_scroll_columns,
    'tablet_gutter' => $settings->tablet_gutter,
    'mobile_width' => $settings->mobile_width,
    'mobile_display_columns' => $settings->mobile_display_columns,
    'mobile_scroll_columns' => $settings->mobile_scroll_columns,
    'mobile_gutter' => $settings->mobile_gutter,

];

$carousel_settings = array_merge($carousel_settings, $responsive_settings);
?>

<?php if (!empty($elements)) : ?>

    <div class="labb-carousel labb-container"
         data-settings='<?php echo wp_json_encode($carousel_settings); ?>'>

        <?php foreach ($elements as $element) : ?>

            <?php if (!is_object($element))
                continue; ?>

            <div class="labb-carousel-item">

                <?php echo do_shortcode($element->element_content); ?>

            </div><!--.labb-carousel-item -->

        <?php endforeach; ?>

    </div> <!-- .labb-carousel -->

<?php endif; ?>
