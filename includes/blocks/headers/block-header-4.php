<?php

class LABB_Block_Header_4 extends LABB_Block_Header {

    function get_block_taxonomy_filter() {

        $output = '';

        $block_filter_terms = $this->get_block_filter_terms();

        if (empty($block_filter_terms))
            return '';

        $output .= '<div class="labb-block-filter">';

        $output .= '<div class="labb-block-filter-dropdown">';

        $output .= '<div class="labb-block-filter-more"><span>' . __('All' , 'livemesh-bb-addons') . '</span><i class="labb-icon-arrow-right3"></i></div>';

        $output .= '<ul class="labb-block-filter-dropdown-list">';

        $output .= '<li class="labb-block-filter-item labb-active"><a class="labb-block-filter-link" data-term-id="" data-taxonomy="" href="#">' . esc_html__('All', 'livemesh-bb-addons') . '</a>';

        foreach ($block_filter_terms as $block_filter_term) {

            $output .= '<li class="labb-block-filter-item"><a class="labb-block-filter-link" data-term-id="' . $block_filter_term->term_id . '" data-taxonomy="' . $block_filter_term->taxonomy . '" href="#">' . $block_filter_term->name . '</a>';

        }

        $output .= '</ul>';

        $output .= '</div><!-- .labb-block-filter-dropdown -->';

        $output .= '</div><!-- .labb-block-filter -->';

        return $output;

    }

    function get_block_header_class() {

        return 'labb-block-header-4';

    }
}