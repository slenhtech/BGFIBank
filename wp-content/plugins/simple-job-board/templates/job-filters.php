<?php
/**
 * Show filters for jobs
 *
 * @author 	PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/Templates
 * @version     1.0.0
 * @since       2.1.0
 * @since       2.2.0   Added @hooks for dropdowns & column classes.
 * @since       2.2.3   Added more @hooks for dropdowns & broke filter's template structure.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Get Shortcode Attributes 
$atts = empty( $atts ) ? '' : $atts;
        
/**
 * Fires before filters on job listing page.
 * 
 * @since    2.1.0
 */
do_action('simple_job_board_job_filters_before', $atts);
?>

<!-- Start Job Filters
================================================== -->
<article id="sjb-contain-bg" <?php post_class('sjb-job-filters'); ?>>
    <div class="sjb-row">
        <div class="sjb-form-inline">
            <?php
            /**
             * Job Filters Form 
             * 
             * - Keywords Search.
             * - Job Category Filter.
             * - Job Type Filter.
             * - Job Location Filter.
             * 
             * Search jobs by category, job location, job type and keywords.
             */
            ?>
            <form class="sjb-job-filters-form" action="<?php echo apply_filters('sjb_job_filters_form_action', ''); ?>" method="<?php echo apply_filters('sjb_job_filters_form_method', 'get'); ?>">
                <?php
                /**
                 * Fires before keyword search on job listing page.
                 * 
                 * @since   2.1.0
                 */
                do_action('simple_job_board_job_filters_start', $atts);

                /**
                 * Template -> Keyword Search:
                 * 
                 * - Keyword Search.
                 */
                get_simple_job_board_template('search/keyword-search.php', array ('atts' => $atts));

                /**
                 * Fires before category dropdown on job listing page
                 * 
                 * @since   2.2.0
                 */
                do_action('simple_job_board_job_filters_dropdowns_start', $atts);

                /**
                 * Template -> Category Filter:
                 * 
                 * - Display Category Filter Dropdown.
                 */
                get_simple_job_board_template('search/category-filter.php', array ('atts' => $atts));

                /**
                 * Fires after "Category" dropdown on job listing page
                 * 
                 * @since   2.2.3
                 */
                do_action('sjb_category_filter_dropdown_after', $atts);

                /**
                 * Template -> Type Filter:
                 * 
                 * - Display Job Type Filter Dropdown.
                 */
                get_simple_job_board_template('search/type-filter.php', array ('atts' => $atts));

                /**
                 * Fires after "Job Type" dropdown on job listing page
                 * 
                 * @since   2.2.3
                 */
                do_action('sjb_job_type_filter_dropdown_after', $atts);

                /**
                 * Template -> Location Filter:
                 * 
                 * - Display Job Location Filter Dropdown.
                 */
                get_simple_job_board_template('search/location-filter.php', array ('atts' => $atts));

                /**
                 * Fires after job location dropdown on job listing page.
                 * 
                 * @since   2.2.0
                 */
                do_action('simple_job_board_job_filters_dropdowns_end', $atts);

                /**
                 * Template -> Search Button:
                 * 
                 * - Display Search Button.
                 */
                get_simple_job_board_template('search/search-btn.php');
                ?>
            </form>
        </div>
    </div>
</article>
<!-- ==================================================
End Job Filters -->

<?php
/**
 * Fires after job filters on job listing page.
 * 
 * @since   2.1.0
 */
do_action('simple_job_board_job_filters_after', $atts);