<?php

class LABB_Block_Grid_3 extends LABB_Block {

    function inner($posts, $settings) {

        $output = '';

        $post_count = 1;

        $num_of_columns = $settings->per_line;

        $block_layout = new LABB_Block_Layout();

        $column_class = $this->get_column_class(intval($num_of_columns));

        if (!empty($posts)) {

            foreach ($posts as $post) {

                if ($num_of_columns == 1) {

                    $output .= $block_layout->open_column($column_class);

                    $module2 = new LABB_Module_1($post, $settings);

                    $output .= $module2->render();

                    $post_count++;

                }
                else {

                    $output .= $block_layout->open_column($column_class);

                    $module2 = new LABB_Module_1($post, $settings);

                    $output .= $module2->render();

                    $output .= $block_layout->close_column($column_class);

                    $post_count++;
                }

            };

            $output .= $block_layout->close_all_tags();

        };

        return $output;

    }

    function get_block_class() {

        return 'labb-block-grid labb-block-grid-3 labb-gapless-grid';

    }
}