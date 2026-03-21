<?php
/**
 * Mobile menu: header height for panel below main header + hamburger state sync with overlay close.
 * Include once before </body> after jQuery and main.min.js.
 */
?>
<script>
(function () {
    function setHaneriHeaderOffset() {
        var el = document.querySelector('.header .sticky-header') || document.querySelector('.header-middle');
        if (!el) return;
        var h = Math.ceil(el.getBoundingClientRect().height);
        document.documentElement.style.setProperty('--haneri-header-h', h + 'px');
    }
    function schedule() {
        clearTimeout(window._haneriHdrT);
        window._haneriHdrT = setTimeout(setHaneriHeaderOffset, 50);
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setHaneriHeaderOffset);
    } else {
        setHaneriHeaderOffset();
    }
    window.addEventListener('resize', schedule);
    window.addEventListener('load', setHaneriHeaderOffset);
})();
</script>
<script>
jQuery(function ($) {
    $(document).on('click', '.mobile-menu-overlay, .mobile-menu-close', function () {
        $('.mobile-menu-toggler').removeClass('active');
    });
});
</script>
