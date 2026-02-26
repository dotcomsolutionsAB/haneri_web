<?php
// pages/view_order.php
?>
<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>

<?php 
  $current_page = "Order Detail";
?>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<?php include("header1.php"); ?>

<main class="grow content pt-5" id="content" role="content">
  <div class="container-fixed" id="content_container"></div>

  <div class="container-fixed">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
      <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">Order Details</h1>
      </div>
      <div class="flex items-center gap-2.5">
        <a class="btn btn-sm btn-light" href="pages/show_users.php">Back</a>
        <button id="printInvoice" class="btn btn-sm btn-primary">
          <i class="ki-filled ki-note-2 text-lg"></i> Print
        </button>
      </div>
    </div>
  </div>

  <div class="container-fixed">
    <div class="bg-white rounded-lg shadow p-6 space-y-8">
      <!-- Top Controls -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" id="topControlsContainer">
        <div class="text-xs text-gray-600">Loading…</div>
      </div>

      <!-- Customer & Order Info -->
      <div class="grid md:grid-cols-2 gap-6" id="customerOrderInfoContainer">
        <div class="text-xs text-gray-600">Loading…</div>
      </div>

      <hr class="border-gray-200" />

      <!-- Items Table -->
      <div class="overflow-x-auto" id="productTableContainer">
        <div class="text-xs text-gray-600">Loading products…</div>
      </div>

      <hr class="border-gray-200 mt-6" />

      <!-- Totals -->
      <div class="flex justify-end">
        <div class="text-sm w-full max-w-xs space-y-1">
          <div class="flex justify-between">
            <span class="text-gray-700 font-medium">Sub Total</span>
            <span id="subTotal">₹0.00</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-700 font-medium">Tax</span>
            <span id="tax">₹0.00</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-700 font-medium">Shipping</span>
            <span id="shipping">₹0.00</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-700 font-medium">Coupon</span>
            <span id="coupon">₹0.00</span>
          </div>
          <hr class="my-2" />
          <div class="flex justify-between text-base font-bold text-gray-900">
            <span>Total</span>
            <span id="totalAmount">₹0.00</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const BASE = `<?php echo BASE_URL; ?>`;
    const token = localStorage.getItem('auth_token') || '';
    const orderId = new URLSearchParams(window.location.search).get('o_id');

    const topControlsEl = document.getElementById('topControlsContainer');
    const infoEl = document.getElementById('customerOrderInfoContainer');
    const tableEl = document.getElementById('productTableContainer');

    const fmtAmt = (n) => {
      const num = Number(n);
      return isFinite(num) ? num.toFixed(2) : '0.00';
    };
    const na = (v) => {
      if (v === null || v === undefined) return 'N/A';
      const s = String(v).trim();
      return s.length ? s : 'N/A';
    };
    const fmtDate = (iso) => {
      if (!iso) return 'N/A';
      const d = new Date(iso);
      return isNaN(d.getTime()) ? 'N/A' : d.toLocaleString();
    };
    const escapeHtml = (s = "") =>
      s.replace(/[&<>"']/g, c => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));

    if (!orderId) {
      topControlsEl.innerHTML = `<div class="text-xs text-red-600">Missing order id.</div>`;
      infoEl.innerHTML = `<div class="text-xs text-red-600">Missing order id.</div>`;
      tableEl.innerHTML = `<div class="text-xs text-red-600">Missing order id.</div>`;
      return;
    }

    // Fetch order detail
    fetch(`${BASE}/fetch_order_detail/${orderId}`, {
      method: 'GET',
      headers: Object.assign(
        { 'Accept': 'application/json' },
        token ? { 'Authorization': `Bearer ${token}` } : {}
      )
    })
    .then(r => r.json())
    .then(payload => {
      if (!payload?.success || !payload?.data) {
        throw new Error(payload?.message || 'Failed to fetch order.');
      }
      const order = payload.data;
      renderTopControls(order);
      renderInfo(order);
      renderItems(order.items || []);
      renderTotals(order);
    })
    .catch(err => {
      topControlsEl.innerHTML = `<div class="text-xs text-red-600">${escapeHtml(err.message || 'Error')}</div>`;
      infoEl.innerHTML = `<div class="text-xs text-red-600">${escapeHtml(err.message || 'Error')}</div>`;
      tableEl.innerHTML = `<div class="text-xs text-red-600">${escapeHtml(err.message || 'Error')}</div>`;
    });

    function renderTopControls(order) {
        const paymentOptions = ['pending', 'paid', 'failed'];
        const orderOptions   = ['pending', 'completed', 'cancelled','refunded'];
        const deliveryOptions= ['pending', 'accepted', 'arrived', 'completed', 'cancelled'];

        const makeOptions = (opts, current) =>
        opts.map(o => `<option value="${o}" ${o === String(current).toLowerCase() ? 'selected' : ''}>${o}</option>`).join('');

        topControlsEl.innerHTML = `
        <div>
            <label class="text-sm font-medium block mb-1">Payment Status</label>
            <select id="sel-payment-status" class="select select-sm w-[350px]">
            ${makeOptions(paymentOptions, order.payment_status)}
            </select>
        </div>
        <div>
            <label class="text-sm font-medium block mb-1">Order Status</label>
            <select id="sel-order-status" class="select select-sm w-[350px]">
            ${makeOptions(orderOptions, order.status)}
            </select>
        </div>
        <div>
            <label class="text-sm font-medium block mb-1">Delivery Status</label>
            <select id="sel-delivery-status" class="select select-sm w-[350px]">
            ${makeOptions(deliveryOptions, order.delivery_status || 'pending')}
            </select>
        </div>
        <div id="status-toast" class="col-span-1 sm:col-span-3 hidden text-xs mt-1"></div>
        `;

        // Wire up change handlers with optimistic UI + revert on error
        wireSelect('sel-payment-status', 'payment_status');
        wireSelect('sel-order-status', 'status');
        wireSelect('sel-delivery-status', 'delivery_status');

        function wireSelect(selectId, field) {
        const el = document.getElementById(selectId);
        let prev = el.value; // for revert if API fails

        el.addEventListener('change', async () => {
            const next = el.value;
            if (next === prev) return;

            // Disable all selects briefly during update
            setSelectsDisabled(true);
            showToast(`Updating ${labelFor(field)} → ${next}…`, 'info');

            try {
            await updateOrderField({ [field]: next });
            prev = next;
            showToast(`Updated ${labelFor(field)} to "${next}"`, 'success');

            // Also reflect badges on the right info box if needed
            // (Optional) You can update text nodes there, too.

            } catch (err) {
            // Revert UI
            el.value = prev;
            showToast(err.message || `Failed to update ${labelFor(field)}.`, 'error');
            } finally {
            setSelectsDisabled(false);
            }
        });
        }

        function setSelectsDisabled(disabled) {
        ['sel-payment-status','sel-order-status','sel-delivery-status'].forEach(id => {
            const s = document.getElementById(id);
            if (s) s.disabled = disabled;
        });
        }

        function labelFor(f) {
        if (f === 'payment_status') return 'Payment Status';
        if (f === 'delivery_status') return 'Delivery Status';
        return 'Order Status';
        }

        function showToast(msg, type='info') {
        const toast = document.getElementById('status-toast');
        if (!toast) return;
        const palette = {
            info:    'bg-blue-50 text-blue-700 border-blue-200',
            success: 'bg-green-50 text-green-700 border-green-200',
            error:   'bg-red-50 text-red-700 border-red-200',
        }[type] || palette?.info;

        toast.className = `col-span-1 sm:col-span-3 border rounded px-3 py-2 ${palette}`;
        toast.textContent = msg;
        toast.hidden = false;
        clearTimeout(showToast._t);
        showToast._t = setTimeout(() => { toast.hidden = true; }, 2000);
        }
    }

    function renderInfo(order) {
      const user = order.user || {};
      // Parse shipping_address "Name, Phone, Address…"
      const fullAddress = na(order.shipping_address);
      let name = na(user.name);
      let phone = na(user.mobile);
      let addr = fullAddress;

      if (fullAddress !== 'N/A') {
        const parts = fullAddress.split(',');
        if (parts.length >= 2) {
          name = na(parts[0]);
          phone = na(parts[1]);
          addr = parts.slice(2).join(',').trim();
          if (!addr) addr = fullAddress; // fallback
        }
      }

      infoEl.innerHTML = `
        <div class="flex gap-4">
          <img src="../../images/default/df001.png" alt="User" class="w-32 h-32 border rounded" />
          <div class="text-sm space-y-1">
            <p class="text-lg font-semibold">${escapeHtml(name)}</p>
            <p>Email: ${escapeHtml(na(user.email))}</p>
            <p>Phone: ${escapeHtml(phone)}</p>
            <p class="pt-2">${escapeHtml(na(addr))}</p>
          </div>
        </div>

        <div class="text-sm flex justify-end w-full">
          <div class="right-box w-full max-w-xs space-y-1">
            <div class="flex justify-between">
              <span class="text-gray-600">Order #</span>
              <span class="text-indigo-600 font-semibold">${escapeHtml(String(order.id))}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Order Status</span>
              <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                ${escapeHtml(na(order.status))}
              </span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Order Date</span>
              <span>${fmtDate(order.created_at)}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Total Amount</span>
              <span class="font-medium">₹${fmtAmt(order.total_amount)}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Payment Status</span>
              <span>${escapeHtml(na(order.payment_status))}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Razorpay Order</span>
              <span>${escapeHtml(na(order.razorpay_order_id))}</span>
            </div>
          </div>
        </div>
      `;
    }

    function renderItems(items) {
      if (!items.length) {
        tableEl.innerHTML = `<div class="text-xs text-gray-600">No items found.</div>`;
        return;
      }

      let rows = '';
      items.forEach((it, idx) => {
        const product = it.product || {};
        const variant = it.variant || {};
        rows += `
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3">${idx + 1}</td>
            <td class="px-4 py-3">
              <div class="font-semibold">${escapeHtml(na(product.name))}</div>
              <div class="text-xs text-gray-500">
                Variant: ${escapeHtml(na(variant.variant_value))}
              </div>
            </td>
            <td class="px-4 py-3">${Number(it.quantity) || 0}</td>
            <td class="px-4 py-3">₹${fmtAmt(it.price)}</td>
            <td class="px-4 py-3 text-right">₹${fmtAmt(it.subtotal)}</td>
          </tr>
        `;
      });

      tableEl.innerHTML = `
        <table class="min-w-full text-sm">
          <thead class="bg-gray-100 text-gray-600 text-left uppercase tracking-wide">
            <tr>
              <th class="px-4 py-3">#</th>
              <th class="px-4 py-3">Product</th>
              <th class="px-4 py-3">Qty</th>
              <th class="px-4 py-3">Price</th>
              <th class="px-4 py-3 text-right">Subtotal</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            ${rows}
          </tbody>
        </table>
      `;
    }

    function renderTotals(order) {
      const items = order.items || [];
    //   const subtotal = items.reduce((acc, it) => acc + (Number(it.subtotal) || 0), 0);
      const subtotal = Number(order.total) || 0.00;
      const tax = Number(order.tax) || 0.00;
      const total = Number(order.total_amount) || 0.00;

      // If your API later provides explicit tax/shipping/coupon, use those.
      // For now:
    //   const tax = Math.max(total - subtotal, 0);
      const shipping = 0;
      const coupon = 0;

      document.getElementById('subTotal').textContent = `₹${fmtAmt(subtotal)}`;
      document.getElementById('tax').textContent = `₹${fmtAmt(tax)}`;
      document.getElementById('shipping').textContent = `₹${fmtAmt(shipping)}`;
      document.getElementById('coupon').textContent = `₹${fmtAmt(coupon)}`;
      document.getElementById('totalAmount').textContent = `₹${fmtAmt(total)}`;
    }

    async function updateOrderField(payload) {
        // Uses BASE and orderId already defined in your page script
        const url = `${BASE}/status/${orderId}/update`;
        const res = await fetch(url, {
        method: 'POST',
        headers: Object.assign(
            { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            (localStorage.getItem('auth_token') ? { 'Authorization': `Bearer ${localStorage.getItem('auth_token')}` } : {})
        ),
        body: JSON.stringify(payload)
        });

        const json = await res.json().catch(() => ({}));
        if (!res.ok || json?.success !== true) {
        throw new Error(json?.message || `Update failed (${res.status})`);
        }
        // Optional: you can update the “right info box” live here using json.data.*
        return json.data; // {id, status, payment_status, delivery_status, updated_at}
    }
    // Print
    document.getElementById('printInvoice').addEventListener('click', () => window.print());
  });
  </script>
<script>
  
</script>

</main>

<?php include("footer1.php"); ?>
