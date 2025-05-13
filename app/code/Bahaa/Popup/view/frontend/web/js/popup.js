define([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function($, modal) {
    'use strict';
    
    return function(config) {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'Welcome',
            buttons: [{
                text: $.mage.__('Close'),
                class: 'action primary',
                click: function() {
                    this.closeModal();
                    // Store in localStorage to prevent showing again in the same session
                    localStorage.setItem('popup_shown', 'true');
                }
            }]
        };

        // Get current page type
        var body = $('body');
        var isCategoryPage = body.hasClass('catalog-category-view');
        
        // Only show popup if not on category page and not already shown in this session
        if (!isCategoryPage && !localStorage.getItem('popup_shown')) {
            var popup = $('#bahaa-popup');
            modal(options, popup);
            popup.modal('openModal');
            
            // Close button functionality
            $('.popup-close').on('click', function() {
                popup.modal('closeModal');
                localStorage.setItem('popup_shown', 'true');
            });
        }
    };
}); 