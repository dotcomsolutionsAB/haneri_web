<?php include("configs/config.php"); ?>
<section class="featured">
    <h2 class="heading_1">Best Sellers</h2>

    <!-- Grid wrapper for cards -->
    <div class="featured-products-grid" id="best-seller-carousel">
        <!-- Cards will be inserted here -->
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const token = localStorage.getItem("auth_token");
        // const tempId = localStorage.getItem("temp_id");
        const apiUrl = "<?php echo BASE_URL; ?>/products/get_products";

        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            },
            body: JSON.stringify({ search_product: "Fengshui" })
        })
        .then(response => response.json())
        .then(res => {
            if (res.success && res.data.length > 0) {
                const product = res.data[0];
                const container = document.getElementById("best-seller-carousel");

                product.variants.forEach(variant => {
                    // const imageName = variant.variant_value.replace(/\s+/g, '_') + ".png";
                    const imageName = variant.file_urls[0] || [];
                    const card = document.createElement("div");
                    card.className = "card";
                    card.innerHTML = `
                        <div class="card_image">
                            <img src="${imageName}" alt="${variant.variant_value}" class="img-fluid-card">
                        </div>
                        <h4 class="heading2">${product.brand} ${product.name} <span>${product.category}</span></h4>
                        <p class="product-price">MRP ₹${variant.selling_price}</p>
                        <div class="card-foot">
                            <div class="qty-selector">
                                <button class="qty-btn minusb">−</button>
                                <input type="text" class="qty-input" value="1" min="1" readonly>
                                <button class="qty-btn plusb">+</button>
                            </div>
                            <div class="add-to-cart">
                                <a href="#" id="addcartbs" class="add-to-cart-btn" data-product-id="${product.id}" 
                                   data-variant-id="${variant.id}">Add to Cart</a>
                            </div>
                        </div>

                    `;
                    container.appendChild(card);
                });

                // Quantity control
                document.addEventListener('click', function (e) {
                    if (e.target.classList.contains('plusb')) {
                        const input = e.target.previousElementSibling;
                        input.value = parseInt(input.value) + 1;
                    } else if (e.target.classList.contains('minusb')) {
                        const input = e.target.nextElementSibling;
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;
                        }
                    }

                    // Add to Cart handler using id="addcartbs"
                    if (e.target.id === 'addcartbs') {
                        e.preventDefault();

                        const productId = e.target.dataset.productId;
                        const variantId = e.target.dataset.variantId;
                        const quantity = e.target.closest(".card-foot").querySelector(".qty-input").value;

                        let cartPayload = {
                            product_id: parseInt(productId),
                            quantity: parseInt(quantity)
                        };
                        if (variantId) {
                            cartPayload.variant_id = parseInt(variantId);
                        }

                        const authToken = localStorage.getItem("auth_token");
                        const existingTempId = localStorage.getItem("temp_id");

                        const headers = {
                            "Content-Type": "application/json"
                        };

                        if (authToken) {
                            headers["Authorization"] = `Bearer ${authToken}`;
                        } else if (existingTempId) {
                            cartPayload.cart_id = existingTempId;
                        }

                        fetch("<?php echo BASE_URL; ?>/cart/add", {
                            method: "POST",
                            headers,
                            body: JSON.stringify(cartPayload)
                        })
                        .then(response => response.json())
                        .then(cartRes => {
                            if (cartRes.data) {
                                // Save temp_id if first time (you can use user_id or generate cart_id depending on your backend logic)
                                const existingTempId = localStorage.getItem("temp_id");
                                const authToken = localStorage.getItem("auth_token");
                                if(existingTempId){
                                    console.log("Temp ID is:", existingTempId);
                                }else{
                                    console.log("Auth token is:", authToken)
                                }
                                if (!authToken && !existingTempId && cartRes.data.user_id) {
                                    localStorage.setItem("temp_id", cartRes.data.user_id);
                                }

                                const cardFoot = e.target.closest(".card-foot");
                                cardFoot.innerHTML = `
                                    <a href="cart.php" class="go-to-cart-btn heading2">View Cart</a>
                                `;
                            } else {
                                alert("Failed to add product to cart.");
                            }
                        })
                        .catch(err => {
                            console.error("Cart Add Error:", err);
                            alert("An error occurred while adding to cart.");
                        });

                    }
                });
            } else {
                document.getElementById("best-seller-carousel").innerHTML = "<p>No Best Seller products found.</p>";
            }
        })
        .catch(error => {
            console.error("Error fetching product:", error);
        });
    });
</script>
