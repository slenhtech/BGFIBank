<?php
/**
 * The template for displaying job logo in grid view
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/grid-view/logo.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/grid-view/
 * @version     1.0.0
 * @since       2.2.3
 */
?>

<!-- Start Jobs Logo
================================================== -->
<div id="sjb_company-logo" class="company-logo">
    <a href="<?php the_permalink(); ?>">
        <?php sjb_the_company_logo(); ?>
    </a>
</div>
<!-- ==================================================
End Jobs Logo-->