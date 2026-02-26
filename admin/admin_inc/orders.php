    <main class="grow content pt-5" id="content" role="content">
        <!-- Container -->
        <div class="container-fixed" id="content_container">
        </div>
        <!-- Container -->
        <div class="">
            <div class="grid gap-5 lg:gap-7.5">
                <div class="card card-grid min-w-full">
                    <div class="card-header py-5 flex-wrap gap-2">
                        <h3 class="card-title">
                            Overview of <span id="count-orders"> 00 </span>
                        </h3>
                        <div class="flex gap-6">
                            <!-- Order ID Search -->
                            <div class="relative">
                                <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
                                <input class="input input-sm pl-8" data-datatable-search-order placeholder="Search Order ID" type="text" />
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
                                            <th class="min-w-[165px]">
                                                <span class="sort asc">
                                                    <span class="sort-label text-gray-700 font-normal">Order Date</span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="text-gray-700 font-normal min-w-[100px]">Order Code</th>
                                            <th class="min-w-[165px]">
                                                <span class="sort">
                                                    <span class="sort-label text-gray-700 font-normal">Invoice Number</span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th><th class="min-w-[100px]">
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
            let itemsPerPage = 5;
            let currentPage = 1;
            let totalItems = 0;

            let orderIdQuery = ""; // Store Order ID filter
            let dateQuery = ""; // Store Date filter
            let userNameQuery = ""; // Store User Name filter

            const fetchOrders = () => {
                const offset = (currentPage - 1) * itemsPerPage; // Correctly setting offset

                let requestData = { 
                    limit: itemsPerPage, 
                    offset: offset 
                };

                // Include filters only if they have values
                if (orderIdQuery) requestData.order_id = orderIdQuery;
                if (dateQuery) requestData.date = dateQuery;
                if (userNameQuery) requestData.user_name = userNameQuery;

                $.ajax({
                    url: `<?php echo BASE_URL; ?>/fetch_all`,
                    type: 'POST',
                    headers: { Authorization: `Bearer ${token}` },
                    data: requestData,  // Send requestData directly
                    success: (response) => {
                        if (response?.success && response.data) {
                            totalItems = response.total_orders ?? response.data.length;
                            console.log("Total Orders:", totalItems);
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

            // Debounce function to limit API calls while typing
            const debounce = (func, delay) => {
                let timer;
                return function (...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            };

            // Search by Order ID
            $("[data-datatable-search-order]").on("input", debounce(function () {
                orderIdQuery = $(this).val().trim();
                fetchOrders();
            }, 300));

            // Search by User Name (Triggers API call after 3 letters)
            $("[data-datatable-search-user]").on("input", debounce(function () {
                let query = $(this).val().trim();
                if (query.length >= 3) {
                    userNameQuery = query;
                    fetchOrders();
                } else if (query.length === 0) {
                    userNameQuery = "";
                    fetchOrders();
                }
            }, 300));

            // Filter by Date
            $("[data-datatable-date]").on("change", function () {
                dateQuery = $(this).val();
                fetchOrders();
            });

            // Populate Table with Orders
            const populateTable = (data) => {
                const tbody = $("#orders-table tbody");
                tbody.empty();

                if (data.length === 0) {
                    tbody.append(`<tr><td colspan="10" class="text-center text-gray-500">No orders found.</td></tr>`);
                    return;
                }

                data.forEach((order) => {
                    tbody.append(`
                        <tr>
                            <td class="text-center">
                                <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="${order.id}">
                            </td>
                            <td><span class="text-xs text-gray-700 font-normal">${new Date(order.created_at).toLocaleString()}</span></td>
                            <td><span class="badge badge-sm badge-light badge-outline">${order.id}</span></td>
                            <td><span class="text-xs text-gray-700 font-normal">${order.razorpay_order_id || "N/A"}</span></td>
                            <td>
                                <span class="text-xs text-gray-700 font-normal">${order.user?.name || "N/A"}</span>
                                <span class="badge text-warning">${order.user?.role || "N/A"}</span>
                            </td>
                            <td>
                                <span class="text-xs text-gray-700 font-normal">₹${order.total_amount}</span>  
                                <span class="badge text-danger">${order.payment_status}</span>
                            </td>                            
                            <td class="w-[60px]">${generateActionButtons(order)}</td>
                        </tr>
                    `);
                });
            };

            // Get status badge class dynamically
            const getStatusClass = (status) => {
                const statusClasses = {
                    pending: "badge-warning",
                    completed: "badge-success",
                    canceled: "badge-danger",
                    failed: "badge-secondary"
                };
                return statusClasses[status] || "badge-primary";
            };

            // Update Pagination
            const updatePagination = () => {
                const totalPages = Math.ceil(totalItems / itemsPerPage);
                const pagination = $(".pagination");
                pagination.empty();

                if (currentPage > 1) {
                    pagination.append(`<button class="btn btn-sm" data-page="${currentPage - 1}">Previous</button>`);
                }

                const startPage = Math.max(1, currentPage - 2);
                const endPage = Math.min(totalPages, currentPage + 2);

                for (let page = startPage; page <= endPage; page++) {
                    const isActive = page === currentPage ? "active" : "";
                    pagination.append(`<button class="btn btn-sm ${isActive}" data-page="${page}">${page}</button>`);
                }

                if (currentPage < totalPages) {
                    pagination.append(`<button class="btn btn-sm" data-page="${currentPage + 1}">Next</button>`);
                }
                $("#count-orders").text(`${totalItems} Orders`);
            };

            // Pagination Button Click Event
            $(".pagination").on("click", "button", function () {
                currentPage = parseInt($(this).data("page"));
                fetchOrders();
            });

            // Change Items Per Page
            $("[data-datatable-size]").on("change", function () {
                itemsPerPage = parseInt($(this).val());
                currentPage = 1;
                fetchOrders();
            });

            // Populate items per page dropdown
            const perPageSelect = $("[data-datatable-size]");
            [5, 10, 25, 50, 100].forEach((size) => {
                perPageSelect.append(`<option value="${size}">${size}</option>`);
            });
            perPageSelect.val(itemsPerPage);

            // Fetch initial data
            fetchOrders();
        });

        // Generate action buttons for each row
        const generateActionButtons = (order) => {
            return `
                <div class="menu" data-menu="true">
                    <div class="menu-item menu-item-dropdown" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                        <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                            <i class="ki-filled ki-dots-vertical">
                            </i>
                        </button>
                        <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true" style="">
                            <div class="menu-item">
                                <a class="menu-link" href="orders.php?o_id=${order.id}">
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
                                <a class="menu-link" href="orders.php?o_id=${order.id}">
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
                                <a class="menu-link" href="orders.php?o_id=${order.id}">
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