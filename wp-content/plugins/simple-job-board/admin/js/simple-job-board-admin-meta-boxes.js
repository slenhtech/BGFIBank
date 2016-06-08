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
        $('document').ready(function () {

            /*Job Application Field Type change*/
            $('#jobapp_field_type').on('change', function () {
                var fieldType = $(this).val();

                if (!(fieldType == 'text' || fieldType == 'date' || fieldType == 'text_area' || fieldType == 'email' || fieldType == 'phone')) {
                    $('#jobapp_field_options').show();
                }
                else {
                    $('#jobapp_field_options').hide();
                    $('#jobapp_field_options').val('');
                }
            });

            /*Add Application Field (Group Fields)*/
            $('#addField').on("click", function () {
                var fieldNameRaw = $('#jobapp_name').val(); // Get Raw value.
                var fieldNameRaw = fieldNameRaw.trim();    // Remove White Spaces from both ends.
                var fieldName = fieldNameRaw.split(' ').join('_').toLowerCase(); //Replace white space with _.
                var fieldNameOption = fieldNameRaw.replace(/[&\/\\#,+()$~%.^!'"@:=*?|ØŸ<>{}]/g, '').replace(/[_\s]/g, '_').toLowerCase(); //Replace white space with _.
                var fieldType = $('#jobapp_field_type').val();
                var fieldOptions = $('#jobapp_field_options').val();
                var fieldRequired = $("#jobapp_required_field").attr("checked") ? "checked" : "unchecked";
                var fieldTypeHtml = $('#jobapp_field_type').html();

                if (fieldName != '') {
                    if (fieldType == 'text' || fieldType == 'date' || fieldType == 'text_area' || fieldType == 'email' || fieldType == 'phone') {
                        $('#app_form_fields').append('<li class="' + fieldNameOption + '"><label for="' + fieldName + '">' + fieldNameRaw + '</label><select class="jobapp_field_type" name="jobapp_' + fieldName + '[type]">' + fieldTypeHtml + '</select>&nbsp;<input type="text" class="' + fieldName + ' jobapp_field_options" name="jobapp_' + fieldName + '[options]" value="' + fieldOptions + '" placeholder="Option1, option2, option3" style="display:none;" />&nbsp;<input type="checkbox" class="' + fieldName + ' jobapp_required_field"  ' + fieldRequired + '/><input type="hidden" name="jobapp_' + fieldName + '[optional]" value="' + fieldRequired + '"/>' + admin_meta_box.admin_jquery_alerts['required'] +' &nbsp; <div class="button removeField">' + admin_meta_box.admin_jquery_alerts['delete'] +'</div></li>');
                        $('.' + fieldNameOption + ' .' + fieldType).attr('selected', 'selected');
                        $('#jobapp_name').val('');
                        $('#jobapp_field_type').val('text');
                        $('#jobapp_required_field').prop("checked", true);
                    }
                    else {
                        $('#app_form_fields').append('<li class="' + fieldNameOption + '"><label for="' + fieldName + '">' + fieldNameRaw + '</label><select class="jobapp_field_type" name="jobapp_' + fieldName + '[type]">' + fieldTypeHtml + '</select>&nbsp;<input type="text" class="' + fieldName + ' jobapp_field_options" name="jobapp_' + fieldName + '[options]" value="' + fieldOptions + '" /><input type="checkbox" class="' + fieldName + ' jobapp_required_field" ' + fieldRequired + ' /><input type="hidden" name="jobapp_' + fieldName + '[optional]" value="' + fieldRequired + '"/>' + admin_meta_box.admin_jquery_alerts['required'] +' &nbsp; <div class="button removeField">' + admin_meta_box.admin_jquery_alerts['delete'] +'</div></li>');
                        $('.' + fieldNameOption + ' .' + fieldType).attr('selected', 'selected');
                        $('#jobapp_name').val('');
                        $('#jobapp_field_type').val('text');
                        $('#jobapp_field_options').val('');
                        $('#jobapp_field_options').hide();
                        $('#jobapp_required_field').prop("checked", true);
                    }
                }
                else {
                    alert(admin_meta_box.admin_jquery_alerts['empty_field_name']);
                    $('#jobapp_name').focus(); //Keep focus on this input
                }

            });

            /* Change the Required & Optional Field Parameter*/
            $('.jobapp-required-field').on("change", function () {
                var input = $(this);
                input.attr("checked") ? input.next().val("checked") : input.next().val("unchecked");
            });

            /* Job Application Field Type change (added) */
            $('#app_form_fields').on('change', 'li .jobapp_field_type', function () {

                var fieldType = $(this).val();

                if (!(fieldType == 'text' || fieldType == 'date' || fieldType == 'text_area' || fieldType == 'email' || fieldType == 'phone')) {
                    $(this).next().show();
                }
                else {
                    $(this).next().hide();
                }
            });

            // Add Job Feature
            $('#addFeature').click(function () {
                var fieldNameRaw = $('#jobfeature_name').val(); // Get Raw value.
                var fieldNameRaw = fieldNameRaw.trim();    // Remove White Spaces from both ends.
                var fieldName = fieldNameRaw.split(' ').join('_').toLowerCase(); //Replace white space with _.
                var fieldVal = $('#jobfeature_value').val();
                var fieldVal = fieldVal.trim();

                if (fieldName != '' && fieldVal != '') {
                    $('#job_features').append('<li class="' + fieldName + '"><label for="' + fieldName + '">' + fieldNameRaw + '</label> <input type="text" name="jobfeature_' + fieldName + '" value="' + fieldVal + '" > &nbsp; <div class="button removeField">' + admin_meta_box.admin_jquery_alerts['delete'] +'</div></li>');
                    $('#jobfeature_name').val(""); //Reset Field value.
                    $('#jobfeature_value').val(""); //Reset Field value.
                }
                else {
                    alert(admin_meta_box.admin_jquery_alerts['empty_feature_name']);
                    $('#jobfeature_name').focus(); //Keep focus on this input
                }
            });

            /*Remove Job app or job Feature Fields*/
            $('.jobpost_fields').on('click', 'li .removeField', function () {
                $(this).parent('li').remove();
            });
        });

    });
})(jQuery);