$(window).on('load', function() {
    // Initialize parallax
    if (typeof window.mr_parallax !== "undefined") {
        window.mr_parallax.windowLoad();
    }
});

$(document).ready(function() {
    // Initialize parallax on document ready as well
    if (typeof window.mr_parallax !== "undefined") {
        window.mr_parallax.documentReady();
    }
});
