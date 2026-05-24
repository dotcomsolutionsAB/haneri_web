<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php 
    $current_page = "Edit Product";
?>
<?php include("header1.php"); ?>

<main class="grow content pt-5 product-edit-page" id="content" role="content">
    <div class="container-fixed">
        <div class="product-edit-topbar">
            <div class="product-edit-topbar__info">
                <div class="product-edit-topbar__eyebrow">Product Management</div>
                <h1 class="product-edit-topbar__title">Edit Product</h1>
                <p class="product-edit-topbar__subtitle">Update details, features, pricing, media, and 3D assets for each variant.</p>
            </div>
            <div class="product-edit-topbar__actions">
                <span class="product-id-badge" id="product_id_badge">#—</span>
                <a class="btn btn-sm btn-light" href="pages/show_products.php">Back to Products</a>
            </div>
        </div>
    </div>

    <div class="container-fixed product-edit-shell">
        <section class="card product-section-card">
            <div class="card-header" id="basic_settings">
                <div>
                    <h3 class="card-title">General Information</h3>
                    <p class="section-subtitle">Core product metadata shown across the storefront.</p>
                </div>
            </div>
            <div class="card-body product-form-grid">
                <div class="form-field">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input class="input" type="text" id="product_name" placeholder="Enter product name">
                </div>
                <div class="form-field">
                    <label for="slug" class="form-label">Slug</label>
                    <input class="input" type="text" id="slug" placeholder="product-url-slug">
                </div>
                <div class="form-field">
                    <label for="brand" class="form-label">Brand</label>
                    <select class="select" id="brand">
                        <option value="">Select brand</option>
                        <option value="1">Haneri</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="category" class="form-label">Category</label>
                    <select class="select" id="category">
                        <option value="">Select category</option>
                        <option value="1">CEILING FAN</option>
                        <option value="2">TABLE WALL PEDESTALS</option>
                        <option value="3">DOMESTIC EXHAUSTS</option>
                        <option value="4">PERSONAL</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="is_active" class="form-label">Published</label>
                    <select class="select" id="is_active">
                        <option value="true">Yes</option>
                        <option value="false" selected>No</option>
                    </select>
                </div>
                <div class="form-field form-field--full">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="note-codable text-edit" id="description" aria-multiline="true" placeholder="Product description"></textarea>
                </div>
            </div>
        </section>

        <section class="card product-section-card">
            <div class="card-header" id="features">
                <div>
                    <h3 class="card-title">Features</h3>
                    <p class="section-subtitle">Highlight specifications and filterable attributes.</p>
                </div>
                <button id="add_feature" class="btn btn-sm btn-primary">+ Add Feature</button>
            </div>
            <div class="card-body">
                <div class="table-wrap">
                    <table class="table table-bordered w-full" id="features_table">
                        <thead>
                            <tr>
                                <th style="width: 28%">Feature Name</th>
                                <th>Feature Value</th>
                                <th style="width: 16%">Filterable</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="features_body"></tbody>
                    </table>
                </div>
                <p class="section-hint">Only completed feature rows are saved.</p>
            </div>
        </section>

        <section class="card product-section-card" id="variants">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Variants</h3>
                    <p class="section-subtitle">Configure pricing, inventory, media, 3D files, and links per variant.</p>
                </div>
                <button id="add_variant" class="btn btn-sm btn-primary">+ Add Variant</button>
            </div>
            <div class="card-body">
                <div id="variants_body" class="variants-stack"></div>
                <p class="section-hint">Save the product before uploading media for newly added variants.</p>
            </div>
        </section>

        <div class="product-edit-footer">
            <div class="product-edit-footer__note">Changes apply after you save the product.</div>
            <button class="btn btn-primary" id="update_product">Save Product</button>
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

		const esc = (s) => String(s ?? '').replace(/[&<>"']/g, (m) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]));

		function refreshVariantCardSummary(card) {
			const type = card.querySelector('.v_variant_type')?.value.trim() || '';
			const value = card.querySelector('.v_variant_value')?.value.trim() || '';
			const summary = card.querySelector('.variant-card__summary');
			if (summary) {
				summary.textContent = (type && value) ? `${type} · ${value}` : (type || value || 'Not configured');
			}
		}

		function renumberVariantCards() {
			qa('#variants_body .variant-card').forEach((card, i) => {
				const badge = card.querySelector('.variant-card__index');
				if (badge) badge.textContent = `Variant ${i + 1}`;
			});
		}

		const badgeEl = q('#product_id_badge');
		if (badgeEl && productId) badgeEl.textContent = `#${productId}`;

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
					'Authorization': 'Bearer ' + authToken,
					'Accept': 'application/json',
					'X-Requested-With': 'XMLHttpRequest'
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
				if (v['3d_file']) display3dFilePreview(v['3d_file'], rowEl, v.id);
				if (v['3d_placeholder']) display3dPlaceholderPreview(v['3d_placeholder'], rowEl, v.id);
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
			const card = document.createElement('div');
			card.className = 'variant-card';
			if (data?.id) card.dataset.variantId = data.id;

			const summaryText = (data.variant_type && data.variant_value)
				? `${data.variant_type} · ${data.variant_value}`
				: (data.variant_type || data.variant_value || 'Not configured');

			card.innerHTML = `
				<input type="hidden" class="v_variant_id" value="${data.id ?? ''}">
				<div class="variant-card__header">
					<div class="variant-card__heading">
						<span class="variant-card__index">Variant</span>
						<span class="variant-card__summary">${esc(summaryText)}</span>
					</div>
					<div class="variant-card__toolbar">
						<button type="button" class="btn btn-sm btn-light toggle_variant_btn" title="Collapse/expand" aria-label="Toggle variant section">▾</button>
						<button type="button" class="btn btn-sm btn-light danger remove_variant">Remove</button>
					</div>
				</div>
				<div class="variant-card__body">
					<div class="variant-section">
						<div class="variant-section__title">Identity</div>
						<div class="variant-grid variant-grid--2">
							<div class="form-field"><label class="form-label">Variant Type</label><input type="text" class="input v_variant_type" value="${esc(data.variant_type ?? '')}" placeholder="e.g. Color"></div>
							<div class="form-field"><label class="form-label">Variant Value</label><input type="text" class="input v_variant_value" value="${esc(data.variant_value ?? '')}" placeholder="e.g. White"></div>
						</div>
						<div class="form-field" style="margin-top:.75rem"><label class="form-label">Description</label><input type="text" class="input v_description" value="${esc(data.description ?? '')}" placeholder="Optional variant description"></div>
					</div>
					<div class="variant-section">
						<div class="variant-section__title">Pricing & Tax</div>
						<div class="variant-grid variant-grid--4">
							<div class="form-field"><label class="form-label">Regular Price (₹)</label><input type="number" step="0.01" class="input v_regular_price" value="${data.regular_price ?? ''}"></div>
							<div class="form-field"><label class="form-label">Customer Disc %</label><input type="number" step="0.01" min="0" max="100" class="input v_customer_discount" value="${data.customer_discount ?? ''}"></div>
							<div class="form-field"><label class="form-label">Dealer Disc %</label><input type="number" step="0.01" min="0" max="100" class="input v_dealer_discount" value="${data.dealer_discount ?? ''}"></div>
							<div class="form-field"><label class="form-label">Architect Disc %</label><input type="number" step="0.01" min="0" max="100" class="input v_architect_discount" value="${data.architect_discount ?? ''}"></div>
							<div class="form-field"><label class="form-label">HSN</label><input type="text" class="input v_hsn" value="${esc(data.hsn ?? '')}"></div>
							<div class="form-field"><label class="form-label">Reg. Tax %</label><input type="number" step="0.01" class="input v_regular_tax" value="${data.regular_tax ?? ''}"></div>
							<div class="form-field"><label class="form-label">Sell. Tax %</label><input type="number" step="0.01" class="input v_selling_tax" value="${data.selling_tax ?? ''}"></div>
						</div>
					</div>
					<div class="variant-section">
						<div class="variant-section__title">Inventory</div>
						<div class="variant-grid variant-grid--3">
							<div class="form-field"><label class="form-label">Min Qty</label><input type="number" step="1" min="1" class="input v_min_qty" value="${data.min_qty ?? ''}"></div>
							<div class="form-field"><label class="form-label">Weight (kg)</label><input type="number" step="0.01" class="input v_weight" value="${data.weight ?? ''}"></div>
							<div class="form-field"><label class="form-label">COD Available</label>
								<select class="select v_is_cod">
									<option value="true" ${data.is_cod ? 'selected' : ''}>Yes</option>
									<option value="false" ${!data.is_cod ? 'selected' : ''}>No</option>
								</select>
							</div>
						</div>
					</div>
					<div class="variant-section">
						<div class="variant-section__title">Media</div>
						<div class="variant-media-grid">
							<div class="upload-panel">
								<div class="upload-panel__head"><span>Photos</span><button type="button" class="btn btn-sm btn-light upload_photos_btn">Upload</button></div>
								<input type="file" class="input v_photos" multiple accept="image/*">
								<div class="photo-thumbnails media-thumbs"></div>
							</div>
							<div class="upload-panel">
								<div class="upload-panel__head"><span>Banners</span><button type="button" class="btn btn-sm btn-light upload_banners_btn">Upload</button></div>
								<input type="file" class="input v_banners" multiple accept="image/*,application/pdf,video/*">
								<div class="banner-thumbnails media-thumbs"></div>
							</div>
						</div>
					</div>
					<div class="variant-section">
						<div class="variant-section__title">3D Assets</div>
						<div class="variant-media-grid">
							<div class="upload-panel">
								<div class="upload-panel__head"><span>3D Model (.glb)</span><button type="button" class="btn btn-sm btn-light upload_3d_file_btn">Upload</button></div>
								<input type="file" class="input v_3d_file" accept=".glb,model/gltf-binary">
								<div class="three-d-file-preview media-thumbs"></div>
							</div>
							<div class="upload-panel">
								<div class="upload-panel__head"><span>Placeholder Image</span><button type="button" class="btn btn-sm btn-light upload_3d_placeholder_btn">Upload</button></div>
								<input type="file" class="input v_3d_placeholder" accept=".png,.webp,.jpg,.jpeg,image/png,image/webp,image/jpeg">
								<div class="three-d-placeholder-preview media-thumbs"></div>
							</div>
						</div>
					</div>
					<div class="variant-section">
						<div class="variant-section__title">Links</div>
						<div class="variant-grid variant-grid--2">
							<div class="form-field"><label class="form-label">Video URL</label><input type="url" class="input v_video_url" value="${esc(data.video_url ?? '')}" placeholder="https://"></div>
							<div class="form-field"><label class="form-label">Product PDF</label><input type="url" class="input v_product_pdf" value="${esc(data.product_pdf ?? '')}" placeholder="https://"></div>
						</div>
					</div>
				</div>
			`;


			q('#variants_body').appendChild(card);
			renumberVariantCards();
			refreshVariantCardSummary(card);
			return card;
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
		async function uploadBannersForRow(card) {
			const variantId = card.dataset.variantId;
			if (!variantId) {
				console.warn('No variantId on row; cannot upload banners');
				return Swal?.fire('Error', 'Variant ID missing on this row.', 'error') ?? alert('Variant ID missing on this row.');
			}
			const input = card.querySelector('.v_banners');
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
			displayBannerThumbnails(banners, card, Number(variantId));
			input.value = ''; // clear input
			Swal?.fire('Uploaded', 'Banners uploaded successfully.', 'success');
		}
		async function uploadPhotosForRow(card) {
			const variantId = card.dataset.variantId;
			if (!variantId) {
				console.warn('No variantId on row; cannot upload photos');
				return Swal?.fire('Error', 'Variant ID missing on this row.', 'error') ?? alert('Variant ID missing on this row.');
			}
			const input = card.querySelector('.v_photos');
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
			displayPhotoThumbnails(photos, card, Number(variantId));
			input.value = ''; // clear input
			Swal?.fire('Uploaded', 'Photos uploaded successfully.', 'success');
		}

		async function upload3dFileForRow(card) {
			const variantId = card.dataset.variantId;
			if (!variantId) {
				return Swal?.fire('Error', 'Variant ID missing on this row.', 'error') ?? alert('Variant ID missing on this row.');
			}
			const input = card.querySelector('.v_3d_file');
			if (!input?.files?.length) {
				return Swal?.fire('No file', 'Please choose a .glb file first.', 'info') ?? alert('Please choose a .glb file first.');
			}

			const fd = new FormData();
			fd.append('file', input.files[0]);

			const res = await postFiles(`${BASE_URL}/products/${variantId}/glb-model`, fd);
			if (!res.ok || !res.json) {
				console.error('3D file upload failed:', res.json || res.text);
				return Swal?.fire('Error', '3D file upload failed.', 'error') ?? alert('3D file upload failed.');
			}

			display3dFilePreview(res.json['3d_file'], card, Number(variantId));
			input.value = '';
			Swal?.fire('Uploaded', '3D file uploaded successfully.', 'success');
		}

		async function upload3dPlaceholderForRow(card) {
			const variantId = card.dataset.variantId;
			if (!variantId) {
				return Swal?.fire('Error', 'Variant ID missing on this row.', 'error') ?? alert('Variant ID missing on this row.');
			}
			const input = card.querySelector('.v_3d_placeholder');
			if (!input?.files?.length) {
				return Swal?.fire('No file', 'Please choose a placeholder image first.', 'info') ?? alert('Please choose a placeholder image first.');
			}

			const fd = new FormData();
			fd.append('file', input.files[0]);

			const res = await postFiles(`${BASE_URL}/products/${variantId}/model-placeholder`, fd);
			if (!res.ok || !res.json) {
				console.error('3D placeholder upload failed:', res.json || res.text);
				return Swal?.fire('Error', '3D placeholder upload failed.', 'error') ?? alert('3D placeholder upload failed.');
			}

			display3dPlaceholderPreview(res.json['3d_placeholder'], card, Number(variantId));
			input.value = '';
			Swal?.fire('Uploaded', '3D placeholder uploaded successfully.', 'success');
		}
		
        // Attach event listeners to the upload buttons
		// document.querySelector('#variants_body').addEventListener('click', async function (e) {
		//     const target = e.target;
		//     if (!target) return;

		//     const card = target.closest('.variant-card');
		//     if (!card) return;

		//     const variantIdRaw = card.dataset.variantId || card.querySelector('.v_variant_id')?.value || '';
		//     const variantId = variantIdRaw ? Number(variantIdRaw) : null;
		//     // const variantId = tr.dataset.variantId || card.querySelector('.v_variant_id')?.value;
		//     // if (!variantId) return;

		//     if (target.classList.contains('upload_banners_btn')) {
		//         if (!variantId) {
		//             return Swal?.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload banners.', 'info')
		//                 ?? alert('Save the product first so this variant gets an ID, then upload banners.');
		//         }
		//         const input = card.querySelector('.v_banners');
		//         await handleUploadFiles(input, `${BASE_URL}/products/${variantId}/banners`, variantId, tr, 'banners');
		//     }
		//     if (target.classList.contains('upload_photos_btn')) {
		//         if (!variantId) {
		//             return Swal?.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload photos.', 'info')
		//                     ?? alert('Save the product first so this variant gets an ID, then upload photos.');
		//         }
		//         const input = card.querySelector('.v_photos');
		//         await handleUploadFiles(input, `${BASE_URL}/products/${variantId}/photos`, variantId, tr, 'photos');

		//         // REMOVE VARIANT (table row "Remove" button)
		//         if (target.classList.contains('remove_variant')) {
		//             // If the row is not yet persisted (no ID), remove immediately
		//             if (!variantId) {
		//             card.remove(); renumberVariantCards();
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
		//             card.remove(); renumberVariantCards();

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


		document.querySelector('#variants_body').addEventListener('input', (e) => {
			const card = e.target.closest('.variant-card');
			if (!card) return;
			if (e.target.matches('.v_variant_type, .v_variant_value')) {
				refreshVariantCardSummary(card);
			}
		});

		document.querySelector('#variants_body').addEventListener('click', async function(e) {
			const target = e.target;
			if (!target) return;

			const card = target.closest('.variant-card');
			if (!card) return;

			if (target.classList.contains('toggle_variant_btn')) {
				card.classList.toggle('is-collapsed');
				return;
			}

			const variantIdRaw = card.dataset.variantId || card.querySelector('.v_variant_id')?.value || '';
			const variantId = variantIdRaw ? Number(variantIdRaw) : null;

			// 1) Upload banners
			if (target.classList.contains('upload_banners_btn')) {
				if (!variantId) {
					return (window.Swal ?
						Swal.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload banners.', 'info') :
						alert('Save the product first so this variant gets an ID, then upload banners.'));
				}
				const input = card.querySelector('.v_banners');
				return await handleUploadFiles(input, `${BASE_URL}/products/${variantId}/banners`, variantId, card, 'banners');
			}

			// 2) Upload photos
			if (target.classList.contains('upload_photos_btn')) {
				if (!variantId) {
					return (window.Swal ?
						Swal.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload photos.', 'info') :
						alert('Save the product first so this variant gets an ID, then upload photos.'));
				}
				const input = card.querySelector('.v_photos');
				return await handleUploadFiles(input, `${BASE_URL}/products/${variantId}/photos`, variantId, card, 'photos');
			}

			if (target.classList.contains('upload_3d_file_btn')) {
				if (!variantId) {
					return (window.Swal ?
						Swal.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload the 3D file.', 'info') :
						alert('Save the product first so this variant gets an ID, then upload the 3D file.'));
				}
				return await upload3dFileForRow(card);
			}

			if (target.classList.contains('upload_3d_placeholder_btn')) {
				if (!variantId) {
					return (window.Swal ?
						Swal.fire('Variant not saved', 'Please save the product first so this variant gets an ID, then upload the placeholder.', 'info') :
						alert('Save the product first so this variant gets an ID, then upload the placeholder.'));
				}
				return await upload3dPlaceholderForRow(card);
			}

			// 3) Remove variant (separate branch — not nested)
			if (target.classList.contains('remove_variant')) {
				// If never saved, just remove locally
				if (!variantId) {
					card.remove(); renumberVariantCards();
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
					card.remove(); renumberVariantCards();
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

		function display3dFilePreview(fileObj, row, variantId) {
			const container = row.querySelector('.three-d-file-preview');
			if (!container) return;
			container.innerHTML = '';
			if (!fileObj?.url) return;

			const wrap = document.createElement('div');
			wrap.style.position = 'relative';
			wrap.style.display = 'inline-block';

			const link = document.createElement('a');
			link.href = fileObj.url;
			link.target = '_blank';
			link.rel = 'noopener';
			link.textContent = 'View .glb';
			link.className = 'text-primary text-sm';

			const deleteBtn = document.createElement('button');
			deleteBtn.innerText = 'X';
			deleteBtn.style.position = 'absolute';
			deleteBtn.style.top = '-8px';
			deleteBtn.style.right = '-8px';
			deleteBtn.style.fontSize = '12px';
			deleteBtn.style.backgroundColor = 'rgba(255, 0, 0, 0.7)';
			deleteBtn.style.color = '#fff';
			deleteBtn.style.border = 'none';
			deleteBtn.style.borderRadius = '50%';
			deleteBtn.style.cursor = 'pointer';
			deleteBtn.dataset.variantId = variantId;

			deleteBtn.addEventListener('click', async (e) => {
				e.preventDefault();
				const confirmDelete = await Swal.fire({
					title: 'Are you sure?',
					text: 'Do you want to delete this 3D file?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes, delete it!',
					cancelButtonText: 'No, keep it'
				});
				if (!confirmDelete.isConfirmed) return;

				try {
					await delete3dFileById(variantId);
					container.innerHTML = '';
					Swal.fire('Deleted!', 'The 3D file has been deleted.', 'success');
				} catch (err) {
					console.error(err);
					Swal.fire('Error', 'Failed to delete 3D file.', 'error');
				}
			});

			wrap.appendChild(link);
			wrap.appendChild(deleteBtn);
			container.appendChild(wrap);
		}

		function display3dPlaceholderPreview(fileObj, row, variantId) {
			const container = row.querySelector('.three-d-placeholder-preview');
			if (!container) return;
			container.innerHTML = '';
			if (!fileObj?.url) return;

			const wrap = document.createElement('div');
			wrap.style.position = 'relative';
			wrap.style.display = 'inline-block';

			const img = document.createElement('img');
			img.src = fileObj.url;
			img.alt = '3D placeholder';
			img.loading = 'lazy';
			img.style.width = '50px';
			img.style.height = '50px';
			img.style.objectFit = 'contain';
			img.style.padding = '10px';
			img.style.cursor = 'pointer';

			img.addEventListener('click', () => {
				Swal.fire({
					imageUrl: fileObj.url,
					imageAlt: '3D placeholder',
					confirmButtonText: 'Close'
				});
			});

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
			deleteBtn.dataset.variantId = variantId;

			deleteBtn.addEventListener('click', async (e) => {
				e.stopPropagation();
				const confirmDelete = await Swal.fire({
					title: 'Are you sure?',
					text: 'Do you want to delete this placeholder?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes, delete it!',
					cancelButtonText: 'No, keep it'
				});
				if (!confirmDelete.isConfirmed) return;

				try {
					await delete3dPlaceholderById(variantId);
					container.innerHTML = '';
					Swal.fire('Deleted!', 'The placeholder has been deleted.', 'success');
				} catch (err) {
					console.error(err);
					Swal.fire('Error', 'Failed to delete placeholder.', 'error');
				}
			});

			wrap.appendChild(img);
			wrap.appendChild(deleteBtn);
			container.appendChild(wrap);
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

		async function delete3dFileById(variantId) {
			const url = `${BASE_URL}/products/variants/${variantId}/glb-model`;
			const res = await fetch(url, {
				method: 'DELETE',
				headers: {
					'Authorization': 'Bearer ' + authToken
				}
			});
			if (!res.ok) {
				const text = await res.text().catch(() => '');
				throw new Error(`3D file delete failed: ${res.status} ${text}`);
			}
		}

		async function delete3dPlaceholderById(variantId) {
			const url = `${BASE_URL}/products/variants/${variantId}/model-placeholder`;
			const res = await fetch(url, {
				method: 'DELETE',
				headers: {
					'Authorization': 'Bearer ' + authToken
				}
			});
			if (!res.ok) {
				const text = await res.text().catch(() => '');
				throw new Error(`3D placeholder delete failed: ${res.status} ${text}`);
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
			const variants = qa('#variants_body .variant-card').map(card => {
				const variant_id = (card.querySelector('.v_variant_id')?.value || '').trim();
				const min_qty = parseNum(card.querySelector('.v_min_qty')?.value);
				const is_cod = toBoolVal(card.querySelector('.v_is_cod'));
				const weight = parseNum(card.querySelector('.v_weight')?.value);
				const desc = card.querySelector('.v_description')?.value.trim() || null;
				const variant_type = card.querySelector('.v_variant_type')?.value.trim() || null;
				const variant_value = card.querySelector('.v_variant_value')?.value.trim() || null;
				const regular_price = parseNum(card.querySelector('.v_regular_price')?.value);
				// const selling_price = parseNum(card.querySelector('.v_selling_price')?.value);
				// const sales_price_vendor = parseNum(card.querySelector('.v_sales_price_vendor')?.value);
				const hsn = card.querySelector('.v_hsn')?.value.trim() || null;
				const regular_tax = parseNum(card.querySelector('.v_regular_tax')?.value);
				const selling_tax = parseNum(card.querySelector('.v_selling_tax')?.value);
				const video_url = card.querySelector('.v_video_url')?.value.trim() || null;
				const product_pdf = card.querySelector('.v_product_pdf')?.value.trim() || null;
				// NEW (keeps 0 as valid):
				const customer_discount = parseNum(card.querySelector('.v_customer_discount')?.value) ?? null;
				const dealer_discount = parseNum(card.querySelector('.v_dealer_discount')?.value) ?? null;
				const architect_discount = parseNum(card.querySelector('.v_architect_discount')?.value) ?? null;


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

				variantRows.push(card); // keep same order as we push into variants[]
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
				const card = variantRows[i];
				const vid = cv.id;

				// Collect chosen files
				const photosInput = card.querySelector('.v_photos');
				const bannersInput = card.querySelector('.v_banners');
				const threeDFileInput = card.querySelector('.v_3d_file');
				const threeDPlaceholderInput = card.querySelector('.v_3d_placeholder');

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

				if (threeDFileInput && threeDFileInput.files && threeDFileInput.files.length > 0) {
					const fd3d = new FormData();
					fd3d.append('file', threeDFileInput.files[0]);
					const threeDRes = await postFiles(`${BASE_URL}/products/${vid}/glb-model`, fd3d);
					if (!threeDRes.ok) {
						console.error(`3D file upload failed for variant ${vid}:`, threeDRes.json || threeDRes.text);
						throw new Error(`3D file upload failed for variant ${vid}`);
					}
					display3dFilePreview(threeDRes.json['3d_file'], card, Number(vid));
					threeDFileInput.value = '';
				}

				if (threeDPlaceholderInput && threeDPlaceholderInput.files && threeDPlaceholderInput.files.length > 0) {
					const fdPlaceholder = new FormData();
					fdPlaceholder.append('file', threeDPlaceholderInput.files[0]);
					const placeholderRes = await postFiles(`${BASE_URL}/products/${vid}/model-placeholder`, fdPlaceholder);
					if (!placeholderRes.ok) {
						console.error(`3D placeholder upload failed for variant ${vid}:`, placeholderRes.json || placeholderRes.text);
						throw new Error(`3D placeholder upload failed for variant ${vid}`);
					}
					display3dPlaceholderPreview(placeholderRes.json['3d_placeholder'], card, Number(vid));
					threeDPlaceholderInput.value = '';
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
    .product-edit-page { padding-bottom: 2rem; }
    .product-edit-shell { max-width: 1180px; margin: 0 auto; display: flex; flex-direction: column; gap: 1.25rem; }
    .product-edit-topbar { display: flex; flex-wrap: wrap; align-items: flex-start; justify-content: space-between; gap: 1rem; padding-bottom: 1.5rem; }
    .product-edit-topbar__eyebrow { font-size: 11px; letter-spacing: .08em; text-transform: uppercase; color: #64748b; font-weight: 600; margin-bottom: .35rem; }
    .product-edit-topbar__title { font-size: 1.5rem; font-weight: 600; color: #0f172a; line-height: 1.2; margin: 0 0 .35rem; }
    .product-edit-topbar__subtitle { font-size: .875rem; color: #64748b; margin: 0; max-width: 42rem; }
    .product-edit-topbar__actions { display: flex; align-items: center; gap: .75rem; }
    .product-id-badge { display: inline-flex; align-items: center; padding: .35rem .65rem; border-radius: 999px; background: #eff6ff; color: #1d4ed8; font-size: .75rem; font-weight: 600; border: 1px solid #dbeafe; }
    .product-section-card { border: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(15,23,42,.04); }
    .product-section-card .card-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; padding: 1rem 1.25rem; border-bottom: 1px solid #eef2f7; }
    .section-subtitle { margin: .25rem 0 0; font-size: .8125rem; color: #64748b; }
    .section-hint { margin: .75rem 0 0; font-size: .75rem; color: #64748b; }
    .product-form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem 1.25rem; }
    .form-field { display: flex; flex-direction: column; gap: .35rem; min-width: 0; }
    .form-field--full { grid-column: 1 / -1; }
    .form-field .form-label { font-size: .8125rem; font-weight: 600; color: #334155; margin: 0; }
    .table-wrap { overflow-x: auto; border: 1px solid #e2e8f0; border-radius: .75rem; }
    .product-edit-footer { position: sticky; bottom: 0; z-index: 20; display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 1rem 1.25rem; background: rgba(255,255,255,.95); border: 1px solid #e2e8f0; border-radius: .875rem; box-shadow: 0 -4px 24px rgba(15,23,42,.06); backdrop-filter: blur(8px); }
    .product-edit-footer__note { font-size: .8125rem; color: #64748b; }
    .variants-stack { display: flex; flex-direction: column; gap: 1rem; }
    .variant-card { border: 1px solid #e2e8f0; border-radius: .875rem; background: #fff; overflow: hidden; }
    .variant-card__header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: .85rem 1rem; background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; }
    .variant-card__heading { display: flex; align-items: center; gap: .65rem; min-width: 0; }
    .variant-card__index { display: inline-flex; align-items: center; padding: .2rem .55rem; border-radius: 999px; background: #dbeafe; color: #1e40af; font-size: .6875rem; font-weight: 700; letter-spacing: .02em; text-transform: uppercase; white-space: nowrap; }
    .variant-card__summary { font-size: .875rem; font-weight: 600; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .variant-card__toolbar { display: flex; align-items: center; gap: .5rem; flex-shrink: 0; }
    .variant-card__body { padding: 1rem; display: flex; flex-direction: column; gap: 1rem; }
    .variant-card.is-collapsed .variant-card__body { display: none; }
    .variant-card.is-collapsed .toggle_variant_btn { transform: rotate(-90deg); }
    .toggle_variant_btn { transition: transform .2s ease; min-width: 2rem; padding-inline: .5rem; font-size: .9rem; line-height: 1; }
    .variants-stack:empty::before { content: 'No variants yet. Click "+ Add Variant" to create one.'; display: block; padding: 1.25rem; text-align: center; color: #64748b; font-size: .875rem; border: 1px dashed #cbd5e1; border-radius: .75rem; background: #f8fafc; }
    .variant-section { border: 1px solid #eef2f7; border-radius: .75rem; padding: .85rem; background: #fcfdff; }
    .variant-section__title { font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: #64748b; margin-bottom: .75rem; }
    .variant-grid { display: grid; gap: .75rem; }
    .variant-grid--2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .variant-grid--3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .variant-grid--4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .form-field--span-2 { grid-column: span 2; }
    .variant-media-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: .85rem; }
    .upload-panel { border: 1px dashed #cbd5e1; border-radius: .75rem; padding: .75rem; background: #fff; }
    .upload-panel__head { display: flex; align-items: center; justify-content: space-between; gap: .5rem; margin-bottom: .5rem; font-size: .8125rem; font-weight: 600; color: #334155; }
    .media-thumbs { display: flex; flex-wrap: wrap; gap: .5rem; min-height: 2rem; margin-top: .5rem; }
    .text-edit { width: 100%; min-height: 120px; border: 1px solid rgba(128,128,128,.34); border-radius: 10px; background: #fcfcfc; padding: 8px 12px; text-align: justify; }
    .table th, .table td { vertical-align: middle; }
    .btn.danger { color: #b42318; border-color: #f3d5d3; }
    .text-2xs { font-size: 11px; line-height: 1.1; }
    @media (max-width: 992px) {
        .product-form-grid, .variant-grid--4, .variant-grid--3, .variant-media-grid, .variant-grid--2 { grid-template-columns: 1fr; }
        .form-field--span-2 { grid-column: auto; }
        .product-edit-footer { flex-direction: column; align-items: stretch; }
        .product-edit-footer .btn { width: 100%; }
    }
</style>
