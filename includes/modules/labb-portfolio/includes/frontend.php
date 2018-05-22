<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */
$module::$grid_counter++;

$settings->block_class = !empty($settings->grid_class) ? sanitize_title($settings->grid_class) : 'grid-' . $module::$grid_counter;

$settings = labb_parse_block_settings($settings);

// Remove the offset if we are going for pagination - unit we support it
if ($settings->pagination !== 'none')
    $settings->offset = null;

$block = LABB_Blocks_Manager::get_instance($settings->block_type);

echo $block->render($settings);