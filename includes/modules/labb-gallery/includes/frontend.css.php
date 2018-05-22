.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-load-more  {
    background: <?php echo $module->get_theme_color(); ?>;
    }

.fl-node-<?php echo $id; ?> .labb-gallery {
    margin-left: -<?php echo $settings->gutter; ?>px;
    margin-right: -<?php echo $settings->gutter; ?>px;
    }
@media screen and (max-width: <?php echo $settings->tablet_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-gallery {
        margin-left: -<?php echo $settings->tablet_gutter; ?>px;
        margin-right: -<?php echo $settings->tablet_gutter; ?>px;
        }
    }
@media screen and (max-width: <?php echo $settings->mobile_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-gallery {
        margin-left: -<?php echo $settings->mobile_gutter; ?>px;
        margin-right: -<?php echo $settings->mobile_gutter; ?>px;
        }
    }

.fl-node-<?php echo $id; ?> .labb-gallery .labb-gallery-item {
    padding: <?php echo $settings->gutter; ?>px;
    }
@media screen and (max-width: <?php echo $settings->tablet_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-gallery .labb-gallery-item {
        padding: <?php echo $settings->tablet_gutter; ?>px;
        }
    }
@media screen and (max-width: <?php echo $settings->mobile_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-gallery .labb-gallery-item {
        padding: <?php echo $settings->mobile_gutter; ?>px;
        }
    }

.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-heading {
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
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-taxonomy-filter .labb-filter-item a {
<?php
    if( $settings->filter_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->filter_font );
    }
    if( !empty( $settings->filter_font_size ) ) {
        echo 'font-size: '. $settings->filter_font_size .'px;';
    }
    if( !empty( $settings->filter_line_height ) ) {
        echo 'line-height: '. $settings->filter_line_height .'px;';
    }
    if( !empty( $settings->filter_color ) ) {
        echo 'color: #'. $settings->filter_color .';';
    }
    if ( $settings->filter_text_transform != 'none') {
        echo 'text-transform: '. $settings->filter_text_transform .';';
    }
    if ( $settings->filter_font_style != 'none' ) {
        echo 'font-style: '. $settings->filter_font_style .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-taxonomy-filter .labb-filter-item a:hover {
<?php
    if( !empty( $settings->filter_hover_color ) ) {
        echo 'color: #'. $settings->filter_hover_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-taxonomy-filter .labb-filter-item.labb-active::after {
<?php
    if( !empty( $settings->filter_active_border ) ) {
        echo 'border-color: #'. $settings->filter_active_border .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image:hover img {
<?php
    if( !empty( $settings->thumbnail_hover_brightness ) ) {
        echo '-webkit-filter: brightness('. ($settings->thumbnail_hover_brightness) .'%); filter: brightness('. ($settings->thumbnail_hover_brightness) .'%);';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-entry-title {
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
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-entry-title, .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-entry-title a {
<?php
    if( !empty( $settings->title_color ) ) {
        echo 'color: #'. $settings->title_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-entry-title a:hover {
<?php
    if( !empty( $settings->title_hover_border_color ) ) {
        echo 'border-color: #'. $settings->title_hover_border_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-terms {
<?php
    if( $settings->tags_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->tags_font );
    }
    if( !empty( $settings->tags_font_size ) ) {
        echo 'font-size: '. $settings->tags_font_size .'px;';
    }
    if( !empty( $settings->tags_line_height ) ) {
        echo 'line-height: '. $settings->tags_line_height .'px;';
    }
    if( !empty( $settings->tags_color ) ) {
        echo 'color: #'. $settings->tags_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-terms:hover {
<?php
    if( !empty( $settings->tags_hover_color ) ) {
        echo 'color: #'. $settings->tags_hover_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav {
<?php
    if( $settings->pagination_text_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->pagination_text_font );
    }
    if( !empty( $settings->pagination_text_font_size ) ) {
        echo 'font-size: '. $settings->pagination_text_font_size .'px;';
    }
    if( !empty( $settings->pagination_text_line_height ) ) {
        echo 'line-height: '. $settings->pagination_text_line_height .'px;';
    }

    if( !empty( $settings->pagination_text_color ) ) {
        echo 'color: #'. $settings->pagination_text_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav, .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav:first-child {
<?php
    if( !empty( $settings->pagination_border_color ) ) {
        echo 'border-color: #'. $settings->pagination_border_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav:hover, .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav.labb-current-page {
<?php
    if( !empty( $settings->pagination_hover_bg_color ) ) {
        echo 'background-color: #'. $settings->pagination_hover_bg_color .';';
    }
    if( !empty( $settings->pagination_hover_text_color ) ) {
        echo 'color: #'. $settings->pagination_hover_text_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav i {
<?php
    if( !empty( $settings->pagination_nav_icon_color ) ) {
        echo 'color: #'. $settings->pagination_nav_icon_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav:hover i {
<?php
    if( !empty( $settings->pagination_hover_nav_icon_color ) ) {
        echo 'color: #'. $settings->pagination_hover_nav_icon_color .';';

    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav.labb-disabled i {
<?php
    if( !empty( $settings->pagination_disabled_nav_icon_color ) ) {
        echo 'color: #'. $settings->pagination_disabled_nav_icon_color .';';
    }
?>
    }
<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-heading {
    <?php
        if( !empty( $settings->heading_font_size_medium ) ) {
            echo 'font-size: '. $settings->heading_font_size_medium .'px;';
        }
        if( !empty( $settings->heading_line_height_medium ) ) {
            echo 'line-height: '. $settings->heading_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-taxonomy-filter .labb-filter-item a {
    <?php
        if( !empty( $settings->filter_font_size_medium ) ) {
            echo 'font-size: '. $settings->filter_font_size_medium .'px;';
        }
        if( !empty( $settings->filter_line_height_medium ) ) {
            echo 'line-height: '. $settings->filter_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-entry-title {
    <?php
        if( !empty( $settings->title_font_size_medium ) ) {
            echo 'font-size: '. $settings->title_font_size_medium .'px;';
        }
        if( !empty( $settings->title_line_height_medium ) ) {
            echo 'line-height: '. $settings->title_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-terms {
    <?php
        if( !empty( $settings->tags_font_size_medium ) ) {
            echo 'font-size: '. $settings->tags_font_size_medium .'px;';
        }
        if( !empty( $settings->tags_line_height_medium ) ) {
            echo 'line-height: '. $settings->tags_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav {
    <?php
        if( !empty( $settings->pagination_text_font_size_medium ) ) {
            echo 'font-size: '. $settings->pagination_text_font_size_medium .'px;';
        }
        if( !empty( $settings->pagination_text_line_height_medium ) ) {
            echo 'line-height: '. $settings->pagination_text_line_height_medium .'px;';
        }
    ?>
        }

    }
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-heading {
    <?php
        if( !empty( $settings->heading_font_size_responsive ) ) {
            echo 'font-size: '. $settings->heading_font_size_responsive .'px;';
        }
        if( !empty( $settings->heading_line_height_responsive ) ) {
            echo 'line-height: '. $settings->heading_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-taxonomy-filter .labb-filter-item a {
    <?php
        if( !empty( $settings->filter_font_size_responsive ) ) {
            echo 'font-size: '. $settings->filter_font_size_responsive .'px;';
        }
        if( !empty( $settings->filter_line_height_responsive ) ) {
            echo 'line-height: '. $settings->filter_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-entry-title {
    <?php
        if( !empty( $settings->title_font_size_responsive ) ) {
            echo 'font-size: '. $settings->title_font_size_responsive .'px;';
        }
        if( !empty( $settings->title_line_height_responsive ) ) {
            echo 'line-height: '. $settings->title_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-gallery .labb-gallery-item .labb-project-image .labb-image-info .labb-terms {
    <?php
        if( !empty( $settings->tags_font_size_responsive ) ) {
            echo 'font-size: '. $settings->tags_font_size_responsive .'px;';
        }
        if( !empty( $settings->tags_line_height_responsive ) ) {
            echo 'line-height: '. $settings->tags_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-wrap .labb-pagination .labb-page-nav {
    <?php
        if( !empty( $settings->pagination_text_font_size_responsive ) ) {
            echo 'font-size: '. $settings->pagination_text_font_size_responsive .'px;';
        }
        if( !empty( $settings->pagination_text_line_height_responsive ) ) {
            echo 'line-height: '. $settings->pagination_text_line_height_responsive .'px;';
        }
    ?>
        }

    }
<?php endif; ?>