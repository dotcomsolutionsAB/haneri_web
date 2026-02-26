<!-- Fonts (safe to include once site-wide) -->
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

<style>
 /* =========================================================
   AIR CURVE — BASE / TOKENS (mobile-first)
   ========================================================= */
  #air-curve { color:#1F2A2E; background:#fff; }
  #air-curve *, #air-curve *::before, #air-curve *::after { box-sizing:border-box; }

  /* design tokens */
  :root{
    --gap-col: 5%;
    --gap-row: 30px;
    --space-sm: 16px;
    --space-md: 28px;
    --space-lg: 44px;
    --card-pad: 16px;
    --radius: 12px;
    --stroke: #e6efee;
    --green: #00473E;
    --orange: #CA5D27;
  }

  /* =========================================================
    TYPOGRAPHY
    ========================================================= */
  #air-curve .bldc103{
    font-family:"Barlow Condensed", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
    font-size: clamp(30px, 5vw, 56px);
    line-height: 1.03;
    letter-spacing: 0;
    margin: 0 0 10px;
    font-weight: 300;
    color: var(--green);
  }
  #air-curve .bldc103 b{
    color: var(--orange);
    font-weight: 500;
  }
  #air-curve .bldc104,
  #air-curve .bldc106,
  #air-curve .bldch3 p{
    font-family:"Montserrat", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
    color:#1F2A2E;
  }
  #air-curve .bldc104{
    font-size: clamp(14px, 1.1vw, 17px);
    line-height: 1.75;
    margin: 0;
    max-width: 62ch;
  }

  /* =========================================================
    LAYOUT ROWS
    ========================================================= */
  /* two-column rows (image/text or text/image) */
  #air-curve .bldc102{
    display:grid;
    grid-template-columns: 1fr;           /* mobile: single column */
    gap: 18px;
    align-items:start;
    margin-top: var(--space-md);
  }
  #air-curve .bldc102:first-of-type{ margin-top:0; }

  /* single-column section wrapper (e.g., features + benefits) */
  #air-curve .bldc107{
    display:grid;
    grid-template-columns: 1fr;
    gap: var(--gap-row) var(--gap-col);
    align-items:start;
    margin-top: var(--space-md);
  }

  /* media blocks */
  #air-curve .sm_h{ position:relative; }
  #air-curve .sm_h img{
    display:block; width:100%; height:auto; border:0; box-shadow:none; background:transparent; transform: translateZ(0);
  }

  /* =========================================================
    LISTS / BULLETS
    ========================================================= */
  #air-curve .bldc106{
    list-style:none; margin:0; padding:0;
    display:grid; gap:14px;
  }
  #air-curve .bldc106 li{
    position:relative; padding-left:20px; line-height:1.7;
  }
  #air-curve .bldc106 li::before{
    content:""; position:absolute; left:0; top:.55em;
    width:8px; height:8px; border-radius:50%; background:var(--orange);
  }
  #air-curve .bldc106 li strong{ color:var(--green); }

  /* =========================================================
    BENEFITS GRID / CARDS
    ========================================================= */
  /* a responsive two-up grid that never overflows */
  #air-curve .bldc108{
    display:grid;
    grid-template-columns: 1fr;                 /* mobile: stack */
    gap: 18px;
  }
  #air-curve .bldc109{
    display:grid;
    grid-template-columns: 72px 1fr;
    align-items:start;
    gap:14px;
    padding: var(--card-pad);
    border-radius: var(--radius);
    border: 1px solid var(--stroke);
    background:#fff;
  }
  #air-curve .bldc110{ width:60px; height:60px; object-fit:contain; }
  #air-curve .bldch3 h3{
    margin:0 0 4px;
    font-family:"Barlow Condensed", ui-sans-serif;
    font-weight:500;
    font-size: clamp(20px, 2.2vw, 26px);
    line-height:1.05;
    color: var(--orange);
  }
  #air-curve .bldch3 p{
    margin:0;
    color:#315859;
    font-size:14.5px;
    line-height:1.6;
  }

/* helpers */
#air-curve .mt-2{ margin-top: var(--space-sm); }
#air-curve .mt-4{ margin-top: var(--space-md); }
#air-curve .text-justify{ text-align: justify; }

/* =========================================================
   INTERACTIONS (hover-capable only)
   ========================================================= */
@media (hover:hover) and (pointer:fine){
  #air-curve .sm_h{ overflow:hidden; border-radius:10px; }
  #air-curve .sm_h img{ transition: transform .45s ease, filter .45s ease; }
  #air-curve .sm_h:hover img{ transform: scale(1.03); filter: saturate(1.04) contrast(1.02); }

  #air-curve .bldc109{ transition: box-shadow .25s ease, transform .25s ease; }
  #air-curve .bldc109:hover{ box-shadow:0 8px 24px rgba(0,0,0,.06); transform: translateY(-2px); }
  #air-curve .bldc109:focus-within{ box-shadow:0 8px 24px rgba(0,0,0,.08); transform: translateY(-1px); }
}

/* =========================================================
   MOTION (no layout shift)
   ========================================================= */
@media (prefers-reduced-motion: no-preference){
  @keyframes bldc-fade-up { from{opacity:0; transform:translateY(18px);} to{opacity:1; transform:none;} }
  #air-curve .reveal.in{ animation:bldc-fade-up .6s ease both; }
  /* gentle stagger for the four benefit cards */
  #air-curve .bldc108 > .bldc109.reveal.in:nth-of-type(2){ animation-delay:.08s; }
  #air-curve .bldc108 > .bldc109.reveal.in:nth-of-type(3){ animation-delay:.16s; }
  #air-curve .bldc108 > .bldc109.reveal.in:nth-of-type(4){ animation-delay:.24s; }
}

/* =========================================================
   MOBILE SPECIAL CASES
   ========================================================= */
/* show image first for the 2nd .bldc102 block on phones */
@media (max-width: 767px){
  #air-curve .bldc102:nth-of-type(2){
    display: flex; flex-direction: column-reverse;
  }
  #air-curve .bldc102:nth-of-type(2) > .sm_h:first-child{ order: -1; }
}

/* very small phones */
@media (max-width: 520px){
  #air-curve .bldc109{ grid-template-columns: 60px 1fr; padding:12px; gap:12px; }
  #air-curve .bldc110{ width:48px; height:48px; }
  #air-curve .bldch3 h3{ font-size:20px; }
  #air-curve .bldch3 p{ font-size:13.5px; line-height:1.55; }
  #air-curve .bldc108{ gap:10px !important; }
}
@media (max-width: 380px){
  #air-curve .bldc109{ grid-template-columns: 54px 1fr; }
  #air-curve .bldc110{ width:42px; height:42px; }
}

/* =========================================================
   TABLET (≥ 768px and ≤ 1199px)
   ========================================================= */
@media (min-width: 768px) and (max-width: 1199px){
  /* 1) Make each row full-width stacked */
  #air-curve .bldc102{
    grid-template-columns: 1fr;   /* was 1.05fr 1fr */
    gap: 28px;                    /* a bit more breathing room */
  }

  /* 2) Let body copy span full width */
  #air-curve .bldc104{
    max-width: none;              /* was 62ch */
  }

  /* 3) Make sure images stretch nicely */
  #air-curve .sm_h img{
    width: 100%;
    height: auto;
    object-fit: cover;            /* keep it neat if your images are taller */
  }
}

/* =========================================================
   DESKTOP (≥ 1200px)
   ========================================================= */
@media (min-width: 1200px){
  /* two-up rows with larger breathing room */
  #air-curve .bldc102{
    grid-template-columns: 1.05fr 1fr;
    gap: var(--space-lg) var(--gap-col);
  }
  /* benefits still two-up, wider gutters */
  #air-curve .bldc108{
    grid-template-columns: repeat(2, minmax(320px, 1fr));
    gap: 28px 40px;
  }
  #air-curve .bldc109{
    grid-template-columns: 88px 1fr;
  }
  #air-curve .bldc110{ width:72px; height:72px; }
}

  
</style>

<main class="main">
  <div id="air-curve">

    <!-- Section 1 -->
    <div class="bldc001">

      <div class="bldc102">
        <div class="sm_h">
          <img src="images/air_1.png" alt="Motor Visual" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103"><b>Introducing Air Curve Design:</b><br>Redefining Ceiling Fan Efficiency</h2>
          <p class="bldc104">
            At Haneri, innovation drives us to create products that are not only stylish but also deliver superior performance. Our revolutionary Air 
            Curve Design technology transforms how ceiling fan blades are conceptualized, designed, and manufactured. With high-tech design and precision engineering,  
            blades designed with Air Curve Design Technology offer unmatched air delivery, efficiency, and durability, showcasing the superiority of our product.
          </p>
        </div>
      </div>

      <!-- Section 2 -->
      <div class="bldc102 mt-2">
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">Why is Air Curve Design?</h2>
          <p class="bldc104">
            Air Curve Design is a cutting-edge blade technology that leverages advanced computational modelling and simulation to craft blades optimized for maximum airflow and energy efficiency. This innovation ensures that every curve and angle of the blade is scientifically tailored for superior aerodynamics, delivering a ceiling fan that offers unparalleled performance, energy efficiency, and style.
          </p>
        </div>
        <div class="sm_h">
          <img src="images/air_2.png" alt="Blade Design" class="img-fluid" />
        </div>
      </div>

      <!-- Section 3 -->
      <div class="bldc107 mt-4">       
        <!-- Right: Customer Benefits -->
        <div class="sm_h" style="justify-content:flex-start;">
          <h2 class="bldc103 mb-4">Key Features of Air Curve Design</h2>
          <div class="bldc108">
            <div class="bldc109">
              <img src="images/hight_air_delivery.png" class="bldc110" alt="High Air Delivery"> 
              <div class="bldch3">
                <h3>High Air Delivery</h3>
                <p>Air Curve blades are engineered to maximize airflow, providing a powerful and consistent cooling experience. They are designed to deliver optimal air 
                  circulation even in large spaces.</p>
              </div>
            </div>

            <div class="bldc109">
              <img src="images/energy_efficiency.png" class="bldc110" alt="Energy Efficiency"> 
              <div class="bldch3">
                <h3>Energy Efficiency</h3>
                <p>The aerodynamic profile of Air Curve blades optimizing drag, reducing the load on the motor and ensuring energy-efficient operation. Thanks to 
                  their energy-efficient operation, you can enjoy a powerful cooling experience while saving on electricity bills.</p>
              </div>
            </div>

            <div class="bldc109">
              <img src="images/advance_material.png" class="bldc110" alt="Advanced Materials"> 
              <div class="bldch3">
                <h3>Advanced Materials</h3>
                <p>Air Curve blades are crafted using high-strength, lightweight materials, ensuring durability and optimal blade weight for efficient rotation. 
                  You can trust in the longevity of your cooling solution.</p>
              </div>
            </div>

            <div class="bldc109">
              <img src="images/silent_performance.png" class="bldc110" alt="Silent Performance"> 
              <div class="bldch3">
                <h3>Silent Performance</h3>
                <p>The streamlined blade design minimizes turbulence, ensuring whisper-quiet operation, ideal for residential and professional settings.</p>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /Section 3 -->

      <!-- Section 4 -->
      <div class="bldc102 mt-2">
        <div class="sm_h">
          <img src="images/air_4.png" alt="Motor Render" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">The Science Behind Air Curve Design</h2>
          <ul class="bldc106">
            <li>Computational Fluid Dynamics (CFD) Advanced CFD simulations analyze airflow patterns, ensuring that each blade design achieves peak aerodynamic efficiency.</li>
            <li>Prototyping and Testing Multiple prototypes are tested under real-world conditions to validate performance metrics such as air delivery, noise levels, and energy consumption.</li>
            <li>Iterative Design Continuous refinement based on data-driven insights ensures that AirCurve blades exceed industry benchmarks for performance and reliability.</li>
          </ul>
        </div>
      </div>

      <!-- Right: Customer Benefits -->
      <div class="sm_h" style="justify-content: flex-start;">
        <h2 class="bldc103 mb-4">Benefits For Customers</h2>
        <div class="bldc108">
          <div>
            <div class="bldc109">
              <img src="images/enhance_comfort.png" class="bldc110" alt="Comfort Icon" />
              <div class="bldch3">
                <h3>Enhanced Comfort</h3>
                <p>
                  Experience superior cooling with high air delivery, ensuring a refreshing breeze in every corner of
                  the room.
                </p>
              </div>
            </div>
          </div>
          <div>
            <div class="bldc109">
              <img src="images/cost_savings.png" class="bldc110" alt="Cost Savings" />
              <div class="bldch3">
                <h3>Cost Savings</h3>
                <p>
                  Energy-efficient operation translates to long-term savings on electricity bills.
                </p>
              </div>
            </div>
          </div>
          <div>
            <div class="bldc109">
              <img src="images/sustainable_choice.png" class="bldc110" alt="Sustainable Choice" />
              <div class="bldch3">
                <h3>Sustainable Choice</h3>
                <p>
                  This Technology contributes to a greener, more sustainable environment by reducing energy
                  consumption.
                </p>
              </div>
            </div>
          </div>
          <div>
            <div class="bldc109">
              <img src="images/quiet_operation.png" class="bldc110" alt="Modern Aesthetics" />
              <div class="bldch3">
                <h3>Quiet Operation</h3>
                <p>
                  Reduced turbulence and noise make Silent M.A.S.S ideal for bedrooms, offices, and libraries where silence is a priority.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.bldc001 -->
  </div><!-- /#air-curve -->
</main>
<script>
(() => {
  // Mark reveal targets without changing your HTML structure
  const targets = document.querySelectorAll('#air-curve .bldc102, #air-curve .bldc107, #air-curve .bldc109');
  targets.forEach(el => el.classList.add('reveal'));

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduced) { targets.forEach(el => el.classList.add('in')); return; }

  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting){
        entry.target.classList.add('in');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  targets.forEach(el => io.observe(el));
})();
</script>
<script>
(() => {
  // Animate sections & cards as they enter
  const targets = document.querySelectorAll('#air-curve .bldc102, #air-curve .bldc107, #air-curve .bldc109');
  targets.forEach(el => el.classList.add('reveal'));

  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduced){ targets.forEach(el => el.classList.add('in')); return; }

  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting){
        entry.target.classList.add('in');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  targets.forEach(el => io.observe(el));
})();
</script>
