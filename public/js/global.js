(function($) {

    $(document).ready(function() {
        $('input.js-toggle-trigger').on('focus', function() {
            var triggerName = $(this).data('toggle-trigger');

            $('.js-toggle-when-triggered[data-toggle-trigger="' + triggerName + '"]').show();
        });
        $('button.js-toggle-trigger').on('click', function() {
            var triggerName = $(this).data('toggle-trigger');

            $('.js-toggle-when-triggered[data-toggle-trigger="' + triggerName + '"]').hide();
        });
    });
})(jQuery);
