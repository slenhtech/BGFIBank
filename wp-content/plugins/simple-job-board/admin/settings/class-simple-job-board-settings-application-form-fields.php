<?php
/**
 * Simple_Job_Board_Settings_Application_Form_Fields class
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/admin/settings
 * @since       2.2.3
 */
if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * This is used to define application form fields settings.
 *
 * This file used to define the settings for the job application form. User can create 
 * generic job application form that will only add to the newly created job.
 * 
 * @since      2.2.3
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/admin/settings
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Settings_Application_Form_Fields {

    /**
     * Initialize the class and set its properties.
     *
     * @since   2.2.3
     */
    public function __construct() {

        // Filter -> Add Settings Application Form Fields Tab
        add_filter('sjb_settings_tab_menus', array($this, 'add_settings_tab'), 50);

        // Action -> Add Settings Application Form Fields Section 
        add_action('sjb_settings_tab_section', array($this, 'add_settings_section'), 50);

        // Action -> Save Settings Application Form Fields Section 
        add_action('sjb_save_setting_sections', array($this, 'save_settings_section'));
    }

    /**
     * Add Settings Application Form Fields tab.
     *
     * @since    2.2.3
     * 
     * @param    array  $tabs  Settings Tab
     * @return   array  $tabs  Merge array of Settings Tab with Application Form Fields Tab.
     */
    public function add_settings_tab($tabs) {
        $tabs['application_form_fields'] = __( 'Application Form Fields', 'simple-job-board' );
        return $tabs;
    }

    /**
     * Add Settings Application Form Fields Section.
     *
     * @since    2.2.3
     */
    public function add_settings_section() {
        ?>
        <!-- Application Form Fields -->
        <div id="settings-application_form_fields" class="sjb-admin-settings" style="display: none;">
            <?php
            $field_types = array(
                'text'      => __('Text Field', 'simple-job-board'),
                'text_area' => __('Text Area', 'simple-job-board'),
                'email'     => __('Email', 'simple-job-board'),
                'phone'     => __('Phone', 'simple-job-board'),
                'date'      => __('Date', 'simple-job-board'),
                'checkbox'  => __('Check Box', 'simple-job-board'),
                'dropdown'  => __('Drop Down', 'simple-job-board'),
                'radio'     => __('Radio', 'simple-job-board'),
            );
            ?>
            <h4 class="first"><?php _e('Default Application Form Fields', 'simple-job-board'); ?></h4>
            <div class="sjb-section settings-fields">
                <form method="post" id="job_app_form">
                    <ul id="settings_app_form_fields">
                        <?php
                        // Get Application Form Data
                        $jobapp_fields = unserialize(get_option('jobapp_settings_options'));

                        // Display Job Application From DB
                        if (NULL != $jobapp_fields):
                            foreach ($jobapp_fields as $key => $val):
                                if (isset($val['type']) && isset($val['option'])):
                                    if (substr($key, 0, 7) == 'jobapp_'):
                                        $select_option = NULL;

                                        // Job Application Form Select Options
                                        foreach ($field_types as $field_key => $field_val) {
                                            if ($val['type'] == $field_key)
                                                $select_option .= '<option value="' . $field_key . '" selected>' . $field_val . '</option>';
                                        }

                                        // Options for [Checkbox],[Radio],[Drop Down] Fields
                                        if (!( 'text' === $val['type'] or 'date' === $val['type'] or 'text_area' === $val['type'] or 'email' === $val['type'] or 'phone' === $val['type'] )):
                                            $field_options = '<input type="text" name="field_option[]" value="' . $val['option'] . '"  placeholder="Option1, option2, option3" />';
                                        else:
                                            $field_options = '<input type="hidden" name="field_option[]" value="' . $val['option'] . '" placeholder="Option1, option2, option3"  />';

                                        endif;

                                        echo '<li class="' . $key . '">'
                                        . '<label for="">' . ucwords(str_replace('_', ' ', substr($key, 7))) . '</label>'
                                        . '<input type="hidden" name="field_name[]" value="' . $key . '" >'
                                        . '<input type="hidden" name="field_type[]" value="' . $val['type'] . '" >'
                                        . '' . $field_options . ''
                                        . '<select class="jobapp_field_type" name="' . $key . '[type]">' . $select_option . '</select>&nbsp;';

                                        // Set Fields as Optional or Required
                                        if (isset($val['optional'])) {
                                            echo '<input type="checkbox" name="field_required[]" value="' . $val['optional'] . '" class="settings-jobapp-required-field"  ' . $val['optional'] . ' />' . __('Required', 'simple-job-board') . ' &nbsp; ';
                                            echo '<input type="hidden"   name="field_optional[]" value="' . $val['optional'] . '" class="settings-jobapp-optional-field"  />';
                                        } else {
                                            echo '<input type="checkbox" name="field_required[]" value="checked" class="settings-jobapp-required-field" checked />' . __('Required', 'simple-job-board') . '&nbsp; ';
                                            echo '<input type="hidden"   name="field_optional[]" value="checked" class="settings-jobapp-optional-field" />';
                                        }
                                        echo ' &nbsp; <div class="button removeField">' . __('Delete', 'simple-job-board') . '</div></li>';
                                    endif;
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </ul>
                    <input type="hidden" name="empty_jobapp" value="empty_jobapp" />
                    <input type="hidden" value="1" name="admin_notices" />
                </form>
            </div>
            <div class="clearfix clear"></div>
            
            <!-- Add Application Form Fields -->
            <div class="sjb-section">
                <div class="sjb-content-featured">
                    <div class="sjb-form-group">
                        <label class="pt-featured-label"><?php _e('Field', 'simple-job-board'); ?></label>
                        <input type="text" id="setting_jobapp_name" />
                    </div>
                    <div class="sjb-form-group">
                        <label class="pt-featured-label"><?php _e('Type', 'simple-job-board'); ?></label>
                        <select id="setting_jobapp_field_type">
                            <?php
                            foreach ($field_types as $key => $val):
                                echo '<option value="' . $key . '" class="' . $key . '">' . $val . '</option>';
                            endforeach;
                            ?>
                        </select>
                        <input id="settings_jobapp_field_options" class="jobapp_field_type" type="text" style="display: none;" placeholder="Option1, Option2, Option3" >
                    </div>
                    <div class="pt-elements">
                        <label class="pt-required">
                            <input type="checkbox" id="settings_jobapp_required_field" checked="checked"/> 
                            <span><?php _e('Required', 'simple-job-board'); ?></span>
                        </label>
                    </div>
                    <div class="pt-elements">
                        <input type="submit" class="button" id="app_add_field" value="<?php _e('Add Field', 'simple-job-board'); ?>" />    
                    </div>
                </div>
            </div>
            <input type="submit" name="jobapp_submit" id="jobapp_btn" class="button button-primary" value="<?php echo __('Save Changes', 'simple-job-board'); ?>" />
        </div>
        <?php
    }

    /**
     * Save Settings Application Form Fields Section.
     * 
     * This function is used to save the generic job application form. This form
     * is visible to job detail page in admin on creation of new job.
     *
     * @since    2.2.3
     */
    public function save_settings_section() {
        // Save the Form Data
        if (isset($_POST['field_name']) && isset($_POST['field_type']) && isset($_POST['field_optional'])) {
            $jopapp_fields = Simple_Job_Board_Settings_Init::sjb_mergeArrays($_POST['field_name'], $_POST['field_type'], $_POST['field_option'], $_POST['field_optional']);

            // Creating WP Options For Job Application          
            $jopapp_fields = serialize($jopapp_fields);

            // Save Application Form in WP Options || Add Option if not exist.
            (FALSE !== get_option('jobapp_settings_options')) ?
                            update_option('jobapp_settings_options', $jopapp_fields) :
                            add_option('jobapp_settings_options', $jopapp_fields, '', 'no');
        } elseif (isset($_POST['empty_jobapp']) && 'empty_jobapp' == $_POST['empty_jobapp']) {
            // Save Empty Data
            update_option('jobapp_settings_options', '');
        }
    }

}