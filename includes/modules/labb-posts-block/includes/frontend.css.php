.fl-node-<?php echo $id; ?> .labb-block .labb-load-more {
    background: <?php echo $module->get_theme_color(); ?>;
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-heading span, .fl-node-<?php echo $id; ?> .labb-block .labb-heading a {
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
.fl-node-<?php echo $id; ?> .labb-block .labb-taxonomy-filter .labb-filter-item a, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter .labb-block-filter-item a, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter .labb-block-filter-more span, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter ul.labb-block-filter-dropdown-list li a {
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
    if( $settings->filter_text_transform != 'none' ) {
        echo 'text-transform: '. $settings->filter_text_transform .';';
    }
    if ( $settings->filter_font_style != 'none' ) {
        echo 'font-style: '. $settings->filter_font_style .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-taxonomy-filter .labb-filter-item a:hover, .fl-node-<?php echo $id; ?> .labb-block-grid .labb-taxonomy-filter .labb-filter-item.labb-active a, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter .labb-block-filter-item a:hover, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter .labb-block-filter-item.labb-active a {
<?php
    if( !empty( $settings->filter_hover_color ) ) {
        echo 'color: #'. $settings->filter_hover_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-module .labb-module-image .labb-terms a {
<?php
    if( $settings->entry_terms_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->entry_terms_font );
    }
    if( !empty( $settings->entry_terms_font_size ) ) {
        echo 'font-size: '. $settings->entry_terms_font_size .'px;';
    }
    if( !empty( $settings->entry_terms_line_height ) ) {
        echo 'line-height: '. $settings->entry_terms_line_height .'px;';
    }
    if( !empty( $settings->entry_terms_color ) ) {
        echo 'color: #'. $settings->entry_terms_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-module .labb-module-image .labb-terms {
<?php
    if( !empty( $settings->entry_terms_bg_color ) ) {
        echo 'background-color: #'. $settings->entry_terms_bg_color .';';
    }
?>
    }

<?php if( ($settings->entry_title_font['family'] != 'Default') || !empty( $settings->entry_title_font_size ) || !empty( $settings->entry_title_line_height ) || !empty( $settings->entry_title_color )  || ($settings->entry_title_text_transform != 'none')) :  ?>

.fl-node-<?php echo $id; ?> .labb-block .labb-module .entry-title a {
<?php
    if( $settings->entry_title_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->entry_title_font );
    }
    if( !empty( $settings->entry_title_font_size ) ) {
        echo 'font-size: '. $settings->entry_title_font_size .'px;';
    }
    if( !empty( $settings->entry_title_line_height ) ) {
        echo 'line-height: '. $settings->entry_title_line_height .'px;';
    }
    if( !empty( $settings->entry_title_color ) ) {
        echo 'color: #'. $settings->entry_title_color .';';
    }
    if( $settings->entry_title_text_transform != 'none' ) {
        echo 'text-transform: '. $settings->entry_title_text_transform .';';
    }
?>
    }
<?php endif; ?>

.fl-node-<?php echo $id; ?> .labb-block .labb-module .entry-title a {
<?php
    if( !empty( $settings->entry_title_color ) ) {
        echo 'color: #'. $settings->entry_title_color .';';
    }
?>
    }

.fl-node-<?php echo $id; ?> .labb-block .labb-module .entry-title a:hover {
<?php
    if( !empty( $settings->entry_title_hover_color ) ) {
        echo 'color: #'. $settings->entry_title_hover_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-module .entry-summary {
<?php
    if( $settings->entry_summary_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->entry_summary_font );
    }
    if( !empty( $settings->entry_summary_font_size ) ) {
        echo 'font-size: '. $settings->entry_summary_font_size .'px;';
    }
    if( !empty( $settings->entry_summary_line_height ) ) {
        echo 'line-height: '. $settings->entry_summary_line_height .'px;';
    }
    if( !empty( $settings->entry_summary_color ) ) {
        echo 'color: #'. $settings->entry_summary_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span, .fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span a {
<?php
    if( $settings->entry_meta_font['family'] != 'Default') {
        FLBuilderFonts::font_css( $settings->entry_meta_font );
    }
    if( !empty( $settings->entry_meta_font_size ) ) {
        echo 'font-size: '. $settings->entry_meta_font_size .'px;';
    }
    if( !empty( $settings->entry_meta_line_height ) ) {
        echo 'line-height: '. $settings->entry_meta_line_height .'px;';
    }
    if( !empty( $settings->entry_meta_color ) ) {
        echo 'color: #'. $settings->entry_meta_color .';';
    }
?>
    }

.fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span {
<?php
    if( !empty( $settings->entry_meta_color ) ) {
        echo 'color: #'. $settings->entry_meta_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span a {
<?php
    if( !empty( $settings->entry_meta_link_color ) ) {
        echo 'color: #'. $settings->entry_meta_link_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span a:hover {
<?php
    if( !empty( $settings->entry_meta_link_hover_color ) ) {
        echo 'color: #'. $settings->entry_meta_link_hover_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav {
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
.fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav, .fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav:first-child {
<?php
    if( !empty( $settings->pagination_border_color ) ) {
        echo 'border-color: #'. $settings->pagination_border_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav:hover, .fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav.labb-current-page {
<?php
    if( !empty( $settings->pagination_hover_bg_color ) ) {
        echo 'background-color: #'. $settings->pagination_hover_bg_color .';';
    }
    if( !empty( $settings->pagination_hover_text_color ) ) {
        echo 'color: #'. $settings->pagination_hover_text_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav i {
<?php
    if( !empty( $settings->pagination_nav_icon_color ) ) {
        echo 'color: #'. $settings->pagination_nav_icon_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav:hover i {
<?php
    if( !empty( $settings->pagination_hover_nav_icon_color ) ) {
        echo 'color: #'. $settings->pagination_hover_nav_icon_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav.labb-disabled i {
<?php
    if( !empty( $settings->pagination_disabled_nav_icon_color ) ) {
        echo 'color: #'. $settings->pagination_disabled_nav_icon_color .';';
    }
?>
    }
<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-block .labb-heading span, .fl-node-<?php echo $id; ?> .labb-block .labb-heading a {
    <?php
        if( !empty( $settings->heading_font_size_medium ) ) {
            echo 'font-size: '. $settings->heading_font_size_medium .'px;';
        }
        if( !empty( $settings->heading_line_height_medium ) ) {
            echo 'line-height: '. $settings->heading_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter .labb-block-filter-item a, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter .labb-block-filter-more span, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter ul.labb-block-filter-dropdown-list li a {
    <?php
        if( !empty( $settings->filter_font_size_medium ) ) {
            echo 'font-size: '. $settings->filter_font_size_medium .'px;';
        }
        if( !empty( $settings->filter_line_height_medium ) ) {
            echo 'line-height: '. $settings->filter_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-module .labb-module-image .labb-terms a {
    <?php
        if( !empty( $settings->entry_terms_font_size_medium ) ) {
            echo 'font-size: '. $settings->entry_terms_font_size_medium .'px;';
        }
        if( !empty( $settings->entry_terms_line_height_medium ) ) {
            echo 'line-height: '. $settings->entry_terms_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-module .entry-title a {
    <?php
        if( !empty( $settings->entry_title_font_size_medium ) ) {
            echo 'font-size: '. $settings->entry_title_font_size_medium .'px;';
        }
        if( !empty( $settings->entry_title_line_height_medium ) ) {
            echo 'line-height: '. $settings->entry_title_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-module .entry-summary {
    <?php
        if( !empty( $settings->entry_summary_font_size_medium ) ) {
            echo 'font-size: '. $settings->entry_summary_font_size_medium .'px;';
        }
        if( !empty( $settings->entry_summary_line_height_medium ) ) {
            echo 'line-height: '. $settings->entry_summary_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span {
    <?php
        if( !empty( $settings->entry_meta_font_size_medium ) ) {
            echo 'font-size: '. $settings->entry_meta_font_size_medium .'px;';
        }
        if( !empty( $settings->entry_meta_line_height_medium ) ) {
            echo 'line-height: '. $settings->entry_meta_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span a {
    <?php
        if( !empty( $settings->entry_meta_link_font_size_medium ) ) {
            echo 'font-size: '. $settings->entry_meta_link_font_size_medium .'px;';
        }
        if( !empty( $settings->entry_meta_link_line_height_medium ) ) {
            echo 'line-height: '. $settings->entry_meta_link_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav {
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

    .fl-node-<?php echo $id; ?> .labb-block .labb-heading span, .fl-node-<?php echo $id; ?> .labb-block .labb-heading a {
    <?php
        if( !empty( $settings->heading_font_size_responsive ) ) {
            echo 'font-size: '. $settings->heading_font_size_responsive .'px;';
        }
        if( !empty( $settings->heading_line_height_responsive ) ) {
            echo 'line-height: '. $settings->heading_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter .labb-block-filter-item a, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter .labb-block-filter-more span, .fl-node-<?php echo $id; ?> .labb-block .labb-block-filter ul.labb-block-filter-dropdown-list li a {
    <?php
        if( !empty( $settings->filter_font_size_responsive ) ) {
            echo 'font-size: '. $settings->filter_font_size_responsive .'px;';
        }
        if( !empty( $settings->filter_line_height_responsive ) ) {
            echo 'line-height: '. $settings->filter_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-module .labb-module-image .labb-terms a {
    <?php
        if( !empty( $settings->entry_terms_font_size_responsive ) ) {
            echo 'font-size: '. $settings->entry_terms_font_size_responsive .'px;';
        }
        if( !empty( $settings->entry_terms_line_height_responsive ) ) {
            echo 'line-height: '. $settings->entry_terms_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-module .entry-title a {
    <?php
        if( !empty( $settings->entry_title_font_size_responsive ) ) {
            echo 'font-size: '. $settings->entry_title_font_size_responsive .'px;';
        }
        if( !empty( $settings->entry_title_line_height_responsive ) ) {
            echo 'line-height: '. $settings->entry_title_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-module .entry-summary {
    <?php
        if( !empty( $settings->entry_summary_font_size_responsive ) ) {
            echo 'font-size: '. $settings->entry_summary_font_size_responsive .'px;';
        }
        if( !empty( $settings->entry_summary_line_height_responsive ) ) {
            echo 'line-height: '. $settings->entry_summary_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span {
    <?php
        if( !empty( $settings->entry_meta_font_size_responsive ) ) {
            echo 'font-size: '. $settings->entry_meta_font_size_responsive .'px;';
        }
        if( !empty( $settings->entry_meta_line_height_responsive ) ) {
            echo 'line-height: '. $settings->entry_meta_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-module .labb-module-meta span a {
    <?php
        if( !empty( $settings->entry_meta_link_font_size_responsive ) ) {
            echo 'font-size: '. $settings->entry_meta_link_font_size_responsive .'px;';
        }
        if( !empty( $settings->entry_meta_link_line_height_responsive ) ) {
            echo 'line-height: '. $settings->entry_meta_link_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-block .labb-pagination .labb-page-nav {
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