<?php
/**
 * Simple_Job_Board_Settings_Email_Notifications class
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/admin/settings
 * @since       2.2.3
 */
if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * This is used to define email notifications settings.
 *
 * This file used to define the settings for the email notifications. User can 
 * enable/disable emails receiving for Admin/HR/Applicant.
 * 
 * @since      2.2.3
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/admin/settings
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Settings_Email_Notifications {

    /**
     * Initialize the class and set its properties.
     *
     * @since   2.2.3
     */
    public function __construct() {

        // Filter -> Add Settings Email Notifications Tab
        add_filter('sjb_settings_tab_menus', array($this, 'add_settings_tab'), 70);

        // Action -> Add Settings Email Notifications Section 
        add_action('sjb_settings_tab_section', array($this, 'add_settings_section'), 70);

        // Action -> Save Settings Email Notifications Section 
        add_action('sjb_save_setting_sections', array($this, 'save_settings_section'));
    }

    /**
     * Add Settings Email Notifications tab.
     *
     * @since    2.2.3
     * 
     * @param    array  $tabs  Settings Tab
     * @return   array  $tabs  Merge array of Settings Tab with "Email Notification" Tab.
     */
    public function add_settings_tab($tabs) {
        $tabs['email_notifications'] = __( 'Email Notifications', 'simple-job-board' );
        return $tabs;
    }

    /**
     * Add Settings Email Notifications Section.
     *
     * @since    2.2.3
     */
    public function add_settings_section() {
        ?>
        <!-- Notification -->
        <div id="settings-email_notifications" class="sjb-admin-settings" style="display: none;">
            <?php
            /**
             * Action -> Add new section before notifications settings .  
             * 
             * @since 2.2.0 
             */
            do_action('sjb_notifications_settings_before');

            $hr_email = ( false !== get_option('settings_hr_email') ) ? get_option('settings_hr_email') : '';
            ?>
            <h4 class="first"><?php _e('Enable Email Notification', 'simple-job-board'); ?></h4>
            <form method="post" id="email_notification_form">
                <div class="sjb-section">
                    <div class="sjb-content-email-notify">
                        <?php
                        /**
                         * Action -> Add new fields at the start of notification section.  
                         * 
                         * @since 2.2.0 
                         */
                        do_action('sjb_email_notifications_settings_start');
                        ?> 

                        <div class="sjb-form-group">
                            <label><?php echo __('HR Email:', 'simple-job-board'); ?><input type="hidden" name="empty_form_check" value="empty_form_submitted"></label>
                            <input type="email" name="hr_email" value="<?php echo $hr_email ?>" size="30">
                        </div>
                        <div class="sjb-form-group right-align">
                            <input type="checkbox" name="email_notification[]" value="hr_email" <?php if ('yes' === get_option('job_board_hr_notification')) echo 'checked="checked"'; ?>/>
                            <label><?php echo __('Enable the HR email notification', 'simple-job-board'); ?></label>
                        </div>
                        <div class="sjb-form-group">
                            <label><?php echo __('Admin Email:', 'simple-job-board'); ?></label>
                            <input type="text" value="<?php echo get_option('admin_email'); ?>" size="30" readonly>
                        </div>
                        <div class="sjb-form-group right-align">
                            <input type="checkbox" name="email_notification[]" value="admin_email" <?php if ('yes' === get_option('job_board_admin_notification')) echo 'checked="checked"'; ?> />
                            <label><?php echo __('Enable the Admin email notification', 'simple-job-board'); ?></label>
                        </div>
                        <div class="sjb-form-group right-align">
                            <input type="checkbox" name="email_notification[]" value="applicant_email" <?php if ('yes' === get_option('job_board_applicant_notification')) echo 'checked="checked"'; ?>/>
                            <label><?php echo __('Enable the Applicant email notification', 'simple-job-board'); ?></label>
                        </div>
                        <?php
                        /**
                         * Action -> Add new fields at the end of notification section.  
                         * 
                         * @since 2.2.0 
                         */
                        do_action('sjb_notifications_settings_end');
                        ?> 
                    </div>
                </div>
                <?php
                /**
                 * Action -> Add new section after notifications settings .  
                 * 
                 * @since 2.2.0 
                 */
                do_action('sjb_notifications_settings_after');
                ?>
                <input type="hidden" value="1" name="admin_notices" />
                <input type="submit" name="job_email_notification" id="job_email_notification" class="button button-primary" value="<?php echo __('Save Changes', 'simple-job-board'); ?>" />
            </form>
        </div>
        <?php
    }

    /**
     * Save Settings Email Notification Section.
     * 
     * This function is used to save the email notifications settings. User can 
     * enable/disable the notifications for Admin/HR/Applicant. 
     *
     * @since    2.2.3
     */
    public function save_settings_section() {
        if ((isset($_POST['email_notification']) && '' != $_POST['email_notification']) || isset($_POST['empty_form_check'])) {

            // Empty checkboxes status
            $hr_email_status = $admin_email_status = $applicant_email_status = 'no';

            // Save Notifications Settings
            if (isset($_POST['email_notification'])) {
                foreach ($_POST['email_notification'] as $value) {
                    if ('hr_email' === $value) {
                        update_option('job_board_hr_notification', 'yes');
                        $hr_email_status = 'yes';
                    } elseif ('admin_email' === $value) {
                        update_option('job_board_admin_notification', 'yes');
                        $admin_email_status = 'yes';
                    } elseif ('applicant_email' === $value) {
                        update_option('job_board_applicant_notification', 'yes');
                        $applicant_email_status = 'yes';
                    }
                }
            }

            // HR Email
            if (isset($_POST['hr_email'])) {
                ( false !== get_option('settings_hr_email') ) ? update_option('settings_hr_email', sanitize_email($_POST['hr_email'])) : add_option('settings_hr_email', sanitize_email($_POST['hr_email']));
                $hr_email = get_option('settings_hr_email');
            }

            // Disable HR Notification
            if ('no' === $hr_email_status) {
                update_option('job_board_hr_notification', 'no');
            }

            // Disable Admin Notification
            if ('no' === $admin_email_status) {
                update_option('job_board_admin_notification', 'no');
            }

            // Disable Applicant Notification
            if ('no' === $applicant_email_status) {
                update_option('job_board_applicant_notification', 'no');
            }
        }
    }

}