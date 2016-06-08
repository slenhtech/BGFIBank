<?php
/**
 * Simple_Job_Board_Settings_Filters class
 *
 * @link        https://wordpress.org/plugins/simple-job-board
 *
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/admin/settings
 * @since       2.2.3
 */
if (!defined('ABSPATH')) { exit; } // Exit if accessed directly

/**
 * This is used to define job filters settings.
 *
 * This file used to define the settings for the job filters. User can enable/disable
 * keyword search, job category, job type and job location filters.
 * 
 * @since      2.2.3
 * 
 * @package    Simple_Job_Board
 * @subpackage Simple_Job_Board/admin/settings
 * @author     PressTigers <support@presstigers.com>
 */
class Simple_Job_Board_Settings_Filters {

    /**
     * Initialize the class and set its properties.
     *
     * @since   2.2.3
     */
    public function __construct() {

        // Filter -> Add Settings Filters Tab
        add_filter('sjb_settings_tab_menus', array($this, 'add_settings_tab'), 60);

        // Action -> Add Settings Filters Section 
        add_action('sjb_settings_tab_section', array($this, 'add_settings_section'), 60);

        // Action -> Save Settings Filters Section 
        add_action('sjb_save_setting_sections', array($this, 'save_settings_section'));
    }

    /**
     * Add Settings Filters tab.
     *
     * @since    2.2.3
     * 
     * @param    array  $tabs  Settings Tab
     * @return   array  $tabs  Merge array of Settings Tab with "Filters" Tab.
     */
    public function add_settings_tab($tabs) {
        $tabs['job_filters'] = __( 'Filters', 'simple-job-board' );
        return $tabs;
    }

    /**
     * Add Settings Filters section.
     *
     * @since    2.2.3
     */
    public function add_settings_section() {
        ?>
        <!-- Filters Setting -->
        <div id="settings-job_filters" class="sjb-admin-settings" style="display: none;">
            <?php
            /**
             * Action -> Add new section before job filters settings .  
             * 
             * @since 2.2.0 
             */
            do_action('sjb_job_filters_settings_before');
            ?>
            <h4 class="first"><?php _e('Select filters that display on front-end', 'simple-job-board'); ?></h4>
            <form method="post" id="job_filters_form">
                <div class="sjb-section">
                    <div class="sjb-content">
                        <?php
                        /**
                         * Action -> Add new fields at the start of job filters section.  
                         * 
                         * @since 2.2.0 
                         */
                        do_action('sjb_job_filters_settings_start');
                        ?> 

                        <div class="sjb-form-group">
                            <input type="checkbox" name="job_filters[]" value="category"  <?php if ('yes' === get_option('job_board_category_filter')) echo 'checked="checked"'; ?> />
                            <label><?php echo __('Enable the Job Category Filter', 'simple-job-board'); ?></label>
                            <input type='hidden' name="empty_filter[]" value="empty_category" >
                        </div>
                        <div class="sjb-form-group">
                            <input type="checkbox" name="job_filters[]" value="jobtype" <?php if ('yes' === get_option('job_board_jobtype_filter')) echo 'checked="checked"'; ?>/>
                            <label><?php echo __('Enable the Job Type Filter', 'simple-job-board'); ?></label>
                            <input type='hidden' name="empty_filter[]" value="empty_jobtype" >
                        </div>
                        <div class="sjb-form-group">
                            <input type="checkbox" name="job_filters[]" value="location" <?php if ('yes' === get_option('job_board_location_filter')) echo 'checked="checked"'; ?>/>
                            <label><?php echo __('Enable the Job Location Filter', 'simple-job-board'); ?></label>
                            <input type='hidden' name="empty_filter[]" value="empty_location" >
                        </div>
                        <div class="sjb-form-group">
                            <input type="checkbox" name="job_filters[]" value="search_bar" <?php if ('yes' === get_option('job_board_search_bar')) echo 'checked="checked"'; ?>/>
                            <label><?php echo __('Enable the Search Bar', 'simple-job-board'); ?></label>
                            <input type='hidden' name="empty_filter[]" value="empty_search_bar" >
                        </div>
                        <?php
                        /**
                         * Action -> Add new fields at the end of job filters section.  
                         * 
                         * @since 2.2.0 
                         */
                        do_action('sjb_job_filters_settings_end');
                        ?>
                    </div>
                </div>
                <input type="hidden" value="1" name="admin_notices" />
                <input type="submit" name="jobfilter_submit" id="job_filters" class="button button-primary" value="<?php echo __('Save Changes', 'simple-job-board'); ?>" />
            </form>
            <?php
            /**
             * Action -> Add new section after job filters settings .  
             * 
             * @since 2.2.0 
             */
            do_action('sjb_job_filters_settings_after');
            ?>
        </div>
        <?php
    }

    /**
     * Save Settings Job Filters Section.
     * 
     * This function is used to save the job filters settings. User can 
     * enable/disable the job filters on frontend for keyword search, category, job
     * type & job location filters.
     *
     * @since    2.2.3
     */
    public function save_settings_section() {

        if (( isset($_POST['job_filters']) && '' !== $_POST['job_filters'] ) || isset($_POST['empty_filter'])) {

            // Empty checkboxes status
            $category_status = 0;
            $jobtype_status = 0;
            $location_status = 0;
            $search_bar_status = 0;

            // Update checkbox status 
            if (isset($_POST['job_filters']) && '' != $_POST['job_filters']) {
                foreach ($_POST['job_filters'] as $filter) {
                    if ('category' === $filter) {
                        update_option('job_board_category_filter', 'yes');
                        $category_status = 1;
                    } elseif ('jobtype' === $filter) {
                        update_option('job_board_jobtype_filter', 'yes');
                        $jobtype_status = 1;
                    } elseif ('location' === $filter) {
                        update_option('job_board_location_filter', 'yes');
                        $location_status = 1;
                    } elseif ('search_bar' === $filter) {
                        update_option('job_board_search_bar', 'yes');
                        $search_bar_status = 1;
                    }
                }
            }

            // Disable Category Filter
            if (0 === $category_status) {
                update_option('job_board_category_filter', 'no');
            }

            // Disable Job Type Filter
            if (0 === $jobtype_status) {
                update_option('job_board_jobtype_filter', 'no');
            }

            // Disable Job Location Filter
            if (0 === $location_status) {
                update_option('job_board_location_filter', 'no');
            }

            // Disable Search Filter
            if (0 === $search_bar_status) {
                update_option('job_board_search_bar', 'no');
            }
        }
    }

}