<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

<style>
  /* =========================================================
    BLDC PAGE — BASE / TOKENS (mobile-first)
    ========================================================= */
  #hass-page { color:#1F2A2E; background:#fff; padding-bottom:80px; }
  #hass-page *, #hass-page *::before, #hass-page *::after { box-sizing:border-box; }

  /* tokens */
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
    TYPE
    ========================================================= */
  #hass-page .bldc103{
    font-family:"Barlow Condensed", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
    font-size: clamp(30px, 5vw, 56px);
    line-height: 1.03;
    margin: 0 0 10px;
    font-weight: 300;
    color: var(--green);
  }
  #hass-page .bldc103 b{ color: var(--orange); font-weight: 500; }

  #hass-page .bldc104,
  #hass-page .bldc106,
  #hass-page .bldch3 p{
    font-family:"Montserrat", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
    color:#1F2A2E;
  }
  #hass-page .bldc104{
    font-size: clamp(14px, 1.1vw, 15px);
    line-height: 1.75;
    margin: 0;
    max-width: 62ch;
  }

  /* =========================================================
    LAYOUT ROWS
    ========================================================= */
  /* default: stack on mobile */
  #hass-page .bldc102{
    display:grid;
    grid-template-columns: 1fr;
    gap: 18px;
    align-items:start;
    margin-top: var(--space-md);
  }
  #hass-page .bldc102:first-of-type{ margin-top:0; }

  /* features + benefits wrapper */
  #hass-page .bldc107{
    display:grid;
    grid-template-columns: 1fr;
    gap: var(--gap-row) var(--gap-col);
    align-items:start;
    margin-top: var(--space-md);
  }

  /* media blocks */
  #hass-page .sm_h{ position:relative; }
  #hass-page .sm_h img{
    display:block; width:100%; height:auto; border:0; box-shadow:none; background:transparent; transform: translateZ(0);
  }

  /* subtle image hover (pointer devices only) */
  @media (hover:hover) and (pointer:fine){
    #hass-page .sm_h{ overflow:hidden; border-radius:10px; }
    #hass-page .sm_h img{ transition: transform .45s ease, filter .45s ease; }
    #hass-page .sm_h:hover img{ transform: scale(1.03); filter: saturate(1.04) contrast(1.02); }
  }

  /* =========================================================
    BULLETS
    ========================================================= */
  #hass-page .bldc106{
    list-style:none; margin:0; padding:0;
    display:grid; gap:14px;
  }
  #hass-page .bldc106 li{
    position:relative; padding-left:20px; line-height:1.7;
  }
  #hass-page .bldc106 li::before{
    content:""; position:absolute; left:0; top:.55em;
    width:8px; height:8px; border-radius:50%; background:var(--orange);
  }
  #hass-page .bldc106 li strong{ color:var(--green); }

  /* =========================================================
    BENEFITS GRID / CARDS
    ========================================================= */
  /* equal-height, responsive */
  #hass-page .bldc108{
    display:grid;
    grid-template-columns: 1fr;      /* mobile: stack */
    gap: 18px;
    align-items: stretch;
  }
  #hass-page .bldc108 > div{ height:100%; }  /* wrapper fills track */

  #hass-page .bldc109{
    display:grid;
    grid-template-columns: 72px 1fr; /* icon + text on mobile */
    align-items:start;
    gap:14px;
    padding: var(--card-pad);
    border:1px solid var(--stroke);
    border-radius: var(--radius);
    background:#fff;
    height:100%;
    transition: box-shadow .25s ease, transform .25s ease;
  }
  #hass-page .bldc110{ width:60px; height:60px; object-fit:contain; }

  #hass-page .bldch3 h3{
    margin:0 0 4px;
    font-family:"Barlow Condensed", ui-sans-serif;
    font-weight:500;
    font-size: clamp(20px, 2.2vw, 26px);
    line-height:1.05;
    color: var(--orange);
  }
  #hass-page .bldch3 p{
    margin:0;
    color:#315859;
    font-size:14.5px;
    line-height:1.6;
  }

  /* hover affordances */
  @media (hover:hover) and (pointer:fine){
    #hass-page .bldc109:hover{ box-shadow:0 8px 24px rgba(0,0,0,.06); transform: translateY(-2px); }
    #hass-page .bldc109:focus-within{ box-shadow:0 8px 24px rgba(0,0,0,.08); transform: translateY(-1px); }
  }

  /* helpers */
  #hass-page .mt-2{ margin-top: var(--space-sm); }
  #hass-page .mt-4{ margin-top: var(--space-md); }
  #hass-page .text-justify{ text-align: justify; }

  /* =========================================================
    MOTION (no layout shift)
    ========================================================= */
  @media (prefers-reduced-motion: no-preference){
    @keyframes bldc-fade-up { from{opacity:0; transform:translateY(18px);} to{opacity:1; transform:none;} }
    #hass-page .reveal.in{ animation:bldc-fade-up .6s ease both; }
    /* benefit card gentle stagger */
    #hass-page .bldc108 > div:nth-child(2) .bldc109.reveal.in{ animation-delay:.08s; }
    #hass-page .bldc108 > div:nth-child(3) .bldc109.reveal.in{ animation-delay:.16s; }
    #hass-page .bldc108 > div:nth-child(4) .bldc109.reveal.in{ animation-delay:.24s; }
  }

  /* =========================================================
    MOBILE SPECIALS
    ========================================================= */
  /* 2nd .bldc102: image first on phones */
  @media (max-width: 767px){
    #hass-page .bldc102:nth-of-type(2){
      display:flex; flex-direction:column-reverse;
    }
    #hass-page .bldc102:nth-of-type(2) > .sm_h:first-child{ order:-1; }
  }

  /* very small phones */
  @media (max-width: 520px){
    #hass-page .bldc109{ grid-template-columns: 60px 1fr; padding:12px; gap:12px; }
    #hass-page .bldc110{ width:48px; height:48px; }
    #hass-page .bldch3 h3{ font-size:20px; }
    #hass-page .bldch3 p{ font-size:13.5px; line-height:1.55; }
    #hass-page .bldc108{ gap:10px !important; }
  }
  @media (max-width: 380px){
    #hass-page .bldc109{ grid-template-columns: 54px 1fr; }
    #hass-page .bldc110{ width:42px; height:42px; }
  }

  /* =========================================
    TABLET (stack image + content full width)
    ========================================= */
  @media (min-width: 768px) and (max-width: 1199px){
    /* 1) Make each row full-width stacked */
    #hass-page .bldc102{
      grid-template-columns: 1fr;   /* was 1.05fr 1fr */
      gap: 28px;                    /* a bit more breathing room */
    }

    /* 2) Let body copy span full width */
    #hass-page .bldc104{
      max-width: none;              /* was 62ch */
    }

    /* 3) Make sure images stretch nicely */
    #hass-page .sm_h img{
      width: 100%;
      height: auto;
      object-fit: cover;            /* keep it neat if your images are taller */
    }
  }


  /* =========================================================
    DESKTOP (≥1200px)
    ========================================================= */
  @media (min-width: 1200px){
    #hass-page .bldc102{
      grid-template-columns: 1.05fr 1fr;
      gap: var(--space-lg) var(--gap-col);
    }
    /* benefits keep two-up, bigger gutters */
    #hass-page .bldc108{
      grid-template-columns: repeat(2, minmax(320px, 1fr));
      gap: 28px 40px;
    }
    #hass-page .bldc109{ grid-template-columns: 88px 1fr; }
    #hass-page .bldc110{ width:72px; height:72px; }
  }

</style>

<main class="main">
  <div id="hass-page">

    <!-- Section 1 -->
    <div class="bldc001">
      <div class="bldc102">
        <div class="sm_h">
          <img src="/images/hass_1.png" alt="Motor Visual" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103"><b>Introducing Silent H.A.S.S Technology:</b> More Air, Slow Speed</h2>
          <p class="bldc104">
            At Haneri, we believe that true innovation lies in challenging common misconceptions and delivering solutions that redefine industry standards. 
            Our Silent H.A.S.S Technology (More Air, Slow Speed) embodies this philosophy, and debunks the myth that you don’t need high speed (RPM) to achieve 
            superior air delivery. Leveraging our advanced Air Curve Design and TurboSilent BLDC Motor Technology, Silent H.A.S.S delivers unparalleled performance, 
            offering powerful airflow with near-silent operation at lower rotational speeds.
          </p>
        </div>
      </div>

      <!-- Section 2 -->
      <div class="bldc102">
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">What is Silent H.A.S.S Technology?</h2>
          <p class="bldc104">
            Silent H.A.S.S Technology is a revolutionary integration of Haneri’s two engineering marvels—Air Curve Design and TurboSilent BLDC Motor Technology. 
            By combining aerodynamically optimized blades with high-torque, energy-efficient motors, this Trademark Registered Pillar Technology achieves exceptional 
            air delivery at reduced RPM, redefining ceiling fan performance while ensuring whisper-quiet operation.            
          </p>
        </div>
        <div class="sm_h">
          <img src="/images/hass_2.png" alt="Blade Design" class="img-fluid" />
        </div>
      </div>

      <!-- Section 3 -->
      <div class="bldc102">
        <div class="sm_h">
          <img src="/images/hass_3.png" alt="Top view blades" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">Key Features of Silent H.A.S.S Technology</h2>
          <ul class="bldc106">
            <li><strong>High Air Delivery at Low RPM :</strong> Powered by Air Curve Design, the blades feature precision-engineered contours that maximize air displacement while optimizing drag. 
              <br>High torque from the TurboSilent BLDC Motor ensures efficient blade rotation, delivering consistent airflow even at reduced speeds.</li>
            <li><strong>Ultra-Quiet Operation :</strong> The low RPM operation, combined with Efficient Torque output from the TurboSilent BLDC Motor, eliminates mechanical noise, creating an ultra-quiet cooling experience.
            <br>Streamlined blade profiles reduce turbulence, further contributing to silent performance.</li>
            <li><strong>Enhanced Motor Efficiency :</strong> TurboSilent BLDC motors utilize advanced electromagnetic design for optimal torque-to-RPM ratios, ensuring seamless operation at low speeds.
            <br>Electronic Controller which has been made in India as per Indian Conditions , minimizes energy losses, making the system highly efficient and cost-effective.</li>
            <li><strong>Advanced Blade Aerodynamics :</strong>Blades designed with Air Curve Design use computational fluid dynamics (CFD) to optimize airflow pathways, ensuring maximum air delivery per watt of power consumed.</li>
            <li><strong>Trademarked Technology :</strong>Silent M.A.S.S Technology is a Trademark Registered Pillar of Haneri, integrating proprietary engineering solutions to deliver performance and efficiency.</li>
          </ul>
        </div>
      </div>

      <!-- Section 4 -->
      <div class="bldc107">
        <!-- Science -->
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">The Science Behind H.A.S.S Technology</h2>
          <ul class="bldc106 text-justify">
            <li><strong>Aerodynamic Optimization with Air Curve Design :</strong> Advanced blade profiles create an efficient pressure differential, maximizing air displacement while operating at slower speeds. <br>
            The design minimizes resistance and turbulence, reducing energy wastage and noise.</li>
            <li><strong>High-Torque Motor Performance :</strong> TurboSilent BLDC Motors leverage high torque generation to power blades effectively at low RPM, ensuring consistent airflow without 
              overloading the system. <br>Field-oriented control (FOC) and advanced motor algorithms enable precise speed regulation, maintaining performance consistency.</li>
            <li><strong>Integrated System Design :</strong> The synergy between Air Curve Design and TurboSilent BLDC Motors ensures that every component is optimized for efficiency and performance, eliminating bottlenecks in airflow or energy transfer.</li>
            <li><strong>Energy Optimization :</strong> Combined with energy-efficient motor controls and low-drag blade designs, Silent M.A.S.S Technology reduces power consumption significantly, contributing to lower operational costs and a smaller carbon footprint.</li>
          </ul>
        </div>

        <!-- Benefits -->
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
      </div><!-- /Section 4 -->
    </div><!-- /.bldc001 -->
  </div><!-- /#hass-page -->
  <script>
/* Entrance reveal — lightweight */
(()=>{const els=document.querySelectorAll('#hass-page .bldc102,#hass-page .bldc107,#hass-page .bldc109');
els.forEach(e=>e.classList.add('reveal'));
if(window.matchMedia('(prefers-reduced-motion: reduce)').matches){els.forEach(e=>e.classList.add('in'));return;}
const io=new IntersectionObserver(es=>{es.forEach(en=>{if(en.isIntersecting){en.target.classList.add('in');io.unobserve(en.target);}})},{threshold:.15});
els.forEach(e=>io.observe(e));})();
</script>

</main>
