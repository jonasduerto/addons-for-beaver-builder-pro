<?php

add_action('wp_ajax_labb_load_posts_block', 'labb_load_posts_block_callback');

add_action('wp_ajax_nopriv_labb_load_posts_block', 'labb_load_posts_block_callback');


function labb_load_posts_block_callback() {

    $ajax_parameters = array(
        'query' => '',            // original block atts
        'currentPage' => '',    // the current page of the block
        'blockId' => '',        // block uid
        'blockType' => '',         // the type of the block / block class
        'filterTerm' => '',     // the id for this specific filter type. The filter type is in the query
        'filterTaxonomy' => ''     // the id for this specific filter type. The filter type is in the query
    );


    if (!empty($_POST['blockId'])) {
        $ajax_parameters['blockId'] = $_POST['blockId'];
    }
    if (!empty($_POST['query'])) {
        $ajax_parameters['query'] = $_POST['query']; //current block args
    }
    if (!empty($_POST['settings'])) {
        $ajax_parameters['settings'] = $_POST['settings']; //current block args
    }

    if (!empty($_POST['blockType'])) {
        $ajax_parameters['blockType'] = $_POST['blockType'];
    }
    if (!empty($_POST['currentPage'])) {
        $ajax_parameters['currentPage'] = intval($_POST['currentPage']);
    }
    //read the id for this specific filter type
    if (!empty($_POST['filterTerm'])) {

        //this removes the block offset for blocks pull down filter items
        //..it excepts the "All" filter tab which will load posts with the set offset
        if (!empty($ajax_parameters['query']['offset'])) {
            unset($ajax_parameters['query']['offset']);
        }
        $ajax_parameters['filterTerm'] = $_POST['filterTerm']; //the new id filter
    }

    if (!empty($_POST['filterTaxonomy'])) {

        $ajax_parameters['filterTaxonomy'] = $_POST['filterTaxonomy']; //the new id filter
    }

    if (!empty($ajax_parameters['query']))
        $query_params = labb_parse_block_query($ajax_parameters);


    if (!empty($_POST['settings']))
        $settings = labb_parse_block_settings($ajax_parameters['settings']);

    $loop = new WP_Query($query_params);

    $block = LABB_Blocks_Manager::get_instance($ajax_parameters['blockType']);

    $output = $block->inner($loop->posts, $settings);

    //pagination
    $hidePrev = false;
    $hideNext = false;
    $remaining_posts = 0;

    if ($ajax_parameters['currentPage'] == 1) {
        $hidePrev = true; //hide link on page 1
    }

    if ($ajax_parameters['currentPage'] >= $loop->max_num_pages) {
        $hideNext = true; //hide link on last page
    }
    else {
        $remaining_posts = $loop->found_posts - ($query_params['paged'] * $query_params['posts_per_page']);
    }

    $outputArray = array(
        'data' => $output,
        'blockId' => $ajax_parameters['blockId'],
        'filterTerm' => $ajax_parameters['filterTerm'],
        'filterTaxonomy' => $ajax_parameters['filterTaxonomy'],
        'paged' => $query_params['paged'],
        'maxpages' => $loop->max_num_pages,
        'remaining' => $remaining_posts,
        'hidePrev' => $hidePrev,
        'hideNext' => $hideNext
    );

    echo json_encode($outputArray);

    wp_die();

}

function labb_parse_block_query($params) {

    $q = $params['query'];

    $q['ignore_sticky_posts'] = filter_var($q['ignore_sticky_posts'], FILTER_VALIDATE_BOOLEAN);

    $q['posts_per_page'] = filter_var($q['posts_per_page'], FILTER_VALIDATE_INT);

    // go for the page requested by the user
    $q['paged'] = filter_var($params['currentPage'], FILTER_VALIDATE_INT);

    // Reset offset to enable pagination - setting this to 0 does not work
    $q['offset'] = null;

    $q['fl_builder_loop'] = filter_var($q['fl_builder_loop'], FILTER_VALIDATE_BOOLEAN);

    $q['fl_original_offset'] = filter_var($q['fl_original_offset'], FILTER_VALIDATE_INT);

    // Replace existing tax_query with filter term, if any
    if (!empty($params['filterTerm'])) {
        $q['tax_query'] = array(
            array(
                'field' => 'term_id',
                'taxonomy' => filter_var($params['filterTaxonomy'], FILTER_SANITIZE_STRING),
                'terms' => filter_var($params['filterTerm'], FILTER_VALIDATE_INT),
                'operator' => 'IN',
            )
        );
    }

    return $q;
}

function labb_parse_block_settings($s) {

    $s = (object)$s; // ensure this is an settings object; convert from array to object if required

    $s->block_class = isset($s->block_class) ? $s->block_class : '';

    $s->per_line = isset($s->per_line) ? filter_var($s->per_line, FILTER_VALIDATE_INT) : 3;

    $s->per_line_tablet = isset($s->per_line_tablet) ? filter_var($s->per_line_tablet, FILTER_VALIDATE_INT) : 2;

    $s->per_line_mobile = isset($s->per_line_mobile) ? filter_var($s->per_line_mobile, FILTER_VALIDATE_INT) : 1;

    $s->per_line1 = isset($s->per_line1) ? filter_var($s->per_line1, FILTER_VALIDATE_INT) : 2;

    $s->per_line2 = isset($s->per_line2) ? filter_var($s->per_line2, FILTER_VALIDATE_INT) : 4;

    $s->per_line2_tablet = isset($s->per_line2_tablet) ? filter_var($s->per_line2_tablet, FILTER_VALIDATE_INT) : 2;

    $s->per_line2_mobile = isset($s->per_line2_mobile) ? filter_var($s->per_line2_mobile, FILTER_VALIDATE_INT) : 1;

    $s->excerpt_length = isset($s->excerpt_length) ? filter_var($s->excerpt_length, FILTER_VALIDATE_INT) : 25;

    $s->posts_per_page = isset($s->posts_per_page) ? filter_var($s->posts_per_page, FILTER_VALIDATE_INT) : 6;

    $s->layout_mode = isset($s->layout_mode) ? $s->layout_mode : 'fitRows';

    $s->taxonomy_chosen = isset($s->taxonomy_chosen) ? $s->taxonomy_chosen : $s->taxonomy_filter;

    $s->filterable = isset($s->filterable) ? ($s->filterable == 'yes' || $s->filterable == 'true') : true;

    $s->show_remaining = isset($s->show_remaining) ? ($s->show_remaining == 'yes' || $s->show_remaining == 'true') : false;

    $s->image_linkable = isset($s->image_linkable) ? ($s->image_linkable == 'yes' || $s->image_linkable == 'true') : true;

    $s->post_link_new_window = isset($s->post_link_new_window) ? ($s->post_link_new_window == 'yes' || $s->post_link_new_window == 'true') : false;

    $s->enable_lightbox = isset($s->enable_lightbox) ? ($s->enable_lightbox == 'yes' || $s->enable_lightbox == 'true') : true;

    $s->display_title_on_thumbnail = isset($s->display_title_on_thumbnail) ? ($s->display_title_on_thumbnail == 'yes' || $s->display_title_on_thumbnail == 'true') : true;

    $s->display_taxonomy_on_thumbnail = isset($s->display_taxonomy_on_thumbnail) ? ($s->display_taxonomy_on_thumbnail == 'yes' || $s->display_taxonomy_on_thumbnail == 'true') : true;

    $s->image_size = isset($s->image_size) ? $s->image_size : 'medium';

    $s->crop = isset($s->crop) ? $s->crop : '';

    $s->display_title = isset($s->display_title) ? ($s->display_title == 'yes' || $s->display_title == 'true') : true;

    $s->display_summary = isset($s->display_summary) ? ($s->display_summary == 'yes' || $s->display_summary == 'true') : true;

    $s->rich_text_excerpt = isset($s->rich_text_excerpt) ? ($s->rich_text_excerpt == 'yes' || $s->rich_text_excerpt == 'true') : false;

    $s->display_excerpt_lightbox = isset($s->display_excerpt_lightbox) ? ($s->display_excerpt_lightbox == 'yes' || $s->display_excerpt_lightbox == 'true') : true;

    $s->display_author = isset($s->display_author) ? ($s->display_author == 'yes' || $s->display_author == 'true') : true;

    $s->display_post_date = isset($s->display_post_date) ? ($s->display_post_date == 'yes' || $s->display_post_date == 'true') : true;

    $s->display_comments = isset($s->display_comments) ? ($s->display_comments == 'yes' || $s->display_comments == 'true') : false;

    $s->display_read_more = isset($s->display_read_more) ? ($s->display_read_more == 'yes' || $s->display_read_more == 'true') : false;

    $s->display_taxonomy = isset($s->display_taxonomy) ? ($s->display_taxonomy == 'yes' || $s->display_taxonomy == 'true') : true;

    $s->thumbnail_info_title_tag = isset($s->thumbnail_info_title_tag) ? $s->thumbnail_info_title_tag : 'h3';

    return $s;
}

function labb_process_block_query($settings, $paged = '') {

    $settings->offset = null; // ignore offsets for paged query for now

    $settings->paged = empty($paged) ? 1 : $paged;

    $query = FLBuilderLoop::query($settings);

    return $query;
}