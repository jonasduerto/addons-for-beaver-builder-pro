<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

$slider_options = [
    'slide_animation' => $settings->slide_animation,
    'direction' => $settings->direction,
    'slideshow_speed' => absint( $settings->slideshow_speed ),
    'animation_speed' => absint( $settings->animation_speed ),
    'control_nav' => ( 'yes' === $settings->control_nav ),
    'direction_nav' => ( 'yes' === $settings->direction_nav ),
    'pause_on_hover' => ( 'yes' === $settings->pause_on_hover ),
    'pause_on_action' => ( 'yes' === $settings->pause_on_action )
];
?>

<div class="labb-testimonials-slider labb-flexslider labb-container"  data-settings='<?php echo wp_json_encode($slider_options); ?>'>

    <div class="labb-slides">

        <?php foreach ($settings->testimonials as $testimonial) : ?>

            <?php if (!is_object($testimonial))
                continue; ?>

            <div class="labb-slide labb-testimonial-wrapper">

                <div class="labb-testimonial">

                    <div class="labb-testimonial-text">

                        <i class="labb-icon-quote"></i>

                        <?php echo wp_kses_post($testimonial->author_text); ?>

                    </div>

                    <div class="labb-testimonial-user">

                        <div class="labb-image-wrapper">

                            <?php $author_image = $testimonial->author_image; ?>

                            <?php if (!empty($author_image)): ?>

                                <?php echo wp_get_attachment_image($author_image, 'thumbnail', false, array('class' => 'labb-image full')); ?>

                            <?php endif; ?>

                        </div>

                        <div class="labb-text">

                            <<?php echo $settings->title_tag; ?> class="labb-author-name"><?php echo esc_html($testimonial->author_name) ?></<?php echo $settings->title_tag; ?>>

                            <div class="labb-author-credentials"><?php echo wp_kses_post($testimonial->credentials); ?></div>

                        </div>

                    </div>

                </div>

            </div>

            <?php

        endforeach;

        ?>

    </div>

</div>