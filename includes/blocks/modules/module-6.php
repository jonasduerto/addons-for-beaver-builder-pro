<?php

class LABB_Module_6 extends LABB_Module {

    function render() {
        ob_start();
        ?>

        <div class="labb-module-6 labb-small-thumb <?php echo $this->get_module_classes(); ?>">

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

            </div>

        </div>

        <?php return ob_get_clean();
    }
}