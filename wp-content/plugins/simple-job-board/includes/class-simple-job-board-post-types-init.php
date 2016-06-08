<?php
/**
 * Custom Post Types Initialization
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/includes
 * @since       2.2.3
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Define custom post types.
 *
 * Includes all files of the custom post types for simple job board.
 * 
 * @since      2.2.3
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/includes
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Post_Types_Init
{
    /**
     * Initialize the class and set its properties.
     *
     * @since   2.2.3
     */
    public function __construct()
    {
        //Jobpost Custom Post Type 
        require_once plugin_dir_path ( __FILE__ ) . 'posttypes/class-simple-job-board-post-type-jobpost.php';
        
        // Check if Jobpost Class Exists
        if (class_exists ( 'Simple_Job_Board_Post_Type_Jobpost' )) {
            
            // Initialize Jobpost Object
            new Simple_Job_Board_Post_Type_Jobpost ();
        }
        
        // Applicants Custom Post Type
        require_once plugin_dir_path ( __FILE__ ) . 'posttypes/class-simple-job-board-post-type-applicants.php';
        
        // Check if Applicants Class Exists
        if (class_exists ( 'Simple_Job_Board_Post_Type_Applicants' )) {
            
            // Initialize Applicant Object
            new Simple_Job_Board_Post_Type_Applicants ();
        }
    }
       
}

new Simple_Job_Board_Post_Types_Init();