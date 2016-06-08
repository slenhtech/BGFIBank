<?php
/**
 * Template for displays the company logo
 *
 * Override this template by copying it to yourtheme/simple_job_board/single-jobpost/job-meta/company-logo.php
 * 
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/single-jobpost/job-meta
 * @version     1.0.0
 * @since       2.2.3
 */
?>

<!-- Start Company Logo 
================================================== -->
<div class="sjb-company-logo">
    <?php
    if ($website = sjb_get_the_company_website()):
        ?>
        <a class="website" href="<?php echo esc_url($website); ?>"  target="_blank" rel="nofollow"><?php sjb_the_company_logo(); ?></a>
        <?php
    else:
        sjb_the_company_logo();
    endif;
    ?>
</div>
<!-- ==================================================
End Company Logo  -->