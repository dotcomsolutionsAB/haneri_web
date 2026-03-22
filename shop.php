<?php include("header.php"); ?>
<?php include("configs/config.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.js"></script>

<main class="main about shop_page">
  <div class="page-wrapper">
    <main class="main">
      <div class="container mb-1">
        <div class="row">
          <div class="col-lg-12 main-content shop">
            <!-- images area -->
            <div class="image_area">
              <img class="slide-bg" src="images/categories.png" alt="banner" width="100%">
            </div>
            <br>
            <section class="shop-features-section">
              <div class="shop-feature-card">
                <img src="images/Group_19.png" alt="Pan India Delivery">
                <span>Pan India Delivery</span>
              </div>
              <div class="shop-feature-card">
                <img src="images/Group_20.png" alt="Free Delivery">
                <span>Free Delivery</span>
              </div>
              <div class="shop-feature-card">
                <img src="images/Group_18.png" alt="Easy Returns">
                <span>Easy Returns</span>
              </div>
              <div class="shop-feature-card">
                <img src="images/Group_.png" alt="GST Billing">
                <span>GST Billing</span>
              </div>
            </section>
            <br>

            <!-- =========================
                 DESKTOP FILTER BAR (≥ lg)
                 ========================= -->
            <div id="desktop-filters-bar" class="d-none d-lg-block">
              <div class="desktop-filters sticky-filters">
                <!-- Categories -->
                <div class="filter-card">
                  <h5 class="filter-title">Model</h5>
                  <div id="ms-category-desktop" class="multi-select"></div>
                </div>

                <!-- Color -->
                <div class="filter-card">
                  <h5 class="filter-title">Color</h5>
                  <div id="ms-color-desktop" class="multi-select"></div>
                </div>

                <!-- Sweep Size -->
                <div class="filter-card">
                  <h5 class="filter-title">Sweep Size</h5>
                  <div id="ms-sweep-desktop" class="multi-select"></div>
                </div>

                <!-- Price -->
                <div class="filter-card">
                  <h5 class="filter-title">Price</h5>
                  <div class="price-slider-wrapper">
                    <div id="price-slider-desktop"></div>
                  </div>
                  <div class="filter-price-action">
                    <div class="filter-price-text">
                      Price: <span id="filter-price-range-desktop">Rs.1000 - Rs.20000</span>
                    </div>
                  </div>
                </div>

                <!-- Apply -->
                <div class="filter-card filter-actions">
                  <button class="apply_filter btn btn-primary w-100" id="apply-filters-desktop">Apply Filters</button>
                  <button class="remove_filter btn btn-outline-secondary w-100" id="remove-filters-desktop">Remove Filters</button>
                </div>
              </div>
            </div>
            <!-- spacer to prevent layout jump when bar becomes fixed -->
            <div id="filters-spacer" class="d-none d-lg-block" style="display:none;height:0;"></div>
            <br>
            <!-- For Mobile And Desktop View (sort/show bar stays) -->
            <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
              <div class="toolbox-left">
                <a href="https://haneri.ongoingsites.xyz/domex" class="sidebar-toggle">
                  <svg data-name="Layer 3" id="Layer_3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                    <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                    <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                  </svg>
                  <span>Filter</span>
                </a>

                <div class="toolbox-item toolbox-sort">
                  <label>Sort By:</label>
                  <div class="select-custom">
                    <select name="orderby" id="orderby-select" class="form-control">
                      <option value="">-Select-</option>
                      <option value="ascending">Low to High</option>
                      <option value="descending">High to Low</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="toolbox-right">
                <div class="toolbox-item toolbox-show">
                  <label>Show:</label>
                  <div class="select-custom">
                    <select name="perpage" class="form-control" data-datatable-size="true"></select>
                  </div>
                </div>
              </div>
            </nav>

            <div class="row products_area" id="products-table">
              <!-- products showing here  -->
            </div>

            <nav class="toolbox toolbox-pagination">
              <div class="toolbox-item toolbox-show">
                <!-- <label>Show:</label>
                <div class="select-custom">
                  <select name="perpage" class="form-control" data-datatable-size="true"></select>
                </div> -->
              </div>
              <ul class="pagination toolbox-item"></ul>
            </nav>
          </div>

          <div class="sidebar-overlay"></div>

          <!-- =========================
               MOBILE SIDEBAR (≤ lg)
               ========================= -->
          <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar d-block d-lg-none">
            <div class="sidebar-wrapper">

                <!-- Model (Category) MOBILE -->
                <div class="widget widget-category wid">
                <h3 class="widget-title wid_title">
                    <a data-toggle="collapse" href="#widget-body-categories" role="button" aria-expanded="true" aria-controls="widget-body-categories">
                    Model
                    </a>
                </h3>
                <div class="collapse show" id="widget-body-categories">
                    <div class="widget-body">
                    <div id="ms-category-mobile" class="multi-select"></div>
                    </div>
                </div>
                </div>

                <!-- Color MOBILE -->
                <div class="widget widget-brand wid">
                <h3 class="widget-title wid_title">
                    <a data-toggle="collapse" href="#widget-body-7" role="button" aria-expanded="true" aria-controls="widget-body-7">Color</a>
                </h3>
                <div class="collapse show" id="widget-body-7">
                    <div class="widget-body pb-0">
                    <div id="ms-color-mobile" class="multi-select"></div>
                    </div>
                </div>
                </div>

                <!-- Sweep Size MOBILE -->
                <div class="widget widget-variant wid">
                <h3 class="widget-title wid_title">
                    <a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true" aria-controls="widget-body-5">Sweep Size</a>
                </h3>
                <div class="collapse show" id="widget-body-5">
                    <div class="widget-body">
                    <div id="ms-sweep-mobile" class="multi-select"></div>
                    </div>
                </div>
                </div>

                <!-- Price Widget (MOBILE) -->
                <div class="widget widget-price wid">
                <h3 class="widget-title wid_title">
                    <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
                </h3>
                <div class="collapse show" id="widget-body-3">
                    <div class="widget-body">
                    <form action="#">
                        <div class="price-slider-wrapper">
                        <div id="price-slider-mobile"></div>
                        </div>
                        <div class="filter-price-action">
                        <div class="filter-price-text">
                            Price: <span id="filter-price-range-mobile">Rs.0 - Rs.1000</span>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>

                <!-- Filter Button - triggers product fetching -->
                <div class="fil">
                    <button id="apply-filters-mobile" class="apply_filter">
                        Apply Filters
                    </button>
                    <button id="remove-filters-mobile" class="remove_filter_mobile btn-outline-secondary" style="margin-top:8px;width:100%;">
                        Remove Filters
                    </button>
                </div>
            </div>
          </aside>
        </div>
      </div>
    </main>

    <div id="flash-message" style="display: none; position: fixed; bottom: -100px; left: 50%; transform: translateX(-50%);
      background: #c8e5e3; color: #005d5a; padding: 14px 24px; border-radius: 8px; font-weight: 500; font-size: 16px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.15); transition: bottom 0.4s ease; z-index: 9999; border: 1px solid #005d5a;">
      Item added to cart!
    </div>
    
    <!-- For Multi select check box style -->
    <style>
        /* ===== Multiselect base ===== */
        .multi-select { position: relative; }
        .multi-select .ms-toggle {
        width: 100%;
        display: flex; align-items: center; justify-content: space-between;
        gap: 8px; padding: 10px 12px;
        border: 1px solid #ddd; border-radius: 8px; background: #fff; cursor: pointer;
        min-height: 42px; font-size: 14px;
        }
        .multi-select .ms-toggle .ms-placeholder { color: #666; }
        .multi-select .ms-toggle .ms-badges { display: flex; gap: 6px; flex-wrap: wrap; }
        .multi-select .ms-badge {
        padding: 2px 8px; border-radius: 12px; background: #f1f5f9; font-size: 12px; color: #334155;
        }
        .multi-select .ms-menu {
        position: absolute; left: 0; right: 0; top: calc(100% + 6px);
        background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
        box-shadow: 0 10px 24px rgba(0,0,0,0.08);
        padding: 8px; z-index: 1036; display: none; max-height: 280px; overflow: auto;
        }
        .multi-select.open .ms-menu { display: block; }
        .multi-select .ms-item {
        display: flex; align-items: center; gap: 8px; padding: 8px 6px; border-radius: 6px; cursor: pointer;
        }
        .multi-select .ms-item:hover { background: #f8fafc; }
        .multi-select .ms-item input { margin: 0; }
        .multi-select .ms-item .swatch {
        width: 14px; height: 14px; border-radius: 50%;
        border: 1px solid rgba(0,0,0,0.15); display: inline-block;
        }

        /* Compact in fixed mode */
        #desktop-filters-bar.is-stuck .multi-select .ms-menu { top: calc(100% + 4px); }

        .remove_filter {
        background: #f3f6f6;
        padding: 10px 20px;
        border-radius: 5px;
        border: 0;
        color: #005d5ac2;
        font-size: 16px;
        }

    </style>

      <style>
        /* tablet view */
        @media (min-width: 768px) and (max-width: 991px) {
          .remove_filter_mobile {
            margin-top: 8px;
            width: 100%;
            background: #f3f6f6;
            padding: 10px 20px;
            border-radius: 5px;
            border: 0px;
            color: #005d5a;
            font-size: 14px;
            cursor: pointer;
            font-family: 'Open Sans' !important;
            text-transform: uppercase;
            font-weight: 600 !important;
          }
          .fil {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            height: 100px;
            /* justify-content: center; */
            align-items: center;
            flex-wrap: wrap;
            flex-direction: column;
          }
          .apply_filter {
            background: #005d5a;
            padding: 10px 20px;
            border-radius: 5px;
            border: 0px;
            width: 100%;
            color: #f3f6f6;
            font-size: 14px;
            cursor: pointer;
            font-family: 'Open Sans' !important;
            text-transform: uppercase;
            font-weight: 600 !important;
            /* max-width: 50%; */
          }   
          .shop-feature-card {
            flex: 1 1 175px;
            max-width: 175px;
          } 
          .shop_products {
            display: block;
            max-width: 235px !important;
          }   
          .products_area {
            justify-content: flex-start;
            gap: 15px !important;
          }
          .brand_image {
            height: 15px;
            margin-left: -80px !important;
          }
          .cart_view_add .color-dot {
            width: 14px !important;
            height: 18px !important;
            border-radius: 0px;
          }   
          .shop .card {
            padding: 15px;
          }
        }
      </style>
    <!-- Mobile view -->
    <style>
        @media (max-width: 480px) {
            .brand_image {
                height: 15px;
                width: 100%;
                display: flex;
                justify-content: flex-start;
                margin-left: -50px !important;
            }
            .shop_products {
                max-width: 165px !important;            
            }
            .products_area {
                justify-content: space-between !important;
                gap: 1rem !important;
                min-height: 500px;
            }
            .add_to_carts{
                font-family: 'Barlow Condensed';
                font-size: 14px !important;
            }
            .product_names{
                font-size: 32px !important;
            }
            .prod-desc{
              display:none;
            }
            .cart_view_add .color-dot {
              width: 20px !important;
              height: 20px !important;
            }
            .color-dot.active {
              outline: 2px solid #005d5a; !important;
              width: 20px !important;
              height: 20px !important;
            }
            .shop .card {
              width: 100%;
              min-height: 380px !important;
            }
            .fil {
              display: flex;
              width: 100%;
              justify-content: center;
              align-items: center;
              height: 100px;
              /* justify-content: center; */
              align-items: center;
              flex-wrap: wrap;
              flex-direction: column;
            }
            .apply_filter {
              background: #005d5a;
              padding: 10px 20px;
              border-radius: 5px;
              border: 0px;
              width: 100%;
              color: #f3f6f6;
              font-size: 14px;
              cursor: pointer;
              font-family: 'Open Sans' !important;
              text-transform: uppercase;
              font-weight: 600 !important;
              /* max-width: 50%; */
            }
            .remove_filter_mobile{
              margin-top: 8px;
              width: 100%;
              background: #f3f6f6;
              padding: 10px 20px;
              border-radius: 5px;
              border: 0px;
              color: #005d5a;
              font-size: 14px;
              cursor: pointer;
              font-family: 'Open Sans' !important;
              text-transform: uppercase;
              font-weight: 600 !important;
              /* max-width: 50%; */
              /* display: flex */
            }
        }
        @media (max-width: 1499px) and (min-width: 1300px) {
            .shop_products {
                max-width: 290px !important;            
            }
        }
    </style>
    <script>
        function buildMultiSelect(el, { placeholder = 'Select...', options = [] } = {}) {
            const root = $(el);
            root.addClass('multi-select');
            root.html(`
                <div class="ms-toggle">
                <span class="ms-placeholder">${placeholder}</span>
                <div class="ms-badges"></div>
                <span class="ms-caret">▾</span>
                </div>
                <div class="ms-menu"></div>
            `);

        const menu = root.find('.ms-menu');
        options.forEach(opt => {
            const id = `ms_${Math.random().toString(36).slice(2)}`;
            const colorDot = opt.swatch ? `<span class="swatch" style="background:${opt.swatch}"></span>` : '';
            menu.append(`
            <label class="ms-item" for="${id}">
                ${colorDot}
                <input type="checkbox" id="${id}" value="${opt.value}">
                <span>${opt.label}</span>
            </label>
            `);
        });

        const toggle = root.find('.ms-toggle');
        const badges = root.find('.ms-badges');

        // open/close
        toggle.on('click', function (e) {
            e.stopPropagation();
            $('.multi-select').not(root).removeClass('open'); // close others
            root.toggleClass('open');
        });

        // update badges
        function renderBadges() {
            const vals = getMultiSelectValues(root[0]);
            badges.empty();
            if (vals.length === 0) {
            root.find('.ms-placeholder').show();
            return;
            }
            root.find('.ms-placeholder').hide();
            vals.slice(0, 3).forEach(v => badges.append(`<span class="ms-badge">${v}</span>`));
            if (vals.length > 3) badges.append(`<span class="ms-badge">+${vals.length - 3}</span>`);
        }

        root.on('change', 'input[type="checkbox"]', renderBadges);
        $(document).on('click', function () { root.removeClass('open'); });

        // expose a simple API
        return {
            setValues(values = []) {
            root.find('input[type="checkbox"]').each(function () {
                $(this).prop('checked', values.includes(this.value));
            });
            renderBadges();
            },
            getValues() { return getMultiSelectValues(root[0]); }
        };
        }

        function getMultiSelectValues(container) {
            return Array.from(container.querySelectorAll('input[type="checkbox"]:checked'))
                .map(i => i.value);
        }
    </script>
    <!-- =========================
         DATA + FILTERS LOGIC
         ========================= -->
    <script>
        function normalizePrice(value) {
          if (value === null || value === undefined) return null;
          const num = parseFloat(String(value).replace(/,/g, ''));
          return isNaN(num) ? null : num;
        }

        $(document).ready(function () {
            // -------- State --------
            let currentPage   = 1;
            let itemsPerPage  = 12;
            let totalItems    = 0;
            // Read ?category= from URL once (for initial filter)
            const urlParams = new URLSearchParams(window.location.search);
            const categoryFromURL = urlParams.get('category') || '';
            // This will be "" if no category param
            const initialCategoryFilter = categoryFromURL ? decodeURIComponent(categoryFromURL) : '';


            // Build multiselects
            const msCategoryDesktop = buildMultiSelect('#ms-category-desktop', { placeholder: 'Select Model' });
            const msCategoryMobile  = buildMultiSelect('#ms-category-mobile',  { placeholder: 'Select Model' });

            const COLOR_OPTIONS = [
                { label: 'Denim Blue',        value: 'Denim Blue',        swatch: '#6497B2' },
                { label: 'Baby Pink',         value: 'Baby Pink',         swatch: '#C7ABA9' },
                { label: 'Pearl White',       value: 'Pearl White',       swatch: '#F5F5F5' },
                { label: 'Matte Black',       value: 'Matte Black',       swatch: '#21201E' },
                { label: 'Pine',              value: 'Pine',              swatch: '#DDC194' },
                { label: 'Beige',             value: 'Beige',             swatch: '#E6E0D4' },
                { label: 'Walnut',            value: 'Walnut',            swatch: '#926148' },
                { label: 'Sunset Copper',     value: 'Sunset Copper',     swatch: '#936053' },
                { label: 'Royal Brass',       value: 'Royal Brass',       swatch: '#B7A97C' },
                { label: 'Regal Gold',        value: 'Regal Gold',        swatch: '#D3B063' },
                { label: 'Pure Steel',        value: 'Pure Steel',        swatch: '#878782' },
                { label: 'Metallic Grey',     value: 'Metallic Grey',     swatch: '#D4D4D4' },
                { label: 'Sand Beige',        value: 'Sand Beige',        swatch: '#D3CBBB' },
                { label: 'Metallic Walnut',   value: 'Metallic Walnut',   swatch: '#7F513F' },
                { label: 'Espresso Walnut',   value: 'Espresso Walnut',   swatch: '#926148' },
                { label: 'Moonlit White',     value: 'Moonlit White',     swatch: '#E6E6E6' },
                { label: 'Natural Pine',      value: 'Natural Pine',      swatch: '#DDC194' },
                { label: 'Velvet Black',      value: 'Velvet Black',      swatch: '#0B0A08' }
            ];
            const msColorDesktop = buildMultiSelect('#ms-color-desktop', { placeholder: 'Select Color', options: COLOR_OPTIONS });
            const msColorMobile  = buildMultiSelect('#ms-color-mobile',  { placeholder: 'Select Color', options: COLOR_OPTIONS });

            const SWEEP_OPTIONS = [
                { label: '600mm',  value: '600mm' },
                { label: '1200mm', value: '1200mm' },
                { label: '1320mm', value: '1320mm' }
                
            ];
            const msSweepDesktop = buildMultiSelect('#ms-sweep-desktop', { placeholder: 'Select Sweep Size', options: SWEEP_OPTIONS });
            const msSweepMobile  = buildMultiSelect('#ms-sweep-mobile',  { placeholder: 'Select Sweep Size', options: SWEEP_OPTIONS });

            // expose for reset button to access them later
            window.msColorDesktop = msColorDesktop;
            window.msColorMobile  = msColorMobile;
            window.msSweepDesktop = msSweepDesktop;
            window.msSweepMobile  = msSweepMobile;


            // -------- Init --------
            fetchCategories();
            fetchBrands();
            fetchVariants();

            initPriceSlider('#price-slider-desktop', '#filter-price-range-desktop', 5000, 20000);
            initPriceSlider('#price-slider-mobile',  '#filter-price-range-mobile',  5000, 20000);

            // Fill "Show per page"
            const perPageSelect = $("[data-datatable-size]");
            [4, 8, 12, 16, 20].forEach((size) => {
            perPageSelect.append(`<option value="${size}">${size}</option>`);
            });
            perPageSelect.val(itemsPerPage);

            // Apply Filters (both buttons)
            $('#apply-filters-desktop, #apply-filters-mobile, .apply_filter').on('click', function () {
            currentPage = 1;
            fetchProducts();
            });

            // Sorting + per-page
            $(".pagination").on("click", "button", function () {
              currentPage = parseInt($(this).data("page"));
              fetchProducts();
            });

            $("[data-datatable-size]").on("change", function () {
              itemsPerPage = parseInt($(this).val());
              currentPage = 1;
              fetchProducts();
            });

            $('#orderby-select').on('change', function () {
              currentPage = 1;
              fetchProducts();
            });

            // First load
            fetchProducts();

            // -------- Functions --------

            function initPriceSlider(sliderSelector, rangeSelector, min, max) {
              const el = document.querySelector(sliderSelector);
              if (!el || el.noUiSlider) return;
              noUiSlider.create(el, {
                  start: [100, 20000],
                  connect: true,
                  range: { min, max },
                  step: 100
              });
              el.noUiSlider.on('update', function (values) {
                  const minV = parseFloat(values[0]).toFixed(2);
                  const maxV = parseFloat(values[1]).toFixed(2);
                  const span = document.querySelector(rangeSelector);
                  if (span) span.textContent = `Rs.${minV} - Rs.${maxV}`;
              });
            }

            function effectiveSliderValues() {
              // Prefer desktop if visible (≥ lg); else mobile.
              let sliderEl = document.getElementById('price-slider-desktop');
              const isDesktop = window.getComputedStyle(document.getElementById('desktop-filters-bar')).display !== 'none';
              if (!isDesktop) sliderEl = document.getElementById('price-slider-mobile');

              if (sliderEl && sliderEl.noUiSlider) {
                  const [min, max] = sliderEl.noUiSlider.get();
                  return [parseFloat(min), parseFloat(max)];
              }
              return [0, 0];
            }

            // ============== API Renders ==============

            // function fetchCategories() {
            //   $.ajax({
            //       url: '<?php echo BASE_URL; ?>/categories/fetch',
            //       type: 'POST',
            //       success: function (response) {
            //       if (response && response.data) {
            //           populateCategories(response.data);
            //           $(document).trigger('categoriesRendered');
            //       } else {
            //           console.error("Unexpected categories response format:", response);
            //       }
            //       },
            //       error: function (err) {
            //       console.error("Error fetching categories:", err);
            //       }
            //   });
            // }
            // function populateCategories(categories) {
            //     const catOptions = (categories || []).map(c => ({ label: c.name, value: c.name }));
            //     // Rebuild the two dropdowns with options
            //     const catDesktop = buildMultiSelect('#ms-category-desktop', { placeholder: 'Select Model', options: catOptions });
            //     const catMobile  = buildMultiSelect('#ms-category-mobile',  { placeholder: 'Select Model', options: catOptions });

            //     // If URL has a category, preselect it
            //     const urlParams = new URLSearchParams(window.location.search);
            //     const fromURL = urlParams.get('category');
            //     if (fromURL) {
            //         const decoded = decodeURIComponent(fromURL);
            //         catDesktop.setValues([decoded]);
            //         catMobile.setValues([decoded]);
            //     }

            //     // expose for fetchProducts (overwrite earlier consts if needed)
            //     window._msCategoryDesktop = catDesktop;
            //     window._msCategoryMobile  = catMobile;
            // }

            function fetchCategories() {
              $.ajax({
                url: '<?php echo BASE_URL; ?>/products/get_models',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({}), // send empty body if not required
                success: function (response) {
                  if (response && response.data) {
                    // response.data = [{ model_id, model_name }, ...]
                    populateCategories(response.data);
                    $(document).trigger('categoriesRendered');
                  } else {
                    console.error("Unexpected models response format:", response);
                  }
                },
                error: function (err) {
                  console.error("Error fetching models:", err);
                }
              });
            }
            function populateCategories(models) {
              // models = [{ model_id, model_name }, ...]
              const catOptions = (models || []).map(m => ({
                label: m.model_name,
                value: m.model_name   // THIS is what we’ll send in filter
              }));

              const catDesktop = buildMultiSelect('#ms-category-desktop', {
                placeholder: 'Select Model',
                options: catOptions
              });
              const catMobile = buildMultiSelect('#ms-category-mobile', {
                placeholder: 'Select Model',
                options: catOptions
              });

              // If URL has ?model=Ezra or ?category=Ezra, support that
              const urlParams = new URLSearchParams(window.location.search);
              const fromURL = urlParams.get('model');
              if (fromURL) {
                const decoded = decodeURIComponent(fromURL);
                catDesktop.setValues([decoded]);
                catMobile.setValues([decoded]);
              }

              window._msCategoryDesktop = catDesktop;
              window._msCategoryMobile  = catMobile;
            }


            function fetchBrands() {
              $.ajax({
                  url: '<?php echo BASE_URL; ?>/brands/fetch',
                  type: 'POST',
                  success: function (response) {
                  if (response && response.data) {
                      populateBrands(response.data);
                  } else {
                      console.error("Unexpected brands response format:", response);
                  }
                  },
                  error: function (err) {
                  console.error("Error fetching brands:", err);
                  }
              });
            }

            function populateBrands(brands) {
              let html = '';
              brands.forEach(brand => {
                  html += `
                  <li>
                      <label>
                      <input type="checkbox" name="brand" value="${brand.name}">
                      <span>${brand.name}</span>
                      </label>
                  </li>`;
              });
              $('#brands-list-desktop').html(html);
              $('#brands-list-mobile').html(html);
            }

            function fetchVariants() {
              $.ajax({
                  url: '<?php echo BASE_URL; ?>/products/unique_variant',
                  type: 'GET',
                  success: function (response) {
                    if (response && response.data) {
                        let html = '';
                        response.data.forEach(variant => {
                        html += `
                            <li>
                            <label>
                                <span>${variant}</span>
                                <input type="checkbox" name="variant" value="${variant}">
                            </label>
                            </li>`;
                        });
                        $('#variant-list-desktop').html(html);
                        $('#variant-list-mobile').html(html);
                    } else {
                        console.error("Unexpected response format for variants:", response);
                    }
                  },
                  error: function (err) {
                  console.error("Error fetching variants:", err);
                  }
              });
            }

            function fetchProducts() {
                const offset = (currentPage - 1) * itemsPerPage;

                // 1. Product name search (if you add a field with this id)
                // const searchProduct = $('#search-product-input').val() || '';

                // MODEL filter from multiselects; prefer desktop if visible
                const isDesktop = window.getComputedStyle(document.getElementById('desktop-filters-bar')).display !== 'none';
                const selectedModels = isDesktop
                  ? (window._msCategoryDesktop?.getValues() || [])
                  : (window._msCategoryMobile?.getValues() || []);

                // Comma-separated list of model NAMES to send in search_product
                const modelNameFilter = selectedModels.join(',');  // e.g. "Fengshui,Ezra"

                // CATEGORY filter only from URL param (set once above)
                const categoryFilter = initialCategoryFilter;      // "" or e.g. "Ceiling Fan"


                // COLOR
                const selectedColors = (isDesktop ? (msColorDesktop.getValues()) : (msColorMobile.getValues()));
                const colorPayload = selectedColors.join(','); // "Natural Pine" or "Natural Pine,Velvet Black"

                // SWEEP SIZE
                const selectedSweep = (isDesktop ? (msSweepDesktop.getValues()) : (msSweepMobile.getValues()));
                const sweepPayload = selectedSweep.join(',');


                // 4. Price range slider (desktop or mobile, whichever visible)
                const [minPrice, maxPrice] = effectiveSliderValues();

                // 5. Static price range (optional select with this id)
                const priceRange = $('#price-range-select').val();

                // 6. Sorting option
                const orderValue = $('#orderby-select').val();
                const orderPrice = orderValue === 'ascending' ? 'Ascending' :
                                    orderValue === 'descending' ? 'Descending' : '';

                // 7. Variant filters (both UIs)
                const selectedVariants = [];
                $('input[name="variant"]:checked').each(function () {
                    selectedVariants.push($(this).val());
                });
                const variantType = selectedVariants.join(',');

                const getAuthToken = localStorage.getItem("auth_token");

                $.ajax({
                    url: '<?php echo BASE_URL; ?>/products/get_products',
                    type: 'POST',
                    headers: {
                    "Content-Type": "application/json",
                    ...(getAuthToken ? { "Authorization": `Bearer ${getAuthToken}` } : {})
                    },
                    data: JSON.stringify({
                      // If later you want name search also, you can combine it with modelNameFilter
                      search_product:  modelNameFilter,     // 👈 MODEL NAME(S) here
                      search_category: categoryFilter,      // 👈 CATEGORY from ?category=Ceiling Fan

                      color:           colorPayload,
                      sweep_size:      sweepPayload,
                      price_range:     priceRange,
                      limit:           itemsPerPage,
                      offset:          offset,
                      order_price:     orderPrice,
                      min_priceFilter: minPrice,
                      max_priceFilter: maxPrice,
                      variant_type:    variantType,
                    }),
                    success: (response) => {
                    if (response && response.data) {
                        totalItems = response.total_records || 0;
                        populateTable(response.data);
                        updatePagination();
                    } else {
                        totalItems = 0;
                        updatePagination();
                        populateTable([]);
                    }
                    },
                    error: (error) => {
                    console.error("Error fetching products:", error);
                    }
                });
            }

            function getColorHex(name) {
                if (!name) return '#ddd';
                const map = {
                  'Denim Blue'       : '#6497B2',
                  'Baby Pink'        : '#C7ABA9',
                  'Pearl White'      : '#F5F5F5',
                  'Matte Black'      : '#21201E',
                  'Pine'             : '#DDC194',
                  'Beige'            : '#E6E0D4',
                  'Walnut'           : '#926148',
                  'Sunset Copper'    : '#936053',
                  'Royal Brass'      : '#B7A97C',
                  'Regal Gold'       : '#D3B063',
                  'Pure Steel'       : '#878782',
                  'Metallic Grey'    : '#D4D4D4',
                  'Sand Beige'       : '#D3CBBB',
                  'Metallic Walnut'  : '#7F513F',
                  'Espresso Walnut'  : '#926148',
                  'Moonlit White'    : '#E6E6E6',
                  'Natural Pine'     : '#DDC194',
                  'Velvet Black'     : '#0B0A08'
                };
                // If it's already a hex like "#aabbcc", use it; else fallback/map/neutral
                const looksHex = /^#([0-9a-f]{3}|[0-9a-f]{6})$/i.test(name);
                return looksHex ? name : (map[name] || '#ddd');
            }

            // Clean and trim text safely
            function stripHtml(html = '') {
                const div = document.createElement('div');
                div.innerHTML = html;
                return (div.textContent || div.innerText || '').trim();
            }

            // Use variant.description if available; else fallback to product.description
            // function getShortDesc(product, variant, limit = 100) {
            //     const src =
            //         (variant?.description && variant.description.trim()) ||
            //         (product?.description && product.description.trim()) ||
            //         '';
            //     if (!src) return '';
            //     const clean = stripHtml(src);
            //     return clean.length > limit ? clean.slice(0, limit) + '...' : clean;
            // }
            function getShortDesc(product, variant, limit = 100) {
                const src =
                    (product?.description && product.description.trim()) ||
                    (variant?.description && variant.description.trim()) ||                    
                    '';
                if (!src) return '';
                const clean = stripHtml(src);
                return clean.length > limit ? clean.slice(0, limit) + '...' : clean;
            }

            const populateTable = (data) => {
                const tbody = $("#products-table");
                
                tbody.empty();

                if (!data || data.length === 0) {
                    tbody.html(`
                    <div class="col-12 text-center comming_soon">
                        <h3 class="text-danger my-5">Coming Soon!</h3>
                    </div>
                    `);
                    return;
                }
                const userRole = localStorage.getItem("user_role");

                data.forEach((product) => {
                    if (!Array.isArray(product.variants)) return;

                    product.variants.forEach((variant) => {
                    
                    let regularPrice = variant.regular_price || "00";
                    let sellingPrice = variant.selling_price || "00";
                    let vendor_price = variant.sales_price_vendor || "00";

                    // numeric compare (handles 9999, 9,999, 9999.00 all same)
                    const regNum  = normalizePrice(regularPrice);
                    const sellNum = normalizePrice(sellingPrice);
                    const samePrice = regNum !== null && sellNum !== null && regNum === sellNum;

                    const shortDesc = getShortDesc(product, variant);                        

                    let priceSnippet = `
                        <div class="price-box">
                            <div class="c_price">
                                <span class="product-price heading2"> ${samePrice ? 'MRP' : ''} ₹${sellingPrice}</span>
                                <span class="old-price heading2 ${samePrice ? 'd-none' : ''}">MRP ₹${regularPrice}</span>
                            </div>
                            <div class="sp_price none">
                                Special Price : <span class="special_price paragraph1">MRP ₹${vendor_price}</span>
                            </div>
                        </div>`;

                        const imageName = (variant.file_urls && variant.file_urls[0]) ? variant.file_urls[0] : "assets/images/placeholder.jpg";
                        const swatches = (product.variants || []).map(v => {
                        const hex = getColorHex(v.color || v.variant_value);
                        const isActive = v.id === variant.id; // highlight current variant
                        const img0 = (v.file_urls && v.file_urls[0]) ? v.file_urls[0] : '';
                        return `
                            <span class="color-dot ${isActive ? 'active' : ''}"
                                style="background:${hex}"
                                title="${(v.color || v.variant_value || '').replace(/"/g,'&quot;')}"
                                data-variant-id="${v.id}"
                                data-image="${img0.replace(/"/g,'&quot;')}"
                                data-regular="${(v.regular_price || '00')}"
                                data-selling="${(v.selling_price || '00')}"
                                data-vendor="${(v.sales_price_vendor || '00')}">
                            </span>`;
                        }).join('');

                        tbody.append(`
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 shop_products">
                            <div class="card featured pro-card" id="pro-table" data-product-id="${variant.product_id}" data-variant-id="${variant.id}">                                
                                <div class="card_image">
                                    <img src="${imageName}" alt="${variant.variant_value}" class="img-fluid-card" />
                                </div>
                                <h4 class="heading4 mbo brand_image">
                                    <img src="images/Link_img.png" alt="Haneri Img" class="img-fluid-card" />
                                </h4>
                                <br>
                                <h4 class="product_names">
                                    <a href="javascript:void(0)" class="product_nam" onclick="openProductDetail('${variant.product_id}', '${variant.id}')">
                                        ${product.name}
                                    </a>                               
                                </h4>  
                                ${shortDesc ? `<p class="prod-desc mb-2">${shortDesc}</p>` : ''}                         
                                ${priceSnippet}
                                <div class="cart_view_add">
                                    <div class="variant-swatches" data-product-id="${variant.product_id}">
                                    ${swatches}
                                    </div>
                                    <a href="javascript:void(0)" onclick="addToCartFromList(event, '${product.id}', '${variant.id}')" class="btn rounded-pill px-4 add_to_carts">
                                    Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                        `);
                    });
                });
            };

            const updatePagination = () => {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const pagination = $(".pagination");
            pagination.empty();

            if (totalPages <= 1) return;

            if (currentPage > 1) {
                pagination.append(`<button class="page-link pagi" data-page="${currentPage - 1}">Previous</button>`);
            }

            for (let page = 1; page <= totalPages; page++) {
                const isActive = page === currentPage ? "active" : "";
                pagination.append(`<button class="page-link pagi ${isActive}" data-page="${page}">${page}</button>`);
            }

            if (currentPage < totalPages) {
                pagination.append(`<button class="page-link pagi" data-page="${currentPage + 1}">Next</button>`);
            }
            };

            // Handle swatch click: swap image, prices, add_to_carts variant, and active class
            $('#products-table').on('click', '.color-dot', function (e) {
                e.stopPropagation();
                const dot  = $(this);
                const card = dot.closest('.pro-card');

                // 1) active state
                card.find('.color-dot').removeClass('active');
                dot.addClass('active');

                // 2) image + alt
                const img = card.find('.card_image img');
                const newSrc = dot.data('image');
                if (newSrc) {
                    img.attr('src', newSrc);
                    img.attr('alt', dot.attr('title') || '');
                }

                // 3) prices
                const reg = String(dot.data('regular') || '00');
                const sell = String(dot.data('selling') || '00');
                const vendor = String(dot.data('vendor') || '00');

                // numeric compare again
                const regNum  = normalizePrice(reg);
                const sellNum = normalizePrice(sell);
                const samePrice = regNum !== null && sellNum !== null && regNum === sellNum;

                const $oldPrice = card.find('.old-price');

                // Update selling price always
                card.find('.product-price').text(' MRP ₹' + sell);

                // Show/hide old price based on equality
                if (samePrice) {
                    $oldPrice.addClass('d-none');
                } else {
                    $oldPrice.removeClass('d-none').text('MRP ₹' + reg);
                }

                // Vendor / special price
                card.find('.special_price').text('MRP ₹' + vendor);


                // 4) add_to_carts button -> update variant id in the inline onclick
                const productId = card.data('product-id');
                const variantId = String(dot.data('variantId') || '');
                const $addBtn = card.find('a.add_to_carts');
                // rebuild the onclick to use the new variant
                $addBtn.attr('onclick', `addToCartFromList(event, '${productId}', '${variantId}')`);

                // 5) AFTER 3 SECONDS → auto open product detail with this variant
                //    cancel previous timer for this card if any
                const previousTimer = card.data('openTimer');
                if (previousTimer) {
                    clearTimeout(previousTimer);
                }

                const timerId = setTimeout(function () {
                    openProductDetail(productId, variantId);
                }, 2000);

                card.data('openTimer', timerId);
            });

            // Attach remove-filters clicks
            $('#remove-filters-desktop, #remove-filters-mobile').on('click', function () {
            const isDesktop = window.getComputedStyle(document.getElementById('desktop-filters-bar')).display !== 'none';

            // Reset Model (Category)
            resetMultiSelectInstance(window._msCategoryDesktop);
            resetMultiSelectInstance(window._msCategoryMobile);

            // Reset Color
            resetMultiSelectInstance(window.msColorDesktop);
            resetMultiSelectInstance(window.msColorMobile);

            // Reset Sweep Size
            resetMultiSelectInstance(window.msSweepDesktop);
            resetMultiSelectInstance(window.msSweepMobile);

            // Reset Brands
            $('input[name="brand"]').prop('checked', false);

            // Reset Variants
            $('input[name="variant"]').prop('checked', false);

            // Reset Search
            $('#search-product-input').val('');

            // Reset Sort
            $('#orderby-select').val('');

            // Reset Price sliders
            resetPriceSlider('#price-slider-desktop', 100, 50000);
            resetPriceSlider('#price-slider-mobile',  100, 50000);

            // Refetch
            currentPage = 1;
            fetchProducts();
            });
            // Card click → open details (avoid inside buttons/links)
            $('#products-table').on('click', '.pro-card', function (event) {
                const productId = $(this).data('product-id');
                const variantId = $(this).data('variant-id');  // Get the variant_id from the card
                const isInsideLinkOrButton = $(event.target).closest('a, button').length > 0;

                // Ensure it's not a click inside a button or link, then open the product details page
                if (!isInsideLinkOrButton) openProductDetail(productId, variantId);
            });

        }); // document.ready end

        // --- Reset helpers ---
        function resetPriceSlider(selector, min = 100, max = 50000) {
            const el = document.querySelector(selector);
            if (el && el.noUiSlider) {
                el.noUiSlider.set([min, max]);
            }
        }
        function resetMultiSelectInstance(instance) {
            if (instance && typeof instance.setValues === 'function') {
                instance.setValues([]);
            }
        }

        function addToCartFromList(event, productId, variantId = null) {
            event.stopPropagation();

            const token    = localStorage.getItem("auth_token");
            let tempId     = localStorage.getItem("temp_id");
            const quantity = 1;

            if (!productId) {
            alert("Product is missing.");
            return;
            }

            const requestData = {
            product_id: parseInt(productId),
            quantity: quantity
            };

            if (variantId) requestData.variant_id = parseInt(variantId);
            if (!token && tempId) requestData.cart_id = tempId;

            const ajaxOptions = {
            url: `<?php echo BASE_URL; ?>/cart/add`,
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(requestData),
            success: function (data) {
                if (data.success === true || (data.message && data.message.includes("successfully"))) {
                if (!token && !tempId && data.data && typeof data.data.user_id === "string") {
                    localStorage.setItem("temp_id", data.data.user_id);
                }
                try {
                    if (typeof window.haneriRefreshCartBadge === "function") window.haneriRefreshCartBadge();
                } catch (e) {}
                showFlashMessage("Item added to cart!");
                window.location.href = 'cart.php';
                } else {
                showFlashMessage("Failed to add to cart", "#ffeaea", "#ff0000");
                }
            },
            error: function (err) {
                console.error("Add to cart failed:", err);
                alert("There was an error adding the product to your cart.");
            }
            };

            if (token) {
            ajaxOptions.headers = { "Authorization": `Bearer ${token}` };
            }

            $.ajax(ajaxOptions);
        }

        function showFlashMessage(message = "Success!", background = '#c8e5e3', textColor = '#005d5a') {
            const flash = document.getElementById("flash-message");
            flash.innerText = message;
            flash.style.background = background;
            flash.style.color = textColor;
            flash.style.bottom = "30px";
            flash.style.display = "block";
            setTimeout(() => {
            flash.style.bottom = "-100px";
            setTimeout(() => { flash.style.display = "none"; }, 400);
            }, 3000);
        }

        function openProductDetail(productId, variantId) {
          const url = `product_detail.php?id=${productId}&v_id=${variantId || ''}`;
          window.location.href = url;
        }
    </script>

    <style>
      /* ======= Desktop sticky filter bar ======= */
      /* desktop bar is normal flow by default */
      #desktop-filters-bar {
        z-index: 1035; /* below nav(1040), above content */
      }

      /* when stuck (after 500px), we fix it below the nav */
      #desktop-filters-bar.is-stuck {
        position: fixed;
        top: 100px;            /* your nav height */
        left: 0;
        right: 0;
        z-index: 1035;         /* nav is 1040 */
      }

      /* keep your nice card styling on the inner box */
      .sticky-filters {
        background: #fff;
        padding: 16px 12px;
        border-radius: 10px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        border: 1px solid #eee;
      }
      .is-stuck .sticky-filters {
        background: #fff;
        padding: 16px 12px;
        border-radius: 10px;
        box-shadow: none;
        border: 0px solid #eee;
        margin-left: 5vw;
        margin-right: 5vw;
      }

      /* grid stays the same */
      .desktop-filters {
        display: grid;
        grid-template-columns: 2fr 2fr 2fr 2fr 1fr;
        gap: 16px;
      }

      /* make sure ancestors don't kill fixed/sticky behavior */
      .page-wrapper,
      .main,
      .container,
      .row,
      [class*="col-"] { overflow: visible !important; }


      .filter-card .filter-title {
        font-size: 14px;
        margin: 0 0 8px 0;
        font-weight: 600;
      }
      .cat-list, .config-size-list {
        max-height: 260px;
        overflow: auto;
        padding-left: 0;
        list-style: none;
        margin: 0;
      }
      .filter-actions {
        display: flex;
        align-items: end;
        flex-direction: column;
        gap: 10px;
      }

      /* ======= Existing visual tweaks ======= */
      .none { display: none; }
      .product-price { color: #495057; font-size: 1.5rem; line-height: 1; }
      .cross { text-decoration: line-through; }
      .special_price { color: #f0340efa; font-size: 2.3rem; line-height: 1; font-family: 'Barlow Condensed'; }
      .sp_price { font-size: 18px; font-family: 'Barlow Condensed'; font-style: italic; }

      /* Optional: nice scrollbar for lists */
      .cat-list::-webkit-scrollbar, .config-size-list::-webkit-scrollbar {
        width: 8px;
      }
      .cat-list::-webkit-scrollbar-thumb, .config-size-list::-webkit-scrollbar-thumb {
        background: rgba(0,0,0,0.15);
        border-radius: 8px;
      }
      /* Ensure ancestors don't block sticky */
      .page-wrapper,
      .main,
      .container,
      .row,
      [class*="col-"] {
        overflow: visible !important;
      }

    </style>

    <!-- Sticky filter script -->
    <script>
      (function () {
        const NAV_HEIGHT     = 100;  // your nav height
        const STICKY_SCROLL  = 900;  // start sticking after 500px
        const NAV_Z          = 1040; // your nav z-index

        const bar     = document.getElementById('desktop-filters-bar');
        const spacer  = document.getElementById('filters-spacer');

        if (!bar || !spacer) return;

        let barHeight = 0;
        let isStuck   = false;

        // ensure bar sits under nav
        bar.style.zIndex = Math.min(NAV_Z - 5, 9999); // just below nav

        function measure() {
          // temporarily remove fixed class to measure natural height
          if (bar.classList.contains('is-stuck')) {
            bar.classList.remove('is-stuck');
          }
          // allow layout to settle
          barHeight = bar.offsetHeight || 0;
          // if we were stuck, reapply now that we measured
          if (isStuck) bar.classList.add('is-stuck');
        }

        function applySpacer(enable) {
          if (enable) {
            spacer.style.display = 'block';
            // spacer.style.height  = barHeight + 'px';
            spacer.style.height  = '0px';

          } else {
            spacer.style.display = 'none';
            spacer.style.height  = '0';
          }
        }

        function onScroll() {
          const y = window.pageYOffset || document.documentElement.scrollTop || 0;
          const shouldStick = y >= STICKY_SCROLL;

          if (shouldStick && !isStuck) {
            isStuck = true;
            bar.classList.add('is-stuck');
            bar.style.top = NAV_HEIGHT + 'px';
            applySpacer(true);
          } else if (!shouldStick && isStuck) {
            isStuck = false;
            bar.classList.remove('is-stuck');
            applySpacer(false);
          }
        }

        // simple throttle for scroll/resize
        let ticking = false;
        function tickwrap(fn) {
          return function () {
            if (!ticking) {
              window.requestAnimationFrame(() => {
                fn();
                ticking = false;
              });
              ticking = true;
            }
          };
        }

        // init
        measure();
        onScroll();

        window.addEventListener('scroll', tickwrap(onScroll), { passive: true });
        window.addEventListener('resize', tickwrap(() => { measure(); onScroll(); }));
      })();
    </script>

    <!-- color dots -->
    <style>
      .toolbox-pagination {
        border-top: 0px solid #efefef !important;
      }
        /* Variant color dots */
        .add_to_carts{
            /* font-family: 'Barlow Condensed';
            font-size: 18px;
            font-weight: 500;
            border-radius: 0px !important; */
            display: inline-block;
            padding: 12px 20px;
            border-radius: 10px !important;
            background: #244a46;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            letter-spacing: .01em;
            text-transform: capitalize;
        }
        /* 4-up grid already handled by col-md-3, add spacing */
        .brand_image{
            height: 15px;
            width: 100%;
            display: flex;
            justify-content: flex-start;
            margin-left: -100px;
        }
        .brand_image img{
            height: 100%;
            width: 100%;
            object-fit: contain;
        }
        .product_names{
            font-family: 'Barlow Condensed', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
            font-weight: 600;
            font-size: 30px;
            line-height: 1.05;
            letter-spacing: 0;
            color: #CA5D27 !important;
            text-transform: uppercase;
            text-align: left;
            margin: 0 0 10px 0;            
        }
        .product_nam{
            /* font-family: 'Barlow Condensed', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
            font-weight: 600;
            font-size: 38px;
            line-height: 1.05;
            letter-spacing: 0; */
            color: #CA5D27 !important;
            /* text-transform: uppercase;
            margin: 0 0 10px 0; */
        }
        .product-price {
            font-size: 24px;
            font-family: 'Barlow Condensed';
            font-weight: 500 !important;
            line-height: 1;
            color: #005d5a;
            text-align: left;
        }
        .old-price {
            color: #495057;
            font-size: 20px;
            line-height: 1;
        }
        .shop_products { 
            display: block;
            max-width: 314px;
        }
        .products_area {
            justify-content: flex-start;
            gap: 3rem;
        }
        .card_image img{
            display: block;
            max-width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .shop .card {
            width: 100%;
            min-height: 400px;
            background: #ffffff;
        }

        /* Actions row as a bar: swatches on left, button on right */
        .cart_view_add {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 8px;
        }

        /* Swatches row (reuse your existing .color-dot look) */
        .variant-swatches {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            max-width: 70%; /* give space to the button */
        }

        /* Optional: make dots a bit smaller in actions row */
        .cart_view_add .color-dot {
            width: 28px;
            height: 28px;
            border-radius: 999px;
        }

        .color-dot {
            width: 28px;
            height: 28px;
            border-radius: 999px;
            /* border: 1px solid #000; */
            /* cursor: pointer; */
            transition: transform .08s ease, outline-color .08s ease;
            border: 1px solid #ddd;
            cursor: pointer;
            box-shadow: inset 0 0 0 2px rgba(255, 255, 255, .8);
        }
        .color-dot:hover { transform: scale(1.06); border-color: #000; }
        .color-dot.active {
            outline: 2px solid #9c9c9c;
            border-color: #9c9c9c;
            width: 28px;
            height: 28px;
        }

    </style>
    <style>
      .shop label {
        color: #222529;
        font-family: sans-serif !important;
        font-size: 14px !important;
        font-weight: 600;
        text-transform: math-auto !important;
      }
      .toolbox .select-custom .form-control {
        border-color: #005d5a;
        font-family: 'Barlow Condensed';
        text-transform: math-auto;
        font-weight: 500;
      }
      @media (max-width: 991px) {
        .toolbox .select-custom .form-control {
          color: #005d5a;
        }
        .sidebar-toggle span {
          font-size: 11px;
          font-weight: 600;
          color: #005d5a;
        }
        .sidebar-toggle svg {
          stroke: #005d5a;
        }
        .sidebar-toggle {
          border-width: 2px;
          border-color: #005d5a;
          font-weight: 700;
        }
      }
      
    </style>

    <!-- product image hover effect -->
    <style>
      /* Card should remain perfectly fixed */
      .pro-card {
        position: relative;
        overflow: hidden; /* keeps zoom inside */
      }

      /* Keep image container fixed */
      .pro-card .card_image {
        position: relative;
        overflow: hidden;
      }

      /* Image default state */
      .pro-card .card_image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
        transform-origin: center center;
      }

      /* Only image zooms on hover */
      .pro-card:hover .card_image img {
        transform: scale(1.1); /* zoom in */
      }

      /* Disable zoom on mobile (optional) */
      @media (max-width: 767px) {
        .pro-card:hover .card_image img {
          transform: none;
        }
      }
    </style>

    <?php include("footer.php"); ?>
  </div>
</main>
