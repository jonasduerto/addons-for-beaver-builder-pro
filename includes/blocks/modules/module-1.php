<?php

class LABB_Module_1 extends LABB_Module {

    function render() {
        ob_start();
        ?>

        <article
                class="labb-module-1 <?php echo $this->get_module_classes(); ?> <?php echo join(' ', get_post_class('', $this->post_ID)); ?>">

            <div class="labb-module-image">
                <?php echo $this->get_thumbnail();?>
                <?php echo $this->get_taxonomies_info(); ?>
            </div>

            <?php echo $this->get_title();?>

            <div class="labb-module-meta">
                <?php echo $this->get_author();?>
                <?php echo $this->get_date();?>
                <?php echo $this->get_comments();?>
            </div>

            <div class="labb-excerpt">
                <?php echo $this->get_excerpt();?>
            </div>

        </article>

        <?php return ob_get_clean();
    }
}