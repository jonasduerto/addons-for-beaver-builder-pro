<?php

class LABB_Module_5 extends LABB_Module {

    function render() {
        ob_start();
        ?>

        <article
                class="labb-module-5 <?php echo $this->get_module_classes(); ?> <?php echo join(' ', get_post_class('', $this->post_ID)); ?>">

            <div class="labb-entry-details">

                <?php echo $this->get_title(); ?>

                <div class="labb-module-meta">
                    <?php echo $this->get_author(); ?>
                    <?php echo $this->get_date(); ?>
                    <?php echo $this->get_comments(); ?>
                    <?php echo $this->get_taxonomies_info(); ?>
                </div>

                <div class="labb-excerpt">
                    <?php echo $this->get_excerpt(); ?>
                </div>

            </div>

        </article>

        <?php return ob_get_clean();
    }
}