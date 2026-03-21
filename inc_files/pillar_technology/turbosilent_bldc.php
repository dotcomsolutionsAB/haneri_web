<!-- Fonts (safe to include once site-wide) -->
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

<style>
 /* =========================================================
   BLDC PAGE — BASE / TOKENS (mobile-first)
   ========================================================= */
#bldc-page { color:#1F2A2E; background:#fff; padding-bottom:80px; }
#bldc-page *, #bldc-page *::before, #bldc-page *::after { box-sizing:border-box; }

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
  --green: #005d5a;
  --orange: #CA5D27;
}

/* =========================================================
   TYPE
   ========================================================= */
#bldc-page .bldc103{
  font-family:"Barlow Condensed", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  font-size: clamp(30px, 5vw, 56px);
  line-height: 1.03;
  margin: 0 0 10px;
  font-weight: 300;
  color: var(--green);
}
#bldc-page .bldc103 b{ color: var(--orange); font-weight: 500; }

#bldc-page .bldc104,
#bldc-page .bldc106,
#bldc-page .bldch3 p{
  font-family:"Montserrat", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  color:#1F2A2E;
}
#bldc-page .bldc104{
  font-size: clamp(14px, 1.1vw, 15px);
  line-height: 1.75;
  margin: 0;
  max-width: 62ch;
}

/* =========================================================
   LAYOUT ROWS
   ========================================================= */
/* default: stack on mobile */
#bldc-page .bldc102{
  display:grid;
  grid-template-columns: 1fr;
  gap: 18px;
  align-items:start;
  margin-top: var(--space-md);
}
#bldc-page .bldc102:first-of-type{ margin-top:0; }

/* features + benefits wrapper */
#bldc-page .bldc107{
  display:grid;
  grid-template-columns: 1fr;
  gap: var(--gap-row) var(--gap-col);
  align-items:start;
  margin-top: var(--space-md);
}

/* media blocks */
#bldc-page .sm_h{ position:relative; }
#bldc-page .sm_h img{
  display:block; width:100%; height:auto; border:0; box-shadow:none; background:transparent; transform: translateZ(0);
}

/* subtle image hover (pointer devices only) */
@media (hover:hover) and (pointer:fine){
  #bldc-page .sm_h{ overflow:hidden; border-radius:10px; }
  #bldc-page .sm_h img{ transition: transform .45s ease, filter .45s ease; }
  #bldc-page .sm_h:hover img{ transform: scale(1.03); filter: saturate(1.04) contrast(1.02); }
}

/* =========================================================
   BULLETS
   ========================================================= */
#bldc-page .bldc106{
  list-style:none; margin:0; padding:0;
  display:grid; gap:14px;
}
#bldc-page .bldc106 li{
  position:relative; padding-left:20px; line-height:1.7;
}
#bldc-page .bldc106 li::before{
  content:""; position:absolute; left:0; top:.55em;
  width:8px; height:8px; border-radius:50%; background:var(--orange);
}
#bldc-page .bldc106 li strong{ color:var(--green); }

/* =========================================================
   BENEFITS GRID / CARDS
   ========================================================= */
/* equal-height, responsive */
#bldc-page .bldc108{
  display:grid;
  grid-template-columns: 1fr;      /* mobile: stack */
  gap: 18px;
  align-items: stretch;
}
#bldc-page .bldc108 > div{ height:100%; }  /* wrapper fills track */

#bldc-page .bldc109{
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
#bldc-page .bldc110{ width:60px; height:60px; object-fit:contain; }

#bldc-page .bldch3 h3{
  margin:0 0 4px;
  font-family:"Barlow Condensed", ui-sans-serif;
  font-weight:500;
  font-size: clamp(20px, 2.2vw, 26px);
  line-height:1.05;
  color: var(--orange);
}
#bldc-page .bldch3 p{
  margin:0;
  color:#005d5a;
  font-size:14.5px;
  line-height:1.6;
}

/* hover affordances */
@media (hover:hover) and (pointer:fine){
  #bldc-page .bldc109:hover{ box-shadow:0 8px 24px rgba(0,0,0,.06); transform: translateY(-2px); }
  #bldc-page .bldc109:focus-within{ box-shadow:0 8px 24px rgba(0,0,0,.08); transform: translateY(-1px); }
}

/* helpers */
#bldc-page .mt-2{ margin-top: var(--space-sm); }
#bldc-page .mt-4{ margin-top: var(--space-md); }
#bldc-page .text-justify{ text-align: justify; }

/* =========================================================
   MOTION (no layout shift)
   ========================================================= */
@media (prefers-reduced-motion: no-preference){
  @keyframes bldc-fade-up { from{opacity:0; transform:translateY(18px);} to{opacity:1; transform:none;} }
  #bldc-page .reveal.in{ animation:bldc-fade-up .6s ease both; }
  /* benefit card gentle stagger */
  #bldc-page .bldc108 > div:nth-child(2) .bldc109.reveal.in{ animation-delay:.08s; }
  #bldc-page .bldc108 > div:nth-child(3) .bldc109.reveal.in{ animation-delay:.16s; }
  #bldc-page .bldc108 > div:nth-child(4) .bldc109.reveal.in{ animation-delay:.24s; }
}

/* =========================================================
   MOBILE SPECIALS
   ========================================================= */
/* 2nd .bldc102: image first on phones */
@media (max-width: 767px){
  #bldc-page .bldc102:nth-of-type(2){
    display:flex; flex-direction:column-reverse;
  }
  #bldc-page .bldc102:nth-of-type(2) > .sm_h:first-child{ order:-1; }
}

/* very small phones */
@media (max-width: 520px){
  #bldc-page .bldc109{ grid-template-columns: 60px 1fr; padding:12px; gap:12px; }
  #bldc-page .bldc110{ width:48px; height:48px; }
  #bldc-page .bldch3 h3{ font-size:20px; }
  #bldc-page .bldch3 p{ font-size:13.5px; line-height:1.55; }
  #bldc-page .bldc108{ gap:10px !important; }
}
@media (max-width: 380px){
  #bldc-page .bldc109{ grid-template-columns: 54px 1fr; }
  #bldc-page .bldc110{ width:42px; height:42px; }
}

/* =========================================
   TABLET (stack image + content full width)
   ========================================= */
@media (min-width: 768px) and (max-width: 1199px){
  /* 1) Make each row full-width stacked */
  #bldc-page .bldc102{
    grid-template-columns: 1fr;   /* was 1.05fr 1fr */
    gap: 28px;                    /* a bit more breathing room */
  }

  /* 2) Let body copy span full width */
  #bldc-page .bldc104{
    max-width: none;              /* was 62ch */
  }

  /* 3) Make sure images stretch nicely */
  #bldc-page .sm_h img{
    width: 100%;
    height: auto;
    object-fit: cover;            /* keep it neat if your images are taller */
  }
}


/* =========================================================
   DESKTOP (≥1200px)
   ========================================================= */
@media (min-width: 1200px){
  #bldc-page .bldc102{
    grid-template-columns: 1.05fr 1fr;
    gap: var(--space-lg) var(--gap-col);
  }
  /* benefits keep two-up, bigger gutters */
  #bldc-page .bldc108{
    grid-template-columns: repeat(2, minmax(320px, 1fr));
    gap: 28px 40px;
  }
  #bldc-page .bldc109{ grid-template-columns: 88px 1fr; }
  #bldc-page .bldc110{ width:72px; height:72px; }
}

</style>


<main class="main">
  <div id="bldc-page">

    <!-- Section 1 -->
    <div class="bldc001">
      <div class="bldc102">
        <div class="sm_h">
          <img src="images/turbo_2.png" alt="Motor Visual" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103"><b>Introducing TurboSilent BLDC:</b><br>Unleashing Unmatched Power and Efficiency</h2>
          <p class="bldc104">
            At HANERI, we redefine engineering excellence with our proprietary TurboSilent BLDC Technology. This advanced motor design not only delivers higher 
            torque and exceptional durability but also ensures unmatched energy efficiency, setting a new benchmark for ceiling fan performance and contributing to a 
            greener environment.
          </p>
        </div>
      </div>

      <!-- Section 2 -->
      <div class="bldc102 mt-2">
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">What is TurboSilent BLDC Technology?</h2>
          <p class="bldc104">
            TurboSilent BLDC (Brushless Direct Current) Technology is an in-house developed motor system that employs high-tech electromagnetic and mechanical design 
            principles. This cutting-edge innovation enhances torque delivery, minimizes energy losses, and ensures extended motor lifespan. TurboSilent motors are 
            engineered to outperform conventional systems, offering industry-leading reliability and precision that you can trust.
          </p>
        </div>
        <div class="sm_h">
          <img src="images/turbo_1.png" alt="Blade Design" class="img-fluid" />
        </div>
      </div>

      <!-- Section 3 -->
      <div class="bldc102 mt-2">
        <div class="sm_h">
          <img src="images/turbo_3.png" alt="Motor Render" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">The Science Behind Turbosilent BLDC Technology</h2>
          <ul class="bldc106">
            <li><strong>Electromagnetic Optimization:</strong> It uses Finite Element Analysis (FEA) to design and validate the magnetic circuit, maximizing flux density while minimizing losses.</li>
            <li><strong>Thermal Management:</strong> Employs advanced cooling designs, including optimized ventilation paths and materials, to maintain motor efficiency under continuous operation.</li>
            <li><strong>Smart Power Electronics:</strong> Integrated drivers, meticulously designed for seamless operation, instil confidence with precise speed control and minimal switching losses. Advanced motor control algorithms, including Field-Oriented Control (FOC), enable precise torque and speed regulation.</li>
            <li><strong>Structural Engineering:</strong> The magnet rotor dynamics are meticulously optimized, providing reassuring stability and minimizing resonance at all operating speeds. Lightweight, high-strength materials not only reduce the motor's overall weight but also enhance its durability and performance, achieving the perfect balance between these factors.</li>
          </ul>
        </div>
      </div>

      <!-- Section 4 -->
      <div class="bldc107 mt-4">
        <!-- Left: Advantages -->
        <div class="sm_h c01" style="justify-content:flex-start;">
          <h2 class="bldc103 mb-4">Unique Advantages of TurboSilent BLDC Technology</h2>
          <ul class="bldc106 text-justify">
            <li><strong>Higher Torque for Optimized Performance: </strong> The TurboSilent motor stands out with its superior performance. It achieves higher torque through optimized magnetic flux density and reduced electromagnetic losses.Advanced stator and Magnet designs enhance the torque constant (kT), providing superior air circulation, even at varying speeds.</li>
            <li><strong>Long-Term Durability: </strong> Designed for long-term durability, the TurboSilent motors are constructed with premium-grade laminations and heat-resistant winding materials to minimize core losses and thermal degradation. The motor is fitted with high-precision ball bearings and balanced rotor assemblies, reducing mechanical wear and extending operational life.</li>
            <li><strong>Enhanced Energy Efficiency: </strong> TurboSilent motors utilize sinusoidal commutation to reduce current ripple and improve efficiency.Power electronics are optimized to deliver consistent performance while consuming up to 65% less energy than traditional motors.</li>
            <li><strong>Thermal Management of Electronics: </strong> Electronics PCBs are made in India and have been tested according to Indian Conditions. A key focus is the thermal management of critical components to ensure longer life and better performance.</li>
            <li><strong>In-House Innovation and Testing: </strong> Developed using simulation tools for computational electromagnetic analysis (CEM). Rigorously validated under real-world conditions to ensure robustness across a wide range of operating environments.</li>
          </ul>
        </div>

        <!-- Questions -->
        <div class="sm_h c01" style="justify-content:flex-start;">
          <h2 class="bldc103 mb-1">Why Choose HANERI TurboSilent Ceiling Fans?</h2>
          <p>
            HANERI’S TurboSilent BLDC Technology offers a sophisticated combination of engineering precision and operational excellence. Focusing on high torque, 
            energy savings, and durability, TurboSilent motors set the gold standard in modern ceiling fan design.
          </p>
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
                <img src="images/mordern_asthetics.png" class="bldc110" alt="Modern Aesthetics" />
                <div class="bldch3">
                  <h3>Modern Aesthetics</h3>
                  <p>
                    Sleek, innovative blade designs complement contemporary interiors, adding a touch of sophistication to your space.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /Section 4 -->

    </div><!-- /.bldc001 -->
  </div><!-- /#bldc-page -->
</main>

<script>
(() => {
  // Mark reveal targets without changing your HTML structure
  const targets = document.querySelectorAll('#bldc-page .bldc102, #bldc-page .bldc107, #bldc-page .bldc109');
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
  const targets = document.querySelectorAll('#bldc-page .bldc102, #bldc-page .bldc107, #bldc-page .bldc109');
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


