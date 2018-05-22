<?php

class LABB_Module_2 extends LABB_Module {

    function render() {
        ob_start();
        ?>

        <div class="labb-module-2 labb-small-thumb <?php echo $this->get_module_classes(); ?>">

            <div class="labb-entry-details">

                <?php echo $this->get_title(); ?>

                <div class="labb-module-meta">
                    <?php echo $this->get_author();?>
                    <?php echo $this->get_date();?>
                    <?php echo $this->get_comments();?>
                </div>

            </div>

        </div>

        <?php return ob_get_clean();
    }
}