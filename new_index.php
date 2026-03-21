<?php include("header.php"); ?>

<!-- Category section  -->
<main class="main">
  <?php //include("inc_files/top_slider.php"); ?>

  <div class="container">
    <!-- Featured Products section -->
    <?php include("inc_files/featured_products.php"); ?>
    <?php //include("inc_files/video_section.php"); ?>

    <!-- =========================
             Steel Fan Vimeo Slider (clean, looping, no UI)
        ========================== -->
    <section class="steel-hero">
      <h2 class="heading_1">Introducing India’s First Stainless Steel Ceiling Fan</h2>

      <div class="steel-slider owl-carousel owl-theme">
        <!-- Slide 1 (was Slide 6) -->
        <div class="steel-slide">
          <div class="steel-vid-wrap">
            <div style="padding:42.19% 0 0 0;position:relative;">
              <iframe
                src="https://player.vimeo.com/video/1127430705?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
                frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin"
                style="position:absolute;top:0;left:0;width:100%;height:100%;" title="rock one 1.2x"></iframe>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="steel-slide">
          <div class="steel-vid-wrap">
            <div style="padding:42.19% 0 0 0;position:relative;">
              <iframe
                src="https://player.vimeo.com/video/1127430579?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
                frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin"
                style="position:absolute;top:0;left:0;width:100%;height:100%;" title="blowup shot"></iframe>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="steel-slide">
          <div class="steel-vid-wrap">
            <div style="padding:42.19% 0 0 0;position:relative;">
              <iframe
                src="https://player.vimeo.com/video/1127430600?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
                frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin"
                style="position:absolute;top:0;left:0;width:100%;height:100%;" title="180 rotate shot"></iframe>
            </div>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="steel-slide">
          <div class="steel-vid-wrap">
            <div style="padding:42.19% 0 0 0;position:relative;">
              <iframe
                src="https://player.vimeo.com/video/1127430626?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
                frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin"
                style="position:absolute;top:0;left:0;width:100%;height:100%;"
                title="transparent motor working shot 1.2x"></iframe>
            </div>
          </div>
        </div>

        <!-- Slide 5 -->
        <div class="steel-slide">
          <div class="steel-vid-wrap">
            <div style="padding:42.19% 0 0 0;position:relative;">
              <iframe
                src="https://player.vimeo.com/video/1127430662?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
                frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin"
                style="position:absolute;top:0;left:0;width:100%;height:100%;" title="dark shot"></iframe>
            </div>
          </div>
        </div>

        <!-- Slide 6 -->
        <div class="steel-slide">
          <div class="steel-vid-wrap">
            <div style="padding:42.19% 0 0 0;position:relative;">
              <iframe
                src="https://player.vimeo.com/video/1127430683?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
                frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin"
                style="position:absolute;top:0;left:0;width:100%;height:100%;" title="nut shot 1x"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="https://player.vimeo.com/api/player.js"></script>

    <style>
      .steel-hero {
        padding: 8px 0 24px;
      }

      .steel-hero .heading_1 {
        margin: 0 0 18px;
        text-align: left;
        color: #005d5a;
      }

      .steel-vid-wrap {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        background: linear-gradient(#d8d8d8, #eeeeee);
      }

      .steel-hero .owl-dots {
        margin-top: 10px;
      }

      @media (max-width: 768px) {
        .steel-vid-wrap {
          border-radius: 6px;
        }
      }
    </style>

    <script>
      (function () {
        function loadScript(src) { return new Promise(function (res, rej) { var s = document.createElement('script'); s.src = src; s.onload = res; s.onerror = rej; document.head.appendChild(s); }); }
        function loadCss(href) { var l = document.createElement('link'); l.rel = 'stylesheet'; l.href = href; document.head.appendChild(l); }

        function initSlider() {
          var $ = window.jQuery;
          if (!$ || !$.fn || !$.fn.owlCarousel) return;

          var $slider = $(".steel-slider");
          $slider.owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: false
          });

          var players = [];
          $slider.find("iframe").each(function () {
            try {
              var p = new Vimeo.Player(this);
              p.setLoop(true).catch(() => { });
              p.setMuted(true).catch(() => { });
              players.push(p);
            } catch (e) { }
          });

          function syncPlayback() {
            var activeIframe = $slider.find(".owl-item.active iframe")[0];
            players.forEach(function (p) {
              p.getIframe().then(function (ifr) {
                if (ifr === activeIframe) { p.play().catch(() => { }); }
                else { p.pause().catch(() => { }); }
              });
            });
          }

          $slider.on("initialized.owl.carousel translated.owl.carousel", syncPlayback);
          setTimeout(syncPlayback, 600);
        }

        function ensureOwl() {
          var hasOwl = window.jQuery && window.jQuery.fn && window.jQuery.fn.owlCarousel;
          if (hasOwl) { initSlider(); return; }

          loadCss("https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css");
          loadCss("https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css");

          var jqReady = window.jQuery ? Promise.resolve() :
            loadScript("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js");

          jqReady
            .then(() => loadScript("https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"))
            .then(initSlider)
            .catch(e => console.warn("Owl Carousel load failed:", e));
        }

        if (document.readyState === "loading")
          document.addEventListener("DOMContentLoaded", ensureOwl);
        else
          ensureOwl();
      })();
    </script>
    <!-- ======================= -->
  
    <section class="why-choose">
        <div class="wc-container">
            <h2 class="heading_1">Why To Choose Haneri Fans?</h2>

            <ul class="wc-grid">
            <!-- Item 1 -->
            <li class="wc-item">
                <div class="wc_img_div">
                    <img src="images/why_home_1.png" alt="Design Excellence" class="wc-icon">
                </div>                
                <p class="wc-caption">Design<br>Excellence</p>
            </li>

            <!-- Item 2 -->
            <li class="wc-item">
                <div class="wc_img_div">
                    <img src="images/why_home_2.png" alt="Technologically Advanced" class="wc-icon">
                </div>
                <p class="wc-caption">Technologically<br>Advanced</p>
            </li>

            <!-- Item 3 -->
            <li class="wc-item">
                <div class="wc_img_div">
                    <img src="images/why_home_3.png" alt="Lasting Quality" class="wc-icon">
                </div>
                <p class="wc-caption">Lasting<br>Quality</p>
            </li>

            <!-- Item 4 -->
            <li class="wc-item">
                <div class="wc_img_div">
                    <img src="images/why_home_4.png" alt="Inclusive Pricing" class="wc-icon">
                </div>
                <p class="wc-caption">Inclusive<br>Pricing</p>
            </li>

            <!-- Item 5 -->
            <li class="wc-item">
                <div class="wc_img_div">
                    <img src="images/why_home_5.png" alt="Enduring Sustainability" class="wc-icon">
                </div>
                <p class="wc-caption">Enduring<br>Sustainability</p>
            </li>
            </ul>
        </div>
    </section>

  <section class="fancraft" aria-label="Fan Craft by Haneri">
    <h2 class="heading_1">Fan Craft by Haneri</h2>

    <section class="section fancraft-onimg">
      <div class="">
        <figure class="fancraft-block" style="--x:7.5%; --y:18%; --w:32%;"> <!-- width of text block -->
          <img class="fancraft-media" src="/images/Fancraft.png" alt="Haneri Fancraft fan" />

          <figcaption class="fancraft-caption">
            <h2 class="fancraft-wordmark" aria-label="FANCRAFT">FANCRAFT</h2>

            <p class="fancraft-body">
              At Fancraft by Haneri, artistry meets engineering to create ceiling fans that are truly bespoke.
              Each piece is a statement of sophistication — tailored in design, finish, and form to complement refined
              interiors.
              From handcrafted details to precision-balanced performance, every fan embodies the elegance of
              exclusivity.
              Redefining air and aesthetics alike, Fancraft transforms a simple utility into a timeless expression of
              luxury craftsmanship.
            </p>

            <a class="fancraft-cta" href="#enquire">ENQUIRE NOW</a>
          </figcaption>
        </figure>
      </div>
    </section>
  </section>
</div>
  <style>
    :root {
      --radius: 10px;
      --shadow: 0 6px 14px rgba(0, 0, 0, .12);
      --brand: #CA5D27;
    }

    /* ===== Match Innovation-grid heading rules ===== */
    .fancraft {
      padding: 24px 0;
    }

    .fancraft>h2.heading_1 {
      margin-bottom: 18px;
      text-align: left;
      /* padding: 0 12px; */
      /* same as Innovations section */
    }

    /* ===== Fonts ===== */
    @font-face {
      font-family: "Ailerons";
      src: url("/Fonts/Ailerons-Typeface.woff2") format("woff2");
      font-weight: 400;
      font-style: normal;
      font-display: swap;
    }

    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap");

    /* ===== Block layout ===== */
    .fancraft-onimg {
      color: #fff;
    }

    .fancraft-block {
      position: relative;
      /* margin: 0 12px; */
      /* gives same gutter as your grid section */
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
      background: #000;
    }

    .fancraft-media {
      display: block;
      width: 100%;
      height: auto;
      /* keeps original aspect ratio */
    }

    /* ===== Caption positioned via CSS vars ===== */
    .fancraft-caption {
      position: absolute;
      left: var(--x);
      top: var(--y);
      width: var(--w);
      max-width: 560px;
      font-family: "Open Sans", system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
      text-shadow: 0 1px 0 rgba(0, 0, 0, .18);
    }

    /* ===== FANCRAFT wordmark ===== */
    .fancraft-wordmark {
      margin: 0 0 16px 0;
      font-family: "Ailerons", sans-serif;
      font-size: clamp(42px, 6.6vw, 76px);
      letter-spacing: 0.28em;
      line-height: 1.02;
      color: #fff;
    }

    /* ===== Body text ===== */
    .fancraft-body {
      margin: 0 0 22px 0;
      font-size: 16px;
      line-height: 1.72;
      color: #e9e3dc;
    }

    /* ===== CTA button ===== */
    .fancraft-cta {
      display: inline-block;
      background: var(--brand);
      color: #fff;
      text-decoration: none;
      font-weight: 700;
      letter-spacing: 0.02em;
      padding: 12px 20px;
      border-radius: 8px;
      box-shadow: 0 10px 22px rgba(202, 93, 39, .22);
      transition: transform 0.2s ease, filter 0.2s ease, box-shadow 0.2s ease;
    }

    .fancraft-cta:hover {
      transform: translateY(-1px);
      filter: brightness(1.06);
    }

    .fancraft-cta:active {
      transform: translateY(0);
      box-shadow: 0 6px 16px rgba(202, 93, 39, .2);
    }

    /* ===== Responsive tweaks ===== */
    @media (max-width: 900px) {
      .fancraft-caption {
        left: 6%;
        top: 14%;
        width: 60%;
      }

      .fancraft-body {
        font-size: 15px;
        text-align: justify;
      }
    }

    @media (max-width: 520px) {
      .fancraft-caption {
        left: 6%;
        top: 10%;
        width: 82%;
      }

      .fancraft-wordmark {
        letter-spacing: 0.22em;
      }
      .fancraft-media {
        display: block;
        width: 100%;
        height: 500px;
        object-fit: cover;
      }
    }
  </style>

<style>
    /* ===== Why Choose section ===== */
    .why-choose {
        padding: 0px;
        /* background: #fff; */
    }
    .wc-container {
        max-width: 100%;
        margin: 0 auto;
    }

    /* Grid – 5 columns on desktop, wraps down responsively */
    .wc-grid {
        list-style: none;
        padding: 10px 0 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 40px 36px;                   /* row/column gap */
        align-items: start;
        justify-items: strech;
    }

    .wc-item {
        text-align: center;
    }
    .wc-icon {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 8px auto 10px;
        object-fit: contain;
        image-rendering: -webkit-optimize-contrast;
        transition: transform .2s ease;
        padding-bottom: 10px;
    }
    .wc-item:hover .wc-icon { transform: translateY(-2px); }
    .wc_img_div{
        width:100%;
        height:100px;
    }
    .wc-caption {
        margin: 0;
        color: #CA5D27;                   /* orange from your brand */
        font-family: "Open Sans",sans-serif;
        font-size: 20px;
        line-height: 1.2;
        font-weight: 500;
    }

    /* ===== Responsiveness ===== */
    @media (max-width: 1100px){
    .wc-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 900px){
    .wc-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 640px){
    .wc-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 28px 24px;
        justify-content: center;
    }
    .wc-grid li:last-child:nth-child(odd) {
      grid-column: 1 / -1;
      justify-self: center;
    }
      .wc-icon { width: 64px; }
    .wc-caption { font-size: 18px; }
    .wc-title { font-size: 24px; }
    }
    @media (max-width: 400px){
    .wc-grid { grid-template-columns: 1fr; }
    .wc-icon { width: 58px; }
    .wc-caption { font-size: 17px; }
    }

</style>


  <!-- Blogs Section -->
  <div class="container">
    <?php include("inc_files/index_blogs.php"); ?>
  </div>
</main><!-- End .main -->

<?php include("footer.php"); ?>