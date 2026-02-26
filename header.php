<?php
// Force UTF-8 for the whole page (must be before ANY HTML)
header('Content-Type: text/html; charset=utf-8');

// Include the loadData.php file
include('configs/read.php');
// Load the data from the JSON file
$data = loadData('configs/haneri.json');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Haneri</title>
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
    <link rel="stylesheet" href="custom/custom.css">
    <link rel="stylesheet" href="custom/pop_up.css">
    <!--<link rel="stylesheet" href="custom/hass.css">-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;700&family=Open+Sans:wght@400;700&family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="full-screen-slider">
<!-- Loader HTML -->
<!-- <script>console.log("🔄 DC Loader is showing...");</script>
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
                        <a href="index.php" class="logo">
                            <img src="images/Haneri Logo.png" alt="Haneri">
                        </a>
                        <div class="logo_div">
                            <a href="index.php" class="logos">
                                <img src="images/Haneri Logo.png" alt="Haneri">
                            </a>
                        </div>

                        <nav class="main-nav font2">
                            <ul class="menu">
                                <li class="active">
                                    <a href="shop.php">Categories</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols categoryy">
                                        <div class="row">
                                            <section class="categories hover">
                                                <a href="shop.php?category=Ceiling Fan">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Ceilimg Fan.png" alt="Ceiling Fan">
                                                        </div>
                                                        <div class="text">
                                                            <p>Ceiling Fan</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="shop.php?category=Table Wall Pedestals">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Table Wall Pedestals.png" alt="Table Wall Pedestals">
                                                        </div>                
                                                        <div class="text">
                                                            <p>Table Wall Pedestals</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="shop.php?category=Domestic Exhaust">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Domestic Exhaust.png" alt="Domestic Exhaust">
                                                        </div>
                                                        <div class="text">
                                                            <p>Domestic Exhaust</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="shop.php?category=Personal">
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
                                    <a href="air_curve_design">Pillar Technology</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <ul class="submenu">
                                                    <li><a href="air_curve_design">Air Curve Design</a></li>
                                                    <li><a href="turbosilent_bldc">TurboSilent BLDC</a></li>
                                                    <li><a href="hass">H.A.S.S®</a></li>
                                                    <li><a href="lumiambience">LumiAmbience</a></li>
                                                    <li><a href="scan">S.C.A.N</a></li>
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
                                    <a href="our_story.php">About Us</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="submenu">
                                                    <li class="submenu-item">
                                                        <a href="our_story.php">Our Story</a>
                                                        <div class="submenu-description">
                                                            <a href="our_story.php#vision" class="description-link">VISION</a> |
                                                            <a href="our_story.php#mission" class="description-link"> MISSION</a> |
                                                            <a href="our_story.php#values" class="description-link"> VALUES</a>
                                                        </div>
                                                    </li>
                                                    <li class="submenu-item">
                                                        <a href="our_brands.php">Our Brands</a>
                                                        <div class="submenu-description">
                                                            <a href="our_brands.php#haneri" class="description-link">Haneri</a> |
                                                            <a href="our_brands.php#bespoke" class="description-link"> Bespoke</a> |
                                                            <a href="our_brands.php#professional" class="description-link"> Professional</a>
                                                        </div>
                                                    </li>
                                                    <li class="submenu-item">
                                                        <a href="capabilities.php">Capabilities</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="active">
                                    <a href="contact.php">Support</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <ul class="submenu">
                                                    <li>
                                                        <a href="#">Product Help</a>
                                                        <div class="submenu-description">
                                                            <a href="faqs" class="description-link">FAQs</a> |
                                                            <a href="#" class="description-link">Videos</a> |
                                                            <a href="#" class="description-link">Catalogues</a> |
                                                            <a href="#" class="description-link">Manuals</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="#">Corporate Enquiry</a>
                                                        <div class="submenu-description">
                                                            <a href="contact" class="description-link">FORM</a> 
                                                        </div>
                                                    </li>
                                                    <li><a href="contact">Contact Us</a></li>
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <?php 
                            $isLoggedIn = "<script>document.write(localStorage.getItem('auth_token') ? 'true' : 'false');</script>";
                        ?>

                        <?php if ($isLoggedIn === "true") : ?>
                            <!-- Show when user is logged in -->
                            <a href="profile.php" class="header-icon header-icon-user" title="Profile">
                                <i class="icon-user-2"></i>
                            </a> |  
                            <a href="#" class="header-icon">
                                <i class="fab fa-whatsapp"></i>
                            </a> | 
                            <a href="cart.php" class="header-icon header-icon-wishlist" title="Wishlist">
                                <!-- <i class="icon-wishlist-2"></i> -->
                                <i class="fas fa-shopping-cart"></i>
                            </a> |
                            <a href="#" class="header-icon" id="logout-btn" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        <?php else : ?>
                            <!-- Show when user is NOT logged in -->
                            <a href="login.php" class="header-icon header-icon-user" title="Login">
                                <i class="icon-user-2"></i>
                            </a> |  
                            <a href="#" class="header-icon"><i class="fab fa-whatsapp"></i></a> 
                        <?php endif; ?>

                        <!-- <div class="header-search header-search-popup header-search-category d-none d-sm-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>

        </header>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const authToken = localStorage.getItem("auth_token");

            if (authToken) {
                document.querySelector(".header-right").innerHTML = `
                    <a href="profile.php" class="header-icon header-icon-user" title="Profile">
                        <i class="icon-user-2"></i>
                    </a> |  
                    <a href="#" class="header-icon"><i class="fab fa-whatsapp"></i></a> | 
                    <a href="cart.php" class="header-icon cart" title="cart">
                        <i class="fas fa-shopping-cart"></i>
                    </a> |                
                    <a href="#" class="header-icon" id="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                `;

                document.getElementById("logout-btn").addEventListener("click", function() {
                    localStorage.removeItem("auth_token");
                    localStorage.removeItem("user_name");
                    localStorage.removeItem("user_role");
                    localStorage.removeItem("user_id");
                    window.location.href = "login.php"; // Redirect to login page after logout
                });
            } else {
                document.querySelector(".header-right").innerHTML = `
                    <a href="login.php" class="header-icon header-icon-user" title="Login">
                        <i class="icon-user-2"></i>
                    </a> |  
                    <a href="#" class="header-icon"><i class="fab fa-whatsapp"></i></a>
                `;
            }
        });
    </script>