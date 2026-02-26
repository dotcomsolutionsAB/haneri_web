<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Pillar Technology</title>
    <?php include("inc_files/fav_icon_others.php"); ?>

    <script>
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,600,700,800', 'Poppins:300,400,500,600,700', 'Shadows+Into+Light:400', 'Segoe+Script:300,400,500,600' ] }
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
    <link rel="stylesheet" type="text/css" href="assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="custom/responsive.css">
    <link rel="stylesheet" href="custom/custom.css">
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-transparent">
            <?php include("inc_files/header.php"); ?>
        </header><!-- End .header -->

        <main class="main about">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pillar Technology</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <section id="air_curve_design">
                    <?php include("inc_files/pillar_technology/air_curve_design.php"); ?>
                </section>
                <br><br>                            
                <section id="air_curve_design">
                    <?php include("inc_files/pillar_technology/M.A.S.S.php"); ?>
                </section>

                <?php include("inc_files/pillar_technology/turbosilent_bldc.php"); ?>
                <style type="text/css" media="all">
                    /* General Section Styling */
                    .capabilities-section {
                        padding: 60px 20px;
                        /*background-color: #f8f9fa;*/
                        /* font-family: 'Roboto', sans-serif; */
                        /*color: #333;*/
                        text-align: center;
                    }

                    .section-title {
                        font-size: 42px;
                        font-weight: bold;
                        margin-bottom: 40px;
                        /*color: #222;*/
                        text-transform: uppercase;
                    }

                    /* Capability Rows */
                    .capability-row {
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: center;
                        align-items: center;
                        gap: 30px;
                        margin-bottom: 40px;
                    }

                    .capability-row.reverse {
                        flex-direction: row-reverse;
                    }

                    .capability-content {
                        flex: 1;
                        max-width: 600px;
                        text-align: left;
                        padding: 20px 0px;
                    }

                    .capability-content h2 {
                        margin-bottom: 2.6rem;
                        font-weight: 400;
                        font-size: 22px;
                    }

                    .capability-content p,
                    .capability-content ul {
                        font-size: 14px;
                        line-height: 22px;
                        text-align: justify;
                    }

                    .capability-content ul {
                        list-style-type: disc;
                        margin-left: 20px;
                    }

                    .capability-content ul li {
                        margin-bottom: 10px;
                    }

                    /* Capability Images */
                    .capability-image {
                        flex: 1;
                        max-width: 500px;
                    }

                    .capability-image img {
                        width: 100%;
                        height: auto;
                        border-radius: 10px;
                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                    }

                    /* Conclusion */
                    .capability-conclusion {
                        font-size: 20px;
                        font-weight: bold;
                        margin-top: 40px;
                        color:rgb(37, 108, 99);
                    }
                    .about .row.row-bg {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                    /* #00473e */
                </style>
            </div>
        </main><!-- End .main -->

        <?php include("inc_files/footer.php"); ?>
    </div><!-- End .page-wrapper -->

    <div class="loading-overlay">
        <?php include("inc_files/loading.php"); ?>
    </div>

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <!-- Mobile_sidebar code -->
        <?php include("inc_files/mobile_sidebar.php"); ?>
    </div>

    <div class="sticky-navbar">
        <!-- Mobile sitky bottom nav -->
        <?php include("inc_files/mobile_sticky_bottom_nav.php"); ?>
    </div>

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins.min.js"></script>
    <script src="assets/js/jquery.plugin.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.min.js"></script>
</body>

</html>