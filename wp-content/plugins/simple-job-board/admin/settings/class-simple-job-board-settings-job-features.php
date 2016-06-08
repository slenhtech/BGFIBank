<?php
/**
 * Simple_Job_Board_Settings_Job_Features class
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/admin/settings
 * @since       2.2.3
 */
if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * This is used to define job features settings.
 *
 * This file used to define the settings for the job features. User can create 
 * generic job features that will add to the newly created job.
 * 
 * @since      2.2.3
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/admin/settings
 * @author     PressTigers <support@presstigers.com>
 */

class Simple_Job_Board_Settings_Job_Features {

    /**
     * Initialize the class and set its properties.
     *
     * @since   2.2.3
     */
    public function __construct() {

        // Filter -> Add Settings Job Features Tab
        add_filter('sjb_settings_tab_menus', array($this, 'add_settings_tab'), 40);

        // Action -> Add Settings Job Features Section 
        add_action('sjb_settings_tab_section', array($this, 'add_settings_section'), 40);

        // Action -> Save Settings Job Features Section 
        add_action('sjb_save_setting_sections', array($this, 'save_settings_section'));
    }

    /**
     * Add Settings Job Features tab.
     *
     * @since    2.2.3
     * 
     * @param    array  $tabs  Settings Tab
     * @return   array  $tabs  Merge array of Settings Tab with Job Features Tab.
     */
    public function add_settings_tab($tabs) {
        $tabs['job_features'] = __( 'Job Features', 'simple-job-board' );
        return $tabs;
    }

    /**
     * Add Settings Job Features section.
     *
     * @since    2.2.3
     */
    public function add_settings_section() {
        ?>
        <!-- Job Features -->
        <div id="settings-job_features" class="sjb-admin-settings" style="display: none;">                
            <h4 class="first"><?php _e('Default Feature List', 'simple-job-board'); ?></h4>
            <div class="sjb-section settings-fields">
                <form method="post" action="" id="job_feature_form">
                    <ul id="settings_job_features">
                        <?php
                        // Get Job Features From DB
                        $job_features = get_option('jobfeature_settings_options');
                        $fields = unserialize($job_features);

                        // Display Job Features
                        if (NULL != $fields):
                            foreach ($fields as $field => $val) {
                                $feature_value = ('empty' === $val) ? '<input type="text" value=" "  name="jobfeature_value[]" />' : '<input type="text" value="' . $val . '"  name="jobfeature_value[]" />';
                                echo '<li class="' . $field . '"><label for="' . $field . '"><strong>' . __('Field Name', 'simple-job-board') . ':</strong> ' . ucwords(str_replace('_', ' ', substr($field, 11))) . '</label> <input type="hidden"  name="jobfeature[]" value="' . $field . '"  >' . $feature_value . ' &nbsp; <div class="button removeField">' . __('Delete', 'simple-job-board') . '</div></li>';
                            }
                        endif;
                        ?>
                    </ul>
                    <input type="hidden" name="empty_feature" value="empty_features" />
                    <input type="hidden" value="1" name="admin_notices" />
                </form>
            </div> 

            <!-- Add Job Features -->
            <h4><?php _e('Add New Feature', 'simple-job-board'); ?></h4>
            <div class="sjb-section">
                <div class="sjb-content-featured">
                    <div class="sjb-form-group">
                        <label class="pt-featured-label"><?php _e('Feature', 'simple-job-board'); ?></label>
                        <input type="text" id="settings_jobfeature_name" />
                    </div>
                    <div class="sjb-form-group">
                        <label class="pt-featured-label"><?php _e('Value', 'simple-job-board'); ?></label>
                        <input type="text" id="settings_jobfeature_value" />
                    </div>
                    <input type="submit" class="button" id="settings_addFeature" value="<?php echo __('Add Field', 'simple-job-board'); ?>" />
                </div>
            </div>
            <input type="submit" name="jobfeature_submit" id="jobfeature_form" class="button button-primary" value="<?php echo __('Save Changes', 'simple-job-board'); ?>" />
        </div>
        <?php
    }

    /**
     * Save Settings Job Features Section.
     * 
     * This function is used to save the generic job features. All these 
     * features are displayed on creation of new job.
     *
     * @since    2.2.3
     */
    public function save_settings_section() {
        // Save Form Data to WP Option
        if (isset($_POST['jobfeature']) && $_POST['jobfeature'] != '' && isset($_POST['jobfeature_value'])) {
            $job_features = array_combine($_POST['jobfeature'], $_POST['jobfeature_value']);
            $job_features = serialize($job_features);

            // Save Job Features in WP Options || Add Option if not exist.
            (FALSE !== get_option('jobfeature_settings_options')) ? update_option('jobfeature_settings_options', $job_features) : add_option('jobfeature_settings_options', $job_features, '', 'no');
        } elseif (isset($_POST['empty_feature']) && 'empty_features' == $_POST['empty_feature']) {
            // Save Empty Data
            update_option('jobfeature_settings_options', '');
        }
    }

}