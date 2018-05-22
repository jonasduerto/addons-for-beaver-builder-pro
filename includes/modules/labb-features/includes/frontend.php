<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */


?>

<?php $class = (($settings->tiled == 'yes') ? 'labb-tiled ' . $settings->container_class : $settings->container_class); ?>

<div class="labb-features <?php echo esc_attr($class); ?>">

    <?php foreach ($settings->features as $feature): ?>

        <?php if (!is_object($feature))
            continue; ?>

        <div class="labb-feature labb-image-text-toggle">

            <?php list($animate_class, $animation_attr) = labb_get_animation_atts($feature->image_animation); ?>

            <div class="labb-feature-image labb-image-content <?php echo $animate_class; ?>" <?php echo $animation_attr; ?>>

                <?php if (!empty($feature->feature_image)): ?>
                    
                    <?php

                    $size = isset($settings->image_size) ? $settings->image_size : 'large';

                    $src = wp_get_attachment_image_src($feature->feature_image, $size);

                    $photo_data = FLBuilderPhoto::get_attachment_data($feature->feature_image);

                    // set params
                    $photo_settings = array(
                        'align' => 'center',
                        'link_type' => '',
                        'crop' => $settings->crop,
                        'photo' => $photo_data,
                        'photo_src' => $src[0],
                        'photo_source' => 'library',
                    );

                    // render image
                    FLBuilder::render_module_html('photo', $photo_settings);

                    ?>

                <?php endif; ?>

            </div>

            <?php list($animate_class, $animation_attr) = labb_get_animation_atts($feature->text_animation); ?>

            <div class="labb-feature-text labb-text-content <?php echo $animate_class; ?>" <?php echo $animation_attr; ?>>

                <div class="labb-subtitle"><?php echo esc_html($feature->feature_subtitle); ?></div>

                <<?php echo $settings->title_tag; ?> class="labb-title"><?php echo esc_html($feature->feature_title); ?></<?php echo $settings->title_tag; ?>>

                <div class="labb-feature-details"><?php echo do_shortcode(wp_kses_post($feature->feature_text)); ?></div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>
