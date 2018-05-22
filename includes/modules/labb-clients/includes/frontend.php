<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */


?>

<?php list($animate_class, $animation_attr) = labb_get_animation_atts($settings->client_animation); ?>

<div class="labb-clients labb-gapless-grid">

    <div class="labb-grid-container <?php echo labb_get_grid_classes($settings); ?> ">

        <?php foreach ($settings->clients as $client): ?>

            <?php if (!is_object($client))
                continue; ?>

            <div class="labb-grid-item labb-client <?php echo $animate_class; ?>" <?php echo $animation_attr; ?>>

                <?php if (!empty($client->client_image)): ?>

                    <?php echo wp_get_attachment_image($client->client_image, 'full', false, array('class' => 'labb-image full', 'alt' => $client->client_name)); ?>

                <?php endif; ?>

                <?php if (!empty($client->client_link)): ?>

                    <div class="labb-client-name">

                        <a href="<?php echo esc_url($client->client_link); ?>"
                           title="<?php echo esc_html($client->client_name); ?>"
                           target="_blank"><?php echo esc_html($client->client_name); ?></a>
                    </div>

                <?php else: ?>

                    <div class="labb-client-name"><?php echo esc_html($client->client_name); ?></div>

                <?php endif; ?>


                <div class="labb-image-overlay"></div>

            </div>

        <?php

        endforeach;

        ?>

    </div>

</div>