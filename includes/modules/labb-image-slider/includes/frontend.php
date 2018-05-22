<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

if ($settings->bulk_upload == 'yes') {

    $image_slides = array();

    $ids = $settings->image_gallery;

    if (empty($ids))
        return;

    foreach ($ids as $id):
    
        $photo_data = FLBuilderPhoto::get_attachment_data($id);

        $image_slide = array('slide_title' => $photo_data->title, 'slide_image' => $id, 'slide_url' => '', 'heading' => $photo_data->caption, 'subheading' => '', 'button_text' => '', 'button_url' => '');

        $image_slides[] = (object)$image_slide;

    endforeach;
}
else {

    $image_slides = $settings->image_slides;

}

$thumbnail_attr = $button_type = '';

$slider_options = [
    'slide_animation' => $settings->slide_animation,
    'direction' => $settings->direction,
    'slideshow_speed' => absint($settings->slideshow_speed),
    'animation_speed' => absint($settings->animation_speed),
    'randomize' => ('yes' === $settings->randomize),
    'loop' => ('yes' === $settings->loop),
    'slideshow' => ('yes' === $settings->slideshow),
    'control_nav' => ('yes' === $settings->control_nav),
    'direction_nav' => ('yes' === $settings->direction_nav),
    'thumbnail_nav' => ('yes' === $settings->thumbnail_nav),
    'pause_on_hover' => ('yes' === $settings->pause_on_hover),
    'pause_on_action' => ('yes' === $settings->pause_on_action)
];
?>

<div class="labb-image-slider labb-container labb-caption-<?php echo $settings->caption_style; ?>"
     data-slider-type="<?php echo $settings->slider_type; ?>"
     data-settings='<?php echo wp_json_encode($slider_options); ?>'>

    <?php if ($settings->slider_type == 'flex'): ?>

        <?php if ('yes' == $settings->thumbnail_nav):

            $carousel_id = uniqid('labb-carousel-');
            $slider_id = uniqid('labb-slider-');

        endif; ?>

        <div <?php echo(!empty($slider_id) ? 'id="' . $slider_id . '"' : ''); ?>
            <?php echo(!empty($carousel_id) ? 'data-carousel="' . $carousel_id . '"' : ''); ?>
                class="labb-flexslider">

            <div class="labb-slides">

                <?php foreach ($image_slides as $slide): ?>

                    <?php if (!is_object($slide))
                        continue; ?>

                    <?php if (!empty($slide->slide_image) && wp_attachment_is_image($slide->slide_image)) : ?>

                        <?php

                        if ('yes' == $settings->thumbnail_nav):

                            $thumbnail_src = wp_get_attachment_image_src($slide->slide_image, 'medium');

                            if ($thumbnail_src)
                                $thumbnail_attr = 'data-thumb="' . $thumbnail_src[0] . '"';

                        endif;

                        ?>

                        <div <?php echo $thumbnail_attr; ?> class="labb-slide">

                            <?php

                            $size = isset($settings->image_size) ? $settings->image_size : 'full';

                            $src = wp_get_attachment_image_src($slide->slide_image, $size);

                            $photo_data = FLBuilderPhoto::get_attachment_data($slide->slide_image);

                            // set params
                            $photo_settings = array(
                                'align' => 'center',
                                'link_type' => '',
                                'crop' => $settings->crop,
                                'photo' => $photo_data,
                                'photo_src' => $src[0],
                                'photo_source' => 'library',
                            );

                            if (!empty($slide->slide_url)) {

                                $photo_settings['link_type'] = 'url';

                                $photo_settings['link_url'] = $slide->slide_url;

                                $photo_settings['link_target'] = $settings->link_target;
                            }

                            // render image
                            FLBuilder::render_module_html('photo', $photo_settings);

                            ?>

                            <?php if (!empty($slide->heading)): ?>

                                <div class="labb-caption">

                                    <?php echo empty($slide->subheading) ? '' : '<div class="labb-subheading">' . htmlspecialchars_decode($slide->subheading) . '</div>'; ?>

                                    <?php if (!empty($slide->heading)): ?>

                                        <?php if (!empty($slide->slide_url)) : ?>

                                            <<?php echo $settings->heading_tag; ?> class="labb-heading">
                                                <a href="<?php echo esc_url($slide->slide_url); ?>"
                                                   title="<?php echo $slide->slide_title; ?>"><?php echo $slide->heading; ?></a>
                                            </<?php echo $settings->heading_tag; ?>>

                                        <?php else : ?>

                                            <<?php echo $settings->heading_tag; ?> class="labb-heading"><?php echo $slide->heading; ?></<?php echo $settings->heading_tag; ?>>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                    <?php if ($settings->caption_style == 'style1' && (!empty($slide->button_url))) : ?>

                                        <?php
                                        $color_class = ' labb-' . esc_attr($slide->button_color);
                                        if (!empty($slide->button_type))
                                            $button_type = ' labb-' . esc_attr($slide->button_type);

                                        $rounded = ($slide->rounded == 'yes') ? ' labb-rounded' : '';

                                        ?>

                                        <a class="labb-button <?php echo $color_class . $button_type . $rounded; ?>"
                                           href="<?php echo esc_url($slide->button_url); ?>"
                                            <?php echo ($slide->new_window == 'yes') ? 'target="_blank"' : ''; ?>><?php echo $slide->button_text; ?></a>

                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>


                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>

            </div>

        </div>

        <?php if (!empty($carousel_id)): ?>

            <div id="<?php echo $carousel_id; ?>" class="labb-thumbnailslider labb-flexslider">

                <div class="labb-slides">

                    <?php foreach ($image_slides as $slide): ?>

                        <?php if (!empty($slide->slide_image) && wp_attachment_is_image($slide->slide_image)) : ?>

                            <div class="labb-slide">

                                <?php echo wp_get_attachment_image($slide->slide_image, 'medium', false, array('class' => 'labb-image medium', 'alt' => $slide->slide_title)); ?>

                            </div>

                        <?php endif; ?>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endif; ?>

    <?php elseif ($settings->slider_type == 'nivo') : ?>

        <?php $nivo_captions = array(); ?>

        <div class="nivoSlider">

            <?php foreach ($image_slides as $slide): ?>

                <?php $caption_index = uniqid('labb-nivo-caption-'); ?>

                <?php if (!empty($slide->slide_image) && wp_attachment_is_image($slide->slide_image)) : ?>

                    <?php

                    $thumbnail_src = wp_get_attachment_image_src($slide->slide_image, 'medium');

                    if ($thumbnail_src)
                        $thumbnail_src = $thumbnail_src[0];

                    ?>

                    <?php if (!empty($slide->slide_url)) : ?>

                        <a href="<?php echo esc_url($slide->slide_url); ?>"
                           title="<?php echo $slide->slide_title; ?>">

                            <?php echo wp_get_attachment_image($slide->slide_image, 'full', false, array('class' => 'labb-image full', 'data-thumb' => $thumbnail_src, 'alt' => $slide->slide_title, 'title' => ('#' . $caption_index))); ?>

                        </a>

                    <?php else : ?>

                        <?php echo wp_get_attachment_image($slide->slide_image, 'full', false, array('class' => 'labb-image full', 'data-thumb' => $thumbnail_src, 'alt' => $slide->slide_title, 'title' => ('#' . $caption_index))); ?>

                    <?php endif; ?>

                    <?php if (!empty($slide->heading)): ?>

                        <?php if (!empty($slide->slide_url)) : ?>

                            <?php $nivo_captions[] = '<div id="' . $caption_index . '" class="nivo-html-caption">' . '<div class="labb-subheading">' . htmlspecialchars_decode($slide->subheading) . '</div>' . '<h3 class="labb-heading">' . '<a href="' . esc_url($slide->slide_url) . '" title="' . $slide->slide_title . '">' . $slide->heading . '</a></h3>' . '</div>'; ?>

                        <?php else : ?>

                            <?php $nivo_captions[] = '<div id="' . $caption_index . '" class="nivo-html-caption">' . '<div class="labb-subheading">' . htmlspecialchars_decode($slide->subheading) . '</div>' . '<h3 class="labb-heading">' . $slide->heading . '</h3>' . '</div>'; ?>

                        <?php endif; ?>

                    <?php endif; ?>

                    <?php $nivo_captions[] = '<div id="' . $caption_index . '" class="nivo-html-caption">' . '<div class="labb-subheading">' . htmlspecialchars_decode($slide->subheading) . '</div>' . '<h3 class="labb-heading">' . $slide->heading . '</h3>' . '</div>'; ?>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

        <div class="labb-caption nivo-html-caption">

            <?php foreach ($nivo_captions as $nivo_caption): ?>

                <?php echo $nivo_caption . "\n"; ?>

            <?php endforeach; ?>

        </div>


    <?php elseif ($settings->slider_type == 'slick') : ?>

        <div class="labb-slickslider">

            <?php foreach ($image_slides as $slide): ?>

                <div class="labb-slide">

                    <?php if (!empty($slide->slide_image) && wp_attachment_is_image($slide->slide_image)) : ?>

                            <?php

                            $size = isset($settings->image_size) ? $settings->image_size : 'full';

                            $src = wp_get_attachment_image_src($slide->slide_image, $size);

                            $photo_data = FLBuilderPhoto::get_attachment_data($slide->slide_image);

                            // set params
                            $photo_settings = array(
                                'align' => 'center',
                                'link_type' => '',
                                'crop' => $settings->crop,
                                'photo' => $photo_data,
                                'photo_src' => $src[0],
                                'photo_source' => 'library',
                            );

                            if (!empty($slide->slide_url)) {

                                $photo_settings['link_type'] = 'url';

                                $photo_settings['link_url'] = $slide->slide_url;

                                $photo_settings['link_target'] = $settings->link_target;
                            }

                            // render image
                            FLBuilder::render_module_html('photo', $photo_settings);

                            ?>

                        <div class="labb-caption">

                            <?php echo empty($slide->subheading) ? '' : '<div class="labb-subheading">' . htmlspecialchars_decode($slide->subheading) . '</div>'; ?>

                            <?php if (!empty($slide->heading)): ?>

                                <?php if (!empty($slide->slide_url)) : ?>

                                    <<?php echo $settings->heading_tag; ?> class="labb-heading">
                                        <a href="<?php echo esc_url($slide->slide_url); ?>"
                                           title="<?php echo $slide->slide_title; ?>"><?php echo $slide->heading; ?></a>
                                    </<?php echo $settings->heading_tag; ?>>

                                <?php else : ?>

                                    <<?php echo $settings->heading_tag; ?> class="labb-heading"><?php echo $slide->heading; ?></<?php echo $settings->heading_tag; ?>>

                                <?php endif; ?>

                            <?php endif; ?>

                            <?php if ($settings->caption_style == 'style1' && (!empty($slide->button_url))) : ?>

                                <?php
                                $color_class = ' labb-' . esc_attr($slide->button_color);
                                if (!empty($slide->button_type))
                                    $button_type = ' labb-' . esc_attr($slide->button_type);

                                $rounded = ($slide->rounded == 'yes') ? ' labb-rounded' : '';

                                ?>

                                <a class="labb-button <?php echo $color_class . $button_type . $rounded; ?>"
                                   href="<?php echo esc_url($slide->button_url); ?>"
                                    <?php echo ($slide->new_window == 'yes') ? 'target="_blank"' : ''; ?>><?php echo $slide->button_text; ?></a>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        </div>

    <?php elseif ($settings->slider_type == 'responsive') : ?>

        <div class="rslides_container">

            <ul class="rslides labb-slide">

                <?php foreach ($image_slides as $slide): ?>

                    <li>

                        <?php if (!empty($slide->slide_image) && wp_attachment_is_image($slide->slide_image)) : ?>

                            <?php

                            $size = isset($settings->image_size) ? $settings->image_size : 'full';

                            $src = wp_get_attachment_image_src($slide->slide_image, $size);

                            $photo_data = FLBuilderPhoto::get_attachment_data($slide->slide_image);

                            // set params
                            $photo_settings = array(
                                'align' => 'center',
                                'link_type' => '',
                                'crop' => $settings->crop,
                                'photo' => $photo_data,
                                'photo_src' => $src[0],
                                'photo_source' => 'library',
                            );

                            if (!empty($slide->slide_url)) {

                                $photo_settings['link_type'] = 'url';

                                $photo_settings['link_url'] = $slide->slide_url;

                                $photo_settings['link_target'] = $settings->link_target;
                            }

                            // render image
                            FLBuilder::render_module_html('photo', $photo_settings);

                            ?>

                            <div class="labb-caption">

                                <?php echo empty($slide->subheading) ? '' : '<div class="labb-subheading">' . htmlspecialchars_decode($slide->subheading) . '</div>'; ?>

                                <?php if (!empty($slide->heading)): ?>

                                    <?php if (!empty($slide->slide_url)) : ?>

                                        <<?php echo $settings->heading_tag; ?> class="labb-heading">
                                            <a href="<?php echo esc_url($slide->slide_url); ?>"
                                               title="<?php echo $slide->slide_title; ?>"><?php echo $slide->heading; ?></a>
                                        </<?php echo $settings->heading_tag; ?>>

                                    <?php else : ?>

                                        <<?php echo $settings->heading_tag; ?> class="labb-heading"><?php echo $slide->heading; ?></<?php echo $settings->heading_tag; ?>>

                                    <?php endif; ?>

                                <?php endif; ?>

                                <?php if ($settings->caption_style == 'style1' && (!empty($slide->button_url))) : ?>

                                    <?php
                                    $color_class = ' labb-' . esc_attr($slide->button_color);
                                    if (!empty($slide->button_type))
                                        $button_type = ' labb-' . esc_attr($slide->button_type);

                                    $rounded = ($slide->rounded == 'yes') ? ' labb-rounded' : '';

                                    ?>

                                    <a class="labb-button <?php echo $color_class . $button_type . $rounded; ?>"
                                       href="<?php echo esc_url($slide->button_url); ?>"
                                        <?php echo ($slide->new_window == 'yes') ? 'target="_blank"' : ''; ?>><?php echo $slide->button_text; ?></a>

                                <?php endif; ?>

                            </div>

                        <?php endif; ?>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>

</div>