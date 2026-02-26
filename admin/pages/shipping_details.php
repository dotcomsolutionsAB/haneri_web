<base href="../">
<?php include "../../configs/auth_check.php"; ?>
<?php include "../../configs/config.php"; ?>

<?php
    // Now listing ALL shipments; filters are applied via API body
    $current_page = "Delhivery Shipments";
?>
<?php include "header1.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    Delhivery Shipments
                </h1>
                <!-- <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                    Overview of all shipments created via Delhivery.
                </div> -->
            </div>
            <div class="flex items-center gap-2.5">
                <!-- Optional: future button (e.g., Create Shipment) -->
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
                        Overview of <span id="count-shipments">0 Shipments</span>
                    </h3>
                    <div class="flex gap-6">
                        <!-- Search -->
                        <div class="relative">
                            <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
                            <input class="input input-sm pl-8" data-datatable-search="#delhivery-table"
                                placeholder="Search by AWB / Name / Phone / PIN" type="text" />
                        </div>

                        <!-- Shipment ID filter -->
                        <div class="relative">
                            <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
                            <input class="input input-sm pl-8 w-24" id="filter-shipment-id" placeholder="ID" type="text" />
                        </div>                        

                        <!-- Courier filter -->
                        <div>
                            <select class="select select-sm w-[200px]" id="filter-courier">
                                <option value="">All Couriers</option>
                                <option value="delhivery">Delhivery</option>
                                <option value="other">Other</option>
                            </select>
                        </div>                        

                        <!-- Status filter -->
                        <div>                            
                            <select class="select select-sm w-[200px]" id="filter-status">
                                <option value="">All Status</option>
                                <option value="booked">Booked</option>
                                <option value="pending">Pending</option>
                                <option value="awaited">Awaited</option>
                                <option value="success">Success</option>
                            </select>
                        </div>
                        
                    </div>
                </div>

                <div class="card-body">
                    <div data-datatable="true" data-datatable-page-size="10">
                        <div class="scrollable-x-auto">
                            <table class="table table-border" data-datatable-table="true" id="delhivery-table">
                                <thead>
                                    <tr>
                                        <th class="w-[60px] text-center">
                                            <input class="checkbox checkbox-sm" data-datatable-check="true"
                                                type="checkbox" />
                                        </th>
                                        <th class="min-w-[260px]">
                                            <span class="sort asc">
                                                <span class="sort-label text-gray-700 font-normal">
                                                    Shipment
                                                </span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[220px]">
                                            <span class="sort">
                                                <span class="sort-label text-gray-700 font-normal">
                                                    Route
                                                </span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[200px]">
                                            <span class="sort">
                                                <span class="sort-label text-gray-700 font-normal">
                                                    Dates
                                                </span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[160px]">
                                            <span class="sort">
                                                <span class="sort-label text-gray-700 font-normal">
                                                    Payment
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
                            class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                            <div class="flex items-center gap-2 order-2 md:order-1">
                                Show
                                <select class="select select-sm w-16" data-datatable-size name="perpage">
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
        let currentPage = 1;    // Current page index
        let totalItems = 0;    // Will be set from response "records"
        let searchTerm = "";   // Search text
        let filterId = "";   // Shipment id filter
        let filterCourier = "";   // Courier filter (delhivery, other)
        let filterStatus = "";   // Status filter (booked, pending, awaited, success)

        const $searchInput = $("input[data-datatable-search=\"#delhivery-table\"]");
        const $idInput = $("#filter-shipment-id");
        const $courierSelect = $("#filter-courier");
        const $statusSelect = $("#filter-status");

        // Small helper to escape HTML in strings
        const esc = (s = "") =>
            String(s).replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[c]));

        // ===== FETCH FUNCTION =====
        window.fetchDelhiveryShipments = function fetchDelhiveryShipments() {
            const offset = (currentPage - 1) * itemsPerPage;

            const requestData = {
                limit: itemsPerPage,
                offset: offset
            };

            // Search bar
            if (searchTerm.length >= 2) {
                requestData.search = searchTerm;
            }

            // ID filter
            if (filterId) {
                requestData.id = filterId;
            }

            // Courier filter
            if (filterCourier) {
                requestData.courier = filterCourier;
            }

            // Status filter
            if (filterStatus) {
                requestData.status = filterStatus;
            }

            $.ajax({
                url: `<?php echo BASE_URL; ?>/delivery/fetch_shipments`,
                type: 'POST',
                headers: { Authorization: `Bearer ${token}` },
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify(requestData),
                success: (response) => {
                    if (response && response.success) {
                        let rows = [];

                        if (Array.isArray(response.data)) {
                            // Normal list
                            rows = response.data;
                            totalItems = response.records || rows.length;
                        } else if (response.data && typeof response.data === 'object') {
                            // Single record (e.g. filter by ID)
                            rows = [response.data];
                            totalItems = response.records || 1;
                        } else {
                            // Unexpected but "success" – treat as empty
                            rows = [];
                            totalItems = 0;
                        }

                        populateTable(rows);
                        updatePagination();
                    } else {
                        // success === false -> e.g. "Shipment not found."
                        totalItems = 0;
                        populateTable([]);       // will show "No shipments found"
                        updatePagination();

                        // Optional: show a small info alert only when user applied filters
                        if ( (searchTerm && searchTerm.length >= 2) || filterId || filterCourier || filterStatus ) {
                            console.warn(response?.message || 'No shipments found.');
                        }
                    }
                },
                error: (error) => {
                    console.error("Error fetching Delhivery shipments:", error);
                }
            });
        };

        // ===== TABLE RENDER =====
        const populateTable = (data) => {
            const $tbody = $("#delhivery-table tbody");
            $tbody.empty();

            if (!data.length) {
                $tbody.append(`
                    <tr>
                        <td colspan="6" class="text-center">
                            No shipments found
                        </td>
                    </tr>
                `);
                return;
            }

            data.forEach((shipment) => {
                // Mapping from your t_order_shipments response
                const awb = shipment.awb_no || "N/A";
                const orderNo = shipment.order_id || shipment.courier_reference || "N/A";
                const customer = shipment.customer_name || "N/A";
                const phone = shipment.customer_phone || "N/A";
                const status = shipment.status || "N/A";
                const originPin = shipment.pickup_pin || "N/A";
                const originCity = shipment.pickup_city || "";
                const destPin = shipment.shipping_pin || "N/A";
                const destCity = shipment.shipping_city || "";
                const payment = shipment.payment_mode || "N/A";
                const codAmount = shipment.cod_amount || 0;
                const totalAmount = shipment.total_amount || 0;
                const bookedAt = shipment.booked_at || shipment.created_at || "";
                const deliveredAt = shipment.delivered_at || null;

                // Small formatters
                const fmtDate = (v) => {
                    if (!v) return "—";
                    const d = new Date(v);
                    if (isNaN(d.getTime())) return v; // fallback raw
                    return d.toLocaleString();
                };
                const fmtMoney = (v) => {
                    const num = parseFloat(v);
                    if (!num || isNaN(num)) return "—";
                    return `₹ ${num.toFixed(2)}`;
                };

                $tbody.append(`
                    <tr>
                        <!-- Checkbox -->
                        <td class="text-center">
                            <input
                                class="checkbox checkbox-sm"
                                type="checkbox"
                                value="${esc(awb)}"
                            >
                        </td>

                        <!-- Shipment Column (AWB + Status + Order + Customer) -->
                        <td>
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-sm text-gray-900">
                                        AWB: ${esc(awb)}
                                    </span>
                                    <span class="badge badge-xs badge-light badge-outline">
                                        ${esc(status)}
                                    </span>
                                </div>
                                <div class="text-xs text-gray-700">
                                    Order: <span class="font-medium">${esc(orderNo)}</span>
                                </div>
                                <div class="text-xs text-gray-700">
                                    ${esc(customer)} &bull; ${esc(phone)}
                                </div>
                            </div>
                        </td>

                        <!-- Route Column -->
                        <td>
                            <div class="flex flex-col gap-1 text-xs text-gray-700">
                                <span>
                                    <span class="font-medium">Origin:</span>
                                    ${esc(originCity)} (${esc(originPin)})
                                </span>
                                <span>
                                    <span class="font-medium">Destination:</span>
                                    ${esc(destCity)} (${esc(destPin)})
                                </span>
                            </div>
                        </td>

                        <!-- Dates Column -->
                        <td>
                            <div class="flex flex-col gap-1 text-xs text-gray-700">
                                <span>
                                    <span class="font-medium">Booked:</span>
                                    ${fmtDate(bookedAt)}
                                </span>
                                <span>
                                    <span class="font-medium">Delivered:</span>
                                    ${fmtDate(deliveredAt)}
                                </span>
                            </div>
                        </td>

                        <!-- Payment Column -->
                        <td>
                            <div class="flex flex-col gap-1 text-xs text-gray-700">
                                <span>
                                    <span class="font-medium">Mode:</span> ${esc(payment)}
                                </span>
                                <span>
                                    <span class="font-medium">COD:</span> ${fmtMoney(codAmount)}
                                </span>
                                <span>
                                    <span class="font-medium">Total:</span> ${fmtMoney(totalAmount)}
                                </span>
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
                                    <div class="menu-dropdown menu-default w-full max-w-[200px]" data-menu-dismiss="true">

                                        <!-- Track on Delhivery (public tracking page using AWB) -->
                                        <div class="menu-item">
                                            <a
                                                class="menu-link"
                                                href="https://www.delhivery.com/tracking?waybill=${encodeURIComponent(awb)}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                            >
                                                <span class="menu-icon">
                                                    <i class="ki-filled ki-delivery"></i>
                                                </span>
                                                <span class="menu-title">
                                                    Track Shipment
                                                </span>
                                            </a>
                                        </div>

                                        <!-- View JSON (raw API data or pretty modal later) -->
                                        <div class="menu-item">
                                            <a
                                                class="menu-link view-delhivery-json"
                                                href="#" 
                                                data-json='${esc(JSON.stringify(shipment))}'
                                            >
                                                <span class="menu-icon">
                                                    <i class="ki-filled ki-search-list"></i>
                                                </span>
                                                <span class="menu-title">
                                                    View Details
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
        const updatePagination = () => {
            const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;
            const $pagination = $(".pagination");
            const $info = $("[data-datatable-info='true']");
            const startItem = totalItems ? ((currentPage - 1) * itemsPerPage + 1) : 0;
            const endItem = Math.min(currentPage * itemsPerPage, totalItems);

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
                $info.text(`Showing ${startItem}–${endItem} of ${totalItems} shipments`);
            } else {
                $info.text("No shipments to display");
            }

            // Counter in header
            $("#count-shipments").text(`${totalItems} Shipments`);
        };

        // ===== EVENTS =====

        // Pagination clicks
        $(".pagination").on("click", "button", function () {
            currentPage = parseInt($(this).data("page")) || 1;
            fetchDelhiveryShipments();
        });

        // Items per page
        $("[data-datatable-size]").on("change", function () {
            itemsPerPage = parseInt($(this).val()) || 10;
            currentPage = 1;
            fetchDelhiveryShipments();
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
            fetchDelhiveryShipments();
        });

        // Shipment ID filter
        $idInput.on("keyup", function () {
            filterId = $(this).val().trim();
            currentPage = 1;
            fetchDelhiveryShipments();
        });

        // Courier filter
        $courierSelect.on("change", function () {
            filterCourier = $(this).val();
            currentPage = 1;
            fetchDelhiveryShipments();
        });

        // Status filter
        $statusSelect.on("change", function () {
            filterStatus = $(this).val();
            currentPage = 1;
            fetchDelhiveryShipments();
        });

        // View Shipment Details (compact grid layout)
        $(document).on("click", ".view-delhivery-json", function (e) {
            e.preventDefault();

            let shipment = $(this).data("json");

            // Handle both string and object
            if (typeof shipment === 'string') {
                try {
                    shipment = JSON.parse(shipment);
                } catch (err) {
                    console.error('Failed to parse shipment JSON:', err);
                }
            }

            if (!shipment || typeof shipment !== 'object') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unable to display shipment details.',
                    confirmButtonColor: '#ef4444'
                });
                return;
            }

            const safe = (v) => esc(v == null ? '' : String(v));

            const fmtDate = (v) => {
                if (!v) return '—';
                const d = new Date(v);
                if (isNaN(d.getTime())) return safe(v);
                return d.toLocaleString();
            };

            const fmtMoney = (v) => {
                const num = parseFloat(v);
                if (!num || isNaN(num)) return '—';
                return `₹ ${num.toFixed(2)}`;
            };

            const html = `
                <div class="shipment-grid">
                    <!-- Row 1 -->
                    <div class="shipment-field">
                        <label>AWB</label>
                        <div class="shipment-value">${safe(shipment.awb_no)}</div>
                    </div>
                    <div class="shipment-field">
                        <label>Status</label>
                        <div class="shipment-value">${safe(shipment.status)}</div>
                    </div>
                    <div class="shipment-field">
                        <label>Order ID</label>
                        <div class="shipment-value">${safe(shipment.order_id ?? shipment.courier_reference)}</div>
                    </div>

                    <!-- Row 2 -->
                    <div class="shipment-field">
                        <label>Customer Name</label>
                        <div class="shipment-value">${safe(shipment.customer_name)}</div>
                    </div>
                    <div class="shipment-field">
                        <label>Customer Phone</label>
                        <div class="shipment-value">${safe(shipment.customer_phone)}</div>
                    </div>
                    <div class="shipment-field">
                        <label>Payment Mode</label>
                        <div class="shipment-value">${safe(shipment.payment_mode)}</div>
                    </div>

                    <!-- Row 3 -->
                    <div class="shipment-field">
                        <label>Origin</label>
                        <div class="shipment-value">
                            ${safe(shipment.pickup_city)} (${safe(shipment.pickup_pin)})
                        </div>
                    </div>
                    <div class="shipment-field">
                        <label>Destination</label>
                        <div class="shipment-value">
                            ${safe(shipment.shipping_city)} (${safe(shipment.shipping_pin)})
                        </div>
                    </div>
                    <div class="shipment-field">
                        <label>Courier Reference</label>
                        <div class="shipment-value">${safe(shipment.courier_reference)}</div>
                    </div>

                    <!-- Row 4 -->
                    <div class="shipment-field">
                        <label>COD Amount</label>
                        <div class="shipment-value">${fmtMoney(shipment.cod_amount)}</div>
                    </div>
                    <div class="shipment-field">
                        <label>Total Amount</label>
                        <div class="shipment-value">${fmtMoney(shipment.total_amount)}</div>
                    </div>
                    <div class="shipment-field">
                        <label>Weight</label>
                        <div class="shipment-value">${safe(shipment.weight)}</div>
                    </div>

                    <!-- Row 5 -->
                    <div class="shipment-field">
                        <label>Booked At</label>
                        <div class="shipment-value">${fmtDate(shipment.booked_at || shipment.created_at)}</div>
                    </div>
                    <div class="shipment-field">
                        <label>Delivered At</label>
                        <div class="shipment-value">${fmtDate(shipment.delivered_at)}</div>
                    </div>
                    <div class="shipment-field">
                        <label>Last Updated</label>
                        <div class="shipment-value">${fmtDate(shipment.updated_at)}</div>
                    </div>

                    <!-- Row 6 (Full width note) -->
                    <div class="shipment-field" style="grid-column: span 3;">
                        <label>Remarks</label>
                        <div class="shipment-value">${safe(shipment.remarks || shipment.remark)}</div>
                    </div>
                </div>
            `;

            Swal.fire({
                title: 'Shipment Details',
                html: html,
                width: 550,
                customClass: { popup: 'swal2-shipment-popup' },
                confirmButtonText: 'Close',
                confirmButtonColor: '#2563eb' // blue
            });
        });
        
        // Initial load
        fetchDelhiveryShipments();
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
</style>
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

  /* NEW: Shipment details popup */
  .swal2-shipment-popup{
    font-size: 0.8rem;
    line-height: 1.3;
    padding: 14px 18px !important;
  }

  .shipment-grid{
    display:grid;
    grid-template-columns:repeat(3,minmax(0,1fr));
    gap:8px 10px;
    text-align:left;
  }

  .shipment-field label{
    display:block;
    font-size:11px;
    margin-bottom:2px;
    color:#4b5563; /* gray-600 */
  }

  .shipment-value{
    border:1px solid #e5e7eb;
    border-radius:4px;
    padding:4px 6px;
    background:#f9fafb;
    font-size:12px;
    min-height:24px;
    display:flex;
    align-items:center;
  }
</style>
<?php include "footer1.php"; ?>