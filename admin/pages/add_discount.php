<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php $current_page = "Add Discount"; ?>
<?php include("header1.php"); ?>
<style>
  .cardx{ width:100%; }
  .is-hidden { display:none !important; }

  /* ===== Tom Select – shared look (single & multi) ===== */
  .ts-wrapper { width: 100%; }
  .ts-wrapper.single .ts-control,
  .ts-wrapper.multi  .ts-control{
    display:flex; align-items:center;
    min-height:42px; padding:0 12px;
    border:1px solid #E5E7EB; border-radius:10px;
    background:#fff; box-shadow:none;
  }
  .ts-wrapper.focus .ts-control{
    border-color:#93C5FD;
    box-shadow:0 0 0 3px rgba(59,130,246,0.15);
  }
  .ts-wrapper.single .ts-control .item,
  .ts-wrapper.multi  .ts-control .item{
    background:transparent; border:0; box-shadow:none;
    padding:0; margin:0 6px 0 0; color:#111827; line-height:1.5rem;
  }
  .ts-control::after{ border-color:#9CA3AF transparent transparent transparent; }
  .ts-wrapper .ts-control>input{ margin:0; padding:0; height:1.5rem; line-height:1.5rem; }

  .ts-dropdown{
    border:1px solid #E5E7EB; border-radius:10px;
    box-shadow:0 10px 20px rgba(0,0,0,0.06); overflow:hidden; font-size:14px;
  }
  .ts-dropdown .dropdown-input{
    border:none!important; border-bottom:1px solid #F3F4F6;
    padding:10px 12px; outline:none!important; box-shadow:none!important;
  }
  .ts-dropdown .dropdown-input::placeholder{ color:#9CA3AF; }
  .ts-dropdown .option{ padding:10px 12px; display:flex; align-items:center; gap:8px; }
  .ts-dropdown .option.active, .ts-dropdown .option:hover{
    background:#EFF6FF; color:#1F2937;
  }

  /* Remove template’s .select skin from TS wrapper if present */
  .ts-wrapper.select{
    border:0!important; padding:0!important; background:transparent!important;
    border-radius:0!important; box-shadow:none!important;
  }

  .text-edit{
    width:100%; min-height:120px;
    border:1px solid rgba(128,128,128,0.34); border-radius:10px;
    background:#fcfcfc; padding:2px 10px; text-align:justify;
  }

  /* ----- swatch styling for Tom Select options/items ----- */
  .ts-option-row, .ts-item-row {
    display: flex; align-items: center; gap: 8px;
  }
  .ts-swatch {
    width: 14px; height: 14px; border-radius: 50%;
    border: 1px solid rgba(0,0,0,.08);
    flex: 0 0 14px;
  }

  /* Product/Variant Tree */
  .tree-wrap { border:1px solid #E5E7EB; border-radius:12px; padding:12px; position: absolute; background: #fff;}
  .tree-product { border-bottom:1px dashed #EEE; padding:10px 0; }
  .tree-product:last-child { border-bottom:0; }
  .tree-head { display:flex; align-items:center; gap:10px; cursor:pointer; }
  .tree-head .caret { width:16px; height:16px; display:inline-flex; align-items:center; justify-content:center; font-size:12px; border:1px solid #E5E7EB; border-radius:4px; }
  .tree-variants { margin:10px 0 0 26px; display:none; }
  .tree-variants.open { display:block; }
  .tree-variant { display:flex; align-items:center; gap:8px; padding:6px 0; }

  .badge { padding:2px 8px; font-size:11px; border-radius:999px; background:#F3F4F6; color:#374151; }

</style>

<link  href="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/js/tom-select.complete.min.js"></script>

<main class="grow content pt-5" id="content" role="content">
  <div class="container-fixed" id="content_container"></div>

  <div class="container-fixed">
    <div class="grid gap-5 grid-cols-1 lg:gap-7.5 xl:w-[68.75rem] mx-auto">
      <div class="card pb-2.5">
        <div class="card-header" id="basic_settings">
          <h3 class="card-title">Add Discount</h3>
        </div>

        <div class="card-body grid gap-5">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

            <!-- Discount % -->
            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
              <label for="discount" class="form-label max-w-56">Discount %</label>
              <input class="input" type="text" id="discount" placeholder="Discount Value">
            </div>

            <!-- Category -->
            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
              <label for="chooseCategory" class="form-label max-w-56">Select Category</label>
              <select class="select" id="chooseCategory">
                <option value="">Loading categories...</option>
              </select>
            </div>

            <!-- Audience Mode -->
            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
              <label for="chooseAudience" class="form-label max-w-56">User Type</label>
              <select class="select" id="chooseAudience">
                <option value="specific" selected>Specific user</option>
                <option value="dealer">All dealer</option>
                <option value="architect">All architect</option>
                <option value="customer">All customer</option>
              </select>
            </div>

            <!-- User Name (multi) -->
            <div id="userChooserRow" class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
              <label for="chooseUser" class="form-label max-w-56">User Name</label>
              <select class="select" id="chooseUser" placeholder="Search user..." multiple>
                <option value="">Loading users...</option>
              </select>
            </div>

            <!-- Product & Variants Tree -->
            <div class="flex items-start flex-wrap lg:flex-nowrap gap-2.5">
              <label class="form-label max-w-56 mt-1.5">Select Product(s)</label>
              <div class="w-full" id="productTree">
                <div class="rounded-lg border border-gray-200 p-3 text-sm text-gray-500">
                  Select a category first
                </div>
              </div>
            </div>
          </div>

          <div class="flex justify-end gap-5">
            <button class="btn btn-primary" id="saveDiscount">Save Discount</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</main>
<script>
document.addEventListener("DOMContentLoaded", function () {
  /* =========================
   * GLOBAL CONFIG + HELPERS
   * ========================= */
  const token          = localStorage.getItem('auth_token');
  const $              = (sel) => document.querySelector(sel);

  // Endpoints
  const API_BASE       = "<?php echo BASE_URL; ?>";
  const URL_PRODUCTS   = API_BASE + "/products/get_products";
  const URL_USERS      = API_BASE + "/all_users";
  const URL_CATEGORIES = API_BASE + "/categories/fetch";
  const URL_DISCOUNT   = API_BASE + "/discount/add";

  /* ===== Variant Color Map ===== */
  const COLOR_OPTIONS = [
    { label: 'Denim Blue',      value: 'Denim Blue',      swatch: '#6497B2' },
    { label: 'Baby Pink',       value: 'Baby Pink',       swatch: '#C7ABA9' },
    { label: 'Pearl White',     value: 'Pearl White',     swatch: '#F5F5F5' },
    { label: 'Matte Black',     value: 'Matte Black',     swatch: '#21201E' },
    { label: 'Pine',            value: 'Pine',            swatch: '#DDC194' },
    { label: 'Beige',           value: 'Beige',           swatch: '#E6E0D4' },
    { label: 'Walnut',          value: 'Walnut',          swatch: '#926148' },
    { label: 'Sunset Copper',   value: 'Sunset Copper',   swatch: '#936053' },
    { label: 'Royal Brass',     value: 'Royal Brass',     swatch: '#B7A97C' },
    { label: 'Regal Gold',      value: 'Regal Gold',      swatch: '#D3B063' },
    { label: 'Pure Steel',      value: 'Pure Steel',      swatch: '#878782' },
    { label: 'Metalic Grey',   value: 'Metalic Grey',   swatch: '#D4D4D4' },
    { label: 'Sand Beige',      value: 'Sand Beige',      swatch: '#D3CBBB' },
    { label: 'Metallic Walnut', value: 'Metallic Walnut', swatch: '#7F513F' },
    { label: 'Espresso Walnut', value: 'Espresso Walnut', swatch: '#926148' },
    { label: 'Moonlit White',   value: 'Moonlit White',   swatch: '#E6E6E6' },
    { label: 'Natural Pine',    value: 'Natural Pine',    swatch: '#DDC194' },
    { label: 'Velvet Black',    value: 'Velvet Black',    swatch: '#0B0A08' }
  ];
  /* =========================
  * GLOBAL SELECTION STATE
  * ========================= */
  // Map variantId -> { productId, productName, variantLabel }
  const selectedVariants = new Map();
  // lookups for confirmation grid
  const userMap = new Map();      // id -> { name, role }
  const categoryMap = new Map();  // id -> { name }
  let currentCategoryName = "";   // selected category's name for display

  /* reset helper */
  function clearVariantSelection() {
    selectedVariants.clear();
  }

  /* update parent checkbox state */
  function setParentCheckboxIndeterminate(parentCb, variantIds) {
    let checked = 0;
    variantIds.forEach(id => { if (selectedVariants.has(String(id))) checked++; });
    parentCb.indeterminate = checked > 0 && checked < variantIds.length;
    parentCb.checked = checked === variantIds.length;
  }

  /* toggle entire product */
  function toggleProduct(productObj, isChecked, productCb, groupEl) {
    const { id: productId, name: productName, variants = [] } = productObj;
    variants.forEach(v => {
      const vid = String(v.id);
      const vcb = groupEl.querySelector(`input[type="checkbox"][data-variant-id="${vid}"]`);
      if (vcb) vcb.checked = isChecked;

      if (isChecked) {
        selectedVariants.set(vid, {
          productId: String(productId),
          productName: productName || `Product #${productId}`,
          variantLabel: (v.variant_value || `Variant #${v.id}`),
          colorHex: getSwatchHexByName(v.variant_value) || '#f324e5ff'
        });
      } else {
        selectedVariants.delete(vid);
      }
    });
    setParentCheckboxIndeterminate(productCb, (productObj.variants || []).map(x => x.id));
  }

  /* toggle single variant */
  function toggleVariant(productObj, variantObj, productCb) {
    const vid = String(variantObj.id);
    if (selectedVariants.has(vid)) {
      selectedVariants.delete(vid);
    } else {
      selectedVariants.set(vid, {
        productId: String(productObj.id),
        productName: productObj.name || `Product #${productObj.id}`,
        variantLabel: (variantObj.variant_value || `Variant #${variantObj.id}`),
        colorHex: getSwatchHexByName(variantObj.variant_value) || '#f324e5ff'
      });
    }
    setParentCheckboxIndeterminate(productCb, (productObj.variants || []).map(x => x.id));
  }

  /* nice color for swatch */
  function getSwatchHexByName(name) {
    if (!name) return null;
    const n = String(name).trim().toLowerCase();
    const hit = COLOR_OPTIONS.find(c => c.value.toLowerCase() === n || c.label.toLowerCase() === n);
    return hit ? hit.swatch : null;
  }

  // DOM refs
  const elAudience = $("#chooseAudience");
  const rowUser    = $("#userChooserRow");
  const elUser     = $("#chooseUser");
  const elProduct  = $("#chooseProduct");
  const elCategory = $("#chooseCategory");
  const elDiscount = $("#discount");
  const btnSave    = $("#saveDiscount");
  // Tom Select instances
  let tsProduct = null;
  let tsUser    = null;
  // Users data stores
  let usersLoaded = false;
  /** arrays of option objects */
  const optionsAllUsers   = [];               // all users
  const optionsByRole     = {                 // role → options subset
    customer: [],
    dealer:   [],
    architect:[]
  };
  /** id buckets only */
  const buckets           = {
    customer: [],
    dealer:   [],
    architect:[]
  };
  // Common POST
  function apiPost(url, bodyObj) {
    return fetch(url, {
      method: "POST",
      headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
        ...(token ? { "Authorization": `Bearer ${token}` } : {})
      },
      body: bodyObj ? JSON.stringify(bodyObj) : "{}"
    }).then(r => r.json());
  }
  // Tom Select init once
  function initTomSelectOnce(el, opts = {}) {
    if (el.dataset.tsInit === "1") return el.tomselect;
    const ts = new TomSelect(el, {
      plugins: { dropdown_input: {}, remove_button: { title: 'Remove' } },
      allowEmptyOption: true,
      maxOptions: 500,
      maxItems: null,                  // MULTI
      sortField: { field: 'text', direction: 'asc' },
      searchField: ['text'],
      create: false,
      hideSelected: false,
      closeAfterSelect: false,
      selectOnTab: true,
      render: {
        item: (data, escape)   => `<div>${escape(data.text || '')}</div>`,
        option: (data, escape) => `<div><span class="lbl">${escape(data.text || '')}</span></div>`
      },
      ...opts
    });
    if (ts.wrapper?.classList.contains('select')) ts.wrapper.classList.remove('select');
    el.dataset.tsInit = "1";
    el.tomselect = ts;
    return ts;
  }
  function refillTomSelect(ts, options, placeholderText = 'Select', addEmpty = true) {
    ts.clear(); ts.clearOptions();
    if (addEmpty) ts.addOption({ value: '', text: placeholderText });
    if (Array.isArray(options) && options.length) ts.addOptions(options);
    ts.refreshOptions(false);
  }

  /* =========================
   * PRODUCTS
   * ========================= */
  function fetchProductsByCategoryName(categoryName) {
    const container = document.getElementById('productTree');
    clearVariantSelection();

    if (!categoryName) {
      if (container) {
        container.innerHTML = `<div class="rounded-lg border border-gray-200 p-3 text-sm text-gray-500">Select a category first</div>`;
      }
      return;
    }

    if (container) {
      container.innerHTML = `<div class="rounded-lg border border-gray-200 p-3 text-sm text-gray-500">Loading products...</div>`;
    }

    const payload = { search_category: String(categoryName).toUpperCase() };

    apiPost(URL_PRODUCTS, payload)
      .then(data => {
        const products = (data && data.success && Array.isArray(data.data)) ? data.data : [];
        renderProductTree(products);
      })
      .catch(err => {
        console.error("Error fetching products by category:", err);
        if (container) {
          container.innerHTML = `<div class="rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">Failed to load products</div>`;
        }
      });
  }
  function renderProductTree(apiProducts) {
    const container = document.getElementById('productTree');
    if (!container) return;

    container.innerHTML = '';

    if (!apiProducts || !apiProducts.length) {
      container.innerHTML = `<div class="rounded-lg border border-gray-200 p-3 text-sm text-gray-500">No products found</div>`;
      return;
    }

    const wrap = document.createElement('div');
    wrap.className = 'tree-wrap';

    apiProducts.forEach((p) => {
      const productDiv = document.createElement('div');
      productDiv.className = 'tree-product';

      const productId = p.id;
      const productName = p.name || `Product #${productId}`;
      const variantIds = (p.variants || []).map(v => v.id);

      // Header
      const head = document.createElement('div');
      head.className = 'tree-head';

      const caret = document.createElement('span');
      caret.className = 'caret';
      caret.textContent = '›';

      const cb = document.createElement('input');
      cb.type = 'checkbox';
      cb.className = 'product-cb';
      cb.dataset.productId = String(productId);
      cb.addEventListener('change', e => {
        toggleProduct(p, e.target.checked, cb, variantsGroup);
      });

      const title = document.createElement('span');
      title.className = 'font-medium text-gray-800';
      title.textContent = productName;

      const count = document.createElement('span');
      count.className = 'badge';
      count.textContent = `${variantIds.length} variants`;

      head.appendChild(caret);
      head.appendChild(cb);
      head.appendChild(title);
      head.appendChild(count);

      head.addEventListener('click', (e) => {
        if (e.target === cb) return;
        variantsGroup.classList.toggle('open');
        caret.textContent = variantsGroup.classList.contains('open') ? '‹' : '›';
      });

      // Variants list
      const variantsGroup = document.createElement('div');
      variantsGroup.className = 'tree-variants';

      (p.variants || []).forEach(v => {
        const row = document.createElement('div');
        row.className = 'tree-variant';

        const vcb = document.createElement('input');
        vcb.type = 'checkbox';
        vcb.dataset.variantId = String(v.id);
        vcb.addEventListener('change', () => toggleVariant(p, v, cb));

        const colorHex = getSwatchHexByName(v.variant_value);
        const sw = document.createElement('span');
        sw.className = 'ts-swatch';
        sw.style.background = colorHex || '#E5E7EB';

        const label = document.createElement('span');
        label.textContent = v.variant_value ? `${v.variant_value}` : `Variant #${v.id}`;

        row.appendChild(vcb);
        row.appendChild(sw);
        row.appendChild(label);
        variantsGroup.appendChild(row);
      });

      productDiv.appendChild(head);
      productDiv.appendChild(variantsGroup);
      wrap.appendChild(productDiv);
    });

    container.appendChild(wrap);
  }
  /* =========================
   * USERS
   * ========================= */
  function fetchUsers() {
    apiPost(URL_USERS)
      .then(data => {
        if (!(data && data.success)) return;

        (data.data || []).forEach(u => {
          const raw  = (u.user_type || u.role || '').toString().toLowerCase();
          const role = ['customer','dealer','architect'].includes(raw) ? raw : 'customer';
          const value = String(u.id);
          const text  = u.name || `User #${u.id}`;

          // option object for TomSelect
          const opt = { value, text, role };
          optionsAllUsers.push(opt);
          optionsByRole[role].push(opt);
          buckets[role].push(value);

          // map for grid display
          userMap.set(value, { name: text, role });
        });

        tsUser = initTomSelectOnce(elUser, {
          placeholder: 'Search & select user(s)...'
        });

        // default: specific → all users, nothing selected
        refillTomSelect(tsUser, optionsAllUsers, 'Select User', false);
        usersLoaded = true;

        // apply current audience mode after load (in case user changed early)
        applyAudienceUI(/*reapply=*/true);
      })
      .catch(err => console.error("Error fetching users:", err));
  }
  /* =========================
   * CATEGORIES
   * ========================= */
  function fetchCategories() {
    apiPost(URL_CATEGORIES)
      .then(data => {
        if (!(data && Array.isArray(data.data))) return;

        // Clear and add the default option
        elCategory.innerHTML = "";
        const def = document.createElement("option");
        def.value = "";
        def.textContent = "Select Category";
        elCategory.appendChild(def);

        // Append categories (value = id, visible text = name)
        data.data.forEach(cat => {
          const id   = String(cat.id);
          const name = String(cat.name || "").trim();

          const opt = document.createElement("option");
          opt.value = id;
          opt.textContent = name;
          elCategory.appendChild(opt);

          // map for grid display
          categoryMap.set(id, { name });
        });

        // Change handler: fetch products by selected category NAME
        elCategory.addEventListener("change", function () {
          const selectedText = elCategory.options[elCategory.selectedIndex]?.text?.trim() || "";
          // Clear previous product value and disable while loading
          // if (tsProduct) tsProduct.clear(true);
          currentCategoryName = selectedText; // store for confirmation grid
          tsProduct?.clear(true);
          fetchProductsByCategoryName(selectedText);
        });
      })
      .catch(err => console.error("Error fetching categories:", err));
  }

  /* =========================
   * AUDIENCE MODE BEHAVIOR
   * ========================= */
  function applyAudienceUI(reapply=false) {
    const mode = elAudience.value; // 'specific' | 'dealer' | 'architect' | 'customer'

    // If users not loaded yet, just ensure user field is visible and return;
    // we’ll reapply once usersLoaded becomes true.
    if (!usersLoaded) {
      rowUser.classList.remove('is-hidden');
      return;
    }

    if (mode === 'specific') {
      // Show all users; do not preselect anything (unless reapply flag says keep current)
      rowUser.classList.remove('is-hidden');
      refillTomSelect(tsUser, optionsAllUsers, 'Select User', false);
      if (!reapply) tsUser.clear(true);
    } else {
      // Role mode: show only that role’s users, preselect all of them so user can deselect a few
      rowUser.classList.remove('is-hidden');
      const role = mode; // dealer | architect | customer
      const opts = optionsByRole[role] || [];
      const allIds = buckets[role] || [];

      refillTomSelect(tsUser, opts, 'Select User', false);
      // Preselect everyone in that role (user can remove chips to exclude)
      tsUser.setValue(allIds, true); // silent
    }
  }
  elAudience.addEventListener('change', () => applyAudienceUI(false));

  /* =========================
   * SUBMIT
   * ========================= */
  function buildPayloads() {
    const mode = elAudience.value; // 'specific' | role
    const discountValue = parseFloat((elDiscount.value || '').trim());
    const categoryId = elCategory.value;
    const userIds = tsUser ? tsUser.items.slice() : [];

    // validations already done before calling this
    const base = {
      audience_mode: mode,
      audience_role: (mode === 'specific' ? null : mode),
      category_id: String(categoryId),
      discount: isNaN(discountValue) ? "0" : discountValue.toString()
    };

    // Cross-product of users × selectedVariants
    const variantsArr = Array.from(selectedVariants.entries()); // [ [vid, {productId, productName, variantLabel}], ... ]
    const payloads = [];

    userIds.forEach(uid => {
      variantsArr.forEach(([variantId, meta]) => {
        payloads.push({
          ...base,
          user_id: String(uid),
          product_id: meta.productId,
          product_variant_id: String(variantId)
        });
      });
    });

    return payloads;
  }
  function renderConfirmHTML(payloads) {
    const cards = payloads.map(p => {
      const vMeta = selectedVariants.get(String(p.product_variant_id));
      const title = vMeta ? vMeta.productName : `Product ${p.product_id}`;
      const subt  = vMeta ? vMeta.variantLabel : `Variant ${p.product_variant_id}`;
      const sw    = vMeta ? vMeta.colorHex : '#E5E7EB';

      const catInfo = categoryMap.get(String(p.category_id));
      const catName = catInfo ? catInfo.name : `Category ${p.category_id}`;

      const uInfo  = userMap.get(String(p.user_id));
      const uName  = uInfo ? uInfo.name : `User ${p.user_id}`;

      return `
        <div class="confirm-card">
          <div class="confirm-title">${title}</div>
          <div class="confirm-sub">
            <span class="swatch" style="background:${sw}"></span>
            <span>${subt}</span>
          </div>
          <div class="confirm-line"><span>User</span><span>${uName} <span class="muted">(${p.user_id})</span></span></div>
          <div class="confirm-line"><span>Category</span><span>${catName} <span class="muted">(${p.category_id})</span></span></div>
          <div class="confirm-line"><span>Discount</span><span>${p.discount}%</span></div>
        </div>
      `;
    }).join("");

    return `
      <style>
        .confirm-grid{
          display:grid;
          gap:12px;
          grid-template-columns: repeat(1, minmax(0,1fr));
        }
        @media (min-width: 680px){
          .confirm-grid{ grid-template-columns: repeat(2, minmax(0,1fr)); }
        }
        @media (min-width: 1024px){
          .confirm-grid{ grid-template-columns: repeat(3, minmax(0,1fr)); }
        }
        .confirm-card{
          border:1px solid #e5e7eb; border-radius:12px; padding:12px; background:#fff;
        }
        .confirm-title{ font-weight:600; color:#111827; margin-bottom:4px; }
        .confirm-sub{ color:#374151; font-size:12px; margin-bottom:8px; display:flex; align-items:center; gap:8px; }
        .swatch{ width:14px; height:14px; border-radius:50%; border:1px solid rgba(0,0,0,.08); display:inline-block; }
        .confirm-line{ display:flex; justify-content:space-between; font-size:12px; color:#374151; gap:12px; }
        .confirm-line .muted{ color:#6b7280; }
        .confirm-warning{ background:#FFF7ED; border:1px solid #FED7AA; color:#9A3412; padding:10px 12px; border-radius:8px; margin-bottom:10px; }
      </style>
      <div class="confirm-warning">
        Please review carefully. This will create <b>${payloads.length}</b> discounts (user × product × variant).
      </div>
      <div class="confirm-grid">
        ${cards}
      </div>
    `;
  }
  async function postSequentially(payloads) {
    await Swal.fire({
      title: 'Creating discounts…',
      html: `<div id="prog">0 / ${payloads.length} done</div>`,
      allowOutsideClick: false,
      didOpen: async () => {
        Swal.showLoading();
        const prog = document.getElementById('prog');
        let ok = 0, fail = 0;

        for (let i = 0; i < payloads.length; i++) {
          try {
            const res = await apiPost(URL_DISCOUNT, payloads[i]);

            // robust success detection
            const msg = (res && typeof res.message === 'string') ? res.message.toLowerCase() : '';
            const isOk =
              (res && res.success === true) ||
              (res && res.code === 200) ||
              (msg.includes('success')) ||
              (res && res.data && (res.data.id || res.data.product_variant_id));

            if (isOk) ok++; else fail++;
          } catch(e) {
            fail++;
          }
          if (prog) prog.textContent = `${i+1} / ${payloads.length} done`;
        }

        Swal.close();

        const title = fail ? 'Completed with warnings' : 'All done!';
        const icon  = fail ? 'warning' : 'success';
        const msg   = `${ok} discount${ok!==1?'s':''} created${fail ? `, ${fail} failed` : ''}`;

        await Swal.fire({ icon, title, text: msg });

        clearFields();
      }
    });
  }
  function submitDiscount() {
    const mode = elAudience.value;
    const discountValue = parseFloat((elDiscount.value || '').trim());
    if (isNaN(discountValue)) {
      Swal.fire({ icon:'error', title:'Invalid Discount', text:'Please enter a valid discount value.' });
      return;
    }

    const selectedUserIds = tsUser ? tsUser.items.slice() : [];
    if (!selectedUserIds.length) {
      Swal.fire({ icon:'error', title:'Select user(s)', text:'Please choose at least one user.' });
      return;
    }

    if (!elCategory.value) {
      Swal.fire({ icon:'error', title:'Select category', text:'Please select a category.' });
      return;
    }

    if (selectedVariants.size === 0) {
      Swal.fire({ icon:'error', title:'Select variant(s)', text:'Please select at least one variant.' });
      return;
    }

    // Build all payloads (user × product × variant)
    const payloads = buildPayloads();

    // Confirmation grid
    Swal.fire({
      title: 'Confirm discounts',
      html: renderConfirmHTML(payloads),
      width: Math.min(window.innerWidth - 40, 1000),
      showCancelButton: true,
      confirmButtonText: 'Yes, create',
      cancelButtonText: 'No, go back',
    }).then(async (res) => {
      if (res.isConfirmed) {
        await postSequentially(payloads);
      }
    });
  }
  function clearFields() {
    // audience
    elAudience.value = 'specific';
    applyAudienceUI();

    // users
    if (tsUser) {
      tsUser.clear(true);
      tsUser.clearOptions();
      refillTomSelect(tsUser, optionsAllUsers, 'Select User', false);
    }

    // category & product tree
    elCategory.value = "";
    const container = document.getElementById('productTree');
    if (container) {
      container.innerHTML = `<div class="rounded-lg border border-gray-200 p-3 text-sm text-gray-500">Select a category first</div>`;
    }
    clearVariantSelection();

    // discount
    elDiscount.value = "";
  }
  /* =========================
   * INIT
   * ========================= */
  btnSave.addEventListener("click", function (e) { e.preventDefault(); submitDiscount(); });

  // initial UI (in case users load slightly later)
  applyAudienceUI(true);

  fetchUsers();
  fetchCategories();
});
</script>

<?php include("footer1.php"); ?>
