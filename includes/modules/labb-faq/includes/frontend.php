<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */


?>

<div class="labb-faq-list labb-grid-container <?php echo labb_get_grid_classes($settings); ?>">

    <?php foreach ($settings->faq_list as $faq): ?>

        <?php if (!is_object($faq))
            continue; ?>

        <?php list($animate_class, $animation_attr) = labb_get_animation_atts($faq->faq_animation); ?>

        <div class="labb-grid-item labb-faq-item <?php echo $animate_class; ?>" <?php echo $animation_attr; ?>>

            <<?php echo $settings->title_tag; ?> class="labb-faq-question"><?php echo esc_html($faq->question) ?></<?php echo $settings->title_tag; ?>>

            <div class="labb-faq-answer"><?php echo do_shortcode($faq->answer) ?></div>

        </div>

        <?php

    endforeach;

    ?>

</div>