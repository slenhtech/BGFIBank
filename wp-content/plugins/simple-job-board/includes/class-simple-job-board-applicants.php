<?php
/**
 * Simple_Job_Board_Applicants class.
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/includes
 * @since       1.0.0
 */
if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * This is used to display the applicant details in WP admin.
 *
 * This file is used to modify the default WP editor funtionality and also the display the applicant data & resume. 
 *
 * @since      1.0.0
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/includes
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Applicants {

    /**
     * Initialize the class and set its properties.
     *
     * @since   1.0.0
     */
    public function __construct() {
        // Hook -> Job Applicants Data
        add_action('edit_form_after_title', array($this, 'jobpost_applicants_detail_page_content'));
    }

    /**
     * Creates Detail Page for Applicants
     * 
     * @since   1.0.0
     */
    public function jobpost_applicants_detail_page_content() {
        global $post;

        if (!empty($post) and 'jobpost_applicants' === $post->post_type):
            $keys = get_post_custom_keys($post->ID);

            /**
             * Fires before displaying the applicant details
             * 
             * @since 2.2.0
             */
            do_action('sjb_applicants_details_before');
            ?>
            <div class="wrap"><div id="icon-tools" class="icon32"></div>
                
                <!-- Applicant's Name & Resume in Admin Area -->
                <h3>
                    <?php
                    if (NULL != $keys):
                        foreach ($keys as $key) {
                            if ('jobapp_' === substr($key, 0, 7)) {
                                $place = strpos($key, 'name');
                                if (!empty($place)) {
                                    echo $applicant_name = get_post_meta($post->ID, $key, TRUE);
                                    break;
                                }
                            }
                        }
                    endif;
                    
                    if (in_array('resume', $keys)):
                        ?>
                        &nbsp; &nbsp; <small><a href="<?php echo get_post_meta($post->ID, 'resume', TRUE); ?>" target="_blank" ><?php echo __('Resume', 'simple-job-board'); ?></a></small>
                    <?php endif; ?>
                </h3>  
                
                <!-- Applicant's Detail in Admin Area -->
                <table class="widefat striped">
                    <?php
                    /**
                     * Fires at start of applicant details
                     * 
                     * @since 2.2.0
                     */
                    do_action('sjb_applicants_details_start');

                    foreach ($keys as $key):
                        if (substr($key, 0, 7) == 'jobapp_') {
                            if (!is_serialized(get_post_meta($post->ID, $key, TRUE))) {
                                echo '<tr><td>' . ucwords(str_replace('_', ' ', substr($key, 7))) . '</td><td>' . get_post_meta($post->ID, $key, TRUE) . '</td></tr>';
                            } else {
                                $values = unserialize(get_post_meta($post->ID, $key, TRUE));
                                if (is_array($values)) {
                                    echo '<tr><td>' . ucwords(str_replace('_', ' ', substr($key, 7))) . '</td><td>';
                                    $count = sizeof($values);
                                    foreach ($values as $val):
                                        echo $val;
                                        if ($count > 1) {
                                            echo ',&nbsp';
                                        }
                                        $count--;
                                    endforeach;
                                    echo '</td></tr>';
                                } else {
                                    echo '<tr><td>' . ucwords(str_replace('_', ' ', substr($key, 7))) . '</td><td>' . get_post_meta($post->ID, $key, TRUE) . '</td></tr>';
                                }
                            }
                        }
                    endforeach;

                    /**
                     * Fires at the end of applicant details
                     * 
                     * @since 2.2.0
                     */
                    do_action('sjb_applicants_details_end');
                    ?>
                </table>
            </div>
            <?php
            /**
             * Fires after displaying the applicant details
             * 
             * @since 2.2.0
             */
            do_action('sjb-applicants-details-after');
            ?>
            <h2><?php _e('Application Notes', 'simple-job-board'); ?></h2>
            <?php
            /**
             * Fires after displaying the applicant details
             * 
             * @since 2.2.0 
             */
            do_action('sjb_applicantion_notes');
        endif;
    }

}

new Simple_Job_Board_Applicants();