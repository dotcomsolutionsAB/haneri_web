



<footer class="footer">
        <div class="container">
            <div class="footer-top top-border d-flex align-items-center justify-content-between flex-wrap">
                <div class="footer-left widget-newsletter d-md-flex align-items-center">
                    

                </div>
            </div>

            <div class="footer-middle">
                <div class="row">
                    <div class="col-lg-6 col-xl-4">
                        <div class="widget right">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="images/logo_white.png" alt="logo">
                                </a>
                            </div>
                        </div><!-- End .widget -->                            
                    </div>

                    <div class="col-sm-6 col-lg-3 col-xl-2">
                        <div class="widget center">
                            <h4 class="widget-title">Pillar Technology</h4>
                            <div class="links link-parts row">
                                <ul class="link-part col-xl-12 mb-0">
                                    <li><a href="https://haneri.com/air-curve-design">Air Curve Design</a></li>
                                    <li><a href="https://haneri.com/turbosilent-bldc">Turbosilent BLDC</a></li>
                                    <li><a href="https://haneri.com/hass">HASS</a></li>
                                    <li><a href="https://haneri.com/lumiambience">Lumiambience</a></li>
                                    <li><a href="https://haneri.com/scan">SCAN</a></li>
                                </ul>
                            </div>
                        </div><!-- End .widget -->
                    </div>
                    <div class="col-sm-6 col-lg-3 col-xl-2">
                        <div class="widget center">
                            <h4 class="widget-title">Our Policy</h4>
                            <div class="links link-parts row">
                                <ul class="link-part col-xl-12 mb-0">
                                    <li><a href="https://haneri.com/faqs">FAQs</a></li>
                                    <li><a href="https://haneri.com/privacy-policy">Privacy Policy</a></li>
                                    <li><a href="https://haneri.com/shipping-policy">Shipping Policy</a></li>
                                    <li><a href="https://haneri.com/wir-policy">WIR Policy</a></li>
                                </ul>
                            </div>
                        </div><!-- End .widget -->
                    </div>

                    <div class="col-sm-6 col-lg-3 col-xl-4">
                        <div class="widget">
                            <h4 class="widget-title">Company Info</h4>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="contact-widget">
                                        <p><i class="fas fa-home"></i></p>
                                        <p>
                                            <span>
                                                <?php
                                                    $mapsUrl = 'https://www.google.com/maps/search/A-48+Sector+57+Noida+Uttar+Pradesh+201301/@19.6922828,61.0418276,4z/data=!3m1!4b1?entry=ttu&g_ep=EgoyMDI2MDMxOC4xIKXMDSoASAFQAw%3D%3D';
                                                    if ($data && isset($data['name'])) {
                                                        echo '<a href="' . htmlspecialchars($mapsUrl, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer">' . htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') . '</a>';
                                                    } else {
                                                        echo 'Name not found';
                                                    }
                                                ?>
                                            <br>
                                                <?php
                                                    if ($data && isset($data['address'])) {
                                                        echo '<a href="' . htmlspecialchars($mapsUrl, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer">' . htmlspecialchars($data['address'], ENT_QUOTES, 'UTF-8') . '</a>';
                                                    } else {
                                                        echo 'Address not found';
                                                    }
                                                ?>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="contact-widget">
                                        <p><i class="fas fa-phone"></i></p>
                                        <p>
                                            <a href="#">
                                                <?php 
                                                    if ($data && isset($data['phone'])) {
                                                        echo $data['phone'];
                                                    } else {
                                                        echo 'phone not found';
                                                    }
                                                ?>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="contact-widget email">
                                        <p><i class="fas fa-envelope"></i></p>
                                        <p>
                                            <a href="mailto:<?php echo $data['email']; ?>">
                                                <?php 
                                                    if ($data && isset($data['email'])) {
                                                        echo "info@haneri.com";
                                                    } else {
                                                        echo 'email not found';
                                                    }
                                                ?>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="contact-widget">
                                        <p><i class="fas fa-clock"></i></p>
                                        <p><a href="#">Mon - Sun / 9:00 AM - 8:00 PM</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom d-sm-flex align-items-center">
                <div class="footer-left">
                    <span class="footer-copyright">&copy; 2025 | Haneri </span>
                </div>
                <div class="footer-right ml-auto mt-1 mt-sm-0">
                    <!-- <div class="social-icons">
                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                        <a href="#" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                    </div> -->
                </div>
            </div>
        </div>
    </footer>
    </div><!-- End .page-wrapper -->

    <div class="loading-overlay">
        <?php include("inc_files/loading.php"); ?>
    </div>

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <!-- Mobile_sidebar code -->
         <?php include("inc_files/mobile_sidebar.php"); ?>

    </div><!-- End .mobile-menu-container -->

    <div class="sticky-navbar">
        <!-- Mobile sitky bottom nav -->
        <?php include("inc_files/mobile_sticky_bottom_nav.php"); ?>
    </div>

    <!-- <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a> -->

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins.min.js"></script>
    <script src="assets/js/jquery.appear.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.min.js"></script>
    <!-- Loader JS -->
    <!-- <script>
        const letters = document.querySelectorAll('.dc-letter');
        let stopAnimation = false;

        function animateLetters() {
        if (stopAnimation) return;

        letters.forEach((l) => {
            l.classList.remove('center-style');
            l.style.opacity = 0;
            l.style.transform = 'translateX(-120%)';
            l.style.color = 'black';
        });

        letters.forEach((letter, index) => {
            setTimeout(() => {
            letter.style.opacity = 1;
            letter.style.transform = 'translateX(0)';
            }, index * 250);
        });

        const inTime = letters.length * 250 + 400;

        setTimeout(() => {
            letters.forEach((l) => l.classList.add('center-style'));
        }, inTime);

        const outStart = inTime + 800;
        setTimeout(() => {
            [...letters].reverse().forEach((letter, i) => {
            setTimeout(() => {
                letter.classList.remove('center-style');
                letter.style.opacity = 0;
                letter.style.transform = 'translateX(120%)';
            }, i * 250);
            });
        }, outStart);

        const finishTime = outStart + letters.length * 250 + 600;
        setTimeout(() => {
            animateLetters();
        }, finishTime);
        }

        function dcHideLoader() {
        stopAnimation = true;
        document.body.classList.add("dc-loaded");
        console.log("✅ All content (HTML + API) loaded – hiding loader...");
        }

        // Global tracking of fetch and XHR requests
        let pendingFetches = 0;

        // Track fetch()
        const originalFetch = window.fetch;
        window.fetch = function (...args) {
        pendingFetches++;
        return originalFetch(...args).finally(() => {
            pendingFetches--;
            checkIfReadyToHideLoader();
        });
        };

        // Track XMLHttpRequest (e.g., jQuery or other libs)
        (function (open) {
        XMLHttpRequest.prototype.open = function (...args) {
            this.addEventListener('loadend', () => {
            pendingFetches--;
            checkIfReadyToHideLoader();
            });
            pendingFetches++;
            open.apply(this, args);
        };
        })(XMLHttpRequest.prototype.open);

        // Check if all requests have finished
        function checkIfReadyToHideLoader() {
        if (pendingFetches === 0) {
            setTimeout(() => {
            if (pendingFetches === 0) {
                dcHideLoader();
            }
            }, 500); // slight delay to ensure rendering
        }
        }

        // Start animation when HTML & assets are loaded
        // window.addEventListener("load", function () {
        // console.log("⚡ Page loaded – starting HANERI animation...");
        // animateLetters();

        // // Optional fallback: hide loader after X sec in worst case
        // setTimeout(() => {
        //     if (!document.body.classList.contains('dc-loaded')) {
        //     console.warn("⏱️ Force hiding loader after timeout...");
        //     dcHideLoader();
        //     }
        // }, 15000); // failsafe after 15s
        // });
    </script> -->
    <!--Mobile Sticky code-->
    <style>
      .sticky-navbar.fixed {
        display:none;
      }
      /* ===== MOBILE STICKY BAR ===== */
      @media (max-width:520px) {
        body {
          padding-bottom: calc(56px + env(safe-area-inset-bottom, 0px));
        }
        .wpp i {
          font-size: 25px !important;
        }
        .mobile_sticky_bar {
            display: none;
          position: fixed;
          left: 0;
          right: 0;
          bottom: 0;
          z-index: 9999;
          display: grid;
          grid-template-columns: repeat(5, 1fr);
          align-items: stretch;
          background: #fff;
          /* border-top: 1px solid #e9edf0; */
          box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.06);
          padding-bottom: env(safe-area-inset-bottom, 0px);
        }
    
        .mobile_sticky_bar .sticky-info {
          margin: 0;
          padding: 0;
        }
    
        .mobile_sticky_bar .sticky-info > a {
          display: flex;
          flex-direction: column;
          align-items: center;
          gap: 4px;
          padding: 8px 0;
          text-decoration: none;
          font-size: 11px;
          line-height: 1.1;
          color: #222;
        }
    
        .mobile_sticky_bar .sticky-info i {
          font-size: 25px;
          line-height: 1;
        }
    
        .mobile_sticky_bar .sticky-info > a:active {
          background: #f6f6f6;
        }
      }
    </style>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const mobile_sticky_buttons = Array.from(document.querySelectorAll('.sticky-info'));
        if (!mobile_sticky_buttons.length) return;
    
        const mobile_sticky_mql = window.matchMedia('(max-width:520px)');
        let mobile_sticky_built = false;
        let mobile_sticky_bar = null;
    
        function mobile_sticky_buildBar() {
          if (mobile_sticky_built) return;
          mobile_sticky_bar = document.createElement('div');
          mobile_sticky_bar.className = 'mobile_sticky_bar';
    
          // Move existing sticky-info elements into the bar
          mobile_sticky_buttons.forEach(node => mobile_sticky_bar.appendChild(node));
    
          // Append to body so fixed positioning is viewport-relative
          document.body.appendChild(mobile_sticky_bar);
          mobile_sticky_built = true;
        }
    
        function mobile_sticky_destroyBar() {
          if (!mobile_sticky_built || !mobile_sticky_bar) return;
    
          // Move items back out if needed
          while (mobile_sticky_bar.firstChild) {
            document.body.insertBefore(mobile_sticky_bar.firstChild, mobile_sticky_bar);
          }
          mobile_sticky_bar.remove();
          mobile_sticky_bar = null;
          mobile_sticky_built = false;
        }
    
        function mobile_sticky_sync() {
          if (mobile_sticky_mql.matches) {
            mobile_sticky_buildBar();
          } else {
            mobile_sticky_destroyBar();
          }
        }
    
        // Run immediately and on viewport changes
        mobile_sticky_sync();
        mobile_sticky_mql.addEventListener('change', mobile_sticky_sync);
        window.addEventListener('resize', mobile_sticky_sync);
      });
    </script>
</body>

</html>