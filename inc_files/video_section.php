<section class="innovation-grid" aria-label="Innovations that take Haneri further">
  <h2 class="heading_1">Innovations that take Haneri further</h2>

  <div class="in-viewport" id="inViewport">
    <ul class="in-track">
      <!-- Air Curve -->
      <li class="in-card">
        <div class="in-iframe-wrap">
          <iframe
            src="https://player.vimeo.com/video/1127434008?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            title="Air Curve">
          </iframe>
        </div>
      </li>

      <!-- BLDC -->
      <li class="in-card">
        <div class="in-iframe-wrap">
          <iframe
            src="https://player.vimeo.com/video/1127434068?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            title="BLDC">
          </iframe>
        </div>
      </li>

      <!-- HASS -->
      <li class="in-card">
        <div class="in-iframe-wrap">
          <iframe
            src="https://player.vimeo.com/video/1127434033?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            title="HASS">
          </iframe>
        </div>
      </li>

      <!-- Lumi -->
      <li class="in-card">
        <div class="in-iframe-wrap">
          <iframe
            src="https://player.vimeo.com/video/1127435632?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            title="Lumi">
          </iframe>
        </div>
      </li>

      <!-- Scan -->
      <li class="in-card">
        <div class="in-iframe-wrap">
          <iframe
            src="https://player.vimeo.com/video/1127434145?autoplay=1&muted=1&loop=1&autopause=0&background=1&playsinline=1&title=0&byline=0&portrait=0&badge=0&controls=0&dnt=1"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            title="Scan">
          </iframe>
        </div>
      </li>
    </ul>
  </div>
</section>

<!-- Vimeo API once -->
<script src="https://player.vimeo.com/api/player.js"></script>

<style>
  :root{
    --radius: 10px;
    --shadow: 0 6px 14px rgba(0,0,0,.12);
  }

  .innovation-grid{padding:24px 0;}
  .innovation-grid h2{
    margin-bottom:18px;
    text-align:left;
    padding:0 12px;
  }

  .in-viewport{overflow:hidden;}
  .in-track{
    display:grid;
    grid-template-columns: repeat(5, 1fr);
    gap:20px;
    list-style:none;margin:0;padding:0 12px;
  }

  .in-card{
    border-radius:var(--radius);
    overflow:hidden;
    background:#000;
    box-shadow:var(--shadow);
  }

  /* Aspect wrapper: 9:16 (portrait) as per your 177.78% padding */
  .in-iframe-wrap{
    position:relative;
    width:100%;
    padding-top:177.78%; /* 9:16 */
    background: #111;
  }
  .in-iframe-wrap iframe{
    position:absolute; inset:0;
    width:100%; height:100%;
    display:block;
    border:0;
  }

  /* Tablet: fix over-tall cards (without touching mobile/desktop) */
    @media (min-width: 769px) and (max-width: 1199px) {
        .in-track {
            /* Optional: slightly fewer columns on mid screens */
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .in-iframe-wrap {
            /* Turn off padding hack on tablets */
            padding-top: 0;

            /* Keep correct portrait ratio but prevent full-height */
            aspect-ratio: 9 / 16;
            max-height: 80vh;
            margin: 0 auto;
        }

        .in-iframe-wrap iframe {
            width: 100%;
            height: 100%;
        }
    }

  /* Mobile: horizontal snap scroll */
  @media(max-width: 768px){
    .in-track{
      display:flex;
      gap:16px;
      overflow-x:auto;
      scroll-snap-type:x mandatory;
      padding:0 12px;
    }
    .in-card{
      flex:0 0 45%;
      scroll-snap-align:start;
    }
    .in-track::-webkit-scrollbar{display:none;}
  }
</style>
<style>
    
</style>
<script>
  // Optional: pause iframes that are far off-screen for performance
  (function(){
    var cards = document.querySelectorAll('.in-card iframe');
    if (!('IntersectionObserver' in window) || !cards.length) return;

    var players = [];
    cards.forEach(function(ifr){
      try { players.push({ el: ifr, p: new Vimeo.Player(ifr) }); } catch(e){}
    });

    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        var item = players.find(function(p){ return p.el === entry.target; });
        if (!item) return;
        if (entry.isIntersecting){
          item.p.play().catch(function(){});
        } else {
          item.p.pause().catch(function(){});
        }
      });
    }, { root: null, rootMargin: '100px', threshold: 0.25 });

    players.forEach(function(it){ io.observe(it.el); });
  })();
</script>
