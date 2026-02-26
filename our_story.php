<?php include("header.php"); ?>

<main class="main about">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <!-- <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Our Story</li>
            </ol>
        </div> -->
    </nav>
    <!-- <div class="page-header pt-3 bg-transparent"> -->
    <?php include("our_story_links.php"); ?>

    <div class="container">       
        <section id="our-story" class="our_story">
            <?php include("inc_files/about/our_story_section.php"); ?>
        </section>
    </div>

</main><!-- End .main -->

<?php include("footer.php"); ?>