<?php
/**
 * The template for displaying job title in grid view
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/grid-view/title.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/grid-view/
 * @version     1.0.0
 * @since       2.2.3
 */

// Company Name
if (sjb_get_the_company_name()) {
    ?>
    | <?php
    sjb_the_company_name();
}