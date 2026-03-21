<!-- Manufacturing & R&D Section -->
<div class="cpblts_107">
  <div class="cpblts_108 reveal reveal-up" data-delay="0">
    <div class="cpblts_109 reveal reveal-up" data-delay="100">
      <h2 class="cpblts_110">Excellence in Manufacturing, R&amp;D, and Innovation</h2>
      <p class="cpblts_111">
        At Haneri, we seamlessly integrate design, innovation, and precision manufacturing, ensuring every product
        exemplifies quality, functionality, and elegance.
      </p>
    </div>
    <div class="cpblts_div_img reveal reveal-up" data-delay="200">
      <img src="images/capa_2.png" alt="Manufacturing Image" class="cpblts_img" />
    </div>
  </div>

  <div class="cpblts_108 reveal reveal-up" data-delay="0">
    <div class="cpblts_109 reveal reveal-up" data-delay="100">
      <h2 class="cpblts_110">Product-Specific R&amp;D and Prototyping Facilities</h2>
      <p class="cpblts_111">
        Innovation is at the heart of Haneri. Our dedicated research and development teams focus on creating products
        that redefine everyday living.
      </p>
    </div>
    <div class="cpblts_div_img reveal reveal-up" data-delay="200">
      <img src="images/capa_1.png" alt="R&amp;D Facility Image" class="cpblts_img" />
    </div>
  </div>

  <div class="cpblts_108 reveal reveal-up" data-delay="0">
    <div class="cpblts_109 reveal reveal-up" data-delay="100">
      <h2 class="cpblts_110">Comprehensive Manufacturing Processes</h2>
      <p class="cpblts_111">
        Our robust manufacturing capabilities ensure end-to-end control, enabling consistent quality, quick turnarounds, and agile innovation.
      </p>
    </div>
    <div class="cpblts_div_img reveal reveal-up" data-delay="200">
      <img src="images/capa_3.png" alt="R&amp;D Facility Image" class="cpblts_img" />
    </div>
  </div>

  <div class="cpblts_108 reveal reveal-up" data-delay="0">
    <div class="cpblts_109 reveal reveal-up" data-delay="100">
      <h2 class="cpblts_110">Superior Surface Finishing Capabilities</h2>
      <p class="cpblts_111">
        Haneri’s advanced surface finishing ensures that every product meets the highest standards of aesthetics and longevity.
      </p>
    </div>
    <div class="cpblts_div_img reveal reveal-up" data-delay="200">
      <img src="images/capa_4.png" alt="R&amp;D Facility Image" class="cpblts_img" />
    </div>
  </div>

  <div class="cpblts_108 reveal reveal-up" data-delay="0">
    <div class="cpblts_109 reveal reveal-up" data-delay="100">
      <h2 class="cpblts_110">Design &amp; Tooling Expertise</h2>
      <p class="cpblts_111">
        Our in-house tool room for mold manufacturing and sophisticated 3D CAD design capabilities empower us to innovate with precision.
      </p>
    </div>
    <div class="cpblts_div_img reveal reveal-up" data-delay="200">
      <img src="images/capa_5.png" alt="R&amp;D Facility Image" class="cpblts_img" />
    </div>
  </div>
</div>


<style>
  /* ===== Capabilities: Variables & Base ===== */
  :root{
    --cap-maxw: 1200px;
    --cap-pad-x: 16px;
    --cap-gap-row: 28px;
    --cap-gap-col: 28px;
    --cap-radius: 14px;
    --cap-shadow: 0 6px 20px rgba(0,0,0,.06);
    --cap-stroke: #e5e7eb;
    --cap-heading-color: #005d5a;
  }

  /* Wrapper */
  .cpblts_107 {
    max-width: 100%;
    margin: 0px;
    padding: 0px;
  }

  /* Row Card */
  .cpblts_108 {
    display: grid;
    grid-template-columns: 1fr;
    gap: 16px;
    padding: 0px;
    /* border: 1px solid var(--cap-stroke); */
    border-radius: var(--cap-radius);
    background: #fff;
    /* box-shadow: var(--cap-shadow); */
  }
  .cpblts_107 .cpblts_108 + .cpblts_108 { margin-top: var(--cap-gap-row); }

  /* Text */
  .cpblts_109 { display: grid; gap: 12px; }
  .cpblts_110 {
    font-size: 58px;
    font-weight: 300;
    font-family: 'Barlow Condensed', sans-serif;
    color: var(--cap-heading-color);
    text-align: left;
    line-height: 1.2;
    margin: 0;
  }
  .cpblts_111 {
    font-size: 24px;
    font-family: 'Open Sans', sans-serif;
    line-height: 1.8;
    color: #000000;
    padding: 0px; /* as requested */
    text-align: left;
    margin: 0;
  }

  /* Image */
  .cpblts_div_img { width: 100%; position: relative; }
  .cpblts_img {
    width: 100%;
    height: 260px; /* mobile default */
    display: block;
    object-fit: cover;
    border-radius: calc(var(--cap-radius) - 2px);
  }
  /* ===== Image Zoom on Hover ===== */
  .cpblts_div_img {
    position: relative;
    overflow: hidden;           /* hides overflow for zoom effect */
    border-radius: calc(var(--cap-radius) - 2px);
  }

  .cpblts_div_img::after {
    content: "";
    position: absolute;
    inset: 0;
    border: 2px solid #e5e7eb;  /* subtle border around image */
    border-radius: inherit;
    pointer-events: none;
    transition: border-color 0.4s ease;
  }

  .cpblts_img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.7s ease, filter 0.4s ease;
    border-radius: inherit;
  }

  /* Hover effect: zoom slightly inward */
  .cpblts_div_img:hover .cpblts_img {
    transform: scale(1.08);     /* zoom-in */
    filter: brightness(1.05);   /* optional subtle brightness */
  }

  /* Border highlight on hover */
  .cpblts_div_img:hover::after {
    border-color: #005d5a;      /* same as your theme green */
  }   

  /* Tablet (≥768px) */
  @media (min-width: 768px) {
    .cpblts_108 {
      grid-template-columns: 1fr 1fr; /* text | image */
      gap: 50px;
      padding: 0px;
    }
    .cpblts_img { height: 320px; }
    .cpblts_108:nth-child(even) { grid-template-columns: 1fr 1fr; }
    .cpblts_108:nth-child(even) .cpblts_div_img { order: 1; }
    .cpblts_108:nth-child(even) .cpblts_109 { order: 2; }
  }

  /* Laptop (≥1024px) */
  @media (min-width: 1024px) {
    .cpblts_108 { grid-template-columns: 1fr 1fr; padding: 0px; }
    .cpblts_img { height: 380px; }
  }

  /* Large Desktop (≥1280px) */
  @media (min-width: 1280px) { .cpblts_img { height: 420px; } }

  /* Responsive type/padding */
  @media (max-width: 991px) {
    .cpblts_110 { font-size: 40px; }
    .cpblts_111 { font-size: 18px; padding: 0 2rem 0 0; }
  }
  @media (max-width: 575px) {
    .cpblts_110 { font-size: 34px; text-align: left; }
    .cpblts_111 { font-size: 16px; line-height: 1.6; text-align: justify; padding: 0; }
    .cpblts_img { height: 220px; }
  }

  .reveal {
    opacity: 0;
    transform: translateY(40px); /* starts lower */
    transition: opacity .8s ease, transform .8s ease;
    will-change: opacity, transform;
  }
  .reveal.in {
    opacity: 1;
    transform: none; /* moves upward into place */
  }

  /* optional stagger delay */
  .reveal[data-delay="100"] { transition-delay: .1s; }
  .reveal[data-delay="200"] { transition-delay: .2s; }
  .reveal[data-delay="300"] { transition-delay: .3s; }

  @media (prefers-reduced-motion: reduce) {
    .reveal, .reveal.in {
      transition: none !important;
      transform: none !important;
      opacity: 1 !important;
    }
  }

</style>

<script>
  (function() {
    const els = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window) || els.length === 0) {
      els.forEach(el => el.classList.add('in'));
      return;
    }
    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          io.unobserve(entry.target);
        }
      });
    }, { root: null, rootMargin: '0px 0px -10% 0px', threshold: 0.1 });
    els.forEach(el => io.observe(el));
  })();
</script>

