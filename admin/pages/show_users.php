<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>

<?php 
    $current_page = "Show Users"; // Dynamically set this based on the page
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
                            Users
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
                                Overview of <span id="count-users"> 00 </span>
                            </h3>
                            <div class="flex gap-6">

                                <!-- Role Selection Filter -->
                                <div>
                                    <select class="select select-sm w-24" data-datatable-role>
                                        <!-- <option value="customer" selected>Customer</option> -->
                                        <option value="">User Type</option>
                                        <option value="customer">Customer</option>
                                        <option value="vendor">Vendor</option>
                                        <option value="admin">Admin</option>
                                        <option value="dealer">Dealer</option>
                                        <option value="architect">Architect</option>
                                    </select>
                                </div>
                                <div class="relative">
                                    <i
                                        class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3">
                                    </i>
                                    <input class="input input-sm pl-8" data-datatable-search="#users_table"
                                        placeholder="Search Users" type="text" />
                                </div>
                                <label class="switch switch-sm">
                                    <input class="order-2" name="check" type="checkbox" value="1" />
                                    <span class="switch-label order-1">
                                        Active Users
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div data-datatable="true" data-datatable-page-size="10">
                                <div class="scrollable-x-auto">
                                    <table class="table table-border" data-datatable-table="true" id="users-table">
                                        <thead>
                                            <tr>
                                                <th class="w-[60px] text-center">
                                                    <input class="checkbox checkbox-sm" data-datatable-check="true"
                                                        type="checkbox" />
                                                </th>
                                                <th class="min-w-[300px]">
                                                    <span class="sort asc">
                                                        <span class="sort-label text-gray-700 font-normal">
                                                            Member
                                                        </span>
                                                        <span class="sort-icon">
                                                        </span>
                                                    </span>
                                                </th>
                                                <th class="text-gray-700 font-normal min-w-[100px]">
                                                    Roles
                                                </th>
                                                <th class="text-gray-700 font-normal min-w-[100px]">
                                                    Selected Type
                                                </th>
                                                <th class="text-gray-700 font-normal min-w-[100px]">
                                                    GSTIN Number
                                                </th>
                                                <th class="min-w-[165px]">
                                                    <span class="sort">
                                                        <span class="sort-label text-gray-700 font-normal">
                                                            Mobile
                                                        </span>
                                                        <span class="sort-icon">
                                                        </span>
                                                    </span>
                                                </th>
                                                <th class="min-w-[165px]">
                                                    <span class="sort">
                                                        <span class="sort-label text-gray-700 font-normal">
                                                            Status
                                                        </span>
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
                                        <select class="select select-sm w-16" data-datatable-size=""
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

<!-- Switch User -->
<script>
    function openSwitchUserPopup(userId, selectedType, userName) {
        const roles = {
            admin: 'Admin',
            customer: 'Customer',
            architect: 'Architect',
            dealer: 'Dealer'
        };

        const roleButtons = Object.entries(roles)
            .map(([key, label]) => `
            <label class="role-option ${selectedType === key ? 'selected' : ''}" data-role="${key}">
                <input type="radio" name="role" value="${key}" ${selectedType === key ? 'checked' : ''}>
                <span>${label}</span>
            </label>
            `)
            .join('');

        Swal.fire({
            title: 'Switch User Role',
            html: `
                <p class="swal-subtitle">Change the role of <b>${userName}</b></p>
                <div class="role-options-grid">${roleButtons}</div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Update Role',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            // customClass: {
            //     popup: 'swal2-popup-custom',        
            // },
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            didOpen: () => {
            document.querySelectorAll('.role-option').forEach(el => {
                el.addEventListener('click', () => {
                document.querySelectorAll('.role-option').forEach(opt => opt.classList.remove('selected'));
                el.classList.add('selected');
                el.querySelector('input').checked = true;
                });
            });
            },
            preConfirm: () => {
            const selectedRole = document.querySelector('input[name="role"]:checked');
            if (!selectedRole) {
                Swal.showValidationMessage('Please select a role');
                return false;
            }
            return selectedRole.value;
            }
        }).then((result) => {
            if (result.isConfirmed) {
            const selectedRole = result.value;
            switchUser(userId, selectedRole);
            }
        });
    }

    // 💅 Basic CSS styling for nicer layout
    const style = document.createElement('style');
        style.textContent = `
        .swal-subtitle {
            font-size: 14px;
            margin-bottom: 10px;
            color: #555;
        }
        .role-options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }
        .role-option {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 8px 10px;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s ease;
            background-color: #fafafa;
        }
        .role-option.selected {
            border-color: #3085d6;
            background-color: #e8f3ff;
            font-weight: 600;
            color: #1d4ed8;
        }
        .role-option input {
            display: none;
        }
        .role-option span {
            font-size: 14px;
        }
        @media (max-width: 520px) {
            .role-options-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 10px;
                margin-top: 15px;
            }
        }
        `;
    document.head.appendChild(style);

    // Function to handle the switch-user API call
    function switchUser(userId, selectedType) {
        const token = localStorage.getItem('auth_token');  // Get the auth token from local storage

        // Data to send in the body
        const requestData = {
            user_id: userId,
            role: selectedType.toLowerCase()  // Convert role to lowercase
        };

        // API call to switch user
        $.ajax({
            url: `<?php echo BASE_URL; ?>/switch_user`,  // Replace with the actual endpoint
            type: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,  // Send the auth token in the header
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(requestData),  // Send user_id and selected_type in the body
            success: function(response) {
                // Handle the response from the API
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'User Switched',
                        text: 'User type has been updated successfully!'
                    }).then(() => {
                        if (typeof window.fetchUsers === 'function') {
                            window.fetchUsers();
                        }
                    });
                    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Failed to switch user.'
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'API Error',
                    text: xhr.responseJSON?.message || 'An error occurred while switching user.'
                });
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        const token = localStorage.getItem('auth_token');

        let itemsPerPage = 10;
        let currentPage = 1;
        let totalItems = 0;

        let searchQuery = ""; // Store the search query
        let selectedRole = ""; // Store selected role

        window.fetchUsers = function fetchUsers() {
            const offset = (currentPage - 1) * itemsPerPage;

            let requestData = { 
                limit: itemsPerPage, 
                offset: offset 
            };

            // Include filters only if they have values
            if (searchQuery) requestData.user_name = searchQuery;
            if (selectedRole) requestData.role = selectedRole;

            $.ajax({
                url: `<?php echo BASE_URL; ?>/all_users`,
                type: 'POST',
                headers: { Authorization: `Bearer ${token}` },
                data: requestData,
                success: (response) => {
                    if (response?.success && response.data) {
                        totalItems = response.total_users;
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

        // Search filter (triggers API call after 3 letters)
        $("[data-datatable-search]").on("input", debounce(function () {
            let query = $(this).val().trim();
            if (query.length >= 3) {
                searchQuery = query;
                currentPage = 1; // Reset to first page
                fetchUsers();
            } else if (query.length === 0) {
                searchQuery = ""; // Clear search
                fetchUsers();
            }
        }, 300)); // 300ms delay

        // Role filter (triggers API call when role is selected)
        $("[data-datatable-role]").on("change", function () {
            selectedRole = $(this).val(); // Get selected role
            currentPage = 1; // Reset to first page
            fetchUsers();
        });

        // Set default role in the select dropdown
        $("[data-datatable-role]").val(selectedRole);

        // Initial fetch with "Customer" pre-selected
        fetchUsers();

        const populateTable = (data) => {
            const tbody = $("#users-table tbody");
            tbody.empty();

            data.forEach((user) => {
                tbody.append(`
                    <tr>
                        <td class="text-center">
                            <input class="checkbox checkbox-sm" type="checkbox" value="${user.id}">
                        </td>
                        <td>
                            <div class="flex items-center gap-2.5">
                                <div class="">
                                    <img class="h-9 rounded-full" src="../../images/default/df001.png" />
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary" href="#">
                                        ${user.name}
                                    </a>
                                    <span class="text-xs text-gray-700 font-normal">
                                        ${user.email}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-wrap gap-2.5 mb-2">
                                <span class="badge badge-sm badge-light badge-outline">
                                    ${user.role}
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-sm badge-outline ${user.selected_type != null ? 'badge-primary' : 'badge-danger'}">
                                ${user.selected_type != null ? user.selected_type : 'N/A'}
                            </span>
                        </td>
                        <td>
                            <div class="flex flex-wrap gap-2.5 mb-2">
                                <span class="badge badge-sm badge-success badge-outline">
                                    ${user.gstin ? user.gstin : 'NA'}
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class="text-xs text-gray-700 font-normal">${user.mobile}</span>
                        </td>
                        <td>
                            <span class="badge badge-sm badge-outline ${user.is_present == 1 ? 'badge-success' : 'badge-danger'}">
                                ${user.is_present == 1 ? 'Present' : 'Absent'}
                            </span>
                        </td>
                        <td class="w-[60px]">${generateActionButtons(user)}</td>
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
            $("#count-users").text(`${totalItems} Users`);
        };

        $(".pagination").on("click", "button", function () {
            currentPage = parseInt($(this).data("page"));
            fetchUsers();
        });

        $("[data-datatable-size]").on("change", function () {
            itemsPerPage = parseInt($(this).val());
            currentPage = 1;
            fetchUsers();
        });

        const perPageSelect = $("[data-datatable-size]");
        [3, 10, 25, 50, 100].forEach((size) => {
            perPageSelect.append(`<option value="${size}">${size}</option>`);
        });
        perPageSelect.val(itemsPerPage);

        fetchUsers();
    });

    const generateActionButtons = (user) => {
        return `
            <div class="menu" data-menu="true">
                <div class="menu-item" data-menu-item-offset="0, 10px"
                    data-menu-item-placement="bottom-end"
                    data-menu-item-placement-rtl="bottom-start"
                    data-menu-item-toggle="dropdown"
                    data-menu-item-trigger="click|lg:click">
                    <button
                        class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                        <i class="ki-filled ki-dots-vertical">
                        </i>
                    </button>
                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                        <div class="menu-item">
                            <a class="menu-link" href="pages/user_detail.php?id=${user.id}">
                                <span class="menu-icon">
                                <i class="ki-filled ki-eye"></i>
                                </span>
                                <span class="menu-title">View User</span>
                            </a>
                        </div>
                        <div class="menu-separator"> </div>
                        <div class="menu-item">
                            <a class="menu-link" onclick="openSwitchUserPopup(${user.id}, '${user.selected_type}', '${user.name}')">
                                <span class="menu-icon">
                                    <i class="ki-filled ki-search-list"></i>
                                </span>
                                <span class="menu-title">Switch User</span>
                            </a>
                        </div>
                        <div class="menu-separator"> </div>
                        <div class="menu-item">
                            <a class="menu-link" onclick="openDeleteUserPopup(${user.id}, '${user.name}')">
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
<script>
  // Tiny helper to avoid XSS in names shown inside SweetAlert
  const escapeHtml = (s = "") =>
    s.replace(/[&<>"']/g, (c) => ({ "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;" }[c]));

  // Confirm + delete
  function openDeleteUserPopup(userId, userName = "") {
    Swal.fire({
      icon: 'warning',
      title: 'Delete user?',
      html: userName
        ? `You are about to permanently delete <b>${escapeHtml(userName)}</b>.`
        : 'You are about to permanently delete this user.',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete',
      cancelButtonText: 'Cancel',
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      showLoaderOnConfirm: true,
      reverseButtons: true,
      preConfirm: async () => {
        try {
          const token = localStorage.getItem('auth_token');
          const res = await fetch(`<?php echo BASE_URL; ?>/delete/${userId}`, {
            method: 'DELETE', // if your API expects POST, change to 'POST'
            headers: {
              'Authorization': `Bearer ${token}`
            }
          });
          const data = await res.json().catch(() => ({}));

          if (!res.ok || data.success !== true) {
            throw new Error(data.message || `Failed with status ${res.status}`);
          }
          return data; // passed to .then(result)
        } catch (err) {
          Swal.showValidationMessage(err.message || 'Unable to delete user.');
        }
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: (result.value && result.value.message) || 'User permanently deleted.'
            }).then(() => {
            // Refresh the table without reloading the page
                if (typeof window.fetchUsers === 'function') {
                    window.fetchUsers();
                }
            });
        }
    });
  }
</script>

    <!-- Footer -->
<?php include("footer1.php"); ?>