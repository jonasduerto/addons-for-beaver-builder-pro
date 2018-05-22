<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<?php $item_style = ''; ?>

<?php $container_style = 'labb-container'; ?>

<?php if ($settings->style == 'style1'): ?>

    <?php $item_style = 'labb-grid-item'; ?>

    <?php $container_style = 'labb-grid-container' . labb_get_grid_classes($settings); ?>

<?php endif; ?>

<div class="labb-team-members labb-<?php echo $settings->style; ?> <?php echo $container_style; ?>">

    <?php foreach ($settings->team_members as $team_member): ?>

        <?php if (!is_object($team_member))
            continue; ?>

        <div class="<?php echo $item_style; ?> labb-team-member-wrapper">

            <?php list($animate_class, $animation_attr) = labb_get_animation_atts($team_member->member_animation); ?>

            <div class="labb-team-member <?php echo $animate_class; ?>" <?php echo $animation_attr; ?>>

                <div class="labb-image-wrapper">

                    <?php $member_image = $team_member->member_image; ?>

                    <?php if (!empty($member_image)): ?>
                        
                        <?php

                        $size = isset($settings->image_size) ? $settings->image_size : 'medium';

                        $src = wp_get_attachment_image_src($member_image, $size);

                        $photo_data = FLBuilderPhoto::get_attachment_data($member_image);

                        // set params
                        $photo_settings = array(
                            'align' => 'center',
                            'link_type' => '',
                            'crop' => $settings->crop,
                            'photo' => $photo_data,
                            'photo_src' => $src[0],
                            'photo_source' => 'library',
                        );

                        // render image
                        FLBuilder::render_module_html('photo', $photo_settings);

                        ?>

                    <?php endif; ?>

                    <?php if ($settings->style == 'style1'): ?>

                        <?php $module->social_profile($team_member) ?>

                    <?php endif; ?>

                </div>

                <div class="labb-team-member-text">

                    <<?php echo $settings->title_tag; ?> class="labb-title"><?php echo esc_html($team_member->member_name) ?></<?php echo $settings->title_tag; ?>>

                    <div class="labb-team-member-position">

                        <?php echo do_shortcode($team_member->member_position) ?>

                    </div>

                    <div class="labb-team-member-details">

                        <?php echo do_shortcode($team_member->member_details) ?>

                    </div>

                    <?php if ($settings->style == 'style2'): ?>

                        <?php $module->social_profile($team_member) ?>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>