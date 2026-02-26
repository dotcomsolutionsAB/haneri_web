<?php include("header.php"); ?>
<style>
  #fancraft { color:#1F2A2E; background:#fff; }
  #fancraft *, #fancraft *::before, #fancraft *::after { box-sizing:border-box; }

  :root{
    --gap-col: 5%;
    --gap-row: 30px;
    --space-md: 28px;
    --radius: 10px;
    --green: #00473E;
    --orange: #CA5D27;
  }

  /* ===== Base (Mobile) ===== */
  #fancraft .bldc102{
    display:grid;
    grid-template-columns: 1fr;
    gap: var(--gap-row) var(--gap-col);
    align-items: start;
    margin-top: var(--space-md);
  }
  #fancraft .bldc102:first-of-type{ margin-top:0; }

  /* Text section */
  #fancraft .bldc103{
    font-family:"Barlow Condensed",sans-serif;
    font-size:clamp(28px,5vw,56px);
    font-weight:300;
    line-height:1.05;
    color:var(--green);
    margin:0 0 10px;
  }
  #fancraft .bldc103 b{
    color:var(--orange);
    font-weight:500;
    font-size:clamp(20px,2.5vw,38px);
  }
  #fancraft .bldc104{
    font-family:"Montserrat",sans-serif;
    font-size:clamp(14px,1.1vw,17px);
    line-height:1.75;
    color:#1F2A2E;
    margin:0;
  }
  .fnss img{max-width:220px;height:auto;margin-bottom:12px;display:block;}

  /* ===== Image Cover (works for all) ===== */
  #fancraft .img-cover{
    position:relative;
    overflow:hidden;
    border-radius:var(--radius);
    width:100%;
    height:100%;
    display:flex;
  }
  #fancraft .img-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center;
    display:block;
    transition:transform .45s ease, filter .45s ease;
  }
  @media (hover:hover) and (pointer:fine){
    #fancraft .img-cover:hover img{
      transform:scale(1.03);
      filter:saturate(1.04) contrast(1.02);
    }
  }

  /* ===== Tablet & Desktop ===== */
  @media (min-width: 992px){
    #fancraft .bldc102{
      grid-template-columns: 1fr 1fr;
      gap: var(--gap-row) var(--gap-col);
      align-items: stretch;     /* ensures equal height between text & image */
    }

    /* Column order */
    #fancraft .bldc102 .sm_h{ grid-column: 2; }          /* image right */
    #fancraft .bldc102 .sm_h.c01{ grid-column: 1; }      /* text left */
    #fancraft .bldc102.is-flip .sm_h{ grid-column: 1; }  /* image left */
    #fancraft .bldc102.is-flip .sm_h.c01{ grid-column: 2; } /* text right */

    /* Force image cell to fill its grid height */
    #fancraft .bldc102 .img-cover{
      height:100%;
    }
  }

  /* ===== Extra large screens ===== */
  @media (min-width:1400px){
    #fancraft .bldc102{ gap:40px; }
  }
</style>



<main class="main fancraft">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index"><i class="icon-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Fancraft</li>
      </ol>
    </div>
  </nav>
  <div class="container">
    <section class="main" id="fancraft">

      <!-- Row 1: text | image (cover) -->
      <div class="bldc102 mt-2">
        <div class="sm_h c01">
            <div class="fnss">
                <img src="images/fnss.png" alt="fancraft">
            </div>
          <h2 class="bldc103 mb-4">
            Personalised Air. Perfected Aesthetics. <br>
            <b>Every space has a story. Every ceiling, a canvas.</b>
          </h2>
            <p class="bldc104">
              Every space has a story. Every ceiling, a canvas. <br>
              FanCraft by Haneri turns your ceiling fan into a reflection of your personal taste — where colour, finish, and emotion come together in harmony.
            </p>
            <p class="bldc104">
              From deep metallic tones and satin pastels to dual-shade blends and signature textures, FanCraft lets you custom-curate your fan’s colour palette to complement your interiors. Whether you want the calm of ivory and gold, the boldness of graphite and rosewood, or an entirely bespoke hue crafted just for you — the choice is yours.
            </p>
        </div>
        <div class="sm_h img-cover">
          <img src="images/fan_craft_1.png" alt="Fan craft" />
        </div>
      </div>

      <!-- Row 2 (flip): image (cover) | text -->
      <div class="bldc102 is-flip">
        <div class="sm_h img-cover">
          <img src="images/fan_craft_2.png" alt="Fan Craft" />
        </div>
        <div class="sm_h c01">
          <h2 class="bldc103">Design the Air Around You</h2>
            <p class="bldc104">
              At FanCraft, design begins with emotion — with the subtle interplay between what you feel and what you see. It’s an intimate process, rooted in the belief that the spaces we inhabit are not just built; they are felt. Every shade we create tells a story — a whisper of mood, a memory of light, a reflection of who you are. Through colour, texture, and finish, we translate emotion into design — transforming the ordinary into a personal expression of taste.
              Each hue carries its own soul: the soft serenity of satin pastels that evoke calm and grace; the confident depth of graphite and rosewood that speak of strength and sophistication; the timeless harmony of ivory brushed with gold that radiates quiet luxury. These are not just colours — they are feelings, captured and crafted to live on your ceiling.
              <br>
              Our design specialists take this philosophy further. They work hand in hand with you, understanding your rhythm, your inspirations, and the story your home wishes to tell. Every conversation becomes a creative dialogue — a journey through tones, finishes, and combinations that mirror your aesthetic. From your first idea to the final stroke of craftsmanship, each detail is refined to achieve perfect balance — ensuring your fan complements your interiors not as an accessory, but as an integral piece of art.
            </p>
        </div>
      </div>

      <!-- Row 3: text | image (cover) -->
      <div class="bldc102 mt-2">
        <div class="sm_h c01">
          <h2 class="bldc103 mb-4">Where Art Meets Engineering</h2>
            <p class="bldc104">
              Behind the artistry lies Haneri’s legacy of engineering excellence — a philosophy where beauty and precision coexist in perfect equilibrium. Every FanCraft creation is the result of decades of research, refined craftsmanship, and an unwavering pursuit of perfection. What begins as a design sketch transforms into a meticulously engineered masterpiece, brought to life through advanced techniques such as precision electroplating, UV metalizing, and custom paintwork, each executed under the keen eye of our artisans and engineers.
              <br>
              Every finish, texture, and tone is curated not only for its aesthetic appeal but also for its resilience. Each layer is tested against time, humidity, and wear — ensuring that the brilliance you see today remains just as luminous for years to come. Our artisans hand-finish every blade, polish every contour, and inspect every component with a level of care that machines alone could never replicate.
              <br>
              From the core motor assembly to the outermost sheen, FanCraft by Haneri represents a perfect synthesis of artistry and engineering — a union of durability and design that stands as beautifully as it performs. Every fan we craft isn’t just built to move air; it’s built to move you..
            </p>
        </div>
        <div class="sm_h img-cover">
          <img src="images/fan_craft_3.png" alt="Fan Craft" />
        </div>
      </div>

    </section>
  </div>
</main>
<script>
(() => {
  // Reveal animation
  const targets = document.querySelectorAll('#fancraft .bldc102, #fancraft .bldc107, #fancraft .bldc109');
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

<?php include("footer.php"); ?>