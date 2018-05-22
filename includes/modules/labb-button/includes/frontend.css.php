<?php

/**
 * @var $module
 * @var $settings
 * @var $id
 */

$options = get_option('labb_settings');

if ($options && isset($options['labb_theme_color']))
    $theme_color = $options['labb_theme_color'];
else
    $theme_color = '#f94213'; // default button color if none set in theme options

if ($options && isset($options['labb_theme_hover_color']))
    $theme_hover_color = $options['labb_theme_hover_color'];
else
    $theme_hover_color = '#d03912'; // default button hover color if none set in theme options

$custom_color = '';
$hover_color = '';

if ($settings->button_color == 'default') {
    $custom_color = $theme_color;
    $hover_color = $theme_hover_color;
}

?>

<?php if (!empty($custom_color)): ?>
.fl-node-<?php echo $id; ?> .labb-button {
    background-color: <?php echo $custom_color; ?>;
    }
<?php endif; ?>

<?php if (!empty($hover_color)): ?>
.fl-node-<?php echo $id; ?> .labb-button:hover {
    background-color: <?php echo $hover_color; ?>;
    }
<?php endif; ?>


.fl-node-<?php echo $id; ?> .labb-button {
<?php
    if( !empty( $settings->button_top_bottom_padding ) ) {
        echo 'padding-top: '. $settings->button_top_bottom_padding .'px;';
        echo 'padding-bottom: '. $settings->button_top_bottom_padding .'px;';
    }
    if( !empty( $settings->button_left_right_padding ) ) {
        echo 'padding-left: '. $settings->button_left_right_padding .'px;';
        echo 'padding-right: '. $settings->button_left_right_padding .'px;';
    }
    if( !empty( $settings->button_custom_color ) ) {
        echo 'background-color: #'. $settings->button_custom_color .';';
    }
    if( !empty( $settings->button_border_radius ) ) {
        echo 'border-radius: '. $settings->button_border_radius .'px;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-button:hover {
<?php
    if( !empty( $settings->button_custom_hover_color ) ) {
        echo 'background-color: #'. $settings->button_custom_hover_color .';';
    }
?>
    }

.fl-node-<?php echo $id; ?> .labb-button {
<?php
    if( $settings->button_label_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->button_label_font );
    }
    if( !empty( $settings->button_label_font_size ) ) {
        echo 'font-size: '. $settings->button_label_font_size .'px;';
    }
    if( !empty( $settings->button_label_line_height ) ) {
        echo 'line-height: '. $settings->button_label_line_height .'px;';
    }

    if( !empty( $settings->button_label_color ) ) {
        echo 'color: #'. $settings->button_label_color .';';
    }
?>
    }

<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
    
    .fl-node-<?php echo $id; ?> .labb-button {
    <?php
        if( !empty( $settings->button_label_font_size_medium ) ) {
            echo 'font-size: '. $settings->button_label_font_size_medium .'px;';
        }
        if( !empty( $settings->button_label_line_height_medium ) ) {
            echo 'line-height: '. $settings->button_label_line_height_medium .'px;';
        }
    ?>
        }

    }
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
    
    .fl-node-<?php echo $id; ?> .labb-button {
    <?php
        if( !empty( $settings->button_label_font_size_responsive ) ) {
            echo 'font-size: '. $settings->button_label_font_size_responsive .'px;';
        }
        if( !empty( $settings->button_label_line_height_responsive ) ) {
            echo 'line-height: '. $settings->button_label_line_height_responsive .'px;';
        }
    ?>
        }

    }
<?php endif; ?>

.fl-node-<?php echo $id; ?> a.labb-button.labb-with-icon span {
<?php
    if( !empty( $settings->icon_color ) ) {
        echo 'color: #'. $settings->icon_color .';';
    }
    if( !empty( $settings->icon_size ) ) {
        echo 'font-size: '. $settings->icon_size .'px;';
    }
    if( !empty( $settings->icon_spacing ) ) {
        echo 'margin-right: '. $settings->icon_spacing .'px;';
    }
?>
    }
.fl-node-<?php echo $id; ?> a.labb-button.labb-with-icon:hover span {
<?php
    if( !empty( $settings->icon_hover_color ) ) {
        echo 'color: #'. $settings->icon_hover_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> a.labb-button.labb-with-icon img.labb-thumbnail {
<?php
    if( !empty( $settings->icon_size ) ) {
        echo 'max-width: '. $settings->icon_size .'px;';
    }
    if( !empty( $settings->icon_spacing ) ) {
        echo 'margin-right: '. $settings->icon_spacing .'px;';
    }
?>
    }
