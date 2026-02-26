<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php 
    $current_page = "Show Products"; // Dynamically set this based on the page
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
                                Products
                            </h1>
                            <!-- <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                                Overview of all products and brands.
                            </div> -->
                        </div>
                        <div class="flex items-center gap-2.5">
                            <a class="btn btn-sm btn-light" href="#">
                                Sync Products
                            </a>
                            <a class="btn btn-sm btn-primary" href="pages/add_product.php">
                                Add Product
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
                                    Overview of <span id="count-products">00</span>
                                </h3>
                                <div class="flex gap-6">
                                    <div class="relative">
                                        <i
                                            class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3">
                                        </i>
                                        <input class="input input-sm pl-8" data-datatable-search="#members_table"
                                            placeholder="Search Product" type="text" />
                                    </div>
                                    <label class="switch switch-sm">
                                        <input class="order-2" name="check" type="checkbox" value="1" />
                                        <span class="switch-label order-1">
                                            Publish Products
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="card-body">
                                <div data-datatable="true" data-datatable-page-size="10">
                                    <div class="scrollable-x-auto">
                                        <table class="table table-border" data-datatable-table="true" id="products-table">
                                            <thead>
                                                <tr>
                                                    <th class="w-[60px] text-center">
                                                        <input class="checkbox checkbox-sm" data-datatable-check="true" type="checkbox">
                                                    </th>
                                                    <th class="min-w-[200px]">
                                                        <span class="sort asc">
                                                            <span class="sort-label text-gray-700 font-normal">Name</span>
                                                            <span class="sort-icon">
                                                            </span>
                                                        </span>
                                                    </th>
                                                    <th class="text-gray-700 font-normal min-w-[100px]">Added By</th>
                                                    <th class="text-gray-700 font-normal min-w-[100px]">Brand</th>
                                                    <th class="text-gray-700 font-normal min-w-[100px]">Category</th>
                                                    <th class="min-w-[225px]">
                                                        <span class="sort">
                                                            <span class="sort-label text-gray-700 font-normal">Variants Info</span>
                                                            <span class="sort-icon">
                                                            </span>
                                                        </span>
                                                    </th>
                                                    <th class="min-w-[100px]">
                                                        <span class="sort">
                                                            <span class="sort-label text-gray-700 font-normal">Publish</span>
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
            <!-- Footer -->

<script>
    $(document).ready(function () {
        const token = localStorage.getItem('auth_token');

        let itemsPerPage = 10; // Default items per page
        let currentPage = 1; // Current page number
        let totalItems = 0; // Total items from API response

        const fetchProducts = () => {
            const offset = (currentPage - 1) * itemsPerPage;

            $.ajax({
                url: '<?php echo BASE_URL; ?>/products/get_admin',
                type: 'POST',
                headers: { Authorization: `Bearer ${token}` },
                data: { search: '', limit: itemsPerPage, offset: offset},
                success: (response) => {
                        if (response && response.data) {
                            totalItems = response.total_records; // Assuming total items is part of the API response
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
            const tbody = $("#products-table tbody");
            tbody.empty();

            data.forEach((product) => {
                // Get variant details
                let variantDetails = "";
                let highestPrice = 0;
                let lowestPrice = Infinity;

                if (product.variants && product.variants.length > 0) {
                    // Extract variant types and values
                    variantDetails = product.variants
                        .map(v => `${v.variant_type}: ${v.variant_value}`)
                        .join(",<br> ");

                    // Find highest and lowest selling prices
                    product.variants.forEach(variant => {
                        // let sellingPrice = parseFloat(variant.selling_price) || 0;
                        let sellingPrice = parseFloat(variant.selling_price.replace(/,/g, '')) || 0;
                        if (sellingPrice > highestPrice) highestPrice = sellingPrice;
                        if (sellingPrice < lowestPrice) lowestPrice = sellingPrice;
                    });
                } else {
                    variantDetails = "No Variants Available";
                    lowestPrice = highestPrice = "N/A"; // If no variants exist
                }

                // Append a single row for each product
                tbody.append(`
                    <tr>
                        <td class="text-center">
                            <input class="checkbox checkbox-sm" data-datatable-row-check="true" type="checkbox" value="${product.slug}" />
                        </td>
                        <td>
                            <div class="flex items-center gap-2.5">
                                <img class="h-9 rounded-full" src="${
                                    product.variants[0]?.file_urls && product.variants[0]?.file_urls[0]
                                        ? product.variants[0].file_urls[0]  // If a valid image URL exists
                                        : '../images/default/df001.png' // Use placeholder image if no valid image exists
                                }">
                                <div class="flex flex-col gap-0.5">
                                    <a class="leading-none font-medium text-sm text-gray-900 hover:text-primary">
                                        ${product.name}
                                    </a>
                                    <span class="text-gray-700 text-xs pt-3">HSN : ${product.variants[0]?.hsn || "N/A"}</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-sm badge-light badge-outline">${product.added_by || "Admin"}</span></td>
                        <td class="text-gray-800 font-normal">${product.brand || "N/A"}</td>
                        <td class="text-gray-800 font-normal">${product.category || "Uncategorized"}</td>
                        <td>
                            <div class="text-gray-700 text-xs">${variantDetails}</div>
                            <div class="text-gray-800 text-s pt-2"><b>₹${highestPrice}.00 - ₹${lowestPrice}.00</b></div>
                        </td>
                        <td>
                            <span class="badge badge-sm badge-outline ${product.is_active ? "badge-success" : "badge-danger"}">
                                ${product.is_active ? "Active" : "Inactive"}
                            </span>
                        </td>
                        <td class="w-[60px]">
                            ${generateActionButtons(product)}
                        </td>
                    </tr>
                `);
            });
        };

        const updatePagination = () => {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const pagination = $(".pagination");
            pagination.empty();

            if (currentPage > 1) {
                pagination.append(`<button class="btn btn-sm" data-page="${currentPage - 1}">Previous</button>`);
            }
            for (let page = 1; page <= totalPages; page++) {
                const isActive = page === currentPage ? "active" : "";
                pagination.append(`<button class="btn btn-sm ${isActive}" data-page="${page}">${page}</button>`);
            }
            if (currentPage < totalPages) {
                pagination.append(`<button class="btn btn-sm" data-page="${currentPage + 1}">Next</button>`);
            }
            $("#count-products").text(`${totalItems} Products`);
        };

        $(".pagination").on("click", "button", function () {
            currentPage = parseInt($(this).data("page"));
            fetchProducts();
        });

        $("[data-datatable-size]").on("change", function () {
            itemsPerPage = parseInt($(this).val());
            currentPage = 1;
            fetchProducts();
        });

        // Initialize dropdown for items per page
        const perPageSelect = $("[data-datatable-size]");
        [5, 10, 25, 50, 100].forEach((size) => {
            perPageSelect.append(`<option value="${size}">${size}</option>`);
        });
        perPageSelect.val(itemsPerPage);

        fetchProducts();
    });
</script>

<script>
    const generateActionButtons = (product) => {
        const productId = product.id || "invalid";
        return `
            <div class="menu" data-menu="true">
                <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" 
                    data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                    
                    <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                        <i class="ki-filled ki-dots-vertical"></i>
                    </button>

                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                        
                        <div class="menu-item">
                            <a class="menu-link" href="pages/edit_product.php?id=${product.id}">
                                <span class="menu-icon"><i class="ki-filled ki-pencil"></i></span>
                                <span class="menu-title">Edit</span>
                            </a>
                        </div>
                        <div class="menu-separator"></div>
                        <div class="menu-item">
                            <a class="menu-link remove-product" data-product-id="${productId || "invalid"}" href="">
                                <span class="menu-icon"><i class="ki-filled ki-trash"></i></span>
                                <span class="menu-title">Remove</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `;
    };

    // Handle product deletion
    document.addEventListener("click", async function (e) {
        const removeBtn = e.target.closest(".remove-product");
        if (removeBtn) {
            e.preventDefault();
            const productId = removeBtn.getAttribute("data-product-id");
            const baseUrl = "<?php echo BASE_URL; ?>"; // replace this dynamically or set beforehand
            const authToken = localStorage.getItem("auth_token");

            if (productId === "invalid") {
                Swal.fire("Invalid product!", "Product ID is not available.", "error");
                return;
            }

            const confirm = await Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            });

            if (confirm.isConfirmed) {
                try {
                    const response = await fetch(`${baseUrl}/products/${productId}`, {
                        method: "DELETE",
                        headers: {
                            "Authorization": `Bearer ${authToken}`,
                            "Content-Type": "application/json"
                        }
                    });

                    const result = await response.json();

                    console.log("DELETE response status:", response.status);
                    console.log("DELETE response data:", result);

                    if (response.ok || response.status === 200 || response.status === 204) {
                        Swal.fire("Deleted!", result.message || "Product has been deleted.", "success");
                        location.reload(); // or call fetchProducts() if defined
                    } else {
                        Swal.fire("Failed!", result.message || "Could not delete product.", "error");
                    }
                } catch (error) {
                    console.error("DELETE Error:", error);
                    Swal.fire("Error!", "Something went wrong while deleting.", "error");
                }
            }
        }
    });
</script>
    <!-- Sync Products api -->
    <!-- <script>     
        const syncProducts = () => {
            const token = localStorage.getItem('authToken');
            if (!token) return alert('You are not authenticated.');

            $('.loading-spinner').show(); // Show spinner for sync operation

            $.ajax({
                url: 'https://app.supersteelpowertools.com/api/fetch_products',
                type: 'GET',
                headers: { Authorization: `Bearer ${token}` },
                success: () => {
                        $('.loading-spinner').hide();
                        fetchProducts(); // Refresh table after sync
                },
                error: () => {
                        $('.loading-spinner').hide();
                        alert('Failed to sync products.');
                },
            });
        };
        $('#syncProducts').on('click', syncProducts); // Attach sync button click event

        const handleImageUpload = () => {
            const token = localStorage.getItem('authToken');
            if (!token) return alert('You are not authenticated.');

            const productCode = $('#productCode').val();
            const file = $('#imageFile')[0].files[0];

            if (!file) return alert('Please select an image file.');

            const formData = new FormData();
            formData.append('product_code', productCode);
            formData.append('product_image', file);

            $.ajax({
                url: 'https://app.supersteelpowertools.com/api/admin/upload_product',
                type: 'POST',
                headers: { Authorization: `Bearer ${token}` },
                data: formData,
                processData: false,
                contentType: false,
                success: (response) => {
                        const res = JSON.parse(response);
                        if (res.message === 'Image uploaded successfully') {
                            alert(res.message);
                            $('#uploadModal').modal('hide');
                            fetchProducts(); // Refresh the product list
                        } else {
                            alert('Failed to upload image.');
                        }
                },
                error: () => {
                        alert('Image upload failed.');
                },
            });
        };
        $('#uploadImageBtn').on('click', handleImageUpload);

        // $('#syncProducts').on('click', syncProducts);

        $('#logoutBtn').on('click', () => {
            localStorage.removeItem('authToken');
            alert('You have been logged out.');
            window.location.href = 'index.php';
        });

        // $(document).ready(fetchProducts);
    </script> -->
<?php include("footer1.php"); ?>