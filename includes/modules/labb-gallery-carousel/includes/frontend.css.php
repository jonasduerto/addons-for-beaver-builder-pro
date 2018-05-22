.fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item {
    padding: <?php echo $settings->gutter; ?>px;
    }
@media screen and (max-width: <?php echo $settings->tablet_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item {
        padding: <?php echo $settings->tablet_gutter; ?>px;
        }
    }
@media screen and (max-width: <?php echo $settings->mobile_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item {
        padding: <?php echo $settings->mobile_gutter; ?>px;
        }
    }
.fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item .labb-project-image .labb-image-info .labb-entry-title {
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
.fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item .labb-project-image .labb-image-info .labb-entry-title a {
<?php
    if( !empty( $settings->title_color ) ) {
        echo 'color: #'. $settings->title_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item .labb-project-image .labb-image-info .labb-entry-title a:hover {
<?php
    if( !empty( $settings->title_hover_border_color ) ) {
        echo 'border-color: #'. $settings->title_hover_border_color .';';
    }
?>
    }
.fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item .labb-project-image .labb-image-info .labb-terms {
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
<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
    .fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item .labb-project-image .labb-image-info .labb-entry-title {
    <?php
        if( !empty( $settings->title_font_size_medium ) ) {
            echo 'font-size: '. $settings->title_font_size_medium .'px;';
        }
        if( !empty( $settings->title_line_height_medium ) ) {
            echo 'line-height: '. $settings->title_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item .labb-project-image .labb-image-info .labb-terms {
    <?php
        if( !empty( $settings->tags_font_size_medium ) ) {
            echo 'font-size: '. $settings->tags_font_size_medium .'px;';
        }
        if( !empty( $settings->tags_line_height_medium ) ) {
            echo 'line-height: '. $settings->tags_line_height_medium .'px;';
        }
    ?>
        }
    }
@media ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item .labb-project-image .labb-image-info .labb-entry-title {
    <?php
        if( !empty( $settings->title_font_size_responsive ) ) {
            echo 'font-size: '. $settings->title_font_size_responsive .'px;';
        }
        if( !empty( $settings->title_line_height_responsive ) ) {
            echo 'line-height: '. $settings->title_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-gallery-carousel .labb-gallery-carousel-item .labb-project-image .labb-image-info .labb-terms {
    <?php
        if( !empty( $settings->tags_font_size_responsive ) ) {
            echo 'font-size: '. $settings->tags_font_size_responsive .'px;';
        }
        if( !empty( $settings->tags_line_height_responsive ) ) {
            echo 'line-height: '. $settings->tags_line_height_responsive .'px;';
        }
    ?>
        }
    }
<?php endif; ?>