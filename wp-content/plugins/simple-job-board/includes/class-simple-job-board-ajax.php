<?php
/**
 * Simple_Job_Board_Ajax class
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/includes
 * @since       2.1.0
 */
if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * This is used to define ajax calls for job board.
 *
 * This file includes the ajax call for uploading resume validation and stores applicant data on job submit.
 *
 * @since      2.1.0
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/includes
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Ajax {
    
    /**
     * Base directory of uploaded resume.
     *
     * @since    2.2.3
     * @access   private
     * @var      Simple_Job_Board_Ajax    $upload_basedir   Store the base directory of uploaded resume.
     */
    private $upload_basedir;
    
    /**
     * Base url of uploaded resume.
     *
     * @since    2.2.3
     * @access   private
     * @var      Simple_Job_Board_Ajax    $upload_baseurl   Store the base url of uploaded resume.
     */
    private $upload_baseurl;
    
    /**
     * Directory of uploaded resume.
     *
     * @since    2.2.3
     * @access   private
     * @var      Simple_Job_Board_Ajax    $upload_file_dir  Store the path of uploaded resume.
     */
    private $upload_file_dir;
    
    /**
     * Path of uploaded resume.
     *
     * @since    2.2.3
     * @access   private
     * @var      Simple_Job_Board_Ajax    $upload_file_url  Store the url of uploaded resume.
     */
    private $upload_file_url;
    
    /**
     * Flag to indicate the error while uploading file
     *
     * @since    2.2.3
     * @access   private
     * @var      Simple_Job_Board_Ajax    $upload_file_error    Store error indicator during file upload.
     */
    private $upload_file_error_indicator;
    
    /**
     * Uploaded file error message 
     *
     * @since    2.2.3
     * @access   private
     * @var      Simple_Job_Board_Ajax    $upload_file_error    Store error message of file upload.
     */
    private $upload_file_error = array();
    
    /**
     * The name of uploaded file
     *
     * @since    2.2.3
     * @access   private
     * @var      Simple_Job_Board_Ajax    $upload_file_name Store the name of uploaded file.
     */
    private $upload_file_name;
    
    /**
     * Constructor
     */
    public function __construct() {
        
        $this->upload_file_error_indicator = 0;        
        $this->upload_file_url = '';
        
        // Hook - Entertain Applicant Request From Job Apply Form
        add_action('wp_ajax_nopriv_process_applicant_form', array($this, 'process_applicant_form'));
        add_action('wp_ajax_process_applicant_form', array($this, 'process_applicant_form'));

        // Hook - Uploaded Resume Validation
        add_action('sjb_uploaded_resume_validation', array($this, 'uploaded_resume_validation'));
    }

    /**
     * Entertain Applicant Request From Job Apply Form
     *
     * @access public
     * @return void
     */
    public function process_applicant_form() {
        $nonce = $_POST['wp_nonce'];
        
        if (!wp_verify_nonce($nonce, 'the_best_jobpost_security_nonce'))
            die('Not Working');
        
        /**
         * Fires on job submission 
         * 
         * @since 2.2.3
         */
        do_action('sjb_uploaded_resume_validation');

        if ( $this->upload_file_error_indicator == 1 ) {  
            $errors = '<div id="uploaded-file-error">';
            foreach ($this->upload_file_error as $error_value) {
                $errors .= esc_html__($error_value, 'simple-job-board');
            }

            $response = json_encode(apply_filters( 'sjb_job_submission_validation_error' , array('success' => FALSE, 'error' => $errors), $errors));
            header("Content-Type: application/json");
            echo apply_filters('sjb_job_submit_validation_errors', $response);
            die();
        }
        
        /**
         * Fires before inserting applicant's post.
         * 
         * @since 2.2.3
         */
        do_action('sjb_applicants_insert_post_before');

        $args = apply_filters('sjb_applicant_insert_post_args', array(
            'post_type'    => 'jobpost_applicants',
            'post_content' => '',
            'post_parent'  => $_POST['job_id'],
            'post_title'   => get_the_title($_POST['job_id']),
            'post_status'  => 'publish',
        ));
        $pid = wp_insert_post($args);
        
        /**
         * Fires before inserting applicant's post meta.
         * 
         * @since 2.2.3
         */
        do_action('sjb_applicants_insert_post_meta_start');

        if ( '' != $this->upload_file_url ) {
            $resume_name = $pid . '_' . $this->upload_file_name;
            $resume_url = $this->upload_baseurl . '/' . $resume_name;
            $resume_path = $this->upload_basedir . '/' . $resume_name;
            rename($this->upload_file_dir, $resume_path);

            /* Replace single backslash with double for DB storage */
            $resume_path = str_replace("\\", "\\\\", $resume_path);
            add_post_meta($pid, 'resume', $resume_url);
            add_post_meta($pid, 'resume_path', $resume_path);
        }
        
        foreach ($_POST as $key => $val):            
            if (substr($key, 0, 7) == 'jobapp_'):
                $val = is_array($val) ? serialize($val) : $val; 
                add_post_meta($pid, $key, sanitize_text_field($val));
            endif;
        endforeach;
        
        /**
	 * Fires after inserting applicant's post meta.
	 *
	 * @since 2.2.3
	 */
        do_action('sjb_applicants_insert_post_meta_end');
        
        // Generate response
        $response = ($pid > 0) ? json_encode(array('success' => TRUE)) : json_encode(array('success' => FALSE));
        
        // Response output
        header("Content-Type: application/json"); 
        echo $response;       

        // Admin Notification 
        if ('yes' === get_option('job_board_admin_notification'))
            Simple_Job_Board_Notification::admin_notification($pid);

        //  HR Notification
        if (('yes' === get_option('job_board_hr_notification')) && ('' != get_option('settings_hr_email')))
            Simple_Job_Board_Notification::hr_notification($pid);

        // Applicant Notification
        if ('yes' === get_option('job_board_applicant_notification'))
            Simple_Job_Board_Notification::applicant_notification($pid);
        
        /**
	 * Fires after sending notifications on job submission.
	 *
	 * @since 2.2.3
	 */
        do_action('sjb_admin_notices_after');

        exit();
    }

    /**
     * Uploaded Resume Validation
     * 
     * @since  2.2.3
     */
    public function uploaded_resume_validation() {
        
        /**
	 * Fires before uploaded resume validation.
	 *
	 * @since 2.2.3
	 */
        do_action('sjb_uploaded_resume_validation_before');
        
        // Check the File Existance
        if (strlen($_FILES['applicant_resume']['name']) > 3) {
            $uploadfiles = $_FILES['applicant_resume'];
            if (is_array($uploadfiles)) {
                
                // WP Upload Directory 
                $upload_dir = wp_upload_dir();
                
                // Allowable File Size
                $assignment_upload_size = 200;
                $time = (!empty($_SERVER['REQUEST_TIME'])) ? $_SERVER['REQUEST_TIME'] : (time() + (get_option('gmt_offset') * 3600)); // Fallback of now

                $post_type = 'jobpost';
                
                // Getting Current Date
                $date = explode(" ", date('Y m d H i s', $time));
                $timestamp = strtotime(date('Y m d H i s'));
                if ($post_type) {
                    $upload_dir = array(
                        'path'   => $upload_dir['basedir'] . '/' . $post_type . '/' . $date[0],
                        'url'    => $upload_dir['baseurl'] . '/' . $post_type . '/' . $date[0],
                        'subdir' => '',
                        'error'  => FALSE,
                    );
                }
                
                // Make Upload Directory 
                if (!is_dir($upload_dir['path'])) {
                    wp_mkdir_p($upload_dir['path']);
                }

                // Uploaded File Parameters 
                $uploadfiles = array(
                    'name'     => $_FILES['applicant_resume']['name'],
                    'type'     => $_FILES['applicant_resume']['type'],
                    'tmp_name' => $_FILES['applicant_resume']['tmp_name'],
                    'error'    => $_FILES['applicant_resume']['error'],
                    'size'     => $_FILES['applicant_resume']['size']
                );

                // Look only for uploded files
                if ( 0 == $uploadfiles['error']) {
                    $filetmp = $uploadfiles['tmp_name'];
                    $this->upload_file_name = $uploadfiles['name'];
                    $filesize = $uploadfiles['size'];
                    $max_upload_size = $assignment_upload_size * 1048576; //Multiply by KBs
                    
                    // Check Uploaded File Size
                    if ($max_upload_size < $filesize) {
                        $this->upload_file_error[] = __('Maximum upload File size allowed ' . $assignment_upload_size . 'MB', 'simple-job-board');
                        $this->upload_file_error_indicator = 1;
                    }                    

                    /** Get file info
                     *  @fixme: wp checks the file extension
                     */
                    $filetype = wp_check_filetype(basename($this->upload_file_name), NULL);
                    $file_ext = strtolower($filetype['ext']);
                    $filetitle = preg_replace('/\.[^.]+$/', '', basename($this->upload_file_name));
                    $this->upload_file_name = $filetitle . $timestamp . '.' . $file_ext;

                    /**
                     * Check if the filename already exist in the directory & rename
                     * the file if necessary
                     */
                    $i = 0;

                    while (file_exists($upload_dir['path'] . '/' . $this->upload_file_name)) {
                        $this->upload_file_name = $filetitle . $timestamp . '_' . $i . '.' . $file_ext;
                        $i++;
                    }
                    $filedest = $upload_dir['path'] . '/' . $this->upload_file_name;

                    // Check write permissions
                    if (!is_writeable($upload_dir['path'])) {
                        $this->upload_file_error[] = 'Unable to write to directory %s. Is this directory writable by the server?';
                        $this->upload_file_error_indicator = 1;
                    }

                    // Check valid file extensions
                    $allowed_file_exts = get_option('job_board_allowed_extensions');
                    $settings_file_exts = get_option('job_board_upload_file_ext');

                    // Selection of Setting Extension 
                    $file_extension = ( ( 'yes' === get_option('job_board_all_extensions_check') ) || ( NULL == $settings_file_exts ) ) ? $allowed_file_exts : $settings_file_exts;

                    if (!in_array($file_ext, $file_extension)) {
                        $this->upload_file_error[] = __('This is not an allowed file type.', 'simple-job-board');
                        $this->upload_file_error_indicator = 1;
                    }

                    // Save Temporary File to Uploads Dir
                    if ($this->upload_file_error_indicator <> 1) {
                        if (!@move_uploaded_file($filetmp, $filedest)) {
                            $this->upload_file_error[] = 'Error, the file $filetmp could not moved to : $filedest .';
                            $this->upload_file_error_indicator = 1;
                        }
                        
                        // Upload Base Path & URL
                        $this->upload_baseurl = $upload_dir['url'];
                        $this->upload_basedir = $upload_dir['path'];
                        
                        // Upload File Path & URL
                        $this->upload_file_url = $this->upload_baseurl . '/' . $this->upload_file_name;
                        $this->upload_file_dir = $this->upload_basedir . '/' . $this->upload_file_name;
                    }
                }
            }
        }        
        /**
	 * Fires after uploaded resume validation.
	 *
	 * @since 2.2.3
	 */
        do_action('sjb_uploaded_resume_validation_after');
    }    

}

new Simple_Job_Board_Ajax();