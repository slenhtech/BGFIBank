<?php
/**
 * The template for displaying job location
 *
 * Override this template by copying it to yourtheme/simple_job_board/single-jobpost/job-meta/job-location.php
 * 
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/single-jobpost/job-meta
 * @version     1.0.0
 * @since       2.2.3
 */
?>
<!-- Start Job Location
================================================== -->
<div class="sjb-col-md-2">
    <?php if ($job_location = sjb_get_the_job_location()) {
        ?>
        <div id="sjb_job-bolits">
            <i class="fa fa-location-arrow"></i><?php sjb_the_job_location(); ?>
        </div>
    <?php } ?> 
</div>
<!-- ==================================================
End Job Location -->