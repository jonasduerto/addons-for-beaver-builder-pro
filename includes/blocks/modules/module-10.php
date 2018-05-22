<?php

class LABB_Module_10 extends LABB_Module {

    function render() {
        ob_start();
        ?>

        <div class="labb-module-10 labb-small-thumb <?php echo $this->get_module_classes(); ?>">

            <div class="labb-entry-details">

                <?php echo $this->get_taxonomies_info(); ?>

                <?php echo $this->get_title(); ?>

                <div class="labb-module-meta">
                    <?php echo $this->get_author(); ?>
                    <?php echo $this->get_date(); ?>
                    <?php echo $this->get_comments(); ?>
                    <?php echo $this->get_taxonomies_info(); ?>
                </div>

            </div>

            <?php echo $this->get_thumbnail(); ?>

            <div class="labb-excerpt">
                <?php echo $this->get_excerpt(); ?>
            </div>

            <div class="labb-read-more">
                <a href="<?php the_permalink($this->post_ID); ?>"><?php echo esc_html__('Read more', 'livemesh-bb-addons'); ?></a>
            </div>

        </div>

        <?php return ob_get_clean();
    }
}