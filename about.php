<?php include("header.php"); ?>

<main class="main about">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <section id="our-story" class="our_story">
            <?php include("inc_files/about/our_story_section.php"); ?>
        </section>
        <section id="our-brands" class="brands-section">
            <?php include("inc_files/about/our-brands.php"); ?>
        </section>
        <br><br>
        <style type="text/css" media="all">
            /* General Section Styling */
            .capabilities-section {
                padding: 20px 20px;
                text-align: center;
            }

            .section-title {
                font-size: 42px;
                font-weight: bold;
                margin-bottom: 40px;
                text-transform: uppercase;
            }

            /* Capability Rows */
            .row-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 30px;
                margin-bottom: 40px;
            }

            .capability-row {
                display: flex;
                flex-direction: row;
                flex: 1;
                gap: 20px;
                align-items: flex-start;
                max-width: calc(50% - 15px); /* Each capability-row takes 50% width minus gap */
            }

            .capability-row.reverse {
                flex-direction: row-reverse;
            }

            .capability-content {
                flex: 1;
                max-width: 400px;
                text-align: left;
                padding: 20px 0;
            }
            /* Capability Images */
            .capability-image {
                flex: 1;
                max-width: 200px;
            }

            .capability-image img {
                width: 100%;
                height: 100%;
                object-fit: contain;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            /* Conclusion */
            .capability-conclusion {
                font-size: 20px;
                font-weight: bold;
                margin-top: 40px;
                color: rgb(37, 108, 99);
            }
        </style>

        <section id="capabilities" class="capabilities-section">
            <?php include("inc_files/about/capabilities_section.php"); ?>
        </section>
    </div>

</main><!-- End .main -->

<?php include("footer.php"); ?>