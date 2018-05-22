<?php

/*
Widget Name: Livemesh Countdown
Description: Display a countdown timer for an end date.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBCountdownModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Countdown', 'livemesh-bb-addons'),
            'description' => __('Display a countdown timer for an end date.', 'livemesh-bb-addons'),
            'group' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-countdown/',
            'url' => LABB_ADDONS_URL . 'labb-countdown/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_js('jquery-countdown');

    }

}

FLBuilder::register_module('LABBCountdownModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'countdown_label' => array(
                                'type' => 'text',
                                'label' => __('Countdown Label', 'livemesh-bb-addons'),
                                'description' => __('The label for the countdown.', 'livemesh-bb-addons'),
                                'connections' => array('string', 'html'),
                            ),

                            'end_date' => array(
                                'type' => 'time',
                                'label' => __('End date', 'livemesh-bb-addons'),
                                'description' => __('The end date for the countdown.', 'livemesh-bb-addons'),
                            ),

                            'align' => array(
                                'type' => 'select',
                                'label' => __('Alignment', 'livemesh-bb-addons'),
                                'default' => 'left',
                                'options' => array(
                                    'left' => __('Left', 'livemesh-bb-addons'),
                                    'right' => __('Right', 'livemesh-bb-addons'),
                                    'center' => __('Center', 'livemesh-bb-addons'),
                                )
                            ),
                        )
                ),
            )
        )
    )
);