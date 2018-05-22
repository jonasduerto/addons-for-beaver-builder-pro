<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

$module::$gallery_counter++;

$settings->gallery_class = !empty($settings->gallery_class) ? sanitize_title($settings->gallery_class) : 'gallery-carousel-' . $module::$gallery_counter;

$items = $settings->gallery_items;

if ($settings->bulk_upload == 'yes') {

    $items = array();

    $ids = $settings->gallery_images;

    if (empty($ids))
        return;

    foreach ($ids as $id):

        $item = array('item_type' => 'image', 'item_image' => $id, 'item_name' => '', 'tags' => '', 'item_link' => '','item_description' => '');

        $items[] = (object)$item;

    endforeach;
}

$carousel_settings = [
    'enable_lightbox' => ('yes' === $settings->enable_lightbox),
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

$carousel_settings = (object)array_merge($carousel_settings, $responsive_settings);

if (!empty($items)) : ?>

<div id="labb-gallery-carousel-<?php echo uniqid(); ?>"
     class="labb-gallery-carousel labb-container <?php echo $settings->gallery_class; ?>"
     data-settings='<?php echo wp_json_encode($carousel_settings); ?>'>

    <?php foreach ($items as $item): ?>

        <?php if (!is_object($item))
            continue; ?>

        <?php

        $style = '';
        if (!empty($item->item_tags)) {
            $terms = explode(',', $item->item_tags);

            foreach ($terms as $term) {
                $style .= ' term-' . $term;
            }
        }
        ?>

        <?php

        $item_type = $item->item_type;
        $item_class = 'labb-' . $item_type . '-type';

        ?>

        <div class="labb-gallery-carousel-item <?php echo $style; ?> <?php echo $item_class; ?>">

            <div class="labb-project-image">

                <?php

                if (!empty($item->item_image)) :

                    $size = isset($settings->image_size) ? $settings->image_size : 'large';

                    $src = wp_get_attachment_image_src($item->item_image, $size);

                    $photo_data = FLBuilderPhoto::get_attachment_data($item->item_image);

                    // Display caption of the photo as item name if no name is specified by the user - useful in bulk upload case
                    if (empty($item->item_name))
                        $item->item_name = $photo_data->caption;

                    // Display description of the photo as item description if no description is specified by the user - useful in bulk upload case
                    if (empty($item->item_description))
                        $item->item_description = $photo_data->description;

                    // set params
                    $photo_settings = array(
                        'align' => 'center',
                        'link_type' => '',
                        'crop' => $settings->crop,
                        'photo' => $photo_data,
                        'photo_src' => $src[0],
                        'photo_source' => 'library',
                    );

                    if ($item_type == 'image' && !empty($item->item_link)) {

                        $photo_settings['link_type'] = 'url';

                        $photo_settings['link_url'] = $item->item_link;

                        $photo_settings['link_target'] = $settings->link_target;
                    }

                    // render image
                    FLBuilder::render_module_html('photo', $photo_settings);

                    ?>

                    <div class="labb-image-info">

                        <div class="labb-entry-info">

                            <<?php echo $settings->title_tag; ?> class="labb-entry-title">

                            <?php if ($item_type == 'image' && !empty($item->item_link)): ?>

                                <a href="<?php echo esc_url($item->item_link); ?>"
                                   title="<?php echo esc_html($item->item_name); ?>"
                                   target="_blank"><?php echo esc_html($item->item_name); ?></a>

                            <?php else: ?>

                                <?php echo esc_html($item->item_name); ?>

                            <?php endif; ?>

                        </<?php echo $settings->title_tag; ?>>

                        <?php if ($item_type == 'youtube' || $item_type == 'vimeo') : ?>

                            <?php
                            $video_url = $item->video_link;
                            ?>
                            <?php if (!empty($video_url)) : ?>

                                <a class="labb-video-lightbox"
                                   data-fancybox="<?php echo $settings->gallery_class; ?>"
                                   href="<?php echo $video_url; ?>"
                                   title="<?php echo esc_html($item->item_name); ?>"
                                   data-description="<?php echo wp_kses_post($item->item_description); ?>"><i
                                            class="labb-icon-video-play"></i></a>

                            <?php endif; ?>

                        <?php elseif ($item_type == 'html5video' && !empty($item->mp4_video)) : ?>

                            <?php $video_id = 'labb-video-' . $item->mp4_video; ?>

                            <a class="labb-video-lightbox"
                               data-fancybox="<?php echo $settings->gallery_class; ?>"
                               href="#<?php echo $video_id; ?>"
                               title="<?php echo esc_html($item->item_name); ?>"
                               data-description="<?php echo wp_kses_post($item->item_description); ?>"><i
                                        class="labb-icon-video-play"></i></a>

                            <div id="<?php echo $video_id; ?>" class="labb-fancybox-video">

                                <?php

                                $mp4_video_data = FLBuilderPhoto::get_attachment_data($item->mp4_video);

                                $webm_video_data = FLBuilderPhoto::get_attachment_data($item->webm_video);

                                ?>

                                <video width="<?php $mp4_video_data->width; ?>"
                                       height="<?php $mp4_video_data->height; ?>"
                                       poster="<?php echo $photo_data->url; ?>"
                                       src="<?php echo $mp4_video_data->url; ?>"
                                       autoplay="1"
                                       preload="metadata"
                                       controls
                                       controlsList="nodownload">
                                    <source type="video/mp4"
                                            src="<?php echo $mp4_video_data->url; ?>">
                                    <source type="video/webm"
                                            src="<?php echo $webm_video_data->url; ?>">
                                </video>

                            </div>

                        <?php endif; ?>

                        <span class="labb-terms"><?php echo esc_html($item->tags); ?></span>

                    </div>

                    <?php if ($item_type == 'image' && $carousel_settings->enable_lightbox) : ?>

                        <?php $image_data = wp_get_attachment_image_src($item->item_image, 'full'); ?>

                        <?php if ($image_data) : ?>

                            <?php $image_src = $image_data[0]; ?>

                            <a class="labb-lightbox-item"
                               data-fancybox="<?php echo $settings->gallery_class; ?>"
                               href="<?php echo $image_src; ?>"
                               title="<?php echo esc_html($item->item_name); ?>"
                               data-description="<?php echo wp_kses_post($item->item_description); ?>"><i
                                        class="labb-icon-full-screen"></i></a>

                        <?php endif; ?>

                    <?php endif; ?>

                <?php endif; ?>

            </div>

        </div>

        </div>

    <?php endforeach; ?>

    </div> <!-- .labb-gallery-carousel -->

<?php endif; ?>