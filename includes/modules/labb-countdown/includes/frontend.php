<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<div class="labb-countdown-wrap labb-align<?php echo $settings->align; ?>">
    <div class="labb-countdown-label"><?php echo $settings->label; ?></div>
    <div class="labb-countdown" data-end-date="<?php echo $settings->end_date; ?>"></div>
</div>