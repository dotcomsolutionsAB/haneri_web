<?php include "header.php"; ?>
<?php include "configs/config.php"; ?>
<script>window.jQuery||document.write('<script src="https://code.jquery.com/jquery-3.6.0.min.js"><\/script>')</script>

<style>

  /* ===== ROOT LAYOUT: make page stretch and footer always visible ===== */
  html,
  body {
    height: 100%;
    min-height: 100%;
  }

  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    overflow: visible !important;
    background: #fff;
  }

  /* Main content grows; footer stays at bottom and visible */
  .page-wrapper,
  #page,
  .wrapper {
    display: flex;
    flex-direction: column;
    flex: 1 0 auto;
    min-height: 0 !important;
  }

  main.main {
    flex: 1 0 auto;
    position: relative;
    overflow: visible !important;
    padding-bottom: 20px;
  }

  /* room for footer */

  /* Unlock any rogue wrappers */
  .page-wrapper,
  .wrapper,
  #page,
  .content,
  .main,
  .container,
  .container-fluid,
  #layout,
  .prod-grid {
    overflow: visible !important;
    height: auto !important;
    min-height: auto !important;
  }

  /* Prevent transforms breaking sticky */
  /* #layout,
  #layout * {
    transform: none !important;
  } */
    /* Prevent transforms breaking sticky – but DO NOT disable transforms on the slider */
    #layout *:not(.fs-track):not(.fs-item) {
      transform: none !important;
    }


  :root {
    --headerH: 112px;
  }

  /* ===== BREADCRUMB ===== */
  .breadcrumb-nav {
    margin-top: 8px
  }

  /* ===== GRID (60/40) ===== */
  .prod-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 56px;
    align-items: start;
  }

  @media (min-width:1101px) {
    .prod-grid {
      grid-template-columns: 55% 45%;
      gap: 56px;
      padding-top: 20px;
    }
  }

  /* ===== LEFT GALLERY ===== */
  .gallery-main {
    position: relative;
    width: 100%;
    background: transparent;
    border-radius: 8px;
    overflow: hidden;
    min-height: 650px;
    width: 100%;
    height: 650px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .gallery-main img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
    background: #fff;
    margin: 0px;
    /* margin: 0px 50px; */
  }
  /* Gallery nav arrows */
  .g-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 0 6px rgba(0,0,0,.15);
    color: #CA5D27;
    font-size: 22px;
    line-height: 1;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0.85;
    z-index: 3;
  }

  .g-nav:hover {
    opacity: 1;
  }

  .g-prev {
    left: 10px;
  }

  .g-next {
    right: 10px;
  }

  /* If you want to hide arrows on very small screens */
  @media (max-width: 480px) {
    .g-nav {
      display: flex !important;
    }
  }

  .thumbs {
    display: grid;
    gap: 10px;
    margin-top: 12px;
    grid-template-columns: repeat(auto-fill, minmax(84px, 1fr));
    align-items: stretch;
  }

  @media (min-width:480px) {
    .thumbs {
      grid-template-columns: repeat(auto-fill, minmax(96px, 1fr));
    }
  }
  @media (max-width:480px) {
    .related-products {
      position: relative;
      margin: 28px auto 28px !important;
      padding-bottom:0px;
    }
    .thumbs {
      grid-template-columns: repeat(auto-fill, minmax(48px, 1fr));
    }
    .title-hero {
      font-family: "Barlow Condensed", sans-serif;
      font-weight: 500;
      font-size: 32px !important;
    }
    .brand_image {
      width: 100px;
    }
    .prod-grid {
      gap: 18px;
    }
    .gallery-main {
      display: flex;
      align-items: center;
      justify-content: center;
      background: transparent;
      min-height: 320px;
      height: 320px;
    }
    .gallery-main img{
      height: 100%;
      width: 100%;
      object-fit: contain;
    }
    .gallery-main img, .gallery-main iframe {
      padding: 0px 20px;
    }
    .full-description p {
      margin-right: 0px;
    }
    section.faq .faq-title {
      font-weight:400;
    }
  }

  @media (min-width:992px) {
    .thumbs {
      grid-template-columns: repeat(auto-fill, minmax(104px, 1fr));
    }
  }

  .thumbs button {
    width: 100%;
    aspect-ratio: 1/1;
    padding: 0;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    background: #fff;
    overflow: hidden;
    cursor: pointer;
  }

  .thumbs img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: contain;
    background: #fff;
    border-radius: inherit;
  }

  @supports not (aspect-ratio:1/1) {
    .thumbs button {
      position: relative;
    }

    .thumbs button::before {
      content: "";
      display: block;
      padding-top: 100%;
    }

    .thumbs img {
      position: absolute;
      inset: 0;
    }
  }

  .poster-stack {
    margin-top: 12px;
    line-height: 0;
  }

  .poster-stack img {
    display: block;
    width: 100%;
    height: auto;
    margin: 0;
  }

  /* ===== RIGHT STICKY ===== */
  #colRight {
    position: sticky;
    top: var(--headerH, 112px);
    align-self: start;
    z-index: 5;
    /* max-height: calc(100vh - var(--headerH, 112px)); */
    height: auto;
    /* overflow: auto; */
  }

  /* ===== TEXT BLOCKS ===== */
  .brand_image img {
    height: 28px;
    width: auto;
  }

  .title-hero {
    font-family: "Barlow Condensed", sans-serif;
    font-weight: 600;
    font-size: 30px;
    line-height: 1;
    text-transform: uppercase;
    color: #CA5D27;
    margin: 6px 0 8px;
  }

  .ratings-container {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 6px;
  }

  .prod-badge {
    font-family: "Open Sans", sans-serif;
    font-weight: 700;
    font-size: 14px;
    line-height: 18px;
    color: #005d5a;
    margin: 6px 0 4px;
    text-transform: uppercase;
  }

  .prod-desc {
    font-family: "Open Sans", sans-serif;
    font-weight: 500;
    font-size: 14px;
    line-height: 18px;
    color: #858585;
    margin: 10px 0px;
  }
  .full-description{
    padding-bottom: 0rem;
  }
  /* ===== VARIANTS ===== */
  .select_variant {
    margin: 16px 0px;
    padding: 0px;
  }

  .select_variant p {
    font-family: "Open Sans", Arial, sans-serif;
    font-weight: 700;
    font-size: 14px;
    line-height: 18px;
    text-transform: uppercase;
    color: #005d5a;
    margin: 0 0 6px;
  }

  .variants {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .variant-color-circle {
    width: 28px;
    height: 28px;
    border-radius: 999px;
    border: 1px solid #ddd;
    cursor: pointer;
    box-shadow: inset 0 0 0 2px rgba(255, 255, 255, .8);
  }

  .variant-color-circle.selected {
    outline: 2px solid #005d5a;
  }

  /* ===== PRICES / CART ===== */
  .price-box .mrp {
    margin-right: 8px;
  }

  ._price {
    display: inline-flex;
    gap: 10px;
    align-items: baseline;
  }

  .in-ex {
    display: block;
    margin-top: 6px;
  }

  .product-action {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
  }

  .product-single-qty {
    width: 120px;
  }

  .divider {
    border: 0;
    border-top: 1px solid #e9edf0;
    margin: 16px 0;
  }

  /* ===== GUIDE LINKS ===== */
  .guide-links {
    display: flex;
    gap: 28px;
    align-items: center;
    margin: 6px 0 10px;
  }

  .guide-links a {
    font-family: "Open Sans", Arial, sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: #005d5a;
    text-decoration: none;
  }

  .guide-links a:hover {
    text-decoration: underline;
  }

  /* ===== BENEFITS (icon row) ===== */
  #hx-benefits {
    background: transparent;
    border: 0;
    padding: 0;
  }

  .hx-benefits-strip {
    display: grid;
    grid-template-columns: repeat(3, minmax(160px, 1fr));
    gap: 22px;
    margin: 10px 0;
  }

  .hx-benefit {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    background: transparent;
    border: 0;
    padding: 6px 8px;
  }

  .hx-benefit img {
    width: 60px;
    height: 60px;
    object-fit: contain;
    margin-bottom: 8px;
  }

  .hx-benefit .hx-txt {
    font-family: "Open Sans", sans-serif;
    color: #005d5a;
    font-weight: 600;
    font-size: 12px;
    line-height: 1.2;
  }

  /* ===== FAQ ===== */
  section.faq {
    display: block !important;
    margin: 20px 0;
  }

  section.faq .faq-title {
    font-family: "Barlow Condensed", sans-serif;
    font-size: 36px;
    font-weight:400;
    line-height: 1.1;
    color: #005d5a;
    margin: 0 0 10px;
  }

  section.faq .faq-item {
    margin: 0;
    padding: 14px 0;
    border: 0;
    border-top: 1px solid #e9edf0;
  }

  section.faq .faq-item:last-of-type {
    border-bottom: 1px solid #e9edf0;
  }

  section.faq .faq-item summary {
    list-style: none;
    display: block;
    cursor: pointer;
    font-family: "Open Sans", Arial, sans-serif;
    font-weight: 600;
    font-size: 16px;
    color: #111;
    position: relative;
    padding-right: 26px;
  }

  section.faq .faq-item summary::-webkit-details-marker {
    display: none;
  }

  section.faq .faq-item summary::after {
    content: "+";
    position: absolute;
    right: 0;
    top: 0;
    font-weight: 700;
    font-size: 18px;
    color: #005d5a;
    line-height: 1;
  }

  section.faq .faq-item[open] summary::after {
    content: "–";
  }

  section.faq .faq-item>div {
    margin-top: 8px;
    font-family: "Open Sans", Arial, sans-serif;
    font-size: 14px;
    color: #4a505e;
  }

  /* ===== SPECS (contained; extra bottom so footer never overlaps) ===== */
  .product-specs-full {
    width: 100%;
    margin: 0px;
    padding: 0px;
    background: #fff;
    position: relative;
    z-index: 0;
  }

  .product-specs-full .specs-inner {
    padding: 0 20px;
  }

  .specs-json-table {
    width: 100%;
    border-collapse: collapse;
  }
  .spec-title{
    font-family: "Barlow Condensed", sans-serif;
    font-size: 36px;
    font-weight: 400;
    line-height: 1.1;
    color: #005d5a;
    margin: 0 0 10px;
    text-align:left;
  }
  .specs-json-table th,
  .specs-json-table td {
    border: 1px solid #ececec;
    padding: 12px 14px;
    text-align: left;
  }

  .specs-json-table th {
    background: #fafafa;
  }

  /* ===== Footer guarantee ===== */
  footer,
  .footer,
  #footer {
    display: block !important;
    position: static !important;
    visibility: visible !important;
    clear: both !important;
    overflow: visible !important;
    height: auto !important;
    max-height: none !important;
    z-index: 2 !important;
  }
  @media(max-width:520px){
    #colRight {
    position: sticky;
    top: var(--headerH, 112px);
    align-self: start;
    z-index: 5;
    max-height:100%;
    height: 100%;
    overflow: auto;
  }
  }

</style>
<!-- FEATURES SLIDER CSS -->
<style>
  /* --- Feature Slider --- */
  .fs {
    position: relative;
    margin: 10px 0 6px; /* sits right under guide links */
    padding: 8px 36px;  /* room for chevrons */
  }
  .fs-viewport {
    overflow: hidden;
    width: 100%;
  }
  .fs-track {
    display: flex;
    align-items: center;
    gap: 32px;
    will-change: transform;
  }
  .fs-item {
    flex: 0 0 auto;
    width: 120px;                 /* compact, like your screenshot */
    display: grid;
    justify-items: center;
    text-align: center;
    row-gap: 6px;
  }
  .fs-item .fs-icon {
    width: 42px;
    height: 42px;
    object-fit: contain;
    /* filter: invert(40%) sepia(32%) saturate(1251%) hue-rotate(350deg) brightness(92%) contrast(91%); */
    /* above tint makes PNG/SVG look #CA5D27; remove if your icons are already orange */
  }
  .fs-item .fs-label {
    font: 600 12px/1.2 "Open Sans", Arial, sans-serif;
    color: #CA5D27;
    letter-spacing: .2px;
  }
  /* Chevrons */
  .fs-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 28px;
    height: 28px;
    border: 0;
    background: transparent;
    color: #CA5D27;
    font-size: 22px;
    line-height: 1;
    cursor: pointer;
    opacity: .7;
  }
  /* Make 4 items fit comfortably on desktops */
  @media (min-width:1101px) {
    .fs { padding: 8px 30px; }   /* a bit more room for chevrons */
    .fs-track { gap: 24px; }     /* slightly tighter gap */
    .fs-item { width: 108px; }   /* compact cards so 4 show at once */
  }

  /* Keep buttons clickable above the viewport overlay */
  .fs-nav { z-index: 4; }

  .fs-nav:hover { opacity: 1; }
  .fs-prev { left: 4px; top: 35%; }
  .fs-next { right: 4px; top: 35%; }
  /* Pause the auto-scroll when hovering the whole section */
  .fs:hover .fs-track { animation-play-state: paused; }
</style>
<main class="product_detail">
  <div class="page-wrapper">
    <main class="main">
      <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active breadcrumb-title" id="breadcrumb-title" aria-current="page">Product</li>
          </ol>
        </div>
      </nav>

      <section class="container" id="layout">
        <div class="prod-grid">
          <!-- LEFT -->
          <aside class="prod-left" id="colLeft">
            <div class="prod-gallery">
              <div class="gallery-main">
                <!-- Prev arrow -->
                <button type="button" class="g-nav g-prev" aria-label="Previous image">
                  &#8249;
                </button>
                  <!-- Main image / video goes here -->
                  <div id="gMain" aria-live="polite"></div>
                <!-- Next arrow -->
                <button type="button" class="g-nav g-next" aria-label="Next image">
                  &#8250;
                </button>
              </div>
              <div class="thumbs" id="gThumbs"></div>
            </div>
            <div class="poster-stack m-d-done" id="posterStack" hidden></div>
          </aside>

          <!-- RIGHT (CSS sticky) -->
          <article class="prod-right" id="colRight">
            <div class="brand_image"><img src="images/Haneri Logo.png" onerror="this.onerror=null;this.src='/images/Link.png'" alt="Haneri"></div>
            <h1 id="product-title" class="title-hero"></h1>

            <div class="ratings-container">
              <div class="product-ratings"><span class="ratings" style="width:60%"></span></div>
              <a class="rating-link primary_light" href="#">( 6 Reviews )</a>
            </div>

            <div class="prod-badge">Category: <span id="product-category">Ceiling Fan</span></div>
            <section class="full-description" id="variant-description-section">
                <p id="variant-description"></p>
            </section>

            <section class="select_variant">
              <p class="primary_light fw-600" style="margin-bottom:6px;">Select The Variant:</p>
              <input type="hidden" id="selected-variant" value="">
              <div class="variants"></div>
            </section>

            <section class="price-box p_box">
                <div class="prices">
                    <div class="_price">
                        <span class="reducePercent">0.00%</span>
                    <span class="new-price" id="product-price">₹0.00</span>
                    </div>
                </div>
                <div class="reg_price_n_tax">
                    <div class="reg_pricex">
                        <span class="mrp">MRP</span>
                        <del class="old-price"><span id="regular-price">₹0.00</span></del>
                    </div>
                    <div class="tax_type">
                        <span class="in-ex paragraph2 primary_light">Inclusive All Taxes</span>
                    </div>
                </div>
            </section>

            <section class="product-action">
              <div class="price-box">
                <span class="product-price primary_light" id="selling-tprice" data-price="0">₹0.00</span>
              </div>
              <div class="product-single-qty" id="cartId" data-cart-id="">
                <input class="horizontal-quantity form-control" type="number" id="quantity" value="1" min="1">
              </div>
              <a href="#" id="add-to-cart-btn" class="btn btn-primary_light">Add to Cart</a>
              <a href="cart.php" class="btn btn-view_light" id="view-cart-btn" style="display:none;">View cart</a>
            </section>

            <hr class="divider">

            <!-- Guide links (optional) -->
            <div class="guide-links">
              <a href="#" aria-label="Buying Guide">Buying Guide</a>
              <a href="#" aria-label="Installation Guide">Installation Guide</a>
            </div>

            <hr class="divider">

            <!-- FEATURES SLIDER (below guide links) -->
            <section id="feature-slider" class="fs" aria-label="Key Features">
              <button class="fs-nav fs-prev" aria-label="Previous">&#8249;</button>
              <div class="fs-viewport">
                <div class="fs-track" id="fsTrack"><!-- built by JS --></div>
              </div>
              <button class="fs-nav fs-next" aria-label="Next">&#8250;</button>
            </section>

            <!-- <div class="poster-stack m-d-done" id="posterStack" hidden></div> -->
            <!-- <hr class="divider"> -->
          </article>
        </div>
      </section>

      <section class="descr container">
        <h2 class="spec-title" style="margin:0 0 14px 0;">Description</h2>
        <p id="product-description" class="prod-desc"></p>
        <a href="#" id="read-more" style="display:none;">Read More</a>
        <a href="#" id="show-less" style="display:none;">Show Less</a>
      </section>

      <!-- Technical Specifications -->
      <section class="product-specs-full">
        <div class="specs-inner container">
          <h2 class="spec-title" style="margin:0 0 14px 0;">Technical Specifications</h2>
          <table id="spec-table" class="specs-json-table"></table>
        </div>
      </section>
      <br>
      <section class="container">
        <section class="faq" id="faq">
          <h3 class="faq-title">Frequently Asked Questions</h3>
          <details class="faq-item"><summary>What makes Haneri different?</summary><div>Design + engineering for fluidic airflow and quiet operation.</div></details>
          <details class="faq-item"><summary>Is installation included?</summary><div>We provide service & installation in supported cities.</div></details>
          <details class="faq-item"><summary>Warranty?</summary><div>5 years from the date of purchase.</div></details>
        </section>
      </section>
      <br>
      <!-- Related Products -->
      <section class="related-products container" id="related-products" hidden>
        <h2 class="rp-title">Related Products</h2>
        <div class="rp-slider">
          <button class="rp-nav rp-prev" aria-label="Previous">&#8249;</button>
          <div class="rp-viewport">
            <div class="rp-track" id="relatedGrid"></div>
          </div>
          <button class="rp-nav rp-next" aria-label="Next">&#8250;</button>
        </div>
      </section>

      <!-- MOBILE STICKY CART BAR -->
      <div class="mobile-sticky-cart" id="mStickyCart" aria-hidden="true">
        <div class="msc-inner">
          <div class="msc-qty">
            <button type="button" class="msc-btn msc-minus" aria-label="Decrease quantity">−</button>
            <input type="text" id="m-qty" value="1" min="1" inputmode="numeric" />
            <button type="button" class="msc-btn msc-plus" aria-label="Increase quantity">+</button>
          </div>

          <div class="msc-total">
            <div class="msc-total-main" id="m-total">₹0.00</div>
            <small class="msc-tax">Incl. taxes</small>
          </div>

          <a href="#" id="m-add-to-cart" class="msc-add">Add to Cart</a>
          <a href="cart.php" id="m-view-cart" class="msc-view" style="display:none;">View cart</a>
        </div>
      </div>

      <!-- DESKTOP / TABLET STICKY CART BAR -->
      <div class="desktop-sticky-cart" id="dStickyCart" aria-hidden="true">
        <div class="dsc-inner">
          <div class="dsc-left">
            <div class="dsc-label">Selected Variant</div>
            <div class="dsc-qty-wrap">
              <button type="button" class="dsc-btn dsc-minus" aria-label="Decrease quantity">−</button>
              <input type="text" id="d-qty" value="1" min="1" inputmode="numeric" />
              <button type="button" class="dsc-btn dsc-plus" aria-label="Increase quantity">+</button>
            </div>
          </div>

          <div class="dsc-middle">
            <div class="dsc-total" id="d-total">₹0.00</div>
            <small class="dsc-tax">Incl. all taxes</small>
          </div>

          <div class="dsc-right">
            <a href="#" id="d-add-to-cart" class="dsc-add">Add to Cart</a>
            <a href="cart.php" id="d-view-cart" class="dsc-view" style="display:none;">View cart</a>
          </div>
        </div>
      </div>

    </main> 

    <!-- tiny spacer before footer (belt & suspenders) -->
    <div style="height:24px; clear:both;"></div>
<!-- Desktop sticky cart -->
<style>
  .product-single-qty .bootstrap-touchspin .form-control {
    width:40px !important;
  }
  /* ===== Desktop / Tablet Sticky Cart Bar ===== */
  .desktop-sticky-cart {
    position: fixed;
    left: 0;
    right: 0;
    top: 99px;
    padding: 10px 20px;
    background: #ffffff;
    /* box-shadow: 0 -8px 20px rgba(0,0,0,.08); */
    border-top: 1px solid #ececec;
    z-index: 9998;
    transform: translateY(110%);
    transition: transform .3s ease, opacity .25s ease;
    opacity: 0;
  }

  /* visible state */
  .desktop-sticky-cart.is-visible {
    transform: translateY(0);
    opacity: 1;
  }

  .dsc-inner {
    max-width: 1180px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(0, 1fr) auto;
    gap: 16px;
    align-items: center;
  }

  /* left side (label + qty) */
  .dsc-left {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px 16px;
  }
  .dsc-label {
    font: 600 13px/1 "Open Sans", Arial, sans-serif;
    color: #4b5563;
    text-transform: uppercase;
  }
  .dsc-qty-wrap {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    /* border: 1px solid #e5e5e5; */
    border-radius: 10px;
    padding: 4px 6px;
    background: #fff;
  }
  .dsc-btn {
    width: 31px;
    height: 31px;
    border: 0;
    background: transparent;
    border-radius: 10px;
    font-size: 18px;
    line-height: 1;
    color: #005d5a;
    cursor: pointer;
    border: 1px solid #e7e7e7;
  }
  #d-qty {
    width: 40px;
    text-align: center;
    border: 0;
    background: transparent;
    font: 600 14px/1 "Open Sans", Arial, sans-serif;
    color: #111;
  }
  .product-single-qty .btn {
    width:31px;
    height:31px;
  }

  /* middle (total) */
  .dsc-middle {
    display: grid;
    justify-items: flex-start;
    line-height: 1.1;
  }
  .dsc-total {
    font-size: 4rem ;
    font-family: "Barlow Condensed", sans-serif;
    color: #005d5a;
    font-weight: 600;
  }
  .dsc-tax {
    color: #6b7280;
    font: 400 11px/1.2 "Open Sans", Arial, sans-serif;
  }

  /* right (buttons) */
  .dsc-right {
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }
  .dsc-add,
  .dsc-view {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    border-radius: 10px;
    text-decoration: none;
    font: 700 14px/1 "Open Sans", Arial, sans-serif;
    /* min-width: 120px; */
  }
  .dsc-add {
    background: #005d5a;
    color: #fff;
  }
  .dsc-view {
    background: #f7faf9;
    border: 1px solid #e9edf0;
    color: #005d5a;
  }

  /* Desktop / Tablet only – mobile par yeh bar band rakho */
  @media (max-width: 520px) {
    .desktop-sticky-cart {
      display: none !important;
    }
  }

</style>
<!-- mobile sticky cart btn -->
<style>
  /* ===== Mobile Sticky Cart Bar ===== */
  .mobile-sticky-cart {
    position: fixed;
    left: 0;
    right: 0;
    bottom: 58px;                                     /* sticks to bottom */
    padding: 8px max(10px, env(safe-area-inset-left)) calc(8px + env(safe-area-inset-bottom)) max(10px, env(safe-area-inset-right));
    background: #ffffff;
    box-shadow: 0 -10px 25px rgba(0,0,0,.08);
    border-top: 1px solid #ececec;
    z-index: 9999;
    transform: translateY(110%);
    transition: transform .35s ease, opacity .25s ease;
    opacity: 0;
  }
  .mobile-sticky-cart.is-visible {
    transform: translateY(0);
    opacity: 1;
  }

  /* layout inside bar */
  .msc-inner {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 10px;
    align-items: center;
  }

  /* qty controls */
  .msc-qty {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 4px 6px;
    background: #fff;
  }
  .msc-btn {
    width: 28px;
    height: 28px;
    border: 0;
    background: #f5f7f7;
    border-radius: 8px;
    font-size: 18px;
    line-height: 1;
    color: #005d5a;
  }
  #m-qty {
    width: 48px;
    text-align: center;
    border: 0;
    background: transparent;
    font: 600 14px/1 "Open Sans", Arial, sans-serif;
    color: #111;
  }

  /* total + buttons */
  .msc-total {
    display: grid;
    justify-items: start;
    line-height: 1.1;
  }
  .msc-total-main {
    font-size: 20px;
    font-family: "Barlow Condensed", sans-serif;
    color: #005d5a;
    font-weight: 600;
  }
  .msc-tax {
    color: #6b7280;
    font: 400 11px/1.2 "Open Sans", Arial, sans-serif;
  }

  .msc-add, .msc-view {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 14px;
    min-width: 120px;
    border-radius: 10px;
    text-decoration: none;
    font: 700 13px/1 "Open Sans", Arial, sans-serif;
  }
  .msc-add {
    background: #005d5a;
    color: #fff;
  }
  .msc-view {
    background: #f7faf9;
    border: 1px solid #e9edf0;
    color: #005d5a;
  }

  /* Only show on small screens */
  @media (min-width: 521px) {
    .mobile-sticky-cart { display: none; }
  }

  /* Make room so footer content isn't covered when bar is visible (mobile only) */
  @media (max-width: 520px) {
    body.has-mobile-cart-padding main.main {
      padding-bottom: 92px; /* ~bar height */
    }
  }
</style>

<style>
  /* ===== RELATED PRODUCTS ===== */
  .related-products {
    margin: auto;
  }
  .related-products .rp-title {
    margin: 0 0 14px;
    font-family: "Barlow Condensed", sans-serif;
    font-size: 30px;
    line-height: 1.1;
    color: #005d5a;
    font-weight: 600;
    text-transform: uppercase;
  }
  .rp-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 16px;
  }
  @media (min-width:768px){
    .rp-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
  }
  @media (min-width:1100px){
    .rp-grid { grid-template-columns: repeat(5, minmax(0, 1fr)); }
  }
  .rp-card {
    display: flex;
    flex-direction: column;
    border: 1px solid #ececec;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    transition: transform .15s ease, box-shadow .15s ease;
  }
  .rp-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 22px rgba(0,0,0,.06);
  }
  .rp-thumb {
    width: 100%;
    aspect-ratio: 1/1;
    background: #fff;
    display: block;
    object-fit: contain;
  }
  @supports not (aspect-ratio:1/1){
    .rp-thumb-wrap { position: relative; width: 100%; }
    .rp-thumb-wrap::before { content:""; display:block; padding-top:100%; }
    .rp-thumb { position:absolute; inset:0; width:100%; height:100%; }
  }
  .rp-body {
    padding: 10px 12px 12px;
    display: grid;
    gap: 6px;
  }
  .rp-name {
    font-family: "Barlow Condensed", sans-serif;
    font-weight: 600;
    font-size: 32px;
    line-height: 1;
    text-transform: uppercase;
    color: #CA5D27;
    margin: 6px 0 8px;
  }
  .rp-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-content: space-between;
  }
  .rp-price {
    font-size: 24px;
    font-family: 'Barlow Condensed';
    font-weight: 500 !important;
    line-height: 1;
    color: #005d5a;
    text-align: left;
  }
  .rp-mrp {
    color: #9aa3b2;
    font-size: 12px;
    text-decoration: line-through;
  }
  .rp-btn {
    margin-top: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    border-radius: 10px;
    border: 1px solid #e9edf0;
    color: #f7faf9;
    background-color: #005d5a;
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    width: fit-content;
  }
  .rp-btn:hover { color: #000000; }
  /* === Related Product Slider === */
  .related-products {
    position: relative;
    margin: 28px auto 48px;
  }
  .rp-slider {
    position: relative;
    overflow: hidden;
    width: 100%;
  }
  .rp-viewport {
    overflow: hidden;
    width: 100%;
  }
  .rp-track {
    display: flex;
    gap: 16px;
    transition: transform 0.4s ease;
    will-change: transform;
  }
  .rp-card {
    flex: 0 0 auto;
    width: 290px; /* card width in slider */
  }
  .rp-nav {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    width: 32px;
    height: 32px;
    border: none;
    background: rgba(255,255,255,0.8);
    color: #CA5D27;
    font-size: 22px;
    line-height: 1;
    cursor: pointer;
    z-index: 3;
    border-radius: 50%;
    box-shadow: 0 0 4px rgba(0,0,0,.1);
  }
  .rp-prev { left: -8px; }
  .rp-next { right: -8px; }
  .rp-nav:hover { background: #fff; }
  @media(max-width:520px){
    .rp-card { width: 160px; }
    .rp-name {
      font-family: "Barlow Condensed", sans-serif;
      font-size: 22px;
    }
    .rp-price {
      font-size: 25px;
    }
  }

</style>

<script>
	/* Sticky header offset */
	(function() {
		function setHeaderH() {
			var header = document.querySelector('.header-middle') || document.querySelector('header');
			var h = (header ? header.offsetHeight : 96) + 16;
			document.documentElement.style.setProperty('--headerH', h + 'px');
		}
		setHeaderH();
		window.addEventListener('resize', setHeaderH);
		document.addEventListener('readystatechange', setHeaderH);
	})(); 
</script>

<script>
	/* Product binding + gallery + variants + benefits style switch + FOOTER GUARD */
	document.addEventListener("DOMContentLoaded", function() {
		const params = new URLSearchParams(window.location.search);
		const productId = params.get('id');
		const variantIdFromUrl = params.get('v_id'); // Get the variant ID from the URL
		const token = localStorage.getItem('auth_token');
    let tempId = localStorage.getItem('temp_id');  // 👈 ADD THIS

		const addCartBtn = $('#add-to-cart-btn');
		const viewCartBtn = $('#view-cart-btn');
		const qtyInput = $('#quantity');
    const mQtyInput = $('#m-qty'); // mobile bar input (already exists in HTML)
    // 👇 NEW: cart awareness
    let cartItemsCache = [];
    let currentCartItemId = null;

		const priceShow = $('#selling-tprice');
		const priceMain = $('#product-price');
		const priceMRP = $('#regular-price');
    const shortDescription = $('#short-description');
    const fullDescription = $('#full-description');
    const readMoreLink = $('#read-more');
    const showLessLink = $('#show-less');
    const reducePercent = $('.reducePercent'); // Get the discount percentage element

    // ---------- CART STATUS HELPERS (product page) ----------
    function fetchCartStatus() {
        // if no auth/guest cart yet, nothing to do
        if (!token && !tempId) return;

        const body = token ? {} : { cart_id: tempId };

        $.ajax({
            url: "<?php echo BASE_URL; ?>/cart/fetch",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(body),
            headers: token ? { "Authorization": `Bearer ${token}` } : {},
            success: function (resp) {
                cartItemsCache = Array.isArray(resp.data) ? resp.data : [];
                syncCartStatusForSelected(); // update current variant if already selected
            },
            error: function (xhr) {
                console.warn("fetchCartStatus error", xhr);
            }
        });
    }
    function findCartRow(productId, variantId) {
        if (!Array.isArray(cartItemsCache)) return null;
        return cartItemsCache.find(function (item) {
            return Number(item.product_id) === Number(productId) &&
                   Number(item.variant_id) === Number(variantId);
        }) || null;
    }
    function syncCartStatusForSelected() {
        const vId = $('#selected-variant').val();

        // -------------------------------------
        // 1) Koi variant select hi nahi hai
        // -------------------------------------
        if (!vId) {
            currentCartItemId = null;

            // default qty = 1
            qtyInput.val(1);
            if (mQtyInput.length) {
                mQtyInput.val(1);
            }
            updateTotal();

            // Sirf ADD TO CART dikhana hai
            addCartBtn.show();
            viewCartBtn.hide();
            return;
        }

        // Try to find row in cart for this product + this variant
        const row = findCartRow(productId, vId);

        // -------------------------------------
        // 2) Variant NOT in cart
        // -------------------------------------
        if (!row) {
            currentCartItemId = null;

            // New variant -> fresh qty = 1
            qtyInput.val(1);
            if (mQtyInput.length) {
                mQtyInput.val(1);
            }
            updateTotal();

            // Add to Cart dikhana hai, View Cart hide
            addCartBtn.show();
            viewCartBtn.hide();
            return;
        }

        // -------------------------------------
        // 3) Variant IS in cart
        // -------------------------------------
        currentCartItemId = row.id;

        const q = Math.max(1, parseInt(row.quantity || '1', 10));
        qtyInput.val(q);
        if (mQtyInput.length) {
            mQtyInput.val(q);
        }

        updateTotal();

        // 👉 Yahan bas do cheeze:
        //    - Add to Cart hide
        //    - View Cart show
        addCartBtn.hide();
        viewCartBtn.show();
    }
    function updateCartQtyApi(newQty) {
        if (!currentCartItemId) return;
        if (!token && !tempId) return;

        const body = token ? { quantity: newQty }
                           : { cart_id: tempId, quantity: newQty };

        $.ajax({
            url: "<?php echo BASE_URL; ?>/cart/update/" + currentCartItemId,
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(body),
            headers: token ? { "Authorization": `Bearer ${token}` } : {},
            success: function (resp) {
                // you can console.log if needed
                // console.log("Qty updated from PDP", resp);
            },
            error: function (xhr) {
                console.warn("updateCartQtyApi error", xhr);
            }
        });
    }


    // Function to calculate discount percentage
    function calculateDiscountPercentage(regularPrice, sellingPrice) {
        if (regularPrice && sellingPrice) {
            const discount = ((regularPrice - sellingPrice) / regularPrice) * 100;
            const discountPercentage = discount.toFixed(2);

            // Hide the discount percentage if it's 0
            return discountPercentage === "0.00" ? "" : `-${discountPercentage}%`; 
        }
        return ""; // Return empty if there's no valid price to calculate discount
    }

    function handleDescription(description) {
      // Just use the full description (no trimming or toggling)
      const fullDesc = (description || '').trim();

      // Set the full description directly
      shortDescription.text(fullDesc);

      // Remove the read-more and show-less logic
      readMoreLink.hide();
      showLessLink.hide();
    }

		/* Footer guard: reveal and normalize positioning */
		(function footerGuard() {
			const f = document.querySelector('footer, .footer, #footer');
			if (f) {
				f.style.setProperty('display', 'block', 'important');
				f.style.setProperty('position', 'static', 'important');
				f.style.setProperty('visibility', 'visible', 'important');
				f.style.setProperty('overflow', 'visible', 'important');
				f.style.setProperty('height', 'auto', 'important');
				f.style.setProperty('max-height', 'none', 'important');
				// Ensure nothing overlays footer
				const blockers = document.querySelectorAll('.fixed-bar, .sticky-cta, .chat-widget, .cookie-bar');
				blockers.forEach(el => el.style.setProperty('z-index', '1', 'important'));
			}
		})();

		/* Optional: change benefits look with ?benefitsStyle=cards|line|compact */
		(function() {
			const el = document.getElementById('hx-benefits');
			if (!el) return;
			const desired = (el.getAttribute('data-style') || params.get('benefitsStyle') || '').toLowerCase();
			el.classList.remove('hx-style-line', 'hx-style-cards', 'hx-style-compact');
			if (desired === 'cards') el.classList.add('hx-style-cards');
			else if (desired === 'compact') el.classList.add('hx-style-compact');
			else el.classList.add('hx-style-line');
		})();

	
    function setGallery(items, videoUrl) {
      const gMain   = document.getElementById('gMain');
      const gThumbs = document.getElementById('gThumbs');
      const prevBtn = document.querySelector('.g-prev');
      const nextBtn = document.querySelector('.g-next');
      const galleryBox = document.querySelector('.gallery-main');

      gMain.innerHTML = '';
      gThumbs.innerHTML = '';

      // Normalize media list
      const media = [...(items || [])];
      if (videoUrl) media.push({ type: 'video', url: videoUrl });

      // If your API sometimes sends objects instead of plain strings,
      // normalize them here:
      const normalized = media.map(m => {
        if (typeof m === 'string') {
          return { type: 'image', url: m };
        }
        if (m && typeof m === 'object') {
          return {
            type: m.type === 'video' ? 'video' : 'image',
            url: m.url || ''
          };
        }
        return { type: 'image', url: '' };
      }).filter(m => m.url);

      let currentIndex = 0;

      function yt(url) {
        try {
          if (!url) return null;
          url = url.trim();

          // If it's already an embed URL, just return it
          if (url.includes('youtube.com/embed/')) {
            return url;
          }

          // youtu.be short links
          if (url.includes('youtu.be/')) {
            const id = url.split('youtu.be/')[1].split(/[?&]/)[0];
            return 'https://www.youtube.com/embed/' + id;
          }

          // Normal watch URL: ?v=XXXX
          if (url.includes('youtube.com/watch')) {
            const vPart = url.split('v=')[1];
            if (vPart) {
              const id = vPart.split('&')[0];
              return 'https://www.youtube.com/embed/' + id;
            }
          }

          // Shorts URL
          if (url.includes('youtube.com/shorts/')) {
            const id = url.split('youtube.com/shorts/')[1].split(/[?&]/)[0];
            return 'https://www.youtube.com/embed/' + id;
          }

          // Live URL (sometimes /live/ID)
          if (url.includes('youtube.com/live/')) {
            const id = url.split('youtube.com/live/')[1].split(/[?&]/)[0];
            return 'https://www.youtube.com/embed/' + id;
          }

          // If it's some other http(s) URL, try using directly as iframe src
          if (/^https?:\/\//i.test(url)) {
            return url;
          }

        } catch (e) {
          console.error('yt() parse error', e);
        }
        return null;
      }

      function show(i) {
        if (!normalized.length) return;
        if (i < 0) i = 0;
        if (i >= normalized.length) i = normalized.length - 1;
        currentIndex = i;

        const m = normalized[i];
        if (!m) return;

        if (m.type === 'video') {
          let iframeSrc = yt(m.url);
          if (galleryBox) galleryBox.classList.add('video-mode');

          if (iframeSrc) {
            // YouTube / iframe case
            gMain.innerHTML = `
              <div class="g-video-wrap">
                <iframe src="${iframeSrc}" frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen></iframe>
              </div>`;
          } else if (m.url.match(/\.(mp4|webm|ogg)(\?|$)/i)) {
            // Direct HTML5 video file
            gMain.innerHTML = `
              <div class="g-video-wrap">
                <video src="${m.url}" controls playsinline style="width:100%;height:100%;object-fit:contain;"></video>
              </div>`;
          } else {
            // Unknown format → at least don't blank it silently
            console.warn('Unsupported video URL format:', m.url);
            gMain.innerHTML = '';
          }
        } else {
          if (galleryBox) galleryBox.classList.remove('video-mode');
          gMain.innerHTML = `<img src="${m.url}" alt="">`;
        }
      }

      // Build thumbnails
      normalized.forEach((m, i) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.setAttribute('aria-label', 'View media ' + (i + 1));
        if (m.type === 'video') {
          btn.innerHTML = `<img src="images/video-thumb.png" alt="video">`;
        } else {
          btn.innerHTML = `<img src="${m.url}" alt="">`;
        }
        btn.addEventListener('click', () => show(i));
        gThumbs.appendChild(btn);
      });

      // Initial image
      if (normalized.length) {
        show(0);
      } else {
        gMain.innerHTML = '';
      }

      // Show/hide arrows if only one image
      function updateNavVisibility() {
        const visible = normalized.length > 1;
        if (prevBtn) prevBtn.style.display = visible ? '' : 'none';
        if (nextBtn) nextBtn.style.display = visible ? '' : 'none';
      }
      updateNavVisibility();

      // Wire prev / next arrows (overwrite old handlers each time setGallery runs)
      if (prevBtn) {
        prevBtn.onclick = function () {
          if (!normalized.length) return;
          currentIndex = (currentIndex - 1 + normalized.length) % normalized.length;
          show(currentIndex);
        };
      }

      if (nextBtn) {
        nextBtn.onclick = function () {
          if (!normalized.length) return;
          currentIndex = (currentIndex + 1) % normalized.length;
          show(currentIndex);
        };
      }
    }

		window.buildPoster = function buildPoster(banners) {
			const wrap = document.getElementById('posterStack');
			if (!wrap) return;

			// Clean + dedupe
			const list = (banners || [])
				.filter(Boolean)
				.filter(u => typeof u === 'string' && u.trim().length > 0)
				.filter((u, i, arr) => arr.indexOf(u) === i);

			if (!list.length) {
				wrap.innerHTML = "";
				wrap.hidden = true;
				return;
			}

			// Render (lazy + safe onerror fallback to a tiny transparent gif)
			const tiny = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
			wrap.innerHTML = list.map((src, idx) => (
				`<img src="${src}" alt="Product banner ${idx+1}" loading="lazy" decoding="async"
              onerror="this.onerror=null;this.src='${tiny}'">`
			)).join('');
			wrap.hidden = false;
		}

    // small slider below guide buttons.
    const FEATURES = [
      { icon: "images/turbo_mood.png",   text: "Turbo\nMode" },
      { icon: "images/Breeze_model.png",  text: "Breeze\nMode" },
      { icon: "images/Low_noise.png", text: "Low\nNoise" },
      { icon: "images/Timer_mode.png",   text: "Timer\nMode" },
      { icon: "images/Night_mode.png",  text: "Night\nMode" },
      { icon: "images/Sweep_mm.png",     text: "Sweep\n1320mm" },
      { icon: "images/Double_balt.png",  text: "Double\nBall bearing" },
      { icon: "images/Eco_mode.png",  text: "Eco\nMode" },
      { icon: "images/Forward_Reverse_mode.png",     text: "Forward/\nReverse Mode" },
      { icon: "images/3_in_1_led.png",    text: "3 in 1 LED\nOption" },
      { icon: "images/Easy_clean.png",text: "Easy\nClean" },
      { icon: "images/Study_ABS_blades.png", text: "Sturdy ABS\nBlades" }
    ];

    const track = document.getElementById("fsTrack");
    if (track) {
      // Build one set
      const makeItem = (it) => {
        const d = document.createElement("div");
        d.className = "fs-item";
        d.innerHTML =
          `<img class="fs-icon" src="${it.icon}" alt="" loading="lazy">
          <div class="fs-label">${it.text.replace(/\n/g,"<br>")}</div>`;
        return d;
      };

      FEATURES.forEach(f => track.appendChild(makeItem(f)));
      // Duplicate for seamless loop
      FEATURES.forEach(f => track.appendChild(makeItem(f)));

      // Auto-scroll (requestAnimationFrame; smoother than CSS-only for variable speeds)
      let rafId = null;
      let offset = 0;
      let speed = 0.5;              // px per frame; tweak to taste
      const viewport = track.parentElement;
      let halfWidth = 0;

      function measureHalf() {
        // width of the first half (12 items + gaps)
        // We can sum children until half
        let w = 0;
        for (let i = 0; i < FEATURES.length; i++) {
          const el = track.children[i];
          w += el.getBoundingClientRect().width;
          if (i < FEATURES.length - 1) w += parseFloat(getComputedStyle(track).gap || 0);
        }
        halfWidth = w;
      }

      function loop() {
        offset -= speed;
        // when passed half, reset
        if (Math.abs(offset) >= halfWidth) offset += halfWidth;
        track.style.transform = `translateX(${offset}px)`;
        rafId = requestAnimationFrame(loop);
      }

      // Start after layout
      requestAnimationFrame(() => {
        measureHalf();
        loop();
      });

      // Pause on hover / resume on leave
      track.closest(".fs").addEventListener("mouseenter", () => { cancelAnimationFrame(rafId); rafId = null; });
      track.closest(".fs").addEventListener("mouseleave", () => { if (!rafId) loop(); });

      // Buttons nudge left/right by a few items
      const STEP = 3; // items per click
      function nudge(dir) {
        // dir: -1 left, +1 right
        let w = 0;
        for (let i = 0; i < STEP; i++) {
          const el = track.children[i];
          w += (el ? el.getBoundingClientRect().width : 120) + parseFloat(getComputedStyle(track).gap || 0);
        }
        offset += dir * w;
        // normalize into [-halfWidth, 0)
        while (offset > 0) offset -= halfWidth;
        while (Math.abs(offset) >= halfWidth) offset += halfWidth;
        track.style.transform = `translateX(${offset}px)`;
      }

      const prevBtn = document.querySelector(".fs-prev");
      const nextBtn = document.querySelector(".fs-next");
      prevBtn?.addEventListener("click", () => nudge(+1));
      nextBtn?.addEventListener("click", () => nudge(-1));

      // Recompute on resize (item widths can change)
      window.addEventListener("resize", () => {
        const curr = offset; // keep visual position roughly stable
        measureHalf();
        offset = Math.max(-halfWidth + 1, Math.min(0, curr));
        track.style.transform = `translateX(${offset}px)`;
      });
    }

		window.updateVariant = function(el) {
			const $el = $(el);
			const variantId = $el.data("variant-id");
			const sellingPrice = parseFloat($el.data("selling-price") || 0);
			const regularPrice = parseFloat($el.data("regular-price") || 0);

			$('.variant-color-circle').removeClass('selected');
			$el.addClass('selected');
			$('#selected-variant').val(variantId);

			priceMRP.text(regularPrice ? '₹' + regularPrice.toFixed(2) : '—');
			priceMain.text('₹' + sellingPrice.toFixed(2));
			priceShow.attr('data-price', sellingPrice.toFixed(2)).text('₹' + sellingPrice.toFixed(2));

			const sel = (window.allVariants || []).find(v => v.id == variantId);
			if (sel) {
        // Gallery + posters
        setGallery(sel.file_urls || [], sel.video_url || '');
        buildPoster(sel.banner_urls || []);

        // ✅ Update the description for the selected variant
       const variantDesc = sel.description || "Default variant description";
       document.getElementById('variant-description').innerHTML = variantDesc.replace(/\n/g, "<br>");

        // ✅ Discount for this variant
        const discount = calculateDiscountPercentage(
          parseFloat(sel.regular_price || 0),
          parseFloat(sel.selling_price || 0)
        );
        reducePercent.text(discount || ""); // empty string if no discount

        // ✅ Description for this variant
        handleDescription(sel.description || '');
      }
			updateTotal();
      // 👇 NEW: after switching variant, see if this variant exists in cart
      syncCartStatusForSelected();
		};

		function updateTotal() {
			const qty = Math.max(1, parseInt(qtyInput.val() || '1', 10));
			const base = parseFloat(priceShow.attr('data-price') || '0') || 0;
			priceShow.text('₹' + (qty * base).toFixed(2));
		}

		function addToCart() {
			const variantId = $('#selected-variant').val();
			const qty = Math.max(1, parseInt(qtyInput.val() || '1', 10));
			if (!variantId) return;

			tempId = localStorage.getItem("temp_id") || tempId;

			const body = {
				product_id: productId,
				variant_id: variantId,
				quantity: qty,
				...(!token && tempId ? {
					cart_id: tempId
				} : {})
			};

			const opts = {
				url: "<?php echo BASE_URL; ?>/cart/add",
				type: "POST",
				contentType: "application/json",
				data: JSON.stringify(body),
				success: function(data) {
					if (data && (data.success || (data.message || '').includes('success'))) {
						addCartBtn.hide();
						viewCartBtn.show();
						// $('#cartId').hide();
						if (!token && !tempId && data.data && data.data.user_id) {
              tempId = data.data.user_id;  
							localStorage.setItem("temp_id", tempId);
						}
            // 👇 IMPORTANT: refresh cart info so currentCartItemId is set
            fetchCartStatus();
					} else {
						alert("Unable to add to cart.");
					}
				},
				error: function() {
					alert("Unable to add to cart.");
				}
			};
			if (token) opts.headers = {
				"Authorization": `Bearer ${token}`
			};
			$.ajax(opts);
		}

		function colorSwatches(variants) {
			const map = {
				"Denim Blue": "#6497B2",
        "Baby Pink": "#C7ABA9",
        "Pearl White": "#F5F5F5",
        "Matte Black": "#21201E",
        "Pine": "#DDC194",
        "Beige": "#E6E0D4",
        "Walnut": "#926148",
        "Sunset Copper": "#936053",
        "Royal Brass": "#B7A97C",
        "Regal Gold": "#D3B063",
        "Pure Steel": "#878782",
        "Metallic Grey": "#D4D4D4",
        "Sand Beige": "#D3CBBB",
        "Metallic Walnut": "#7F513F",
        "Espresso Walnut": "#926148",
        "Moonlit White": "#E6E6E6",
        "Natural Pine": "#DDC194",
        "Velvet Black": "#0B0A08"
			};
			return variants.map((v, i) => {
				const c = map[v.variant_value] || "#ccc";
				return '<div class="variant-color-circle' + (i === 0 ? ' selected' : '') + '" ' +
					'title="' + v.variant_value + '" data-variant-id="' + v.id + '" ' +
					'data-selling-price="' + v.selling_price + '" data-regular-price="' + v.regular_price + '" ' +
					'style="background-color:' + c + '"></div>';
			}).join('');
		}

		function setTitle(name) {
			const n = (name || 'Fengshui').trim();
			document.getElementById('product-title').textContent = (n).toUpperCase();
		}

    function setDescription(description) {
      const fullDesc = description || "Default product description if none exists";
      const shortDesc = fullDesc.slice(0, 600);  // Show a shortened version initially
      const descriptionElement = document.getElementById('product-description');
      
      // Set the initial short description with line breaks
      descriptionElement.innerHTML = shortDesc.replace(/\n/g, "<br>");

      // Show the full description if needed
      const readMoreLink = document.createElement('a');
      readMoreLink.href = "#";
      readMoreLink.textContent = "Read More";
      readMoreLink.style.display = "inline";

      const showLessLink = document.createElement('a');
      showLessLink.href = "#";
      showLessLink.textContent = "Show Less";
      showLessLink.style.display = "none";
      
      // Append "Read More" link after description
      descriptionElement.appendChild(readMoreLink);
      descriptionElement.appendChild(showLessLink);

      // Event listeners for read-more and show-less links
      readMoreLink.addEventListener('click', function (e) {
        e.preventDefault();
        descriptionElement.innerHTML = fullDesc.replace(/\n/g, "<br>");
        descriptionElement.appendChild(showLessLink);
        showLessLink.style.display = "inline";
        readMoreLink.style.display = "none";
      });

      showLessLink.addEventListener('click', function (e) {
        e.preventDefault();
        descriptionElement.innerHTML = shortDesc.replace(/\n/g, "<br>");
        descriptionElement.appendChild(readMoreLink);
        readMoreLink.style.display = "inline";
        showLessLink.style.display = "none";
      });
    }

    // Example usage with an API response (assuming p.description is the API response):
    // setDescription(p.description || '');

		if (productId) {
			$.ajax({
				url: "<?php echo BASE_URL; ?>/products/get_products/" + productId,
				type: "POST",
				headers: token ? {
					"Authorization": `Bearer ${token}`
				} : {},
				success: function(data) {
					if (!data || !data.success) {
						buildSpecsFromFeatures();
						return;
					}
					const p = data.data;
					setTitle(p.name || '');
					setDescription(p.description || '');
					$('#product-category').text(p.category || 'Ceiling Fan');
					$('.breadcrumb-title').text(p.name || 'Product');

          // ✅ ADD THIS
          loadRelated((p.category || '').toString().trim(), productId);
					buildSpecsFromFeatures(p.features || []);

					if (p.variants && p.variants.length) {
						window.allVariants = p.variants;
						$('.variants').html(colorSwatches(p.variants));

            // 🟢 ALWAYS fetch cart first (if token/temp_id exist)
            fetchCartStatus();
						// Check if the `v_id` matches any variant and set it as selected
						const selectedVariant = p.variants.find(v => v.id === parseInt(variantIdFromUrl));
						if (selectedVariant) {
              const circle = $('.variant-color-circle[data-variant-id="' + selectedVariant.id + '"]')[0];
              if (circle) {
                updateVariant(circle); // updateVariant will handle discount + description
              }
            } else {
              const first = $('.variant-color-circle').first()[0];
              if (first) {
                updateVariant(first); // updateVariant will handle discount + description
              }
            }
          }
				},
				error: function() {
					buildSpecsFromFeatures();
				}
			});
		} else {
			setTitle('');
			setDescription('');
			buildSpecsFromFeatures();
		} 
    

		$(document).on('click', '.variant-color-circle', function() {
			updateVariant(this);
		});
		$('#add-to-cart-btn').on('click', function(e) {
			e.preventDefault();
			addToCart();
		});
		$('#quantity').on('change', function() {
			const v = Math.max(1, parseInt(this.value || '1', 10));
			this.value = v;
			const base = parseFloat(priceShow.attr('data-price') || '0') || 0;
			priceShow.text('₹' + (v * base).toFixed(2));

      // 👇 NEW: if this variant already exists in cart, update via API
      if (currentCartItemId && (token || tempId)) {
          updateCartQtyApi(v);
      }
		});
	}); 
</script>

<script>
	function buildSpecsFromFeatures(features) {
		const table = document.getElementById("spec-table");
		table.innerHTML = "";

		// guard: nothing to render
		if (!Array.isArray(features) || features.length === 0) {
			// optional: leave empty or show a placeholder row
			table.innerHTML = '<tr><td>No technical specifications available.</td></tr>';
			return;
		}

		// 1) Normalize + dedupe by feature_name (keep the last non-empty value)
		const map = new Map();
		for (const f of features) {
			if (!f) continue;
			const rawName = (f.feature_name ?? "").toString().trim();
			const rawValue = (f.feature_value ?? "").toString().replace(/\r?\n/g, " ").trim();
			if (!rawName || !rawValue) continue;
			map.set(rawName, rawValue); // last one wins (handles duplicates like "Material", "Warranty")
		}

		// 2) Convert to array of {label, value}
		const rows = Array.from(map.entries()).map(([label, value]) => ({
			label,
			value
		}));

		const priority = [
			"Sweep Size",
			"Power Consumption",
			"RPM / Air Delivery",
			"Motor Type",
			"Control",
			"Lighting",
			"Material",
			"Warranty",
			"Weight",
			"Country of Origin"
		];
		// Stable sort: items in `priority` first, in the given order; others keep their original order
		rows.sort((a, b) => {
			const ia = priority.indexOf(a.label);
			const ib = priority.indexOf(b.label);
			if (ia === -1 && ib === -1) return 0;
			if (ia === -1) return 1;
			if (ib === -1) return -1;
			return ia - ib;
		});

		// 3) Render in two columns per row: [Label | Value] [Label | Value]
		for (let i = 0; i < rows.length; i += 2) {
			const tr = document.createElement("tr");

			const th1 = document.createElement("th");
			th1.textContent = rows[i].label;
			const td1 = document.createElement("td");
			td1.textContent = rows[i].value;
			tr.appendChild(th1);
			tr.appendChild(td1);

			if (rows[i + 1]) {
				const th2 = document.createElement("th");
				th2.textContent = rows[i + 1].label;
				const td2 = document.createElement("td");
				td2.textContent = rows[i + 1].value;
				tr.appendChild(th2);
				tr.appendChild(td2);
			}

			table.appendChild(tr);
		}
	} 
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const posterStack  = document.getElementById('posterStack');
    const faqSection   = document.getElementById('faq');
    const specsSection = document.querySelector('.product-specs-full');

    if (!posterStack || !faqSection) return;

    // Remember original spot (left column, below thumbnails)
    const originalParent = posterStack.parentNode;
    const originalNext   = posterStack.nextElementSibling; // may be null

    // Mobile means ≤520px
    const mql = window.matchMedia('(max-width:520px)');

    function hasRealContent(el) {
      const rect = el.getBoundingClientRect();
      return el.hidden === false &&
             el.innerHTML.trim().length > 0 &&
             (rect.width > 0 || rect.height > 0);
    }

    function relocatePoster() {
      const hasContent = hasRealContent(posterStack);

      if (mql.matches && hasContent) {
        // 👉 MOBILE: show posterStack *before* Technical Specs
        if (specsSection) {
          const needsMove =
            posterStack.parentNode !== specsSection.parentNode ||
            posterStack.nextElementSibling !== specsSection;

          if (needsMove) {
            specsSection.parentNode.insertBefore(posterStack, specsSection);
          }
        } else {
          // Fallback: old behavior (before FAQ) if specs section not found
          if (posterStack.nextElementSibling !== faqSection &&
              posterStack.previousElementSibling !== faqSection) {
            faqSection.parentNode.insertBefore(posterStack, faqSection);
          }
        }
      } else {
        // DESKTOP or no content: restore to original (left column)
        if (posterStack.parentNode !== originalParent) {
          if (originalNext) originalParent.insertBefore(posterStack, originalNext);
          else originalParent.appendChild(posterStack);
        }
      }
    }

    // Run now and on viewport changes
    relocatePoster();
    mql.addEventListener('change', relocatePoster);
    window.addEventListener('resize', relocatePoster);

    // Re-run whenever poster content/visibility changes
    const obs = new MutationObserver(relocatePoster);
    obs.observe(posterStack, {
      childList: true,
      subtree: true,
      attributes: true,
      attributeFilter: ['hidden', 'style', 'class']
    });

    // Hook buildPoster so we relocate right after banners are built
    if (typeof window.buildPoster === 'function') {
      const _buildPoster = window.buildPoster;
      window.buildPoster = function (...args) {
        const r = _buildPoster.apply(this, args);
        setTimeout(relocatePoster, 0);
        return r;
      };
    }
  });
</script>

<!-- stycky cart btn -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var bar        = document.getElementById('mStickyCart');
    if (!bar) return;

    var mainQty    = document.getElementById('quantity');          // existing qty
    var barQty     = document.getElementById('m-qty');
    var addBtn     = document.getElementById('m-add-to-cart');
    var viewBtn    = document.getElementById('m-view-cart');
    var mainAddBtn = document.getElementById('add-to-cart-btn');    // existing add button
    var mainViewBtn= document.getElementById('view-cart-btn');      // existing view btn
    var priceShow  = document.getElementById('selling-tprice');     // holds data-price
    var totalLbl   = document.getElementById('m-total');

    // --- Helpers ---
    function parseNum(x){ return Math.max(1, parseInt(String(x || '1').replace(/[^\d]/g,''), 10) || 1); }
    function formatINR(n){
      try { return new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR', maximumFractionDigits: 2 }).format(n); }
      catch(e){ return '₹' + (n || 0).toFixed(2); }
    }
    function basePrice(){
      var bp = parseFloat((priceShow && priceShow.getAttribute('data-price')) || '0') || 0;
      return bp;
    }
    function updateTotals(){
      var qty = parseNum(barQty.value);
      var total = qty * basePrice();
      totalLbl.textContent = formatINR(total);
    }
    function syncFromMain(){
      if (mainQty) barQty.value = parseNum(mainQty.value);
      updateTotals();
    }
    function syncToMain(){
      if (mainQty){ 
        mainQty.value = parseNum(barQty.value);
        // trigger the same update logic you have
        mainQty.dispatchEvent(new Event('change', { bubbles: true }));
      }
      updateTotals();
    }
    // initial sync (after your product loads updates data-price)
    setTimeout(syncFromMain, 50);

    // keep in sync when main quantity changes
    if (mainQty){
      mainQty.addEventListener('change', syncFromMain);
      mainQty.addEventListener('input',  syncFromMain);
    }

    // bar qty handlers
    barQty.addEventListener('input',  syncToMain);
    barQty.addEventListener('change', syncToMain);
    bar.querySelector('.msc-minus').addEventListener('click', function(){
      barQty.value = Math.max(1, parseNum(barQty.value) - 1);
      syncToMain();
    });
    bar.querySelector('.msc-plus').addEventListener('click', function(){
      barQty.value = parseNum(barQty.value) + 1;
      syncToMain();
    });

    // Add to cart: reuse your existing click handler
    addBtn.addEventListener('click', function(e){
      e.preventDefault();
      if (mainAddBtn){
        mainAddBtn.click();
        // mirror view state a moment later (after ajax)
        setTimeout(function(){
          if (mainViewBtn && getComputedStyle(mainViewBtn).display !== 'none') {
            addBtn.style.display = 'none';
            viewBtn.style.display = '';
          }
        }, 600);
      }
    });

    // Also mirror when your main code switches to "View cart"
    var mirrorViewState = new MutationObserver(function(){
      if (!mainViewBtn) return;
      var visible = getComputedStyle(mainViewBtn).display !== 'none';
      addBtn.style.display  = visible ? 'none' : '';
      viewBtn.style.display = visible ? '' : 'none';
    });
    if (mainViewBtn) {
      mirrorViewState.observe(mainViewBtn, { attributes: true, attributeFilter: ['style', 'class'] });
    }

    // --- Show/Hide after 110vh from top + near-bottom (mobile only) ---
    var ticking = false;

    // px threshold = 150 * viewport height (vh)
    function thresholdPx() {
      var vh = window.innerHeight || document.documentElement.clientHeight || 0;
      return Math.round(vh * 1.1); // 110vh
    }

    // always show if we are close to page bottom
    var bottomBuffer = 160; // px from bottom where bar must be visible

    function getScrollData() {
      var doc = document.documentElement, body = document.body;
      var y    = window.scrollY || doc.scrollTop || body.scrollTop || 0;
      var winH = window.innerHeight || doc.clientHeight;
      var docH = Math.max(
        body.scrollHeight, body.offsetHeight, body.clientHeight,
        doc.scrollHeight,  doc.offsetHeight,  doc.clientHeight
      );
      return { y, winH, docH };
    }

    function setBarVisible(isVisible) {
      if (isVisible) {
        bar.classList.add('is-visible');
        document.body.classList.add('has-mobile-cart-padding');
      } else {
        bar.classList.remove('is-visible');
        document.body.classList.remove('has-mobile-cart-padding');
      }
    }

    function onScroll() {
      // keep logic aligned with your CSS mobile breakpoint (<=520px)
      if ((window.innerWidth || 0) > 520) {
        setBarVisible(false);
        ticking = false;
        return;
      }

      var s = getScrollData();
      var pastThreshold = s.y > thresholdPx();
      var nearBottom    = (s.y + s.winH) >= (s.docH - bottomBuffer);

      // show only if scrolled beyond 150vh OR near bottom
      setBarVisible(pastThreshold || nearBottom);

      ticking = false;
    }

    // run once on load (handles reloads mid-page)
    onScroll();

    window.addEventListener('scroll', function () {
      if (!ticking) {
        window.requestAnimationFrame(onScroll);
        ticking = true;
      }
    }, { passive: true });

    window.addEventListener('resize', onScroll, { passive: true });



    // Recompute totals when price base changes (e.g., variant switch)
    var priceObsTarget = document.getElementById('product-price');
    var priceObs = new MutationObserver(function(){ setTimeout(updateTotals, 0); });
    if (priceObsTarget) priceObs.observe(priceObsTarget, { childList: true, characterData: true, subtree: true });

    // Also update after variant changes (your code calls updateVariant + sets data-price)
    document.addEventListener('click', function(e){
      if (e.target && e.target.classList && e.target.classList.contains('variant-color-circle')){
        setTimeout(function(){ syncFromMain(); }, 0);
      }
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var bar         = document.getElementById('dStickyCart');
    if (!bar) return;

    var mainQty     = document.getElementById('quantity');        // existing qty
    var mainAddBtn  = document.getElementById('add-to-cart-btn'); // existing Add button
    var mainViewBtn = document.getElementById('view-cart-btn');   // existing View button
    var priceShow   = document.getElementById('selling-tprice');  // holds data-price

    var dQty        = document.getElementById('d-qty');
    var dAddBtn     = document.getElementById('d-add-to-cart');
    var dViewBtn    = document.getElementById('d-view-cart');
    var dTotal      = document.getElementById('d-total');

    if (!dQty || !dAddBtn || !dViewBtn || !dTotal) return;

    function isDesktop() {
      return (window.innerWidth || 0) > 520;  // align with your mobile breakpoint
    }

    // ---- helpers ----
    function parseNum(x) {
      return Math.max(1, parseInt(String(x || '1').replace(/[^\d]/g,''), 10) || 1);
    }
    function basePrice() {
      var bp = parseFloat((priceShow && priceShow.getAttribute('data-price')) || '0') || 0;
      return bp;
    }
    function formatINR(n) {
      try {
        return new Intl.NumberFormat('en-IN', {
          style: 'currency',
          currency: 'INR',
          maximumFractionDigits: 2
        }).format(n);
      } catch(e) {
        return '₹' + (n || 0).toFixed(2);
      }
    }
    function updateTotals() {
      var q = parseNum(dQty.value);
      var total = q * basePrice();
      dTotal.textContent = formatINR(total);
    }

    function syncFromMain() {
      if (mainQty) dQty.value = parseNum(mainQty.value);
      updateTotals();
    }
    function syncToMain() {
      if (mainQty) {
        mainQty.value = parseNum(dQty.value);
        // trigger your existing change logic (which also updates API if needed)
        mainQty.dispatchEvent(new Event('change', { bubbles: true }));
      }
      updateTotals();
    }

    // Initial sync (after product / variant load)
    setTimeout(syncFromMain, 80);

    // Keep in sync if user changes original qty field
    if (mainQty) {
      mainQty.addEventListener('change', syncFromMain);
      mainQty.addEventListener('input',  syncFromMain);
    }

    // Desktop bar qty handlers
    dQty.addEventListener('input',  syncToMain);
    dQty.addEventListener('change', syncToMain);

    var minusBtn = bar.querySelector('.dsc-minus');
    var plusBtn  = bar.querySelector('.dsc-plus');

    if (minusBtn) {
      minusBtn.addEventListener('click', function () {
        dQty.value = Math.max(1, parseNum(dQty.value) - 1);
        syncToMain();
      });
    }
    if (plusBtn) {
      plusBtn.addEventListener('click', function () {
        dQty.value = parseNum(dQty.value) + 1;
        syncToMain();
      });
    }

    // Add To Cart – reuse existing handler
    dAddBtn.addEventListener('click', function (e) {
      e.preventDefault();
      if (mainAddBtn) {
        mainAddBtn.click(); // triggers your existing ajax addToCart
        // Mirror state after ajax completes
        setTimeout(function () {
          if (mainViewBtn && getComputedStyle(mainViewBtn).display !== 'none') {
            dAddBtn.style.display  = 'none';
            dViewBtn.style.display = '';
          }
        }, 600);
      }
    });

    // Mirror "View cart" state (if main button toggles)
    if (mainViewBtn) {
      var obs = new MutationObserver(function () {
        var visible = getComputedStyle(mainViewBtn).display !== 'none';
        dAddBtn.style.display  = visible ? 'none' : '';
        dViewBtn.style.display = visible ? '' : 'none';
      });
      obs.observe(mainViewBtn, { attributes: true, attributeFilter: ['style', 'class'] });
    }

    // ---- Scroll logic: show bar only when product-action area upar chala jaye ----
    function setBarVisible(isVisible) {
      if (isVisible && isDesktop()) {
        bar.classList.add('is-visible');
      } else {
        bar.classList.remove('is-visible');
      }
    }

    function handleScroll() {
      if (!isDesktop()) {
        setBarVisible(false);
        return;
      }
      var section = document.querySelector('.product-action');
      if (!section) return;

      var rect = section.getBoundingClientRect();
      // jab complete product-action block viewport ke upar chala jaye
      var isAbove = rect.bottom <= 0;
      setBarVisible(isAbove);
    }

    // run once
    setTimeout(handleScroll, 200);

    window.addEventListener('scroll', handleScroll, { passive: true });
    window.addEventListener('resize', handleScroll, { passive: true });

    // Total ko update karo jab price change ho (variant change etc.)
    var priceObsTarget = document.getElementById('product-price');
    if (priceObsTarget) {
      var priceObs = new MutationObserver(function () {
        setTimeout(updateTotals, 0);
        setTimeout(syncFromMain, 0);
      });
      priceObs.observe(priceObsTarget, { childList: true, characterData: true, subtree: true });
    }
  });
</script>


<!-- related producct section -->
<script>
  // Helpers for prices & images
  function parsePriceToNumber(val) {
    if (val === null || val === undefined) return 0;
    // Keep digits and dot only (handles "5,474" -> "5474")
    const n = String(val).replace(/[^0-9.]/g, "");
    return Number(n) || 0;
  }
  function formatINR(n) {
    try {
      return new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR', maximumFractionDigits: 2 }).format(n);
    } catch(e) {
      return '₹' + (n || 0).toFixed(2);
    }
  }
  function getFirstImage(p) {
    try {
      const v0 = (p.variants && p.variants[0]) ? p.variants[0] : null;
      const u0 = v0 && Array.isArray(v0.file_urls) && v0.file_urls[0] ? v0.file_urls[0] : null;
      return u0 || 'images/placeholder-1x1.png';
    } catch(e) {
      return 'images/placeholder-1x1.png';
    }
  }
  function getMinPrices(variants) {
    if (!Array.isArray(variants) || !variants.length) return { sell: 0, mrp: 0 };
    let minSell = Infinity, minMRP = Infinity;
    variants.forEach(v => {
      const sp = parsePriceToNumber(v.selling_price);
      const rp = parsePriceToNumber(v.regular_price);
      if (sp > 0 && sp < minSell) minSell = sp;
      if (rp > 0 && rp < minMRP) minMRP = rp;
    });
    if (!isFinite(minSell)) minSell = 0;
    if (!isFinite(minMRP)) minMRP = 0;
    return { sell: minSell, mrp: minMRP };
  }
  function makeProductUrl(id) {
    // Keep user on same page file, only change query param
    const basePath = window.location.pathname.replace(/#.*$/, "");
    return `${basePath}?id=${encodeURIComponent(id)}`;
  }
  function getVariantImage(v) {
    try {
      const u0 = Array.isArray(v.file_urls) && v.file_urls[0] ? v.file_urls[0] : null;
      return u0 || 'images/placeholder-1x1.png';
    } catch(e) {
      return 'images/placeholder-1x1.png';
    }
  }
  // Fetch & render related by category (exclude current product)
  function loadRelated(categoryName, excludeId) {
    if (!categoryName) return;
    const token = localStorage.getItem('auth_token');
    const opts = {
      url: "<?php echo BASE_URL; ?>/products/get_products",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify({ search_category: String(categoryName).toUpperCase() }),
      success: function(resp) {
        try {
          const list = (resp && resp.data) ? resp.data : [];
          // exclude current product, then explode into variants
          const products = list.filter(p => Number(p.id) !== Number(excludeId));
          const variantCards = [];
          products.forEach(p => {
            if (Array.isArray(p.variants) && p.variants.length) {
              p.variants.forEach(v => {
                variantCards.push(buildVariantCard(p, v));
              });
            }
          });

          const grid = document.getElementById('relatedGrid');
          const wrap = document.getElementById('related-products');
          if (!grid || !wrap) return;

          if (!variantCards.length) {
            wrap.hidden = true;
            grid.innerHTML = "";
            return;
          }
          // render ALL variants (remove slice); if you want a cap: .slice(0, 10)
          grid.innerHTML = variantCards.join("");
          // === Initialize horizontal slider ===
          const track = document.getElementById("relatedGrid");
          let offset = 0;
          const step = 240; // pixel shift per click

          function move(dir){
            const maxScroll = track.scrollWidth - track.clientWidth;
            offset += dir * step;
            if (offset < 0) offset = 0;
            if (offset > maxScroll) offset = maxScroll;
            track.style.transform = `translateX(${-offset}px)`;
          }

          document.querySelector(".rp-prev")?.addEventListener("click", ()=>move(-1));
          document.querySelector(".rp-next")?.addEventListener("click", ()=>move(+1));

          wrap.hidden = false;
        } catch(e) {
          // keep section hidden on render error
        }
      },
      error: function() {
        // keep section hidden on error
      }
    };
    if (token) opts.headers = { "Authorization": `Bearer ${token}` };
    $.ajax(opts);
  }
</script>
<script>
  const COLOR_MAP = {
    "Denim Blue": "#6497B2",
    "Baby Pink": "#C7ABA9",
    "Pearl White": "#F5F5F5",
    "Matte Black": "#21201E",
    "Pine": "#DDC194",
    "Beige": "#E6E0D4",
    "Walnut": "#926148",
    "Sunset Copper": "#936053",
    "Royal Brass": "#B7A97C",
    "Regal Gold": "#D3B063",
    "Pure Steel": "#878782",
    "Metallic Grey": "#D4D4D4",
    "Sand Beige": "#D3CBBB",
    "Metallic Walnut": "#7F513F",
    "Espresso Walnut": "#926148",
    "Moonlit White": "#E6E6E6",
    "Natural Pine": "#DDC194",
    "Velvet Black": "#0B0A08"
  };
</script>
<script>
  function firstVariant(p){
    return (Array.isArray(p.variants) && p.variants.length) ? p.variants[0] : null;
  }
  function firstVariantUrl(p){
    const v = firstVariant(p);
    return v ? `product_detail?id=${encodeURIComponent(p.id)}&v_id=${encodeURIComponent(v.id)}` 
             : `product_detail?id=${encodeURIComponent(p.id)}`;
  }
  function shortText(s, n=140){
    s = (s || '').trim();
    return s.length > n ? s.slice(0, n-1) + '…' : s;
  }
  function buildVariantSwatches(p){
    if (!Array.isArray(p.variants)) return '';
    return `
      <div class="rp-swatches" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:8px;">
        ${p.variants.map(v=>{
          const label = (v.variant_value || '').trim();
          const color = COLOR_MAP[label] || '#ccc';
          const href  = `product_detail?id=${encodeURIComponent(p.id)}&v_id=${encodeURIComponent(v.id)}`;
          return `
            <a href="${href}" title="${label}" aria-label="${label}"
               style="width:22px;height:22px;border-radius:4px;border:1px solid #ddd;display:inline-block;box-shadow:inset 0 0 0 2px rgba(255,255,255,.7);background:${color}"></a>
          `;
        }).join('')}
      </div>
    `;
  }
  function buildVariantCard(p, v) {
    const img = getVariantImage(v);
    const sell = parsePriceToNumber(v.selling_price);
    const mrp  = parsePriceToNumber(v.regular_price);
    const detailUrl = `product_detail?id=${encodeURIComponent(p.id)}&v_id=${encodeURIComponent(v.id)}`;

    // optional color chip for the variant (keeps the look from your screenshot)
    const label = (v.variant_value || '').trim();
    const chipColor = COLOR_MAP[label] || '#ccc';

    return `
      <article class="rp-card">
        <a class="rp-thumb-wrap" href="${detailUrl}" aria-label="${(p.name||'Product')} - ${label}">
          <img class="rp-thumb" src="${img}" alt="${(p.name||'Product')} - ${label}" loading="lazy" decoding="async"
              onerror="this.onerror=null;this.src='images/placeholder-1x1.png'">
        </a>
        <div class="rp-body">
          <div class="rp-name">${(p.name || '').trim()}</div>
          <div class="rp-copy" style="color:#4b5563;font:400 13px/1.4 'Open Sans', Arial, sans-serif;">
            ${shortText(p.description || '')}
          </div>

          <div style="display:flex;align-items:center;gap:10px;margin-top:6px;">
            <span title="${label}" aria-label="${label}"
                  style="width:28px;height:28px;border-radius:999px;border:1px solid #ddd;display:inline-block;box-shadow:inset 0 0 0 2px rgba(255,255,255,.7);background:${chipColor}"></span>
            <span style="font:600 12px/1 'Open Sans', Arial, sans-serif;color:#555;">${label || ''}</span>
          </div>

          <div class="rp-meta" style="margin-top:6px;display:flex;align-items:baseline;gap:8px;">
            <div class="rp-price">${formatINR(sell)}</div>
            ${mrp && mrp > sell ? `<div class="rp-mrp">${formatINR(mrp)}</div>` : ``}
          </div>

          <a class="rp-btn" href="${detailUrl}" style="margin-top:10px;">Add To Cart</a>
        </div>
      </article>
    `;
  }
</script>

<style>
  .product-single-qty .btn.btn-outline {
    border-color: #e7e7e7;
    border-radius: 10px !important;
  }
  .btn-primary_light {
    border-color: #005d5a;
    background-color: #005d5a;
    color: #fff;
    box-shadow: none;
    border-radius: 10px;
    padding: 12px 20px;
  }
    .full-description p{
    text-align: justify;
    margin-right: 55px;
    margin-bottom: 0px;
    }
    .reg_pricex{
    align-items: center;
    justify-content: flex-start;
    display: flex;
    }
    .mrp {
    font-size: 1.4rem !important;
    }
    .reg_price_n_tax{
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 20px;
    }
    .in-ex {
        display: block;
        margin-top: 0px;
    }
    .new-price{
    font-size: 4.4rem !important;
    color:#005d5a;
    }
    .reducePercent{
    font-size: 24px;
    color: #CA5D27;
    font-weight: 400;
    }
    #selling-tprice{
      display:none;
    }
</style>
<style>
  /* =========================================
   TABLET & SMALL-LAPTOP FIXES (768–1100px)
   ========================================= */
  @media (min-width:750px) and (max-width:1000px) {

    .related-products {
      margin: 15px auto 15px;
      padding-bottom: 0rem;
    }
    /* Grid: show two columns with a bit more room for the gallery */
    .prod-grid {
      grid-template-columns: 50% 46%;
      gap: 15px;
      padding-top: 14px;
    }

    /* Gallery: scale by viewport; avoid giant fixed heights */
    .gallery-main {
      /* never shorter than 380px, usually ~52vw tall, max 560px */
      height: clamp(380px, 52vw, 560px);
      min-height: unset;
    }

    /* Make images fully visible without cropping on tablets */
    .gallery-main img {
      object-fit: contain;
      margin: 0;              /* remove side margins that caused clipping */
      height: 100%;
      width: 100%;
    }

    /* Tighter thumbs grid so they fit on tablets */
    .thumbs {
      grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
      gap: 8px;
    }

    /* Sidebar: turn off "tall sticky" so it doesn't overlap content */
    #colRight {
      position: sticky;
      top: var(--headerH, 112px);
      align-self: start;
      z-index: 5;
      /* max-height: calc(100vh - var(--headerH, 112px)); */
      height: 92vh !important;
      /* overflow: auto; */
    }

    /* Pricing headline a bit smaller to avoid wrapping/pushdown */
    .new-price {
      font-size: 3.2rem !important;
    }

    /* Reduce headline size so it doesn’t overflow in 42% column */
    .title-hero {
      font-size: 26px;
    }

    /* Benefits strip: let three tiles breathe */
    .hx-benefits-strip {
      grid-template-columns: repeat(3, minmax(140px, 1fr));
      gap: 16px;
    }

    /* Specs container: reduce side padding so table fits */
    .product-specs-full .specs-inner {
      padding: 0 10px;
    }

    /* Related product cards a tad narrower so more fit in view */
    .rp-card { width: 200px; }
  }
  /* === Video mode: make iframe fill the gallery box like images === */
  /* Make #gMain fill the entire gallery area */
  .gallery-main #gMain {
    width: 100%;
    height: 100%;              /* KEY FIX — gives video real height */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* Video wrapper uses full available space */
  .gallery-main .g-video-wrap {
    position: relative;
    width: 100%;
    height: 100%;              /* now it actually has height */
    overflow: hidden;          /* keeps iframe clean */
  }

  /* Iframe fills the wrapper like an image */
  .gallery-main .g-video-wrap iframe {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }


  /* =========================================
    WIDER DESKTOP TWEAK (only > 1200px)
    Keep mobile/tablet logic intact; apply desktop spacing
    ========================================= */
  @media (min-width:1001px) {
    .prod-grid {
      grid-template-columns: 55% 45%;
      gap: 56px;
    }
    /* Restore sticky only where we have vertical room */
    #colRight {
      position: sticky;
      top: var(--headerH, 112px);
      height: 105vh;           /* let content decide height */
      max-height: 100%;
      /* overflow: auto; */
    }
  }
</style>
  <?php include "footer.php"; ?>
  </div>
</main>