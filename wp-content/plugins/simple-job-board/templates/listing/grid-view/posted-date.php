<?php
/**
 * The template for displaying job post date in grid view
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/grid-view/posted-date.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/grid-view/
 * @version     1.0.0
 * @since       2.2.3
 */
?>

<!-- Start Job's Post Date
================================================== -->
<div class="sjb-col-md-12">
    <?php if ($job_posting_time = sjb_get_the_job_posting_time()) {
        ?>
        <div id="sjb_job-bolits">
            <i class="fa fa-calendar"></i><?php sjb_the_job_posting_time(); ?>
        </div>
    <?php } ?>
</div>

<!-- ==================================================
End Job's Post Date -->
