<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

list($animate_class, $animation_attr) = labb_get_animation_atts($settings->button_animation);

$icon_html = $type = '';

$class = (!empty($settings->button_class)) ? ' ' . $settings->button_class : '';

$color_class = ' labb-' . esc_attr($settings->button_color);
if (!empty($settings->button_type))
    $type = ' labb-' . esc_attr($settings->button_type);

$rounded = ($settings->rounded == 'yes') ? ' labb-rounded' : '';

$target = $settings->button_target ? 'target="_blank"' : '';

if (!empty($settings->button_href)) {
    $link = $settings->button_href;
}
else {
    $link = '#';
}

$style = ($settings->button_style) ? ' style="' . esc_attr($settings->button_style) . '"' : '';

if ($settings->icon_type == 'icon_image') {
    if (!empty($settings->icon_image))
        $icon_html = wp_get_attachment_image($settings->icon_image, 'thumbnail', false, array('class' => 'labb-image labb-thumbnail'));
}
elseif ($settings->icon_type == 'icon') {
    $icon_html = '<span class="' . esc_attr($settings->font_icon) . '"></span>';
}

$button_content = '<a class= "labb-button ' . ((!empty($icon_html)) ? ' labb-with-icon' : '') . esc_attr($class) . $color_class . $type . $rounded . $animate_class . '"' . $style . $animation_attr . ' href="' . esc_url($link) . '"' . esc_html($target) . '>' . $icon_html . esc_html($settings->button_title) . '</a>';

if ($settings->button_align != 'none')
    $button_content = '<div class="labb-button-wrap" style="clear: both; text-align:' . esc_attr($settings->button_align) . ';">' . $button_content . '</div>';

echo $button_content;

?>