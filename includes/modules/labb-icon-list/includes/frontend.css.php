.fl-node-<?php echo $id; ?> .labb-icon-list .labb-icon-list-item {
<?php
    if( !empty( $settings->icon_spacing ) ) {
        echo 'margin-right: '. $settings->icon_spacing .'px;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-icon-list .labb-icon-list-item .labb-image-wrapper img {
<?php
    if( !empty( $settings->icon_size ) ) {
        echo 'width: '. $settings->icon_size .'px;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-icon-list .labb-icon-list-item .labb-icon-wrapper span {
<?php
    if( !empty( $settings->icon_color ) ) {
        echo 'color: #'. $settings->icon_color .';';
    }
    if( !empty( $settings->icon_size ) ) {
        echo 'font-size: '. $settings->icon_size .'px;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-icon-list .labb-icon-list-item .labb-icon-wrapper span:hover {
<?php
    if( !empty( $settings->hover_color ) ) {
        echo 'color: #'. $settings->hover_color .';';
    }
?>
    }

#powerTip {
<?php
    if( $settings->tooltip_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->tooltip_font );
    }
    if( !empty( $settings->tooltip_font_size ) ) {
        echo 'font-size: '. $settings->tooltip_font_size .'px;';
    }
    if( !empty( $settings->tooltip_line_height ) ) {
        echo 'line-height: '. $settings->tooltip_line_height .'px;';
    }
    if( !empty( $settings->tooltip_color ) ) {
        echo 'color: #'. $settings->tooltip_color .' !important;';
    }
    if( !empty( $settings->tooltip_bg_color ) ) {
        echo 'background-color: #'. $settings->tooltip_bg_color .' !important;';
    }
    if( !empty( $settings->tooltip_padding ) ) {
        echo 'padding: '. $settings->tooltip_padding .'px !important;';
    }
?>
    }

#powerTip.n:before {
<?php
    if( !empty( $settings->tooltip_bg_color ) ) {
        echo 'border-top-color: #'. $settings->tooltip_bg_color .' !important;';
    }
?>
    }
<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

    #powerTip {
    <?php
        if( !empty( $settings->tooltip_font_size_medium ) ) {
            echo 'font-size: '. $settings->tooltip_font_size_medium .'px;';
        }
        if( !empty( $settings->tooltip_line_height_medium ) ) {
            echo 'line-height: '. $settings->tooltip_line_height_medium .'px;';
        }
    ?>
        }

    }
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

    #powerTip {
    <?php
        if( !empty( $settings->tooltip_font_size_responsive ) ) {
            echo 'font-size: '. $settings->tooltip_font_size_responsive .'px;';
        }
        if( !empty( $settings->tooltip_line_height_responsive ) ) {
            echo 'line-height: '. $settings->tooltip_line_height_responsive .'px;';
        }
    ?>
        }

    }
<?php endif; ?>