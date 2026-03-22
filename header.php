<?php
require_once __DIR__ . '/configs/canonical_host.php';
// Force UTF-8 for the whole page (must be before ANY HTML)
header('Content-Type: text/html; charset=utf-8');

// Include the loadData.php file
include('configs/read.php');
// Load the data from the JSON file
$data = loadData('configs/haneri.json');

if (!defined('BASE_URL')) {
    require_once __DIR__ . '/configs/config.php';
}

// Header utility icons (order: Profile → Cart → WhatsApp), inline SVGs for JS + SSR
$HANERI_WHATSAPP_URL = 'https://wa.me/918377826826';
$haneri_svg_profile = '<svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" width="22" height="22" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>';
$haneri_svg_cart = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="22" height="22" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path></svg>';
$haneri_svg_whatsapp = '<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Haneri - Premium Ceiling Fans</title>
    <meta name="keywords" content="" />
    <meta name="description" content="Haneri">
    <meta name="author" content="Cognitive Branding">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/Haneri_Favicon.jpg">

    <script>
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700' ] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[ 0 ];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/demo3.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/simple-line-icons/css/simple-line-icons.min.css">


    <!-- Custom -->
    <link rel="stylesheet" href="custom/extra.css">
    <link rel="stylesheet" href="custom/haneri-swal.css">
    <link rel="stylesheet" href="custom/custom.css">
    <script>
        window.HANERI_HEADER = <?php echo json_encode(array(
            'waUrl' => $HANERI_WHATSAPP_URL,
            'svgProfile' => $haneri_svg_profile,
            'svgCart' => $haneri_svg_cart,
            'svgWhatsapp' => $haneri_svg_whatsapp,
            'profileUrl' => 'https://www.haneri.com/account/profile',
            'loginUrl' => 'https://www.haneri.com/account/login',
            'cartUrl' => 'https://www.haneri.com/account/cart',
            'cartFetchUrl' => BASE_URL . '/cart/fetch',
        ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    </script>
    <link rel="stylesheet" href="custom/pop_up.css">
    <!--<link rel="stylesheet" href="custom/hass.css">-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;700&family=Open+Sans:wght@400;700&family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="custom/haneri-swal-defaults.js"></script>

</head>

<body class="full-screen-slider">
<!-- Loader HTML -->
<!-- <script>console.log("ðŸ”„ DC Loader is showing...");</script>
<div id="dc-loader-wrapper">
  <div class="dc-haneri-container" id="dc-haneri">
    <div class="dc-letter">H</div>
    <div class="dc-letter">A</div>
    <div class="dc-letter">N</div>
    <div class="dc-letter">E</div>
    <div class="dc-letter">R</div>
    <div class="dc-letter">I</div>
  </div>
</div> -->


    <!-- <div class="page-wrapper" id="dc-page-content"> -->
    <div class="page-wrapper">
        <header class="header header-transparent">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <!-- <a href="https://www.haneri.com" class="logo"> -->
                        <a href="https://www.haneri.com/" class="logo">
                            <img src="images/Haneri Logo.png" alt="Haneri">
                        </a>
                        <div class="logo_div">
                         <!--   <a href="https://www.haneri.com" class="logos"> -->
                            <a href="https://www.haneri.com" class="logos">
                                <img src="images/Haneri Logo.png" alt="Haneri">
                            </a>
                        </div>

                        <nav class="main-nav font2">
                            <ul class="menu">
                                <li class="active">
                                    <a href="https://www.haneri.com/shop">Categories</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols categoryy">
                                        <div class="row">
                                            <section class="categories hover">
                                                <a href="https://www.haneri.com/shop?category=Ceiling Fan">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Ceilimg Fan.png" alt="Ceiling Fan">
                                                        </div>
                                                        <div class="text">
                                                            <p>Ceiling Fan</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="https://www.haneri.com/shop?category=Table Wall Pedestals">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Table Wall Pedestals.png" alt="Table Wall Pedestals">
                                                        </div>                
                                                        <div class="text">
                                                            <p>Table Wall Pedestals</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="https://www.haneri.com/shop?category=Domestic Exhaust">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Domestic Exhaust.png" alt="Domestic Exhaust">
                                                        </div>
                                                        <div class="text">
                                                            <p>Domestic Exhaust</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="https://www.haneri.com/shop?category=Personal">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Personal.png" alt="Personal">
                                                        </div>
                                                        <div class="text">
                                                            <p>Personal</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </section>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="https://www.haneri.com/air-curve-design">Pillar Technology</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <ul class="submenu">
                                                    <li><a href="https://www.haneri.com/air-curve-design">Air Curve Design</a></li>
                                                    <li><a href="https://www.haneri.com/turbosilent-bldc">TurboSilent BLDC</a></li>
                                                    <li><a href="https://www.haneri.com/hass">HASS®</a></li>
                                                    <li><a href="https://www.haneri.com/lumiambience">LumiAmbience</a></li>
                                                    <li><a href="https://www.haneri.com/scan">SCAN</a></li>
                                                </ul>
                                            </div><!-- End .col-lg-4 -->
                                        </div>
                                    </div>
                                </li>                        
                                <style>
                                    .description-link {
                                        /* font-size: 14px; */
                                        color:rgb(8, 9, 9); /* Link color */
                                        text-decoration: none;
                                        /* margin: 0 5px; */
                                        font-size: 14px;
                                        font-weight: 300;
                                    }

                                    .description-link:hover {
                                        text-decoration: underline;
                                    }
                                </style>
                                <li class="active">
                                    <a href="https://www.haneri.com/our-story">About Us</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="submenu">
                                                    <li class="submenu-item">
                                                        <a href="https://www.haneri.com/our-story">Our Story</a>
                                                        <div class="submenu-description">
                                                            <a href="https://www.haneri.com/our-story#vision" class="description-link">VISION</a> |
                                                            <a href="https://www.haneri.com/our-story#mission" class="description-link"> MISSION</a> |
                                                            <a href="https://www.haneri.com/our-story#values" class="description-link"> VALUES</a>
                                                        </div>
                                                    </li>
                                                    <li class="submenu-item">
                                                        <a href="https://www.haneri.com/our-brands">Our Brands</a>
                                                        <div class="submenu-description">
                                                            <a href="https://www.haneri.com/our-brands#haneri" class="description-link">Haneri</a> |
                                                            <a href="https://www.haneri.com/our-brands#bespoke" class="description-link"> Bespoke</a> |
                                                            <a href="https://www.haneri.com/our-brands#professional" class="description-link"> Professional</a>
                                                        </div>
                                                    </li>
                                                    <li class="submenu-item">
                                                        <a href="https://www.haneri.com/capabilities">Capabilities</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="active">
                                    <a href="https://www.haneri.com/contact">Support</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <ul class="submenu">
                                                    <li>
                                                        <a href="#">Product Help</a>
                                                        <div class="submenu-description">
                                                            <a href="https://www.haneri.com/faqs" class="description-link">FAQs</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="#">Corporate Enquiry</a>
                                                        <div class="submenu-description">
                                                            <a href="https://www.haneri.com/contact" class="description-link">FORM</a> 
                                                        </div>
                                                    </li>
                                                    <li><a href="https://www.haneri.com/contact">Contact Us</a></li>
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div><!-- End .header-left -->

                    <div class="header-right haneri-header-util">
                        <?php /* SSR (logged out): Profile → Cart → WhatsApp — JS refreshes when token exists */ ?>
                        <a href="https://www.haneri.com/account/login" class="header-icon header-icon-svg" title="Login"><?php echo $haneri_svg_profile; ?></a><span class="header-icon-sep" aria-hidden="true">|</span><span class="haneri-header-cart-wrap"><a href="https://www.haneri.com/account/cart" class="header-icon header-icon-svg header-icon-cart haneri-cart-link" title="Cart"><?php echo $haneri_svg_cart; ?><span class="haneri-cart-badge" hidden data-haneri-cart-badge aria-live="polite"></span></a></span><span class="header-icon-sep" aria-hidden="true">|</span><a href="<?php echo htmlspecialchars($HANERI_WHATSAPP_URL, ENT_QUOTES, 'UTF-8'); ?>" class="header-icon header-icon-svg header-icon-whatsapp" title="WhatsApp" target="_blank" rel="noopener noreferrer"><?php echo $haneri_svg_whatsapp; ?></a>
                    </div>
                </div>
            </div>

        </header>

    <script>
        (function () {
            function haneriCartLineCount(items) {
                if (!Array.isArray(items)) return 0;
                return items.reduce(function (sum, row) {
                    var q = parseInt(row && row.quantity, 10);
                    return sum + (isNaN(q) ? 0 : Math.max(0, q));
                }, 0);
            }

            function haneriRefreshCartBadge() {
                var H = window.HANERI_HEADER;
                var badge = document.querySelector("[data-haneri-cart-badge]");
                if (!H || !H.cartFetchUrl || !badge) return;

                var token = localStorage.getItem("auth_token");
                var tempId = localStorage.getItem("temp_id");
                if (!token && !tempId) {
                    badge.textContent = "";
                    badge.hidden = true;
                    badge.classList.remove("is-visible");
                    return;
                }

                var body = token ? {} : { cart_id: tempId };
                var headers = { "Content-Type": "application/json" };
                if (token) headers["Authorization"] = "Bearer " + token;

                fetch(H.cartFetchUrl, { method: "POST", headers: headers, body: JSON.stringify(body) })
                    .then(function (r) {
                        return r.json();
                    })
                    .then(function (data) {
                        var items = data && data.data;
                        var n = haneriCartLineCount(Array.isArray(items) ? items : []);
                        if (n > 0) {
                            badge.textContent = n > 99 ? "99+" : String(n);
                            badge.hidden = false;
                            badge.classList.add("is-visible");
                            badge.setAttribute("aria-label", n + " items in cart");
                        } else {
                            badge.textContent = "";
                            badge.hidden = true;
                            badge.classList.remove("is-visible");
                            badge.removeAttribute("aria-label");
                        }
                    })
                    .catch(function () {
                        badge.textContent = "";
                        badge.hidden = true;
                        badge.classList.remove("is-visible");
                    });
            }

            window.haneriRefreshCartBadge = haneriRefreshCartBadge;
            window.addEventListener("haneri-cart-changed", haneriRefreshCartBadge);

            document.addEventListener("DOMContentLoaded", function () {
                var H = window.HANERI_HEADER;
                var el = document.querySelector(".header-right.haneri-header-util") || document.querySelector(".header-right");
                if (!el || !H || !H.svgProfile) return;

                var authToken = localStorage.getItem("auth_token");
                var sep = '<span class="header-icon-sep" aria-hidden="true">|</span>';
                var profileHref = authToken ? (H.profileUrl || "https://www.haneri.com/account/profile") : (H.loginUrl || "https://www.haneri.com/account/login");
                var profileTitle = authToken ? "Profile" : "Login";
                var cartUrl = H.cartUrl || "https://www.haneri.com/account/cart";
                var waUrl = H.waUrl || "https://wa.me/";

                el.innerHTML =
                    '<a href="' + profileHref + '" class="header-icon header-icon-svg" title="' + profileTitle + '">' + H.svgProfile + "</a>" +
                    sep +
                    '<span class="haneri-header-cart-wrap">' +
                    '<a href="' + cartUrl + '" class="header-icon header-icon-svg header-icon-cart haneri-cart-link" title="Cart">' +
                    H.svgCart +
                    '<span class="haneri-cart-badge" hidden data-haneri-cart-badge aria-live="polite"></span>' +
                    "</a></span>" +
                    sep +
                    '<a href="' + waUrl + '" class="header-icon header-icon-svg header-icon-whatsapp" title="WhatsApp" target="_blank" rel="noopener noreferrer">' +
                    H.svgWhatsapp +
                    "</a>";

                haneriRefreshCartBadge();
            });
        })();
    </script>