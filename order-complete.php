<?php include("header.php"); ?>
<?php include("configs/config.php"); ?> 

<?php
    // Fetch data from URL parameters (fallbacks)
    $status           = $_GET['status'] ?? 'success'; // success | failed | cancelled
    $method           = $_GET['method'] ?? 'N/A';
    $payment_id       = $_GET['payment_id'] ?? 'N/A';
    $amount           = $_GET['amount'] ?? '0.00';
    $order_id         = $_GET['order_id'] ?? 'N/A';
    $shipping_address = $_GET['shipping_address'] ?? 'N/A'; // fallback only

    // Decide content based on status
    $isSuccess  = ($status === 'success');
    $isFailed   = ($status === 'failed');
    $isCanceled = ($status === 'cancelled');

    if ($isSuccess) {
        $mainTitle   = "Thank You! Your Order Has Been Placed Successfully.";
        $subtitle    = "We’ve received your order and payment. You will receive a confirmation email shortly.";
        $badgeText   = "Payment Successful";
        $badgeClass  = "status-badge-success";
        $iconClass   = "fas fa-check-circle";
        $accentClass = "hero-card-success";
        $amountLabel = "Total Paid";
    } elseif ($isFailed) {
        $mainTitle   = "Payment Failed, Order Cancelled.";
        $subtitle    = "Kindly place the order again.";
        $badgeText   = "Payment Failed";
        $badgeClass  = "status-badge-failed";
        $iconClass   = "fas fa-times-circle";
        $accentClass = "hero-card-failed";
        $amountLabel = "Order Value";
    } else { // cancelled
        $mainTitle   = "Order Cancelled.";
        $subtitle    = "You closed the payment window. Kindly place the order again.";
        $badgeText   = "Payment Pending";
        $badgeClass  = "status-badge-pending";
        $iconClass   = "fas fa-exclamation-circle";
        $accentClass = "hero-card-pending";
        $amountLabel = "Order Value";
    }
?>
<style>
    .main.checkout_page {
        background: radial-gradient(circle at top, #e9f5ff 0%, #fefefe 40%, #ffffff 100%);
        min-height: 100vh;
    }

    .order-wrapper {
        position: relative;
        padding-bottom: 60px;
    }

    /* Confetti blast */
    .confetti-layer {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }

    .confetti-piece {
        position: absolute;
        width: 8px;
        height: 14px;
        background: linear-gradient(135deg, #005d5a, #005d5a);
        opacity: 0;
        border-radius: 2px;
        animation: confettiFall 1.8s forwards ease-out;
    }

    .confetti-piece:nth-child(2n) {
        background: linear-gradient(135deg, #ffb703, #ff6b6b);
    }
    .confetti-piece:nth-child(3n) {
        background: linear-gradient(135deg, #3a86ff, #a855f7);
    }

<?php
    for ($i = 1; $i <= 18; $i++) {
        $left = rand(5, 95);
        $delay = rand(0, 12) / 10;
        $translateX = rand(-40, 40);
        echo ".confetti-piece:nth-child({$i}) { left: {$left}%; animation-delay: {$delay}s; transform: translateY(-40px) translateX({$translateX}px) rotate(0deg); }\n";
    }
?>

    @keyframes confettiFall {
        0% {
            opacity: 0;
            transform: translateY(-40px) scale(0.8) rotate(0deg);
        }
        20% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translateY(260px) scale(1) rotate(260deg);
        }
    }

    .order-hero-container {
        position: relative;
        z-index: 1;
    }

    .order-success-card {
        max-width: 780px;
        margin: 0 auto 30px auto;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.06);
        padding: 30px 25px 26px;
        text-align: center;
        overflow: hidden;
        position: relative;
    }

    .order-success-card::before {
        content: "";
        position: absolute;
        inset: -60px;
        background: radial-gradient(circle at top left, rgba(0, 93, 90, 0.08), transparent 55%);
        opacity: 0.9;
        z-index: 0;
    }

    .order-success-inner {
        position: relative;
        z-index: 1;
    }

    .hero-icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 38px;
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        animation: popIn 0.7s ease-out forwards;
    }

    .hero-card-success .hero-icon-circle {
        background: linear-gradient(135deg, #005d5a, #005d5a);
    }
    .hero-card-failed .hero-icon-circle {
        background: linear-gradient(135deg, #f43f5e, #be123c);
    }
    .hero-card-pending .hero-icon-circle {
        background: linear-gradient(135deg, #f97316, #ea580c);
    }

    @keyframes popIn {
        0% { transform: scale(0.4); opacity: 0; }
        60% { transform: scale(1.08); opacity: 1; }
        100% { transform: scale(1); }
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-bottom: 6px;
    }
    .status-badge-success {
        background: rgba(34, 197, 94, 0.09);
        color: #005d5a;
        border: 1px solid rgba(34, 197, 94, 0.4);
    }
    .status-badge-failed {
        background: rgba(239, 68, 68, 0.09);
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.4);
    }
    .status-badge-pending {
        background: rgba(234, 179, 8, 0.09);
        color: #b45309;
        border: 1px solid rgba(234, 179, 8, 0.4);
    }

    /* 💰 Stylish amount pill just below status badge */
    .order-amount-pill {
        display: inline-flex;
        align-items: baseline;
        gap: 6px;
        margin-top: 8px;
        padding: 6px 18px;
        border-radius: 999px;
        background: #005d5a;
        color: #ffffff;
    }

    .order-amount-pill small {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        opacity: 0.9;
    }

    .order-amount-pill span {
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.04em;
    }

    .order-success-card h2 {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 28px;
        letter-spacing: 0.02em;
        margin-bottom: 6px;
    }

    .order-success-card p.lead {
        font-size: 15px;
        margin-bottom: 4px;
        color: #4b5563;
    }

    .order-details-box {
        border-radius: 18px;
        box-shadow: 0 14px 40px rgba(15, 23, 42, 0.06);
        border: 1px solid #e5e7eb;
    }

    .order-details-box h3 {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 20px;
        letter-spacing: 0.03em;
        margin-bottom: 12px;
    }

    /* 🔹 NEW: Summary list (no table) */
    .summary-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        font-size: 14px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 8px 10px;
        border-radius: 10px;
        background: #f9fafb;
    }

    .summary-label {
        font-weight: 600;
        color: #4b5563;
        flex: 0 0 40%;
    }

    .summary-value {
        text-align: right;
        color: #111827;
        flex: 1;
        word-break: break-word;
    }

    .btn_color{
        background:rgb(0, 93, 90);
    }
    .summary-value-multiline {
        white-space: normal;
    }

    /* 🔹 NEW: Product list (no table) */
    .product-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .product-card-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 12px;
        border-radius: 12px;
        background: #f9fafb;
        width:100%;
    }

    .product-left {
        flex: 1;
        min-width: 0;
    }

    .product-qty-pill {
        padding: 4px 10px;
        border-radius: 999px;
        background: #e5f0ff;
        font-size: 13px;
        font-weight: 600;
        color: #1f2937;
        white-space: nowrap;
    }

    /* 🎨 Variant color dot */
    .variant-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .variant-top-line {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .variant-color-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 1px solid rgba(15, 23, 42, 0.18);
        flex-shrink: 0;
    }

    .variant-name {
        font-weight: 500;
    }

    .variant-label {
        font-size: 12px;
        color: #6b7280;
    }

    .btn-primary.btn-continue {
        border-radius: 999px;
        padding: 10px 32px;
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        font-size: 13px;
        border: none;
        background: #005d5a;
        transition: transform 0.18s ease, box-shadow 0.18s ease, filter 0.18s ease;
    }

    .btn-primary.btn-continue:hover {
        transform: translateY(-1px);
        color: #fff;
        background-color: #343a40;
        border-color: #005d5a;
        filter: brightness(1.03);
    }

    .btn-outline-dark.btn-view-orders {
        border-radius: 999px;
        padding: 9px 22px;
        font-size: 13px;
        font-weight: 500;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    @media (max-width: 576px) {
        .order-success-card h2 { font-size: 22px; }
        .order-success-card p.lead { font-size: 14px; }
        .order-details-box { margin-bottom: 18px; }
        .order-wrapper { padding-bottom: 40px; }
        .product-card-line {
            flex-direction: row;
            align-items: flex-start;
        }
    }
</style>

<main class="main main-test checkout_page">
    <div class="container checkout-container padding_top_100 order-wrapper">

        <!-- 🎉 Confetti Blast Layer -->
        <div class="confetti-layer">
            <?php for ($i = 1; $i <= 18; $i++): ?>
                <div class="confetti-piece"></div>
            <?php endfor; ?>
        </div>

        <!-- Hero Card -->
        <div class="order-hero-container">
            <div class="order-success-card <?= $accentClass ?> animate__animated animate__fadeInDown">
                <div class="order-success-inner">
                    <div class="hero-icon-circle">
                        <i class="<?= $iconClass ?>"></i>
                    </div>

                    <div class="status-badge <?= $badgeClass ?>">
                        <?= htmlspecialchars($badgeText) ?>
                    </div>
                    <br>
                    <!-- 💰 Stylish total amount pill (updated from API) -->
                    <div class="order-amount-pill">
                        <span><?= htmlspecialchars($amountLabel) ?></span>
                        <span id="totalAmountDisplay">
                            ₹<?= htmlspecialchars($amount) ?>
                        </span>
                    </div>

                    <h2 class="mt-2">
                        <?= htmlspecialchars($mainTitle) ?>
                    </h2>

                    <p class="lead">
                        <?= htmlspecialchars($subtitle) ?>
                    </p>

                    <?php if ($isFailed || $isCanceled): ?>
                        <p class="mt-1" style="font-size: 13px; color:#6b7280;">
                            If any amount was deducted, it will be auto-refunded by your bank / provider as per their policy.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="row mt-2 d-flex align-items-stretch">
            <div class="col-lg-8 mb-3">
                <div class="order-details-box p-4 bg-white h-100 animate__animated animate__fadeInLeft">
                    <h3 class="border-bottom pb-2 mb-3">Payment &amp; Order Summary</h3>

                    <div class="summary-list">
                        <div class="summary-row">
                            <div class="summary-label">Method</div>
                            <div class="summary-value"><?= htmlspecialchars($method) ?></div>
                        </div>
                        <div class="summary-row">
                            <div class="summary-label">Payment ID</div>
                            <div class="summary-value"><?= htmlspecialchars($payment_id) ?></div>
                        </div>
                        <div class="summary-row">
                            <div class="summary-label">Total Amount</div>
                            <div class="summary-value" id="totalAmountCell">
                                ₹<?= htmlspecialchars($amount) ?>
                            </div>
                        </div>
                        <div class="summary-row">
                            <div class="summary-label">Shipping Address</div>
                            <div class="summary-value summary-value-multiline" id="shippingAddressCell">
                                <?= nl2br(htmlspecialchars(urldecode($shipping_address))) ?>
                            </div>
                        </div>
                        <div class="summary-row">
                            <div class="summary-label">Status</div>
                            <div class="summary-value">
                                <?php if ($isSuccess): ?>
                                    <span class="badge bg-success">Paid</span>
                                <?php elseif ($isFailed): ?>
                                    <span class="badge bg-danger">Payment Failed</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Payment Pending</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="order-details-box p-4 bg-white h-100 animate__animated animate__fadeInRight">
                    <h3 class="border-bottom pb-2 mb-3">Product Details</h3>

                    <div id="productList" class="product-list">
                        <!-- JS will fill product cards here -->
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4 mb-4 animate__animated animate__fadeInUp">
            <a href="shop" class="btn btn-primary btn-continue px-5 me-2">
                Continue Shopping
            </a>
            <a href="profile#order" class="btn btn-outline-dark btn-view-orders">
                View My Orders
            </a>
        </div>
    </div>
</main>

<!-- 🔁 JS: fetch order details via API using auth token + show variant color -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const authToken = localStorage.getItem("auth_token");
        const orderId   = "<?= htmlspecialchars($order_id) ?>";

        if (!orderId || orderId === "N/A") {
            console.warn("No order_id provided in URL.");
            return;
        }

        if (!authToken) {
            console.warn("No auth_token in localStorage. Cannot call /orders API.");
            return;
        }

        // 🎨 Variant -> Color map
        const variantColors = {
            "Denim Blue": "#6497B2",
            "Baby Pink": "#C7ABA9",
            "Pearl White": "#F5F5F5",
            "Matte Black": "#21201E",
            "Pine": "#DDC194",
            "Beige": "#E6E0D4",
            "Walnut": "#926148",
            "Sunset Copper": "#936053",
            "Royal Brass": "#B7A97C",
            "Regal Gold": "#D3B063",
            "Pure Steel": "#878782",
            "Metallic Grey": "#D4D4D4",
            "Sand Beige": "#D3CBBB",
            "Metallic Walnut": "#7F513F",
            "Espresso Walnut": "#926148",
            "Moonlit White": "#E6E6E6",
            "Natural Pine": "#DDC194",
            "Velvet Black": "#0B0A08"
        };

        const apiUrl = "<?= BASE_URL ?>/orders/" + encodeURIComponent(orderId);

        fetch(apiUrl, {
            method: "GET",
            headers: {
                "Authorization": "Bearer " + authToken,
                "Accept": "application/json"
            }
        })
        .then(res => res.json())
        .then(res => {
            if (!res || !res.success || !res.data) {
                console.warn("Failed to fetch order details:", res);
                return;
            }

            const data = res.data;

            // 🔁 Update amount (pill + summary)
            if (data.total_amount) {
                const formatted = "₹ " + parseFloat(data.total_amount)
                    .toLocaleString("en-IN", {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                const displayEl = document.getElementById("totalAmountDisplay");
                const cellEl    = document.getElementById("totalAmountCell");

                if (displayEl) displayEl.textContent = formatted;
                if (cellEl) cellEl.textContent = formatted;
            }

            // 🔁 Update shipping address
            if (data.shipping_address) {
                const shipCell = document.getElementById("shippingAddressCell");
                if (shipCell) {
                    shipCell.textContent = data.shipping_address;
                }
            }

            // 🔁 Populate product list with color dot & qty pill
            const list = document.getElementById("productList");
            if (list && Array.isArray(data.items)) {
                list.innerHTML = "";

                data.items.forEach(function (item) {
                    const variantValue = item["variant value"] || item.variant_value || "";
                    const productName  = item.product_name || "";
                    const qty          = item.quantity || "";

                    let colorHex = "#E5E7EB"; // default neutral
                    if (variantValue && variantColors[variantValue]) {
                        colorHex = variantColors[variantValue];
                    }

                    const div = document.createElement("div");
                    div.className = "product-card-line";

                    div.innerHTML = `
                        <div class="product-left">
                            <div class="variant-info">
                                <div class="variant-top-line">
                                    <span class="variant-color-dot" style="background-color: ${colorHex};"></span>
                                    <span class="variant-name">${productName}</span>
                                </div>
                                ${variantValue ? `<span class="variant-label">${variantValue}</span>` : ``}
                            </div>
                        </div>
                        <div class="product-right">
                            <span class="product-qty-pill">Qty: ${qty}</span>
                        </div>
                    `;

                    list.appendChild(div);
                });
            }
        })
        .catch(err => {
            console.error("Error calling /orders/{id} API:", err);
        });
    });
</script>

<link rel="stylesheet" href="assets/css/style.min.css">
<?php include("footer.php"); ?>
