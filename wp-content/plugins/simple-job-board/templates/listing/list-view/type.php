<?php
/**
 * The template for displaying job type in list view
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/list-view/type.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/list-view
 * @version     1.0.0
 * @since       2.2.3
 */
?>

<!-- Start Job Type
================================================== -->
<div class="sjb-col-md-2">
    <?php if ($job_type = sjb_get_the_job_type()) {
        ?>
        <div id="sjb_job-bolits">
            <i class="fa fa-clock-o"></i><?php sjb_the_job_type(); ?>
        </div>
    <?php } ?> 
</div>
<!-- ==================================================
End Job Type -->