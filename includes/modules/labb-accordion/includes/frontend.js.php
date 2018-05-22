<?php

// set defaults
$toggle = ($settings->toggle == 'yes') ? 'true' : 'false';
$expanded = ($settings->expanded == 'yes') ? 'true' : 'false';

?>

(function ($) {

    $(function () {

        new LABBAccordion({
            id: '<?php echo $id ?>',
            toggle: <?php echo $toggle ?>,
            expanded: <?php echo $expanded ?>,
        });
    });

})(jQuery);
