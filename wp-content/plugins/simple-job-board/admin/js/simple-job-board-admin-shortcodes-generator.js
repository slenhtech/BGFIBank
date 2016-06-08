(function ($) {
    'use strict';

    /**
     * All of the code for your admin-specific JavaScript source
     * should reside in this file.
     *
     * Note that this assume you're going to use jQuery, so it prepares
     * the $ function reference to be used within the scope of this
     * function.
     *
     * From here, you're able to define handlers for when the DOM is
     * ready:
     *
     * $(function() {
     *
     * });
     *
     * Or when the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and so on.
     *
     * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
     * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
     * be doing this, we should try to minimize doing that in our own work.
     */

    $(function () {
        tinymce.PluginManager.add('sjb_shortcodes_mce_button', function (editor, url) {
            editor.addButton('sjb_shortcodes_mce_button', {
                title: 'Simple Job Board',
                type: 'menubutton',
                icon: 'icon sjb-icon',
                menu: [
                    /* Jobs */
                    {
                        text: 'Job Listing',
                        onclick: function () {
                            editor.windowManager.open({
                                title: 'Insert Simple Job Board Shortcode',
                                body: [
                                    // Number of jobs
                                    {
                                        type: 'textbox',
                                        subtype: 'number',
                                        name: 'job_posts',
                                        label: 'Posts',
                                    },
                                    // Job category
                                    {
                                        type: 'textbox',
                                        name: 'job_category',
                                        label: 'Category',
                                    },
                                    // Job Type
                                    {
                                        type: 'textbox',
                                        name: 'job_type',
                                        label: 'Type',
                                    },
                                    // Job Location                                   
                                    {
                                        type: 'textbox',
                                        name: 'job_location',
                                        label: 'Location',
                                    },
                                    // Job Search                                   
                                    {
                                        type: 'listbox',
                                        name: 'job_search',
                                        label: 'Search',
                                        values: [
                                            {text: 'True', value: 'true'},
                                            {text: 'False', value: 'false'},
                                        ]
                                    },
                                ],
                                onsubmit: function (e) {
                                    
                                    // If user enter number less than -1
                                    if (e.data.job_posts < -1 ) { 
                                        
                                        // Change value with -1
                                        e.data.job_posts = -1;
                                    }                                    
                                    editor.insertContent('[jobpost posts="' + e.data.job_posts + '" category="' + e.data.job_category + '" type="' + e.data.job_type + '" location="' + e.data.job_location + '" search="' + e.data.job_search + '"]');
                                }
                            });
                        }
                    }, // End Jobs

                ]
            });
        });
    });
})(jQuery);