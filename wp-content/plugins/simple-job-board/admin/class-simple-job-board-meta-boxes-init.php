<?php
/**
 * Simple_Job_Board_Meta_Boxes_Init class
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/admin
 * @since       2.2.3
 */
if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * This is used to define all job board meta boxes.
 *
 * This metabox is designed the meta boxes for job feature, job application and job data.
 *
 * @since      2.2.3
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/admin
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Meta_Boxes_Init {

    /**
     * Initialize the class and set its properties.
     *
     * @since   2.2.3
     */
    public function __construct() {

        /**
         * The class responsible for defining job data meta box options under custom post type in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/meta-boxes/class-simple-job-board-meta-box-job-data.php';
          
        /**
         * The class responsible for defining job features meta box options under custom post type in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/meta-boxes/class-simple-job-board-meta-box-job-features.php';

        /**
         * The class responsible for defining job application meta box options under custom post type in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/meta-boxes/class-simple-job-board-meta-box-job-application.php';

        // Action -> Load WP Media Uploader Scripts.
        add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));

        // Action -> Post Type -> Jobpost -> Add Meta Boxes. 
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));

        // Action -> Post Type -> Jobpost -> Save Meta Boxes.
        add_action('save_post_jobpost', array($this, 'save_meta_boxes'), 10, 1);

        // Action -> Post Type -> Jobpost -> Save Job Features Meta Box.
        add_action('sjb_save_jobpost_meta', array('Simple_Job_Board_Meta_Box_Job_Features', 'sjb_save_jobpost_meta'), 10);

        // Action -> Post Type -> Jobpost -> Save Job Application Meta Box.
        add_action('sjb_save_jobpost_meta', array('Simple_Job_Board_Meta_Box_Job_Application', 'sjb_save_jobpost_meta'), 20);

        // Action -> Post Type -> Jobpost -> Save Job Data Meta Box.
        add_action('sjb_save_jobpost_meta', array('Simple_Job_Board_Meta_Box_Job_Data', 'sjb_save_jobpost_meta'), 30);
    }

    /**
     * Load backend scripts
     * 
     * @since   2.1.0
     */
    function admin_script_loader() {
        global $pagenow;

        if (is_admin() && ( in_array($pagenow, array('post-new.php', 'post.php'))) ) {
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');            
        }
    }

    /**
     * Add jobpost meta boxes.
     *
     * @since 2.1.0
     */
    public function add_meta_boxes() {
        global $wp_post_types;
        add_meta_box('jobpost_metas', sprintf(__('%s Features', 'simple-job-board'), $wp_post_types['jobpost']->labels->singular_name), array('Simple_Job_Board_Meta_Box_Job_Features', 'sjb_meta_box_output'), 'jobpost', 'normal', 'high');
        add_meta_box('jobpost_application_fields', __('Application Form Fields', 'simple-job-board'), array('Simple_Job_Board_Meta_Box_Job_Application', 'sjb_meta_box_output'), 'jobpost', 'normal', 'high');
        add_meta_box('simple-job-board-post_options', __('Job Data', 'simple-job-board'), array('Simple_Job_Board_Meta_box_Job_Data', 'sjb_meta_box_output'), 'jobpost', 'normal');
    }

    /**
     * Save meta boxes.
     *
     * @since 2.1.0
     */
    public function save_meta_boxes($post_id) {
        /**
         * We need to verify this came from our screen and with proper authorization,
         * because the save_post action can be triggered at other times.
         */
        // Check if our nonce is set.
        if (!isset($_POST['jobpost_meta_box_nonce'])) {
            return;
        }

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($_POST['jobpost_meta_box_nonce'], 'sjb_jobpost_meta_box')) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check the user's permissions.
        if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }

        /**
         * @hooked sjb_save_jobpost_meta - 10
         * @hooked sjb_save_jobpost_meta - 20
         * @hooked sjb_save_jobpost_meta - 30
         * 
         * Save jobpost meta box:
         * 
         * - Save job features meta box.
         * - Save job application meta box.
         * - Save job data meta box. 
         * 
         * @since   2.2.3
         * 
         * @param   int    $post_id    Post Id
         */
        do_action('sjb_save_jobpost_meta', $post_id);
    }

}

new Simple_Job_Board_Meta_Boxes_Init;