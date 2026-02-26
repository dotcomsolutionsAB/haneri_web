<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php 
    $current_page = "Update Product";
?>
<?php include("header1.php"); ?>

<main class="grow content pt-5" id="content" role="content">
    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-gray-900">Update - Product</h1>
                <div class="text-xs text-gray-500">Edit the product details, features, and variants</div>
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
                                <!-- Features rows will be inserted by JS -->
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
                                    <th style="width: 200px">Variant Banner</th>
                                    <th style="width: 200px">Photos (files)</th>                                    
                                    <th style="width: 200px">Variant Photos</th>
                                    <th style="width: 90px">Min Qty</th>
                                    <th style="width: 90px">COD?</th>
                                    <th style="width: 90px">Weight</th>
                                    <th style="width: 120px">Description</th>
                                    <th style="width: 120px">Variant Type</th>
                                    <th style="width: 160px">Variant Value</th>
                                    <th style="width: 120px">Regular ₹</th>
                                    <th style="width: 120px">Customer. Disc %</th>
                                    <th style="width: 120px">Dealer Disc %</th>
                                    <th style="width: 120px">Architect. Disc %</th>
                                    <th style="width: 120px">HSN</th>
                                    <th style="width: 110px">Reg. Tax %</th>
                                    <th style="width: 110px">Sell. Tax %</th>
                                    <th style="width: 200px">Video URL</th>
                                    <th style="width: 200px">Product PDF</th>
                                    <th style="width: 90px">Action</th>
                                </tr>
                            </thead>
                            <tbody id="variants_body">
                                <!-- Variants rows will be inserted by JS -->
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
                        <button class="btn btn-danger" id="update_product">Update Product</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<script>
	(function() {
		const authToken = localStorage.getItem('auth_token');
		const BASE_URL = '<?php echo BASE_URL; ?>';
		const productId = new URLSearchParams(window.location.search).get('id');

		if (!productId) {
			alert('Product ID is required');
			window.location.href = 'pages/show_products.php';
		}

		const q = (sel, root = document) => root.querySelector(sel);
		const qa = (sel, root = document) => Array.from(root.querySelectorAll(sel));

		const parseNum = (v) => {
			const s = (v ?? '').toString().trim();
			if (!s) return null;
			const n = Number(s);
			return Number.isFinite(n) ? n : null;
		};
		const parseBool = (v) => (v === true || v === 'true');
		const toBoolVal = (el) => parseBool(el?.value);

		// ===== HELPERS: networking =====
		async function getProductData(productId) {
			const res = await fetch(`${BASE_URL}/products/get_admin/${productId}`, {
				method: 'POST',
				headers: {
					'Authorization': 'Bearer ' + authToken,
					'Content-Type': 'application/json'
				}
			});
			const text = await res.text();
			try {
				return {
					ok: res.ok,
					json: JSON.parse(text)
				};
			} catch {
				return {
					ok: res.ok,
					json: null,
					text
				};
			}
		}
		async function postJSON(url, bodyObj) {
			const res = await fetch(url, {
				method: 'PUT',
				headers: {
					'Authorization': 'Bearer ' + authToken,
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(bodyObj)
			});
			const text = await res.text();
			try {
				return {
					ok: res.ok,
					json: JSON.parse(text)
				};
			} catch {
				return {
					ok: res.ok,
					json: null,
					text
				};
			}
		}
		async function postFiles(url, formData) {
			const res = await fetch(url, {
				method: 'POST',
				headers: {
					'Authorization': 'Bearer ' + authToken
				},
				body: formData
			});
			const text = await res.text();
			try {
				return {
					ok: res.ok,
					json: JSON.parse(text)
				};
			} catch {
				return {
					ok: res.ok,
					json: null,
					text
				};
			}
		}

		function setSelectByValueOrText(selectEl, incoming) {
			if (!selectEl || incoming == null) return;

			// Normalize to string
			const inStr = String(
				incoming?.id ?? incoming?.name ?? incoming
			).trim();

			// Try direct value match (ids like "1")
			for (const opt of selectEl.options) {
				if (opt.value === inStr) {
					selectEl.value = inStr;
					return;
				}
			}

			// Fallback: match by visible text (case/space-insensitive)
			const norm = s => String(s ?? '').trim().toLowerCase().replace(/\s+/g, ' ');
			const inNorm = norm(inStr);

			for (const opt of selectEl.options) {
				const text = opt.textContent || opt.innerText || '';
				if (norm(text) === inNorm) {
					selectEl.value = opt.value;
					return;
				}
			}
		}

		function clearFeaturesTable() {
			const tbody = q('#features_body');
			if (tbody) tbody.innerHTML = '';
		}

		function clearVariantsTable() {
			const tbody = q('#variants_body');
			if (tbody) tbody.innerHTML = '';
		}

		// Re-use your existing row builders + thumbnail painters
		function populateProductUI(product) {
			// General fields
			q('#product_name').value = product.name || '';
			q('#slug').value = product.slug || '';
			q('#description').value = product.description || '';
			q('#is_active').value = product.is_active === 1 || product.is_active === true ? 'true' : 'false';

			// Brand & Category (robust setter you added earlier)
			const brandSelect = q('#brand');
			const categorySelect = q('#category');
			const incomingBrand = product.brand_id ?? product.brand?.id ?? product.brand;
			const incomingCategory = product.category_id ?? product.category?.id ?? product.category;
			setSelectByValueOrText(brandSelect, incomingBrand);
			setSelectByValueOrText(categorySelect, incomingCategory);

			// Features
			clearFeaturesTable();
			(product.features || []).forEach(f => addFeatureRow(f));

			// Variants
			clearVariantsTable();
			(product.variants || []).forEach(v => {
				// ensure id sticks into the row
				const rowEl = addVariantRow({
					...v,
					id: v.id
				});

				// Your painters accept [{id,url}], and your API already sends {id,url}
				if (Array.isArray(v.file_urls)) displayPhotoThumbnails(v.file_urls, rowEl, v.id);
				if (Array.isArray(v.banner_urls)) displayBannerThumbnails(v.banner_urls, rowEl, v.id);
			});
		}

		async function populateProductForm(productId) {
			const data = await getProductData(productId);

			console.log(data); // for debugging

			if (!data?.json?.data) {
				alert('Product not found');
				return (window.location.href = 'pages/show_products.php');
			}

			const product = data.json.data;
			// Single call — this fills general fields, brand/category, features, and variants
			populateProductUI(product);
		}

		function addFeatureRow(data = {}) {
			const tr = document.createElement('tr');
			tr.innerHTML = `
                <input type="hidden" class="feature_id" value="${data.id ?? ''}">
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
			q('#features_body').appendChild(tr);

			tr.querySelector('.remove_feature').addEventListener('click', async () => {
				const featureId = tr.querySelector('.feature_id')?.value?.trim();

				// If this row is not saved yet (no id) just remove the row
				if (!featureId) return tr.remove();

				// Confirm & delete via API
				const confirm = await Swal.fire({
					title: 'Delete this feature?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Delete',
					confirmButtonColor: '#b91c1c'
				});
				if (!confirm.isConfirmed) return;

				const delRes = await fetch(`${BASE_URL}/products/features/${featureId}`, {
					method: 'DELETE',
					headers: {
						'Authorization': 'Bearer ' + authToken
					}
				});

				const delText = await delRes.text();
				let delOut = null;
				try {
					delOut = JSON.parse(delText);
				} catch {}

				if (!delRes.ok || !delOut?.success) {
					console.error('Delete feature failed:', delText);
					Swal.fire('Error', (delOut?.message || 'Failed to delete feature.'), 'error');
					return;
				}

				tr.remove();
				Swal.fire('Deleted', 'Feature deleted successfully.', 'success');
			});
		}
		// SweetAlert popup for creating a Feature via API
		q('#add_feature').addEventListener('click', async () => {
			if (!window.Swal) {
				alert('SweetAlert not loaded.');
				return;
			}

			const {
				value: vals
			} = await Swal.fire({
				title: 'Add Feature',
				html: `
                <div style="
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                    gap: 12px;
                    text-align: left;
                    margin-top: 10px;
                ">
                    <div style="display:flex; flex-direction:column; gap:4px;">
                    <label style="font-size:13px; font-weight:500;">Name</label>
                    <input id="swf_name" class="swal2-input" style="height:38px; margin:0;" placeholder="e.g. Speed Control">
                    </div>

                    <div style="display:flex; flex-direction:column; gap:4px;">
                    <label style="font-size:13px; font-weight:500;">Value</label>
                    <input id="swf_value" class="swal2-input" style="height:38px; margin:0;" placeholder="e.g. 5-step">
                    </div>

                    <div style="display:flex; flex-direction:column; gap:4px;">
                    <label style="font-size:13px; font-weight:500;">Filterable?</label>
                    <select id="swf_filter" class="swal2-input" style="height:38px; margin:0;">
                        <option value="false">No</option>
                        <option value="true">Yes</option>
                    </select>
                    </div>
                </div>
                `,
				width: 500,
				background: '#fff',
				showCancelButton: true,
				confirmButtonText: 'Add Feature',
				cancelButtonText: 'Cancel',
				confirmButtonColor: '#2563eb', // blue
				cancelButtonColor: '#b91c1c', // red
				focusConfirm: false,
				preConfirm: () => {
					const feature_name = (document.getElementById('swf_name')?.value || '').trim();
					const feature_value = (document.getElementById('swf_value')?.value || '').trim();
					const is_filterable = (document.getElementById('swf_filter')?.value === 'true');
					if (!feature_name || !feature_value) {
						Swal.showValidationMessage('Both name and value are required');
						return false;
					}
					return {
						feature_name,
						feature_value,
						is_filterable
					};
				}
			});

			if (!vals) return;

			const res = await fetch(`${BASE_URL}/products/${productId}/features`, {
				method: 'POST',
				headers: {
					'Authorization': 'Bearer ' + authToken,
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(vals)
			});

			const text = await res.text();
			let out = null;
			try {
				out = JSON.parse(text);
			} catch {}

			if (!res.ok || !out?.success) {
				console.error('Add feature failed:', text);
				Swal.fire('Error', (out?.message || 'Failed to add feature.'), 'error');
				return;
			}

			const created = Array.isArray(out.data) ? out.data[0] : null;
			if (created) {
				addFeatureRow(created);
				Swal.fire({
					icon: 'success',
					title: 'Feature Added',
					text: 'Feature added successfully.',
					confirmButtonColor: '#2563eb'
				});
			} else {
				Swal.fire('Warning', 'Added, but response didn’t include the feature.', 'warning');
			}
		});

		// ===== ADD VARIANT(S) — Full width modal with Copy & Remove per row =====
		q('#add_variant').addEventListener('click', openAddVariantModal);

		function openAddVariantModal() {
			if (!window.Swal) {
				alert('SweetAlert not loaded.');
				return;
			}

			// Build the modal in one go
			Swal.fire({
				title: 'Add Variant(s)',
				html: `
            <div id="av_wrap" style="width:100%;max-width:1200px;margin:0 auto;">
                <div style="display:flex;justify-content:flex-end;gap:8px;margin-bottom:10px;">
                <button id="av_add_row" class="swal2-confirm" style="color:#fff;background:#2563eb;border:none;padding:8px 12px;border-radius:6px;">+ Add Row</button>
                </div>

                <div id="av_rows" style="display:flex;flex-direction:column;gap:12px;"></div>

                <div style="margin-top:12px;font-size:12px;color:#64748b;">
                Tip: Use <strong>Copy</strong> to duplicate a row; use <strong>×</strong> to remove it.
                </div>
            </div>
            `,
				width: '90vw', // Full width feel
				customClass: {
					popup: 'add-variant-modal'
				},
				background: '#fff',
				focusConfirm: false,
				showCancelButton: true,
				confirmButtonText: 'Save Variant(s)',
				cancelButtonText: 'Cancel',
				confirmButtonColor: '#2563eb', // blue
				cancelButtonColor: '#b91c1c', // red
				didOpen: (popup) => {
					// Add first empty row on open
					const rows = popup.querySelector('#av_rows');
					rows.appendChild(buildVariantRow());

					// Add-row button
					popup.querySelector('#av_add_row').addEventListener('click', () => {
						rows.appendChild(buildVariantRow());
					});

					// Row-level delegation for copy/remove
					rows.addEventListener('click', (e) => {
						const btn = e.target.closest('[data-action]');
						if (!btn) return;
						const action = btn.dataset.action;
						const row = btn.closest('.av_row');
						if (!row) return;

						if (action === 'remove') {
							row.remove();
						} else if (action === 'copy') {
							rows.appendChild(copyVariantRow(row));
						}
					});
				},
				preConfirm: () => {
					// Collect rows -> payload
					const payload = collectVariantRowsFromModal();
					if (!payload || (Array.isArray(payload.variants) && payload.variants.length === 0)) {
						Swal.showValidationMessage('Please add at least one valid variant (Variant Type, Variant Value, and Regular Price are required).');
						return false;
					}
					return payload;
				}
			}).then(async (res) => {
				if (!res.isConfirmed || !res.value) return;
				const body = res.value;

				// POST -> /products/{productId}/variants
				const url = `${BASE_URL}/products/${productId}/variants`;
				const postRes = await fetch(url, {
					method: 'POST',
					headers: {
						'Authorization': 'Bearer ' + authToken,
						'Content-Type': 'application/json'
					},
					body: JSON.stringify(body)
				});

				const text = await postRes.text();
				let out = null;
				try {
					out = JSON.parse(text);
				} catch {}

				if (!postRes.ok || !out?.success) {
					console.error('Add variants failed:', text);
					return Swal.fire('Error', (out?.message || 'Failed to add variant(s).'), 'error');
				}

				// Paint new variants into table
				// API may return a single object or data array — handle both
				let created = [];
				if (Array.isArray(out?.data)) created = out.data;
				else if (out?.data) created = [out.data];

				if (created.length === 0 && Array.isArray(out?.variants)) created = out.variants;

				created.forEach(v => addVariantRow(v)); // your existing painter

				Swal.fire({
					icon: 'success',
					title: 'Variant(s) Added',
					text: 'Successfully added.',
					confirmButtonColor: '#2563eb'
				});
			});
		}

		function buildVariantRow(seed = {}) {
			const row = document.createElement('div');
			row.className = 'av_row';
			row.style.cssText = `
            border:1px solid #e5e7eb;border-radius:10px;padding:12px;
            display:grid;gap:10px;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            align-items:end;background:#fafafa;
            `;

			row.innerHTML = `
            ${inputBox('Variant Type',      'variant_type',     seed.variant_type)}
            ${inputBox('Variant Value',     'variant_value',    seed.variant_value)}
            ${numberBox('Min Qty',          'min_qty',          seed.min_qty, 1)}
            ${selectBox('COD?',             'is_cod',           !!seed.is_cod)}
            ${numberBox('Weight (kg)',      'weight',           seed.weight, 0.01)}
            ${inputBox('Description',       'description',      seed.description)}
            ${numberBox('Regular ₹',        'regular_price',    seed.regular_price, 0.01)}
            ${numberBox('Discount ₹',       'discount_price',   seed.discount_price, 0.01)}
            ${numberBox('Customer Disc %',  'customer_discount',seed.customer_discount, 0.01)}
            ${numberBox('Dealer Disc %',    'dealer_discount',  seed.dealer_discount, 0.01)}
            ${numberBox('Architect Disc %', 'architect_discount',seed.architect_discount, 0.01)}
            ${inputBox('HSN',               'hsn',              seed.hsn)}
            ${numberBox('Reg. Tax %',       'regular_tax',      seed.regular_tax, 0.01)}
            ${numberBox('Sell. Tax %',      'selling_tax',      seed.selling_tax, 0.01)}
            ${inputBox('Video URL',         'video_url',        seed.video_url, 'url')}
            ${inputBox('Product PDF',       'product_pdf',      seed.product_pdf, 'url')}

            <div style="display:flex;gap:8px;justify-content:flex-end;">
            <button type="button" data-action="copy"
                style="background:#2563eb;color:#fff;border:none;border-radius:8px;padding:8px 12px;cursor:pointer;">Copy</button>
            <button type="button" data-action="remove"
                style="background:#b91c1c;color:#fff;border:none;border-radius:8px;padding:8px 12px;cursor:pointer;">×</button>
            </div>
        `;

			return row;

			function inputBox(label, name, value = '', type = 'text') {
				const v = value == null ? '' : value;
				return `
                <div style="display:flex;flex-direction:column;gap:4px;">
                    <label style="font-size:12px;font-weight:600;color:#334155;">${label}</label>
                    <input type="${type}" name="${name}" value="${escapeHtml(String(v))}" 
                        style="height:38px;border:1px solid #e5e7eb;border-radius:8px;padding:6px 10px;">
                </div>
                `;
			}

			function numberBox(label, name, value = '', step = 1) {
				const v = (value == null || value === '') ? '' : value;
				return `
                <div style="display:flex;flex-direction:column;gap:4px;">
                    <label style="font-size:12px;font-weight:600;color:#334155;">${label}</label>
                    <input type="number" name="${name}" value="${escapeHtml(String(v))}" step="${step}"
                        style="height:38px;border:1px solid #e5e7eb;border-radius:8px;padding:6px 10px;">
                </div>
            `;
			}

			function selectBox(label, name, boolVal = false) {
				const t = boolVal ? 'true' : 'false';
				return `
                <div style="display:flex;flex-direction:column;gap:4px;">
                    <label style="font-size:12px;font-weight:600;color:#334155;">${label}</label>
                    <select name="${name}" style="height:38px;border:1px solid #e5e7eb;border-radius:8px;padding:6px 10px;">
                    <option value="false" ${t === 'false' ? 'selected' : ''}>No</option>
                    <option value="true"  ${t === 'true'  ? 'selected' : ''}>Yes</option>
                    </select>
                </div>
            `;
			}

			function escapeHtml(s) {
				return s.replace(/[&<>"']/g, (m) => ({
					'&': '&amp;',
					'<': '&lt;',
					'>': '&gt;',
					'"': '&quot;',
					"'": '&#039;'
				} [m]));
			}
		}

		function copyVariantRow(srcRow) {
			const seed = getRowValues(srcRow);
			return buildVariantRow(seed);
		}

		function getRowValues(row) {
			const g = (name) => row.querySelector(`[name="${name}"]`)?.value ?? '';
			const toNum = (v) => {
				const n = Number(String(v).trim());
				return Number.isFinite(n) ? n : null;
			};
			return {
				variant_type: g('variant_type'),
				variant_value: g('variant_value'),
				min_qty: toNum(g('min_qty')),
				is_cod: g('is_cod') === 'true',
				weight: toNum(g('weight')),
				description: g('description') || null,
				regular_price: toNum(g('regular_price')),
				discount_price: toNum(g('discount_price')),
				customer_discount: toNum(g('customer_discount')),
				dealer_discount: toNum(g('dealer_discount')),
				architect_discount: toNum(g('architect_discount')),
				hsn: g('hsn') || null,
				regular_tax: toNum(g('regular_tax')),
				selling_tax: toNum(g('selling_tax')),
				video_url: (g('video_url') || '').trim() || null,
				product_pdf: (g('product_pdf') || '').trim() || null
			};
		}

		function collectVariantRowsFromModal() {
			const wrap = document.querySelector('.swal2-container #av_rows');
			if (!wrap) return null;

			const rows = Array.from(wrap.querySelectorAll('.av_row'));
			const clean = [];

			const required = (obj) =>
				(obj.variant_type && obj.variant_type.trim()) &&
				(obj.variant_value && obj.variant_value.trim()) &&
				(obj.regular_price !== null && obj.regular_price !== '' && !Number.isNaN(Number(obj.regular_price)));

			for (const row of rows) {
				const obj = getRowValues(row);

				// drop truly empty rows
				const hasAny = Object.values(obj).some(v => (v !== null && v !== '' && v !== false && v !== 0));
				if (!hasAny) continue;

				if (!required(obj)) {
					// Highlight invalid row and block submit
					row.style.outline = '2px solid #b91c1c';
					return null;
				} else {
					row.style.outline = 'none';
				}

				clean.push(obj);
			}

			if (clean.length === 0) return null;

			// API accepts single object OR { variants: [...] }
			if (clean.length === 1) return clean[0];
			return {
				variants: clean
			};
		}

		function addVariantRow(data = {}) {
			const tr = document.createElement('tr');
			if (data?.id) tr.dataset.variantId = data.id;

			tr.innerHTML = `
                <input type="hidden" class="v_variant_id" value="${data.id ?? ''}">
                <td>
                    <input type="file" class="input v_banners" multiple accept="image/*,application/pdf,video/*">
                    <button type="button" class="btn btn-sm btn-light mt-2 upload_banners_btn">Upload Banners</button>
                    <div class="text-2xs text-gray-500 mt-1">Select one or more (images/video/pdf)</div>
                </td>
                <td>
                    <div class="banner-thumbnails" style="display:flex;gap:10px;flex-wrap:wrap;"></div>
                </td>
                <td>
                    <input type="file" class="input v_photos" multiple accept="image/*">
                    <button type="button" class="btn btn-sm btn-light mt-2 upload_photos_btn">Upload Photos</button>
                    <div class="text-2xs text-gray-500 mt-1">Select one or more images</div>
                </td>
                <td>
                    <div class="photo-thumbnails" style="display:flex;gap:10px;flex-wrap:wrap;"></div>
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
                <td><input type="number" step="0.01" min="0" max="100" class="input v_customer_discount" placeholder="" value="${data.customer_discount ?? ''}"></td>
                <td><input type="number" step="0.01" min="0" max="100" class="input v_dealer_discount" placeholder="" value="${data.dealer_discount ?? ''}"></td>
                <td><input type="number" step="0.01" min="0" max="100" class="input v_architect_discount" placeholder="" value="${data.architect_discount ?? ''}"></td>
                <td><input type="text" class="input v_hsn" placeholder="" value="${data.hsn ?? ''}"></td>
                <td><input type="number" step="0.01" class="input v_regular_tax" placeholder="" value="${data.regular_tax ?? ''}"></td>
                <td><input type="number" step="0.01" class="input v_selling_tax" placeholder="" value="${data.selling_tax ?? ''}"></td>
                <td><input type="url" class="input v_video_url" placeholder="" value="${data.video_url ?? ''}"></td>
                <td><input type="url" class="input v_product_pdf" placeholder="" value="${data.product_pdf ?? ''}"></td>
                <td><button type="button" class="btn btn-sm btn-light danger remove_variant">Remove</button></td>
            `;
			q('#variants_body').appendChild(tr);
			// tr.querySelector('.remove_variant').addEventListener('click', () => tr.remove());
			return tr;
		}
		async function deleteVariantById(variantId) {
			const url = `${BASE_URL}/products/variants/${variantId}`;
			const res = await fetch(url, {
				method: 'DELETE',
				headers: {
					'Authorization': 'Bearer ' + authToken
				}
			});

			const text = await res.text();
			let out = null;
			try {
				out = JSON.parse(text);
			} catch {}

			if (!res.ok) {
				throw new Error(out?.message || `Variant delete failed: ${res.status} ${text}`);
			}
			return out; // { message: "...", variant_id: 30 }
		}


		const mapBannerResp = (arr = []) => arr.map(x => ({
			id: x.id,
			url: x.file_path
		}));
		const mapPhotoResp = (arr = []) => arr.map(x => ({
			id: x.id,
			url: x.file_path
		}));

		async function handleUploadFiles(inputElement, url, variantId, rowEl, kind /* 'banners' | 'photos' */ ) {
			if (!inputElement?.files?.length) {
				return (window.Swal ?
					Swal.fire('No files', `Please choose ${kind} files first.`, 'info') :
					alert(`Please choose ${kind} files first.`));
			}

			const fd = new FormData();
			[...inputElement.files].forEach(f => fd.append(kind === 'banners' ? 'banners[]' : 'photos[]', f));

			const res = await postFiles(url, fd); // uses the FIRST postFiles
			if (!res.ok || !res.json) {
				console.error(`${kind} upload failed:`, res.json || res.text);
				return (window.Swal ?
					Swal.fire('Error', `${kind[0].toUpperCase()+kind.slice(1)} upload failed.`, 'error') :
					alert(`${kind} upload failed.`));
			}

			// API’s full list after upload:
			if (kind === 'banners') {
				const banners = mapBannerResp(res.json.all_banner_ids || []);
				displayBannerThumbnails(banners, rowEl, Number(variantId));
			} else {
				const photos = mapPhotoResp(res.json.all_photo_ids || []);
				displayPhotoThumbnails(photos, rowEl, Number(variantId));
			}

			inputElement.value = ''; // clear the chooser

			if (window.Swal) Swal.fire('Uploaded', `${kind[0].toUpperCase()+kind.slice(1)} uploaded successfully.`, 'success');
			else alert(`${kind} uploaded successfully`);
		}
		async function uploadBannersForRow(tr) {
			const variantId = tr.dataset.variantId;
			if (!variantId) {
				console.warn('No variantId on row; cannot upload banners');
				return Swal?.fire('Error', 'Variant ID missing on this row.', 'error') ?? alert('Variant ID missing on this row.');
			}
			const input = tr.querySelector('.v_banners');
			if (!input?.files?.length) {
				return Swal?.fire('No files', 'Please choose banner files first.', 'info') ?? alert('Please choose banner files first.');
			}

			const fd = new FormData();
			[...input.files].forEach(f => fd.append('banners[]', f));

			const res = await postFiles(`${BASE_URL}/products/${variantId}/banners`, fd);
			if (!res.ok || !res.json) {
				console.error('Banner upload failed:', res.json || res.text);
				return Swal?.fire('Error', 'Banner upload failed.', 'error') ?? alert('Banner upload failed.');
			}

			// Refresh thumbnails from all_banner_ids
			const banners = mapBannerResp(res.json.all_banner_ids || []);
			displayBannerThumbnails(banners, tr, Number(variantId));
			input.value = ''; // clear input
			Swal?.fire('Uploaded', 'Banners uploaded successfully.', 'success');
		}
		async function uploadPhotosForRow(tr) {
			const variantId = tr.dataset.variantId;
			if (!variantId) {
				console.warn('No variantId on row; cannot upload photos');
				return Swal?.fire('Error', 'Variant ID missing on this row.', 'error') ?? alert('Variant ID missing on this row.');
			}
			const input = tr.querySelector('.v_photos');
			if (!input?.files?.length) {
				return Swal?.fire('No files', 'Please choose photo files first.', 'info') ?? alert('Please choose photo files first.');
			}

			const fd = new FormData();
			[...input.files].forEach(f => fd.append('photos[]', f));

			const res = await postFiles(`${BASE_URL}/products/${variantId}/photos`, fd);
			if (!res.ok || !res.json) {
				console.error('Photo upload failed:', res.json || res.text);
				return Swal?.fire('Error', 'Photo upload failed.', 'error') ?? alert('Photo upload failed.');
			}

			// Refresh thumbnails from all_photo_ids
			const photos = mapPhotoResp(res.json.all_photo_ids || []);
			displayPhotoThumbnails(photos, tr, Number(variantId));
			input.value = ''; // clear input
			Swal?.fire('Uploaded', 'Photos uploaded successfully.', 'success');
		}
		
        // Attach event listeners to the upload buttons
		// document.querySelector('#variants_body').addEventListener('click', async function (e) {
		//     const target = e.target;
		//     if (!target) return;

		//     const tr = target.closest('tr');
		//     if (!tr) return;

		//     const variantIdRaw = tr.dataset.variantId || tr.querySelector('.v_variant_id')?.value || '';
		//     const variantId = variantIdRaw ? Number(variantIdRaw) : null;
		//     // const variantId = tr.dataset.variantId || tr.querySelector('.v_variant_id')?.value;
		//     // if (!variantId) return;

		//     if (target.classList.contains('upload_banners_btn')) {
		//         if (!variantId) {
		//             return Swal?.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload banners.', 'info')
		//                 ?? alert('Save the product first so this variant gets an ID, then upload banners.');
		//         }
		//         const input = tr.querySelector('.v_banners');
		//         await handleUploadFiles(input, `${BASE_URL}/products/${variantId}/banners`, variantId, tr, 'banners');
		//     }
		//     if (target.classList.contains('upload_photos_btn')) {
		//         if (!variantId) {
		//             return Swal?.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload photos.', 'info')
		//                     ?? alert('Save the product first so this variant gets an ID, then upload photos.');
		//         }
		//         const input = tr.querySelector('.v_photos');
		//         await handleUploadFiles(input, `${BASE_URL}/products/${variantId}/photos`, variantId, tr, 'photos');

		//         // REMOVE VARIANT (table row "Remove" button)
		//         if (target.classList.contains('remove_variant')) {
		//             // If the row is not yet persisted (no ID), remove immediately
		//             if (!variantId) {
		//             tr.remove();
		//             return;
		//             }

		//             // Confirm delete
		//             const ok = await (window.Swal
		//             ? Swal.fire({
		//                 title: 'Delete this variant?',
		//                 text: 'This will remove the variant and its associated images.',
		//                 icon: 'warning',
		//                 showCancelButton: true,
		//                 confirmButtonText: 'Yes, delete',
		//                 cancelButtonText: 'Cancel',
		//                 confirmButtonColor: '#b91c1c'
		//                 })
		//             : Promise.resolve({ isConfirmed: confirm('Delete this variant and associated images?') })
		//             );

		//             if (!ok?.isConfirmed) return;

		//             // Disable the button to prevent double clicks
		//             const prevHTML = target.innerHTML;
		//             target.disabled = true;
		//             target.innerHTML = 'Deleting...';

		//             try {
		//             const out = await deleteVariantById(variantId);
		//             // Remove row from UI
		//             tr.remove();

		//             // Success alert
		//             if (window.Swal) {
		//                 Swal.fire({
		//                 icon: 'success',
		//                 title: 'Deleted',
		//                 text: out?.message || 'Variant deleted successfully.',
		//                 confirmButtonColor: '#2563eb'
		//                 });
		//             } else {
		//                 alert(out?.message || 'Variant deleted successfully.');
		//             }
		//             } catch (err) {
		//             console.error(err);
		//             if (window.Swal) {
		//                 Swal.fire('Error', err.message || 'Failed to delete variant.', 'error');
		//             } else {
		//                 alert(err.message || 'Failed to delete variant.');
		//             }
		//             // Re-enable button on error
		//             target.disabled = false;
		//             target.innerHTML = prevHTML;
		//             }
		//         }
		//     }
		// });

		document.querySelector('#variants_body').addEventListener('click', async function(e) {
			const target = e.target;
			if (!target) return;

			const tr = target.closest('tr');
			if (!tr) return;

			const variantIdRaw = tr.dataset.variantId || tr.querySelector('.v_variant_id')?.value || '';
			const variantId = variantIdRaw ? Number(variantIdRaw) : null;

			// 1) Upload banners
			if (target.classList.contains('upload_banners_btn')) {
				if (!variantId) {
					return (window.Swal ?
						Swal.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload banners.', 'info') :
						alert('Save the product first so this variant gets an ID, then upload banners.'));
				}
				const input = tr.querySelector('.v_banners');
				return await handleUploadFiles(input, `${BASE_URL}/products/${variantId}/banners`, variantId, tr, 'banners');
			}

			// 2) Upload photos
			if (target.classList.contains('upload_photos_btn')) {
				if (!variantId) {
					return (window.Swal ?
						Swal.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload photos.', 'info') :
						alert('Save the product first so this variant gets an ID, then upload photos.'));
				}
				const input = tr.querySelector('.v_photos');
				return await handleUploadFiles(input, `${BASE_URL}/products/${variantId}/photos`, variantId, tr, 'photos');
			}

			// 3) Remove variant (separate branch — not nested)
			if (target.classList.contains('remove_variant')) {
				// If never saved, just remove locally
				if (!variantId) {
					tr.remove();
					return;
				}

				const ok = await (window.Swal ?
					Swal.fire({
						title: 'Delete this variant?',
						text: 'This will remove the variant and its associated images.',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Yes, delete',
						cancelButtonText: 'Cancel',
						confirmButtonColor: '#b91c1c'
					}) :
					Promise.resolve({
						isConfirmed: confirm('Delete this variant and associated images?')
					})
				);
				if (!ok?.isConfirmed) return;

				const prevHTML = target.innerHTML;
				target.disabled = true;
				target.innerHTML = 'Deleting...';

				try {
					const out = await deleteVariantById(variantId);
					tr.remove();
					if (window.Swal) {
						Swal.fire({
							icon: 'success',
							title: 'Deleted',
							text: out?.message || 'Variant deleted successfully.',
							confirmButtonColor: '#2563eb'
						});
					} else {
						alert(out?.message || 'Variant deleted successfully.');
					}
				} catch (err) {
					console.error(err);
					if (window.Swal) Swal.fire('Error', err.message || 'Failed to delete variant.', 'error');
					else alert(err.message || 'Failed to delete variant.');
					target.disabled = false;
					target.innerHTML = prevHTML;
				}
			}
		});

		function displayPhotoThumbnails(photoObjs, row, variantId) {
			const photoContainer = row.querySelector('.photo-thumbnails');
			photoContainer.innerHTML = '';

			photoObjs.forEach(({
				id: photoId,
				url: photoUrl
			}) => {
				const container = document.createElement('div');
				container.style.position = 'relative';
				container.style.display = 'inline-block';
				container.style.marginRight = '10px';

				const img = document.createElement('img');
				img.src = photoUrl;
				img.alt = 'variant photo';
				img.loading = 'lazy';
				img.style.width = '50px';
				img.style.height = '50px';
				img.style.objectFit = 'contain';
				img.style.padding = '10px';
				img.style.cursor = 'pointer';

				img.addEventListener('click', () => {
					Swal.fire({
						imageUrl: photoUrl,
						imageAlt: 'Image',
						confirmButtonText: 'Close'
					});
				});

				// Delete button (wired in Step 2)
				const deleteBtn = document.createElement('button');
				deleteBtn.innerText = 'X';
				deleteBtn.style.position = 'absolute';
				deleteBtn.style.top = '0';
				deleteBtn.style.right = '0';
				deleteBtn.style.fontSize = '12px';
				deleteBtn.style.backgroundColor = 'rgba(255, 0, 0, 0.7)';
				deleteBtn.style.color = '#fff';
				deleteBtn.style.border = 'none';
				deleteBtn.style.borderRadius = '50%';
				deleteBtn.style.cursor = 'pointer';

				// hold data for Step 2
				deleteBtn.dataset.variantId = variantId;
				deleteBtn.dataset.photoId = photoId;

				deleteBtn.addEventListener('click', async (e) => {
					e.stopPropagation();
					const confirmDelete = await Swal.fire({
						title: 'Are you sure?',
						text: 'Do you want to delete this image?',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Yes, delete it!',
						cancelButtonText: 'No, keep it'
					});
					if (!confirmDelete.isConfirmed) return;

					const vId = deleteBtn.dataset.variantId;
					const pId = deleteBtn.dataset.photoId;

					try {
						await deletePhotoById(vId, pId);
						Swal.fire('Deleted!', 'The image has been deleted.', 'success');
						photoContainer.removeChild(container);
					} catch (err) {
						console.error(err);
						Swal.fire('Error', 'Failed to delete image.', 'error');
					}
				});

				container.appendChild(img);
				container.appendChild(deleteBtn);
				photoContainer.appendChild(container);
			});
		}

		function displayBannerThumbnails(bannerObjs, row, variantId) {
			const bannerContainer = row.querySelector('.banner-thumbnails');
			bannerContainer.innerHTML = '';

			bannerObjs.forEach(({
				id: bannerId,
				url: bannerUrl
			}) => {
				const container = document.createElement('div');
				container.style.position = 'relative';
				container.style.display = 'inline-block';
				container.style.marginRight = '10px';

				const img = document.createElement('img');
				img.src = bannerUrl;
				img.alt = 'variant banner';
				img.loading = 'lazy';
				img.style.width = '50px';
				img.style.height = '50px';
				img.style.objectFit = 'contain';
				img.style.padding = '10px';
				img.style.cursor = 'pointer';

				img.addEventListener('click', () => {
					Swal.fire({
						imageUrl: bannerUrl,
						imageAlt: 'Banner',
						confirmButtonText: 'Close'
					});
				});

				// Delete button (wired in Step 2)
				const deleteBtn = document.createElement('button');
				deleteBtn.innerText = 'X';
				deleteBtn.style.position = 'absolute';
				deleteBtn.style.top = '0';
				deleteBtn.style.right = '0';
				deleteBtn.style.fontSize = '12px';
				deleteBtn.style.backgroundColor = 'rgba(255, 0, 0, 0.7)';
				deleteBtn.style.color = '#fff';
				deleteBtn.style.border = 'none';
				deleteBtn.style.borderRadius = '50%';
				deleteBtn.style.cursor = 'pointer';

				deleteBtn.addEventListener('click', async (e) => {
					e.stopPropagation();
					const confirmDelete = await Swal.fire({
						title: 'Are you sure?',
						text: 'Do you want to delete this banner?',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: 'Yes, delete it!',
						cancelButtonText: 'No, keep it'
					});
					if (!confirmDelete.isConfirmed) return;

					const vId = deleteBtn.dataset.variantId;
					const bId = deleteBtn.dataset.bannerId;

					try {
						await deleteBannerById(vId, bId);
						Swal.fire('Deleted!', 'The banner has been deleted.', 'success');
						bannerContainer.removeChild(container);
					} catch (err) {
						console.error(err);
						Swal.fire('Error', 'Failed to delete banner.', 'error');
					}
				});

				// hold data for Step 2
				deleteBtn.dataset.variantId = variantId;
				deleteBtn.dataset.bannerId = bannerId;

				container.appendChild(img);
				container.appendChild(deleteBtn);
				bannerContainer.appendChild(container);
			});
		}
		async function deletePhotoById(variantId, photoId) {
			const url = `${BASE_URL}/products/variants/${variantId}/photos/${photoId}`;
			const res = await fetch(url, {
				method: 'DELETE',
				headers: {
					'Authorization': 'Bearer ' + authToken
				}
			});
			if (!res.ok) {
				const text = await res.text().catch(() => '');
				throw new Error(`Photo delete failed: ${res.status} ${text}`);
			}
		}
		async function deleteBannerById(variantId, bannerId) {
			// Using your requested path (photos) for banners as well:
			const url = `${BASE_URL}/products/variants/${variantId}/banners/${bannerId}`;
			const res = await fetch(url, {
				method: 'DELETE',
				headers: {
					'Authorization': 'Bearer ' + authToken
				}
			});
			if (!res.ok) {
				const text = await res.text().catch(() => '');
				throw new Error(`Banner delete failed: ${res.status} ${text}`);
			}
		}

		// ===== SUBMIT =====
		q('#update_product').addEventListener('click', async function() {
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
				const idEl = tr.querySelector('.feature_id');
				const feature_id = idEl && idEl.value ? Number(idEl.value) : null;

				const feature_name = tr.querySelector('.feature_name')?.value.trim() || '';
				const feature_value = tr.querySelector('.feature_value')?.value.trim() || '';
				const is_filterable = toBoolVal(tr.querySelector('.feature_filterable'));
				if (!feature_name || !feature_value) return null;

				const obj = {
					feature_name,
					feature_value,
					is_filterable
				};
				if (feature_id) obj.id = feature_id;
				return obj;
			}).filter(Boolean);

			// Build variants JSON + keep DOM rows we will send (to align files later)
			const variantRows = [];
			const variants = qa('#variants_body tr').map(tr => {
				const variant_id = (tr.querySelector('.v_variant_id')?.value || '').trim();
				const min_qty = parseNum(tr.querySelector('.v_min_qty')?.value);
				const is_cod = toBoolVal(tr.querySelector('.v_is_cod'));
				const weight = parseNum(tr.querySelector('.v_weight')?.value);
				const desc = tr.querySelector('.v_description')?.value.trim() || null;
				const variant_type = tr.querySelector('.v_variant_type')?.value.trim() || null;
				const variant_value = tr.querySelector('.v_variant_value')?.value.trim() || null;
				const regular_price = parseNum(tr.querySelector('.v_regular_price')?.value);
				// const selling_price = parseNum(tr.querySelector('.v_selling_price')?.value);
				// const sales_price_vendor = parseNum(tr.querySelector('.v_sales_price_vendor')?.value);
				const hsn = tr.querySelector('.v_hsn')?.value.trim() || null;
				const regular_tax = parseNum(tr.querySelector('.v_regular_tax')?.value);
				const selling_tax = parseNum(tr.querySelector('.v_selling_tax')?.value);
				const video_url = tr.querySelector('.v_video_url')?.value.trim() || null;
				const product_pdf = tr.querySelector('.v_product_pdf')?.value.trim() || null;
				// NEW (keeps 0 as valid):
				const customer_discount = parseNum(tr.querySelector('.v_customer_discount')?.value) ?? null;
				const dealer_discount = parseNum(tr.querySelector('.v_dealer_discount')?.value) ?? null;
				const architect_discount = parseNum(tr.querySelector('.v_architect_discount')?.value) ?? null;


				if (!variant_type || !variant_value) return null; // ignore empty rows

				const obj = {
					min_qty,
					is_cod,
					weight,
					description: desc,
					variant_type,
					variant_value,
					regular_price,
					customer_discount,
					dealer_discount,
					architect_discount,
					hsn,
					regular_tax,
					selling_tax,
					video_url,
					product_pdf
				};

				if (variant_id) obj.id = Number(variant_id); // <— include id if present

				variantRows.push(tr); // keep same order as we push into variants[]
				return obj;
			}).filter(Boolean);

			const payload = {
				name,
				brand_id,
				category_id,
				slug,
				description,
				is_active,
				features,
				variants
			};

			// STEP 1: Update product
			// const updateRes = await postJSON(`${BASE_URL}/products/${productId}`, payload);
			// if (!updateRes.ok) {
			//     console.error('Update error:', updateRes.json || updateRes.text);
			//     return alert((updateRes.json && (updateRes.json.message || updateRes.json.error)) || 'Error updating product.');
			// }

			// const updated = updateRes.json || {};
			// // Try to get updated variants with IDs
			// let updatedVariants = findCreatedVariants(updated);

			const updateRes = await postJSON(`${BASE_URL}/products/${productId}`, payload);
			if (!updateRes.ok) {
				console.error('Update error:', updateRes.json || updateRes.text);
				return alert((updateRes.json && (updateRes.json.message || updateRes.json.error)) || 'Error updating product.');
			}

			const updated = updateRes.json || {};
			const updatedProduct = updated.data;

			// paint the latest product immediately (if API returned it)
			if (updatedProduct) {
				populateProductUI(updatedProduct);
			}
			// use variants from response to map uploads to ids
			let updatedVariants = Array.isArray(updatedProduct?.variants) ? updatedProduct.variants : [];


			// Fallback: sometimes API returns product object directly with same order
			if ((!updatedVariants || updatedVariants.length === 0) && Array.isArray(updated?.data)) {
				updatedVariants = updated.data.filter(v => v && v.id != null);
			}

			// If still no variant ids, try to map by order via another known path
			if ((!updatedVariants || updatedVariants.length === 0) && Array.isArray(updated?.product?.variants)) {
				updatedVariants = updated.product.variants.filter(v => v && v.id != null);
			}

			// if (!Array.isArray(updatedVariants) || updatedVariants.length !== variants.length) {
			//     console.warn('Could not reliably map variant IDs from API response. Proceeding without uploads.', updated);
			//     if (window.Swal) {
			//         return Swal.fire({
			//             title: 'Product Updated',
			//             text: 'Product updated, but variant IDs were not returned as expected—skipping file uploads.',
			//             icon: 'warning',
			//             confirmButtonText: 'OK'
			//         }).then(() => location.href = 'pages/show_products.php');
			//     } else {
			//         alert('Product updated, but variant IDs not returned as expected—skipping file uploads.');
			//         return location.href = 'pages/show_products.php';
			//     }
			// }

			if (!Array.isArray(updatedVariants) || updatedVariants.length !== variants.length) {
				console.warn('Could not map variant IDs; skipping file uploads.', updated);
				if (window.Swal) {
					return Swal.fire({
						title: 'Product Updated',
						text: 'Updated successfully. Files not uploaded because variant IDs were not returned as expected.',
						icon: 'warning',
						confirmButtonText: 'OK'
					});
				} else {
					alert('Updated successfully. Files not uploaded because variant IDs were not returned as expected.');
					return;
				}
			}


			// STEP 2 & 3: For each variant, upload photos then banners (if any)
			const uploadPromises = updatedVariants.map(async (cv, i) => {
				const tr = variantRows[i];
				const vid = cv.id;

				// Collect chosen files
				const photosInput = tr.querySelector('.v_photos');
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
						title: 'Product Updated',
						text: 'Some file uploads failed. Check console for details.',
						icon: 'warning',
						confirmButtonText: 'OK'
					});
				} else {
					alert('Product updated, but some file uploads failed. Check console.');
					return;
				}
			}

			// All good
			if (window.Swal) {
				Swal.fire({
					title: 'Success!',
					text: 'Product updated successfully.',
					icon: 'success',
					confirmButtonText: 'OK'
				});
			} else {
				alert('Product updated successfully.');
			}

		});

		populateProductForm(productId);
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
    #variants_table { table-layout: fixed; min-width: 1850px; }
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
