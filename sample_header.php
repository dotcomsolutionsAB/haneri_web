
<!DOCTYPE html>
<html lang="en">
<?php
    // Include the loadData.php file
    include('configs/read.php');
    // Load the data from the JSON file
    $data = loadData('configs/haneri.json');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Haneri</title>
    <meta name="keywords" content="" />
    <meta name="description" content="Haneri">
    <meta name="author" content="Cognitive Branding">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../images/Haneri_Favicon.jpg">

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
<style>
    .header_icon{
        font-size: 20px;
        width: 30%;
        display: flex;
        justify-content: center;
        align-items: center;
        /* font-weight: 100; */
        height: 100%;
    }
    .header_icon_text{
        width: 70%;
        /* background: aqua; */
        height: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 5px;
    }
    .header_a{
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    /* Wrapper for all icons */
    .profile_box {
        display: flex;
        /* background: antiquewhite; */
        justify-content: flex-end;
        align-items: center;
    }

    /* Dropdown menu (hidden by default) */
    .dropdown-menu {
        display: none;
        /* position: absolute; */
        top: 85%;
        right: 4%;
        background-color: #fff;
        border: 0px solid #ccc;
        border-radius: 5px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        max-width: 300px;
        left: 85%;
    }

    /* Dropdown item styling */
    .dropdown-item {
        padding: 10px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        font-family: 'Open Sans', sans-serif;
        text-transform: uppercase;
        font-weight:500;
        display: flex;
        justify-content: flex-start;
        height:50px;
    }

    /* Highlight item on hover */
    .dropdown-item:hover {
        background-color: #f5f5f5;
    }

    /* Show the dropdown menu when hovering over Profile link */
    .header-icon-wrapper:hover .dropdown-menu {
        display: block !important;
    }

    /* Optional: style for icon hover */
    .header-icon-wrapper:hover .header-icon {
        cursor: pointer;
    }
</style>

<style>
.search-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    background: white;
    z-index: 9999;
    padding: 60px 20px;
    box-sizing: border-box;
}
.search-close {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 40px;
    cursor: pointer;
    color: #00aaff;
}
.search-container {
    max-width: 800px;
    margin: auto;
    text-align: center;
}
.search-container input[type="text"] {
    width: 100%;
    padding: 12px 16px;
    font-size: 20px;
    border: 2px solid #00aaff;
    margin-top: 30px;
}
.search-container button {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #00aaff;
    margin-top: 10px;
}
.search-results {
    margin-top: 30px;
    max-height: 300px;
    overflow-y: auto;
    text-align: left;
}
.search-result-item {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding: 10px 0;
}
.search-result-item img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    margin-right: 15px;
}
.search-result-item h4 {
    margin: 0;
    font-size: 18px;
}
</style>

    <!-- Search Overlay -->
    <div id="searchOverlay" class="search-overlay">
        <span class="search-close" onclick="closeSearch()">&times;</span>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Type keywords here" oninput="performSearch()" />
            <button onclick="performSearch()"><i class="icon-magnifier"></i></button>
            <div id="searchResults" class="search-results"></div>
        </div>
    </div>

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
                                                <a href="shop.php">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Ceilimg Fan.png" alt="Ceiling Fan">
                                                        </div>
                                                        <div class="text">
                                                            <p>Ceiling Fan</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="shop.php">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Table Wall Pedestals.png" alt="Table Wall Pedestals">
                                                        </div>                
                                                        <div class="text">
                                                            <p>Table Wall Pedestals</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="shop.php">
                                                    <div class="category hov">
                                                        <div class="img">
                                                            <img src="images/Domestic Exhaust.png" alt="Domestic Exhaust">
                                                        </div>
                                                        <div class="text">
                                                            <p>Domestic Exhaust</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="shop.php">
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
                                    <a href="air_curve_design.php">Pillar Technololgy</a>
                                    <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <ul class="submenu">
                                                    <li><a href="air_curve_design.php">Air Curve Design</a></li>
                                                    <li><a href="turbosilent_bldc.php">TurboSilent BLDC</a></li>
                                                    <li><a href="hass">M.A.S.S®</a></li>
                                                    <li><a href="lumiambience.php">LumiAmbience</a></li>
                                                    <li><a href="scan.php">S.C.A.N</a></li>
                                                    <!-- <li><a href="product-custom-tab.html">WITH CUSTOM TAB</a></li>
                                                    <li><a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a></li>
                                                    <li><a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a></li>
                                                    <li><a href="product-addcart-sticky.html">ADD CART STICKY</a></li> -->
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
                                                            <a href="our_brands.php#haner" class="description-link">Haneri</a> |
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
                                                            <a href="#" class="description-link">FAQs</a> |
                                                            <a href="#" class="description-link">Videos</a> |
                                                            <a href="#" class="description-link">Catalogues</a> |
                                                            <a href="#" class="description-link">Manuals</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="#">Corporate Enquiry</a>
                                                        <div class="submenu-description">
                                                            <a href="#" class="description-link">FORM</a> 
                                                        </div>
                                                    </li>
                                                    <li><a href="contact.php">Contact Us</a></li>
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <div class="profile_box">
                            <?php 
                                $isLoggedIn = "<script>document.write(localStorage.getItem('auth_token') ? 'true' : 'false');</script>";
                            ?>

                            <?php if ($isLoggedIn === "true") : ?>
                                <!-- Show when user is logged in -->
                                <div class="header-icon-wrapper">
                                    <a href="profile.php" class="header-icon header-icon-user" title="Profile">
                                        <i class="icon-user-2"></i>
                                    </a> 

                                    <!-- Profile Dropdown Menu -->
                                    <div class="dropdown-menu d-none">
                                        <a href="#" class="dropdown-item" id="whatsapp-link">WhatsApp</a>
                                        <a href="cart.php" class="dropdown-item">Cart</a>
                                        <a href="profile.php" class="dropdown-item">Account</a>
                                        <a href="#" class="dropdown-item" id="logout-link">Logout</a>
                                    </div> 

                                    | 
                                    <!-- This works for both login and non-login views -->
                                    <div class="header-search header-search-popup header-search-category d-none d-sm-block">
                                        <a href="javascript:void(0);" onclick="openSearch()" role="button"><i class="icon-magnifier"></i></a>
                                    </div>

                                </div>

                            <?php else : ?>
                                <!-- Show when user is NOT logged in -->
                                <div class="header-icon-wrapper">
                                    <a href="login.php" class="header-icon header-icon-user" title="Login">
                                        <i class="icon-user-2"></i>
                                    </a> |
                                    <!-- This works for both login and non-login views -->
                                    <div class="header-search header-search-popup header-search-category d-none d-sm-block">
                                        <a href="javascript:void(0);" onclick="openSearch()" role="button"><i class="icon-magnifier"></i></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- End .header -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const authToken = localStorage.getItem("auth_token");

            if (authToken) {
                document.querySelector(".header-right").innerHTML = `
                    <div class="profile_box">
                        <div class="header-icon-wrapper">
                            <a href="profile.php" class="header-icon header-icon-user" title="Profile">
                                <i class="icon-user-2"></i>
                            </a> 
                            <div class="dropdown-menu d-none">
                                <a href="#" class="dropdown-item header_a" id="whatsapp-link">
                                    <span class="header_icon">
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <span class="header_icon_text">WhatsApp</span>
                                </a>
                                <a href="cart.php" class="dropdown-item header_a">                            
                                    <span class="header_icon">
                                        <i class="fas fa-shopping-cart"></i> 
                                    </span>
                                    <span class="header_icon_text">Cart</span>
                                </a>
                                <a href="profile.php" class="dropdown-item header_a">
                                    <span class="header_icon">
                                        <i class="fas fa-user-cog"></i> 
                                    </span>
                                    <span class="header_icon_text">Account</span>
                                </a>
                                <a href="#" class="dropdown-item header_a" id="logout-link">
                                    <span class="header_icon">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </span>
                                    <span class="header_icon_text">Logout</span>
                                </a>
                            </div>
                        </div> |
                        <div class="header-search header-search-popup header-search-category d-none d-sm-block">
                            <a href="#" class="search-toggle" role="button">
                                <i class="icon-magnifier"></i>
                            </a>
                        </div>
                    </div>
                `;

                // Logout functionality
                document.getElementById("logout-link").addEventListener("click", function() {
                    localStorage.removeItem("auth_token");
                    localStorage.removeItem("user_name");
                    localStorage.removeItem("user_role");
                    localStorage.removeItem("user_id");
                    window.location.href = "login.php"; // Redirect to login page after logout
                });

            } else {
                document.querySelector(".header-right").innerHTML = `
                <div class="">
                    <div class="header-icon-wrapper profile_box">
                        <a href="login.php" class="header-icon header-icon-user" title="Login">
                            <i class="icon-user-2"></i>
                        </a> |
                        <div class="header-search header-search-popup header-search-category d-none d-sm-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
                        </div>
                    </div>
                </div>
                `;
            }
        });
    </script>
<script>
        function openSearch() {
            document.getElementById("searchOverlay").style.display = "block";
            document.getElementById("searchInput").focus();
        }

        function closeSearch() {
            document.getElementById("searchOverlay").style.display = "none";
            document.getElementById("searchInput").value = "";
            document.getElementById("searchResults").innerHTML = "";
        }

        function performSearch() {
            const query = document.getElementById("searchInput").value.toLowerCase();
            const resultsContainer = document.getElementById("searchResults");
            resultsContainer.innerHTML = "";

            if (query.length < 2) return;

            fetch("product.json")
                .then(res => res.json())
                .then(data => {
                    const filtered = data.products.filter(product =>
                        product.name.toLowerCase().includes(query)
                    );

                    if (filtered.length === 0) {
                        resultsContainer.innerHTML = "<p>No products found.</p>";
                        return;
                    }

                    filtered.forEach(product => {
                        const item = document.createElement("div");
                        item.className = "search-result-item";
                        item.innerHTML = `
                            <img src="${product.image}" alt="${product.name}" />
                            <div>
                                <h4>${product.name}</h4>
                                <p>₹${product.price.toFixed(2)} - ${product.brand}</p>
                            </div>
                        `;
                        item.onclick = () => {
                            window.location.href = `product_details.php?id=${product.id}`;
                        };
                        resultsContainer.appendChild(item);
                    });
                })
                .catch(err => {
                    resultsContainer.innerHTML = "<p>Error loading products.</p>";
                });
        }
</script>
