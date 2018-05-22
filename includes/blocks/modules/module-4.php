<?php

class LABB_Module_4 extends LABB_Module {

    function render() {
        ob_start();
        ?>

        <div class="labb-module-4 labb-small-thumb <?php echo $this->get_module_classes(); ?>">

            <?php echo $this->get_thumbnail('medium'); ?>

            <div class="labb-entry-details">

                <?php echo $this->get_title(); ?>

                <div class="labb-module-meta">
                    <?php echo $this->get_date(); ?>
                </div>

            </div>

        </div>

        <?php return ob_get_clean();
    }
}