<?php
/**
 * Displayed when no jobs are found matching the current query
 *
 * Override this template by copying it to yourtheme/simple_job_board/listing/content-no-jobs-found.php
 *
 * @author 	PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/listing
 * @version     1.0.0
 * @since       2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

echo '<div class="no-job-listing">' .__( 'No jobs found.' , 'simple-job-board' ).'</div>';