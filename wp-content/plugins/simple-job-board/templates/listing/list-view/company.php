<?php
/**
 * The template for displaying company name in list view
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/list-view/company.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing/list-view
 * @version     1.0.0
 * @since       2.2.3
 */

// Company Name
if (sjb_get_the_company_name()) {
    ?>
    | <?php
    sjb_the_company_name();
}