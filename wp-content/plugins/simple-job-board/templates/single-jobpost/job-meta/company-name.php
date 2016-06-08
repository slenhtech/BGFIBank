<?php
/**
 * The template for displaying company name
 *
 * Override this template by copying it to yourtheme/simple_job_board/single-jobpost/job-meta/company-name.php
 * 
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/single-jobpost/job-meta
 * @version     1.0.0
 * @since       2.2.3
 */

// Company Name -> Linked with Company Website
if (sjb_get_the_company_name()) {
    if ($website = sjb_get_the_company_website()):
        ?>
        |  <a class="website" href="<?php echo esc_url($website); ?>" target="_blank" rel="nofollow"><?php sjb_the_company_name(); ?></a>
        <?php
    else:
        echo ' | ';
        sjb_the_company_name();
    endif;
}