<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>

<?php
  $current_page = "Show Coupons";
?>
<?php include("header1.php"); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
  .header-controls { row-gap: .5rem; }
  .header-bulk { border-left: 1px solid #e5e7eb; padding-left: .75rem; }
  @media (max-width: 640px) {
    .header-bulk { border-left: 0; padding-left: 0; width: 100%; }
  }

  .swal2-my-small-popup {
    font-size: 0.85rem;
    line-height: 1.2;
  }

  .swal2-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-top: 15px;
  }
  .swal2-field {
    display: flex;
    flex-direction: column;
    text-align: left;
    font-size: 13px;
  }
  .swal2-field label {
    margin-bottom: 4px;
    font-weight: 600;
    color: #444;
  }
  .swal2-field input, .swal2-field select {
    padding: 6px 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 13px;
    width: 100%;
    height: 38px;
  }

  .swal2-confirm-btn {
    background-color: orange !important;
    color: #fff !important;
    border: none !important;
  }
  .swal2-cancel-btn {
    background-color: red !important;
    color: #fff !important;
    border: none !important;
  }

  .pagination {
    display: inline-flex;
    align-items: center;
    gap: 1rem;
  }
  .pagination .active { outline: 2px solid #111827; }
  .pagination .opacity-50 { opacity: .5; }
</style>

<script>
  window.APP_CONFIG = { BASE_URL: "<?php echo BASE_URL; ?>" };
</script>

<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<main class="grow content pt-5" id="content" role="content">
  <div class="container-fixed">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
      <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">Coupons</h1>
      </div>
      <div class="flex items-center gap-2.5">
        <button id="addCouponBtn" class="btn btn-sm btn-primary" type="button">Add Coupon</button>
      </div>
    </div>
  </div>

  <div class="container-fixed">
    <div class="grid gap-5 lg:gap-7.5">
      <div class="card card-grid min-w-full">

        <div class="card-header py-5 flex-wrap gap-3 justify-between items-center">
          <h3 class="card-title">
            Overview of <span id="count-coupons">0</span> Coupons
          </h3>

          <div class="flex flex-wrap items-center gap-3 header-controls">
            <!-- Search -->
            <div class="relative">
              <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
              <input id="couponSearch" class="input input-sm pl-8" placeholder="Search by Coupon Code" type="text" />
            </div>
            <!-- Search: User Name -->
            <div class="relative">
                <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
                <input id="userSearch" class="input input-sm pl-8" placeholder="Search by User Name" type="text" />
            </div>
            <!-- Active-only -->
            <label class="switch switch-sm">
              <input class="order-2" id="activeOnlySwitch" type="checkbox" value="1" />
              <span class="switch-label order-1">Active Coupons</span>
            </label>

            <!-- Bulk -->
            <div class="flex items-center gap-2 header-bulk">
              <select id="bulkActionSelect" class="select select-sm min-w-[180px]">
                <option value="">Bulk action</option>
                <option value="csv">Export in CSV</option>
                <option value="excel">Export in Excel</option>
                <option value="delete">Delete</option>
              </select>
              <span id="selectedCount" class="text-2sm text-gray-600 min-w-[100px]">0 selected</span>
              <button id="applyBulkAction" class="btn btn-sm btn-light">Apply</button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div data-datatable="false" data-datatable-page-size="10">
            <div class="scrollable-x-auto">
              <table class="table table-border" id="coupon-table">
                <thead>
                  <tr>
                    <th class="w-[60px] text-center">
                      <input id="selectAll" class="checkbox checkbox-sm" type="checkbox" />
                    </th>
                    <th class="min-w-[220px] text-gray-700 font-normal">Coupon Code</th>
                    <th class="min-w-[160px] text-gray-700 font-normal">User</th>
                    <th class="min-w-[180px] text-gray-700 font-normal">Discount</th>
                    <th class="min-w-[120px] text-gray-700 font-normal">Count</th>
                    <th class="min-w-[140px] text-gray-700 font-normal">Status</th>
                    <th class="min-w-[180px] text-gray-700 font-normal">Validity</th>
                    <th class="w-[60px]"></th>
                  </tr>
                </thead>
                <tbody><!-- rows injected --></tbody>
              </table>
            </div>

            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
              <div class="flex items-center gap-2 order-2 md:order-1">
                Show
                <select class="select select-sm w-16" id="perPageSelect" name="perpage"></select>
                per page
              </div>
              <div class="flex items-center gap-4 order-1 md:order-2">
                <span id="datatableInfo"></span>
                <div class="pagination" id="pagination"></div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</main>

<script>
(function ($) {
  $(function () {
    const token = localStorage.getItem('auth_token') || '';
    const BASE_URL = (window.APP_CONFIG && window.APP_CONFIG.BASE_URL) || '';

    // ✅ endpoints (change here if your API differs)
    const API_FETCH  = `${BASE_URL}/coupons/fetch`;
    const API_DELETE = (id) => `${BASE_URL}/coupons/delete/${encodeURIComponent(id)}`;
    const API_UPDATE = (id) => `${BASE_URL}/coupons/update/${encodeURIComponent(id)}`;

    // ---- STATE ----
    let itemsPerPage = 10;
    let currentPage  = 1;

    let allCoupons = [];       // full fetched list
    let filtered   = [];       // filtered list
    let totalItems = 0;

    let searchTerm = '';
    let userSearchTerm = '';
    let activeOnly = false;

    const selectedCodes = new Set(); // selection across pages
    const rowsByCode = new Map();    // current rendered page rows

    // ---- ELEMENTS ----
    const $searchInput      = $('#couponSearch');
    const $userSearchInput = $('#userSearch');
    const $perPageSelect    = $('#perPageSelect');
    const $tbody            = $('#coupon-table tbody');
    const $pagination       = $('#pagination');
    const $count            = $('#count-coupons');
    const $info             = $('#datatableInfo');
    const $activeOnlySwitch = $('#activeOnlySwitch');
    const $selectAll        = $('#selectAll');

    const $bulkActionSelect = $('#bulkActionSelect');
    const $applyBulkAction  = $('#applyBulkAction');
    const $selectedCount    = $('#selectedCount');

    // ---- INIT per-page ----
    [5, 10, 25, 50, 100].forEach(size => {
      $perPageSelect.append(`<option value="${size}">${size}</option>`);
    });
    $perPageSelect.val(itemsPerPage);

    function safe(val, fallback='') {
      return (val === null || val === undefined || val === '') ? fallback : val;
    }

    function ordinalSuffix(n) {
      const s = ["th","st","nd","rd"], v = n % 100;
      return n + (s[(v-20)%10] || s[v] || s[0]);
    }

    function clearSelections() {
        selectedCodes.clear();
        updateSelectedCount();
        $selectAll.prop('checked', false).prop('indeterminate', false);
    }

    function formatIST(dateStr, withTime = false) {
      if (!dateStr) return '—';
      const d = new Date(dateStr);
      const parts = new Intl.DateTimeFormat('en-IN', {
        timeZone: 'Asia/Kolkata',
        day: '2-digit', month: 'long', year: 'numeric',
        hour: withTime ? '2-digit' : undefined,
        minute: withTime ? '2-digit' : undefined,
        hour12: true
      }).formatToParts(d);

      const get = (type) => parts.find(p => p.type === type)?.value;
      const dayNum = Number(get('day'));
      const dayWithOrd = ordinalSuffix(dayNum);
      const month = get('month');
      const year  = get('year');

      if (!withTime) return `${dayWithOrd} ${month} ${year}`;

      const hour = get('hour');
      const minute = get('minute');
      const dayPeriod = get('dayPeriod')?.toUpperCase() || '';
      return `${dayWithOrd} ${month} ${year}, ${hour}:${minute} ${dayPeriod} IST`;
    }

    function updateSelectedCount() {
      $selectedCount.text(`${selectedCodes.size} selected`);
    }

    function setHeaderCheckboxState() {
      const visibleCodes = Array.from(rowsByCode.keys());
      if (!visibleCodes.length) {
        $selectAll.prop('checked', false).prop('indeterminate', false);
        return;
      }
      const allSelected = visibleCodes.every(code => selectedCodes.has(code));
      const noneSelected = visibleCodes.every(code => !selectedCodes.has(code));

      $selectAll.prop('checked', allSelected);
      $selectAll.prop('indeterminate', !allSelected && !noneSelected);
    }

    // ---- FETCH ALL ----
    function fetchCoupons() {
        const offset = (currentPage - 1) * itemsPerPage;

        const payload = {
            limit: itemsPerPage,
            offset: offset
        };

        // search by coupon_code
        const term = (searchTerm || '').trim();
        if (term.length >= 1) payload.coupon_code = term;

        // ✅ search by user_name
        const userTerm = (userSearchTerm || '').trim();
        if (userTerm.length >= 1) payload.user_name = userTerm;

        // status filter
        if (activeOnly) payload.status = "active"; // else don't send status
        // If you want dropdown later, you can send inactive too.

        $.ajax({
            url: API_FETCH,
            type: "POST",
            headers: { Authorization: `Bearer ${token}` },
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(payload),
            success: (res) => {
            const d = res?.data || {};
            const list = d?.coupons || [];

            allCoupons = Array.isArray(list) ? list : [];
            totalItems = Number(d.total ?? allCoupons.length);

            // sync paging from API
            itemsPerPage = Number(d.limit ?? itemsPerPage);
            const apiOffset = Number(d.offset ?? offset);
            currentPage = Math.floor(apiOffset / itemsPerPage) + 1;

            // render current page only (API already paginated)
            renderTable(allCoupons);

            // pagination based on total + limit
            const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));
            renderPagination(totalPages);
            renderInfo();

            setHeaderCheckboxState();
            updateSelectedCount();
            $count.text(String(totalItems));
            },
            error: (err) => {
            console.error("Fetch coupons error:", err);
            allCoupons = [];
            totalItems = 0;
            renderTable([]);
            renderPagination(1);
            renderInfo();
            setHeaderCheckboxState();
            updateSelectedCount();
            $count.text("0");
            }
        });
    }

    // ---- FILTER + PAGINATE ----
    function applyFiltersAndRender() {
      const term = (searchTerm || '').trim().toLowerCase();

      filtered = allCoupons.filter(c => {
        const code = String(safe(c.coupon_code, '')).toLowerCase();
        const status = String(safe(c.status, '')).toLowerCase();

        if (term && !code.includes(term)) return false;
        if (activeOnly && status !== 'active') return false;

        return true;
      });

      totalItems = filtered.length;
      const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));
      if (currentPage > totalPages) currentPage = totalPages;

      const startIdx = (currentPage - 1) * itemsPerPage;
      const pageData = filtered.slice(startIdx, startIdx + itemsPerPage);

      renderTable(pageData);
      renderInfo();
      renderPagination(totalPages);

      setHeaderCheckboxState();
      updateSelectedCount();
      $count.text(String(totalItems));
    }

    function renderInfo() {
        const start = totalItems ? ((currentPage - 1) * itemsPerPage + 1) : 0;
        const end   = Math.min(currentPage * itemsPerPage, totalItems);
        $info.text(`Showing ${start}-${end} of ${totalItems}`);
    }

    function renderPagination(totalPages) {
      $pagination.empty();

      const makeBtn = (label, page, opts = {}) => {
        const { disabled=false, active=false, key='' } = opts;
        const classes = ['btn','btn-sm'];
        if (active) classes.push('active');
        if (disabled) classes.push('opacity-50','cursor-not-allowed');
        const dataKey = key ? `data-key="${key}"` : '';
        return `<button class="${classes.join(' ')}" data-page="${page}" ${dataKey} ${disabled ? 'disabled' : ''}>${label}</button>`;
      };

      $pagination.append(makeBtn('First', 1, { disabled: currentPage <= 1, key:'first' }));
      $pagination.append(makeBtn('Previous', Math.max(1, currentPage - 1), { disabled: currentPage <= 1, key:'prev' }));

      const windowSize = 5;
      let start = Math.max(1, currentPage - Math.floor(windowSize / 2));
      let end   = start + windowSize - 1;
      if (end > totalPages) { end = totalPages; start = Math.max(1, end - windowSize + 1); }

      for (let p = start; p <= end; p++) {
        $pagination.append(makeBtn(String(p), p, { active: p === currentPage }));
      }

      $pagination.append(makeBtn('Next', Math.min(totalPages, currentPage + 1), { disabled: currentPage >= totalPages, key:'next' }));
      $pagination.append(makeBtn('Last', totalPages, { disabled: currentPage >= totalPages, key:'last' }));
    }

    // ---- RENDER TABLE ----
    function renderTable(data) {
      rowsByCode.clear();
      $tbody.empty();

      if (!data.length) {
        $tbody.append(`<tr><td colspan="8" class="text-center">No Coupons found</td></tr>`);
        return;
      }

      data.forEach(c => {
        const code = String(safe(c.coupon_code, ''));
        if (!code) return;

        const id = String(safe(c.id, ''));
        rowsByCode.set(code, { ...c, _id: id });

        const user = (c.user_id === null || c.user_id === undefined)
        ? 'All Users'
        : (c.user_name ? `${c.user_name} (ID: ${c.user_id})` : `User ID: ${c.user_id}`);
        const dtype = String(safe(c.discount_type, 'percentage')).toLowerCase();
        const dval  = safe(c.discount_value, 0);

        const discountText = (dtype === 'percentage')
          ? `${dval}%`
          : `₹${dval}`;

        const count = safe(c.count, 0);
        const status = safe(c.status, 'inactive');
        const validity = formatIST(c.validity, false);

        const checkedAttr = selectedCodes.has(code) ? 'checked' : '';

        $tbody.append(`
          <tr>
            <td class="text-center">
              <input class="checkbox checkbox-sm row-check" type="checkbox" data-code="${code}" ${checkedAttr}>
            </td>
            <td>
              <div class="flex flex-col">
                <span class="font-medium text-gray-900">${code}</span>
                <span class="text-xs text-gray-600">${dtype}</span>
              </div>
            </td>
            <td>${user}</td>
            <td><span class="badge badge-sm badge-light badge-outline">${discountText}</span></td>
            <td>${count}</td>
            <td>
              <span class="badge badge-sm ${String(status).toLowerCase()==='active' ? 'badge-success' : 'badge-light'} badge-outline">
                ${status}
              </span>
            </td>
            <td>${validity}</td>
            <td class="w-[60px]">
              ${generateActionButtons(code)}
            </td>
          </tr>
        `);
      });
    }

    function generateActionButtons(code) {
      return `
        <div class="menu" data-menu="true">
          <div class="menu-item menu-item-dropdown" data-menu-item-offset="0, 10px"
              data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown"
              data-menu-item-trigger="click|lg:click">
            <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
              <i class="ki-filled ki-dots-vertical"></i>
            </button>
            <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">

              <div class="menu-item">
                <a class="menu-link view-coupon-btn" href="#" data-code="${code}">
                  <span class="menu-icon"><i class="ki-filled ki-eye"></i></span>
                  <span class="menu-title">View</span>
                </a>
              </div>

              <div class="menu-separator"></div>

              <div class="menu-item">
                <a class="menu-link edit-coupon-btn" href="#" data-code="${code}">
                  <span class="menu-icon"><i class="ki-filled ki-pencil"></i></span>
                  <span class="menu-title">Edit</span>
                </a>
              </div>

              <div class="menu-separator"></div>

              <div class="menu-item">
                <a class="menu-link delete-coupon-btn" href="#" data-code="${code}">
                  <span class="menu-icon"><i class="ki-filled ki-trash"></i></span>
                  <span class="menu-title">Remove</span>
                </a>
              </div>

            </div>
          </div>
        </div>
      `;
    }

    // ---- EVENTS: selection ----
    $(document).on('change', '.row-check', function () {
      const code = String($(this).data('code') || '');
      if (!code) return;

      if (this.checked) selectedCodes.add(code);
      else selectedCodes.delete(code);

      setHeaderCheckboxState();
      updateSelectedCount();
    });

    $selectAll.on('change', function () {
      const check = this.checked;
      rowsByCode.forEach((_, code) => {
        const $cb = $tbody.find(`.row-check[data-code="${CSS.escape(code)}"]`);
        if ($cb.length) {
          $cb.prop('checked', check);
          if (check) selectedCodes.add(code);
          else selectedCodes.delete(code);
        }
      });
      setHeaderCheckboxState();
      updateSelectedCount();
    });

    // ---- EVENTS: pagination/perpage/search/filter ----
    $pagination.on('click', 'button', function () {
        const key = $(this).data('key');
        const page = parseInt($(this).data('page'), 10) || 1;

        const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));

        if (key === 'first') currentPage = 1;
        else if (key === 'prev') currentPage = Math.max(1, currentPage - 1);
        else if (key === 'next') currentPage = Math.min(totalPages, currentPage + 1);
        else if (key === 'last') currentPage = totalPages;
        else currentPage = page;
        clearSelections(); // ✅ add
        fetchCoupons();
    });


    $perPageSelect.on('change', function () {
        itemsPerPage = parseInt($(this).val(), 10) || 10;
        currentPage = 1;
        clearSelections(); // ✅ add
        fetchCoupons();
    });

    let searchDebounce;
    $searchInput.on('keyup', function () {
        clearTimeout(searchDebounce);
        searchDebounce = setTimeout(() => {
            searchTerm = $(this).val() || '';
            currentPage = 1;
            clearSelections(); // ✅ ADD THIS
            fetchCoupons();
        }, 250);
    });

    let userSearchDebounce;
    $userSearchInput.on('keyup', function () {
        clearTimeout(userSearchDebounce);
        userSearchDebounce = setTimeout(() => {
            userSearchTerm = $(this).val() || '';
            currentPage = 1;
            clearSelections(); // ✅ ADD THIS
            fetchCoupons();
        }, 250);
    });

    $activeOnlySwitch.on('change', function () {
        activeOnly = $(this).is(':checked');
        currentPage = 1;
        clearSelections(); // ✅ ADD THIS
        fetchCoupons();
    });


    // ---- BULK ACTIONS ----
    $applyBulkAction.on('click', function () {
      const action = $bulkActionSelect.val();
      if (!action) return Swal.fire({ icon:'info', title:'Select an action' });
      if (selectedCodes.size === 0) return Swal.fire({ icon:'info', title:'No selection' });

      const ids = Array.from(selectedCodes);

      if (action === 'csv') {
        const rows = buildExportRows(ids);
        downloadCSV(rows, 'coupons.csv');
      } else if (action === 'excel') {
        const rows = buildExportRows(ids);
        downloadXLSX(rows, 'coupons.xlsx');
      } else if (action === 'delete') {
        bulkDelete(ids);
      }
    });

    function buildExportRows(codes) {
      const out = [];
      codes.forEach(code => {
        const row = rowsByCode.get(code) || allCoupons.find(x => String(x.coupon_code) === String(code));
        if (!row) return;

        const dtype = String(safe(row.discount_type,'percentage')).toLowerCase();
        const dval = safe(row.discount_value,0);
        out.push({
          coupon_code: safe(row.coupon_code),
          user_id: row.user_id === null ? '' : safe(row.user_id),
          discount_type: dtype,
          discount_value: dval,
          count: safe(row.count, 0),
          status: safe(row.status, ''),
          validity: safe(row.validity, ''),
        });
      });
      return out;
    }

    function downloadCSV(rows, filename) {
      if (!rows.length) return Swal.fire({ icon:'info', title:'Nothing to export' });

      const headers = Object.keys(rows[0]);
      const esc = (v) => {
        if (v === null || v === undefined) return '';
        const s = String(v).replace(/"/g, '""');
        return /[",\n]/.test(s) ? `"${s}"` : s;
      };

      const csv = [
        headers.join(','),
        ...rows.map(r => headers.map(h => esc(r[h])).join(','))
      ].join('\n');

      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const url  = URL.createObjectURL(blob);
      const a    = document.createElement('a');
      a.href = url;
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      URL.revokeObjectURL(url);
    }

    function downloadXLSX(rows, filename) {
      if (!rows.length) return Swal.fire({ icon:'info', title:'Nothing to export' });

      const ws = XLSX.utils.json_to_sheet(rows);
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, 'Coupons');
      XLSX.writeFile(wb, filename);
    }

    function bulkDelete(codes) {
        Swal.fire({
            title: `Delete ${codes.length} coupon(s)?`,
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
        }).then((res) => {
            if (!res.isConfirmed) return;

            const reqs = codes.map(code => {
            const row = rowsByCode.get(code) || allCoupons.find(x => String(x.coupon_code) === String(code));
            const id  = row?._id || row?.id;

            if (!id) {
                return Promise.resolve({ code, ok: false, msg: 'Missing id' });
            }

            return $.ajax({
                url: API_DELETE(id),
                type: 'DELETE',
                headers: { 'Authorization': `Bearer ${token}` }
            }).then(
                () => ({ code, ok: true }),
                (xhr) => ({ code, ok: false, msg: xhr?.responseJSON?.message || 'Failed' })
            );
            });

            Promise.all(reqs).then(results => {
            const failed = results.filter(r => !r.ok);

            results.forEach(r => {
                if (r.ok) selectedCodes.delete(String(r.code));
            });

            if (failed.length) {
                Swal.fire({
                icon: 'warning',
                title: 'Partial success',
                text: `${results.length - failed.length} deleted, ${failed.length} failed. ${failed[0].msg || ''}`
                }).then(() => fetchCoupons());
            } else {
                Swal.fire({ icon: 'success', title: 'Deleted', text: 'Coupons deleted successfully.' })
                .then(() => fetchCoupons());
            }
            });
        });
    }


    // ---- VIEW ----
    $(document).on('click', '.view-coupon-btn', function (e) {
      e.preventDefault();
      const code = String($(this).data('code') || '');
      if (!code) return;

      const c = rowsByCode.get(code) || allCoupons.find(x => String(x.coupon_code) === code);
      if (!c) return Swal.fire({ icon:'error', title:'Not found' });

      const dtype = String(safe(c.discount_type,'percentage')).toLowerCase();
      const discountText = (dtype === 'percentage') ? `${safe(c.discount_value,0)}%` : `₹${safe(c.discount_value,0)}`;

      Swal.fire({
        title: `Coupon: ${code}`,
        width: 700,
        customClass: { popup: 'swal2-my-small-popup' },
        html: `
          <div class="swal2-grid">
            <div class="swal2-field">
              <label>User</label>
              <input type="text" value="${
                (c.user_id===null||c.user_id===undefined)
                    ? 'All Users'
                    : (c.user_name ? `${c.user_name} (ID: ${c.user_id})` : `User ID: ${c.user_id}`)
                }" readonly>
            </div>
            <div class="swal2-field">
              <label>Status</label>
              <input type="text" value="${safe(c.status,'—')}" readonly>
            </div>

            <div class="swal2-field">
              <label>Discount</label>
              <input type="text" value="${discountText}" readonly>
            </div>
            <div class="swal2-field">
              <label>Count</label>
              <input type="text" value="${safe(c.count,0)}" readonly>
            </div>

            <div class="swal2-field" style="grid-column: span 2;">
              <label>Validity</label>
              <input type="text" value="${formatIST(c.validity, true)}" readonly>
            </div>
          </div>
        `,
        confirmButtonText: 'Close'
      });
    });

    // ---- EDIT ----
    $(document).on('click', '.edit-coupon-btn', function (e) {
      e.preventDefault();
      const code = String($(this).data('code') || '');
      if (!code) return;

      const c = rowsByCode.get(code) || allCoupons.find(x => String(x.coupon_code) === code);
      if (!c) return Swal.fire({ icon:'error', title:'Not found' });

      const id = c?._id || c?.id;
      if (!id) return Swal.fire({ icon:'error', title:'Missing ID', text:'Coupon id not found in response.' });


      Swal.fire({
        title: `Edit Coupon`,
        width: 700,
        customClass: {
          popup: 'swal2-my-small-popup',
          confirmButton: 'swal2-confirm-btn',
          cancelButton: 'swal2-cancel-btn',
        },
        html: `
          <div class="swal2-grid">
            <div class="swal2-field" style="grid-column: span 2;">
              <label>Coupon Code</label>
              <input id="swal_code" type="text" value="${safe(c.coupon_code,'')}" readonly>
            </div>

            <div class="swal2-field">
                <label>Discount Type</label>
                <select id="swal_dtype">
                    <option value="percentage" ${String(c.discount_type).toLowerCase()==='percentage'?'selected':''}>percentage</option>
                    <option value="price" ${String(c.discount_type).toLowerCase()==='price'?'selected':''}>price</option>
                </select>
            </div>

            <div class="swal2-field">
              <label>Discount Value</label>
              <input id="swal_dval" type="number" value="${safe(c.discount_value,0)}">
            </div>

            <div class="swal2-field">
              <label>Count</label>
              <input id="swal_count" type="number" value="${safe(c.count,0)}">
            </div>

            <div class="swal2-field">
              <label>Status</label>
              <select id="swal_status">
                <option value="active" ${String(c.status).toLowerCase()==='active'?'selected':''}>active</option>
                <option value="inactive" ${String(c.status).toLowerCase()==='inactive'?'selected':''}>inactive</option>
              </select>
            </div>

            <div class="swal2-field" style="grid-column: span 2;">
              <label>Validity (YYYY-MM-DD)</label>
              <input id="swal_validity" type="date" value="${(c.validity ? new Date(c.validity).toISOString().slice(0,10) : '')}">
            </div>
          </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Update',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
          const discount_type  = $('#swal_dtype').val();
          const discount_value = parseFloat($('#swal_dval').val() || 0);
          const count          = parseInt($('#swal_count').val() || 0, 10);
          const status         = $('#swal_status').val();
          const validity_date  = $('#swal_validity').val(); // YYYY-MM-DD

          if (!validity_date) {
            Swal.showValidationMessage('Please select validity date');
            return false;
          }

          return {
            discount_type,
            discount_value,
            count,
            status,
            validity: validity_date
          };
        }
      }).then((res) => {
        if (!res.isConfirmed) return;
        const payload = res.value; // ✅ coming from preConfirm()
        $.ajax({
            url: API_UPDATE(id),
            type: "POST", // keep POST if your backend uses POST
            headers: { Authorization: `Bearer ${token}` },
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(payload), // ✅ send ALL fields
            success: (data) => {
            Swal.fire({ icon:'success', title:'Updated', text: data?.message || 'Coupon updated.' })
                .then(() => {
                // ✅ reload current page (don’t reset page)
                fetchCoupons();
                });
            },
            error: (xhr) => {
            Swal.fire({ icon:'error', title:'Error', text: xhr?.responseJSON?.message || 'Unable to update coupon.' });
            }
        });

      });
    });

    // ---- DELETE SINGLE ----
    $(document).on('click', '.delete-coupon-btn', function (e) {
      e.preventDefault();
      const code = String($(this).data('code') || '');
      if (!code) return;

      Swal.fire({
        title: `Delete coupon ${code}?`,
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
      }).then((result) => {
        if (!result.isConfirmed) return;

        const c = rowsByCode.get(code) || allCoupons.find(x => String(x.coupon_code) === code);
        const id = c?._id || c?.id;

        if (!id) return Swal.fire({ icon:'error', title:'Missing ID', text:'Coupon id not found in response.' });

        $.ajax({
            url: API_DELETE(id),
            type: "DELETE",
            headers: { 'Authorization': `Bearer ${token}` },
            success: (data) => {
                selectedCodes.delete(code);
                Swal.fire({ icon:'success', title:'Deleted', text: data?.message || 'Coupon deleted.' })
                .then(() => fetchCoupons());
            },
            error: (xhr) => {
                Swal.fire({ icon:'error', title:'Error', text: xhr?.responseJSON?.message || 'Unable to delete coupon.' });
            }
        });

      });
    });

    // ✅ expose refresh globally (so other scripts can call after add/update/delete)
    window.refreshCoupons = function (resetToFirstPage = true) {
        if (resetToFirstPage) currentPage = 1;

        selectedCodes.clear();
        updateSelectedCount();
        $selectAll.prop('checked', false).prop('indeterminate', false);

        fetchCoupons();
    };

    // ---- INITIAL LOAD ----
    fetchCoupons();
  });
})(jQuery);
</script>

<!-- Add coupon -->
<script>
(function ($) {
  $(function () {

    const token = localStorage.getItem('auth_token') || '';
    const BASE_URL = (window.APP_CONFIG && window.APP_CONFIG.BASE_URL) || '';

    // ✅ APIs
    const API_USERS = `${BASE_URL}/all_users`;          // POST
    const API_STORE = `${BASE_URL}/coupons/create`;      // POST

    // ---- Load users once and cache ----
    let USERS_CACHE = null;

    async function loadUsers() {
      if (USERS_CACHE) return USERS_CACHE;

      try {
        const res = await $.ajax({
          url: API_USERS,
          type: "POST",
          headers: { Authorization: `Bearer ${token}` },
          contentType: "application/json; charset=utf-8",
          data: JSON.stringify({}) // if your API needs payload, put it here
        });

        const users = res?.data || [];
        USERS_CACHE = Array.isArray(users) ? users : [];
        return USERS_CACHE;

      } catch (e) {
        console.error("Users fetch failed", e);
        USERS_CACHE = [];
        return USERS_CACHE;
      }
    }

    function usersOptionsHtml(users) {
      // first option = All users (null)
      let html = `<option value="">Select Users</option>`;
      users.forEach(u => {
        const id = u?.id;
        const name = u?.name || '';
        const email = u?.email || '';
        html += `<option value="${id}">${name} (${email})</option>`;
      });
      return html;
    }

    // ---- Add Coupon Popup ----
    $(document).on('click', '#addCouponBtn', async function () {
      const users = await loadUsers();

      Swal.fire({
        title: 'Add Coupon',
        width: 750,
        customClass: {
          popup: 'swal2-my-small-popup',
          confirmButton: 'swal2-confirm-btn',
          cancelButton: 'swal2-cancel-btn',
        },
        html: `
          <div class="swal2-grid">

            <div class="swal2-field" style="grid-column: span 2;">
              <label>Coupon Code</label>
              <input id="add_coupon_code" type="text" placeholder="e.g. NEWYEAR100">
            </div>

            <div class="swal2-field" style="grid-column: span 2;">
              <label>User (optional)</label>
              <select id="add_user_id">
                ${usersOptionsHtml(users)}
              </select>
            </div>

            <div class="swal2-field">
              <label>Discount Type</label>
              <select id="add_discount_type">
                <option value="percentage" selected>Percentage</option>
                <option value="price">Flat Price</option>
              </select>
            </div>

            <div class="swal2-field">
              <label>Discount Value</label>
              <input id="add_discount_value" type="number" min="0" step="0.01" value="10">
            </div>

            <div class="swal2-field">
              <label>Count</label>
              <input id="add_count" type="number" min="0" step="1" value="50">
            </div>

            <div class="swal2-field">
              <label>Status</label>
              <select id="add_status">
                <option value="active" selected>active</option>
                <option value="inactive">inactive</option>
              </select>
            </div>

            <div class="swal2-field" style="grid-column: span 2;">
              <label>Validity (YYYY-MM-DD)</label>
              <input id="add_validity" type="date">
            </div>

          </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Create',
        cancelButtonText: 'Cancel',
        didOpen: () => {
          // set default date = today + 7 days (optional)
          const d = new Date();
          d.setDate(d.getDate() + 7);
          const yyyy = d.getFullYear();
          const mm = String(d.getMonth() + 1).padStart(2, '0');
          const dd = String(d.getDate()).padStart(2, '0');
          $('#add_validity').val(`${yyyy}-${mm}-${dd}`);
            // ✅ Make user select searchable using select2 (inside swal)
            const $sel = $('#add_user_id');

            // destroy if already initialized
            if ($sel.hasClass("select2-hidden-accessible")) {
                $sel.select2('destroy');
            }

            $sel.select2({
                dropdownParent: $('.swal2-popup'),
                width: '100%',
                placeholder: 'Select Users',
                allowClear: true
            });
        },
        preConfirm: () => {
          const coupon_code = ($('#add_coupon_code').val() || '').trim();
          const user_id_raw = ($('#add_user_id').val() || '').trim();
          const discount_type = ($('#add_discount_type').val() || 'percentage').trim();
          const discount_value = parseFloat($('#add_discount_value').val() || 0);
          const count = parseInt($('#add_count').val() || 0, 10);
          const validity = ($('#add_validity').val() || '').trim();
          const status = ($('#add_status').val() || 'active').trim();

          if (!coupon_code) {
            Swal.showValidationMessage('Coupon Code is required');
            return false;
          }
          if (!validity) {
            Swal.showValidationMessage('Validity date is required');
            return false;
          }
          if (!discount_type) {
            Swal.showValidationMessage('Discount type is required');
            return false;
          }
          if (isNaN(discount_value) || discount_value < 0) {
            Swal.showValidationMessage('Discount value must be >= 0');
            return false;
          }
          if (isNaN(count) || count < 0) {
            Swal.showValidationMessage('Count must be >= 0');
            return false;
          }

          // Build payload exactly as you described
          const payload = {
            coupon_code,
            user_id: (!user_id_raw || String(user_id_raw).trim() === '') ? null : parseInt(user_id_raw, 10),
            discount_type,
            discount_value,
            count,
            validity,
            status
          };

          return payload;
        }
      }).then(async (result) => {
        if (!result.isConfirmed) return;

        try {
          const payload = result.value;

          const res = await $.ajax({
            url: API_STORE,
            type: "POST",
            headers: { Authorization: `Bearer ${token}` },
            contentType: "application/json; charset=utf-8",
            data: JSON.stringify(payload)
          });

          Swal.fire({
            icon: 'success',
            title: 'Created',
            text: res?.message || 'Coupon created successfully!'
          }).then(() => {
            // refresh list
            if (typeof window.refreshCoupons === "function") window.refreshCoupons(true);

          });

        } catch (xhr) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: xhr?.responseJSON?.message || 'Unable to create coupon.'
          });
        }
      });

    });

  });
})(jQuery);
</script>

<?php include("footer1.php"); ?>
