<?php
/**
 * The template for displaying company tagline
 *
 * Override this template by copying it to yourtheme/simple_job_board/single-jobpost/job-meta/company-tagline.php
 * 
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/single-jobpost/job-meta
 * @version     1.0.0
 * @since       2.2.3
 */
?>
<!-- Start Company Tagline 
================================================== -->
<?php if (sjb_get_the_company_tagline()): ?>
    <div class="sjb-row">
        <p class="sjb-company-tagline"><?php sjb_the_company_tagline(); ?></p>
    </div>
<?php endif; ?>
<!-- ==================================================
End Company Tagline  -->