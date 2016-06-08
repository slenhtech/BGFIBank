<?php
/**
 * Template for displaying searh button
 *
 * Override this template by copying it to yourtheme/simple_job_board/search/search-btn.php
 *
 * @author 	PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/templates/search
 * @version     1.0.0
 * @since       2.2.3
 */

// Search Button 
$search_button = '<div class="sjb-search-button ' . apply_filters('sjb_filters_button_class', 'sjb-col-md-2') . '" id="sjb-form-padding">'
        . '<input type="submit" class="sjb-search" value=""/>'
        . '</div>';
echo apply_filters('sjb_job_filters_search_button', $search_button);