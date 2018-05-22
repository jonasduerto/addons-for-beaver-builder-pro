
.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .fl-photo:after {
<?php echo 'opacity: '. ($settings->thumbnail_overlay_opacity / 100) .';';?>
    }
.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide:hover .fl-photo:after {
<?php echo 'opacity: '. ($settings->thumbnail_hover_overlay_opacity / 100) .';'; ?>
    }

.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-button.labb-default {
    background: <?php echo $module->get_theme_color(); ?>;
    }
.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-button.labb-default:hover {
    filter: brightness(85%);
    }
.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-heading {
<?php
    if( $settings->heading_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->heading_font );
    }
    if( !empty( $settings->heading_font_size ) ) {
        echo 'font-size: '. $settings->heading_font_size .'px;';
    }
    if( !empty( $settings->heading_line_height ) ) {
        echo 'line-height: '. $settings->heading_line_height .'px;';
    }
    if( !empty( $settings->heading_color ) ) {
        echo 'color: #'. $settings->heading_color .';';
    }
    if( $settings->heading_text_transform != 'none' ) {
        echo 'text-transform: '. $settings->heading_text_transform .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-heading a {
<?php
    if( !empty( $settings->heading_color ) ) {
        echo 'color: #'. $settings->heading_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-heading a:hover {
<?php
    if( !empty( $settings->heading_hover_color ) ) {
        echo 'color: #'. $settings->heading_hover_color .';';
    }
    if( !empty( $settings->heading_hover_border_color ) ) {
        echo 'border-color: #'. $settings->heading_hover_border_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-subheading {
<?php
    if( $settings->subheading_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->subheading_font );
    }
    if( !empty( $settings->subheading_font_size ) ) {
        echo 'font-size: '. $settings->subheading_font_size .'px;';
    }
    if( !empty( $settings->subheading_line_height ) ) {
        echo 'line-height: '. $settings->subheading_line_height .'px;';
    }
    if( !empty( $settings->subheading_color ) ) {
        echo 'color: #'. $settings->subheading_color .';';
    }
    if ( $settings->subheading_text_transform != 'none') {
        echo 'text-transform: '. $settings->subheading_text_transform .';';
    }
    if( $settings->subheading_font_style != 'none' ) {
        echo 'font-style: '. $settings->subheading_font_style .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-button {
<?php
    if( $settings->button_text_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->button_text_font );
    }
    if( !empty( $settings->button_text_font_size ) ) {
        echo 'font-size: '. $settings->button_text_font_size .'px;';
    }
    if( !empty( $settings->button_text_line_height ) ) {
        echo 'line-height: '. $settings->button_text_line_height .'px;';
    }
    if( !empty( $settings->button_top_bottom_padding ) ) {
        echo 'padding-top: '. $settings->button_top_bottom_padding .'px;';
        echo 'padding-bottom: '. $settings->button_top_bottom_padding .'px;';
    }
    if( !empty( $settings->button_left_right_padding ) ) {
        echo 'padding-left: '. $settings->button_left_right_padding .'px;';
        echo 'padding-right: '. $settings->button_left_right_padding .'px;';
    }
    if( !empty( $settings->button_text_color ) ) {
        echo 'color: #'. $settings->button_text_color .';';
    }
?>
    }
<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-heading {
    <?php
        if( !empty( $settings->heading_font_size_medium ) ) {
            echo 'font-size: '. $settings->heading_font_size_medium .'px;';
        }
        if( !empty( $settings->heading_line_height_medium ) ) {
            echo 'line-height: '. $settings->heading_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-subheading {
    <?php
        if( !empty( $settings->subheading_font_size_medium ) ) {
            echo 'font-size: '. $settings->subheading_font_size_medium .'px;';
        }
        if( !empty( $settings->subheading_line_height_medium ) ) {
            echo 'line-height: '. $settings->subheading_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-button {
    <?php
        if( !empty( $settings->button_text_font_size_medium ) ) {
            echo 'font-size: '. $settings->button_text_font_size_medium .'px;';
        }
        if( !empty( $settings->button_text_line_height_medium ) ) {
            echo 'line-height: '. $settings->button_text_line_height_medium .'px;';
        }
    ?>
        }

    }
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-heading {
    <?php
        if( !empty( $settings->heading_font_size_responsive ) ) {
            echo 'font-size: '. $settings->heading_font_size_responsive .'px;';
        }
        if( !empty( $settings->heading_line_height_responsive ) ) {
            echo 'line-height: '. $settings->heading_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-subheading {
    <?php
        if( !empty( $settings->subheading_font_size_responsive ) ) {
            echo 'font-size: '. $settings->subheading_font_size_responsive .'px;';
        }
        if( !empty( $settings->subheading_line_height_responsive ) ) {
            echo 'line-height: '. $settings->subheading_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-image-slider .labb-slide .labb-caption .labb-button {
    <?php
        if( !empty( $settings->button_text_font_size_responsive ) ) {
            echo 'font-size: '. $settings->button_text_font_size_responsive .'px;';
        }
        if( !empty( $settings->button_text_line_height_responsive ) ) {
            echo 'line-height: '. $settings->button_text_line_height_responsive .'px;';
        }
    ?>
        }

    }
<?php endif; ?>