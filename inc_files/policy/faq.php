<section class="faq_top_block" style="--hero-img:url('images/faq_top_img.png');">
  <div class="air-overlay"></div>
  <div class="air-content">
    <h2 class="journal-title heading1">Everything you wanted to know<br>about the art of air</h2>
    <p class="journal-description">
      From technology to trust, innovation to installation — explore how Haneri
      redefines comfort, craftsmanship, and performance.
    </p>

    <form class="air-search">
      <input type="text" placeholder="Type your question here..." class="air-input">
      <button type="submit" class="air-button" aria-label="Search">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><line x1="14" y1="14" x2="20" y2="20"/></svg>
      </button>
    </form>
    <div id="air-results-overlay" class="air-results-overlay" hidden>
        <div class="air-results-box" id="air-results">
            <button type="button" class="air-close" aria-label="Close">×</button>
            <!-- results will be injected here -->
        </div>
    </div>


  </div>
</section>

<section id="faq_second_block" class="cats-wrap">
  <h2 class="journal-title heading1">Categories you would<br>love to discover</h2>

  <!-- Tabs slider -->
  <div class="cats-tabs">
    <button class="cats-nav cats-prev" aria-label="Previous tabs">&#8249;</button>
    <div class="cats-viewport">
      <div class="cats-track" id="catsTrack"><!-- built by JS --></div>
    </div>
    <button class="cats-nav cats-next" aria-label="Next tabs">&#8250;</button>
  </div>

  <!-- Tab content -->
  <div class="cats-content" id="catsContent">
    <div class="cats-left" id="catsFAQ"><!-- accordion --></div>
    <aside class="cats-right">
      <img id="catsImage" src="" alt="" loading="lazy">
    </aside>
  </div>
</section>

<style>
    /* --- Layout --- */
    .cats-wrap{
        max-width:100%;
        margin:40px auto 30px;
        padding:0 16px;
    }
    .cats-wrap .heading1{
        text-align:center;
        color:#005d5a;
        font-family:"Barlow Condensed",sans-serif;
        line-height:1.25;
        margin:0 0 40px;
    }
    /* .cats-wrap .journal-title .heading1{
        text-align:center;
        color:#0a3b36;
        font-family:"Barlow Condensed",sans-serif;
        font-size:34px;
        line-height:1.25;
        margin:0 0 40px;
    } */
    /* --- Tabs slider --- */
    .cats-tabs{
        position:relative;
        display:flex;
        align-items:center;
        gap:8px;
        margin:8px 0 35px;
    }
    .cats-viewport{
        overflow:hidden;
        flex:1;
    }
    .cats-track{
        display:flex;
        gap:16px;
        will-change:transform;
        transition:transform .35s ease;
    }
    .cats-tab{
        flex:0 0 calc((100% - 3*16px)/4); /* 4 visible with 16px gaps */
        display:flex;align-items:center;
        justify-content:center;
        height:54px;
        border:1px solid #d9e3e0;
        /* border-radius:6px; */
        background:#f6fbfa;
        color:#005d5a;
        font-family: "Barlow Condensed";
        font-size:24px;
        /* font:600 14px/1 "Open Sans",Arial,sans-serif; */
        cursor:pointer;
        white-space:nowrap;
        padding:0 14px;
        user-select:none
    }
    .cats-tab.active{
        /* outline:2px solid #CA5D27; */
        background:#EBEBEB;
    }
    .cats-nav{
        width:32px;height:32px;border:0;border-radius:4px;cursor:pointer;
        background:#e7f2f0;color:#005d5a;font-size:18px;line-height:1;display:grid;place-items:center
    }
    .cats-nav:disabled{opacity:.4;cursor:not-allowed}

    /* --- Content area --- */
    .cats-content{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:26px;
        margin-top:10px;
    }
    .cats-right img{
        width:100%;
        height:auto;
        display:block;
        /* border-radius:8px; */
        padding: 0px 50px;
    }

    /* --- Accordion (left) --- */
    .acd{
        margin: 0px -5px 0px 40px;
        border-top:1px solid #e9edf0;
        gap: 10px;
        display: flex;
        flex-direction: column;
    }
    .acd-item{
        border-bottom:1px solid #e9edf0;
    }
    .acd-h{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:12px;
        padding:12px 10px 12px 0;
        cursor:pointer;
        background: #EBEBEB;
    }
    .acd-q{
        /* font:600 14px/1.4 "Open Sans",Arial,sans-serif; */
        /* color:#0f1b1b */
        font-size:24px !important;
        font-family: "Barlow Condensed";
        padding-left: 10px;
    }
    .acd-toggle{
        width:22px;
        height:22px;
        /* border-radius:50%; */
        /* border:1px solid #cfe1de; */
        color:#005d5a;
        display:grid;
        place-items:center;
        /* font-weight:700; */
    }
    .acd-a{display:none;
        padding:0 0 14px 0;
        color:#4a505e;
        font:400 14px/1.6 "Open Sans",Arial,sans-serif;
    }
    .acd-item.open .acd-a{
        display:block;
        padding-left: 10px;
    }
    .acd-item.open .acd-toggle{
        /* background:#005d5a; */
        color: #005d5a;
        border-color: #005d5a;
        font-weight: 900;
    }
    .acd-item.open .acd-toggle::after{content:"–"}
    .acd-toggle::after{content:"+"}

    /* --- Responsive --- */
    @media (max-width: 900px){
    .cats-content{grid-template-columns:1fr}
    }
    @media (max-width: 640px){
    .cats-tab{flex:0 0 calc((100% - 2*12px)/3);padding:0 10px;height:48px} /* show 3 on small */
    .cats-track{gap:12px}
    }
    /* Mobile */
    @media (max-width: 480px){
        .cats-wrap{
            padding: 0px;
            margin-top:15px;
        }
        .cats-wrap .heading1 {
            margin: 0 0 25px;
        }
        .acd {
            margin: 0px;
        }
        .cats-right img {
            padding: 0px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        /* --- Data (edit as needed) --- */
        const TABS = [
            {
                title: 'About Haneri',
                image: 'images/faq_content1.png',
                faqs: [
                    { q: 'What is Haneri?', a: 'Haneri is a premium appliance brand built by a team with 75+ years of combined experience in consumer durables, engineering, and innovation. We design products that blend exceptional performance, modern aesthetics, and user-centric features for today’s discerning consumers. Learn more in About Us.' },
                    { q: 'Why trust a new brand like Haneri?', a: 'Our founding team has deep product creation and manufacturing expertise. Every product is engineered to high standards, validated through rigorous testing, and supported by reliable after-sales service.' },
                    { q: 'How does Haneri compare to established brands?', a: 'We combine veteran know-how with a fresh design perspective—aiming to match or exceed benchmark performance, reliability, and design while focusing on evolving consumer needs.' }
                ]
            },
            {
                title: 'Personalisation & Design',
                image: 'images/faq_content1.png',
                faqs: [
                    { q: 'What is Haneri BeSpoke™?', a: 'Haneri BeSpoke™ lets you personalise select fan models with your choice of colours, patterns, finishes—and on select models, even materials. Built in smaller lots with a nominal premium (and slightly longer lead time), it’s a first-of-its-kind way to match your fan to your décor and vibe. Unleash your creativity!' },
                    { q: 'What is Air Curve Design™?', a: 'Air Curve Design™ uses advanced computational modelling to craft blade profiles that maximise airflow and efficiency. Every curve and angle is optimised for superior aerodynamics—delivering high air, low noise, and refined style.' }
                ]
            },
            {
                title: 'Core Technologies',
                image: 'images/faq_content1.png',
                faqs: [
                    { q: 'What is Silent H.A.S.S.™ Technology?', a: 'Silent H.A.S.S.™ integrates two Haneri pillars—Air Curve Design™ blades + TurboSilent BLDC™ motor. The result: exceptional air at reduced RPM with whisper-quiet operation and outstanding efficiency.' },
                    { q: 'What is TurboSilent BLDC™?', a: 'Our high-torque, energy-efficient BLDC motor platform engineered for strong air delivery, stable speed control, and ultra-quiet performance.' },
                    { q: 'What is More Air Slow Speed Technology™ (High Air at Low Speed)?', a: 'This registered innovation is tuned to deliver excellent air even at lower speeds—so you stay comfortable while saving energy.' },
                    { q: 'What is LumiAmbience™ (Mood Lighting)?', a: 'Selectable ambient lighting on supported models to set a cozy or vibrant mood. Adjustable via the fan’s remote.' }
                ]
            },
            {
                title: 'Products & Performance',
                image: 'images/faq_content1.png',
                faqs: [
                    { q: 'What types of fans do you offer?', a: 'A wide range: ceiling, pedestal, wall-mounted, table, exhaust, and designer fans.' },
                    { q: 'Are Haneri fans suitable for large rooms?', a: 'Absolutely. Our high-performance models are engineered for superior air delivery and even comfort across larger spaces.' },
                    { q: 'Are Haneri fans energy-efficient?', a: 'Yes. Most models use our BLDC platform to deliver strong airflow with minimal power consumption—eco-friendly and wallet-friendly.' },
                    { q: 'Do Haneri fans run quietly?', a: 'Yes. TurboSilent BLDC™ motors and Silent H.A.S.S.™ blade-motor integration keep sound levels impressively low.' },
                    { q: 'Do Haneri fans have remote control?', a: 'Many models include remote control for speed, modes, and (where available) LumiAmbience™ lighting.' }
                ]
            },
            {
                title: 'Quality, Compliance & Manufacturing',
                image: 'images/faq_content1.png',
                faqs: [
                    { q: 'Where are Haneri fans manufactured?', a: 'Designed and manufactured in-house using state-of-the-art processes. Most products are proudly Made in India and comply with BIS and BEE norms.' },
                    { q: 'How do you ensure durability and quality?', a: 'Premium materials, advanced engineering, and multi-stage QC testing aligned to international standards.' },
                    { q: 'Are Haneri fans certified for safety and performance?', a: 'Yes. Our products meet or exceed relevant safety, energy-efficiency, and performance certifications.' }
                ]
            },
            {
                title: 'Ownership, Service & Warranty',
                image: 'images/faq_content1.png',
                faqs: [
                    { q: 'Do Haneri fans come with a warranty?', a: 'Yes. All fans include a standard warranty (terms vary by model). Please refer to the product manual or listing page for specifics.' },
                    { q: 'How do I register my warranty?', a: 'Register on our website with your purchase details and serial number.' },
                    { q: 'After-sales service available?', a: 'Yes. We offer comprehensive service through authorised centres nationwide.' },
                    { q: 'Can I install the fan myself?', a: 'Some models are DIY-friendly, but we recommend professional installation to ensure optimal performance and warranty coverage.' },
                    { q: 'How do I clean and maintain my fan?', a: 'Wipe blades and housing with a soft, damp cloth. For detailed care, see your product manual.' },
                    { q: 'Are replacement parts available?', a: 'Yes. Contact our customer service or visit an authorised service centre for genuine parts.' },
                    { q: 'My fan isn’t working—what should I do?', a: 'Check the troubleshooting section in your manual. If the issue persists, contact customer support—we’re happy to help.' }
                ]
            },
            {
                title: 'Buying, Shipping & Returns',
                image: 'images/faq_content1.png',
                faqs: [
                    { q: 'Where can I buy Haneri fans?', a: 'On our official website, select e-commerce platforms, and leading retail stores.' },
                    { q: 'Do you offer free shipping?', a: 'We offer free shipping on select products and locations. See our Shipping Policy for details.' },
                    { q: 'What’s your return/replacement policy?', a: 'Hassle-free returns/replacements for eligible defective or damaged products. Please review our Return Policy for full terms.' }
                ]
            },
            {
                title: 'Support',
                image: 'images/faq_content1.png',
                faqs: [
                    { q: 'How do I contact Haneri?', a: 'Reach us via our customer care number, email, or the contact form on our website.' },
                    { q: 'How does Haneri engage with customers and ensure transparency?', a: 'We communicate clearly about features, warranties, policies, and invite feedback across our website, social channels, and support lines. Your input helps us improve continuously.' }
                ]
            }
        ];

        const overlay = document.getElementById('air-results-overlay');
        const resultsBox = document.getElementById('air-results');
        resultsBox.addEventListener('click', (e) => {
            if (e.target.closest('.air-close')) hideOverlay();
        });
        const searchInput = document.querySelector('.air-input');
        const searchForm  = document.querySelector('.air-search');

        // Build a flat index from TABS once
        const SEARCH_INDEX = [];

        function norm(s){ return (s||"").toLowerCase().trim(); }
        function tokens(q){
            // split on spaces, remove tiny words unless they’re digits (e.g., “5”)
            return norm(q).split(/\s+/).filter(w => w.length > 1 || /^\d+$/.test(w));
        }
        function matchQuestionOnly(item, query){
            const Q = norm(item.q);
            const parts = tokens(query);
            if (!parts.length) return false;
            // Require ALL tokens to appear in the question (AND matching)
            return parts.every(p => Q.includes(p));
        }
        function highlight(text, query){
            let result = text;
            tokens(query).forEach(t=>{
                // escape regex special chars
                const re = new RegExp(t.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), 'ig');
                result = result.replace(re, m => `<mark>${m}</mark>`);
            });
            return result;
        }
        TABS.forEach(tab => {
            (tab.faqs || []).forEach(f => {
                SEARCH_INDEX.push({
                tab: tab.title,
                q: f.q,
                a: f.a
                });
            });
        });
        function doSearch(q) {
            const term = q.trim();
            if (term.length < 2) { hideOverlay(); return; }

            const results = SEARCH_INDEX
                .filter(item => matchQuestionOnly(item, term))
                .slice(0, 25); // optional cap

            renderResults(results, term);
        }
        // Show overlay with results (replaces your innerHTML usage)
        function renderResults(list, query){
            if (!list.length){
                resultsBox.innerHTML = `
                <button type="button" class="air-close" aria-label="Close">×</button>
                <div class="count">No results for “${query}”.</div>`;
                showOverlay();
                resultsBox.querySelector('.air-close').addEventListener('click', hideOverlay);
                return;
            }

            const header = `<div class="count">${list.length} result${list.length!==1?'s':''} for “${query}”</div>`;
            const items  = list.map(item => `
                    <div class="air-res-item">
                        <div class="res-h">
                            <div class="res-q">${highlight(item.q, query)} <span class="res-meta">${item.tab}</span></div>
                            <div class="res-toggle" aria-hidden="true"></div>
                        </div>
                    <div class="res-a">${item.a}</div>
                </div>`).join('');

            resultsBox.innerHTML = `<button type="button" class="air-close" aria-label="Close">×</button>${header}${items}`;
            showOverlay();

            resultsBox.querySelectorAll('.air-res-item .res-h').forEach(h=>{
                h.addEventListener('click', ()=> h.parentElement.classList.toggle('open'));
            });
            resultsBox.querySelectorAll('.air-res-item').forEach((it, idx)=>{
                if (idx < 3) it.classList.add('open');
            });
            resultsBox.querySelector('.air-close').addEventListener('click', hideOverlay);
        }
        // Close overlay correctly (remove the ::before attempt)
        overlay.addEventListener('click', (e)=>{
            if (e.target === overlay) hideOverlay();
        });
        document.addEventListener('keydown', (e)=>{
            if (e.key === 'Escape') hideOverlay();
        });

        // Input listeners (search when >=2 chars)
        let tId = null;
        searchInput.addEventListener('input', (e)=>{
            clearTimeout(tId);
            const val = e.target.value || '';
            tId = setTimeout(()=> doSearch(val), 180); // debounce a bit
        });

        // Also handle submit (Enter)
        searchForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            doSearch(searchInput.value || '');
        });


        function showOverlay() {
        overlay.hidden = false;
        document.body.style.overflow = 'hidden'; // prevent background scroll
        }
        function hideOverlay() {
        overlay.hidden = true;
        document.body.style.overflow = '';
        resultsBox.innerHTML = '';
        }
        function renderResults(list, query){
        if (!list.length){
            resultsBox.innerHTML = `
            <button type="button" class="air-close" aria-label="Close">×</button>
            <div class="count">No results for “${query}”.</div>`;
            showOverlay();
            resultsBox.querySelector('.air-close').addEventListener('click', hideOverlay);
            return;
        }

        const header = `<div class="count">${list.length} result${list.length!==1?'s':''} for “${query}”</div>`;
        const items  = list.map(item => `
            <div class="air-res-item">
            <div class="res-h">
                <div class="res-q">${highlight(item.q, query)} <span class="res-meta">${item.tab}</span></div>
                <div class="res-toggle" aria-hidden="true"></div>
            </div>
            <div class="res-a">${item.a}</div>
            </div>`).join('');

        resultsBox.innerHTML = `<button type="button" class="air-close" aria-label="Close">×</button>${header}${items}`;
        showOverlay();

        resultsBox.querySelectorAll('.air-res-item .res-h').forEach(h=>{
            h.addEventListener('click', ()=> h.parentElement.classList.toggle('open'));
        });
        resultsBox.querySelectorAll('.air-res-item').forEach((it, idx)=>{
            if (idx < 3) it.classList.add('open');
        });
        resultsBox.querySelector('.air-close').addEventListener('click', hideOverlay);
        }

        /* --- Build tabs --- */
        const track = document.getElementById('catsTrack');
        const contentWrap = document.getElementById('catsContent');
        const faqWrap = document.getElementById('catsFAQ');
        const imgEl = document.getElementById('catsImage');
        // Render tab buttons
        TABS.forEach((t, i) => {
            const b = document.createElement('button');
            b.type = 'button';
            b.className = 'cats-tab';
            b.textContent = t.title;
            b.dataset.index = i;
            track.appendChild(b);
        });

        // Slider math: 4 visible; slide by 2
        const viewport = track.parentElement;
        const prev = document.querySelector('.cats-prev');
        const next = document.querySelector('.cats-next');
        const STEP = 2;
        let indexOffset = 0; // first visible tab index (0..2)
        const maxOffset = Math.max(0, TABS.length - 4);

        function measure() {
            // translate by item width * indexOffset + gap adjustments
            const first = track.children[0];
            if (!first) return 0;
            const itemW = first.getBoundingClientRect().width;
            const gap = parseFloat(getComputedStyle(track).gap || 0);
            return -(indexOffset * (itemW + gap));
        }
        function applyTranslate() {
            track.style.transform = `translateX(${measure()}px)`;
            prev.disabled = (indexOffset <= 0);
            next.disabled = (indexOffset >= maxOffset);
        }
        prev.addEventListener('click', () => {
            indexOffset = Math.max(0, indexOffset - STEP);
            applyTranslate();
        });
        next.addEventListener('click', () => {
            indexOffset = Math.min(maxOffset, indexOffset + STEP);
            applyTranslate();
        });
        window.addEventListener('resize', applyTranslate);

        // Activate a tab
        function setActive(i){
            [...track.children].forEach((el,idx)=>{
            el.classList.toggle('active', idx === i);
            });
            renderContent(TABS[i]);
        }
        // Render accordion + image
        function renderContent(tab){
            // image
            imgEl.src = tab.image || '';
            imgEl.alt = tab.title || 'Category image';

            // accordion
            faqWrap.innerHTML = '';
            const acd = document.createElement('div');
            acd.className = 'acd';
            tab.faqs.forEach(({q,a})=>{
                const it = document.createElement('div');
                it.className = 'acd-item';
                it.innerHTML = `
                <div class="acd-h">
                    <div class="acd-q journal-title">${q}</div>
                    <div class="acd-toggle" aria-hidden="true"></div>
                </div>
                <div class="acd-a">${a}</div>`;
                acd.appendChild(it);
            });
            faqWrap.appendChild(acd);

            // open first 3 initially (or all if fewer)
            const items = faqWrap.querySelectorAll('.acd-item');
            items.forEach((it, idx) => { if (idx < 3) it.classList.add('open'); });

            // toggle individual items; do not close others
            faqWrap.querySelectorAll('.acd-item .acd-h').forEach(h=>{
                h.addEventListener('click', ()=> {
                h.parentElement.classList.toggle('open');
                });
            });
        }
        // Tab click handlers
        track.addEventListener('click', (e)=>{
            const btn = e.target.closest('.cats-tab');
            if (!btn) return;
            setActive(parseInt(btn.dataset.index,10));
        });

        // Init
        applyTranslate();
        setActive(0);
    });
</script>

<style>
    .faq_second_block .journal-title {
        padding-bottom: 40px;
    }
</style>
<style>
  /* --- Full-bleed hero with background image --- */
  .faq_top_block {
    position: relative;
    background-image: var(--hero-img);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 600px;          /* same look as your screenshot */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
  }

  /* Optional soft white overlay for readability */
  .air-overlay {
    position: absolute;
    inset: 0;
    /* background: rgba(255,255,255,0.45);
    backdrop-filter: blur(2px); */
  }

  /* All content sits above the overlay */
  .air-content {
    position: relative;
    z-index: 2;
    max-width: 900px;
    margin: 0 auto;
    padding: 40px 20px;
    color: #0a3b36;
  }

  @keyframes floatFan {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
  }

  .journal-title {
      font-size: 70px;
      color: #005d5a;
      line-height: 1;
      font-weight: 500;
  }
  .journal-description {
      font-size: 16px;
      color: #000000;
      line-height: 1.6;
      margin-top: 20px;
      max-width: 450px;
      margin: 20px auto;
  }

  /* Search bar */
  .air-search {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    border: 1px solid #d0d0d0;
    /* border-radius: 30px; */
    padding: 6px 16px;
    max-width: 420px;
    width: 100%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  }

  .air-input {
    flex: 1;
    border: none;
    outline: none;
    font-family: "Open Sans", sans-serif;
    font-size: 15px;
    color: #333;
    background: transparent;
  }

  .air-button {
    border: none;
    background: none;
    color: #005d5a;
    cursor: pointer;
    padding: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.2s ease;
  }
  .air-button:hover { color: #CA5D27; }

  /* Responsive */
  @media (max-width: 768px) {
    .journal-title { font-size: 32px; }
    .journal-description { font-size: 15px; max-width: 90%; }
    .air-fan { width: 120px; }
    .faq_top_block { min-height: 500px; }
  } 
  @media (max-width: 991px) {
    .air-results-overlay {
      top:650px !important;
    }
  }
   @media (max-width: 520px) {
    .air-results-overlay {
      top:500px !important;
    }
  }
</style>

<style>
    /* =====================================================
        FULL-PAGE SEARCH RESULTS OVERLAY
    ===================================================== */
    .air-results-box { position: relative; }
    .air-results-box .air-close{
        position:absolute; top:10px; right:16px;
        border:0; background:transparent; cursor:pointer;
        font-size:26px; line-height:1; color:#005d5a;
    }

    .air-results-overlay {
    position: fixed;
    inset: 0;
    /* background: rgba(255, 255, 255, 0.95); */
    backdrop-filter: blur(3px);
    display: flex;
    justify-content: center;
    align-items: flex-start;
    overflow-y: auto;
    z-index: 9999;
    padding: 20px 16px;
    top: 450px;
    }

    .air-results-box {
    max-width: 900px;
    width: 100%;
    background: #fff;
    border-radius: 8px;
    padding: 24px 28px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.1);
    position: relative;
    animation: fadeIn .25s ease;
    }

    @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
    }

    /* .air-results-box::before {
    content: "×";
    position: absolute;
    top: 12px;
    right: 20px;
    font-size: 26px;
    color: #005d5a;
    cursor: pointer;
    line-height: 1;
    } */

    /* --- Search Results Content --- */
    .air-results .count {
    margin-bottom: 12px;
    font:600 13px/1.2 "Open Sans", Arial, sans-serif;
    color:#4a505e;
    }

    .air-res-item {
    border:1px solid #e9edf0;
    border-bottom:0;
    background:#fff;
    }
    .air-res-item:last-child { border-bottom:1px solid #e9edf0; }

    .res-h {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    padding:10px 12px;
    cursor:pointer;
    background:#EBEBEB;
    }
    .res-q {
    font-family:"Barlow Condensed";
    font-size:22px;
    color:#0f1b1b;
    }
    .res-meta {
    margin-left:8px;
    font:600 11px/1 "Open Sans", Arial, sans-serif;
    color:#005d5a;
    background:#e7f2f0;
    padding:2px 6px;
    border-radius:3px;
    }
    .res-toggle {
    width:22px; height:22px;
    display:grid; place-items:center;
    color:#005d5a;
    font-weight:900;
    }
    .res-toggle::after { content:"+"; }
    .air-res-item.open .res-toggle::after { content:"–"; }

    .res-a {
        display:none;
        padding:10px 12px;
        background:#fff;
        color:#4a505e;
        font:400 14px/1.6 "Open Sans", Arial,sans-serif;
        text-align:left;
    }
    .air-res-item.open .res-a { display:block; }

</style>