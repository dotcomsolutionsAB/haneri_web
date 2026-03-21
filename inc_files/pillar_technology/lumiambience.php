<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

<style>
 /* =========================================================
   BLDC PAGE — BASE / TOKENS (mobile-first)
   ========================================================= */
#lumi-Ambience { color:#1F2A2E; background:#fff; padding-bottom:80px; }
#lumi-Ambience *, #lumi-Ambience *::before, #lumi-Ambience *::after { box-sizing:border-box; }

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
#lumi-Ambience .bldc103{
  font-family:"Barlow Condensed", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  font-size: clamp(30px, 5vw, 56px);
  line-height: 1.03;
  margin: 0 0 10px;
  font-weight: 300;
  color: var(--green);
}
#lumi-Ambience .bldc103 b{ color: var(--orange); font-weight: 500; }

#lumi-Ambience .bldc104,
#lumi-Ambience .bldc106,
#lumi-Ambience .bldch3 p{
  font-family:"Montserrat", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  color:#1F2A2E;
}
#lumi-Ambience .bldc104{
  font-size: clamp(14px, 1.1vw, 15px);
  line-height: 1.75;
  margin: 0;
  max-width: 62ch;
}

/* =========================================================
   LAYOUT ROWS
   ========================================================= */
/* default: stack on mobile */
#lumi-Ambience .bldc102{
  display:grid;
  grid-template-columns: 1fr;
  gap: 18px;
  align-items:start;
  margin-top: var(--space-md);
}
#lumi-Ambience .bldc102:first-of-type{ margin-top:0; }

/* features + benefits wrapper */
#lumi-Ambience .bldc107{
  display:grid;
  grid-template-columns: 1fr;
  gap: var(--gap-row) var(--gap-col);
  align-items:start;
  margin-top: var(--space-md);
}

/* media blocks */
#lumi-Ambience .sm_h{ position:relative; }
#lumi-Ambience .sm_h img{
  display:block; width:100%; height:auto; border:0; box-shadow:none; background:transparent; transform: translateZ(0);
}

/* subtle image hover (pointer devices only) */
@media (hover:hover) and (pointer:fine){
  #lumi-Ambience .sm_h{ overflow:hidden; border-radius:10px; }
  #lumi-Ambience .sm_h img{ transition: transform .45s ease, filter .45s ease; }
  #lumi-Ambience .sm_h:hover img{ transform: scale(1.03); filter: saturate(1.04) contrast(1.02); }
}

/* =========================================================
   BULLETS
   ========================================================= */
#lumi-Ambience .bldc106{
  list-style:none; margin:0; padding:0;
  display:grid; gap:14px;
}
#lumi-Ambience .bldc106 li{
  position:relative; padding-left:20px; line-height:1.7;
}
#lumi-Ambience .bldc106 li::before{
  content:""; position:absolute; left:0; top:.55em;
  width:8px; height:8px; border-radius:50%; background:var(--orange);
}
#lumi-Ambience .bldc106 li strong{ color:var(--green); }

/* =========================================================
   BENEFITS GRID / CARDS
   ========================================================= */
/* equal-height, responsive */
#lumi-Ambience .bldc108{
  display:grid;
  grid-template-columns: 1fr;      /* mobile: stack */
  gap: 18px;
  align-items: stretch;
}
#lumi-Ambience .bldc108 > div{ height:100%; }  /* wrapper fills track */

#lumi-Ambience .bldc109{
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
#lumi-Ambience .bldc110{ width:60px; height:60px; object-fit:contain; }

#lumi-Ambience .bldch3 h3{
  margin:0 0 4px;
  font-family:"Barlow Condensed", ui-sans-serif;
  font-weight:500;
  font-size: clamp(20px, 2.2vw, 26px);
  line-height:1.05;
  color: var(--orange);
}
#lumi-Ambience .bldch3 p{
  margin:0;
  color:#005d5a;
  font-size:14.5px;
  line-height:1.6;
}

/* hover affordances */
@media (hover:hover) and (pointer:fine){
  #lumi-Ambience .bldc109:hover{ box-shadow:0 8px 24px rgba(0,0,0,.06); transform: translateY(-2px); }
  #lumi-Ambience .bldc109:focus-within{ box-shadow:0 8px 24px rgba(0,0,0,.08); transform: translateY(-1px); }
}

/* helpers */
#lumi-Ambience .mt-2{ margin-top: var(--space-sm); }
#lumi-Ambience .mt-4{ margin-top: var(--space-md); }
#lumi-Ambience .text-justify{ text-align: justify; }

/* =========================================================
   MOTION (no layout shift)
   ========================================================= */
@media (prefers-reduced-motion: no-preference){
  @keyframes bldc-fade-up { from{opacity:0; transform:translateY(18px);} to{opacity:1; transform:none;} }
  #lumi-Ambience .reveal.in{ animation:bldc-fade-up .6s ease both; }
  /* benefit card gentle stagger */
  #lumi-Ambience .bldc108 > div:nth-child(2) .bldc109.reveal.in{ animation-delay:.08s; }
  #lumi-Ambience .bldc108 > div:nth-child(3) .bldc109.reveal.in{ animation-delay:.16s; }
  #lumi-Ambience .bldc108 > div:nth-child(4) .bldc109.reveal.in{ animation-delay:.24s; }
}

/* =========================================================
   MOBILE SPECIALS
   ========================================================= */
/* 2nd .bldc102: image first on phones */
@media (max-width: 767px){
  #lumi-Ambience .bldc102:nth-of-type(2){
    display:flex; flex-direction:column-reverse;
  }
  #lumi-Ambience .bldc102:nth-of-type(2) > .sm_h:first-child{ order:-1; }
}

/* very small phones */
@media (max-width: 520px){
  #lumi-Ambience .bldc109{ grid-template-columns: 60px 1fr; padding:12px; gap:12px; }
  #lumi-Ambience .bldc110{ width:48px; height:48px; }
  #lumi-Ambience .bldch3 h3{ font-size:20px; }
  #lumi-Ambience .bldch3 p{ font-size:13.5px; line-height:1.55; }
  #lumi-Ambience .bldc108{ gap:10px !important; }
}
@media (max-width: 380px){
  #lumi-Ambience .bldc109{ grid-template-columns: 54px 1fr; }
  #lumi-Ambience .bldc110{ width:42px; height:42px; }
}

/* =========================================
   TABLET (stack image + content full width)
   ========================================= */
@media (min-width: 768px) and (max-width: 1199px){
  /* 1) Make each row full-width stacked */
  #lumi-Ambience .bldc102{
    grid-template-columns: 1fr;   /* was 1.05fr 1fr */
    gap: 28px;                    /* a bit more breathing room */
  }

  /* 2) Let body copy span full width */
  #lumi-Ambience .bldc104{
    max-width: none;              /* was 62ch */
  }

  /* 3) Make sure images stretch nicely */
  #lumi-Ambience .sm_h img{
    width: 100%;
    height: auto;
    object-fit: cover;            /* keep it neat if your images are taller */
  }
}


/* =========================================================
   DESKTOP (≥1200px)
   ========================================================= */
@media (min-width: 1200px){
  #lumi-Ambience .bldc102{
    grid-template-columns: 1.05fr 1fr;
    gap: var(--space-lg) var(--gap-col);
  }
  /* benefits keep two-up, bigger gutters */
  #lumi-Ambience .bldc108{
    grid-template-columns: repeat(2, minmax(320px, 1fr));
    gap: 28px 40px;
  }
  #lumi-Ambience .bldc109{ grid-template-columns: 88px 1fr; }
  #lumi-Ambience .bldc110{ width:72px; height:72px; }
}
</style>

<main class="main">
  <div id="lumi-Ambience">

    
    <div class="bldc001">
      <!-- Section 1 -->
      <div class="bldc102">
        <div class="sm_h">
          <img src="/images/lumi_1.png" alt="Motor Visual" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103"><b>Introducing LumiAmbience Technology</b> Revolutionizing Lighting with Precision</h2>
          <p class="bldc104">
            At Haneri, we push the boundaries of innovation, not just in cooling but also in creating holistic lifestyle solutions. Our revolutionary LumiAmbience Technology transforms lighting into an experience, offering unparalleled control, comfort, and a sense of ease. Designed as an optional feature for select ceiling fans, LumiAmbience combines advanced lighting engineering with Haneri’s signature aesthetic excellence.
          </p>
        </div>
      </div>

      <!-- Section 2 -->
      <div class="bldc102">
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">What is LumiAmbience Technology?</h2>
          <p class="bldc104">
            LumiAmbience Technology integrates a state-of-the-art 3-in-1 LED lighting system into select Haneri ceiling fans, allowing you to adapt your lighting to any mood or occasion. The system features Warm White, Cool White, and Natural White light modes, each engineered for specific settings. LumiAmbience stands apart with its proprietary lens diffuser that ensures even light distribution, eliminates harsh LED spots, and creates a soothing ambience for your space.
        </div>
        <div class="sm_h">
          <img src="/images/lumi_2.png" alt="Blade Design" class="img-fluid" />
        </div>
      </div>

      <!-- Section 3 -->
      <div class="bldc102">
        <div class="sm_h">
          <img src="/images/lumi_3.png" alt="Top view blades" class="img-fluid" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">Key Features of LumiAmbience Technology</h2>
          <ul class="bldc106">
              <li>
                  <strong>Three-in-One Color Options:</strong> 
                  Warm White: Perfect for relaxed evenings or cosy settings, offering a soft, inviting glow. 
                  Cool White: Ideal for productivity-focused environments, providing bright and energizing illumination. 
                  Natural White: Mimics natural daylight, creating a balanced, comfortable ambience for versatile use.
              </li>
              <li>
                  <strong>Eye-Comforting Lens Diffuser:</strong> 
                  LumiAmbience’s proprietary diffuser eliminates visible LED spots, ensuring a smooth, uniform light spread that reduces eye strain and enhances visual comfort. 
                  The diffuser technology creates a soft glow that transforms harsh lighting into a calming experience.
              </li>
              <li>
                  <strong>Optimized Light Spread:</strong> 
                  Engineered to illuminate spaces evenly, LumiAmbience ensures every corner is lit with consistent brightness, avoiding dark patches or harsh shadows.
              </li>
              <li>
                  <strong>Integrated Control:</strong> 
                  Seamlessly manage lighting modes, brightness levels, and fan settings with Haneri’s advanced remote systems, including S.C.A.N Technology.
              </li>
              <li>
                  <strong>Energy-Efficient LED System:</strong> 
                  LumiAmbience LED lights are designed for maximum efficiency, consuming significantly less power while delivering superior brightness and longevity.
              </li>
          </ul>
        </div>
      </div>

      <!-- Section 4 -->
      <div class="bldc107">
        <!-- Science -->
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">The Science Behind LumiAmbience Technology</h2>
            <ul class="bldc106 text-justify">
                <li>
                    <strong>Advanced LED Engineering :</strong> 
                    LumiAmbience LEDs are crafted to produce precise colour temperatures, ensuring true-to-life illumination for each mode. High-quality diodes enhance durability and reduce power consumption, aligning with energy-saving standards.
                </li>
                <li>
                    <strong>Proprietary Lens Diffuser Technology :</strong>
                    The lens diffuser evenly distributes light, eliminating glare and harsh points of illumination. Optical-grade materials ensure consistent performance and long-term clarity.
                </li>
                <li>
                    <strong>Precision Circuitry :</strong>  
                    Intelligent LED drivers enable smooth transitions between colour modes and brightness levels, offering users unparalleled control and customization
                </li>
                <li>
                    <strong>Energy Optimization :</strong> 
                    Advanced power management minimizes energy wastage, ensuring high brightness with low power consumption.
                </li>
            </ul>
        </div>

        <!-- Questions -->
        <div class="sm_h c01">
          <h2 class="bldc103 mb-1">Why Choose Haneri LumiAmbience Ceiling Fans?</h2>
          <p>
            LumiAmbience Technology redefines what lighting can achieve, delivering advanced functionality and unparalleled comfort. With its unique lens diffuser, 
            customizable colour options, and seamless integration with Haneri ceiling fans, LumiAmbience sets a new standard in lighting innovation. It’s not just 
            about illumination—it’s about creating the perfect atmosphere for every moment.
          </p>
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103 mb-1">Experience LumiAmbience Technology Today!</h2>
          <p>
            Transform your space with Haneri’s LumiAmbience-enabled ceiling fans. Experience lighting that adapts to your mood and lifestyle with the added 
            elegance of Haneri’s cutting-edge design. Choose LumiAmbience Technology—where innovation meets ambience and lighting meets perfection.
          </p>
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
  </div><!-- /#lumi-Ambience -->
</main>
<script>
(() => {
  // Mark reveal targets without changing your HTML structure
  const targets = document.querySelectorAll('#lumi-Ambience .bldc102, #lumi-Ambience .bldc107, #lumi-Ambience .bldc109');
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
  const targets = document.querySelectorAll('#lumi-Ambience .bldc102, #lumi-Ambience .bldc107, #lumi-Ambience .bldc109');
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