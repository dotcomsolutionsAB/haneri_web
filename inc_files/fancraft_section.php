<section class="fancraft" aria-label="Fan Craft by Haneri">
    <h2 class="heading_1">Fan Craft by Haneri</h2>

    <section class="section fancraft-onimg">
      <div class="">
        <figure class="fancraft-block" style="--x:7.5%; --y:18%; --w:32%;"> <!-- width of text block -->
          <img class="fancraft-media" src="/images/Fancraft.png" alt="Haneri Fancraft fan" />

          <figcaption class="fancraft-caption">
            <h2 class="fancraft-wordmark" aria-label="FANCRAFT">FANCRAFT</h2>

            <p class="fancraft-body">
              Fancraft by Haneri is our bespoke design offering — a specialised service that allows you to 
              personalise the aesthetic of any Haneri ceiling fan. With complete in-house design and manufacturing 
              capabilities, we customise colours, finishes, textures, and accents to match the exact mood and 
              character of your home.
              Every Fancraft creation is crafted with the same precision, balance, and quiet performance that 
              define Haneri, but elevated with your personal touch. It transforms the fan from a utility into a 
              curated design statement — exclusive, intentional, and beautifully tailored to your space.
            </p>

            <a class="fancraft-cta" href="fancraft">ENQUIRE NOW</a>
          </figcaption>
        </figure>
      </div>
    </section>

    <section class="section fancraft-mobile-view">
      <div class="">
          <figure class="fancraft-block" style="--x:7.5%; --y:18%; --w:32%;"> <!-- width of text block -->
            <img class="fancraft-media" src="/images/fancraft_mobile.jpg" alt="Haneri Fancraft fan" />

            <figcaption class="fancraft-caption">
              <h2 class="fancraft-wordmark" aria-label="FANCRAFT">FANCRAFT</h2>

              <p class="fancraft-body">
                Fancraft by Haneri is our bespoke design offering — a specialised service that allows you to 
                personalise the aesthetic of any Haneri ceiling fan. With complete in-house design and manufacturing 
                capabilities, we customise colours, finishes, textures, and accents to match the exact mood and 
                character of your home.
                Every Fancraft creation is crafted with the same precision, balance, and quiet performance that 
                define Haneri, but elevated with your personal touch. It transforms the fan from a utility into a 
                curated design statement — exclusive, intentional, and beautifully tailored to your space.
              </p>

              <a class="fancraft-cta" href="fancraft">ENQUIRE NOW</a>
            </figcaption>
        </figure>
      </div>
    </section>
  </section>
  
  <style>
    :root {
      --radius: 10px;
      --shadow: 0 6px 14px rgba(0, 0, 0, .12);
      --brand: #CA5D27;
    }

    /* ===== Match Innovation-grid heading rules ===== */
    .fancraft {
      padding: 24px 0;
    }

    .fancraft>h2.heading_1 {
      margin-bottom: 18px;
      text-align: left;
      /* padding: 0 12px; */
      /* same as Innovations section */
    }

    /* ===== Fonts ===== */
    @font-face {
      font-family: "Ailerons";
      src: url("/Fonts/Ailerons-Typeface.woff2") format("woff2");
      font-weight: 400;
      font-style: normal;
      font-display: swap;
    }

    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap");

    /* ===== Block layout ===== */
    .fancraft-onimg {
      color: #fff;
    }

    .fancraft-block {
      position: relative;
      /* margin: 0 12px; */
      /* gives same gutter as your grid section */
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
      background: #000;
    }

    .fancraft-media {
      display: block;
      width: 100%;
      height: auto;
      /* keeps original aspect ratio */
    }

    /* ===== Caption positioned via CSS vars ===== */
    .fancraft-caption {
      position: absolute;
      left: var(--x);
      top: var(--y);
      width: var(--w);
      max-width: 560px;
      font-family: "Open Sans", system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
      text-shadow: 0 1px 0 rgba(0, 0, 0, .18);
    }

    /* ===== FANCRAFT wordmark ===== */
    .fancraft-wordmark {
      margin: 0 0 16px 0;
      font-family: "Ailerons", sans-serif;
      font-size: clamp(42px, 6.6vw, 76px);
      letter-spacing: 0.28em;
      line-height: 1.02;
      color: #fff;
    }

    /* ===== Body text ===== */
    .fancraft-body {
      margin: 0 0 22px 0;
      font-size: 16px;
      line-height: 1.72;
      color: #e9e3dc;
    }

    /* ===== CTA button ===== */
    .fancraft-cta {
      display: inline-block;
      background: var(--brand);
      color: #fff;
      text-decoration: none;
      font-weight: 700;
      letter-spacing: 0.02em;
      padding: 12px 20px;
      border-radius: 8px;
      box-shadow: 0 10px 22px rgba(202, 93, 39, .22);
      transition: transform 0.2s ease, filter 0.2s ease, box-shadow 0.2s ease;
    }

    .fancraft-cta:hover {
      transform: translateY(-1px);
      filter: brightness(1.06);
    }

    .fancraft-cta:active {
      transform: translateY(0);
      box-shadow: 0 6px 16px rgba(202, 93, 39, .2);
    }
    .fancraft-mobile-view{
      display:none;
    }

    /* ===== Responsive tweaks ===== */
    @media (max-width: 900px) {
      .fancraft-caption {
        left: 6%;
        top: 14%;
        width: 60%;
      }

      .fancraft-body {
        font-size: 15px;
        text-align: justify;
      }
    }

    @media (max-width: 520px) {
      .fancraft-onimg{
        display: none;
      }
      .fancraft-mobile-view{
        display:block;
      }
      .fancraft-caption {
        left: 5%;
        top: 40%;
        width: 85%;
      }
      .fancraft-caption
      {
        /* position: absolute; */
      }
      /* .fancraft-body {
        color:#000;
      } */
      .fancraft-wordmark {
        letter-spacing: 0.22em;
        /* color:#000; */
        /* margin-top: 10px; */
      }
      .fancraft-media {
        display: block;
        width: 100%;
        height: 500px;
        object-fit: cover;
      }
    }
  </style>