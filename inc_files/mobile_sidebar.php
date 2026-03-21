<div class="mobile-menu-wrapper">
    <div class="haneri-mobile-drawer-header">
        <button type="button" class="haneri-mobile-drawer-close mobile-menu-close" aria-label="Close menu">
            <i class="fa fa-times"></i>
        </button>
        <a href="https://haneri.com/" class="haneri-mobile-drawer-logo">
            <img src="images/Haneri Logo.png" alt="Haneri">
        </a>
        <div class="haneri-mobile-drawer-actions">
            <a href="https://haneri.com/account/login" class="haneri-drawer-icon haneri-drawer-account-link" title="Account">
                <i class="icon-user-2"></i>
            </a>
            <span class="haneri-drawer-divider" aria-hidden="true"></span>
            <a href="https://haneri.com/account/cart" class="haneri-drawer-icon" title="Cart">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <span class="haneri-drawer-divider" aria-hidden="true"></span>
            <a href="https://wa.me/918377826826" class="haneri-drawer-icon" title="WhatsApp" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>

    <nav class="mobile-nav haneri-mobile-nav">
        <ul class="mobile-menu haneri-mobile-menu list-none p-0">
            <li class="haneri-mobile-nav-item">
                <a class="haneri-mobile-nav-link" href="https://haneri.com/">Home</a>
            </li>
            <li class="haneri-mobile-nav-item">
                <a class="haneri-mobile-nav-link" href="https://haneri.com/shop">Categories</a>
                <ul>
                    <li><a href="https://haneri.com/shop">Ceiling Fan</a></li>
                    <li><a href="https://haneri.com/shop">Table Wall Pedestals</a></li>
                    <li><a href="https://haneri.com/shop">Domestic Exhaust</a></li>
                    <li><a href="https://haneri.com/shop">Personal</a></li>
                </ul>
            </li>
            <li class="haneri-mobile-nav-item">
                <a class="haneri-mobile-nav-link" href="https://haneri.com/air-curve-design">Pillar Technology</a>
                <ul>
                    <li><a href="https://haneri.com/air-curve-design">Air Curve Design</a></li>
                    <li><a href="https://haneri.com/turbosilent-bldc">TurboSilent BLDC</a></li>
                    <li><a href="https://haneri.com/hass">HASS&reg;</a></li>
                    <li><a href="https://haneri.com/lumiambience">LumiAmbience</a></li>
                    <li><a href="https://haneri.com/scan">SCAN</a></li>
                </ul>
            </li>
            <li class="haneri-mobile-nav-item">
                <a class="haneri-mobile-nav-link" href="https://haneri.com/our-story">About Us</a>
                <ul>
                    <li><a href="https://haneri.com/our-story#vision">Vision</a></li>
                    <li><a href="https://haneri.com/our-story#mission">Mission</a></li>
                    <li><a href="https://haneri.com/our-story#values">Values</a></li>
                    <li><a href="https://haneri.com/our-brands#haneri">Our Brands</a></li>
                </ul>
            </li>
            <li class="haneri-mobile-nav-item">
                <a class="haneri-mobile-nav-link" href="https://haneri.com/contact">Contact Us</a>
            </li>
        </ul>
    </nav>
</div><!-- End .mobile-menu-wrapper -->

<script>
document.addEventListener("DOMContentLoaded", function () {
    var acc = document.querySelector(".haneri-drawer-account-link");
    if (acc && localStorage.getItem("auth_token")) {
        acc.setAttribute("href", "https://haneri.com/account/profile");
        acc.setAttribute("title", "Profile");
    }
});
</script>
