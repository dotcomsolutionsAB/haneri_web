<?php include("header.php"); ?>

<main class="main about">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <!-- <li class="breadcrumb-item"><a href="#">Pillar Technology</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">FaQs</li>
            </ol>
        </div>
    </nav>

    <!-- <div class="heading">
        <div class="containe text-left">
            <h1 class="text-uppercase text-left about_section">FAQs</h1>
        </div>
    </div> -->

    <div class="container">
        <?php include("inc_files/policy/faq.php"); ?>
    </div>

</main><!-- End .main -->

<?php include("footer.php"); ?>