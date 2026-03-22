<base href="../">
<?php include "../../configs/auth_check.php"; ?>
<?php include "../../configs/config.php"; ?>

<?php
    // Dynamically set this based on the page
    $current_page = "Delhivery Pickup Locations";
?>
<?php include "header1.php"; ?>

<!-- Content -->
<main class="grow content pt-5" id="content" role="content">
    <!-- Container (breadcrumb / alerts etc.) -->
    <div class="container-fixed" id="content_container">
    </div>

    <!-- Page Header -->
    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-gray-900">
                    Delhivery Pickup Locations
                </h1>
                <!-- <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                    Manage your pickup locations for Delhivery.
                </div> -->
            </div>
            <div class="flex items-center gap-2.5">
                <button
                    type="button"
                    class="btn btn-sm btn-primary"
                    id="btn-create-pickup"
                >
                    Create Pickup
                </button>
            </div>
        </div>
    </div>
    <!-- End of Header Container -->

    <!-- Table + Filters Container -->
    <div class="container-fixed">
        <div class="grid gap-5 lg:gap-7.5">
            <div class="card card-grid min-w-full">
                <div class="card-header py-5 flex-wrap gap-2">
                    <h3 class="card-title">
                        Overview of <span id="count-pickups">0 Pickup Locations</span>
                    </h3>
                    <div class="flex gap-6">
                        <div class="relative">
                            <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
                            <input
                                class="input input-sm pl-8"
                                data-datatable-search="#pickup_table"
                                placeholder="Search by Name / Pincode"
                                type="text"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div data-datatable="true" data-datatable-page-size="10">
                        <div class="scrollable-x-auto">
                            <table
                                class="table table-border"
                                data-datatable-table="true"
                                id="pickup-table"
                            >
                                <thead>
                                    <tr>
                                        <th class="w-[60px] text-center">
                                            <input
                                                class="checkbox checkbox-sm"
                                                data-datatable-check="true"
                                                type="checkbox"
                                            />
                                        </th>
                                        <th class="min-w-[240px]">
                                            <span class="sort asc">
                                                <span class="sort-label text-gray-700 font-normal">
                                                    Pickup
                                                </span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[280px]">
                                            <span class="sort">
                                                <span class="sort-label text-gray-700 font-normal">
                                                    Address
                                                </span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[220px]">
                                            <span class="sort">
                                                <span class="sort-label text-gray-700 font-normal">
                                                    Contact
                                                </span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="w-[80px]"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- rows injected via JS -->
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium"
                        >
                            <div class="flex items-center gap-2 order-2 md:order-1">
                                Show
                                <select
                                    class="select select-sm w-16"
                                    data-datatable-size
                                    name="perpage"
                                >
                                </select>
                                per page
                            </div>
                            <div class="flex items-center gap-4 order-1 md:order-2">
                                <span data-datatable-info="true"></span>
                                <div class="pagination" data-datatable-pagination="true"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- End of Content -->

<script>
    $(document).ready(function () {
        const token = localStorage.getItem('auth_token');

        let itemsPerPage = 10;   // Default limit
        let currentPage  = 1;    // Current page index
        let totalItems   = 0;    // Will be set from response "meta.total"
        let searchTerm   = "";   // Search text

        const $searchInput = $("input[data-datatable-search=\"#pickup_table\"]");

        // ===== Small helper to escape HTML in strings =====
        const esc = (s = "") =>
            String(s).replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[c]));

        const fmtBoolBadge = (val, trueLabel, falseLabel) => {
            const isTrue = !!val;
            const label = isTrue ? trueLabel : falseLabel;
            const cls   = isTrue ? 'badge-success' : 'badge-light';
            return `<span class="badge badge-xs ${cls}">${esc(label)}</span>`;
        };

        // ===== FETCH FUNCTION =====
        window.fetchPickupLocations = function fetchPickupLocations() {
            const offset = (currentPage - 1) * itemsPerPage;

            const requestData = {
                limit:  itemsPerPage,
                offset: offset
            };

            // Search logic:
            // If numeric-like -> pincode, else -> name
            if (searchTerm.length >= 2) {
                if (/^\d+$/.test(searchTerm)) {
                    requestData.pincode = searchTerm;
                } else {
                    requestData.name = searchTerm;
                }
            }

            $.ajax({
                url: `<?php echo BASE_URL; ?>/delivery/pickup/fetch`,
                type: 'POST',
                headers: { Authorization: `Bearer ${token}` },
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(requestData),
                success: (response) => {
                    // Expected structure:
                    // {
                    //   "success": true,
                    //   "message": "...",
                    //   "data": {
                    //      "items": [ ... ],
                    //      "meta": { "limit": 50, "offset": 0, "total": 1 }
                    //   }
                    // }
                    if (response && response.data && Array.isArray(response.data.items)) {
                        const items = response.data.items || [];
                        const meta  = response.data.meta || {};
                        totalItems  = meta.total ?? items.length;

                        populateTable(items);
                        updatePagination(meta);
                    } else {
                        console.error("Unexpected response format:", response);
                    }
                },
                error: (error) => {
                    console.error("Error fetching pickup locations:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to fetch pickup locations.'
                    });
                }
            });
        };

        // ===== TABLE RENDER =====
        const populateTable = (items) => {
            const $tbody = $("#pickup-table tbody");
            $tbody.empty();

            if (!items.length) {
                $tbody.append(`
                    <tr>
                        <td colspan="5" class="text-center">
                            No pickup locations found
                        </td>
                    </tr>
                `);
                return;
            }

            items.forEach((pickup) => {
                const id             = pickup.id;
                const name           = pickup.name || "N/A";
                const code           = pickup.code || "";
                const contactPerson  = pickup.contact_person || "";
                const phone          = pickup.phone || "";
                const altPhone       = pickup.alternate_phone || "";
                const email          = pickup.email || "";
                const addr1          = pickup.address_line1 || "";
                const addr2          = pickup.address_line2 || "";
                const landmark       = pickup.landmark || "";
                const city           = pickup.city || "";
                const district       = pickup.district || "";
                const state          = pickup.state || "";
                const pin            = pickup.pin || "";
                const country        = pickup.country || "";
                const isDefault      = pickup.is_default;
                const isActive       = pickup.is_active;

                const flagsHtml = `
                    ${fmtBoolBadge(isDefault, 'Default', 'Non-default')}
                    ${fmtBoolBadge(isActive, 'Active', 'Inactive')}
                `;

                const addressLines = [
                    addr1,
                    addr2,
                    landmark ? `Landmark: ${landmark}` : "",
                    city || district || state || pin || country
                        ? `${city ? city + ', ' : ''}${district ? district + ', ' : ''}${state ? state + ' ' : ''}${pin ? '- ' + pin : ''}${country ? ', ' + country : ''}`
                        : ""
                ].filter(Boolean).map(esc).join('<br>');

                let contactLines = [];
                if (contactPerson) contactLines.push(`<span class="font-medium">${esc(contactPerson)}</span>`);
                if (phone)         contactLines.push(`Phone: ${esc(phone)}`);
                if (altPhone)      contactLines.push(`Alt: ${esc(altPhone)}`);
                if (email)         contactLines.push(`Email: ${esc(email)}`);

                $tbody.append(`
                    <tr>
                        <!-- Checkbox -->
                        <td class="text-center">
                            <input
                                class="checkbox checkbox-sm"
                                type="checkbox"
                                value="${esc(id)}"
                            >
                        </td>

                        <!-- Pickup Column -->
                        <td>
                            <div class="flex flex-col gap-1 text-sm text-gray-900">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium">${esc(name)}</span>
                                    ${code ? `<span class="badge badge-xs badge-light badge-outline">Code: ${esc(code)}</span>` : ''}
                                </div>
                                <div class="flex flex-wrap gap-1 text-xs text-gray-700">
                                    ${flagsHtml}
                                </div>
                            </div>
                        </td>

                        <!-- Address Column -->
                        <td>
                            <div class="flex flex-col gap-1 text-xs text-gray-700">
                                ${addressLines || '—'}
                            </div>
                        </td>

                        <!-- Contact Column -->
                        <td>
                            <div class="flex flex-col gap-1 text-xs text-gray-700">
                                ${contactLines.length ? contactLines.join('<br>') : '—'}
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="w-[80px]">
                            <div class="menu" data-menu="true">
                                <div class="menu-item menu-item-dropdown"
                                    data-menu-item-offset="0, 10px"
                                    data-menu-item-placement="bottom-end"
                                    data-menu-item-placement-rtl="bottom-start"
                                    data-menu-item-toggle="dropdown"
                                    data-menu-item-trigger="click|lg:click">
                                    <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                                        <i class="ki-filled ki-dots-vertical"></i>
                                    </button>
                                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                                        <!-- View raw JSON (optional) -->
                                        <div class="menu-item">
                                            <a
                                                class="menu-link view-pickup-json"
                                                href="#"
                                                data-json='${esc(JSON.stringify(pickup))}'
                                            >
                                                <span class="menu-icon">
                                                    <i class="ki-filled ki-search-list"></i>
                                                </span>
                                                <span class="menu-title">
                                                    View Details
                                                </span>
                                            </a>
                                        </div>

                                        <!-- Delete pickup -->
                                        <div class="menu-item">
                                            <a
                                                class="menu-link delete-pickup"
                                                href="#"
                                                data-id="${esc(id)}"
                                                data-name="${esc(name)}"
                                            >
                                                <span class="menu-icon">
                                                    <i class="ki-filled ki-trash"></i>
                                                </span>
                                                <span class="menu-title text-danger-600">
                                                    Remove Pickup
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                `);
            });
        };

        // ===== PAGINATION RENDER =====
        const updatePagination = (meta = {}) => {
            const totalPages   = Math.ceil(totalItems / itemsPerPage) || 1;
            const $pagination  = $(".pagination");
            const $info        = $("[data-datatable-info='true']");
            const startItem    = totalItems ? ((currentPage - 1) * itemsPerPage + 1) : 0;
            const endItem      = Math.min(currentPage * itemsPerPage, totalItems);

            $pagination.empty();

            // Previous
            if (currentPage > 1) {
                $pagination.append(`
                    <button class="btn btn-sm prev-page" data-page="${currentPage - 1}">
                        Previous
                    </button>
                `);
            }

            // Page numbers (simple – all pages)
            for (let page = 1; page <= totalPages; page++) {
                $pagination.append(`
                    <button
                        class="btn btn-sm page-number ${page === currentPage ? 'btn-primary' : 'btn-light'}"
                        data-page="${page}">
                        ${page}
                    </button>
                `);
            }

            // Next
            if (currentPage < totalPages) {
                $pagination.append(`
                    <button class="btn btn-sm next-page" data-page="${currentPage + 1}">
                        Next
                    </button>
                `);
            }

            // Info text
            if (totalItems > 0) {
                $info.text(`Showing ${startItem}–${endItem} of ${totalItems} pickup locations`);
            } else {
                $info.text("No pickup locations to display");
            }

            // Counter in header
            $("#count-pickups").text(`${totalItems} Pickup Location${totalItems === 1 ? '' : 's'}`);
        };

        // ===== CREATE PICKUP (SweetAlert form) =====
        const showCreatePickupModal = () => {
            Swal.fire({
                title: 'Create Pickup Location',
                html: `
                    <style>
                        .pickup-grid{
                            display:grid;
                            grid-template-columns:repeat(3,minmax(0,1fr));
                            gap:8px 10px;
                            text-align:left;
                        }
                        .pickup-field label{
                            display:block;
                            font-size:11px;
                            margin-bottom:2px;
                            color:#4b5563; /* gray-600 */
                        }
                        .pickup-field input{
                            width:100%;
                            box-sizing:border-box;
                            font-size:12px;
                            padding:4px 6px;
                        }
                        .pickup-toggle-row{
                            margin-top:8px;
                            display:flex;
                            gap:16px;
                            font-size:11px;
                        }
                        .pickup-toggle-row label{
                            display:flex;
                            align-items:center;
                            gap:4px;
                        }
                    </style>

                    <div class="pickup-grid">
                        <!-- Row 1 -->
                        <div class="pickup-field">
                            <label>Name *</label>
                            <input id="swal-name" class="swal2-input" placeholder="Pickup Name">
                        </div>
                        <div class="pickup-field">
                            <label>Contact Person *</label>
                            <input id="swal-contact-person" class="swal2-input" placeholder="Contact Person">
                        </div>
                        <div class="pickup-field">
                            <label>Phone *</label>
                            <input id="swal-phone" class="swal2-input" placeholder="Phone">
                        </div>

                        <!-- Row 2 -->
                        <div class="pickup-field">
                            <label>Alternate Phone</label>
                            <input id="swal-alt-phone" class="swal2-input" placeholder="Alternate Phone">
                        </div>
                        <div class="pickup-field">
                            <label>Email</label>
                            <input id="swal-email" class="swal2-input" placeholder="Email">
                        </div>
                        <div class="pickup-field">
                            <label>Pincode *</label>
                            <input id="swal-pin" class="swal2-input" placeholder="Pincode">
                        </div>

                        <!-- Row 3 -->
                        <div class="pickup-field" style="grid-column:span 2;">
                            <label>Address Line 1 *</label>
                            <input id="swal-addr1" class="swal2-input" placeholder="Address Line 1">
                        </div>
                        <div class="pickup-field">
                            <label>Address Line 2</label>
                            <input id="swal-addr2" class="swal2-input" placeholder="Address Line 2">
                        </div>

                        <!-- Row 4 -->
                        <div class="pickup-field">
                            <label>Landmark</label>
                            <input id="swal-landmark" class="swal2-input" placeholder="Landmark">
                        </div>
                        <div class="pickup-field">
                            <label>City *</label>
                            <input id="swal-city" class="swal2-input" placeholder="City">
                        </div>
                        <div class="pickup-field">
                            <label>District</label>
                            <input id="swal-district" class="swal2-input" placeholder="District">
                        </div>

                        <!-- Row 5 -->
                        <div class="pickup-field">
                            <label>State *</label>
                            <input id="swal-state" class="swal2-input" placeholder="State">
                        </div>
                        <div class="pickup-field">
                            <label>Country *</label>
                            <input id="swal-country" class="swal2-input" placeholder="Country" value="India">
                        </div>
                        <div class="pickup-field"></div>
                    </div>

                    <div class="pickup-toggle-row">
                        <label>
                            <input id="swal-is-default" type="checkbox" checked>
                            <span>Set as Default</span>
                        </label>
                        <label>
                            <input id="swal-is-active" type="checkbox" checked>
                            <span>Active</span>
                        </label>
                    </div>
                `,
                focusConfirm: false,
                width: 550, // smaller
                customClass: { 
                    popup: 'swal2-pickup-popup'
                },
                showCancelButton: true,
                confirmButtonText: 'Create',
                cancelButtonText: 'Close',
                // blue create, red close
                confirmButtonColor: '#2563eb', // blue
                cancelButtonColor: '#ef4444',  // red
                preConfirm: () => {
                    const popup = Swal.getPopup();
                    const getVal = (id) => popup.querySelector(id).value.trim();

                    const name          = getVal('#swal-name');
                    const contactPerson = getVal('#swal-contact-person');
                    const phone         = getVal('#swal-phone');
                    const altPhone      = getVal('#swal-alt-phone');
                    const email         = getVal('#swal-email');
                    const addr1         = getVal('#swal-addr1');
                    const addr2         = getVal('#swal-addr2');
                    const landmark      = getVal('#swal-landmark');
                    const city          = getVal('#swal-city');
                    const district      = getVal('#swal-district');
                    const state         = getVal('#swal-state');
                    const pin           = getVal('#swal-pin');
                    const country       = getVal('#swal-country') || 'India';
                    const isDefault     = popup.querySelector('#swal-is-default').checked;
                    const isActive      = popup.querySelector('#swal-is-active').checked;

                    if (!name || !contactPerson || !phone || !addr1 || !city || !state || !pin) {
                        Swal.showValidationMessage('Please fill all required fields (*)');
                        return false;
                    }

                    return {
                        name,
                        contact_person: contactPerson,
                        phone,
                        alternate_phone: altPhone || null,
                        email: email || null,
                        address_line1: addr1,
                        address_line2: addr2 || null,
                        landmark: landmark || null,
                        city,
                        district: district || null,
                        state,
                        pin,
                        country,
                        is_default: isDefault,
                        is_active: isActive
                    };
                }
            }).then((result) => {
                if (!result.isConfirmed || !result.value) return;

                const payload = result.value;

                $.ajax({
                    url: `<?php echo BASE_URL; ?>/delivery/pickup/create`,
                    type: 'POST',
                    headers: { Authorization: `Bearer ${token}` },
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(payload),
                    success: (response) => {
                        if (response && response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Created',
                                text: response.message || 'Pickup location created successfully.',
                                confirmButtonColor: '#2563eb'
                            });
                            // Reload list from first page
                            currentPage = 1;
                            fetchPickupLocations();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: (response && response.message) || 'Failed to create pickup location.',
                                confirmButtonColor: '#ef4444'
                            });
                        }
                    },
                    error: (error) => {
                        console.error('Error creating pickup:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to create pickup location.',
                            confirmButtonColor: '#ef4444'
                        });
                    }
                });
            });
        };


        // ===== DELETE PICKUP =====
        const deletePickup = (id, name) => {
            Swal.fire({
                icon: 'warning',
                title: 'Remove Pickup',
                html: `Are you sure you want to remove pickup <b>${esc(name)}</b>?`,
                showCancelButton: true,
                confirmButtonText: 'Yes, remove',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: `<?php echo BASE_URL; ?>/delivery/pickup/delete/${encodeURIComponent(id)}`,
                    type: 'DELETE',
                    headers: { Authorization: `Bearer ${token}` },
                    success: (response) => {
                        if (response && response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Removed',
                                text: response.message || 'Pickup location deleted successfully.'
                            });
                            fetchPickupLocations();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: (response && response.message) || 'Failed to delete pickup location.'
                            });
                        }
                    },
                    error: (error) => {
                        console.error('Error deleting pickup:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete pickup location.'
                        });
                    }
                });
            });
        };

        // ===== EVENTS =====

        // Pagination clicks
        $(".pagination").on("click", "button", function () {
            currentPage = parseInt($(this).data("page")) || 1;
            fetchPickupLocations();
        });

        // Items per page
        $("[data-datatable-size]").on("change", function () {
            itemsPerPage = parseInt($(this).val()) || 10;
            currentPage  = 1;
            fetchPickupLocations();
        });

        // Build page-size dropdown
        const $perPageSelect = $("[data-datatable-size]");
        [5, 10, 25, 50, 100].forEach((size) => {
            $perPageSelect.append(`<option value="${size}">${size}</option>`);
        });
        $perPageSelect.val(itemsPerPage);

        // Search input
        $searchInput.on("keyup", function () {
            searchTerm = $(this).val().trim();
            currentPage = 1;
            fetchPickupLocations();
        });

        // View Pickup Details (nice small grid layout)
        $(document).on("click", ".view-pickup-json", function (e) {
            e.preventDefault();

            let pickup = $(this).data("json");

            // Handle both string + object
            if (typeof pickup === 'string') {
                try {
                    pickup = JSON.parse(pickup);
                } catch (err) {
                    console.error('Failed to parse pickup JSON:', err);
                }
            }

            if (!pickup || typeof pickup !== 'object') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unable to display pickup details.',
                    confirmButtonColor: '#ef4444'
                });
                return;
            }

            const safe = (v) => esc(v == null ? '' : String(v));

            const html = `
                <div class="pickup-grid pickup-grid-view">
                    <!-- Row 1 -->
                    <div class="pickup-field">
                        <label>ID</label>
                        <div class="pickup-value">${safe(pickup.id)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>Name</label>
                        <div class="pickup-value">${safe(pickup.name)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>Code</label>
                        <div class="pickup-value">${safe(pickup.code)}</div>
                    </div>

                    <!-- Row 2 -->
                    <div class="pickup-field">
                        <label>Contact Person</label>
                        <div class="pickup-value">${safe(pickup.contact_person)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>Phone</label>
                        <div class="pickup-value">${safe(pickup.phone)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>Alternate Phone</label>
                        <div class="pickup-value">${safe(pickup.alternate_phone)}</div>
                    </div>

                    <!-- Row 3 -->
                    <div class="pickup-field" style="grid-column: span 2;">
                        <label>Email</label>
                        <div class="pickup-value">${safe(pickup.email)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>Pincode</label>
                        <div class="pickup-value">${safe(pickup.pin)}</div>
                    </div>

                    <!-- Row 4 -->
                    <div class="pickup-field" style="grid-column: span 3;">
                        <label>Address Line 1</label>
                        <div class="pickup-value">${safe(pickup.address_line1)}</div>
                    </div>

                    <!-- Row 5 -->
                    <div class="pickup-field" style="grid-column: span 3;">
                        <label>Address Line 2</label>
                        <div class="pickup-value">${safe(pickup.address_line2)}</div>
                    </div>

                    <!-- Row 6 -->
                    <div class="pickup-field">
                        <label>Landmark</label>
                        <div class="pickup-value">${safe(pickup.landmark)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>City</label>
                        <div class="pickup-value">${safe(pickup.city)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>District</label>
                        <div class="pickup-value">${safe(pickup.district)}</div>
                    </div>

                    <!-- Row 7 -->
                    <div class="pickup-field">
                        <label>State</label>
                        <div class="pickup-value">${safe(pickup.state)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>Country</label>
                        <div class="pickup-value">${safe(pickup.country)}</div>
                    </div>
                    <div class="pickup-field">
                        <label>Default</label>
                        <div class="pickup-value">${pickup.is_default ? 'Yes' : 'No'}</div>
                    </div>

                    <!-- Row 8 -->
                    <div class="pickup-field">
                        <label>Active</label>
                        <div class="pickup-value">${pickup.is_active ? 'Yes' : 'No'}</div>
                    </div>
                </div>
            `;

            Swal.fire({
                title: 'Pickup Details',
                html: html,
                width: 550,
                customClass: { popup: 'swal2-pickup-popup' },
                confirmButtonText: 'Close',
                confirmButtonColor: '#2563eb'  // blue close button
            });
        });

        // Delete pickup
        $(document).on("click", ".delete-pickup", function (e) {
            e.preventDefault();
            const id   = $(this).data("id");
            const name = $(this).data("name") || '';
            deletePickup(id, name);
        });

        // Create Pickup button
        $("#btn-create-pickup").on("click", function () {
            showCreatePickupModal();
        });

        // Initial load
        fetchPickupLocations();
    });
</script>

<style>
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

  .swal2-pickup-popup{
    font-size: 0.8rem;
    line-height: 1.3;
    padding: 14px 18px !important;
  }
  .swal2-pickup-popup .swal2-input{
    margin: 2px 0 4px 0;
    height: 32px;
    font-size: 0.8rem;
  }

  /* existing classes you already had (for JSON view) can stay */
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
</style>

<style>
  .swal2-pickup-popup{
    font-size: 0.8rem;
    line-height: 1.3;
    padding: 14px 18px !important;
  }
  .swal2-pickup-popup .swal2-input{
    margin: 2px 0 4px 0;
    height: 32px;
    font-size: 0.8rem;
  }

  /* shared grid for create + view */
  .pickup-grid{
    display:grid;
    grid-template-columns:repeat(3,minmax(0,1fr));
    gap:8px 10px;
    text-align:left;
  }
  .pickup-field label{
    display:block;
    font-size:11px;
    margin-bottom:2px;
    color:#4b5563; /* gray-600 */
  }

  /* view mode value box */
  .pickup-grid-view .pickup-value{
    border:1px solid #e5e7eb;
    border-radius:4px;
    padding:4px 6px;
    background:#f9fafb;
    font-size:12px;
    min-height:24px;
    display:flex;
    align-items:center;
  }

  /* existing classes you already had (keep) */
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
</style>


<?php include "footer1.php"; ?>
