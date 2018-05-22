<?php

class LABB_Block_8 extends LABB_Block {

    function inner($posts, $settings) {

        $output = '';

        $post_count = 1;

        $num_of_columns = 1;

        $block_layout = new LABB_Block_Layout();

        $column_class = $this->get_column_class(intval($num_of_columns));

        if (!empty($posts)) {

            foreach ($posts as $post) {

                    $output .= $block_layout->open_column($column_class);

                    $module6 = new LABB_Module_7($post, $settings);

                    $output .= $module6->render();

                    $post_count++;

            };

            $output .= $block_layout->close_all_tags();

        };

        return $output;

    }

    function get_block_class() {

        return 'labb-block-posts labb-block-8';

    }

    function get_grid_classes($settings) {

        $grid_classes = ' labb-grid-desktop-1 labb-grid-tablet-1 labb-grid-mobile-1';

        return $grid_classes;

    }
}