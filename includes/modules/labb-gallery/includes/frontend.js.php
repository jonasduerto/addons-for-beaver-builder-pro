<?php


?>

(function ($) {

    $(function () {

        new LABBGallery({
            id: '<?php echo $id ?>',
            layoutMode: '<?php echo $settings->layout_mode; ?>'
        });
    });

})(jQuery);
