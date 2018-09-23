var copyToClipboard = function($copyFrom) {
    var range = document.createRange();
    range.selectNode($copyFrom);
    window.getSelection().addRange(range);

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        alert('Copy was ' + msg);
    } catch(err) {
        alert('Oops, unable to copy.');
    }

    window.getSelection().removeAllRanges();
};


(function($) {

})(jQuery);
