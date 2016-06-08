<?php
/**
 * The template for displaying job short description in gird view.
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/grid-view/short-description.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/grid-view/
 * @version     1.0.0
 * @since       2.2.3
 */
?>

<!-- Start Job's Short Description 
================================================== -->
<div class="sjb-col-md-12">
    <div class="sjb-row">
        <div class="sjb-lead job-description">
            <?php the_excerpt(); ?>
        </div>
    </div>
</div>
<!-- ==================================================
End Job's Short Description  -->