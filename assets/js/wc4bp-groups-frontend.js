/*global wc4bp_groups */
jQuery(function($) {
    try {
        var fieldSet, variationInput;

        function onResetVariation() {
            if (fieldSet) {
                fieldSet.hide();
                clearGroups();
            }
        }

        function clearGroups() {
            jQuery('input[name="_bp_group[]"]').prop('checked', false);
        }

        function wc4bp_frontend() {
            return {
                init: function() {
                    fieldSet = jQuery('div.form-field._bp_group_field');
                    variationInput = jQuery('input[name="variation_id"]');
                    if (variationInput.length > 0 && fieldSet.length > 0) {
                        wc4bp_fnc.initGroupVariation();
                    }
                    var clearVariation = jQuery('a.reset_variations');
                    if (clearVariation.length > 0) {
                        clearVariation.on('click', onResetVariation);
                    }
                },
                initGroupVariation: function() {
                    var singleVariation = jQuery(".single_variation_wrap");
                    if (singleVariation.length > 0 && fieldSet && variationInput) {
                        singleVariation.on("show_variation", function(event, variation) {
                            var showContainer = false;
                            if (variation['variation_id']) {
                                jQuery.each(jQuery('input[name="_bp_group[]"]'), function() {
                                    var groupVariationId = jQuery(this).attr('data-variation-id');
                                    if (parseInt(groupVariationId) !== parseInt(variation['variation_id'])) {
                                        jQuery(this).closest('li').hide();
                                    } else {
                                        jQuery(this).closest('li').show();
                                        showContainer = true;
                                    }
                                });
                            }
                            var areEmpty = fieldSet.find('ul.wc4bp-group-radios>li:visible').length > 0;
                            if (showContainer || areEmpty) {
                                fieldSet.show();
                            } else {
                                fieldSet.hide();
                                clearGroups();
                            }
                        });
                    }
                }
            };
        }

        var wc4bp_fnc = wc4bp_frontend();
        jQuery(document).ready(function() {
            wc4bp_fnc.init();
        });
    } catch (err) {
        window.console.log(err);
    }
});
