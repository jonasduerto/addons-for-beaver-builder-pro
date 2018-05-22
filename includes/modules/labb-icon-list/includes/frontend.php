<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

list($animate_class, $animation_attr) = labb_get_animation_atts($settings->icon_animation); ?>

<div class="labb-icon-list labb-align<?php echo $settings->align; ?>">

    <?php foreach ($settings->icon_list as $icon_item): ?>

        <?php if (!is_object($icon_item))
            continue; ?>

        <?php $icon_type = esc_html($icon_item->icon_type); ?>

        <?php $icon_title = esc_html($icon_item->icon_title); ?>

        <?php $icon_url = isset($icon_item->icon_link) ? $icon_item->icon_link : null; ?>

        <div class="labb-icon-list-item<?php echo $animate_class; ?>" <?php echo $animation_attr; ?>
             title="<?php echo $icon_title; ?>">

            <?php if (($icon_type == 'icon_image') && !empty($icon_item->icon_image)) : ?>

                <?php if (empty($icon_url)) : ?>

                    <div class="labb-image-wrapper">

                        <?php echo wp_get_attachment_image($icon_item->icon_image, 'full', false, array('class' => 'labb-image full', 'alt' => $icon_title)); ?>

                    </div>

                <?php else : ?>

                    <a class="labb-image-wrapper"
                       href="<?php echo $icon_url; ?>" <?php ($settings->new_window == 'yes') ? 'target="_blank"' : '' ?>>

                        <?php echo wp_get_attachment_image($icon_item->icon_image, 'full', false, array('class' => 'labb-image full', 'alt' => $icon_title)); ?>

                    </a>

                <?php endif; ?>

            <?php else : ?>

                <?php if (empty($icon_url)) : ?>

                    <div class="labb-icon-wrapper">

                        <span class="<?php echo esc_attr($icon_item->font_icon); ?>"></span>

                    </div>

                <?php else : ?>

                    <a class="labb-icon-wrapper"
                       href="<?php echo $icon_url; ?>" <?php ($settings->new_window == 'yes') ? 'target="_blank"' : '' ?>>

                        <span class="<?php echo esc_attr($icon_item->font_icon); ?>"></span>

                    </a>

                <?php endif; ?>

            <?php endif; ?>

        </div>

        <?php

    endforeach;

    ?>

</div>