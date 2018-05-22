<?php $theme_color = $module->get_theme_color(); ?>

.fl-node-<?php echo $id; ?> .labb-tabs.style4 .labb-tab-nav .labb-tab.labb-active:before {
    background: <?php echo $theme_color; ?>;
    }
.fl-node-<?php echo $id; ?> .labb-tabs.style4.labb-mobile-layout.labb-mobile-open .labb-tab.labb-active {
    border-left-color: <?php echo $theme_color; ?>;
    border-right-color: <?php echo $theme_color; ?>;
    }
.fl-node-<?php echo $id; ?> .labb-tabs.style6 .labb-tab-nav .labb-tab.labb-active a,
.fl-node-<?php echo $id; ?> .labb-tabs.style7 .labb-tab-nav .labb-tab.labb-active a {
    border-color: <?php echo $theme_color; ?>;
    }
.fl-node-<?php echo $id; ?> .labb-tabs.style8 .labb-tab-nav .labb-tab.labb-active a {
    border-left-color: <?php echo $theme_color; ?>;
    }
.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab a {
<?php
    if( !empty( $settings->title_top_bottom_padding) ) {
        echo 'padding-top: '. $settings->title_top_bottom_padding .'px;';
        echo 'padding-bottom: '. $settings->title_top_bottom_padding .'px;';
    }
    if( !empty( $settings->title_left_right_padding) ) {
        echo 'padding-left: '. $settings->title_left_right_padding .'px;';
        echo 'padding-right: '. $settings->title_left_right_padding .'px;';
    }
?>
    }

.fl-node-<?php echo $id; ?> .labb-tabs.style6 .labb-tab-nav .labb-tab.labb-active a, .fl-node-<?php echo $id; ?> .labb-tabs.style7 .labb-tab-nav .labb-tab.labb-active a {
<?php
    if( !empty( $settings->highlight_color ) ) {
        echo 'border-color: #'. $settings->highlight_color .' !important;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs.style8 .labb-tab-nav .labb-tab.labb-active a {
<?php
    if( !empty( $settings->highlight_color ) ) {
        echo 'border-left-color: #'. $settings->highlight_color .' !important;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs.style4.labb-mobile-layout.labb-mobile-open .labb-tab.labb-active {
<?php
    if( !empty( $settings->highlight_color ) ) {
        echo 'border-left-color: #'. $settings->highlight_color .' !important;';
        echo 'border-right-color: #'. $settings->highlight_color .' !important;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs.style4 .labb-tab-nav .labb-tab.labb-active:before {
<?php
    if( !empty( $settings->highlight_color ) ) {
        echo 'background: #'. $settings->highlight_color .' !important;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab .labb-tab-title {
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
    if( $settings->title_text_transform != 'none') {
        echo 'text-transform: '. $settings->title_text_transform .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab.labb-active .labb-tab-title {
<?php
    if( !empty( $settings->title_active_color ) ) {
        echo 'color: #'. $settings->title_active_color .' !important;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab:hover .labb-tab-title {
<?php
    if( !empty( $settings->title_hover_color ) ) {
        echo 'color: #'. $settings->title_hover_color .' !important;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-panes .labb-tab-pane {
<?php
    if( $settings->content_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->content_font );
    }
    if( !empty( $settings->content_font_size ) ) {
        echo 'font-size: '. $settings->content_font_size .'px;';
    }
    if( !empty( $settings->content_line_height ) ) {
        echo 'line-height: '. $settings->content_line_height .'px;';
    }
    if( !empty( $settings->content_color ) ) {
        echo 'color: #'. $settings->content_color .';';
    }
    if( !empty( $settings->content_top_bottom_padding) ) {
        echo 'padding-top: '. $settings->content_top_bottom_padding .'px;';
        echo 'padding-bottom: '. $settings->content_top_bottom_padding .'px;';
    }
    if( !empty( $settings->content_left_right_padding) ) {
        echo 'padding-left: '. $settings->content_left_right_padding .'px;';
        echo 'padding-right: '. $settings->content_left_right_padding .'px;';
    }
?>
    }
<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab .labb-tab-title {
    <?php
        if( !empty( $settings->title_font_size_medium ) ) {
            echo 'font-size: '. $settings->title_font_size_medium .'px;';
        }
        if( !empty( $settings->title_line_height_medium ) ) {
            echo 'line-height: '. $settings->title_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-panes .labb-tab-pane {
    <?php
        if( !empty( $settings->content_font_size_medium ) ) {
            echo 'font-size: '. $settings->content_font_size_medium .'px;';
        }
        if( !empty( $settings->content_line_height_medium ) ) {
            echo 'line-height: '. $settings->content_line_height_medium .'px;';
        }
    ?>
        }

    }
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab .labb-tab-title {
    <?php
        if( !empty( $settings->title_font_size_responsive ) ) {
            echo 'font-size: '. $settings->title_font_size_responsive .'px;';
        }
        if( !empty( $settings->title_line_height_responsive ) ) {
            echo 'line-height: '. $settings->title_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-panes .labb-tab-pane {
    <?php
        if( !empty( $settings->content_font_size_responsive ) ) {
            echo 'font-size: '. $settings->content_font_size_responsive .'px;';
        }
        if( !empty( $settings->content_line_height_responsive ) ) {
            echo 'line-height: '. $settings->content_line_height_responsive .'px;';
        }
    ?>
        }

    }
<?php endif; ?>


.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab .labb-image-wrapper img {
<?php
    if( !empty( $settings->icon_size ) ) {
        echo 'max-width: '. $settings->icon_size .'px;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab .labb-icon-wrapper span {
<?php
    if( !empty( $settings->icon_color ) ) {
        echo 'color: #'. $settings->icon_color .';';
    }
    if( !empty( $settings->icon_size ) ) {
        echo 'font-size: '. $settings->icon_size .'px;';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab.labb-active .labb-icon-wrapper span {
<?php
    if( !empty( $settings->active_icon_color ) ) {
        echo 'color: #'. $settings->active_icon_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-tabs .labb-tab-nav .labb-tab .labb-icon-wrapper:hover span {
<?php
    if( !empty( $settings->hover_icon_color ) ) {
        echo 'color: #'. $settings->hover_icon_color .';';
    }
?>
    }
