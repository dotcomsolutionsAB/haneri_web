<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>

<?php 
  $current_page = "Show Discounts";
?>
<?php include("header1.php"); ?>
<style>
    .header-controls { row-gap: .5rem; }
    .header-bulk { border-left: 1px solid #e5e7eb; padding-left: .75rem; }
    @media (max-width: 640px) {
    .header-bulk { border-left: 0; padding-left: 0; width: 100%; }
    }

    /* Bulk toolbar */
    .bulk-toolbar {
    border: 1px solid #e5e7eb; /* gray-200 */
    border-radius: .5rem;
    background: #fff;
    }

    /* SweetAlert custom sizing */
    .swal2-my-small-popup { 
    font-size: 0.85rem;
    line-height: 1.2;
    }
    .swal2-wide-and-short {
    width: 700px !important;
    max-width: none !important;
    padding: 20px 30px !important;
    }
    .swal2-wide-and-short .swal2-html-container {
    margin: 10px 0 !important;
    }
    .swal2-wide-and-short .swal2-actions {
    margin-top: 12px !important;
    }

    /* Edit popup grid */
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
    .swal2-field input {
    padding: 6px 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 13px;
    width: 100%;
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
    /* Pagination */
    .pagination .active {
    outline: 2px solid #111827; /* gray-900 */
    }
    .pagination .opacity-50 {
    opacity: .5;
    }

</style>
<!-- Expose BASE_URL to JS -->
<script>
  window.APP_CONFIG = {
    BASE_URL: "<?php echo BASE_URL; ?>"
  };
</script>

<!-- SheetJS for Excel export -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<main class="grow content pt-5" id="content" role="content">
  <div class="container-fixed" id="content_container"></div>

  <div class="container-fixed">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
      <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">Discounts</h1>
      </div>
      <div class="flex items-center gap-2.5">
        <a class="btn btn-sm btn-primary" href="pages/add_discount.php">Add Discounts</a>
      </div>
    </div>
  </div>

  <div class="container-fixed">
    <div class="grid gap-5 lg:gap-7.5">
      <div class="card card-grid min-w-full">
        <div class="card-header py-5 flex-wrap gap-3 justify-between items-center">
          <h3 class="card-title">
            Overview of <span id="count-discounts">0</span> Discounts
          </h3>

          <!-- Right controls group -->
          <div class="flex flex-wrap items-center gap-3 header-controls">
            <!-- Search -->
            <div class="relative">
              <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
              <input id="discountSearch" class="input input-sm pl-8" placeholder="Search Discounts By User Name" type="text" />
            </div>

            <!-- Active-only -->
            <label class="switch switch-sm">
              <input class="order-2" id="activeOnlySwitch" type="checkbox" value="1" />
              <span class="switch-label order-1">Active Discounts</span>
            </label>

            <!-- Bulk actions (moved beside search) -->
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
              <table class="table table-border" id="discount-table">
                <thead>
                  <tr>
                    <th class="w-[60px] text-center">
                      <input id="selectAll" class="checkbox checkbox-sm" type="checkbox" />
                    </th>
                    <th class="min-w-[300px]">
                      <span class="sort asc">
                        <span class="sort-label text-gray-700 font-normal">User Name</span>
                        <span class="sort-icon"></span>
                      </span>
                    </th>
                    <th class="text-gray-700 font-normal min-w-[220px]">Product-Variant</th>
                    <th class="text-gray-700 font-normal min-w-[220px]">Category</th>
                    <th class="min-w-[165px]">
                      <span class="sort">
                        <span class="sort-label text-gray-700 font-normal">Discount</span>
                        <span class="sort-icon"></span>
                      </span>
                    </th>
                    <th class="w-[60px]"></th>
                  </tr>
                </thead>
                <tbody><!-- rows injected by JS --></tbody>
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
    // Requires jQuery + SweetAlert2 + SheetJS (xlsx)
(function ($) {
  $(function () {
    const token = localStorage.getItem('auth_token') || '';
    const BASE_URL = (window.APP_CONFIG && window.APP_CONFIG.BASE_URL) || '';

    // ---- STATE ----
    let itemsPerPage = 10;
    let currentPage  = 1;
    let totalItems   = 0;
    let searchTerm   = '';
    let activeOnly   = false;

    // Persist selected IDs across pages
    const selectedIds = new Set();
    // Keep current page rows in a map for export
    const rowsById = new Map();

    // ---- ELEMENTS ----
    const $searchInput      = $('#discountSearch');
    const $perPageSelect    = $('#perPageSelect');
    const $tbody            = $('#discount-table tbody');
    const $pagination       = $('#pagination');
    const $count            = $('#count-discounts');
    const $info             = $('#datatableInfo');
    const $activeOnlySwitch = $('#activeOnlySwitch');
    const $selectAll        = $('#selectAll');

    const $bulkActionSelect = $('#bulkActionSelect');
    const $applyBulkAction  = $('#applyBulkAction');
    const $selectedCount    = $('#selectedCount');

    // ---- INIT per-page options ----
    [5, 10, 25, 50, 100].forEach(size => {
      $perPageSelect.append(`<option value="${size}">${size}</option>`);
    });
    $perPageSelect.val(itemsPerPage);

    // ---- HELPERS ----
    function safe(val, fallback = '') {
      return (val === null || val === undefined || val === '') ? fallback : val;
    }
    function updateSelectedCount() {
      $selectedCount.text(`${selectedIds.size} selected`);
    }
    function setHeaderCheckboxState() {
      // set header checkbox checked if all visible rows are selected
      const visibleIds = Array.from(rowsById.keys());
      if (!visibleIds.length) {
        $selectAll.prop('checked', false).prop('indeterminate', false);
        return;
      }
      const allSelected = visibleIds.every(id => selectedIds.has(id));
      const noneSelected = visibleIds.every(id => !selectedIds.has(id));
      $selectAll.prop('checked', allSelected);
      $selectAll.prop('indeterminate', !allSelected && !noneSelected);
    }

    function ordinalSuffix(n) {
        const s = ["th","st","nd","rd"], v = n % 100;
        return n + (s[(v-20)%10] || s[v] || s[0]);
    }
    function formatIST(dateStr, withTime = true) {
    if (!dateStr) return '—';
    // Parse; supports "2025-11-08T14:12:57.000000Z" or "YYYY-MM-DD HH:mm:ss"
    const d = new Date(dateStr);
    // Pieces in IST
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

    // Hour/Minute/AMPM
    const hour   = get('hour');
    const minute = get('minute');
    const dayPeriod = get('dayPeriod')?.toUpperCase() || '';
    return `${dayWithOrd} ${month} ${year}, ${hour}:${minute} ${dayPeriod} IST`;
    }

    // ---- FETCH (reads meta.limit/offset/total/has_more) ----
    function fetchDiscounts() {
      const offset = (currentPage - 1) * itemsPerPage;

      const payload = {
        limit: itemsPerPage,
        offset: offset
      };
      if (searchTerm.trim().length >= 3) payload.user_name   = searchTerm.trim();
      if (activeOnly)                      payload.only_active = 1;
      // If you need product-based search sometimes:
      // payload.product_name = '...';

      $.ajax({
        url: `${BASE_URL}/discount/fetch`,
        type: 'POST',
        headers: { Authorization: `Bearer ${token}` },
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify(payload),
        success: (response) => {
          const rows = response?.data || [];
          const meta = response?.meta || {};

          // Sync state from meta
          itemsPerPage = Number(meta.limit  ?? itemsPerPage);
          const apiOff = Number(meta.offset ?? 0);
          totalItems   = Number(meta.total  ?? (rows.length || 0));
          const hasMore = Boolean(meta.has_more);

          // Derive current page from offset
          currentPage = Math.floor(apiOff / itemsPerPage) + 1;

          renderTable(rows);
          renderPagination({ totalItems, itemsPerPage, currentPage, hasMore });
          renderInfo({ totalItems, itemsPerPage, currentPage });

          // After render, sync header checkbox and selected count
          setHeaderCheckboxState();
          updateSelectedCount();
        },
        error: (err) => {
          console.error('Fetch error:', err);
          $tbody.html(`<tr><td colspan="6" class="text-center text-red-600">Failed to load discounts.</td></tr>`);
          $count.text('0');
          $pagination.empty();
          $info.text('');
          rowsById.clear();
          setHeaderCheckboxState();
          updateSelectedCount();
        }
      });
    }

    // ---- RENDER: Table ----
    function renderTable(data) {
      rowsById.clear();
      $tbody.empty();

      if (!data.length) {
        $tbody.append('<tr><td colspan="6" class="text-center">No Discounts found</td></tr>');
        return;
      }

      data.forEach(discount => {
        const id = String(safe(discount?.id, ''));
        if (id) rowsById.set(id, discount);

        const userName    = safe(discount?.user?.name, 'Unknown User');
        const userEmail   = safe(discount?.user?.email, 'No Email');
        const userRole    = safe(discount?.user?.role, 'No Role Selected');
        const photoUrl    = safe(discount?.photo, '../../images/default/df001.png');

        const productName = safe(discount?.product_variant?.product?.name, 'Unknown Product');
        const variantVal  = safe(discount?.product_variant?.variant_value, 'Unknown Variant');
        const category    = safe(discount?.category?.name, 'No Category');
        const disVal      = safe(discount?.discount, 'NA');

        const checkedAttr = selectedIds.has(id) ? 'checked' : '';

        $tbody.append(`
          <tr>
            <td class="text-center">
              <input class="checkbox checkbox-sm row-check" type="checkbox" data-id="${id}" ${checkedAttr}>
            </td>
            <td>
              <div class="flex items-center gap-2.5">
                <div><img class="h-9 rounded-full" src="${photoUrl}" /></div>
                <div class="flex flex-col gap-0.5">
                  <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary" href="#">${userName}</a>
                  <span class="text-xs text-gray-700 font-normal">${userEmail}</span>
                  <span class="badge badge-sm badge-light badge-outline">Role : ${userRole}</span>
                </div>
              </div>
            </td>
            <td>
              <span class="badge badge-sm badge-light badge-outline">${productName} - ${variantVal}</span>
            </td>
            <td>${category}</td>
            <td>
              <span class="badge badge-sm badge-light badge-outline">${disVal} %</span>
            </td>
            <td class="w-[60px]">
              ${generateActionButtons(discount)}
            </td>
          </tr>
        `);
      });
    }

    // ---- RENDER: Info text ----
    function renderInfo({ totalItems, itemsPerPage, currentPage }) {
      const start = totalItems ? ((currentPage - 1) * itemsPerPage + 1) : 0;
      const end   = Math.min(currentPage * itemsPerPage, totalItems);
      $info.text(`Showing ${start}-${end} of ${totalItems}`);
      $count.text(String(totalItems));
    }

    // ---- RENDER: Pagination ----
    function renderPagination({ totalItems, itemsPerPage, currentPage, hasMore }) {
      const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));
      $pagination.empty();

      const makeBtn = (label, page, opts = {}) => {
        const { disabled = false, active = false, key = '' } = opts;
        const classes = ['btn','btn-sm'];
        if (active)   classes.push('active');
        if (disabled) classes.push('opacity-50', 'cursor-not-allowed');
        const dataKey = key ? `data-key="${key}"` : '';
        return `<button class="${classes.join(' ')}" data-page="${page}" ${dataKey} ${disabled ? 'disabled' : ''}>${label}</button>`;
      };

      // First & Prev
      $pagination.append(makeBtn('First', 1, { disabled: currentPage <= 1, key: 'first' }));
      $pagination.append(makeBtn('Previous', Math.max(1, currentPage - 1), { disabled: currentPage <= 1, key: 'prev' }));

      // Page window
      const windowSize = 5;
      let start = Math.max(1, currentPage - Math.floor(windowSize / 2));
      let end   = start + windowSize - 1;
      if (end > totalPages) {
        end = totalPages;
        start = Math.max(1, end - windowSize + 1);
      }

      for (let p = start; p <= end; p++) {
        $pagination.append(makeBtn(String(p), p, { active: p === currentPage }));
      }

      // Next & Last
      const canNext = currentPage < totalPages || hasMore; // defensive use of has_more
      $pagination.append(makeBtn('Next', currentPage + 1, { disabled: !canNext, key: 'next' }));
      $pagination.append(makeBtn('Last', totalPages, { disabled: currentPage >= totalPages, key: 'last' }));
    }

    // ---- GENERATE: Row action menu ----
    function generateActionButtons(discount) {
      const id    = safe(discount?.id, '');
      const pName = safe(discount?.product_variant?.product?.name, '');
      return `
        <div class="menu" data-menu="true">
          <div class="menu-item menu-item-dropdown" data-menu-item-offset="0, 10px"
               data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start"
               data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
            <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
              <i class="ki-filled ki-dots-vertical"></i>
            </button>
            <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                <!-- NEW: View -->
                <div class="menu-item">
                    <a class="menu-link view-discount-btn" href="#" data-discount-id="${id}">
                    <span class="menu-icon"><i class="ki-filled ki-eye"></i></span>
                    <span class="menu-title">View</span>
                    </a>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-item">
                    <a class="menu-link edit-discount-btn" href="#" 
                    data-discount-id="${id}" data-product-name="${pName}">
                    <span class="menu-icon"><i class="ki-filled ki-pencil"></i></span>
                    <span class="menu-title">Edit</span>
                    </a>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-item">
                    <a class="menu-link delete-discount-btn" href="#" data-discount-id="${id}">
                    <span class="menu-icon"><i class="ki-filled ki-trash"></i></span>
                    <span class="menu-title">Remove</span>
                    </a>
                </div>
            </div>
          </div>
        </div>`;
    }

    // ---- EVENTS: Row checkbox click ----
    $(document).on('change', '.row-check', function () {
      const id = String($(this).data('id'));
      if (!id) return;
      if (this.checked) selectedIds.add(id);
      else selectedIds.delete(id);
      setHeaderCheckboxState();
      updateSelectedCount();
    });

    // ---- EVENTS: Header select-all ----
    $selectAll.on('change', function () {
      const check = this.checked;
      rowsById.forEach((_, id) => {
        const $rowCb = $tbody.find(`.row-check[data-id="${id}"]`);
        if ($rowCb.length) {
          $rowCb.prop('checked', check);
          if (check) selectedIds.add(id);
          else selectedIds.delete(id);
        }
      });
      setHeaderCheckboxState();
      updateSelectedCount();
    });

    // ---- EVENTS: Pagination click ----
    $pagination.on('click', 'button', function () {
      const key = $(this).data('key');       // 'first' | 'prev' | 'next' | 'last' | undefined
      const pageAttr = $(this).data('page'); // number
      const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage));

      let targetPage = currentPage;

      if (key === 'first')      targetPage = 1;
      else if (key === 'prev')  targetPage = Math.max(1, currentPage - 1);
      else if (key === 'next')  targetPage = Math.min(totalPages, currentPage + 1);
      else if (key === 'last')  targetPage = totalPages;
      else if (pageAttr)        targetPage = parseInt(pageAttr, 10) || 1;

      if (targetPage === currentPage) return;

      currentPage = targetPage;
      fetchDiscounts();
    });

    // ---- EVENTS: Per-page change ----
    $perPageSelect.on('change', function () {
      itemsPerPage = parseInt($(this).val(), 10) || 10;
      currentPage  = 1; // reset to first page when page size changes
      fetchDiscounts();
    });

    // ---- EVENTS: Search (debounced, uses user_name) ----
    let searchDebounce;
    $searchInput.on('keyup', function () {
      clearTimeout(searchDebounce);
      searchDebounce = setTimeout(() => {
        searchTerm = $(this).val() || '';
        currentPage = 1;
        fetchDiscounts();
      }, 300);
    });

    // ---- EVENTS: Active-only filter ----
    $activeOnlySwitch.on('change', function () {
      activeOnly = $(this).is(':checked');
      currentPage = 1;
      fetchDiscounts();
    });

    // ---- BULK ACTIONS ----
    $applyBulkAction.on('click', function () {
      const action = $bulkActionSelect.val();
      if (!action) {
        Swal.fire({ icon: 'info', title: 'Select an action', text: 'Please choose CSV, Excel, or Delete.' });
        return;
      }
      if (selectedIds.size === 0) {
        Swal.fire({ icon: 'info', title: 'No selection', text: 'Please select at least one row.' });
        return;
      }

      if (action === 'csv') {
        const rows = buildExportRows(Array.from(selectedIds));
        downloadCSV(rows, 'discounts.csv');
      } else if (action === 'excel') {
        const rows = buildExportRows(Array.from(selectedIds));
        downloadXLSX(rows, 'discounts.xlsx');
      } else if (action === 'delete') {
        bulkDelete(Array.from(selectedIds));
      }
    });

    function buildExportRows(ids) {
      // Try to use current cache; for ids not in current page we will fetch minimal info from API? 
      // Here we export only those present in cache (visible/visited). If needed, you can add a bulk fetch.
      const out = [];
      ids.forEach(id => {
        const row = rowsById.get(String(id));
        if (!row) return; // skip if not in current cache
        out.push({
          id: safe(row.id),
          user_name: safe(row?.user?.name),
          user_email: safe(row?.user?.email),
          user_role: safe(row?.user?.role),
          product: safe(row?.product_variant?.product?.name),
          variant: safe(row?.product_variant?.variant_value),
          category: safe(row?.category?.name),
          discount: safe(row?.discount)
        });
      });
      return out;
    }

    function downloadCSV(rows, filename) {
      if (!rows.length) {
        Swal.fire({ icon: 'info', title: 'Nothing to export', text: 'Selected rows not on this page.' });
        return;
      }
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
      if (!rows.length) {
        Swal.fire({ icon: 'info', title: 'Nothing to export', text: 'Selected rows not on this page.' });
        return;
      }
      const ws = XLSX.utils.json_to_sheet(rows);
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, 'Discounts');
      XLSX.writeFile(wb, filename);
    }

    function bulkDelete(ids) {
      Swal.fire({
        title: `Delete ${ids.length} item(s)?`,
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
      }).then((res) => {
        if (!res.isConfirmed) return;

        // Fire deletes in parallel, then refetch
        const reqs = ids.map(id => $.ajax({
          url: `${BASE_URL}/discount/${id}`,
          type: 'DELETE',
          headers: { 'Authorization': `Bearer ${token}` }
        }).then(
          () => ({ id, ok: true }),
          (xhr) => ({ id, ok: false, msg: xhr?.responseJSON?.message || 'Failed' })
        ));

        Promise.all(reqs).then(results => {
          const failed = results.filter(r => !r.ok);
          const success = results.length - failed.length;

          // Clean selected set for the successfully deleted ids
          results.forEach(r => { if (r.ok) selectedIds.delete(String(r.id)); });

          if (failed.length) {
            const firstErr = failed[0].msg || 'Some deletions failed.';
            Swal.fire({
              icon: 'warning',
              title: 'Partial success',
              text: `${success} deleted, ${failed.length} failed. ${firstErr}`
            }).then(() => fetchDiscounts());
          } else {
            Swal.fire({
              icon: 'success',
              title: 'Deleted',
              text: `${success} item(s) deleted successfully.`
            }).then(() => fetchDiscounts());
          }
        });
      });
    }

    // ---- DELETE single ----
    $(document).on('click', '.delete-discount-btn', function (e) {
      e.preventDefault();
      const discountId = $(this).data('discount-id');
      if (!discountId) return;

      Swal.fire({
        title: 'Are you sure?',
        text: 'This action will permanently delete the discount.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        reverseButtons: true
      }).then((result) => {
        if (!result.isConfirmed) return;

        $.ajax({
          url: `${BASE_URL}/discount/${discountId}`,
          type: 'DELETE',
          headers: { 'Authorization': `Bearer ${token}` },
          success: (data) => {
            // keep selection in sync
            selectedIds.delete(String(discountId));
            Swal.fire({
              icon: 'success',
              title: 'Deleted!',
              text: data?.message || 'Discount deleted successfully!'
            }).then(() => {
              fetchDiscounts();
            });
          },
          error: (xhr) => {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: xhr?.responseJSON?.message || 'Unable to delete discount.'
            });
          }
        });
      });
    });

    // ---- EDIT ----
    $(document).on('click', '.edit-discount-btn', function (e) {
      e.preventDefault();
      const discountId = $(this).data('discount-id');
      const productNameFallback = $(this).data('product-name');

      if (!discountId) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No discount id found.' });
        return;
      }

      // Preferred: fetch by id (if API supports)
      $.ajax({
        url: `${BASE_URL}/discount/fetch`,
        type: 'POST',
        headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
        data: JSON.stringify({ id: discountId }),
        success: (res) => {
          let item = (res?.data && res.data[0]) ? res.data[0] : null;

          if (!item && productNameFallback) {
            // fallback by product_name
            $.ajax({
              url: `${BASE_URL}/discount/fetch`,
              type: 'POST',
              headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
              data: JSON.stringify({ product_name: productNameFallback }),
              success: (res2) => {
                const item2 = (res2?.data && res2.data[0]) ? res2.data[0] : null;
                if (item2) openEditPopup(item2);
                else Swal.fire({ icon: 'error', title: 'Not Found', text: 'Discount not found.' });
              },
              error: () => Swal.fire({ icon: 'error', title: 'Error', text: 'Unable to fetch discount.' })
            });
          } else if (item) {
            openEditPopup(item);
          } else {
            Swal.fire({ icon: 'error', title: 'Not Found', text: 'Discount not found.' });
          }
        },
        error: () => Swal.fire({ icon: 'error', title: 'Error', text: 'Unable to fetch discount.' })
      });
    });

    function openEditPopup(discountData) {
      const userName   = (discountData?.user?.name) || 'Unknown User';
      const product    = (discountData?.product_variant?.product?.name) || 'Unknown Product';
      const variantVal = (discountData?.product_variant?.variant_value) || 'Unknown Variant';

      Swal.fire({
        title: 'Edit Discount',
        customClass: {
          popup: 'swal2-my-small-popup',
          confirmButton: 'swal2-confirm-btn',
          cancelButton: 'swal2-cancel-btn',
        },
        html: `
          <div class="swal2-grid">
            <div class="swal2-field" style="display: none;">
              <label for="swal-dis-us-id">User ID</label>
              <input id="swal-dis-us-id" type="text" value="${safe(discountData?.user_id, '')}" readonly>
            </div>
            <div class="swal2-field" style="display: none;">
              <label for="swal-dis-var-id">Variant ID</label>
              <input id="swal-dis-var-id" type="text" value="${safe(discountData?.product_variant_id, '')}" readonly>
            </div>
            <div class="swal2-field" style="display: none;">
              <label for="swal-dis-cat-id">Category ID</label>
              <input id="swal-dis-cat-id" type="text" value="${safe(discountData?.category_id, '')}" readonly>
            </div>

            <div class="swal2-field">
              <label for="swal-user-name">User</label>
              <input id="swal-user-name" type="text" value="${userName}" readonly>
            </div>
            <div class="swal2-field">
              <label for="swal-product-name">Product</label>
              <input id="swal-product-name" type="text" value="${product}" readonly>
            </div>
            <div class="swal2-field">
              <label for="swal-variant">Variant</label>
              <input id="swal-variant" type="text" value="${variantVal}" readonly>
            </div>

            <div class="swal2-field">
              <label for="swal-dis-val">Discount (%)</label>
              <input id="swal-dis-val" type="text" value="${safe(discountData?.discount, '')}">
            </div>
          </div>
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Update',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
          const user_id            = $('#swal-dis-us-id').val().trim();
          const product_variant_id = $('#swal-dis-var-id').val().trim() || null;
          const category_id        = $('#swal-dis-cat-id').val().trim() || null;
          const discount           = $('#swal-dis-val').val().trim() || 0;
          return { user_id, product_variant_id, category_id, discount };
        }
      }).then((res) => {
        if (res.isConfirmed) {
          updateDiscount(discountData?.id, res.value);
        }
      });
    }

    function updateDiscount(discountId, payload) {
      if (!discountId) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Missing discount id.' });
        return;
      }
      $.ajax({
        url: `${BASE_URL}/discount/edit/${discountId}`,
        type: 'POST',
        headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
        data: JSON.stringify(payload),
        success: (data) => {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: data?.message || 'Discount updated successfully!'
          }).then(() => {
            fetchDiscounts();
          });
        },
        error: (xhr) => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: xhr?.responseJSON?.message || 'Unable to update Discount.'
          });
        }
      });
    }

    $(document).on('click', '.view-discount-btn', function (e) {
    e.preventDefault();
    const id = String($(this).data('discount-id') || '');
    if (!id) return;

    let item = rowsById.get(id);
    if (item) {
        openViewPopup(item);
        return;
    }

    // Fallback fetch by id if not in current page cache
    $.ajax({
        url: `${BASE_URL}/discount/fetch`,
        type: 'POST',
        headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
        data: JSON.stringify({ id }),
        success: (res) => {
        const found = (res?.data && res.data[0]) ? res.data[0] : null;
        if (found) openViewPopup(found);
        else Swal.fire({ icon: 'error', title: 'Not Found', text: 'Discount not found.' });
        },
        error: () => Swal.fire({ icon: 'error', title: 'Error', text: 'Unable to fetch discount.' })
    });
    });

    function openViewPopup(discount) {
    const id       = safe(discount?.id, '—');
    const userId   = safe(discount?.user_id, '—');
    const userName = safe(discount?.user?.name, '—');
    const userEmail= safe(discount?.user?.email, '—');
    const userRole = safe(discount?.user?.role, '—');

    const prodId   = safe(discount?.product_variant?.product?.id, '—');
    const product  = safe(discount?.product_variant?.product?.name, '—');
    const variant  = safe(discount?.product_variant?.variant_value, '—');
    const varId    = safe(discount?.product_variant_id, '—');

    const category = safe(discount?.category?.name, '—');
    const catId    = safe(discount?.category_id, '—');

    const discountVal = safe(discount?.discount, '—');

    const createdAt = formatIST(discount?.created_at, true); // “09th October 2025, 07:15 PM IST”
    const updatedAt = formatIST(discount?.updated_at, true);

    Swal.fire({
        title: `Discount #${id}`,
        width: 700,
        customClass: { popup: 'swal2-my-small-popup' },
        html: `
        <div class="swal2-grid" style="grid-template-columns: repeat(2, 1fr);">
            <div class="swal2-field">
            <label>Created At</label>
            <input type="text" value="${createdAt}" readonly>
            </div>
            <div class="swal2-field">
            <label>Updated At</label>
            <input type="text" value="${updatedAt}" readonly>
            </div>

            <div class="swal2-field">
            <label>User</label>
            <input type="text" value="${userName} (${userEmail})" readonly>
            </div>
            <div class="swal2-field">
            <label>User Role / ID</label>
            <input type="text" value="${userRole} / ${userId}" readonly>
            </div>

            <div class="swal2-field">
            <label>Product</label>
            <input type="text" value="${product} (ID: ${prodId})" readonly>
            </div>
            <div class="swal2-field">
            <label>Variant / Variant ID</label>
            <input type="text" value="${variant} / ${varId}" readonly>
            </div>

            <div class="swal2-field">
            <label>Category / ID</label>
            <input type="text" value="${category} / ${catId}" readonly>
            </div>
            <div class="swal2-field">
            <label>Discount (%)</label>
            <input type="text" value="${discountVal}" readonly>
            </div>
        </div>
        `,
        showConfirmButton: true,
        confirmButtonText: 'Close',
    });
    }


    // ---- INITIAL LOAD ----
    fetchDiscounts();
  });
})(jQuery);

</script>

<?php include("footer1.php"); ?>
