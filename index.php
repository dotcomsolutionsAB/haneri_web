<?php
header("Location: https://www.haneri.com", true, 302);
exit;
?>
<?php include("header.php"); ?>

<!-- Category section  -->
<main class="main">
  <?php include("inc_files/top_slider.php"); ?>

  <div class="container">
    <!-- Featured Products section -->
    <?php include("inc_files/featured_products.php"); ?>
    <?php include("inc_files/video_section.php"); ?>

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
        color: #315859;
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

    <?php include("inc_files/fancraft_section.php"); ?>
  
</div>


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
    /*.wc-grid { grid-template-columns: 1fr; }*/
    .wc-icon { width: 58px; }
    .wc-caption { font-size: 17px; }
    }

</style>


  <!-- Blogs Section -->
  <div class="container">
    <?php include("inc_files/index_blogs.php"); ?>
  </div>
</main><!-- End .main -->

<script>
(function () {
  const MOBILE_QUERY = '(max-width: 520px)';
  const TABLET_QUERY = '(min-width: 768px) and (max-width: 1199px)';

  const MOBILE_CHAR_LIMIT = 200;
  const TABLET_CHAR_LIMIT = 400;

  const selector = '.fancraft-body';

  function truncateToLimit(s, limit) {
    if (!s || s.length <= limit) return s;
    // cut to limit, then avoid mid-word by trimming back to last space
    let short = s.slice(0, limit);
    const lastSpace = short.lastIndexOf(' ');
    if (lastSpace > Math.floor(limit * 0.6)) { // prefer a reasonable word-boundary
      short = short.slice(0, lastSpace);
    }
    return short.replace(/\s+$/, '') + '…'; // use U+2026 ellipsis
  }

  function applyTruncate(limit) {
    document.querySelectorAll(selector).forEach(function (el) {
      // store original once
      if (!el.dataset.fulltext) {
        el.dataset.fulltext = el.textContent.trim();
      }

      const full = el.dataset.fulltext || '';
      if (full.length > limit) {
        el.textContent = truncateToLimit(full, limit);
      } else {
        el.textContent = full;
      }
    });
  }

  function restoreFull() {
    document.querySelectorAll(selector).forEach(function (el) {
      if (el.dataset.fulltext) {
        el.textContent = el.dataset.fulltext;
      }
    });
  }

  function onChange() {
    const isMobile = window.matchMedia(MOBILE_QUERY).matches;
    const isTablet = window.matchMedia(TABLET_QUERY).matches;

    if (isMobile) {
      applyTruncate(MOBILE_CHAR_LIMIT);
    } else if (isTablet) {
      applyTruncate(TABLET_CHAR_LIMIT);
    } else {
      // desktop and larger – show full text
      restoreFull();
    }
  }

  // run once on load
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', onChange);
  } else {
    onChange();
  }

  // re-run on viewport resize / orientation change (debounced)
  let resizeTimer = null;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(onChange, 120);
  });
  window.addEventListener('orientationchange', function () {
    setTimeout(onChange, 120);
  });
})();
</script>


<?php include("footer.php"); ?>