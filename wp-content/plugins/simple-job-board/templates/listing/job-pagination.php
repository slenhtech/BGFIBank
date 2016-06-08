<?php
/**
 * Pagination - Show numbered pagination for jobs
 *
 * @author 	PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing
 * @version     1.0.0
 * @since       2.2.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $job_query, $wp_rewrite;

/**
 * Job listing pagination
 * 
 * Show pagiantion after displaying fifteen jobs
 */
$job_query->query_vars['paged'] > 1 ? $current = $job_query->query_vars['paged'] : $current = 1;

// Pagination Arguments
$pagination_args = array(
    'base'      => @add_query_arg('page', '%#%'),
    'format'    => '',
    'total'     => $job_query->max_num_pages,
    'current'   => $current,
    'show_all'  => TRUE,
    'next_text' => 'Next',
    'prev_text' => 'Previous',
    'type'      => 'list',
);
$pagination = apply_filters('sjb_pagination_links_default_args', $pagination_args);

/**
 * Modify query string.
 *  
 * Remove query "page" argument from permalink
 */
if (!( isset($_GET['selected_category']) || isset($_GET['selected_jobtype']) || isset($_GET['selected_location']) || isset($_GET['search_keywords']))) {
    if ($wp_rewrite->using_permalinks())
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('page', get_pagenum_link(1))) . '?page=%#%/', 'paged');

    if (!empty($job_query->query_vars['s']))
        $pagination['add_args'] = array('s' => get_query_var('s'));
} 

// Retrieve paginated link for job posts
echo paginate_links($pagination);