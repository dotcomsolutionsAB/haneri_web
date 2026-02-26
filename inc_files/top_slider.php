<section class="video-gallery-slider fullwidth" aria-label="Featured Videos">
  <div class="video-slider" id="videoSlider">

    <!-- Small SVG Arrows -->
    <button class="nav prev" aria-label="Previous video">
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M15 18l-6-6 6-6" />
      </svg>
    </button>

    <button class="nav next" aria-label="Next video">
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M9 6l6 6-6 6" />
      </svg>
    </button>

    <!-- Track (real slides only; JS adds clones) -->
    <div class="track" id="videoTrack">
      <div class="video-slide">
        <iframe
          src="https://player.vimeo.com/video/1147581103?muted=1&loop=1&playsinline=1&title=0&byline=0&portrait=0"
          allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share"
          frameborder="0"
          referrerpolicy="strict-origin-when-cross-origin"
          title="blowup 21_9"></iframe>
      </div>

      <div class="video-slide">
        <iframe
          src="https://player.vimeo.com/video/1147584097?muted=1&loop=1&playsinline=1&title=0&byline=0&portrait=0"
          allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share"
          frameborder="0"
          referrerpolicy="strict-origin-when-cross-origin"
          title="rock one 1.2x"></iframe>
      </div>

      <div class="video-slide">
        <iframe
          src="https://player.vimeo.com/video/1147584148?muted=1&loop=1&playsinline=1&title=0&byline=0&portrait=0"
          allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share"
          frameborder="0"
          referrerpolicy="strict-origin-when-cross-origin"
          title="aesthetic cinematics"></iframe>
      </div>

      <div class="video-slide">
        <iframe
          src="https://player.vimeo.com/video/1147584196?muted=1&loop=1&playsinline=1&title=0&byline=0&portrait=0"
          allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share"
          frameborder="0"
          referrerpolicy="strict-origin-when-cross-origin"
          title="envo shot 21_9"></iframe>
      </div>
    </div>
  </div>
</section>

<style>
  :root{
    --hero-height: clamp(680px, 92vh, 1100px);
    --speed: 900ms;
  }

  .video-gallery-slider.fullwidth{
    width:100vw;
    margin-left: calc(-50vw + 50%);
    overflow:hidden;
  }

  .video-slider{
    position:relative;
    width:100%;
    height: var(--hero-height);
    background:#000;
    overflow:hidden;
  }

  .track{
    display:flex;
    height:100%;
    will-change: transform;
    transition: transform var(--speed) ease;
  }

  .video-slide{
    min-width:100%;
    height:100%;
    position:relative;
    overflow:hidden;
  }

  .video-slide iframe{
    position:absolute;
    top:50%; left:50%;
    width:140vw; height:140vh;
    transform: translate(-50%,-50%);
    border:0;
    z-index:1;
  }

  /* Arrows (no circle) */
  .nav{
    position:absolute;
    top:50%;
    transform: translateY(-50%);
    z-index:20;

    background:none;
    border:none;
    padding:0;
    cursor:pointer;

    width:32px;
    height:32px;
    opacity:0.75;
    transition: opacity .2s ease;
    user-select:none;
  }
  .nav:hover{ opacity:1; }
  .nav.prev{ left:20px; }
  .nav.next{ right:20px; }

  .nav svg{
    width:100%;
    height:100%;
    fill:none;
    stroke:#fff;
    stroke-width:2.5;
    stroke-linecap:round;
    stroke-linejoin:round;
  }

  @media (max-width:768px){
    :root{ --hero-height: clamp(320px, 62vh, 760px); }
    .video-slide iframe{ width:190vw; height:190vh; }
    .nav{ width:26px; height:26px; }
  }
</style>

<script src="https://player.vimeo.com/api/player.js"></script>

<script>
(function(){
  // Prevent double init
  if (window.__VIMEO_SEAMLESS_FIXED__) return;
  window.__VIMEO_SEAMLESS_FIXED__ = true;

  const slider = document.getElementById('videoSlider');
  const track  = document.getElementById('videoTrack');
  const prevBtn = slider.querySelector('.nav.prev');
  const nextBtn = slider.querySelector('.nav.next');

  let realSlides = Array.from(track.querySelectorAll('.video-slide'));
  const realCount = realSlides.length;
  if (realCount < 2) return;

  // Clone ends
  const firstClone = realSlides[0].cloneNode(true);
  const lastClone  = realSlides[realCount - 1].cloneNode(true);
  track.insertBefore(lastClone, realSlides[0]);
  track.appendChild(firstClone);

  // All slides incl clones
  const slides = Array.from(track.querySelectorAll('.video-slide'));
  const players = slides.map(s => new Vimeo.Player(s.querySelector('iframe')));

  // Start at first real slide (index 1)
  let index = 1;
  let timer = null;
  const DELAY = 8000;

  function setTransition(on){
    track.style.transition = on ? `transform var(--speed) ease` : 'none';
  }

  function forceReflow(){
    // key fix: forces browser to apply 'transition: none' BEFORE transform changes
    void track.offsetHeight;
  }

  function goto(i, animate=true){
    setTransition(animate);
    track.style.transform = `translateX(-${i * 100}%)`;
    index = i;
  }

  async function playVisible(i){
    await Promise.all(players.map((p,k)=> k===i ? Promise.resolve() : p.pause().catch(()=>{})));
    await players[i].setMuted(true).catch(()=>{});
    await players[i].play().catch(()=>{});
  }

  function restartAuto(){
    if (timer) clearInterval(timer);
    timer = setInterval(()=> goto(index + 1, true), DELAY);
  }

  // Transition end: if on clone, snap WITHOUT animation (seamless)
  track.addEventListener('transitionend', async () => {
    // moved past last real -> at firstClone
    if (index === realCount + 1){
      setTransition(false);
      forceReflow();
      index = 1;
      track.style.transform = `translateX(-${index * 100}%)`;
      forceReflow();
      requestAnimationFrame(()=> setTransition(true));
    }

    // moved before first real -> at lastClone
    if (index === 0){
      setTransition(false);
      forceReflow();
      index = realCount;
      track.style.transform = `translateX(-${index * 100}%)`;
      forceReflow();
      requestAnimationFrame(()=> setTransition(true));
    }

    await playVisible(index);
  });

  prevBtn.addEventListener('click', () => { restartAuto(); goto(index - 1, true); });
  nextBtn.addEventListener('click', () => { restartAuto(); goto(index + 1, true); });

  // Init position (no animation)
  setTransition(false);
  track.style.transform = `translateX(-${index * 100}%)`;
  forceReflow();
  requestAnimationFrame(()=> setTransition(true));

  playVisible(index);
  restartAuto();
})();
</script>
