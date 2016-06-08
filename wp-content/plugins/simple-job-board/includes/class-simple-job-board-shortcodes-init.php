<?php
/**
 * Simple_Job_Board_Shortcodes_Init class
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/includes
 * @since       2.2.3
 */
if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * This is used to define shortcods for job board.
 *
 * This class lists the jobs on frontend for [jobpost] shortcode.
 *
 * @since      2.2.3
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/includes
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Shortcodes_Init
{

    /**
     * Constructor
     */
    public function __construct() {

        /**
         * The class responsible for job listing shortcode functionality
         * of the plugin.
         */
        require_once plugin_dir_path(__FILE__) . 'shortcodes/class-simple-job-board-shortcode-jobpost.php';
        new Simple_Job_Board_Shortcode_Jobpost();
    }

}

new Simple_Job_Board_Shortcodes_Init();