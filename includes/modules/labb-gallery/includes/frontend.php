<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

$module::$gallery_counter++;

$common = LABB_Gallery_Common::get_instance();

$settings->gallery_class = !empty($settings->gallery_class) ? sanitize_title($settings->gallery_class) : 'gallery-' . $module::$gallery_counter;

$items = $settings->gallery_items;

//$items = $common->parse_items($items);

if ($settings->bulk_upload == 'yes') {

    $items = array();

    $ids = $settings->gallery_images;

    if (empty($ids))
        return;

    foreach ($ids as $id):

        $item = array('item_type' => 'image', 'item_image' => $id, 'item_name' => '', 'tags' => '', 'item_link' => '','item_description' => '');

        $items[] = (object)$item;

    endforeach;

    unset($settings->gallery_images); // exclude items from settings
}
else {

    $items = $settings->gallery_items;

    unset($settings->gallery_items); // exclude items from settings

}

unset($settings->gallery_items); // exclude items from settings

if (!empty($items)) :

    $terms = $common->get_gallery_terms($items);
    $max_num_pages = ceil(count($items) / $settings->items_per_page);

    ?>

    <div class="labb-gallery-wrap labb-gapless-grid"
         data-settings='<?php echo wp_json_encode($module->get_settings_data_atts()); ?>'
         data-items='<?php echo (($settings->pagination) !== 'none') ? json_encode($items, JSON_HEX_APOS) : ''; ?>'
         data-maxpages='<?php echo $max_num_pages; ?>'
         data-total='<?php echo count($items); ?>'
         data-current='1'>


        <?php if (!empty($settings->heading) || $settings->filterable == 'yes'): ?>

            <?php $header_class = (trim($settings->heading) === '') ? ' labb-no-heading' : ''; ?>

            <div class="labb-gallery-header <?php echo $header_class; ?>">

                <?php if (!empty($settings->heading)) : ?>

                    <<?php echo $settings->heading_tag; ?> class="labb-heading"><?php echo wp_kses_post($settings->heading); ?></<?php echo $settings->heading_tag; ?>>

                <?php endif; ?>

                <?php

                if ($settings->bulk_upload !== 'yes' && $settings->filterable == 'yes')
                    echo $common->get_gallery_terms_filter($terms);

                ?>

            </div>

        <?php endif; ?>

        <div class="labb-gallery js-isotope labb-<?php echo esc_attr($settings->layout_mode); ?> labb-grid-container <?php echo labb_get_grid_classes($settings); ?> <?php echo $settings->gallery_class; ?>"
             data-isotope-options='{ "itemSelector": ".labb-gallery-item", "layoutMode": "<?php echo esc_attr($settings->layout_mode); ?>", "masonry": { "columnWidth": ".labb-grid-sizer" } }'>

            <?php if ($settings->layout_mode == 'masonry'): ?>

                <div class="labb-grid-sizer"></div>

            <?php endif; ?>

            <?php $common->display_gallery($items, $settings, 1); ?>

        </div><!-- Isotope items -->

        <?php echo $common->paginate_gallery($items, $settings); ?>

    </div>

    <?php

endif;