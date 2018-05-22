<?php

class LABB_Module_8 extends LABB_Module {

    function render() {
        ob_start();
        ?>

        <div class="labb-module-8 labb-small-thumb <?php echo $this->get_module_classes(); ?>">

            <?php echo $this->get_thumbnail(); ?>

            <div class="labb-entry-details">

                <?php echo $this->get_title();?>

                <div class="labb-module-meta">
                    <?php echo $this->get_author();?>
                    <?php echo $this->get_date();?>
                    <?php echo $this->get_comments();?>
                </div>

                <div class="labb-excerpt">
                    <?php echo $this->get_excerpt();?>
                </div>

                <div class="labb-read-more">
                    <a class="labb-button" href="<?php the_permalink($this->post_ID);?>"><?php echo esc_html__('Read more', 'livemesh-bb-addons');?></a>
                </div>

            </div>

        </div>

        <?php return ob_get_clean();
    }
}