<base href="../">
<?php include("../../configs/config.php"); ?>

<?php 
    $current_page = "Show Brands"; // Dynamically set this based on the page
?>
<?php include("header1.php"); ?>
    <!-- End of Header -->
        <!-- Content -->
        <main class="grow content pt-5" id="content" role="content">
            <!-- Container -->
            <div class="container-fixed" id="content_container">
            </div>
            <!-- Container -->
            <div class="container-fixed">
                <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                    <div class="flex flex-col justify-center gap-2">
                        <h1 class="text-xl font-medium leading-none text-gray-900" id="">
                            Brands
                        </h1>
                        <!-- <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                            Overview of all Products Brand.
                        </div> -->
                    </div>
                    <div class="flex items-center gap-2.5">
                        <!-- <a class="btn btn-sm btn-light" href="#">
                            Import Brands
                        </a> -->
                        <a class="btn btn-sm btn-primary" href="pages/add_brand.php">
                            Add Brands
                        </a>
                    </div>
                </div>
            </div>
            <!-- End of Container -->
            <!-- Container -->
            <div class="container-fixed">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="card card-grid min-w-full">
                        <div class="card-header py-5 flex-wrap gap-2">
                            <h3 class="card-title">
                                Overview of <span id="count-brands">00</span>
                            </h3>
                            <div class="flex gap-6">
                                <div class="relative">
                                    <i
                                        class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3">
                                    </i>
                                    <input class="input input-sm pl-8" data-datatable-search="#b_table"
                                        placeholder="Search Brands" type="text" />
                                </div>
                                <label class="switch switch-sm">
                                    <input class="order-2" name="check" type="checkbox" value="1" />
                                    <span class="switch-label order-1">
                                        Active Brands
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div data-datatable="true" data-datatable-page-size="10">
                                <div class="scrollable-x-auto">
                                    <table class="table table-border" data-datatable-table="true" id="brands-table">
                                        <thead>
                                            <tr>
                                                <th class="w-[60px] text-center">
                                                    <input class="checkbox checkbox-sm" data-datatable-check="true"
                                                        type="checkbox" />
                                                </th>
                                                <th class="min-w-[300px]">
                                                    <span class="sort asc">
                                                        <span class="sort-label text-gray-700 font-normal">
                                                            Brand Name
                                                        </span>
                                                        <span class="sort-icon">
                                                        </span>
                                                    </span>
                                                </th>
                                                <th class="text-gray-700 font-normal min-w-[220px]">
                                                    Sort Number
                                                </th>
                                                <th class="w-[60px]">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--  -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                    <div class="flex items-center gap-2 order-2 md:order-1">
                                        Show
                                        <select class="select select-sm w-16" data-datatable-size
                                            name="perpage">
                                        </select>
                                        per page
                                    </div>
                                    <div class="flex items-center gap-4 order-1 md:order-2">
                                        <span data-datatable-info="true">
                                        </span>
                                        <div class="pagination" data-datatable-pagination="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Container -->
        </main>
        <!-- End of Content -->
<script>
    $(document).ready(function () {
        const token = localStorage.getItem('auth_token');
        let itemsPerPage = 10;
        let currentPage = 1;
        let totalItems = 0;
        let searchTerm = "";     // Will hold the search input text

        const $searchInput = $("input[data-datatable-search=\"#b_table\"]");

        window.fetchBrands = function fetchBrands() {
            const offset = (currentPage - 1) * itemsPerPage;

            // Build request data
            const requestData = {
                limit: itemsPerPage,
                offset: offset
            };
            // Include "name" in request if searchTerm >= 3
            if (searchTerm.length >= 1) {
                requestData.name = searchTerm;
            }

            $.ajax({
                url: `<?php echo BASE_URL; ?>/brands/fetch`,
                type: 'POST',
                headers: { Authorization: `Bearer ${token}` },
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(requestData), // Send limit, offset, and name (if any)
                success: (response) => {
                    if (response?.data) {
                        totalItems = response.records ?? response.count;
                        populateTable(response.data);
                        updatePagination();
                    } else {
                        console.error("Unexpected response format:", response);
                    }
                },
                error: (error) => {
                    console.error("Error fetching data:", error);
                }
            });
        };

        const populateTable = (data) => {
            const tbody = $("#brands-table tbody");
            tbody.empty();

            data.forEach((brand) => {
                tbody.append(`
                    <tr id="row-${brand.id}">
                        <td class="text-center">
                            <input class="checkbox checkbox-sm" type="checkbox" value="${brand.name}">
                        </td>
                        <td>
                            <div class="flex items-center gap-2.5">
                                <div class="">
                                    <img class="h-9 rounded-full" src="${brand.logo ? brand.logo : 'uploads/H.jpg'}" />
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary" href="#">
                                        ${brand.name}
                                    </a>
                                    <span class="text-xs text-gray-700 font-normal">
                                        ${brand.description ? brand.description : 'No description available'}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-sm badge-light badge-outline">
                                ${brand.custom_sort}
                            </span>
                        </td>
                        <td class="w-[60px]">${generateActionButtons(brand)}</td>
                    </tr>
                `);
            });
        };

        const updatePagination = () => {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const pagination = $(".pagination");
            pagination.empty();

            if (currentPage > 1) {
                pagination.append(`<button class="btn btn-sm prev-page" data-page="${currentPage - 1}">Previous</button>`);
            }
            for (let page = 1; page <= totalPages; page++) {
                const isActive = page === currentPage ? "active" : "";
                pagination.append(`<button class="btn btn-sm ${isActive}" data-page="${page}">${page}</button>`);
            }
            if (currentPage < totalPages) {
                pagination.append(`<button class="btn btn-sm next-page" data-page="${currentPage + 1}">Next</button>`);
            }
            $("#count-brands").text(`${totalItems} Brands`);
        };

        $(".pagination").on("click", "button", function () {
            currentPage = parseInt($(this).data("page"));
            fetchBrands();
        });

        $("[data-datatable-size]").on("change", function () {
            itemsPerPage = parseInt($(this).val());
            currentPage = 1;
            fetchBrands();
        });

        const perPageSelect = $("[data-datatable-size]");
        [5, 10, 25, 50, 100].forEach((size) => {
            perPageSelect.append(`<option value="${size}">${size}</option>`);
        });
        perPageSelect.val(itemsPerPage);

        // Search input: trigger fetch when 3+ chars typed or cleared
        $searchInput.on("keyup", function () {
            searchTerm = $(this).val().trim();
            currentPage = 1;  // Always reset to page 1 on new search
            fetchBrands();
        });

        fetchBrands();
    });

    const generateActionButtons = (brand) => {
        return `
           <div class="menu" data-menu="true">
                <div class="menu-item menu-item-dropdown" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                    <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                        <i class="ki-filled ki-dots-vertical">
                        </i>
                    </button>
                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true" style="">
                        <div class="menu-item">
                            <a class="menu-link" href="brands.php?item=${brand.id}">
                                <span class="menu-icon">
                                    <i class="ki-filled ki-search-list">
                                    </i>
                                </span>
                                <span class="menu-title">
                                    View
                                </span>
                            </a>
                        </div>
                        <div class="menu-separator">
                        </div>
                        <div class="menu-item">
                             <a class="menu-link edit-brand-btn" href="#" data-brand-id="${brand.id}">
                                <span class="menu-icon">
                                    <i class="ki-filled ki-pencil">
                                    </i>
                                </span>
                                <span class="menu-title">
                                    Edit
                                </span>
                            </a>
                        </div>
                        <div class="menu-separator">
                        </div>
                        <div class="menu-item">
                            <a class="menu-link delete-brand-btn" href="#" data-brand-id="${brand.id}">
                                <span class="menu-icon">
                                    <i class="ki-filled ki-trash">
                                    </i>
                                </span>
                                <span class="menu-title">
                                    Remove
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
    };
</script>

<!-- for delete -->
<script>
  $(document).ready(function () {
    const token = localStorage.getItem('auth_token');

    $(document).on('click', '.delete-brand-btn', function (e) {
      e.preventDefault();
      const brandId = $(this).data('brand-id');
      const $row = $(`#row-${brandId}`);

      Swal.fire({
        title: 'Delete this brand?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6'
      }).then((result) => {
        if (!result.isConfirmed) return;

        // Optional: optimistic UI (fade row out instantly)
        const $clone = $row.clone(true, true);
        $row.addClass('deleting');
        $row.slideUp(180, () => $row.remove());

        $.ajax({
          url: `<?php echo BASE_URL; ?>/brands/${brandId}`,
          type: 'DELETE',
          headers: { 'Authorization': `Bearer ${token}` },
          success: function (data) {
            // Match your update flow UX
            Swal.fire({
              icon: 'success',
              title: 'Deleted',
              text: (data && data.message) || 'Brand deleted successfully.'
            }).then(() => {
              if (typeof window.fetchBrands === 'function') window.fetchBrands();
            });
          },
          error: function (xhr) {
            // Rollback UI if failed
            const msg = xhr.responseJSON?.message || 'Unable to delete brand.';
            Swal.fire({ icon: 'error', title: 'Error', text: msg });

            const $tbody = $('#brands-table tbody');
            if (!document.getElementById(`row-${brandId}`)) {
              $tbody.append($clone.hide()).find(`#row-${brandId}`).slideDown(180);
            }
          }
        });
      });
    });
  });
</script>
<!-- for update -->
 <script>
  $(document).ready(function () {
    const token = localStorage.getItem('auth_token');

    // Click: Edit
    // $(document).on('click', '.edit-brand-btn', function (e) {
    //   e.preventDefault();
    //   const brandId = $(this).data('brand-id');
    //   if (!brandId) {
    //     Swal.fire({ icon: 'error', title: 'Error', text: 'No brand id found.' });
    //     return;
    //   }

    //   // Fetch one brand (prefer GET /brands/:id; if not available, keep POST /brands/fetch)
    //   $.ajax({
    //     // If your API supports: url: `<?php echo BASE_URL; ?>/brands/${brandId}`, type: 'GET',
    //     url: `<?php echo BASE_URL; ?>/brands/fetch`,
    //     type: 'POST',
    //     headers: {
    //       'Authorization': `Bearer ${token}`,
    //       'Content-Type': 'application/json'
    //     },
    //     data: JSON.stringify({ id: brandId }),
    //     success: function (res) {
    //       const item = Array.isArray(res?.data) ? res.data[0] : res?.data;
    //       if (!item) {
    //         Swal.fire({ icon: 'error', title: 'Not found', text: 'Brand not found.' });
    //         return;
    //       }
    //       openEditBrandPopup(item);
    //     },
    //     error: function (xhr) {
    //       Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Unable to fetch brand.' });
    //     }
    //   });
    // });
    // // Popup
    // function openEditBrandPopup(brand) {
    //   const esc = (s = "") =>
    //     String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':"&quot;"}[c]));

    //   Swal.fire({
    //     title: 'Edit Brand',
    //     width: 560,
    //     customClass: { popup: 'swal2-compact-popup swal2-form-popup' },
    //     html: `
    //       <div class="swal-form-grid compact">
    //         <div class="swal-form-field">
    //           <label for="swal-brand-name">Name<span class="req">*</span></label>
    //           <input id="swal-brand-name" type="text" class="swal-input"
    //                  value="${esc(brand.name || '')}" placeholder="e.g. Apple" />
    //         </div>

    //         <div class="swal-form-field">
    //           <label for="swal-brand-sort">Custom Sort</label>
    //           <input id="swal-brand-sort" type="number" class="swal-input"
    //                  value="${esc(brand.custom_sort ?? 0)}" min="0" step="1" />
    //         </div>

    //         <div class="swal-form-field col-span-2">
    //           <label for="swal-brand-photo-url">Image URL</label>
    //           <input id="swal-brand-photo-url" type="text" class="swal-input"
    //                  value="${esc(brand.logo || '')}" placeholder="https://..." />
    //         </div>

    //         <div class="swal-form-field">
    //           <label for="swal-brand-file">Or choose file</label>
    //           <input id="swal-brand-file" type="file" class="swal-input-file" accept=".png,.jpg,.jpeg,.webp" />
    //           <small class="hint">PNG/JPG/WebP • up to ~2MB</small>
    //         </div>

    //         <div class="swal-form-field img-preview-wrap">
    //           <label>Preview</label>
    //           <div class="img-preview-box">
    //             <img id="swal-brand-preview" alt="Preview" src="${esc(brand.logo || '')}" />
    //           </div>
    //         </div>

    //         <div class="swal-form-field col-span-2">
    //           <label for="swal-brand-description">Description</label>
    //           <textarea id="swal-brand-description" class="swal-textarea" rows="3"
    //             placeholder="Short description">${esc(brand.description || '')}</textarea>
    //         </div>
    //       </div>
    //     `,
    //     focusConfirm: false,
    //     showCancelButton: true,
    //     confirmButtonText: 'Update',
    //     cancelButtonText: 'Cancel',
    //     reverseButtons: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     didOpen: () => {
    //       const urlInput = document.getElementById('swal-brand-photo-url');
    //       const fileInput = document.getElementById('swal-brand-file');
    //       const preview  = document.getElementById('swal-brand-preview');

    //       const setPreviewSrc = (src) => {
    //         preview.src = src || '';
    //         preview.style.display = src ? 'block' : 'none';
    //       };

    //       setPreviewSrc(urlInput.value);

    //       urlInput.addEventListener('input', () => {
    //         if (urlInput.value.trim()) {
    //           fileInput.value = '';
    //           setPreviewSrc(urlInput.value.trim());
    //         } else if (!fileInput.files.length) {
    //           setPreviewSrc('');
    //         }
    //       });

    //       fileInput.addEventListener('change', () => {
    //         const file = fileInput.files[0];
    //         if (file) {
    //           urlInput.value = '';
    //           const objectUrl = URL.createObjectURL(file);
    //           setPreviewSrc(objectUrl);
    //         } else if (!urlInput.value.trim()) {
    //           setPreviewSrc('');
    //         }
    //       });
    //     },
    //     preConfirm: () => {
    //       const name = document.getElementById('swal-brand-name').value.trim();
    //       const custom_sort_raw = document.getElementById('swal-brand-sort').value.trim();
    //       const photo_url = document.getElementById('swal-brand-photo-url').value.trim() || null;
    //       const description = document.getElementById('swal-brand-description').value.trim() || null;
    //       const fileInput = document.getElementById('swal-brand-file');
    //       const file = fileInput.files[0] || null;

    //       if (!name) {
    //         Swal.showValidationMessage('Name is required');
    //         return false;
    //       }
    //       const custom_sort = custom_sort_raw === '' ? 0 : Number(custom_sort_raw);
    //       if (Number.isNaN(custom_sort) || custom_sort < 0) {
    //         Swal.showValidationMessage('Custom Sort must be a non-negative number');
    //         return false;
    //       }

    //       return { name, custom_sort, description, photo_url, fileChosen: !!file, file };
    //     }
    //   }).then((res) => {
    //     if (!res.isConfirmed) return;

    //     const payload = res.value;
    //     if (payload.fileChosen && payload.file) {
    //       updateBrandWithFile(brand.id, payload);
    //     } else {
    //       const { file, fileChosen, ...jsonBody } = payload;
    //       updateBrandViaJson(brand.id, jsonBody);
    //     }
    //   });
    // }
// Click: Edit
$(document).on('click', '.edit-brand-btn', function (e) {
  e.preventDefault();
  const brandId = String($(this).data('brand-id')); // normalize to string

  if (!brandId) {
    Swal.fire({ icon: 'error', title: 'Error', text: 'No brand id found.' });
    return;
  }

  $.ajax({
    // If available, prefer: url: `<?php echo BASE_URL; ?>/brands/${brandId}`, type: 'GET',
    url: `<?php echo BASE_URL; ?>/brands/fetch`,
    type: 'POST',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    data: JSON.stringify({ id: brandId }),
    success: function (res) {
      console.log('brand fetch response:', res); // 👀 see exact shape

      let item = null;

      // Common shapes:
      // { data: { ...brand } }
      if (res && res.data && !Array.isArray(res.data)) {
        item = res.data;
      }
      // { data: [ ...brands ] } → find by id
      else if (Array.isArray(res?.data)) {
        item = res.data.find(b => String(b.id) === brandId) || res.data[0] || null;
      }
      // fallback: maybe API returns { brand: {...} }
      else if (res && res.brand) {
        item = res.brand;
      }

      if (!item) {
        Swal.fire({ icon: 'error', title: 'Not found', text: 'Brand not found.' });
        return;
      }

      openEditBrandPopup(item);
    },
    error: function (xhr) {
      Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Unable to fetch brand.' });
    }
  });
});
    
function openEditBrandPopup(brand) {
  // Escape &, <, >, ", '  (apostrophe included!)
  const esc = (s = "") =>
    String(s).replace(/[&<>"']/g, c => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':"&quot;","'":"&#39;"
    }[c]));

  // Be tolerant to varying API keys
  const nameVal = brand.name ?? brand.brand_name ?? '';
  const sortVal = Number(brand.custom_sort ?? brand.sort ?? 0);
  const logoVal = brand.logo ?? brand.logo_url ?? brand.photo ?? brand.image ?? '';
  const descVal = brand.description ?? brand.desc ?? brand.details ?? '';

  Swal.fire({
    title: 'Edit Brand',
    width: 560,
    customClass: { popup: 'swal2-compact-popup swal2-form-popup' },
    html: `
      <div class="swal-form-grid compact">
        <div class="swal-form-field">
          <label for="swal-brand-name">Name<span class="req">*</span></label>
          <input id="swal-brand-name" type="text" class="swal-input"
                 value="${esc(nameVal)}" placeholder="e.g. Apple" />
        </div>

        <div class="swal-form-field">
          <label for="swal-brand-sort">Custom Sort</label>
          <input id="swal-brand-sort" type="number" class="swal-input"
                 value="${esc(String(isNaN(sortVal) ? 0 : sortVal))}" min="0" step="1" />
        </div>

        <div class="swal-form-field col-span-2">
          <label for="swal-brand-photo-url">Image URL</label>
          <input id="swal-brand-photo-url" type="text" class="swal-input"
                 value="${esc(logoVal)}" placeholder="https://..." />
        </div>

        <div class="swal-form-field">
          <label for="swal-brand-file">Or choose file</label>
          <input id="swal-brand-file" type="file" class="swal-input-file" accept=".png,.jpg,.jpeg,.webp" />
          <small class="hint">PNG/JPG/WebP • up to ~2MB</small>
        </div>

        <div class="swal-form-field img-preview-wrap">
          <label>Preview</label>
          <div class="img-preview-box">
            <img id="swal-brand-preview" alt="Preview" src="${esc(logoVal)}" />
          </div>
        </div>

        <div class="swal-form-field col-span-2">
          <label for="swal-brand-description">Description</label>
          <textarea id="swal-brand-description" class="swal-textarea" rows="3"
            placeholder="Short description">${esc(descVal)}</textarea>
        </div>
      </div>
    `,
    focusConfirm: false,
    showCancelButton: true,
    confirmButtonText: 'Update',
    cancelButtonText: 'Cancel',
    reverseButtons: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    didOpen: () => {
      const urlInput = document.getElementById('swal-brand-photo-url');
      const fileInput = document.getElementById('swal-brand-file');
      const preview  = document.getElementById('swal-brand-preview');

      const setPreviewSrc = (src) => {
        preview.src = src || '';
        preview.style.display = src ? 'block' : 'none';
      };

      setPreviewSrc(urlInput.value);

      urlInput.addEventListener('input', () => {
        if (urlInput.value.trim()) {
          fileInput.value = '';
          setPreviewSrc(urlInput.value.trim());
        } else if (!fileInput.files.length) {
          setPreviewSrc('');
        }
      });

      fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (file) {
          urlInput.value = '';
          const objectUrl = URL.createObjectURL(file);
          setPreviewSrc(objectUrl);
        } else if (!urlInput.value.trim()) {
          setPreviewSrc('');
        }
      });
    },
    preConfirm: () => {
      const name = document.getElementById('swal-brand-name').value.trim();
      const custom_sort_raw = document.getElementById('swal-brand-sort').value.trim();
      const photo_url = document.getElementById('swal-brand-photo-url').value.trim() || null;
      const description = document.getElementById('swal-brand-description').value.trim() || null;
      const fileInput = document.getElementById('swal-brand-file');
      const file = fileInput.files[0] || null;

      if (!name) {
        Swal.showValidationMessage('Name is required');
        return false;
      }
      const custom_sort = custom_sort_raw === '' ? 0 : Number(custom_sort_raw);
      if (Number.isNaN(custom_sort) || custom_sort < 0) {
        Swal.showValidationMessage('Custom Sort must be a non-negative number');
        return false;
      }

      return { name, custom_sort, description, photo_url, fileChosen: !!file, file };
    }
  }).then((res) => {
    if (!res.isConfirmed) return;

    const payload = res.value;
    if (payload.fileChosen && payload.file) {
      updateBrandWithFile(brand.id, payload);
    } else {
      const { file, fileChosen, ...jsonBody } = payload;
      updateBrandViaJson(brand.id, jsonBody);
    }
  });
}

    // PUT with multipart (file chosen)
    function updateBrandWithFile(brandId, payload) {
      const token = localStorage.getItem('auth_token');
      const form = new FormData();
      form.append('_method', 'PUT');
      form.append('name', payload.name);
      form.append('custom_sort', payload.custom_sort ?? 0);
      if (payload.description !== null) form.append('description', payload.description);
      form.append('photo', payload.file); // <-- match your backend field name

      $.ajax({
        url: `<?php echo BASE_URL; ?>/brands/${brandId}`,
        type: 'POST',
        headers: { 'Authorization': `Bearer ${token}` },
        data: form,
        processData: false,
        contentType: false,
        success: function (data) {
          Swal.fire({
            icon: 'success',
            title: 'Updated',
            text: data.message || 'Brand updated.'
          }).then(() => {
            if (typeof window.fetchBrands === 'function') window.fetchBrands();
          });
        },
        error: function (xhr) {
          Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Unable to update brand.' });
        }
      });
    }

    // PUT with JSON (URL only)
    function updateBrandViaJson(brandId, payload) {
      const token = localStorage.getItem('auth_token');
      $.ajax({
        url: `<?php echo BASE_URL; ?>/brands/${brandId}`,
        type: 'PUT',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        },
        data: JSON.stringify({
          name: payload.name,
          custom_sort: payload.custom_sort ?? 0,
          description: payload.description,
          logo: payload.photo_url // <-- keep param name your API expects (logo/photo)
        }),
        success: function (data) {
          Swal.fire({
            icon: 'success',
            title: 'Updated',
            text: data.message || 'Brand updated.'
          }).then(() => {
            if (typeof window.fetchBrands === 'function') window.fetchBrands();
          });
        },
        error: function (xhr) {
          Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON?.message || 'Unable to update brand.' });
        }
      });
    }
  });
</script>
<style>
  .swal2-compact-popup { font-size: 0.9rem; line-height: 1.25; padding: 14px 18px !important; }
  .swal2-form-popup .swal2-html-container { margin: 6px 0 !important; }
  .swal-form-grid.compact { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
  .swal-form-field.col-span-2 { grid-column: 1 / -1; }
  .swal-form-field label { display: block; font-weight: 600; margin-bottom: 4px; color: #374151; font-size: 0.85rem; }
  .swal-form-field .req { color: #ef4444; margin-left: 3px; }
  .swal-input, .swal-textarea {
    width: 100%; box-sizing: border-box; border: 1px solid #d1d5db; border-radius: 8px; padding: 7px 9px;
    background: #fff; color: #111827; outline: none; transition: border-color .15s, box-shadow .15s; font-size: 0.9rem;
  }
  .swal-input:focus, .swal-textarea:focus { border-color: #60a5fa; box-shadow: 0 0 0 3px rgba(96,165,250,.2); }
  .swal-input-file { width: 100%; font-size: 0.9rem; }
  .hint { display:block; color:#6b7280; font-size: 11px; margin-top: 2px; }
  .img-preview-wrap { display:flex; flex-direction: column; }
  .img-preview-box {
    width: 100%; height: 120px; border: 1px dashed #d1d5db; border-radius: 8px; display:flex;
    align-items:center; justify-content:center; overflow:hidden; background:#f9fafb;
  }
  #swal-brand-preview { max-width: 100%; max-height: 100%; display: none; }
  @media (max-width: 640px) { .swal-form-grid.compact { grid-template-columns: 1fr; } }
</style>

<!-- Footer -->
<?php include("footer1.php"); ?>