<?php
  // pages/user_detail.php
?>
<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>

<?php 
  $current_page = "User Detail";
  // id from query param (sanitize light)
  $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<?php include("header1.php"); ?>

<main class="grow content pt-5" id="content" role="content">
  <div class="container-fixed">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
      <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">
          User Detail
        </h1>
        <div class="text-xs text-gray-500">
          Profile, addresses & orders for User ID: <span id="ud-user-id"><?php echo htmlspecialchars($user_id); ?></span>
        </div>
      </div>
      <div class="flex items-center gap-2.5">
        <a class="btn btn-sm btn-light" href="pages/show_users.php">Back to Users</a>
      </div>
    </div>
  </div>

  <div class="container-fixed">
    <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch">
      <!-- Left column: Summary -->
      <div class="lg:col-span-1">
        <div class="card">
          <div class="card-header py-4">
            <h3 class="card-title">Profile Summary</h3>
          </div>
          <div class="card-body">
            <div class="flex items-center gap-4 mb-4">
              <img class="h-12 w-12 rounded-full" src="../../images/default/df001.png" alt="avatar">
              <div class="flex flex-col">
                <div class="font-medium text-gray-900 text-sm" id="ud-name">—</div>
                <div class="text-xs text-gray-600" id="ud-email">—</div>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-2 text-xs text-gray-700">
              <div class="flex justify-between"><span class="text-gray-500">Mobile</span><span id="ud-mobile">—</span></div>
              <div class="flex justify-between"><span class="text-gray-500">Role</span>
                <span class="badge badge-sm badge-light badge-outline" id="ud-role">—</span>
              </div>
              <div class="flex justify-between"><span class="text-gray-500">Selected Type</span>
                <span class="badge badge-sm badge-outline" id="ud-selected-type">—</span>
              </div>
              <div class="flex justify-between"><span class="text-gray-500">GSTIN</span>
                <span class="badge badge-sm badge-outline" id="ud-gstin">—</span>
              </div>
              <div class="flex justify-between"><span class="text-gray-500">Joined</span><span id="ud-joined">—</span></div>
            </div>
          </div>
        </div>

        <!-- Addresses -->
        <div class="card mt-5">
          <div class="card-header py-4">
            <h3 class="card-title">Addresses</h3>
          </div>
          <div class="card-body" id="ud-addresses">
            <div class="text-xs text-gray-600">Loading addresses…</div>
          </div>
        </div>
      </div>

      <!-- Right column: Orders -->
        <div class="lg:col-span-2">
            <div class="card">
                <div class="card-header py-4">
                <h3 class="card-title">Orders</h3>
                </div>
                <div class="card-body" id="ud-orders">
                <div class="text-xs text-gray-600">Loading orders…</div>
                </div>
            </div>
        </div>
    </div>
  </div>
</main>

<script>
(function(){
  const BASE = `<?php echo BASE_URL; ?>`;
  const userId = <?php echo json_encode($user_id, JSON_UNESCAPED_SLASHES); ?>;
  const token = localStorage.getItem('auth_token');

  if (!userId) {
    document.getElementById('ud-orders').innerHTML = `<div class="text-xs text-red-600">No user id provided.</div>`;
    document.getElementById('ud-addresses').innerHTML = `<div class="text-xs text-red-600">No user id provided.</div>`;
    return;
  }

  const safe = (s) => (s === null || s === undefined) ? 'NA' : String(s);
  const na = (s) => {
    if (s === null || s === undefined) return 'NA';
    const v = String(s).trim();
    return v.length ? v : 'NA';
  };
  const fmtAmt = (n) => {
    const num = Number(n);
    return isFinite(num) ? num.toFixed(2) : '0.00';
  };
  const fmtDate = (iso) => {
    if (!iso) return 'NA';
    try {
      const d = new Date(iso);
      if (isNaN(d.getTime())) return 'NA';
      // Asia/Kolkata shown naturally by client timezone
      return d.toLocaleString();
    } catch {
      return 'NA';
    }
  };
  const escapeHtml = (s="") => s.replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));

  async function loadProfile(){
    try {
      const res = await fetch(`${BASE}/get_profile/${userId}`, {
        method: 'GET',
        headers: token ? { 'Authorization': `Bearer ${token}` } : {}
      });
      const json = await res.json().catch(()=> ({}));

      if (!json?.success) throw new Error(json?.message || `Failed (${res.status})`);

      const { user, addresses = [], orders = [] } = json.data || {};

      // Summary
      document.getElementById('ud-name').textContent = na(user?.name);
      document.getElementById('ud-email').textContent = na(user?.email);
      document.getElementById('ud-mobile').textContent = na(user?.mobile);
      document.getElementById('ud-role').textContent = na(user?.role);
      document.getElementById('ud-selected-type').textContent = na(user?.selected_type);
      document.getElementById('ud-gstin').textContent = na(user?.gstin);
      document.getElementById('ud-joined').textContent = fmtDate(user?.joined_at);

      // Addresses
      const addrWrap = document.getElementById('ud-addresses');
      addrWrap.innerHTML = '';
      if (!addresses.length) {
        addrWrap.innerHTML = `<div class="text-xs text-gray-600">No addresses found.</div>`;
      } else {
        addresses.forEach(a => {
          const lines = [
            na(a.address_line1),
            na(a.address_line2),
            [na(a.city), na(a.state), na(a.postal_code)].filter(x=>x!=='NA').join(', '),
            na(a.country)
          ].filter(line => line && line !== 'NA').join('<br>');

          const defBadge = a.is_default == 1
            ? `<span class="badge badge-sm badge-success badge-outline ml-2">Default</span>`
            : '';

          addrWrap.insertAdjacentHTML('beforeend', `
            <div class="border rounded-xl p-3 mb-3">
              <div class="flex items-center justify-between mb-1">
                <div class="text-sm font-medium text-gray-900">
                  ${escapeHtml(na(a.name))}
                  ${defBadge}
                </div>
                <div class="text-xs text-gray-600">${escapeHtml(na(a.contact_no))}</div>
              </div>
              <div class="text-xs text-gray-700 leading-5">
                ${lines || 'NA'}
              </div>
              <div class="mt-2 text-[11px] text-gray-500">GST on address: ${escapeHtml(na(a.gst_no))}</div>
            </div>
          `);
        });
      }

      // Orders
      const ordersWrap = document.getElementById('ud-orders');
      ordersWrap.innerHTML = '';
      if (!orders.length) {
        ordersWrap.innerHTML = `<div class="text-xs text-gray-600">No orders found.</div>`;
      } else {
        orders.forEach(o => {
          // Items table
          let itemsHtml = '';
          (o.items || []).forEach(it => {
            const prod = it.product || {};
            const variant = it.variant || {};
            itemsHtml += `
              <tr>
                <td class="px-3 py-2 text-xs text-gray-700">${escapeHtml(na(prod.name))}</td>
                <td class="px-3 py-2 text-xs text-gray-700">${escapeHtml(na(variant.variant_value))}</td>
                <td class="px-3 py-2 text-xs text-gray-700">${Number(it.quantity) || 0}</td>
                <td class="px-3 py-2 text-xs text-gray-700">₹ ${fmtAmt(it.price)}</td>
                <td class="px-3 py-2 text-xs text-gray-700">₹ ${fmtAmt(it.subtotal)}</td>
              </tr>
            `;
          });

          const itemsTable = itemsHtml
            ? `
              <div class="mt-3 overflow-x-auto">
                <table class="table table-border w-full min-w-[600px]">
                  <thead>
                    <tr>
                      <th class="px-3 py-2 text-[11px] text-gray-500 font-normal">Product</th>
                      <th class="px-3 py-2 text-[11px] text-gray-500 font-normal">Variant</th>
                      <th class="px-3 py-2 text-[11px] text-gray-500 font-normal">Qty</th>
                      <th class="px-3 py-2 text-[11px] text-gray-500 font-normal">Price</th>
                      <th class="px-3 py-2 text-[11px] text-gray-500 font-normal">Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>${itemsHtml}</tbody>
                </table>
              </div>`
            : `<div class="text-xs text-gray-600 mt-2">No items.</div>`;

          // Payments
          let paymentsHtml = '';
          (o.payments || []).forEach(p => {
            paymentsHtml += `
              <div class="flex items-center gap-2 text-xs">
                <span class="badge badge-sm badge-outline ${p.status === 'success' ? 'badge-success' : (p.status === 'failed' ? 'badge-danger' : '')}">
                  ${escapeHtml(na(p.status))}
                </span>
                <span><strong>₹ ${fmtAmt(p.amount)}</strong></span>
              </div>
            `;
          });
          if (!paymentsHtml) paymentsHtml = `<div class="text-xs text-gray-600">No payments.</div>`;

          // Card
          ordersWrap.insertAdjacentHTML('beforeend', `
            <div class="border rounded-xl p-4 mb-4">
              <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex flex-col">
                  <div class="text-sm font-medium text-gray-900">Order #${escapeHtml(String(o.id))}</div>
                  <div class="text-[11px] text-gray-500">${escapeHtml(na(o.razorpay_order_id))}</div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="text-sm font-medium text-gray-900">
                        <span>Order Status</span>
                        <span class="badge badge-sm badge-outline ${o.status === 'completed' ? 'badge-success' : (o.status === 'cancelled' ? 'badge-danger' : 'badge-light')}">
                            ${escapeHtml(na(o.status))}
                        </span>
                    </div> 
                    <div class="text-sm font-medium text-gray-900">
                        <span>Payment Status</span>                  
                        <span class="badge badge-sm badge-outline ${o.payment_status === 'paid' ? 'badge-success' : (o.payment_status === 'failed' ? 'badge-danger' : 'badge-light')}">
                            ${escapeHtml(na(o.payment_status))}
                        </span>
                    </div>
                </div>
              </div>

              <div class="mt-2 grid sm:grid-cols-2 gap-2 text-xs text-gray-700">
                <div><strong><span class="text-gray-500">Total</span> : ₹ ${fmtAmt(o.total_amount)}</strong></div>
                <div><span class="text-gray-500">Created</span> : ${fmtDate(o.created_at)}</div>
                <div class="sm:col-span-2"><span class="text-gray-500">Ship To</span> : ${escapeHtml(na(o.shipping_address))}</div>
              </div>
                <br>
              ${itemsTable}
                <br>
              <div class="flex flex-wrap items-center justify-between mt-3">
                <div class="text-[11px] text-gray-500 mb-1">Payments</div>
                <div class="flex flex-col gap-1">
                  ${paymentsHtml}
                </div>
              </div>
            </div>
          `);
        });
      }

    } catch (err) {
      document.getElementById('ud-orders').innerHTML = `<div class="text-xs text-red-600">${escapeHtml(err.message || 'Failed to load orders')}</div>`;
      document.getElementById('ud-addresses').innerHTML = `<div class="text-xs text-red-600">${escapeHtml(err.message || 'Failed to load addresses')}</div>`;
    }
  }

  loadProfile();
})();
</script>

<?php include("footer1.php"); ?>
