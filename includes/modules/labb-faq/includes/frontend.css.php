.fl-node-<?php echo $id; ?> .labb-faq-list .labb-faq-item .labb-faq-question {
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
?>
    }
.fl-node-<?php echo $id; ?> .labb-faq-list .labb-faq-item .labb-faq-answer {
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
?>
    }
<?php if( $global_settings->responsive_enabled ) : // Global Setting If started ?>

@media ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {

    .fl-node-<?php echo $id; ?> .labb-faq-list .labb-faq-item .labb-faq-question {
    <?php
        if( !empty( $settings->title_font_size_medium ) ) {
            echo 'font-size: '. $settings->title_font_size_medium .'px;';
        }
        if( !empty( $settings->title_line_height_medium ) ) {
            echo 'line-height: '. $settings->title_line_height_medium .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-faq-list .labb-faq-item .labb-faq-answer {
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

    .fl-node-<?php echo $id; ?> .labb-faq-list .labb-faq-item .labb-faq-question {
    <?php
        if( !empty( $settings->title_font_size_responsive ) ) {
            echo 'font-size: '. $settings->title_font_size_responsive .'px;';
        }
        if( !empty( $settings->title_line_height_responsive ) ) {
            echo 'line-height: '. $settings->title_line_height_responsive .'px;';
        }
    ?>
        }
    .fl-node-<?php echo $id; ?> .labb-faq-list .labb-faq-item .labb-faq-answer {
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