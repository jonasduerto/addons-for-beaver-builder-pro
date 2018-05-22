<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<div class="labb-accordion <?php echo $settings->style; ?>"
     data-toggle="<?php echo($settings->toggle == 'yes' ? "true" : "false"); ?>"
     data-expanded="<?php echo($settings->expanded == 'yes' ? "true" : "false"); ?>">

    <?php foreach ($settings->accordion as $panel) : ?>

        <?php if (!is_object($panel))
            continue; ?>

        <?php

        if (empty($panel->panel_id))
            $panel_id = sanitize_title_with_dashes($panel->panel_title);
        else
            $panel_id = $panel->panel_id;

        ?>

        <div class="labb-panel" id="<?php echo $panel_id; ?>">

            <<?php echo $settings->title_tag; ?> class="labb-panel-title"><?php echo esc_html($panel->panel_title); ?></<?php echo $settings->title_tag; ?>>

            <div class="labb-panel-content"><?php echo do_shortcode($panel->panel_content); ?></div>

        </div>

        <?php

    endforeach;

    ?>

</div>