<!-- Fonts -->
<link
  href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;600&family=Montserrat:wght@400;500;600&display=swap"
  rel="stylesheet">

<style>
/* =========================================================
   BLDC PAGE — BASE / TOKENS (mobile-first)
   ========================================================= */
#scan-Tech { color:#1F2A2E; background:#fff; padding-bottom:80px; }
#scan-Tech *, #scan-Tech *::before, #scan-Tech *::after { box-sizing:border-box; }

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
#scan-Tech .bldc103{
  font-family:"Barlow Condensed", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  font-size: clamp(30px, 5vw, 56px);
  line-height: 1.03;
  margin: 0 0 10px;
  font-weight: 300;
  color: var(--green);
}
#scan-Tech .bldc103 b{ color: var(--orange); font-weight: 500; }

#scan-Tech .bldc104,
#scan-Tech .bldc106,
#scan-Tech .bldch3 p{
  font-family:"Montserrat", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  color:#1F2A2E;
}
#scan-Tech .bldc104{
  font-size: clamp(14px, 1.1vw, 15px);
  line-height: 1.75;
  margin: 0;
  max-width: 62ch;
}

/* =========================================================
   LAYOUT ROWS
   ========================================================= */
/* default: stack on mobile */
#scan-Tech .bldc102{
  display:grid;
  grid-template-columns: 1fr;
  gap: 18px;
  align-items:start;
  margin-top: var(--space-md);
}
#scan-Tech .bldc102:first-of-type{ margin-top:0; }

/* features + benefits wrapper */
#scan-Tech .bldc107{
  display:grid;
  grid-template-columns: 1fr;
  gap: var(--gap-row) var(--gap-col);
  align-items:start;
  margin-top: var(--space-md);
}

/* media blocks */
#scan-Tech .sm_h{ position:relative; }
#scan-Tech .sm_h img{
  display:block; width:100%; height:auto; border:0; box-shadow:none; background:transparent; transform: translateZ(0);
}

/* subtle image hover (pointer devices only) */
@media (hover:hover) and (pointer:fine){
  #scan-Tech .sm_h{ overflow:hidden; border-radius:10px; }
  #scan-Tech .sm_h img{ transition: transform .45s ease, filter .45s ease; }
  #scan-Tech .sm_h:hover img{ transform: scale(1.03); filter: saturate(1.04) contrast(1.02); }
}

/* =========================================================
   BULLETS
   ========================================================= */
#scan-Tech .bldc106{
  list-style:none; margin:0; padding:0;
  display:grid; gap:14px;
}
#scan-Tech .bldc106 li{
  position:relative; padding-left:20px; line-height:1.7;
}
#scan-Tech .bldc106 li::before{
  content:""; position:absolute; left:0; top:.55em;
  width:8px; height:8px; border-radius:50%; background:var(--orange);
}
#scan-Tech .bldc106 li strong{ color:var(--green); }

/* =========================================================
   BENEFITS GRID / CARDS
   ========================================================= */
/* equal-height, responsive */
#scan-Tech .bldc108{
  display:grid;
  grid-template-columns: 1fr;      /* mobile: stack */
  gap: 18px;
  align-items: stretch;
}
#scan-Tech .bldc108 > div{ height:100%; }  /* wrapper fills track */

#scan-Tech .bldc109{
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
#scan-Tech .bldc110{ width:60px; height:60px; object-fit:contain; }

#scan-Tech .bldch3 h3{
  margin:0 0 4px;
  font-family:"Barlow Condensed", ui-sans-serif;
  font-weight:500;
  font-size: clamp(20px, 2.2vw, 26px);
  line-height:1.05;
  color: var(--orange);
}
#scan-Tech .bldch3 p{
  margin:0;
  color:#315859;
  font-size:14.5px;
  line-height:1.6;
}

/* hover affordances */
@media (hover:hover) and (pointer:fine){
  #scan-Tech .bldc109:hover{ box-shadow:0 8px 24px rgba(0,0,0,.06); transform: translateY(-2px); }
  #scan-Tech .bldc109:focus-within{ box-shadow:0 8px 24px rgba(0,0,0,.08); transform: translateY(-1px); }
}

/* helpers */
#scan-Tech .mt-2{ margin-top: var(--space-sm); }
#scan-Tech .mt-4{ margin-top: var(--space-md); }
#scan-Tech .text-justify{ text-align: justify; }

/* =========================================================
   MOTION (no layout shift)
   ========================================================= */
@media (prefers-reduced-motion: no-preference){
  @keyframes bldc-fade-up { from{opacity:0; transform:translateY(18px);} to{opacity:1; transform:none;} }
  #scan-Tech .reveal.in{ animation:bldc-fade-up .6s ease both; }
  /* benefit card gentle stagger */
  #scan-Tech .bldc108 > div:nth-child(2) .bldc109.reveal.in{ animation-delay:.08s; }
  #scan-Tech .bldc108 > div:nth-child(3) .bldc109.reveal.in{ animation-delay:.16s; }
  #scan-Tech .bldc108 > div:nth-child(4) .bldc109.reveal.in{ animation-delay:.24s; }
}

/* =========================================================
   MOBILE SPECIALS
   ========================================================= */
/* 2nd .bldc102: image first on phones */
@media (max-width: 767px){
  #scan-Tech .bldc102:nth-of-type(2){
    display:flex; flex-direction:column-reverse;
  }
  #scan-Tech .bldc102:nth-of-type(2) > .sm_h:first-child{ order:-1; }
}

/* very small phones */
@media (max-width: 520px){
  #scan-Tech .bldc109{ grid-template-columns: 60px 1fr; padding:12px; gap:12px; }
  #scan-Tech .bldc110{ width:48px; height:48px; }
  #scan-Tech .bldch3 h3{ font-size:20px; }
  #scan-Tech .bldch3 p{ font-size:13.5px; line-height:1.55; }
  #scan-Tech .bldc108{ gap:10px !important; }
}
@media (max-width: 380px){
  #scan-Tech .bldc109{ grid-template-columns: 54px 1fr; }
  #scan-Tech .bldc110{ width:42px; height:42px; }
}

/* =========================================
   TABLET (stack image + content full width)
   ========================================= */
@media (min-width: 768px) and (max-width: 1199px){
  /* 1) Make each row full-width stacked */
  #scan-Tech .bldc102{
    grid-template-columns: 1fr;   /* was 1.05fr 1fr */
    gap: 28px;                    /* a bit more breathing room */
  }

  /* 2) Let body copy span full width */
  #scan-Tech .bldc104{
    max-width: none;              /* was 62ch */
  }

  /* 3) Make sure images stretch nicely */
  #scan-Tech .sm_h img{
    width: 100%;
    height: auto;
    object-fit: cover;            /* keep it neat if your images are taller */
  }
}


/* =========================================================
   DESKTOP (≥1200px)
   ========================================================= */
@media (min-width: 1200px){
  #scan-Tech .bldc102{
    grid-template-columns: 1.05fr 1fr;
    gap: var(--space-lg) var(--gap-col);
  }
  /* benefits keep two-up, bigger gutters */
  #scan-Tech .bldc108{
    grid-template-columns: repeat(2, minmax(320px, 1fr));
    gap: 28px 40px;
  }
  #scan-Tech .bldc109{ grid-template-columns: 88px 1fr; }
  #scan-Tech .bldc110{ width:72px; height:72px; }
}

</style>

<main class="main">
  <div id="scan-Tech">


    <div class="bldc001">
      <!-- Section 1 -->
      <div class="bldc102">
        <div class="sm_h">
          <img src="images/scan_1.png" alt="Motor Visual" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103">Discover the Future of Fan with :<b> S.C.A.N Technology</b></h2>
          <p class="bldc104">
            At HANERI, we've combined innovation with convenience in our state-of-the-art S.C.A.N Technology (Smooth Control , Advance Navigation). This technology, 
            designed for the modern home, redefines your interaction with ceiling fans, offering an optional LED light for added convenience. With its sleek aesthetics 
            and advanced functionality, this futuristic remote controller ensures seamless control, an enhanced user experience, and cutting-edge technology, all at 
            your fingertips.
          </p>
        </div>
      </div>

      <!-- Section 2 -->
      <div class="bldc102 mt-2">
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">What is S.C.A.N Technology?</h2>
          <p class="bldc104">
            S.C.A.N Technology is a next-generation radio frequency (RF) control system that offers unparalleled convenience and precision when operating ceiling fans. 
            With advanced control features such as speed adjustment, lighting control, timer settings, and unique operating modes, S.C.A.N Technology brings futuristic 
            functionality into the palm of your hand.
          </p>
        </div>
        <div class="sm_h">
          <img src="images/scan_2.png" alt="Blade Design" class="img-fluid" />
        </div>
      </div>

      <!-- Section 3 -->
      <div class="bldc102 mt-2">
        <div class="sm_h" style="display: flex; justify-content: center; align-items: center;">
          <img src="images/scan_3.png" alt="Motor Render" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">Key Features of Silent S.C.A.N Technology</h2>
          <ul class="bldc106">
            <li>
                <strong>Futuristic Design:</strong> 
                The S.C.A.N remote controller, with its ergonomic design, intuitive button placement, and sleek, modern look, offers a convenient and comfortable user experience. 
                Its high-quality materials and lightweight form factor make it comfortable and durable for everyday use.
            </li>
            <li>
                <strong>Comprehensive Fan Control:</strong> 
                With the S.C.A.N remote controller, you can effortlessly adjust fan speed across multiple levels, giving you complete control over your cooling experience. 
                Includes two unique modes:
                <ul>
                    <li>Breeze Mode: Simulates natural airflow patterns, creating a relaxing and refreshing environment.</li>
                    <li>Turbo Speed Mode: Activates maximum fan speed for quick and powerful cooling.</li>
                </ul>
            </li>
            <li>
                <strong>LED Light Integration:</strong> 
                Control LED lights (where available) with the same remote, including switching on/off and changing the Colour Tones if the product is equipped with Haneri’s LumiAmbience Technology. 
                Synchronizes seamlessly with fans, offering complete control and convenience.
            </li>
            <li>
                <strong>Advanced Timer Functionality:</strong> 
                Set programmable timers to automatically switch the fan or light on/off, optimizing energy efficiency and user comfort.
            </li>
            <li>
                <strong>Reliable Radio Frequency Control:</strong> 
                The S.C.A.N remote controller operates on advanced RF technology, ensuring reliable control from greater distances without requiring line-of-sight. 
                This gives you a secure and confident experience, and it eliminates signal interference for a smooth and responsive experience.
            </li>
            <li>
                <strong>Power Efficiency:</strong> 
                Low-power RF communication ensures extended battery life for the remote controller.
            </li>

          </ul>
        </div>
      </div>


      <!-- Section 4 -->
      <div class="bldc107 mt-4">
        <!-- Left: Advantages -->
        <div class="sm_h c01" style="justify-content: flex-start;">
          <h2 class="bldc103 mb-4">The Science behind S.C.A.N Technology</h2>
          <ul class="bldc106 text-justify">
            <li>
              <strong>Radio Frequency (RF) Innovation :</strong>
              Operates on robust RF bands to provide uninterrupted control even through walls or obstructions. Advanced
              signal encoding prevents interference from other wireless devices, ensuring reliability.
            </li>
            <li>
              <strong>Integrated Microcontroller System :</strong>
              Embedded microcontroller units (MCUs) process user inputs for instantaneous response. The system supports
              multi-functional commands, enabling simultaneous fan speed and light adjustments.
            </li>
            <li>
              <strong>Energy Optimization :</strong>
              Timer algorithms and innovative sleep modes ensure energy-efficient operation of both the remote and
              connected devices.
            </li>
            <li>
              <strong>Multi-Mode Control Logic :</strong>
               <span style="color:#00473E">Breeze Mode</span> Powered by dynamic speed variation algorithms to mimic
              natural airflow.
              <br>
              <span style="color:#00473E">Turbo Mode</span> Leverages direct motor communication to maximize fan
              performance instantly.
            </li>
          </ul>
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
      </div>
      
    </div><!-- /.bldc001 -->
  </div><!-- /#scan-Tech -->
<script>
(() => {
  // Mark reveal targets without changing your HTML structure
  const targets = document.querySelectorAll('#scan-Tech .bldc102, #scan-Tech .bldc107, #scan-Tech .bldc109');
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
  const targets = document.querySelectorAll('#scan-Tech .bldc102, #scan-Tech .bldc107, #scan-Tech .bldc109');
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