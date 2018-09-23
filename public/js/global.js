(function($) {

    $(document).ready(function() {
        $('input.js-toggle-trigger').on('focus', function() {
            var triggerName = $(this).data('toggle-trigger');

            $('.js-toggle-when-triggered[data-toggle-trigger="' + triggerName + '"]').slideDown();
        });
        $('button.js-toggle-trigger').on('click', function() {
            var triggerName = $(this).data('toggle-trigger');

            $('.js-toggle-when-triggered[data-toggle-trigger="' + triggerName + '"]').slideUp();
        });

        $('.js-reorder-enable').on('click', function() {
            var $container = $(this).closest('.js-reorder-container'),
                $reorderEls = $('.js-reorder-toggle-el', $container),
                $submit = $('.js-reorder-submit', $container);

            $(this).find('.fas').toggleClass('fa-chevron-down fa-chevron-up');
            $submit.prop('disabled', function(i, v) { return !v; });
            $reorderEls.toggle();
        });


        $('.js-copy-trigger').on('click', function() {
            var copyFromSelector = $(this).data('copy-from'),
                copyWrapperSelector = $(this).data('copy-wrapper'),
                $copyFrom;

            if (copyWrapperSelector) {
                $copyFrom = $(copyFromSelector, $(this).closest(copyWrapperSelector));
            } else {
                $copyFrom = $(copyFromSelector);
            }

            copyToClipboard($copyFrom[0]);
        });

    });
})(jQuery);
