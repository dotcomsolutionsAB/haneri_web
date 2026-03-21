<?php include("header.php"); ?>
<?php include("configs/config.php"); ?>
<!-- Include SweetAlert2 (make sure to have sweetalert2 or similar library included in your project) -->


<style>
    div:where(.swal2-container) .swal2-input {
        width:25rem;
    }
    div:where(.swal2-container).swal2-center>.swal2-popup {
        width:40rem;
    }
    .cart-summary {
        border-radius: 5px;
    }
    @media (max-width: 520px) {
        .table-cart tr {
            display: block;
            margin-bottom: 0rem;
            border: 0px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
        }
        .table.table-cart tfoot {
            border-top: 0px solid #ddd !important;
        }
        .table.table-cart tfoot tr td {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: row !important;
            -ms-flex-align: start;
            align-items: center;
            padding: 10px !important;
            justify-content: end;
        }
    }

/* MOBILE GRID VIEW */
@media (max-width: 520px) {
    .table-cart thead {
        display: none; /* hide table headers */
    }

    .table-cart tbody tr {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* 2 columns */
        gap: 2px;
        margin-bottom: 1rem;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #fff;
        align-items: center;
    }

    .table-cart tbody tr td {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        flex-direction: column; /* value below label */
        text-align: left;
        padding: 5px 0;
    }

    .table-cart tbody tr td[data-label]::before {
        display: none;
    }
    .table-cart td {
        border-bottom: 0px solid #eee;
    }
    .table.table-cart tr td {
        padding: 0px;
        text-align: center;
        align-items: center;
        justify-content: center;
    }

    .table-cart tbody tr td img {
        width: 90px;
        height: 80px;
        margin-bottom: 0px;
    }

    /* Quantity buttons layout */
    .quantity-container {
        display: flex;
        justify-content: center;
        gap: 5px;
        width: 100%;
    }

    .quantity-container input.horizontal-quantity {
        width: 50px;
        text-align: center;
    }

    /* Adjust subtotal text */
    .text-right {
        justify-content: flex-start !important;
    }

    /* Clear cart button placement */
    #clear-cart-btn {
        width: 100%;
        margin-top: 10px;
    }

    /* Cart summary box stacking */
    .cart-summary {
        margin-top: 20px;
    }

    .checkout-methods a.btn,
    .quotation-methods a.btn {
        width: 100%;
        text-align: center;
    }
    .table.table-cart {
        border: 0px solid #e7e7e7 !important;
        box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.05) !important;
    }
    .table.table-cart tfoot {
        border-top: 0px solid #ddd;
    }
}
.checkout-methods a.btn, .quotation-methods a.btn {
    font-family: 'Barlow Condensed' !important;
    font-size: 18px !important;
    letter-spacing: 0.02em !important;
    padding: 10px 0 !important;
    border-radius: 10px;
}
.checkout-progress-bar li.active a {
    font-family: 'Barlow Condensed';
    font-size: 20px !important;
    color: #005d5a;
    letter-spacing: 0.02em;
}
.cart-summary h3 {
    font-family: 'Barlow Condensed';
    font-size: 20px !important;
    letter-spacing: 0.02em;
}
.table.table-cart tr th{
    font-family: 'Barlow Condensed';
    font-size: 20px !important;
    color: #005d5a;
    letter-spacing: 0.02em;
}
.checkout-methods .btn {
    font-family: 'Barlow Condensed' !important;
    font-size: 20px !important;
    letter-spacing: 0.02em !important;
    padding: 10px 0 !important;
}
#clear-cart-btn{
    font-family: 'Barlow Condensed' !important;
    font-size: 18px !important;
    letter-spacing: 0.02em;
    padding: 0px 10px !important;
    border-radius: 10px;
}
.btn-quantity {
    border-radius: 10px;
}
.btn-grey {
    border-color: #34393f;
    background-color: #34393f;
}
.checkout-progress-bar li.disabled a {
    color: #919292;
    font-family: 'Barlow Condensed';
    font-size: 20px !important;
    letter-spacing: 0.02em;
}
.table.table-totals tr td, .table.table-totals tr th {
    font-family: 'Barlow Condensed' !important;
    letter-spacing: normal;
    font-size: 18px !important;
}
.horizontal-quantity {
    font-weight:600;
    font-family: 'Barlow Condensed';
    font-size: 18px !important;
    color: #005d5a;
    letter-spacing: 0.02em;
}
.f145{
    font-family: 'Barlow Condensed';
    font-size: 18px !important;
    color: #005d5a;
    letter-spacing: 0.02em;
    font-weight:600;
}
.f14{
    font-family: 'Barlow Condensed';
    font-size: 18px !important;
    color: #005d5a;
    letter-spacing: 0.02em;
}
</style>

<script>
    window.onload = function() {
        // Retrieve token and tempId from local storage
        let token = localStorage.getItem("auth_token");
        let tempId = localStorage.getItem("temp_id");

        // Define API URLs
        const apiFetchUrl = `<?php echo BASE_URL; ?>/cart/fetch`;

        // Grabbing DOM elements
        const cartTableBody = document.querySelector("#cartTable tbody");
        const subtotalElem = document.getElementById("cart-subtotal");
        const taxElem = document.getElementById("cart-tax");
        const totalElem = document.getElementById("cart-total");
        const shipElem = document.getElementById("shipping_price");

        if (!cartTableBody) {
            console.error("Cart table body not found. Ensure the table has ID 'cartTable'.");
            return;
        }

        // console.log("Auth Token:", token);
        // console.log("Temp ID:", tempId);

        // Fetch the cart on page load
        fetchCart();

        // =============== MAIN: FETCH CART ===============
        function fetchCart() {
            console.log("Fetching cart...");

            // If neither token nor tempId is present, user isn't authenticated or doesn't have a guest cart
            if (!token && !tempId) {
                console.warn("No authentication token or guest cart ID found. Redirecting to login page...");
                window.location.href = "login.php";
                return;
            }

            // Show a loading message while fetching
            cartTableBody.innerHTML = "<tr><td colspan='6' class='text-center'>Loading cart items...</td></tr>";

            // Decide what to send in the request body
            let requestData = token ? {} : { cart_id: tempId };

            console.log("Request Data:", requestData);

            fetch(apiFetchUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    ...(token ? { "Authorization": `Bearer ${token}` } : {})
                },
                body: JSON.stringify(requestData)
            })
            .then(response => response.json())
            .then(data => {
                console.log("Cart data received:", data);

                if (data && Array.isArray(data.data) && data.data.length > 0) {
                    console.log("Data received, displaying cart...");
                    displayCart(data.data);
                } else {
                    console.warn("Cart is empty or data is missing.");

                    // Hide table when empty
                    document.querySelector(".cart-table-container").style.display = "none";

                    // Remove any previous empty-cart box (important when clear-cart calls fetchCart multiple times)
                    const existingEmptyBox = document.querySelector(".empty-cart-box");
                    if (existingEmptyBox) {
                        existingEmptyBox.remove();
                    }

                    // Clear tbody just in case
                    cartTableBody.innerHTML = "";

                    // Show empty cart box outside the table
                    document.querySelector(".cart-table-container").insertAdjacentHTML(
                        'afterend',
                        `
                        <div class="empty-cart-box">
                            <div class="empty-cart-icon">&#128722;</div>
                            <h3>Your cart is empty</h3>
                            <a href="https://haneri.com/shop" class="empty-cart-btn">Go to Shop</a>
                        </div>
                        `
                    );

                    updateCartTotals(0, 0);
                    document.getElementById("clear-cart-btn").style.display = "none";
                }
            })
            .catch(error => {
                console.error("Error fetching cart:", error);
                cartTableBody.innerHTML = "<tr><td colspan='6' class='text-center text-danger'>Error loading cart.</td></tr>";
            });
        }

        // =============== DISPLAY CART ITEMS ===============
        function displayCart(cartItems) {
            document.querySelector(".empty-cart-box")?.remove();
            document.querySelector(".cart-table-container").style.display = "block";

            cartTableBody.innerHTML = "";
            console.log("Displaying cart items:", cartItems);

            // SHOW OR HIDE clear cart button
            const clearBtn = document.getElementById("clear-cart-btn");
            if (cartItems.length > 0) {
                clearBtn.style.display = "inline-block";
            } else {
                clearBtn.style.display = "none";
            }

            let cartSubtotal = 0;
            let taxRate = 0.18; // example tax rate

            cartItems.forEach((item) => {
                let productName = item.product_name;
                let variantName = item.variant_value ? `(${item.variant_value})` : "";
                let sellingPrice = parseFloat((item.selling_price || "0").replace(/,/g, ""));
                let discount = typeof item.discount === "number" ? item.discount : parseFloat(item.discount) || 0;
                let productImage = item.file_urls && item.file_urls[0] ? item.file_urls[0] : "";
                let quantity = item.quantity || 1;
                let subtotal = sellingPrice * quantity;

                if (isNaN(subtotal)) subtotal = 0;
                cartSubtotal += subtotal;

                let priceHtml = `&#8377;${sellingPrice.toFixed(2)}`;
                if (discount > 0) {
                    let originalPrice = sellingPrice / (1 - discount / 100);
                    priceHtml = `<span class="cart-original-price" style="text-decoration:line-through;color:#888;font-size:0.9em;">&#8377;${originalPrice.toFixed(2)}</span> ${priceHtml} <span class="cart-discount-badge" style="display:inline-block;margin-left:4px;padding:2px 6px;background:#c8e5e3;color:#005d5a;border-radius:4px;font-size:12px;font-weight:600;">${discount}% off</span>`;
                }

                console.log(`Adding item: ${productName}, Price: ${sellingPrice}, Quantity: ${quantity}, Discount: ${discount}%`);

                cartTableBody.innerHTML += `
                    <tr data-cart-id="${item.id}">
                        <td data-label="Image"><img src="${productImage}" alt="${productName}" width="50"></td>
                        <td data-label="Product" class="f14">${productName} ${variantName}</td>
                        <td data-label="Price" class="f14">${priceHtml}</td>
                        <td data-label="Quantity">
                            <div class="quantity-container">
                                <button class="btn-quantity" onclick="updateCartQuantity('${item.id}', 'decrease')">-</button>
                                <input type="text" class="horizontal-quantity" 
                                    value="${quantity}" onchange="updateCartQuantity('${item.id}', 'input', this.value)"
                                >
                                <button class="btn-quantity" onclick="updateCartQuantity('${item.id}', 'increase')">+</button>
                            </div>
                        </td>
                        <td data-label="Subtotal" class="text-right f145">&#8377;${subtotal.toFixed(2)}</td>
                        <td data-label="Remove">
                            <button class="btn-remove-item" onclick="removeCartItem('${item.id}')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

            let taxAmount = cartSubtotal * taxRate;
            let totalAmount = cartSubtotal + taxAmount;

            if (isNaN(taxAmount)) taxAmount = 0;
            if (isNaN(totalAmount)) totalAmount = 0;

            // Pass: (total including tax, number of items)
            updateCartTotals(cartSubtotal, cartItems.length);
        }

        // =============== UPDATE TOTALS ===============
        function updateCartTotals(subtotalWithTax, cartItemCount = 0) {
            const taxRate = 0.18;
            const shippingCharge = 0;

            // Ensure the input is valid
            subtotalWithTax = isNaN(subtotalWithTax) ? 0 : subtotalWithTax;

            // Calculate base subtotal (exclusive of tax)
            const baseSubtotal = subtotalWithTax / (1 + taxRate);

            // Calculate tax
            const tax = subtotalWithTax - baseSubtotal;

            // Determine shipping
            let shipping = 0;
            if (cartItemCount > 0) {
                shipping = subtotalWithTax > 1000 ? 0 : shippingCharge;
            }

            // Final total
            const total = subtotalWithTax + shipping;

            // Update DOM elements (using actual ₹ symbol)
            subtotalElem.innerText = `₹${baseSubtotal.toFixed(2)}`;
            taxElem.innerText      = `₹${tax.toFixed(2)}`;
            // shipElem.innerText     = `₹${shipping.toFixed(2)}`;
            shipElem.innerText     = (shipping <= 0) ? "Free Shipping" : `₹${shipping.toFixed(2)}`;
            totalElem.innerText    = `₹${total.toFixed(2)}`;


            console.log(`Updating totals: Subtotal (excl. tax): &#8377;${baseSubtotal.toFixed(2)}, Tax: &#8377;${tax.toFixed(2)}, Shipping: &#8377;${shipping}, Total: &#8377;${total.toFixed(2)}`);
        }

        // =============== CLEAR CART: REMOVE ALL ITEMS ONE-BY-ONE ===============
        document.getElementById("clear-cart-btn").addEventListener("click", function () {
            Swal.fire({
                title: "Are you sure?",
                text: "Your entire cart will be cleared.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, clear it!"
            }).then((result) => {
                if (!result.isConfirmed) return;

                // 1) Get all current cart item rows
                const rows = document.querySelectorAll('#cartTable tbody tr[data-cart-id]');

                // If already empty
                if (!rows.length) {
                    Swal.fire("Info", "Your cart is already empty.", "info");
                    return;
                }

                // 2) Loop over each row and call removeCartItem(id)
                rows.forEach((row) => {
                    const id = row.getAttribute('data-cart-id');
                    if (id) {
                        removeCartItem(id);
                    }
                });

                // 3) Show success message (cart will refresh via removeCartItem -> fetchCart)
                Swal.fire("Cleared!", "Your cart has been cleared.", "success");
            });
        });

        // =============== REMOVE SINGLE ITEM ===============
        window.removeCartItem = function(cartItemId) {
            console.log("Removing item with ID:", cartItemId);

            // Construct the remove URL
            const removeUrl = `<?php echo BASE_URL; ?>/cart/remove/${cartItemId}`;

            // Decide the body
            let requestBody = token ? {} : { cart_id: tempId };

            fetch(removeUrl, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    ...(token ? { "Authorization": `Bearer ${token}` } : {})
                },
                body: JSON.stringify(requestBody)
            })
            .then(response => response.json())
            .then(data => {
                console.log("Remove response:", data);
                // Refresh cart to update the view
                fetchCart();
            })
            .catch(error => {
                console.error("Error removing cart item:", error);
            });
        }

        // =============== UPDATE QUANTITY ===============
        window.updateCartQuantity = function(cartItemId, action, value = 1) {
            const row = document.querySelector(`tr[data-cart-id="${cartItemId}"]`);
            if (!row) {
                console.error("Row not found for cartItemId:", cartItemId);
                return;
            }

            const qtyInput = row.querySelector(".horizontal-quantity");
            if (!qtyInput) {
                console.error("Quantity input not found for cartItemId:", cartItemId);
                return;
            }

            let currentQty = parseInt(qtyInput.value);
            if (isNaN(currentQty)) currentQty = 1;

            let newQty = currentQty;

            switch (action) {
                case "increase":
                    newQty = currentQty + 1;
                    break;
                case "decrease":
                    if (currentQty > 1) {
                        newQty = currentQty - 1;
                    }
                    break;
                case "input":
                    newQty = parseInt(value);
                    if (isNaN(newQty) || newQty < 1) newQty = 1;
                    break;
                default:
                    console.error("Unknown action:", action);
                    return;
            }

            // If quantity didn't actually change, no API call needed
            if (newQty === currentQty) {
                return;
            }

            // Update the input field immediately
            qtyInput.value = newQty;

            // Construct the update URL
            const updateUrl = `<?php echo BASE_URL; ?>/cart/update/${cartItemId}`;

            // Build the request body
            let bodyData = token 
                ? { quantity: newQty } 
                : { cart_id: tempId, quantity: newQty };

            // Make the API call to update quantity
            fetch(updateUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    ...(token ? { "Authorization": `Bearer ${token}` } : {})
                },
                body: JSON.stringify(bodyData)
            })
            .then(response => response.json())
            .then(data => {
                console.log("Update quantity response:", data);
                // After updating, re-fetch cart
                fetchCart();
            })
            .catch(error => {
                console.error("Error updating cart quantity:", error);
            });
        }
    };
</script>

<style>
    /* Empty cart animation */
    .empty-cart-box {
        text-align: center;
        padding: 50px 0;
        animation: fadeIn 0.6s ease-in-out;
        border-top: 2px solid #e7e7e7;
    }

    .empty-cart-icon {
        font-size: 70px;
        margin-bottom: 15px;
        animation: bounce 1.5s infinite;
        display: inline-block;
    }

    .empty-cart-box h3 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    .empty-cart-box p {
        font-size: 16px;
        color: #666;
    }

    /* Fade-in animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Bounce icon animation */
    @keyframes bounce {
        0%, 100% { transform: translateY(0);}
        50%      { transform: translateY(-8px);}
    }
    /* Empty cart button */
    .empty-cart-btn {
        display: inline-block;
        margin-top: 18px;
        padding: 12px 28px;
        font-size: 16px;
        font-weight: 600;
        background: #005d5a;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .empty-cart-btn:hover {
        background: #005d5a;
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.20);
        color:#000;
    }
</style>

<!-- for guest checkout -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const proceedCheckoutBtn = document.querySelector(".checkout-methods a.btn.btn-block.btn-dark");

    if (proceedCheckoutBtn) {
      proceedCheckoutBtn.addEventListener("click", function (e) {
        e.preventDefault();

        const token = localStorage.getItem("auth_token");
        const tempId = localStorage.getItem("temp_id");

        if (token) {
            window.location.href = "checkout.php";
            return;
        }

        if (tempId) {
            window.location.href = "checkout.php";
            return;
        }
      });
    }
  });
</script>


<main class="main cart_page">
    <div class="container padding_top_100">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="cart.php">Shopping Cart</a>
            </li>
            <li class="disabled">
                <a href="checkout.php">Checkout</a>
            </li>
            <li class="disabled">
                <a href="order-complete.php">Order Complete</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <table id="cartTable" class="table table-cart">
                        <thead>
                            <tr>
                                <th class="thumbnail-col"></th>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Quantity</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan='6' class='text-center'>Loading cart items...</td></tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <!-- <td colspan="5" class="clearfix">
                                    <div class="float-right">
                                        <div class="cart-discount">
                                            <form action="#">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Coupon Code" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm" type="submit">Apply Coupon</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td> -->
                                <td colspan="6" class="pt-3">
                                    <div class="float-right">
                                        <div class="cart-clear">
                                            <div class="input-group-append">
                                                <button id="clear-cart-btn" class="btn btn-danger" type="submit" style="display:none;">Clear Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>CART TOTALS</h3>
                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td id="cart-subtotal">&#8377;0.00</td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td id="cart-tax">&#8377;0.00</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td id="shipping_price">Free Shipping</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td id="cart-total">&#8377;0.00</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                        <a href="checkout.php" class="btn btn-block btn-dark">
                            Proceed to Checkout <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                    <br>
                    <div class="quotation-methods" id="quotation-methods">
                        <a href="#" class="btn btn-block btn-grey" id="get-quotation-btn">
                            &#128195; Get Quotation <i class="fa fa-arrow-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Get values from localStorage
    const cartAuthToken = localStorage.getItem('auth_token');
    const userRole = localStorage.getItem('user_role');

    // Check if auth_token exists and user_role is not 'customer'
    if (cartAuthToken && userRole !== 'customer') {
        document.getElementById('quotation-methods').style.display = 'block'; // Show the button
    } else {
        document.getElementById('quotation-methods').style.display = 'none'; // Hide the button
    }
</script>

<script>
    // Event listener for the 'Get Quotation' button
    document.getElementById('get-quotation-btn').addEventListener('click', function () {
        // Show the SweetAlert popup with the form
        Swal.fire({
            title: 'Create Quotation',
            html: `
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <input id="q_user" class="swal2-input" placeholder="User Name (required)" required>
                    <input id="q_email" class="swal2-input" placeholder="Email (optional)">
                    <input id="q_mobile" class="swal2-input" placeholder="Mobile (optional)">
                    <input id="q_address" class="swal2-input" placeholder="Address (optional)">
                </div>
            `,
            confirmButtonText: 'Create Quote',
            confirmButtonColor: '#005d5a',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
            cancelButtonColor: '#dc3545',
            preConfirm: () => {
                const qUser = document.getElementById('q_user').value;
                const qEmail = document.getElementById('q_email').value;
                const qMobile = document.getElementById('q_mobile').value;
                const qAddress = document.getElementById('q_address').value;

                // Validate required fields
                if (!qUser) {
                    Swal.showValidationMessage('User Name is required');
                    return false;
                }

                // Prepare the data for the API request
                const requestData = {
                    q_user: qUser,
                    q_email: qEmail,
                    q_mobile: qMobile,
                    q_address: qAddress
                };

                // API request
                fetch('<?php echo BASE_URL; ?>/quotation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${cartAuthToken}`,  // Pass the auth token here
                    },
                    body: JSON.stringify(requestData),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.data && data.message === "Quotation created successfully!") {
                        // Show success message
                        Swal.fire('Success', data.data.message, 'success');
                        
                        // Get the invoice_quotation URL
                        const invoiceUrl = data.data.data.invoice_quotation;

                        // ⏳ Wait 3 seconds then open in new tab
                        if (invoiceUrl) {
                            setTimeout(() => {
                                window.open(invoiceUrl, '_blank');
                            }, 3000); // 3000ms = 3 sec
                        }
                        
                        // Optionally, you can log the quotation details if needed
                        console.log('Quotation Details:', data.data.data);
                    } else {
                        // Show error message if the message doesn't match or is missing
                        Swal.fire('Error', 'Failed to create quotation.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error', 'Something went wrong. Please try again later.', 'error');
                });
            }
        });
    });
</script>

<link rel="stylesheet" href="assets/css/style.min.css">
<?php include("footer.php"); ?>
