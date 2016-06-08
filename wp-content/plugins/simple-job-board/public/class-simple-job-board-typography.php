<?php
/**
 * Simple_Job_Board_Typography class.
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/public
 * @since       2.2.3
 */

/**
 * Load user defined styles on front-end.
 *
 * This file is used to laod user defined styles in head section of job listing and detail page. 
 *
 * @since      2.2.3
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/public
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Typography {

    /**
     * Initialize the class and set its properties.
     *
     * @since   2.2.3
     */
    public function __construct() {

        // Hook -> Load user defined styles        
        add_action('wp_head', array($this, 'job_board_typography'));
    }

    /**
     * Load user defined styles. 
     * 
     * This function includes the user defined styles ( under Job Board> Settings> Appearance Tab )in head section of job listing and detail page.
     * 
     * @since    2.2.3
     */
    public function job_board_typography() {
        if (get_option('job_board_typography')) {
            $job_board_typography = get_option('job_board_typography');
        }

        /* Job Listing Page Typography */
        $filters_bg_color = isset($job_board_typography['filters_background_color']) ? $job_board_typography['filters_background_color'] : '#f2f2f2';
        $search_btn_bg_color = isset($job_board_typography['filters_button_background_color']) ? $job_board_typography['filters_button_background_color'] : '#164e91';
        $job_listing_title_color = isset($job_board_typography['job_listing_title_color']) ? $job_board_typography['job_listing_title_color'] : '#3b3a3c';
        $pagination_text_color = isset($job_board_typography['pagination_text_color']) ? $job_board_typography['pagination_text_color'] : '#fff';
        $pagination_bg_color = isset($job_board_typography['pagination_background_color']) ? $job_board_typography['pagination_background_color'] : '#164e91';
        $fontawesome_icon_color = isset($job_board_typography['fontawesome_icon_color']) ? $job_board_typography['fontawesome_icon_color'] : '#3b3a3c';
        $fontawesome_text_color = isset($job_board_typography['fontawesome_text_color']) ? $job_board_typography['fontawesome_text_color'] : '#164e91';

        /* Job Detail Page Typography */
        $job_title_color = isset($job_board_typography['job_title_color']) ? $job_board_typography['job_title_color'] : '#164e91';
        $heading_color = isset($job_board_typography['headings_color']) ? $job_board_typography['headings_color'] : '#164e91';
        $submit_btn_color = isset($job_board_typography['job_submit_button_text_color']) ? $job_board_typography['job_submit_button_text_color'] : '#fff';
        $submit_btn_bg_color = isset($job_board_typography['job_submit_button_background_color']) ? $job_board_typography['job_submit_button_background_color'] : '#164e91';
        
        global $post;
        if (!empty($post)):
            if ((is_single() and $post->post_type == 'jobpost') or is_post_type_archive('jobpost') or has_shortcode($post->post_content, 'jobpost') or 'jobpost' === $post->post_type): //Add scripts on plugin pages only.
                ?>

                <style type="text/css">

                    /* Job Filters Background Color */
                    .sjb-wrap #sjb-contain-bg {
                        background-color: <?php echo $filters_bg_color; ?> !important;
                    }

                    /* Job Filters-> Search Button Background Color */
                    .sjb-wrap .sjb-search{
                        background-color: <?php echo $search_btn_bg_color; ?> !important;
                    }

                    /* Pagination Text Color */
                    /* Pagination Background Color */
                    ul.page-numbers span.current , ul.page-numbers a:hover {
                        background: <?php echo $pagination_bg_color; ?> !important;
                        border-color: <?php echo $pagination_bg_color; ?> !important;
                        color: <?php echo $pagination_text_color; ?> !important;
                    }  

                    /* Fontawesome Icon Color */
                    .sjb-wrap #sjb_job-bolits i{
                        color: <?php echo $fontawesome_icon_color; ?> !important;
                    }

                    /* Fontawesome Text Color */
                    .sjb-wrap #sjb_job-bolits{
                        color: <?php echo $fontawesome_text_color; ?> !important;
                    }
                    /* Job Title Color */
                    .sjb-wrap #sjb_job-heading a {
                        color: <?php echo $job_listing_title_color; ?> !important;
                    }

                    /* Job Detial Page Title Color */
                    .sjb-wrap #job-title, #job-title {
                        color: <?php echo $job_title_color; ?> !important;
                    }

                    /* Job Detail Page Headings */
                    .sjb-wrap #sjb_job-detail-heading h3{
                        color: <?php echo $heading_color; ?> !important; 
                    }

                    /* Job Submit Button Text Color */
                    /* Job Submit Button Background Color */
                    .sjb-wrap #sjb-form-padding-button button{
                        background-color: <?php echo $submit_btn_bg_color; ?> !important;
                        color: <?php echo $submit_btn_color; ?> !important;
                    }
                </style>
                <?php
            endif;
        endif;
    }
    
}

new Simple_Job_Board_Typography();