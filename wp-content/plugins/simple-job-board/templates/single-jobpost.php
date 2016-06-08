<?php
/**
 * The Template for displaying job details
 *
 * Override this template by copying it to yourtheme/simple_job_board/single-jobpost.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/Templates
 * @version     1.1.0
 * @since       2.2.0
 * @since       2.2.3   Enqueued Front Styles & Revised the HTML structure.
 */
global $post;
get_header();

/**
 * Enqueue Frontend Styles.
 * 
 * @since   2.2.3
 */
do_action('sjb_enqueue_styles');

/**
 * Hook -> sjb_before_main_content
 * 
 * @hooked sjb_job_listing_wrapper_start - 10 
 * - Output Opening div of Main Container.
 * - Output Opening div of Content Area.
 * 
 * @since   2.2.0
 * @since   2.2.3   Removed the content wrapper opening div.
 */
do_action('sjb_before_main_content');
?>

<!-- Start Content Wrapper
================================================== -->
<div class="sjb-wrap">            

    <!-- Start Job Title
    ================================================== -->
    <section id="sjb-page-detail">
        <h2 id="job-title"><?php echo apply_filters('sjb_single_job_detail_page_title', get_the_title()); ?></h2>                 
    </section>
    <!-- ==================================================
    End Job Title -->

    <?php
    while (have_posts()) : the_post();
        /**
         * Template -> Content Single Job Listing:
         * 
         * - Company Meta
         * - Job Description 
         * - Job Features
         * - Job Application Form
         */
        get_simple_job_board_template('content-single-job-listing.php');
    endwhile;
    ?>
</div>
<!-- ==================================================
End Content Wrapper -->

<?php
/**
 * Hook -> sjb_after_main_content
 *  
 * @hokoed sjb_job_listing_wrapper_end - 10
 * 
 * - Output Closing div of Main Container.
 * - Output Closing div of Content Area.
 * 
 * @since   2.2.0
 * @since   2.2.3   Removed the content wrapper closing div
 */
do_action('sjb_after_main_content');

get_footer();