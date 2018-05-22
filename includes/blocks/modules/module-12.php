<?php

class LABB_Module_12 extends LABB_Module {

    function render() {
        ob_start();
        ?>

        <article
                class="labb-module-12 <?php echo $this->get_module_classes(); ?> <?php echo join(' ', get_post_class('', $this->post_ID)); ?>">

            <?php if ($thumbnail_exists = has_post_thumbnail($this->post_ID)): ?>

                <div class="labb-module-image">

                    <div class="labb-module-thumb">

                        <?php echo $this->get_media(); ?>

                        <?php echo $this->get_lightbox(); ?>

                    </div>

                    <div class="labb-module-image-info">

                        <div class="labb-module-entry-info">

                            <?php echo $this->get_title(); ?>

                            <?php echo $this->get_taxonomies_info(); ?>

                        </div>

                    </div>

                </div>

            <?php endif; ?>

        </article><!-- .hentry -->

        <?php return ob_get_clean();
    }
}