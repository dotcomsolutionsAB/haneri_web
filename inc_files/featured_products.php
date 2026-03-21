<?php include("configs/config.php"); ?>

<section class="featured fi4-wrap pt-0 mt-0" aria-label="Featured Products">
  <h2 class="heading_1">Featured Products</h2>
  <div class="fi4-grid" id="fi4Grid"><!-- items injected here --></div>
</section>

<!-- Barlow Condensed (title font) -->
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  /* ===== Featured (minimal) ===== */
  .fi4-wrap { padding: 24px 0; }
  .fi4-wrap .heading_1 { margin-bottom: 16px; text-align: left; }

  /* ðŸ‘‡ 4 columns on desktop */
  .fi4-grid{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 36px;
  }
  /* 3 cols on medium, 2 on tablet, 1 on mobile */
  @media (max-width: 1200px){ .fi4-grid{ grid-template-columns: repeat(3, 1fr); } }
  @media (max-width: 900px){  .fi4-grid{ grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 600px){  .fi4-grid{ grid-template-columns: 1fr; } }

  .fi4-swatch--active {
    outline: 2px solid #005d5a;;
    /* border-color: #9c9c9c !important;
    width: 20px;
    height: 24px; */
  }

  .fi4-card{
    background: #fff; padding: 0; border: 0; border-radius: 0;
    box-shadow: none; overflow: hidden; cursor: default; position: relative;
  }
  /* stop stray global pseudo-badges */
  .fi4-card::before, .fi4-card::after, .fi4-card *::before, .fi4-card *::after { content: none !important; }

  :root{ --fi4-img-h: 340px; --fi4-zoom: 2; --fi4-zoom-hover: 1.22; }
  .fi4-image{
    position: relative;
    height: var(--fi4-img-h);
    display: grid; place-items: center;
    margin: 0 0 12px 0; overflow: hidden;
  }
  .fi4-img{
    position: absolute; inset: 0;
    width:100%; height:100%;
    object-fit: contain; display:block;
    /*transform: scale(var(--fi4-zoom));*/
    transform-origin: center;
    transition: opacity .35s ease, transform .35s ease;
  }
  .fi4-img {
    opacity: 1 !important;
    z-index: 1;
  }
  .fi4-card:hover .fi4-img{ transform: scale(var(--fi4-zoom-hover)); }

  .fi4-logo{ width: 110px; height:auto; display:block; margin: 0 0 8px 0; }

  .fi4-title{
    font-family: 'Barlow Condensed', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;
    font-weight: 600; font-size: 30px; line-height: 1.05; letter-spacing: 0;
    color:#CA5D27; text-transform: uppercase; margin: 0 0 10px 0;
  }
  @media (max-width: 640px){ .fi4-title{ font-size: 32px; } }

  .fi4-desc{
    color:#6F6F6F; font-size:14px; line-height:1.6; margin: 0 0 16px 0;
    max-width: 60ch;
  }

  .fi4-price{
    /*font-family: 'Barlow Condensed', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, Arial, sans-serif;*/
    /*display:flex; align-items: baseline; gap:12px; margin: 6px 0 16px 0;*/
    font-size: 24px;
    font-family: 'Barlow Condensed';
    font-weight: 400 !important;
    line-height: 1;
    color: #005d5a;
    text-align: left;
  }
  /*.fi4-price .label{ color:#005d5a; font-weight:700; letter-spacing:.02em; }*/
  /*.fi4-price .value{ color:#005d5a; font-weight:700; letter-spacing:.02em; }*/
  .fi4-price del{ color:#B8B8B8; font-weight:600; }

  .fi4-swatches{ display:flex; gap:10px; margin: 6px 0 18px 0; padding-left: 2px;}
    .fi4-swatch{ 
        /* width: 20px;
        height: 22px;
        border-radius: 0px;
        border: 1px solid #000; */
        width: 28px;
        height: 28px;
        border-radius: 999px;
        border: 1px solid #ddd;
        cursor: pointer;
        box-shadow: inset 0 0 0 2px rgba(255, 255, 255, .8);
    }
    .fi4-swatch:hover {
        transform: scale(1.1);
        border-color: #000;
    }

  .fi4-cta{
    display:inline-block; padding:12px 20px; border-radius:10px;
    background:#244a46; color:#fff; text-decoration:none;
    font-weight:700; letter-spacing:.01em;
  }
  .fi4-cta:hover {
      color: #fff;
  }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const grid = document.getElementById("fi4Grid");
  if (!grid) return;

  const BASE = "<?php echo BASE_URL; ?>";
  const apiUrl = BASE + "/products/get_products";

    // ONE delegated click handler (handles CTA + card click safely)
    grid.addEventListener("click", function (e) {
        const cta = e.target.closest(".fi4-cta");
        const swatch = e.target.closest(".fi4-swatch");
        const card = e.target.closest(".fi4-card");

        // 1) Swatch: let normal <a href="..."> navigation happen
        if (swatch) return;

        // 2) Add to Cart
        if (cta) {
            // ✅ If this is a real link (View Cart), allow normal navigation
            const href = (cta.getAttribute("href") || "").trim();
            if (href && href !== "#") return;

            // otherwise it's Add to Cart button
            e.preventDefault();
            e.stopPropagation();

            const productId = Number(cta.getAttribute("data-product-id"));
            const variantId = Number(cta.getAttribute("data-variant-id"));

            const payload = { product_id: productId, quantity: 1 };
            if (variantId) payload.variant_id = variantId;

            const headers2 = { "Content-Type": "application/json" };
            let authToken = null, tempId = null;
            try {
                authToken = localStorage.getItem("auth_token");
                tempId = localStorage.getItem("temp_id");
            } catch (e) {}

            if (authToken) headers2["Authorization"] = "Bearer " + authToken;
            else if (tempId) payload.cart_id = tempId;

            fetch(BASE + "/cart/add", { method: "POST", headers: headers2, body: JSON.stringify(payload) })
            .then((r) => r.json())
            .then((json) => {
                // save temp_id if provided
                if (!authToken && !tempId && json?.data?.user_id) {
                try { localStorage.setItem("temp_id", json.data.user_id); } catch (e) {}
                }

                // ✅ SAFE replace (no outerHTML)
                const view = document.createElement("a");
                view.className = "fi4-cta";
                view.href = "cart.php";
                view.textContent = "View Cart";

                if (cta.isConnected) cta.replaceWith(view); // only if still in DOM
            })
            .catch((err) => {
                console.error("Cart Add Error:", err);
                alert("An error occurred while adding to cart.");
            });

            return;
        }

        // 3) Card click → PDP
        if (!card) return;

        const pid = card.getAttribute("data-product-id");
        const vid = card.getAttribute("data-first-variant-id") || "";
        if (pid) {
            window.location.href =
            `product_detail.php?id=${encodeURIComponent(pid)}${vid ? `&v_id=${encodeURIComponent(vid)}` : ""}`;
        }
    });
  // ---------- helpers ----------
  function inr2(n){
    const x = Number(n || 0);
    try { return new Intl.NumberFormat('en-IN',{minimumFractionDigits:2,maximumFractionDigits:2}).format(x); }
    catch(e){ return x.toFixed(2); }
  }
  function num(v){
    if (v === null || v === undefined || v === "") return 0;
    const s = String(v).replace(/[^0-9.\-]/g, "");
    const n = Number(s);
    return isFinite(n) ? n : 0;
  }
  function pickMRP(fromVariant, fromProduct){
    const v = fromVariant || {}, p = fromProduct || {};
    return num(v.mrp || v.price_mrp || p.mrp || p.price_mrp || v.selling_price || p.selling_price);
  }
  function pickStrike(fromVariant, fromProduct){
    const v = fromVariant || {}, p = fromProduct || {};
    return num(v.compare_at_price || v.strike_price || p.compare_at_price || p.strike_price || 0);
  }

  // color map (same names you used elsewhere)
  const COLOR_MAP = {
    "Denim Blue":"#6497B2","Baby Pink":"#C7ABA9","Pearl White":"#F5F5F5","Matte Black":"#21201E",
    "Pine":"#DDC194","Beige":"#E6E0D4","Walnut":"#926148","Sunset Copper":"#936053",
    "Royal Brass":"#B7A97C","Regal Gold":"#D3B063","Pure Steel":"#878782","Metallic Grey":"#D4D4D4",
    "Sand Beige":"#D3CBBB","Metallic Walnut":"#7F513F","Espresso Walnut":"#926148",
    "Moonlit White":"#E6E6E6","Natural Pine":"#DDC194","Velvet Black":"#0B0A08",
    // generic fallbacks
    "Brown":"#6d4c41","Wood":"#7b5e57","White":"#ffffff","Ivory":"#f5f5f0","Cream":"#eee8d5",
    "Black":"#000000","Graphite":"#2f2f2f","Grey":"#8b8b8b"
  };
  function colorFromLabel(label){
    if (!label) return null;
    const t = String(label).trim();
    if (COLOR_MAP[t]) return COLOR_MAP[t];
    // try split like "Walnut / White"
    const part = t.split(/[\/,|]/)[0].trim();
    return COLOR_MAP[part] || null;
  }

  function initLogo(imgEl){
    const tries = [
      BASE + "/images/Link.png",
      "images/Link.png",
      "/images/Link.png",
      BASE + "/images/Haneri%20Logo.png",
      "images/Haneri%20Logo.png",
      "/images/Haneri%20Logo.png"
    ];
    let i = 0;
    function next(){ if (i>=tries.length) { imgEl.style.display="none"; return; } imgEl.src = tries[i++]; }
    imgEl.onerror = next; next();
  }

//   const DESC_TEXT = "Where the spirit of fluidic design meets cutting edge technology to bring harmony, balance and comfort to you.";

  // auth header (if any)
  const headers = { "Content-Type":"application/json" };
  try {
    const t = localStorage.getItem("auth_token");
    if (t) headers["Authorization"] = "Bearer " + t;
  } catch(e){}

    function trimDesc(text, limit = 100) {
        if (!text) return "";
        text = text.trim();
        return text.length > limit ? text.substring(0, limit) + "..." : text;
    }


  fetch(apiUrl, {
    method: "POST",
    headers,
    // tweak the body to whatever you actually use to fetch “featured”
    // body: JSON.stringify({ search_product: "Fengshui" })
  })
  .then(r => r.json())
  .then(res => {
    const list = (res && res.success && Array.isArray(res.data)) ? res.data : [];
    if (!list.length) {
      grid.innerHTML = "<p>No featured products found.</p>";
      return;
    }

    // Build one card PER PRODUCT (use its FIRST variant for images/prices; show swatches for ALL variants)
    grid.innerHTML = "";
    list.forEach(product => {
      const variants = Array.isArray(product.variants) ? product.variants : [];
      if (!variants.length) return;

      const first = variants[0];

      const img1 = (first.file_urls && first.file_urls[0]) ? first.file_urls[0] : "images/placeholder.png";
      const img2 = (first.file_urls && first.file_urls[1]) ? first.file_urls[1] : img1;

      const mrp  = pickMRP(first, product);
      const old  = pickStrike(first, product);
      const showOld = old && Math.abs(old - mrp) > 1;

      const title = String(product.name || "").toUpperCase();
    //   const DESC_TEXT = String(product.description || "");
      const firstVariantId = first.id || "";

      // swatches from ALL variants (color derived from variant_value)
      const swHTML = variants.map(v => {
        const label = (v.variant_value || "").trim();
        const hex = colorFromLabel(label) || "#ccc";
        const isActive = (v.id === firstVariantId); // highlight first variant as selected
        const activeClass = isActive ? "fi4-swatch--active" : "";
        const url = `product_detail.php?id=${encodeURIComponent(product.id)}&v_id=${encodeURIComponent(v.id)}`;
        return `<a href="${url}" class="fi4-swatch ${activeClass}" title="${label}" aria-label="${label}" style="background:${hex}"></a>`;
      }).join("");


      const card = document.createElement("article");
      card.className = "fi4-card";
      card.setAttribute("data-product-id", product.id);
      card.setAttribute("data-first-variant-id", firstVariantId);

      card.innerHTML =
        `<figure class="fi4-image">
           <img class="fi4-img fi4-img--1" src="${img1}" alt="${(first.variant_value || product.name) || ''}" loading="lazy">
         </figure>
         <img class="fi4-logo" alt="Haneri">
         <h3 class="fi4-title">${title}</h3>
         <p class="fi4-desc">${trimDesc(product.description, 100)}</p>
         <div class="fi4-price">
           <span class="label">MRP</span>
           <span class="value">₹${inr2(mrp)}</span>
           ${showOld ? `<del>₹${inr2(old)}</del>` : ``}
         </div>
         <div class="fi4-swatches">${swHTML}</div>
         <a href="#" class="fi4-cta" data-product-id="${product.id}" data-variant-id="${firstVariantId}">Add to Cart</a>`;

      grid.appendChild(card);
    });

    // logo fallbacks
    Array.from(grid.getElementsByClassName("fi4-logo")).forEach(initLogo);

    // hide missing hover-image
    Array.from(grid.getElementsByClassName("fi4-img--2")).forEach(img => {
      img.addEventListener("error", function(){ this.style.display = "none"; });
    });

  })
  .catch(err => {
    console.error("Featured fetch error:", err);
    grid.innerHTML = "<p style='color:#b00'>Failed to load featured products.</p>";
  });
});
</script>

