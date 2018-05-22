.fl-node-<?php echo $id; ?> .labb-accordion .labb-panel .labb-panel-title {
<?php
    if( $settings->title_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->title_font );
    }
    if( !empty( $settings->title_font_size ) ) {
        echo 'font-size: '. $settings->title_font_size .'px;';
    }
    if( !empty( $settings->title_line_height ) ) {
        echo 'line-height: '. $settings->title_line_height .'px;';
    }
    if( !empty( $settings->title_color ) ) {
        echo 'color: #'. $settings->title_color .';';
    }
    if( $settings->title_text_transform != 'none' ) {
        echo 'text-transform: '. $settings->title_text_transform .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-accordion .labb-panel.labb-active .labb-panel-title {
<?php
    if( !empty( $settings->title_active_color ) ) {
        echo 'color: #'. $settings->title_active_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-accordion .labb-panel .labb-panel-content {
<?php
    if( $settings->text_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->text_font );
    }
    if( !empty( $settings->text_font_size ) ) {
        echo 'font-size: '. $settings->text_font_size .'px;';
    }
    if( !empty( $settings->text_line_height ) ) {
        echo 'line-height: '. $settings->text_line_height .'px;';
    }
    if( !empty( $settings->text_color ) ) {
        echo 'color: #'. $settings->text_color .';';
    }
?>
    }
<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-accordion .labb-panel .labb-panel-title {
    <?php
        if( !empty( $settings->title_font_size_medium ) ) {
            echo 'font-size: '. $settings->title_font_size_medium .'px;';
        }
        if( !empty( $settings->title_line_height_medium ) ) {
            echo 'line-height: '. $settings->title_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-accordion .labb-panel .labb-panel-content {
    <?php
        if( !empty( $settings->text_font_size_medium ) ) {
            echo 'font-size: '. $settings->text_font_size_medium .'px;';
        }
        if( !empty( $settings->text_line_height_medium ) ) {
            echo 'line-height: '. $settings->text_line_height_medium .'px;';
        }
    ?>
        }

    }
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-accordion .labb-panel .labb-panel-title {
    <?php
        if( !empty( $settings->title_font_size_responsive ) ) {
            echo 'font-size: '. $settings->title_font_size_responsive .'px;';
        }
        if( !empty( $settings->title_line_height_responsive ) ) {
            echo 'line-height: '. $settings->title_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-accordion .labb-panel .labb-panel-content {
    <?php
        if( !empty( $settings->text_font_size_responsive ) ) {
            echo 'font-size: '. $settings->text_font_size_responsive .'px;';
        }
        if( !empty( $settings->text_line_height_responsive ) ) {
            echo 'line-height: '. $settings->text_line_height_responsive .'px;';
        }
    ?>
        }

    }
<?php endif; ?>