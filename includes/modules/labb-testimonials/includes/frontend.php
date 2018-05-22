<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<div class="labb-testimonials labb-grid-container <?php echo labb_get_grid_classes($settings); ?>">

    <?php foreach ($settings->testimonials as $testimonial) : ?>

        <?php if (!is_object($testimonial))
            continue; ?>

        <?php list($animate_class, $animation_attr) = labb_get_animation_atts($testimonial->testimonial_animation); ?>

        <div class="labb-grid-item labb-testimonial <?php echo $animate_class; ?>" <?php echo $animation_attr; ?>>

            <div class="labb-testimonial-text">

                <?php echo do_shortcode(wp_kses_post($testimonial->author_text)); ?>

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

        <?php

    endforeach;

    ?>

</div>