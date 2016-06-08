<?php
/**
 * The template for displaying job short description in list view
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/list-view/short-description.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/list-view
 * @version     1.0.0
 * @since       2.2.3
 */
?>

<!-- Start Job Short Description 
================================================== -->
<div class="sjb-row">
    <div class="sjb-lead job-description">
        <?php the_excerpt(); ?>
    </div>
</div>
<!-- ==================================================
End Job Short Description  -->