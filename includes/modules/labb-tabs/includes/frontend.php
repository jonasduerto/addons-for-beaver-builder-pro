<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

$plain_styles = array('style2', 'style6', 'style7');

$vertical_class = '';

$vertical_styles = array('style7', 'style8', 'style9', 'style10');

if (in_array($settings->style, $vertical_styles, true)):

    $vertical_class = 'labb-vertical';

endif;

foreach ($settings->tabs as $tab) :

    if (!is_object($tab))
        continue;

    if (in_array($settings->style, $plain_styles, true)):

        $icon_type = 'none'; // do not display icons for plain styles even if chosen by the user

    else :

        $icon_type = $tab->icon_type;

    endif;

    if (empty($tab->tab_id))
        $tab_id = sanitize_title_with_dashes($tab->tab_title);
    else
        $tab_id = $tab->tab_id;

    $tab_element = '<a class="labb-tab-label" href="#' . $tab_id . '">';

    if ($icon_type == 'icon_image') :

        $tab_element .= '<span class="labb-image-wrapper">';

        $icon_image = $tab->icon_image;

        $tab_element .= wp_get_attachment_image($icon_image, 'thumbnail', false, array('class' => 'labb-image'));

        $tab_element .= '</span>';

    elseif ($icon_type == 'icon') :

        $tab_element .= '<span class="labb-icon-wrapper">';

        $tab_element .= '<span class="' . esc_attr($tab->font_icon) . '"></span>';

        $tab_element .= '</span>';

    endif;

    $tab_element .= '<span class="labb-tab-title">';

    $tab_element .= esc_html($tab->tab_title);

    $tab_element .= '</span>';

    $tab_element .= '</a>';

    $tab_nav = '<div class="labb-tab">' . $tab_element . '</div>';

    $tab_content = '<div id="' . $tab_id . '" class="labb-tab-pane">' . do_shortcode($tab->tab_content) . '</div>';

    $tab_elements[] = $tab_nav;

    $tab_panes[] = $tab_content;

endforeach;

if (empty($tab_panes) || empty($tab_elements))
    return;

?>

<div class="labb-tabs <?php echo $vertical_class; ?> <?php echo esc_attr($settings->style); ?>"
     data-mobile-width="<?php echo intval($settings->mobile_width); ?>">

    <a href="#" class="labb-tab-mobile-menu"><i class="labb-icon-menu"></i>&nbsp;</a>

    <div class="labb-tab-nav">

        <?php

        foreach ($tab_elements as $tab_nav) :

            echo $tab_nav;

        endforeach;

        ?>

    </div>

    <div class="labb-tab-panes">

        <?php

        foreach ($tab_panes as $tab_pane) :

            echo $tab_pane;

        endforeach;

        ?>

    </div>

</div>