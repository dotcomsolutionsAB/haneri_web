<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php 
    $current_page = "Show Orders"; // Dynamically set this based on the page
?>
<?php include("header1.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

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
                        Orders
                    </h1>
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
                            Overview of <span id="count-orders"> 00 </span>
                        </h3>

                        <div class="w-full flex flex-wrap items-center gap-2">                                                      
                            <!-- Sort by / dir -->
                            <div class="flex items-center gap-2">
                                <select class="select select-sm w-[200px]" data-datatable-sort-by>
                                    <option value="">Sort by Column</option>
                                    <option value="created_at">Sort: Order Date</option>
                                    <option value="amount">Sort: Total Amount</option>
                                    <option value="id">Sort: Order ID</option>
                                </select>
                                <select class="select select-sm w-[200px]" data-datatable-sort-dir>
                                    <option value="">Sort by Order</option>
                                    <option value="desc">DESC</option>
                                    <option value="asc">ASC</option>
                                </select>
                            </div>
                            <!-- Status -->
                            <div>
                                <select class="select select-sm w-[200px]" data-datatable-status>
                                    <option value="">Order Status</option>
                                    <option value="pending">pending</option>
                                    <option value="processing">processing</option>
                                    <option value="completed">completed</option>
                                    <option value="cancelled">cancelled</option>
                                </select>
                            </div>
                            <!-- Payment Status -->
                            <div>
                                <select class="select select-sm w-[200px]" data-datatable-payment-status>
                                    <option value="">Payment Status</option>
                                    <option value="pending">pending</option>
                                    <option value="paid">paid</option>
                                    <option value="failed">failed</option>
                                    <option value="refunded">refunded</option>
                                </select>
                            </div>
      
                            <!-- Two Date Pickers ONLY -->
                            <div class="flex items-center gap-2">
                                <input class="input input-sm w-[160px]" type="date" data-datatable-date-from placeholder="From" />
                                <span class="text-2sm text-gray-500">to</span>
                                <input class="input input-sm w-[160px]" type="date" data-datatable-date-to placeholder="To" />
                            </div>   

                            <!-- User Type -->
                            <div>
                                <select class="select select-sm w-[200px]" data-datatable-user-type>
                                    <option value="">User Type</option>
                                    <option value="customer">Customer</option>
                                    <option value="architect">Architect</option>
                                    <option value="dealer">Dealer</option>
                                </select>
                            </div>
                            <!-- Order ID Search -->
                            <div class="relative">
                                <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
                                <input class="input input-sm pl-8" data-datatable-search-order placeholder="Search Order ID" type="text" />
                            </div>                    
                            <!-- User Name Filter -->
                            <div class="relative">
                                <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
                                <input class="input input-sm pl-8" data-datatable-search-user placeholder="Search User Name" type="text" />
                            </div>

                            <!-- Spacer -->
                            <div class="grow"></div>

                            <!-- Bulk Action (Select + Apply) -->
                            <div class="flex items-center gap-2">
                                <span class="text-2sm text-gray-600 flex items-center gap-2">
                                    Selected: <b id="bulk-selected-count">0</b>
                                </span>
                                <select id="bulk-action" class="select select-sm w-[180px]">
                                    <option value="">Bulk Action</option>
                                    <option value="export_csv">Export CSV</option>
                                    <option value="export_xlsx">Export Excel (.xlsx)</option>
                                    <option value="delete_selected">Delete</option>
                                </select>
                                <button class="btn btn-sm btn-primary" id="bulk-apply">Apply</button>                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="10">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" id="orders-table" data-datatable-table="true">
                                    <thead>
                                        <tr>
                                            <th class="w-[60px] text-center">
                                                <input class="checkbox checkbox-sm" data-datatable-check="true" type="checkbox">
                                            </th>
                                            <th class="max-w-[120px]">
                                                <span class="sort asc">
                                                    <span class="sort-label text-gray-700 font-normal">Order Date</span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="text-gray-700 font-normal min-w-[100px]">Order Code</th>
                                            <th class="min-w-[165px]">
                                                <span class="sort">
                                                    <span class="sort-label text-gray-700 font-normal">Razorpay ID</span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th><th class="max-w-[100px]">
                                                <span class="sort">
                                                    <span class="sort-label text-gray-700 font-normal">Customer</span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>                                            
                                            <th class="min-w-[140px]">
                                                <span class="sort">
                                                    <span class="sort-label text-gray-700 font-normal">Amount</span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th><th class="min-w-[100px]">
                                                <span class="sort">
                                                    <span class="sort-label text-gray-700 font-normal">Delivery Status</span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="min-w-[100px]">
                                                <span class="sort">
                                                    <span class="sort-label text-gray-700 font-normal">Payment Method</span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="min-w-[165px]">Shipment Details</th>
                                            <th class="w-[60px]">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--  -->
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
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
                <!-- Faq Section code  -->
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

        // Filters / query state
        let orderIdQuery = "";
        let dateQuery = "";       // single date
        let dateFromQuery = "";   // range from
        let dateToQuery = "";     // range to
        let userNameQuery = "";
        let statusQuery = "";
        let paymentStatusQuery = "";
        let sortBy = "created_at";
        let sortDir = "desc";
        let userTypeQuery = "";

        // Selection state
        const selectedIds = new Set();
        let lastPageData = []; // cache of the current page rows for CSV/selection

        const fmtAmt = (n) => {
            const num = Number(n);
            return isFinite(num) ? num.toFixed(2) : '0.00';
        };

        const updateBulkCount = () => {
            $("#bulk-selected-count").text(selectedIds.size);
            // header checkbox state
            const headerCb = $('[data-datatable-check="true"]')[0];
            if (!headerCb) return;
            const totalOnPage = lastPageData.length;
            const selectedOnPage = lastPageData.filter(o => selectedIds.has(o.id)).length;
            headerCb.indeterminate = selectedOnPage > 0 && selectedOnPage < totalOnPage;
            headerCb.checked = selectedOnPage > 0 && selectedOnPage === totalOnPage;
        };
        const fetchOrders = () => {
            const offset = (currentPage - 1) * itemsPerPage;

            const requestData = {
            limit: itemsPerPage,
            offset: offset,
            sort_by: sortBy,
            sort_dir: sortDir
            };

            // Filters (only if provided)
            if (orderIdQuery) requestData.order_id = orderIdQuery;
            if (userNameQuery) requestData.user_name = userNameQuery;
            if (statusQuery) requestData.status = statusQuery;
            if (paymentStatusQuery) requestData.payment_status = paymentStatusQuery;

            // - If both dateFromQuery & dateToQuery -> send date_from/date_to
            // - Else if only one picked (either from or to) -> send date
            if (dateFromQuery && dateToQuery) {
                requestData.date_from = dateFromQuery;
                requestData.date_to = dateToQuery;
            } else if (dateQuery) {
                requestData.date = dateQuery;
            }

            if (userTypeQuery) {
                requestData.user_type = userTypeQuery; // <-- backend expects 'user_type'
            }

            $.ajax({
            url: `<?php echo BASE_URL; ?>/fetch_all`,
            type: 'POST',
            headers: token ? { Authorization: `Bearer ${token}` } : {},
            data: requestData,
            success: (response) => {
                if (response?.success && Array.isArray(response.data)) {
                    const meta = response.meta || {};

                    // ✅ Use backend meta.total properly
                    if (typeof meta.total === 'number') {
                        totalItems = meta.total;
                    } else if (typeof response.total_orders === 'number') {
                        totalItems = response.total_orders;
                    } else {
                        totalItems = response.data.length;
                    }

                    // Optionally sync itemsPerPage with backend limit
                    if (typeof meta.limit === 'number' && meta.limit > 0) {
                        itemsPerPage = meta.limit;
                        $("[data-datatable-size]").val(itemsPerPage);
                    }

                    lastPageData = response.data;
                    populateTable(response.data);
                    updatePagination();
                    updateBulkCount();
                } else {
                    console.error("Unexpected response format:", response);
                    totalItems = 0;
                    lastPageData = [];
                    populateTable([]);
                    updatePagination();
                    updateBulkCount();
                }
            },
            error: (error) => {
                console.error("Error fetching data:", error);
                lastPageData = [];
                populateTable([]);
                updatePagination();
                updateBulkCount();
            }
            });
        };
        // Debounce helper
        const debounce = (func, delay) => {
            let timer;
            return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
            };
        };

        const tatLoadingIntervals = {}; // prevent multiple animations per row
        function startTatLoadingAnimation(orderId) {
            const el = document.getElementById(`tat-${orderId}`);
            if (!el) return;

            let count = 0;
            clearInterval(tatLoadingIntervals[orderId]);

            tatLoadingIntervals[orderId] = setInterval(() => {
                count = (count + 1) % 4; 
                el.textContent = "Checking ETA" + ".".repeat(count);
            }, 500);
        }
        function stopTatLoadingAnimation(orderId, finalText) {
            clearInterval(tatLoadingIntervals[orderId]);
            const el = document.getElementById(`tat-${orderId}`);
            if (el) el.textContent = finalText;
        }
        const fetchTatForOrders = (orders) => {
            if (!Array.isArray(orders) || !orders.length) return;

            const token = localStorage.getItem('auth_token');

            orders.forEach(order => {
                if (!order?.id) return;

                const orderId = order.id;

                // Start blinking dots animation
                startTatLoadingAnimation(orderId);

                $.ajax({
                    url: `<?php echo BASE_URL; ?>/delivery/expected-time`,
                    type: 'POST',
                    headers: token ? { Authorization: `Bearer ${token}` } : {},
                    contentType: 'application/json',
                    data: JSON.stringify({
                        through: 'order',
                        order_id: String(orderId)
                    }),
                    success: (res) => {
                        const tat = res?.data?.data?.tat;

                        if (res?.success && tat !== undefined && tat !== null && tat > 0) {
                            stopTatLoadingAnimation(orderId, `Expected: ${tat} day${tat > 1 ? 's' : ''}`);
                        } else {
                            stopTatLoadingAnimation(orderId, `Expected: N/A`);
                        }
                    },
                    error: () => {
                        stopTatLoadingAnimation(orderId, `Expected: N/A`);
                    }
                });
            });
        };

        $("[data-datatable-user-type]").on("change", function () {
            userTypeQuery = $(this).val(); // '', 'customer', 'architect', 'dealer'
            currentPage = 1;
            fetchOrders();
        });
        // Inputs wiring
        $("[data-datatable-search-order]").on("input", debounce(function () {
            orderIdQuery = $(this).val().trim();
            currentPage = 1;
            fetchOrders();
        }, 300));
        $("[data-datatable-search-user]").on("input", debounce(function () {
            const q = $(this).val().trim();
            userNameQuery = (q.length >= 3) ? q : (q.length === 0 ? "" : userNameQuery);
            currentPage = 1;
            fetchOrders();
        }, 300));
        /* --- DATE HANDLERS (two inputs only) --- */
        $("[data-datatable-date-from]").on("change", function () {
            dateFromQuery = $(this).val();
            // If only first date chosen (to empty) -> send single `date`
            if (dateFromQuery && !dateToQuery) {
                dateQuery = dateFromQuery;
            } else if (dateFromQuery && dateToQuery) {
                dateQuery = ""; // both picked -> we will send date_from/date_to
            } else {
                dateQuery = ""; // none
            }
            currentPage = 1;
            fetchOrders();
        });
        $("[data-datatable-date-to]").on("change", function () {
            dateToQuery = $(this).val();
            // If both chosen -> range; if only first chosen -> single date; if only second chosen -> treat as single date = second
            if (dateFromQuery && dateToQuery) {
                // If user picked to < from, swap them (nice UX)
                if (new Date(dateToQuery) < new Date(dateFromQuery)) {
                    const tmp = dateFromQuery;
                    dateFromQuery = dateToQuery;
                    dateToQuery = tmp;
                    $("[data-datatable-date-from]").val(dateFromQuery);
                    $("[data-datatable-date-to]").val(dateToQuery);
                }
                dateQuery = "";
            } else if (!dateFromQuery && dateToQuery) {
                dateQuery = dateToQuery; // only second picked -> use as single date
            } else if (dateFromQuery && !dateToQuery) {
                dateQuery = dateFromQuery; // only first picked
            } else {
                dateQuery = "";
            }
            currentPage = 1;
            fetchOrders();
        });
        $("[data-datatable-status]").on("change", function () {
            statusQuery = $(this).val();
            currentPage = 1;
            fetchOrders();
        });
        $("[data-datatable-payment-status]").on("change", function () {
            paymentStatusQuery = $(this).val();
            currentPage = 1;
            fetchOrders();
        });
        $("[data-datatable-sort-by]").on("change", function () {
            sortBy = $(this).val();
            currentPage = 1;
            fetchOrders();
        });
        $("[data-datatable-sort-dir]").on("change", function () {
            sortDir = $(this).val();
            currentPage = 1;
            fetchOrders();
        });

        const escHtml = (s = "") =>
            String(s).replace(/[&<>"']/g, c => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[c]));

        const fmtDateTime = (dt) => {
            if (!dt) return "N/A";
            const d = new Date(dt);
            return isNaN(d) ? dt : d.toLocaleString();
        };

        const renderShipmentCell = (shipment) => {
        if (!shipment) {
            return `<span class="badge badge-sm badge-light badge-outline">No Shipment</span>`;
        }

        const courier = escHtml(shipment.courier || "N/A");
        const status  = escHtml(shipment.status || "N/A");
        const awb     = escHtml(shipment.awb_no || "N/A");
        const booked  = fmtDateTime(shipment.booked_at);

        // shiprocket reference can be long, keep short
        const ref = shipment.courier_reference
            ? escHtml(shipment.courier_reference).slice(0, 60) + (shipment.courier_reference.length > 60 ? "..." : "")
            : "N/A";

        // status badge color (simple)
        const st = String(shipment.status || "").toLowerCase();
        const statusBadge =
            st === "booked" ? "badge-success"
            : st === "pending" ? "badge-warning"
            : "badge-light";

        return `
            <div class="text-xs space-y-1">
            <div class="flex flex-wrap gap-2 items-center">
                <span class="badge badge-sm badge-outline badge-primary">${courier}</span>
                <span class="badge badge-sm badge-outline ${statusBadge}">${status}</span>
            </div>
            <div><b>AWB:</b> ${awb}</div>
            <div><b>Booked:</b> ${escHtml(booked)}</div>
            <div><b>Ref:</b> ${ref}</div>
            </div>
        `;
        };

        // Populate Table with Orders
        const populateTable = (data) => {
            const tbody = $("#orders-table tbody");
            tbody.empty();
            if (data.length === 0) {
                tbody.append(`<tr><td colspan="10" class="text-center text-gray-500">No orders found.</td></tr>`);
                return;
            }

            data.forEach((order) => {
                const isChecked = selectedIds.has(order.id);

                const payStatus = (order.payment_status || '').toLowerCase();
                const payMethodLabel = payStatus === 'paid' ? 'Razorpay' : 'COD';
                tbody.append(`
                    <tr id="row-${order.id}">
                    <td class="text-center">
                        <input class="checkbox checkbox-sm row-check" type="checkbox" value="${order.id}" ${isChecked ? 'checked' : ''}>
                    </td>
                    <td><span class="text-xs text-gray-700 font-normal">${new Date(order.created_at).toLocaleString()}</span></td>
                    <td><span class="badge badge-sm badge-light badge-outline">${order.id}</span></td>
                    <td><span class="text-xs text-gray-700 font-normal">${order.razorpay_order_id || "N/A"}</span></td>
                    <td>
                        <span class="text-xs text-gray-700 font-normal">${order.user?.name || "N/A"}</span>
                        <br>
                        <span class="badge badge-primary">${order.user?.role || "N/A"}</span>
                    </td>
                    <td>
                        <span class="text-xs text-gray-700 font-normal">₹${fmtAmt(order.total_amount)}</span>
                        <br>
                        <span class="badge ${order.payment_status === 'paid' ? 'badge-success' : (order.payment_status === 'failed' ? 'badge-danger' : 'badge-light')}">${order.payment_status || 'N/A'}</span>
                    </td>
                    <td>
                        <span class="badge badge-outline ${getStatusClass(order.status)}">${order.status}</span>
                        <div class="tat-info text-xs mt-1">
                            <span class="badge badge-xs badge-outline badge-danger" id="tat-${order.id}">Checking ETA...</span>
                        </div>
                    </td>
                    <td><span class="text-xs text-gray-700 font-normal">${payMethodLabel}</span></td>
                    <td>${renderShipmentCell(order.shipment)}</td>
                    <td class="w-[60px]">${generateActionButtons(order)}</td>
                    </tr>
                `);
            });

            // Per-row checkbox handler
            $("#orders-table .row-check").off("change").on("change", function(){
                const id = parseInt($(this).val(), 10);
                if (this.checked) selectedIds.add(id); else selectedIds.delete(id);
                updateBulkCount();
            });

            // 🔹 Fetch TAT for all orders on this page
            fetchTatForOrders(data);

            // Header select-all checkbox
            const headerCb = $('[data-datatable-check="true"]');
            headerCb.off("change").on("change", function(){
                const check = this.checked;
                $("#orders-table .row-check").each(function(){
                    const id = parseInt($(this).val(), 10);
                    if (check) {
                        this.checked = true;
                        selectedIds.add(id);
                    } else {
                        this.checked = false;
                        selectedIds.delete(id);
                    }
                });
                updateBulkCount();
            });
        };
        // Status badge map
        const getStatusClass = (status) => {
            const s = String(status || '').toLowerCase();
            const map = {
            pending: "badge-warning",
            processing: "badge-primary",
            completed: "badge-success",
            cancelled: "badge-danger",
            failed: "badge-secondary"
            };
            return map[s] || "badge-light";
        };
        // Pagination
        const updatePagination = () => {
            const totalPages = Math.max(1, Math.ceil(totalItems / itemsPerPage)); // at least 1
            const pagination = $(".pagination");
            pagination.empty();

            // Clamp currentPage within range (safety)
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            // Prev button
            if (currentPage > 1) {
                pagination.append(
                    `<button class="btn btn-sm" data-page="${currentPage - 1}">Previous</button>`
                );
            }

            const maxButtons = 5;
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + maxButtons - 1);

            if (endPage - startPage < maxButtons - 1) {
                startPage = Math.max(1, endPage - maxButtons + 1);
            }

            for (let page = startPage; page <= endPage; page++) {
                const isActive = page === currentPage ? "btn-primary" : "btn-light";
                pagination.append(
                    `<button class="btn btn-sm ${isActive}" data-page="${page}">${page}</button>`
                );
            }

            // Next button
            if (currentPage < totalPages) {
                pagination.append(
                    `<button class="btn btn-sm" data-page="${currentPage + 1}">Next</button>`
                );
            }

            // ✅ "Overview of XX Orders"
            $("#count-orders").text(`${totalItems} Orders`);

            // ✅ "Showing X–Y of Z" in [data-datatable-info="true"]
            const infoEl = $("[data-datatable-info='true']");
            if (totalItems === 0) {
                infoEl.text("Showing 0–0 of 0");
            } else {
                const from = (currentPage - 1) * itemsPerPage + 1;
                const to = Math.min(currentPage * itemsPerPage, totalItems);
                infoEl.text(`Showing ${from}–${to} of ${totalItems}`);
            }
        };

        $(".pagination").on("click", "button", function () {
            currentPage = parseInt($(this).data("page"));
            fetchOrders();
        });
        $("[data-datatable-size]").on("change", function () {
            itemsPerPage = parseInt($(this).val());
            currentPage = 1;
            fetchOrders();
        });

        const perPageSelect = $("[data-datatable-size]");
        [5, 10, 25, 50, 100].forEach((size) => {
            perPageSelect.append(`<option value="${size}">${size}</option>`);
        });
        perPageSelect.val(itemsPerPage);

        // Bulk helpers (reuse your existing selectedIds, lastPageData)
        // helper function (put this once globally)
        const toIST = (utcString) => {
            if (!utcString) return "";
            const utcDate = new Date(utcString);
            if (isNaN(utcDate)) return utcString; // fallback
            const istDate = new Date(utcDate.getTime() + (5.5 * 60 * 60 * 1000));
            const dd = String(istDate.getDate()).padStart(2, "0");
            const mm = String(istDate.getMonth() + 1).padStart(2, "0");
            const yyyy = istDate.getFullYear();
            const hh = String(istDate.getHours()).padStart(2, "0");
            const min = String(istDate.getMinutes()).padStart(2, "0");
            const ss = String(istDate.getSeconds()).padStart(2, "0");
            return `${dd}-${mm}-${yyyy} ${hh}:${min}:${ss}`;
        };

        // --- inside your exportSelectedCSV() ---
        const exportSelectedCSV = () => {
            if (selectedIds.size === 0) {
                Swal.fire({ icon:'info', title:'Nothing selected', text:'Select one or more orders first.' });
                return;
            }
            const rows = lastPageData.filter(o => selectedIds.has(o.id));
            if (rows.length === 0) {
                Swal.fire({ icon:'info', title:'No rows on this page', text:'Selected orders may be on other pages.' });
                return;
            }

            const headers = ["Order ID","Order Date (IST)","Customer","Role","Total Amount","Order Status","Payment Status","Razorpay Order ID"];
            const csvRows = [headers.join(",")];
            rows.forEach(o => {
                const cells = [
                o.id,
                toIST(o.created_at), // ✅ convert to IST here
                (o.user?.name || "").replace(/,/g," "),
                (o.user?.role || "").replace(/,/g," "),
                (Number(o.total_amount) || 0).toFixed(2),
                (o.status || ""),
                (o.payment_status || ""),
                (o.razorpay_order_id || "")
                ].map(v => `"${String(v).replace(/"/g,'""')}"`);
                csvRows.push(cells.join(","));
            });

            // add BOM so Excel opens UTF-8 correctly
            const blob = new Blob(["\ufeff" + csvRows.join("\n")], { type: "text/csv;charset=utf-8;" });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = `orders_export_${Date.now()}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        };

        // Build Excel worksheet and set column widths
        const exportSelectedXLSX = () => {
            if (selectedIds.size === 0) {
                Swal.fire({ icon:'info', title:'Nothing selected', text:'Select one or more orders first.' });
                return;
            }
            const rows = lastPageData.filter(o => selectedIds.has(o.id));
            if (rows.length === 0) {
                Swal.fire({ icon:'info', title:'No rows on this page', text:'Selected orders may be on other pages.' });
                return;
            }

                                // 1) Prepare headers and data rows
            const headers = ["Order ID","Order Date","Customer","Role","Total Amount","Order Status","Payment Status","Razorpay Order ID"];
            // helper: convert UTC string to IST date/time string
            const toIST = (utcString) => {
                if (!utcString) return "";
                const utcDate = new Date(utcString);
                if (isNaN(utcDate)) return utcString; // fallback
                // shift by +5h30m
                const istDate = new Date(utcDate.getTime() + (5.5 * 60 * 60 * 1000));
                const dd = String(istDate.getDate()).padStart(2, "0");
                const mm = String(istDate.getMonth() + 1).padStart(2, "0");
                const yyyy = istDate.getFullYear();
                const hh = String(istDate.getHours()).padStart(2, "0");
                const min = String(istDate.getMinutes()).padStart(2, "0");
                const ss = String(istDate.getSeconds()).padStart(2, "0");
                return `${dd}-${mm}-${yyyy} ${hh}:${min}:${ss}`;
            };

            const data = rows.map(o => ([
                o.id,
                toIST(o.created_at),
                (o.user?.name || ""),
                (o.user?.role || ""),
                (Number(o.total_amount) || 0).toFixed(2),
                (o.status || ""),
                (o.payment_status || ""),
                (o.razorpay_order_id || "")
            ]));

            // 2) Create worksheet
            const aoa = [headers, ...data];
            const ws = XLSX.utils.aoa_to_sheet(aoa);

            // 3) Compute column widths (wch = “characters” width)
            //    Make each column at least the header length & longest cell length
            const colCount = headers.length;
            const getLen = v => String(v ?? "").length;
            const colWidths = Array.from({length: colCount}).map((_, ci) => {
                const headerLen = getLen(headers[ci]);
                const maxCellLen = Math.max(...data.map(r => getLen(r[ci] ?? "")), headerLen);
                // Add a little padding
                return { wch: Math.min(Math.max(maxCellLen + 2, 12), 60) }; // min 12, max 60
            });
            ws['!cols'] = colWidths;

            // 4) Create workbook and save
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Orders");
            XLSX.writeFile(wb, `orders_export_${Date.now()}.xlsx`);
        };

        const bulkDeleteSelected = async () => {
            if (selectedIds.size === 0) {
                Swal.fire({ icon:'info', title:'Nothing selected', text:'Select one or more orders first.' });
                return;
            }
            const confirmed = await Swal.fire({
                icon:'warning',
                title: 'Delete selected orders?',
                text: `You are about to delete ${selectedIds.size} order(s). This cannot be undone.`,
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33'
            }).then(r => r.isConfirmed);

            if (!confirmed) return;

            const token = localStorage.getItem('auth_token');
            const ids = Array.from(selectedIds);
            const results = await Promise.allSettled(ids.map(id =>
                fetch(`<?php echo BASE_URL; ?>/orders/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    ...(token ? { 'Authorization': `Bearer ${token}` } : {})
                }
                })
            ));

            const okCount = results.filter(r => r.status === 'fulfilled' && r.value.ok).length;
            const failCount = ids.length - okCount;

            Swal.fire({
                icon: okCount > 0 ? 'success' : 'error',
                title: 'Bulk delete result',
                html: `Deleted: <b>${okCount}</b><br>Failed: <b>${failCount}</b>`
            });

            // Clear selection for deleted ones
            ids.forEach((id, idx) => {
                if (results[idx].status === 'fulfilled' && results[idx].value.ok) {
                selectedIds.delete(id);
                }
            });

            fetchOrders();
        };

        // Apply handler
        $("#bulk-apply").on("click", () => {
            const action = $("#bulk-action").val();
            if (!action) {
                Swal.fire({ icon:'info', title:'No bulk action', text:'Please select a bulk action first.' });
                return;
            }
            if (action === 'export_csv') return exportSelectedCSV();
            if (action === 'export_xlsx') return exportSelectedXLSX();
            if (action === 'delete_selected') return bulkDeleteSelected();
        });
        // Initial fetch
        fetchOrders();
    });
    const shouldShowCreateShipment = (order) => {
    const sh = order?.shipment;

    // no shipment object at all
    if (!sh) return true;

    const status = String(sh.status || "").toLowerCase();
    const courier = String(sh.courier || "").toLowerCase();

    // if pending => always show
    if (status === "pending") return true;

    // AWB missing => show
    const awbMissing = !String(sh.awb_no || "").trim();
    if (awbMissing) return true;

    // courier_reference only matters for Shiprocket
    const isShiprocket = courier.includes("shiprocket");
    if (isShiprocket) {
        const refMissing = !String(sh.courier_reference || "").trim();
        if (refMissing) return true;
    }

    // otherwise hide
    return false;
    };

    // Action buttons
    const generateActionButtons = (order) => {
        return `
            <div class="menu" data-menu="true">
            <div class="menu-item menu-item-dropdown" data-menu-item-offset="0, 10px"
                data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start"
                data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                <i class="ki-filled ki-dots-vertical"></i>
                </button>
                <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                <div class="menu-item">
                    <a class="menu-link" href="pages/view_order.php?o_id=${order.id}">
                    <span class="menu-icon"><i class="ki-filled ki-search-list"></i></span>
                    <span class="menu-title">View</span>
                    </a>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-item">
                    <a class="menu-link" href="javascript:void(0);" onclick="checkOrderShippingCost(${order.id})">
                        <span class="menu-icon"><i class="ki-filled ki-delivery"></i></span>
                        <span class="menu-title">Check Shipping Cost</span>
                    </a>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-item">
                    <a class="menu-link" href="javascript:void(0);" onclick="trackOrderShipment(${order.id})">
                        <span class="menu-icon"><i class="ki-filled ki-map"></i></span>
                        <span class="menu-title">Track Shipment</span>
                    </a>
                </div>
                <div class="menu-separator"></div>
                <div class="menu-item">
                    <a class="menu-link" href="javascript:void(0);" onclick="removeOrder(${order.id})">
                    <span class="menu-icon"><i class="ki-filled ki-trash"></i></span>
                    <span class="menu-title">Remove</span>
                    </a>
                </div>
                <div class="menu-separator"></div>
                <!-- New 'Create Shipment' Button -->
                ${shouldShowCreateShipment(order) ? `
                <div class="menu-item">
                    <a class="menu-link" href="javascript:void(0);" onclick="createShipment(${order.id})">
                        <span class="menu-icon"><i class="ki-filled ki-ship"></i></span>
                        <span class="menu-title">Create Shipment</span>
                    </a>
                </div>
                ` : ``}
                </div>
            </div>
            </div>
        `;
    };
    function removeOrder(orderId) {
        const token = localStorage.getItem('auth_token');
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the order.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (!result.isConfirmed) return;

            fetch(`<?php echo BASE_URL; ?>/orders/${orderId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                ...(token ? { 'Authorization': `Bearer ${token}` } : {})
            }
            })
            .then(response => {
            if (response.ok) {
                Swal.fire('Deleted!', 'Order has been deleted.', 'success').then(() => {
                window.location.reload();
                });
            } else {
                Swal.fire('Error!', 'Failed to delete the order.', 'error');
            }
            })
            .catch(() => Swal.fire('Error!', 'There was an error processing your request.', 'error'));
        });
    }
    function checkOrderShippingCost(orderId) {
        const token = localStorage.getItem('auth_token');

        // simple HTML esc helper (local to this function)
        const esc = (s = "") =>
            String(s).replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[c]));

        if (!orderId) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Order',
                text: 'Order ID is missing.',
                customClass: { popup: 'swal2-my-small-popup swal2-small-popup' }
            });
            return;
        }

        Swal.fire({
            title: 'Fetching shipping cost...',
            didOpen: () => {
                Swal.showLoading();
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            customClass: {
                popup: 'swal2-my-small-popup swal2-small-popup'
            }
        });

        $.ajax({
            url: `<?php echo BASE_URL; ?>/delivery/shipping-cost`,
            type: 'POST',
            headers: token ? { Authorization: `Bearer ${token}` } : {},
            contentType: 'application/json',
            data: JSON.stringify({
                through: 'order',
                order_id: orderId
            }),
            success: (res) => {
                if (!res || !res.success || !Array.isArray(res.data) || !res.data.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unable to fetch',
                        text: res?.message || 'No shipping cost returned for this order.',
                        customClass: { popup: 'swal2-my-small-popup swal2-small-popup' }
                    });
                    return;
                }

                const ch = res.data[0] || {};

                const total      = Number(ch.total_amount || 0);
                const gross      = Number(ch.gross_amount || 0);
                const chargeCod  = Number(ch.charge_COD || 0);
                const chargeDl   = Number(ch.charge_DL || 0);
                const chargeDph  = Number(ch.charge_DPH || 0);
                const cgst       = Number((ch.tax_data && ch.tax_data.CGST) || 0);
                const sgst       = Number((ch.tax_data && ch.tax_data.SGST) || 0);
                const taxTotal   = cgst + sgst;
                const mode       = chargeCod > 0 ? 'COD' : 'Pre-paid';
                const zone       = ch.zone || '-';
                const cwt        = Number(ch.charged_weight || 0);

                const html = `
                    <div class="text-sm text-left space-y-3">
                        <div>
                            <div class="font-semibold text-gray-800 mb-1">
                                Summary (${esc(mode)}) &mdash; Zone ${esc(zone)}
                            </div>
                            <div class="flex justify-between text-xs">
                                <span>Charged Weight:</span>
                                <span>${cwt.toFixed(2)} kg</span>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-md p-3 bg-gray-50 space-y-1 text-xs">
                            <div class="flex justify-between">
                                <span>Base Freight (DL + DPH)</span>
                                <span>₹ ${(chargeDl + chargeDph).toFixed(2)}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>COD Fee</span>
                                <span>₹ ${chargeCod.toFixed(2)}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Gross Amount</span>
                                <span>₹ ${gross.toFixed(2)}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>GST (CGST + SGST)</span>
                                <span>₹ ${taxTotal.toFixed(2)}</span>
                            </div>
                            <hr class="my-1">
                            <div class="flex justify-between font-semibold text-gray-900">
                                <span>Total Shipping Charge</span>
                                <span>₹ ${total.toFixed(2)}</span>
                            </div>
                        </div>

                        <div class="text-[11px] text-gray-500">
                            Values are returned directly from Delhivery's invoice/charges API for this order.
                        </div>
                    </div>
                `;

                Swal.fire({
                    title: `Shipping Cost (Order #${orderId})`,
                    html: html,
                    icon: 'info',
                    showCloseButton: true,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal2-my-small-popup swal2-small-popup'
                    }
                });
            },
            error: (err) => {
                console.error('Error fetching shipping cost for order:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unable to fetch shipping cost at the moment.',
                    customClass: { popup: 'swal2-my-small-popup swal2-small-popup' }
                });
            }
        });
    }
    function trackOrderShipment(orderId) {
        const token = localStorage.getItem('auth_token');

        const esc = (s = "") =>
            String(s).replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[c]));

        if (!orderId) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Order',
                text: 'Order ID is missing.',
                customClass: { popup: 'swal2-my-small-popup swal2-small-popup' }
            });
            return;
        }

        Swal.fire({
            title: 'Fetching tracking info...',
            didOpen: () => {
                Swal.showLoading();
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            customClass: {
                popup: 'swal2-my-small-popup swal2-small-popup'
            }
        });

        $.ajax({
            url: `<?php echo BASE_URL; ?>/delivery/track`,
            type: 'POST',
            headers: token ? { Authorization: `Bearer ${token}` } : {},
            contentType: 'application/json',
            data: JSON.stringify({
                order_id: String(orderId) // "6" or "6,8" etc; here single
            }),
            success: (res) => {
                if (!res || !res.success || !res.data || !Array.isArray(res.data.ShipmentData) || !res.data.ShipmentData.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'No tracking found',
                        text: res?.message || 'No tracking data returned for this order.',
                        customClass: { popup: 'swal2-my-small-popup swal2-small-popup' }
                    });
                    return;
                }

                // Take first shipment (usually one per order)
                const shipmentWrapper = res.data.ShipmentData[0] || {};
                const shipment = shipmentWrapper.Shipment || {};

                const awb           = shipment.AWB || '-';
                const statusObj     = shipment.Status || {};
                const statusText    = statusObj.Status || 'N/A';
                const statusCode    = statusObj.StatusCode || '';
                const statusLoc     = statusObj.StatusLocation || '';
                const statusDate    = statusObj.StatusDateTime || '';
                const orderType     = shipment.OrderType || '-';
                const invoiceAmount = shipment.InvoiceAmount ?? null;
                const codAmount     = shipment.CODAmount ?? null;
                const qty           = shipment.Quantity || '-';
                const referenceNo   = shipment.ReferenceNo || ''; // your order id ref
                const consignee     = shipment.Consignee || {};
                const consigneeName = consignee.Name || '';
                const consigneeCity = consignee.City || '';
                const consigneeState= consignee.State || '';
                const consigneePin  = consignee.PinCode || '';

                // Scans sorted by date
                const scansRaw = Array.isArray(shipment.Scans) ? shipment.Scans : [];
                const scans = scansRaw
                    .map(s => s.ScanDetail || {})
                    .filter(s => s.ScanDateTime)
                    .sort((a, b) => new Date(a.ScanDateTime) - new Date(b.ScanDateTime));

                // Steps for the progress bar
                const steps = [
                    { key: 'manifested', label: 'Manifested' },
                    { key: 'picked',     label: 'Picked Up' },
                    { key: 'transit',    label: 'In Transit' },
                    { key: 'ofd',        label: 'Out for Delivery' },
                    { key: 'delivered',  label: 'Delivered' }
                ];

                function getTrackingStep(statusText, statusCode) {
                    const s = (statusText || '').toLowerCase();
                    const c = (statusCode || '').toLowerCase();

                    if (s.includes('delivered') || c === 'dl' || c === 'dlv') return 4;
                    if (s.includes('out for delivery') || s.includes('ofd') || c === 'ofd') return 3;
                    if (s.includes('transit') || s.includes('in transit')) return 2;
                    if (s.includes('picked') || s.includes('pickup') || c === 'pkp') return 1;

                    // For "Not Picked", "Manifested", etc.
                    return 0;
                }

                const currentStep = getTrackingStep(statusText, statusCode);
                const maxIndex = steps.length - 1;
                const progressPercent = Math.max(0, Math.min(100, (currentStep / maxIndex) * 100));

                // Build steps HTML
                const stepsHtml = steps.map((st, idx) => {
                    let stateClass = 'pending';
                    if (idx < currentStep) stateClass = 'completed';
                    if (idx === currentStep) stateClass = 'current';

                    return `
                        <div class="track-step ${stateClass}">
                            <div class="track-step-circle"></div>
                            <div class="track-step-label">${esc(st.label)}</div>
                        </div>
                    `;
                }).join('');

                // Timeline scans
                const timelineHtml = scans.length
                    ? scans.map(sc => {
                        const dt  = sc.ScanDateTime || '';
                        const loc = sc.ScannedLocation || '';
                        const txt = sc.Scan || '';
                        const inst= sc.Instructions || '';

                        return `
                            <div class="track-timeline-item">
                                <div class="track-timeline-dot"></div>
                                <div class="track-timeline-body">
                                    <div class="track-timeline-top">
                                        <span class="track-timeline-status">${esc(txt)}</span>
                                        <span class="track-timeline-date">${esc(dt)}</span>
                                    </div>
                                    <div class="track-timeline-mid">
                                        <span class="track-timeline-location">${esc(loc)}</span>
                                    </div>
                                    ${
                                        inst
                                            ? `<div class="track-timeline-bottom">${esc(inst)}</div>`
                                            : ''
                                    }
                                </div>
                            </div>
                        `;
                    }).join('')
                    : `<div class="text-[11px] text-gray-500">No scan history available.</div>`;

                const html = `
                    <div class="track-container">
                        <!-- Shipment summary -->
                        <div class="track-header">
                            <div class="track-header-main">
                                <div class="track-awb">AWB: <span>${esc(awb)}</span></div>
                                <div class="track-status-pill">${esc(statusText)}</div>
                            </div>
                            <div class="track-header-sub">
                                <div><span class="label">Order Ref:</span> <span>${esc(referenceNo || String(orderId))}</span></div>
                                <div><span class="label">Type:</span> <span>${esc(orderType)}</span></div>
                                <div><span class="label">Qty:</span> <span>${esc(qty)}</span></div>
                                ${
                                    invoiceAmount != null
                                        ? `<div><span class="label">Invoice:</span> <span>₹${Number(invoiceAmount).toFixed(2)}</span></div>`
                                        : ''
                                }
                                ${
                                    codAmount != null
                                        ? `<div><span class="label">COD:</span> <span>₹${Number(codAmount).toFixed(2)}</span></div>`
                                        : ''
                                }
                            </div>
                            <div class="track-header-dest">
                                <div class="label">Consignee</div>
                                <div class="value">
                                    ${esc(consigneeName || '')}<br>
                                    ${esc(consigneeCity || '')}${consigneeCity && consigneeState ? ', ' : ''}${esc(consigneeState || '')} ${consigneePin ? '- ' + esc(consigneePin) : ''}
                                </div>
                            </div>
                        </div>

                        <!-- Progress bar -->
                        <div class="track-progress">
                            <div class="track-bar-bg">
                                <div class="track-bar-fill" data-progress="${progressPercent}" style="width:0;"></div>
                            </div>
                            <div class="track-steps">
                                ${stepsHtml}
                            </div>
                            <div class="track-last-update">
                                <span class="label">Last update:</span>
                                <span class="value">${esc(statusDate)} at ${esc(statusLoc)}</span>
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="track-timeline-wrapper">
                            <div class="track-timeline-title">Tracking History</div>
                            <div class="track-timeline">
                                ${timelineHtml}
                            </div>
                        </div>
                    </div>
                `;

                Swal.fire({
                    title: `Shipment Tracking (Order #${orderId})`,
                    html: html,
                    showCloseButton: true,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal2-my-small-popup swal2-small-popup'
                    },
                    didOpen: () => {
                        // Animate bar
                        const fill = document.querySelector('.track-bar-fill');
                        if (fill) {
                            const target = fill.getAttribute('data-progress') || '0';
                            requestAnimationFrame(() => {
                                fill.style.width = target + '%';
                            });
                        }

                        // Animate steps (fade in)
                        document.querySelectorAll('.track-step').forEach((el, idx) => {
                            setTimeout(() => {
                                el.classList.add('track-step-visible');
                            }, 80 * idx);
                        });

                        // Animate timeline items
                        document.querySelectorAll('.track-timeline-item').forEach((el, idx) => {
                            setTimeout(() => {
                                el.classList.add('track-timeline-visible');
                            }, 60 * idx);
                        });
                    }
                });
            },
            error: (err) => {
                console.error('Error fetching tracking for order:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unable to fetch tracking details at the moment.',
                    customClass: { popup: 'swal2-my-small-popup swal2-small-popup' }
                });
            }
        });
    }
    function createShipment(orderId) {
        const token = localStorage.getItem('auth_token');

const money = (n) => {
  const num = Number(n);
  return isFinite(num) ? num.toFixed(2) : "0.00";
};

const buildRatePayload = () => {
  const origin_pin = String($('#pickup_pin').val() || '').trim();
  const destination_pin = String($('#pin').val() || '').trim();

  const w = parseFloat($('#weight').val() || 0);
  const q = parseFloat($('#quantity').val() || 0);
  const weight = Math.max(0, (isFinite(w) ? w : 0) * (isFinite(q) ? q : 0));

  return { through: "simple", origin_pin, destination_pin, weight };
};

const flattenShippingOptions = (provider, res) => {
  const sh = res?.data?.shippings || res?.data?.data?.shippings || res?.data?.shippings;
  if (!sh) return [];

  const modes = ["air", "surface"];
  const levels = ["normal", "express"];
  const out = [];

  modes.forEach(mode => {
    levels.forEach(level => {
      const node = sh?.[mode]?.[level];
      if (!node?.ok) return;

      const sm = node.summary || {};
      out.push({
        provider,
        mode,
        service_level: level,
        total_amount: sm.total_amount ?? 0,
        eta_days: sm.eta_days ?? null,
        courier_name: sm.courier_name ?? null,
        courier_id: sm.courier_id ?? null
      });
    });
  });

  return out;
};

const optionLabel = (o) => {
  if (o.provider === "delhivery") {
    return `Delhivery ${o.mode}-${o.service_level} Rs: ${money(o.total_amount)}`;
  }
  return `Shiprocket ${o.mode}-${o.service_level} Rs: ${money(o.total_amount)} - ${o.eta_days ?? "N/A"}(eta) - ${o.courier_name || "-"}`;
};

const setRateSelectLoading = (txt) => {
  $('#shipping_rate_select').html(`<option value="">${txt}</option>`);
  $('#shipping_rate_hint').text(txt);
  $('#shipping_rate_summary').text('No option selected.');
};

const fillRateSelect = (options) => {
  if (!options.length) {
    setRateSelectLoading("No rates found for this provider.");
    return;
  }

  const html = [
    `<option value="">Select an option...</option>`,
    ...options.map((o, idx) => `
      <option value="${idx}"
        data-provider="${o.provider}"
        data-mode="${o.mode}"
        data-service="${o.service_level}"
        data-courier-id="${o.courier_id ?? ''}"
        data-courier-name="${(o.courier_name ?? '').replace(/"/g,'&quot;')}"
        data-amount="${o.total_amount ?? 0}"
        data-eta="${o.eta_days ?? ''}"
      >
        ${optionLabel(o)}
      </option>
    `)
  ].join("");

  $('#shipping_rate_select').html(html);
  $('#shipping_rate_hint').text("Select an option to auto-fill Shipping Mode + Service Level.");
};

const fetchProviderRates = (provider) => {
  const payload = buildRatePayload();

  if (!payload.origin_pin || !payload.destination_pin || !payload.weight) {
    return Promise.resolve({ ok:false, options:[], message:"Fill Pickup Pin, Customer Pin, Weight and Quantity." });
  }

  const url = provider === "delhivery"
    ? `<?php echo BASE_URL; ?>/delivery/shipping-cost`
    : `<?php echo BASE_URL; ?>/shiprocket/rates`;

  return $.ajax({
    url,
    type: "POST",
    headers: token ? { Authorization: `Bearer ${token}` } : {},
    contentType: "application/json",
    data: JSON.stringify(payload),
  }).then(res => {
    if (!res?.success) return { ok:false, options:[], message:res?.message || "Failed" };
    return { ok:true, options: flattenShippingOptions(provider, res), message:"Loaded" };
  }).catch(() => ({ ok:false, options:[], message:"API error" }));
};

        // Show loading popup
        Swal.fire({
            title: 'Fetching shipment data...',
            didOpen: () => {
                Swal.showLoading();
            },
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
        });

        $.ajax({
            url: "<?php echo BASE_URL; ?>/delivery/check_shipment", // Replace with actual base URL
            type: 'POST',
            headers: token ? { Authorization: `Bearer ${token}` } : {},
            contentType: 'application/json',
            data: JSON.stringify({ order_id: orderId }),
            success: (res) => {
                Swal.close(); // Close loading popup

                if (res.success && res.data) {
                    const shipmentData = res.data.payload;

                    // Create the popup form with pre-filled data
                    const popupContent = `
                        <div id="shipment-form-grid" class="shipment-form-grid">
                            <!-- Customer Details Section -->
                            <h4>Customer Details</h4>
                            <div class="form-section">
                                <div><label for="customer_name">Customer Name:</label><input id="customer_name" type="text" value="${shipmentData.customer_name}" class="input-field" /></div>
                                <div><label for="customer_address">Customer Address:</label><input id="customer_address" type="text" value="${shipmentData.customer_address}" class="input-field" /></div>
                                <div><label for="pin">Pin:</label><input id="pin" type="text" value="${shipmentData.pin}" class="input-field" /></div>
                                <div><label for="city">City:</label><input id="city" type="text" value="${shipmentData.city}" class="input-field" /></div>
                                <div><label for="state">State:</label><input id="state" type="text" value="${shipmentData.state}" class="input-field" /></div>
                                <div><label for="phone">Phone:</label><input id="phone" type="text" value="${shipmentData.phone}" class="input-field" /></div>
                            </div>

                            <!-- Pickup Details Section -->
                            <h4>Pickup Details</h4>
                            <div class="form-section">
                                <div><label for="pickup_name">Pickup Name:</label><input id="pickup_name" type="text" value="${shipmentData.pickup_name}" class="input-field" /></div>
                                <div><label for="pickup_address">Pickup Address:</label><input id="pickup_address" type="text" value="${shipmentData.pickup_address}" class="input-field" /></div>
                                <div><label for="pickup_pin">Pickup Pin:</label><input id="pickup_pin" type="text" value="${shipmentData.pickup_pin}" class="input-field" /></div>
                                <div><label for="pickup_city">Pickup City:</label><input id="pickup_city" type="text" value="${shipmentData.pickup_city}" class="input-field" /></div>
                                <div><label for="pickup_state">Pickup State:</label><input id="pickup_state" type="text" value="${shipmentData.pickup_state}" class="input-field" /></div>
                                <div><label for="pickup_phone">Pickup Phone:</label><input id="pickup_phone" type="text" value="${shipmentData.pickup_phone}" class="input-field" /></div>
                            </div>

                            <!-- Return Details Section -->
                            <h4>Return Details</h4>
                            <div class="form-section">
                                <div><label for="return_pin">Return Pin:</label><input id="return_pin" type="text" value="${shipmentData.return_pin}" class="input-field" /></div>
                                <div><label for="return_city">Return City:</label><input id="return_city" type="text" value="${shipmentData.return_city}" class="input-field" /></div>
                                <div><label for="return_phone">Return Phone:</label><input id="return_phone" type="text" value="${shipmentData.return_phone}" class="input-field" /></div>
                                <div><label for="return_address">Return Address:</label><input id="return_address" type="text" value="${shipmentData.return_address}" class="input-field" /></div>
                                <div><label for="return_state">Return State:</label><input id="return_state" type="text" value="${shipmentData.return_state}" class="input-field" /></div>
                                <div><label for="return_country">Return Country:</label><input id="return_country" type="text" value="${shipmentData.return_country}" class="input-field" /></div>
                            </div>

                            <!-- Seller Details Section -->
                            <h4>Seller Details</h4>
                            <div class="form-section">
                                <div><label for="seller_name">Seller Name:</label><input id="seller_name" type="text" value="${shipmentData.seller_name}" class="input-field" /></div>
                                <div><label for="seller_address">Seller Address:</label><input id="seller_address" type="text" value="${shipmentData.seller_address}" class="input-field" /></div>
                                <div><label for="seller_invoice">Seller Invoice:</label><input id="seller_invoice" type="text" value="${shipmentData.seller_invoice}" class="input-field" /></div>
                            </div>

                            <!-- Product Details Section -->
                            <h4>Product Details</h4>
                            <div class="form-section">
                                <div><label for="products_description">Products Description:</label><input id="products_description" type="text" value="${shipmentData.products_description}" class="input-field" /></div>
                                <div><label for="quantity">Quantity:</label><input id="quantity" type="text" value="${shipmentData.quantity}" class="input-field" /></div>
                                <div><label for="weight">Weight:</label><input id="weight" type="text" value="${shipmentData.weight}" class="input-field" /></div>
                                <div><label for="shipment_length">Shipment Length:</label><input id="shipment_length" type="text" value="${shipmentData.shipment_length}" class="input-field" /></div>
                                <div><label for="shipment_width">Shipment Width:</label><input id="shipment_width" type="text" value="${shipmentData.shipment_width}" class="input-field" /></div>
                                <div><label for="shipment_height">Shipment Height:</label><input id="shipment_height" type="text" value="${shipmentData.shipment_height}" class="input-field" /></div>
                            </div>

                            <!-- Payment and Other Details Section -->
                            <h4>Payment and Other Details</h4>
                            <div class="form-section">
                                <div><label for="order_no">Order No:</label><input id="order_no" type="text" value="${shipmentData.order_no}" class="input-field" /></div>
                                <div><label for="payment_mode">Payment Mode:</label><input id="payment_mode" type="text" value="${shipmentData.payment_mode}" class="input-field" /></div>
                                <div><label for="total_amount">Total Amount:</label><input id="total_amount" type="text" value="${shipmentData.total_amount}" class="input-field" /></div>
                                <div><label for="cod_amount">COD Amount:</label><input id="cod_amount" type="text" value="${shipmentData.cod_amount}" class="input-field" /></div>
                                <div><label for="shipping_mode">Shipping Mode:</label><input id="shipping_mode" type="text" value="${shipmentData.shipping_mode}" class="input-field" /></div>
                                <div><label for="address_type">Address Type:</label><input id="address_type" type="text" value="${shipmentData.address_type}" class="input-field" /></div>
                                <div><label for="service_level">Service Level:</label><input id="service_level" type="text" value="${shipmentData.service_level || 'normal'}" class="input-field" /></div>
                            </div>

                            <!-- Other Details Section -->
                            <h4>Other Details</h4>
                            <div class="form-section">
                                <div><label for="order_date">Order Date:</label><input id="order_date" type="text" value="${shipmentData.order_date}" class="input-field" /></div>
                                <!-- NEW: Provider Radio -->
                                <div>
                                    <label>Ship With:</label>
                                    <div class="ship-provider">
                                        <label class="ship-radio">
                                            <input type="radio" name="ship_provider" value="delhivery" checked>
                                            Delhivery
                                        </label>
                                        <label class="ship-radio">
                                            <input type="radio" name="ship_provider" value="shiprocket">
                                            Shiprocket
                                        </label>
                                    </div>
                                </div>

                                <!-- NEW: Dropdown -->
                                <div style="grid-column: span 6;">
                                    <label for="shipping_rate_select">Select Shipping Option:</label>
                                    <select id="shipping_rate_select" class="input-field">
                                    <option value="">Select provider to load rates...</option>
                                    </select>
                                    <div id="shipping_rate_hint" class="ship-hint">Select a provider to fetch rates.</div>
                                </div>

                                <!-- NEW: Selected summary -->
                                <div style="grid-column: span 6;">
                                    <div id="shipping_rate_summary" class="ship-summary">No option selected.</div>
                                </div>
                            </div>
                        </div>
                    `;
                    // Show the popup with the form
                    Swal.fire({
                        title: `Create Shipment for Order #${orderId}`,
                        html: popupContent,
                        showCancelButton: true,
                        confirmButtonText: 'Delhivery Punch',
                        cancelButtonText: 'Cancel',
                        showCloseButton: true,
                        customClass: {
                            popup: 'shipment_popup' // Use the new custom class for the popup
                        },
                        didOpen: async () => {
                            // Load Delhivery rates by default
                            setRateSelectLoading("Fetching rates...");
                            const r = await fetchProviderRates("delhivery");
                            if (!r.ok) setRateSelectLoading(r.message);
                            else fillRateSelect(r.options);

                            // On radio change
                            $('input[name="ship_provider"]').on("change", async function () {
                                const provider = this.value;
                                setRateSelectLoading("Fetching rates...");
                                const rr = await fetchProviderRates(provider);
                                if (!rr.ok) setRateSelectLoading(rr.message);
                                else fillRateSelect(rr.options);

                                // reset auto filled fields
                                $('#shipping_mode').val("");
                                $('#service_level').val("");
                            });

                            // On dropdown change => auto fill fields
                            $("#shipping_rate_select").on("change", function () {
                                const opt = this.options[this.selectedIndex];
                                if (!opt || !opt.dataset.provider) {
                                    $('#shipping_rate_summary').text("No option selected");
                                    return;
                                }

                                $('#shipping_mode').val(opt.dataset.mode);
                                $('#service_level').val(opt.dataset.service);

                                const provider = opt.dataset.provider;
                                const courierName = opt.dataset.courierName || '';
                                const courierId = opt.dataset.courierId || '';
                                const eta = opt.dataset.eta || '';
                                const amount = opt.dataset.amount || '';

                                $('#shipping_rate_summary').text(
                                    provider === "delhivery"
                                    ? `Selected Delhivery ${opt.dataset.mode}-${opt.dataset.service} ₹${money(amount)}`
                                    : `Selected Shiprocket ${opt.dataset.mode}-${opt.dataset.service} ₹${money(amount)} ETA:${eta} Courier:${courierName} ID:${courierId}`
                                );
                            });
                        },
                        preConfirm: () => {
                            const provider = $('input[name="ship_provider"]:checked').val();
                            const selected = document.querySelector('#shipping_rate_select option:checked');

                            if (!selected || !selected.dataset.provider) {
                                Swal.showValidationMessage("Please select a shipping option.");
                                return false;
                            }

                            const mode = selected.dataset.mode;       // air/surface
                            const service = selected.dataset.service; // normal/express
                            const courierId = selected.dataset.courierId; // shiprocket
                            const courierName = selected.dataset.courierName;

                            // ✅ make sure fields updated
                            $('#shipping_mode').val(mode);
                            $('#service_level').val(service);

                            const payload = {
                                customer_name: $('#customer_name').val(),
                                customer_address: $('#customer_address').val(),
                                pin: $('#pin').val(),
                                city: $('#city').val(),
                                state: $('#state').val(),
                                phone: $('#phone').val(),
                                order_no: $('#order_no').val(),

                                payment_mode: $('#payment_mode').val(),
                                total_amount: $('#total_amount').val(),
                                cod_amount: $('#cod_amount').val(),

                                products_description: $('#products_description').val(),
                                quantity: $('#quantity').val(),
                                weight: $('#weight').val(),
                                order_date: $('#order_date').val(),

                                seller_name: $('#seller_name').val(),
                                seller_address: $('#seller_address').val(),
                                seller_invoice: $('#seller_invoice').val(),

                                pickup_name: $('#pickup_name').val(),
                                pickup_address: $('#pickup_address').val(),
                                pickup_pin: $('#pickup_pin').val(),
                                pickup_city: $('#pickup_city').val(),
                                pickup_state: $('#pickup_state').val(),
                                pickup_phone: $('#pickup_phone').val(),

                                shipment_length: $('#shipment_length').val(),
                                shipment_width: $('#shipment_width').val(),
                                shipment_height: $('#shipment_height').val(),

                                shipping_mode: mode,
                                service_level: service,

                                address_type: $('#address_type').val(),
                                return_pin: $('#return_pin').val(),
                                return_city: $('#return_city').val(),
                                return_phone: $('#return_phone').val(),
                                return_address: $('#return_address').val(),
                                return_state: $('#return_state').val(),
                                return_country: $('#return_country').val(),
                            };

                            let apiUrl = "";
                            let formData = {};

                            if (provider === "delhivery") {
                                payload.courier = "Delhivery";
                                apiUrl = `<?php echo BASE_URL; ?>/delivery/punch_shipment`;
                                formData = { order_id: orderId, payload };
                            } else {
                                apiUrl = `<?php echo BASE_URL; ?>/shiprocket/punch-by-payload`;
                                formData = { order_id: orderId, courier_id: Number(courierId), payload };
                            }

                            $.ajax({
                                url: apiUrl,
                                type: 'POST',
                                headers: token ? { Authorization: `Bearer ${token}` } : {},
                                contentType: 'application/json',
                                data: JSON.stringify(formData),
                                success: (response) => {
                                if (response.success) {
                                    Swal.fire('Success', 'Shipment punched successfully!', 'success');
                                } else {
                                    Swal.fire('Error', response.message || 'Failed to punch shipment.', 'error');
                                }
                                },
                                error: () => Swal.fire('Error', 'API error while punching shipment', 'error')
                            });
                        },
                    });
                } else {
                    Swal.fire('Error', 'Failed to fetch shipment data.', 'error');
                }
            },
            error: () => {
                Swal.fire('Error', 'Unable to fetch shipment data at the moment.', 'error');
            }
        });
    }
</script>
<!-- Shhipment popup style -->
<style>
    /* Styling for headings (h4) */
    h4 {
        font-size: 16px;
        font-weight: 600;
        /* margin-bottom: 10px; */
        text-align: left;
        color: #005d5a;
        width: 100%;
        padding: 5px;
        background: #e6e6e6;
        border-radius: 10px;
        margin-bottom: 5px;
    }
    /* Form Section */
    .form-section {
        margin-bottom: 10px;
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 10px;
    }
    /* Layout for the form */
    #shipment-form-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr); /* 2 columns for larger screens */
        gap: 0px;
        padding: 0px;
    }
    .swal2-confirm {
        background-color: #005d5a !important; /* Change "Punch" button to blue */
    }
    /* Custom popup style */
    .shipment_popup {
        width: 1100px; /* Fixed width of the popup */
        max-width:95vw !important;
        padding: 10px !important;
        font-size: 0.85rem;
        line-height: 1.3;
    }
    .form-section div{
        display: flex;
        flex-direction: column;
    }
    /* Input field styling */
    .input-field {
        width: 100%;
        padding: 6px; /* Slightly larger padding for better spacing */
        margin-bottom: 5px; /* More space between fields */
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px; /* Ensure consistency */
    }

    /* Styling for labels */
    #shipment-form-grid label {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 5px;
        text-align: left;
    }

    /* Adjustments for compact grid */
    @media (max-width: 1024px) {
        
        .form-section {
            margin-bottom: 10px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
    }
    @media (max-width: 768px) {
        #shipment-form-grid {
            grid-template-columns: 1fr; /* 1 column for smaller screens */
        }
        .form-section {
            margin-bottom: 10px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0px;
        }
    }
</style>
<style>
  /* SweetAlert small popup reused */
  .swal2-my-small-popup {
      font-size: 0.85rem;
      line-height: 1.3;
  }
  .swal2-small-popup {
      width: 520px !important;
      max-width: 95vw !important;
      padding: 18px 22px !important;
  }

  /* Tracking container */
  .track-container {
      font-size: 0.85rem;
      color: #111827; /* gray-900 */
  }

  .track-header {
      display: grid;
      grid-template-columns: minmax(0,2fr);
      row-gap: 8px;
      column-gap: 12px;
      margin-bottom: 12px;
  }

  @media (min-width: 640px) {
      .track-header {
          grid-template-columns: minmax(0,2fr) minmax(0,2fr) minmax(0,2fr);
      }
  }

  .track-header-main {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
  }

  .track-awb span {
      font-weight: 600;
  }

  .track-status-pill {
      padding: 2px 8px;
      border-radius: 999px;
      background: #fee2e2; /* red-100 */
      color: #b91c1c;      /* red-700 */
      font-size: 11px;
      font-weight: 600;
      white-space: nowrap;
  }

  .track-header-sub {
      display: flex;
      flex-wrap: wrap;
      gap: 6px 12px;
      font-size: 11px;
      color: #4b5563; /* gray-600 */
  }

  .track-header-sub .label {
      font-weight: 600;
      margin-right: 3px;
  }

  .track-header-dest .label {
      font-size: 11px;
      color: #6b7280;
      margin-bottom: 2px;
  }

  .track-header-dest .value {
      font-size: 12px;
      background: #f9fafb;
      border-radius: 4px;
      padding: 4px 6px;
      border: 1px solid #e5e7eb;
  }

  /* Progress bar */
  .track-progress {
      margin-top: 10px;
      margin-bottom: 12px;
  }

  .track-bar-bg {
      position: relative;
      height: 4px;
      border-radius: 999px;
      background: #e5e7eb;
      overflow: hidden;
      margin-bottom: 18px;
  }

  .track-bar-fill {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      background: #16a34a; /* green-600 */
      width: 0;
      transition: width 0.6s ease-out;
  }

  .track-steps {
      display: flex;
      justify-content: space-between;
      gap: 4px;
      margin-bottom: 6px;
  }

  .track-step {
      flex: 1;
      text-align: center;
      font-size: 11px;
      color: #6b7280;
      opacity: 0;
      transform: translateY(4px);
      transition: all 0.25s ease-out;
  }

  .track-step-visible {
      opacity: 1;
      transform: translateY(0);
  }

  .track-step-circle {
      width: 14px;
      height: 14px;
      margin: 0 auto 3px auto;
      border-radius: 999px;
      border: 2px solid #d1d5db; /* gray-300 */
      background: #f9fafb;
      box-sizing: border-box;
  }

  .track-step.completed .track-step-circle {
      background: #16a34a;
      border-color: #16a34a;
  }

  .track-step.current .track-step-circle {
      background: #2563eb; /* blue-600 */
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.25);
  }

  .track-step-label {
      line-height: 1.1;
  }

  .track-last-update {
      font-size: 11px;
      color: #6b7280;
      display: flex;
      justify-content: space-between;
      gap: 4px;
      flex-wrap: wrap;
  }

  .track-last-update .label {
      font-weight: 600;
  }

  /* Timeline */
  .track-timeline-wrapper {
      margin-top: 10px;
  }

  .track-timeline-title {
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 6px;
      color: #111827;
  }

  .track-timeline {
      max-height: 260px;
      overflow-y: auto;
      padding-right: 4px;
  }

  .track-timeline-item {
      display: flex;
      gap: 8px;
      margin-bottom: 8px;
      opacity: 0;
      transform: translateX(-4px);
      transition: all 0.2s ease-out;
  }

  .track-timeline-visible {
      opacity: 1;
      transform: translateX(0);
  }

  .track-timeline-dot {
      width: 8px;
      height: 8px;
      margin-top: 4px;
      border-radius: 999px;
      background: #2563eb;
      flex-shrink: 0;
  }

  .track-timeline-body {
      flex: 1;
      font-size: 11px;
      border-left: 1px solid #e5e7eb;
      padding-left: 8px;
  }

  .track-timeline-top {
      display: flex;
      justify-content: space-between;
      gap: 6px;
      margin-bottom: 2px;
  }

  .track-timeline-status {
      font-weight: 600;
      color: #111827;
  }

  .track-timeline-date {
      color: #6b7280;
      white-space: nowrap;
  }

  .track-timeline-mid {
      color: #4b5563;
      margin-bottom: 2px;
  }

  .track-timeline-bottom {
      color: #6b7280;
      font-style: italic;
  }
</style>
<style>
    /* ETA animation */
    /* .tat-info {
        opacity: 0;
        transform: translateY(3px);
        transition: opacity 0.3s ease-out, transform 0.3s ease-out;
    } */

    .tat-info.tat-loading {
        opacity: 0.6;
        transform: translateY(0);
        font-style: italic;
    }

    .tat-info.tat-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .tat-info.tat-error {
        opacity: 1;
        transform: translateY(0);
        color: #b91c1c; /* red-700 */
    }
</style>
<!-- Footer -->
<?php include("footer1.php"); ?>