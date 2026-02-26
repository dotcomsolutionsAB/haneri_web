<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php 
    $current_page = "Add Product";
?>
<?php include("header1.php"); ?>

<main class="grow content pt-5" id="content" role="content">
    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-gray-900">Add - Product</h1>
                <div class="text-xs text-gray-500">Blank form • 1 Feature row • 2 Variant rows</div>
            </div>
            <div class="flex items-center gap-2.5">
                <a class="btn btn-sm btn-light" href="pages/show_products.php">Products</a>
            </div>
        </div>
    </div>

    <div class="container-fixed">
        <div class="grid gap-5 grid-cols-2 lg:gap-7.5 xl:w-[68.75rem] mx-auto">
            <!-- General Settings -->
            <div class="col-span-1">
                <div class="card pb-2.5">
                    <div class="card-header" id="basic_settings">
                        <h3 class="card-title">General Settings</h3>
                    </div>
                    <div class="card-body grid gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label for="product_name" class="form-label max-w-56">Product Name</label>
                            <input class="input" type="text" id="product_name" placeholder="">
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label for="brand" class="form-label max-w-56">Brand</label>
                            <select class="select" id="brand">
                                <option value="">Select</option>
                                <option value="1">Haneri</option>
                            </select>
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label for="category" class="form-label max-w-56">Category</label>
                            <select class="select" id="category">
                                <option value="">Select</option>
                                <option value="1">CEILING FAN</option>
                                <option value="2">TABLE WALL PEDESTALS</option>
                                <option value="3">DOMESTIC EXHAUSTS</option>
                                <option value="4">PERSONAL</option>
                            </select>
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label for="slug" class="form-label max-w-56">Slug</label>
                            <input class="input" type="text" id="slug" placeholder="">
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label for="is_active" class="form-label max-w-56">Is Publish</label>
                            <select class="select" id="is_active">
                                <option value="true">Yes</option>
                                <option value="false" selected>No</option>
                            </select>
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label for="description" class="form-label max-w-56">Description</label>
                            <textarea class="note-codable text-edit" id="description" aria-multiline="true" placeholder=""></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="col-span-1">
                <div class="card p-2.5">
                    <div class="card-header" id="features">
                        <div class="flex items-center justify-between w-full">
                            <h3 class="card-title">Features</h3>
                            <button id="add_feature" class="btn btn-sm btn-primary">+ Add Feature</button>
                        </div>
                    </div>
                    <div class="p-2">
                        <table class="table table-bordered w-full" id="features_table">
                            <thead>
                                <tr>
                                    <th style="width: 22%">Feature Name</th>
                                    <th>Feature Value</th>
                                    <th style="width: 16%">Filterable?</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="features_body">
                                <!-- 1 blank row will be inserted by JS -->
                            </tbody>
                        </table>
                        <div class="text-xs text-gray-500 mt-2">Only non-empty features are sent.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Variants -->
        <div class="grid gap-5 grid-cols-1 lg:gap-7.5 xl:w-[68.75rem] mx-auto mt-5">
            <div class="col-span-1">
                <div class="card pb-2.5">
                    <div class="card-header" id="variants">
                        <div class="flex items-center justify-between w-full">
                            <h3 class="card-title">Variants</h3>
                            <button id="add_variant" class="btn btn-sm btn-primary">+ Add Variant</button>
                        </div>
                    </div>
                    <div class="card-body overflow-auto">
                        <table class="table table-bordered w-full min-w-[1800px]" id="variants_table">
                            <thead>
                                <tr>
                                    <th style="width: 200px">Banner (files)</th>
                                    <th style="width: 200px">Photos (files)</th>
                                    <th style="width: 90px">Min Qty</th>
                                    <th style="width: 90px">COD?</th>
                                    <th style="width: 110px">Weight</th>
                                    <th style="width: 200px">Description</th>
                                    <th style="width: 120px">Variant Type</th>
                                    <th style="width: 160px">Variant Value</th>
                                    <th style="width: 120px">Regular ₹</th>
                                    <th style="width: 120px">Selling ₹</th>
                                    <th style="width: 140px">Vendor Sale ₹</th>
                                    <th style="width: 120px">HSN</th>
                                    <th style="width: 110px">Reg. Tax %</th>
                                    <th style="width: 110px">Sell. Tax %</th>
                                    <th style="width: 200px">Video URL</th>
                                    <th style="width: 200px">Product PDF</th>
                                    <th style="width: 90px">Action</th>
                                </tr>
                            </thead>
                            <tbody id="variants_body">
                                <!-- 2 blank rows will be inserted by JS -->
                            </tbody>
                        </table>
                        <div class="text-xs text-gray-500 mt-2">Files are uploaded per-variant. Keep empty if not needed.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="xl:w-[68.75rem] mx-auto mt-5">
            <div class="card">
                <div class="card-body flex flex-col lg:py-6 lg:gap-7.5 gap-7">
                    <div class="flex justify-end gap-2.5">
                        <button class="btn btn-danger" id="create_product">Create Product</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
(function() {
    const authToken = localStorage.getItem('auth_token');
    const BASE_URL  = '<?php echo BASE_URL; ?>';

    const q  = (sel, root=document) => root.querySelector(sel);
    const qa = (sel, root=document) => Array.from(root.querySelectorAll(sel));

    const parseNum  = (v) => {
        const s = (v ?? '').toString().trim();
        if (!s) return null;
        const n = Number(s);
        return Number.isFinite(n) ? n : null;
    };
    const parseBool = (v) => (v === true || v === 'true');
    const toBoolVal = (el) => parseBool(el?.value);

    // Auto-slug from product name (only if slug untouched)
    q('#product_name').addEventListener('input', (e) => {
        const name = e.target.value || '';
        const slugInput = q('#slug');
        if (!slugInput.value || slugInput.dataset.touched !== '1') {
            slugInput.value = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    });
    q('#slug').addEventListener('input', (e) => e.target.dataset.touched = '1');

    // ===== FEATURES =====
    const featuresBody = q('#features_body');
    const addFeatureRow = (data = {}) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="text" class="input feature_name" placeholder="" value="${data.feature_name ?? ''}"></td>
            <td><input type="text" class="input feature_value" placeholder="" value="${data.feature_value ?? ''}"></td>
            <td>
                <select class="select feature_filterable">
                    <option value="true" ${data.is_filterable ? 'selected' : ''}>Yes</option>
                    <option value="false" ${!data.is_filterable ? 'selected' : ''}>No</option>
                </select>
            </td>
            <td><button type="button" class="btn btn-sm btn-light danger remove_feature">Remove</button></td>
        `;
        featuresBody.appendChild(tr);
        tr.querySelector('.remove_feature').addEventListener('click', () => tr.remove());
    };
    q('#add_feature').addEventListener('click', () => addFeatureRow());
    // Seed exactly ONE blank feature row
    addFeatureRow();

    // ===== VARIANTS =====
    const variantsBody = q('#variants_body');
    const addVariantRow = (data = {}) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <input type="file" class="input v_banners" multiple accept="image/*,application/pdf,video/*">
                <div class="text-2xs text-gray-500 mt-1">Select one or more (images/video/pdf)</div>
            </td>
            <td>
                <input type="file" class="input v_photos" multiple accept="image/*">
                <div class="text-2xs text-gray-500 mt-1">Select one or more images</div>
            </td>
            <td><input type="number" step="1" min="1" class="input v_min_qty" placeholder="" value="${data.min_qty ?? ''}"></td>
            <td>
                <select class="select v_is_cod">
                    <option value="true" ${data.is_cod ? 'selected' : ''}>Yes</option>
                    <option value="false" ${!data.is_cod ? 'selected' : ''}>No</option>
                </select>
            </td>
            <td><input type="number" step="0.01" class="input v_weight" placeholder="" value="${data.weight ?? ''}"></td>
            <td><input type="text" class="input v_description" placeholder="" value="${data.description ?? ''}"></td>
            <td><input type="text" class="input v_variant_type" placeholder="" value="${data.variant_type ?? ''}"></td>
            <td><input type="text" class="input v_variant_value" placeholder="" value="${data.variant_value ?? ''}"></td>
            <td><input type="number" step="0.01" class="input v_regular_price" placeholder="" value="${data.regular_price ?? ''}"></td>
            <td><input type="number" step="0.01" class="input v_selling_price" placeholder="" value="${data.selling_price ?? ''}"></td>
            <td><input type="number" step="0.01" class="input v_sales_price_vendor" placeholder="" value="${data.sales_price_vendor ?? ''}"></td>
            <td><input type="text" class="input v_hsn" placeholder="" value="${data.hsn ?? ''}"></td>
            <td><input type="number" step="0.01" class="input v_regular_tax" placeholder="" value="${data.regular_tax ?? ''}"></td>
            <td><input type="number" step="0.01" class="input v_selling_tax" placeholder="" value="${data.selling_tax ?? ''}"></td>
            <td><input type="url" class="input v_video_url" placeholder="" value="${data.video_url ?? ''}"></td>
            <td><input type="url" class="input v_product_pdf" placeholder="" value="${data.product_pdf ?? ''}"></td>
            <td><button type="button" class="btn btn-sm btn-light danger remove_variant">Remove</button></td>
        `;
        variantsBody.appendChild(tr);
        tr.querySelector('.remove_variant').addEventListener('click', () => tr.remove());
    };
    q('#add_variant').addEventListener('click', () => addVariantRow());
    // Seed exactly TWO blank variant rows
    addVariantRow();
    addVariantRow();

    // ===== HELPERS: networking =====
    async function postJSON(url, bodyObj) {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + authToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(bodyObj)
        });
        const text = await res.text();
        try { return { ok: res.ok, json: JSON.parse(text) }; }
        catch { return { ok: res.ok, json: null, text }; }
    }

    async function postFiles(url, formData) {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + authToken
                // Content-Type is auto-set for multipart boundaries
            },
            body: formData
        });
        const text = await res.text();
        try { return { ok: res.ok, json: JSON.parse(text) }; }
        catch { return { ok: res.ok, json: null, text }; }
    }

    function findCreatedVariants(respJson) {
        // Try a few common shapes
        const candidates = [
            respJson?.data?.variants,
            respJson?.variants,
            respJson?.product?.variants,
            Array.isArray(respJson) ? respJson : null
        ].filter(Array.isArray)[0] || [];

        // Only keep ones that have id
        return candidates.filter(v => v && (v.id !== undefined && v.id !== null));
    }

    // ===== SUBMIT =====
    q('#create_product').addEventListener('click', async function() {
        const name = q('#product_name').value.trim();
        const brand_id = q('#brand').value ? Number(q('#brand').value) : null;
        const category_id = q('#category').value ? Number(q('#category').value) : null;
        const slug = q('#slug').value.trim();
        const description = q('#description').value.trim();
        const is_active = toBoolVal(q('#is_active'));

        if (!name) return alert('Please enter Product Name.');
        if (!brand_id) return alert('Please select Brand.');
        if (!category_id) return alert('Please select Category.');
        if (!slug) return alert('Please enter Slug.');

        // Build features array (skip empty)
        const features = qa('#features_body tr').map(tr => {
            const feature_name = tr.querySelector('.feature_name')?.value.trim() || '';
            const feature_value = tr.querySelector('.feature_value')?.value.trim() || '';
            const is_filterable = toBoolVal(tr.querySelector('.feature_filterable'));
            if (!feature_name || !feature_value) return null;
            return { feature_name, feature_value, is_filterable };
        }).filter(Boolean);

        // Build variants JSON + keep DOM rows we will send (to align files later)
        const variantRows = [];
        const variants = qa('#variants_body tr').map(tr => {
            const min_qty = parseNum(tr.querySelector('.v_min_qty')?.value);
            const is_cod = toBoolVal(tr.querySelector('.v_is_cod'));
            const weight = parseNum(tr.querySelector('.v_weight')?.value);
            const desc = tr.querySelector('.v_description')?.value.trim() || null;
            const variant_type = tr.querySelector('.v_variant_type')?.value.trim() || null;
            const variant_value = tr.querySelector('.v_variant_value')?.value.trim() || null;
            const regular_price = parseNum(tr.querySelector('.v_regular_price')?.value);
            const selling_price = parseNum(tr.querySelector('.v_selling_price')?.value);
            const sales_price_vendor = parseNum(tr.querySelector('.v_sales_price_vendor')?.value);
            const hsn = tr.querySelector('.v_hsn')?.value.trim() || null;
            const regular_tax = parseNum(tr.querySelector('.v_regular_tax')?.value);
            const selling_tax = parseNum(tr.querySelector('.v_selling_tax')?.value);
            const video_url = tr.querySelector('.v_video_url')?.value.trim() || null;
            const product_pdf = tr.querySelector('.v_product_pdf')?.value.trim() || null;

            if (!variant_type || !variant_value) return null; // ignore empty rows

            const obj = {
                min_qty, is_cod, weight, description: desc,
                variant_type, variant_value, regular_price, selling_price, sales_price_vendor,
                hsn, regular_tax, selling_tax, video_url, product_pdf
            };
            variantRows.push(tr); // keep same order as we push into variants[]
            return obj;
        }).filter(Boolean);

        const payload = {
            name, brand_id, category_id, slug, description, is_active,
            features, variants
        };

        // STEP 1: Create product
        const createRes = await postJSON(`${BASE_URL}/products/register`, payload);
        if (!createRes.ok) {
            console.error('Create error:', createRes.json || createRes.text);
            return alert((createRes.json && (createRes.json.message || createRes.json.error)) || 'Error creating product.');
        }

        const created = createRes.json || {};
        // Try to get created variants with IDs
        let createdVariants = findCreatedVariants(created);

        // Fallback: sometimes API returns product object directly with same order
        if ((!createdVariants || createdVariants.length === 0) && Array.isArray(created?.data)) {
            createdVariants = created.data.filter(v => v && v.id != null);
        }

        // If still no variant ids, try to map by order via another known path
        if ((!createdVariants || createdVariants.length === 0) && Array.isArray(created?.product?.variants)) {
            createdVariants = created.product.variants.filter(v => v && v.id != null);
        }

        if (!Array.isArray(createdVariants) || createdVariants.length !== variants.length) {
            // Last effort: try to match by (type,value) pairs if API returned a flat `variants`
            const respAll = (created?.data?.variants || created?.variants || []);
            if (Array.isArray(respAll) && respAll.length >= variants.length) {
                const map = [];
                variants.forEach(v => {
                    const idx = respAll.findIndex(rv => rv.variant_type === v.variant_type && rv.variant_value === v.variant_value && rv.id != null && !map.some(m => m.id === rv.id));
                    if (idx >= 0) map.push(respAll[idx]);
                });
                if (map.length === variants.length) createdVariants = map;
            }
        }

        if (!Array.isArray(createdVariants) || createdVariants.length !== variants.length) {
            console.warn('Could not reliably map variant IDs from API response. Proceeding without uploads.', created);
            if (window.Swal) {
                return Swal.fire({
                    title: 'Product Created',
                    text: 'Product created, but variant IDs were not returned as expected—skipping file uploads.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(() => location.href = 'pages/show_products.php');
            } else {
                alert('Product created, but variant IDs not returned as expected—skipping file uploads.');
                return location.href = 'pages/show_products.php';
            }
        }

        // STEP 2 & 3: For each variant, upload photos then banners (if any)
        const uploadPromises = createdVariants.map(async (cv, i) => {
            const tr = variantRows[i];
            const vid = cv.id;

            // Collect chosen files
            const photosInput  = tr.querySelector('.v_photos');
            const bannersInput = tr.querySelector('.v_banners');

            // Upload PHOTOS first (if any)
            if (photosInput && photosInput.files && photosInput.files.length > 0) {
                const fdPhotos = new FormData();
                for (let p = 0; p < photosInput.files.length; p++) {
                    fdPhotos.append('photos[]', photosInput.files[p]);
                }
                const photosRes = await postFiles(`${BASE_URL}/products/${vid}/photos`, fdPhotos);
                if (!photosRes.ok) {
                    console.error(`Photos upload failed for variant ${vid}:`, photosRes.json || photosRes.text);
                    throw new Error(`Photos upload failed for variant ${vid}`);
                }
            }

            // Upload BANNERS (if any)
            if (bannersInput && bannersInput.files && bannersInput.files.length > 0) {
                const fdBanners = new FormData();
                for (let b = 0; b < bannersInput.files.length; b++) {
                    fdBanners.append('banners[]', bannersInput.files[b]);
                }
                const bannersRes = await postFiles(`${BASE_URL}/products/${vid}/banners`, fdBanners);
                if (!bannersRes.ok) {
                    console.error(`Banners upload failed for variant ${vid}:`, bannersRes.json || bannersRes.text);
                    throw new Error(`Banners upload failed for variant ${vid}`);
                }
            }
        });

        try {
            await Promise.all(uploadPromises);
        } catch (e) {
            console.error('One or more uploads failed:', e);
            if (window.Swal) {
                return Swal.fire({
                    title: 'Product Created',
                    text: 'Some file uploads failed. Check console for details.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(() => location.href = 'pages/show_products.php');
            } else {
                alert('Product created, but some file uploads failed. Check console.');
                return location.href = 'pages/show_products.php';
            }
        }

        // All good
        if (window.Swal) {
            Swal.fire({
                title: 'Success!',
                text: 'Product created and files uploaded successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => location.href = 'pages/show_products.php');
        } else {
            alert('Product created and files uploaded successfully.');
            location.href = 'pages/show_products.php';
        }
    });
})();
</script>


<style>
    .text-edit{
        width: 100%;
        min-height: 120px;
        border: 1px solid rgba(128, 128, 128, 0.34);
        border-radius: 10px;
        background: #fcfcfc;
        padding: 8px 12px;
        text-align: justify;
    }
   /* Variants table sizing by ID */
#variants_table { table-layout: fixed; min-width: 1800px; }
#variants_table th, #variants_table td { vertical-align: middle; }
#variants_table input[type="text"],
#variants_table input[type="number"],
#variants_table input[type="url"],
#variants_table select,
#variants_table textarea {
  width: 100%;
  max-width: 100%;
  height: 42px;
  padding: 8px 10px;
  box-sizing: border-box;
}
#variants_table input[type="file"] { width: 100%;     padding-top: 10px;}
#variants_table td { min-width: 80px; white-space: normal; } /* let long text wrap */

.table th, .table td { vertical-align: middle; }
    .btn.danger { color: #b42318; border-color: #f3d5d3; }
    .min-w-\[1400px] { min-width: 1400px; }
    .text-2xs { font-size: 11px; line-height: 1.1; }

</style>

<?php include("footer1.php"); ?>
