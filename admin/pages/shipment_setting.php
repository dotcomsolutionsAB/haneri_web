<base href="../">
<?php include "../../configs/auth_check.php"; ?>
<?php include "../../configs/config.php"; ?>

<?php
    $current_page = "Delhivery Pincode Serviceability";
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
                    Delhivery Pincode Serviceability
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                    Check COD, pickup, and delivery serviceability for any pincode.
                </div>
            </div>
        </div>
    </div>
    <!-- End of Header Container -->

    <!-- TAT + Shipping Cost (Combined Row) -->
    <div class="container-fixed mb-4">
        <div class="grid gap-4 lg:gap-5 md:grid-cols-2">
            <!-- Expected Delivery (TAT) -->
            <div class="card">
                <div class="card-body flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-sm font-medium text-gray-900">
                            Expected Delivery (TAT)
                        </h3>
                        <p class="text-2sm text-gray-600">
                            Get estimated transit days between two pincodes based on mode &amp; pickup date.
                        </p>
                    </div>
                    <button
                        id="btn-check-tat"
                        type="button"
                        class="btn btn-sm btn-primary"
                    >
                        Check Expected Delivery
                    </button>
                </div>
            </div>

            <!-- Shipping Cost Estimator -->
            <div class="card">
                <div class="card-body flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-sm font-medium text-gray-900">
                            Delhivery Shipping Cost
                        </h3>
                        <p class="text-2sm text-gray-600">
                            Estimate shipping charges between two pincodes (Pre-paid or COD).
                        </p>
                    </div>
                    <button
                        id="btn-check-shipping-cost"
                        type="button"
                        class="btn btn-sm btn-primary"
                    >
                        Check Shipping Cost
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="container-fixed">
        <div class="grid gap-5 lg:gap-7.5">
            <div class="card card-grid min-w-full">
                <div class="card-header py-5 flex-wrap gap-2 justify-between items-end">
                    <div class="flex flex-col gap-1">
                        <h3 class="card-title">
                            Pincode Serviceability
                        </h3>
                        <div class="text-2sm text-gray-600">
                            Enter a 6-digit pincode and click <span class="font-medium">Check</span>.
                        </div>
                    </div>
                    <div class="flex items-end gap-3">
                        <div class="flex flex-col">
                            <label for="svc-pincode" class="text-2sm font-medium text-gray-700 mb-1">
                                Pincode
                            </label>
                            <div class="relative">
                                <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
                                <input
                                    id="svc-pincode"
                                    class="input input-sm pl-8 w-32"
                                    placeholder="e.g. 700001"
                                    type="text"
                                    maxlength="6"
                                />
                            </div>
                        </div>
                        <button
                            id="btn-check-pincode"
                            class="btn btn-sm btn-primary mb-[2px]"
                            type="button"
                        >
                            Check
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Inner padding wrapper -->
                    <div class="p-4 md:p-5 space-y-4">
                        <!-- Status line -->
                        <div id="svc-status" class="text-2sm text-gray-600">
                            Enter a pincode to check serviceability.
                        </div>

                        <!-- Two-column layout: left = postal code, right = centers -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- LEFT: Postal code / small data -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-800 mb-2">
                                    Postal Code Details
                                </h4>
                                <div id="svc-result" class="hidden">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                        <!-- Filled by JS -->
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT: Centers -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-800 mb-2">
                                    Associated Centers
                                </h4>
                                <div id="svc-centers-wrapper" class="hidden">
                                    <div id="svc-centers" class="grid grid-cols-1 gap-3 text-xs">
                                        <!-- Filled by JS -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /inner padding -->
                </div>
            </div>
        </div>
    </div>

</main>
<!-- End of Content -->

<script>
    $(document).ready(function () {
        const token = localStorage.getItem('auth_token');

        const $svcPincode     = $("#svc-pincode");
        const $svcBtn         = $("#btn-check-pincode");
        const $svcStatus      = $("#svc-status");
        const $svcResult      = $("#svc-result");
        const $svcCentersWrap = $("#svc-centers-wrapper");
        const $svcCenters     = $("#svc-centers");

        const $btnCheckTat          = $("#btn-check-tat");
        const $btnCheckShippingCost = $("#btn-check-shipping-cost");

        // Small helper to escape HTML in strings
        const esc = (s = "") =>
            String(s).replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[c]));

        // A. EXPECTED DELIVERY (TAT) POPUP
        // ---------------------------------------------------
        function openTatPopup() {
            Swal.fire({
                title: 'Check Expected Delivery',
                html: `
                    <div class="text-left text-sm">
                        <input type="hidden" id="tat-through" value="simple">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <!-- Origin -->
                            <div class="flex flex-col">
                                <label for="tat-origin-pin" class="mb-1 text-gray-700">Origin Pincode</label>
                                <input
                                    id="tat-origin-pin"
                                    class="swal2-input ship-input"
                                    placeholder="e.g. 713146"
                                    maxlength="6"
                                >
                            </div>

                            <!-- Destination -->
                            <div class="flex flex-col">
                                <label for="tat-destination-pin" class="mb-1 text-gray-700">Destination Pincode</label>
                                <input
                                    id="tat-destination-pin"
                                    class="swal2-input ship-input"
                                    placeholder="e.g. 700001"
                                    maxlength="6"
                                >
                            </div>

                            <!-- MOT -->
                            <div class="flex flex-col">
                                <label for="tat-mot" class="mb-1 text-gray-700">Mode of Transport</label>
                                <select id="tat-mot" class="swal2-input ship-input">
                                    <option value="E" selected>Express</option>
                                    <option value="S">Surface</option>
                                </select>
                            </div>

                            <!-- PDT -->
                            <div class="flex flex-col">
                                <label for="tat-pdt" class="mb-1 text-gray-700">Product Type</label>
                                <select id="tat-pdt" class="swal2-input ship-input">
                                    <option value="B2C" selected>B2C</option>
                                    <option value="B2B">B2B</option>
                                    <option value="">Not Specified</option>
                                </select>
                            </div>

                            <!-- Expected Pickup Date/Time -->
                            <div class="flex flex-col sm:col-span-2">
                                <label for="tat-pickup" class="mb-1 text-gray-700">
                                    Expected Pickup Date & Time
                                    <span class="text-xs text-gray-500">(optional, used to compute approx delivery date)</span>
                                </label>
                                <input
                                    id="tat-pickup"
                                    class="swal2-input ship-input"
                                    type="datetime-local"
                                >
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Check',
                cancelButtonText: 'Close',
                focusConfirm: false,
                customClass: {
                    popup: 'swal2-my-small-popup swal2-small-popup',
                    confirmButton: 'swal2-confirm-blue',
                    cancelButton: 'swal2-cancel-red'
                },
                preConfirm: () => {
                    const originPin      = (document.getElementById('tat-origin-pin').value || '').trim();
                    const destinationPin = (document.getElementById('tat-destination-pin').value || '').trim();
                    const mot            = (document.getElementById('tat-mot').value || 'E').trim();
                    const pdt            = (document.getElementById('tat-pdt').value || '').trim();
                    const pickupRaw      = (document.getElementById('tat-pickup').value || '').trim(); // "YYYY-MM-DDTHH:MM"

                    // Basic validation
                    if (!/^\d{6}$/.test(originPin)) {
                        Swal.showValidationMessage('Please enter a valid 6-digit Origin Pincode.');
                        return false;
                    }
                    if (!/^\d{6}$/.test(destinationPin)) {
                        Swal.showValidationMessage('Please enter a valid 6-digit Destination Pincode.');
                        return false;
                    }

                    // pickupRaw is optional; if present we send it as-is (backend converts to "YYYY-MM-DD HH:MM")
                    let expectedPickupDate = null;
                    if (pickupRaw) {
                        expectedPickupDate = pickupRaw; // e.g. "2025-11-26T14:00"
                    }

                    return {
                        through: 'simple',
                        origin_pin: originPin,
                        destination_pin: destinationPin,
                        mot: mot,           // "E" or "S"
                        pdt: pdt || null,   // "B2C", "B2B" or null
                        expected_pickup_date: expectedPickupDate
                    };
                }
            }).then((result) => {
                if (!result.isConfirmed) return;

                const payload = result.value;

                Swal.fire({
                    title: 'Fetching expected delivery...',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal2-my-small-popup'
                    }
                });

                $.ajax({
                    url: `<?php echo BASE_URL; ?>/delivery/expected-time`,
                    type: 'POST',
                    headers: {
                        Authorization: `Bearer ${token}`
                    },
                    contentType: 'application/json',
                    data: JSON.stringify(payload),
                    success: (res) => {
                        const tat = res?.data?.data?.tat;

                        // Prepare labels
                        const motLabel = payload.mot === 'S' ? 'Surface' : 'Express';
                        const pdtLabel = payload.pdt || 'Not specified';
                        const fromPin  = payload.origin_pin;
                        const toPin    = payload.destination_pin;
                        const pickup   = payload.expected_pickup_date || null;

                        let approxDateText = '';
                        if (tat != null && tat > 0 && pickup) {
                            // Compute approx delivery date = pickup + tat days
                            const pickupDate = new Date(pickup);
                            if (!isNaN(pickupDate)) {
                                pickupDate.setDate(pickupDate.getDate() + tat);
                                const dd = String(pickupDate.getDate()).padStart(2,'0');
                                const mm = String(pickupDate.getMonth()+1).padStart(2,'0');
                                const yyyy = pickupDate.getFullYear();
                                approxDateText = `${dd}-${mm}-${yyyy}`;
                            }
                        }

                        if (!res?.success || tat == null) {
                            Swal.fire({
                                icon: 'info',
                                title: 'No TAT available',
                                text: res?.message || 'No expected delivery information returned for the given inputs.',
                                customClass: { popup: 'swal2-my-small-popup' }
                            });
                            return;
                        }

                        const html = `
                            <div class="text-sm text-left space-y-3">
                                <div>
                                    <div class="font-semibold text-gray-800 mb-1">
                                        Route: <span>${esc(fromPin)} → ${esc(toPin)}</span>
                                    </div>
                                    <div class="flex flex-wrap gap-4 text-xs text-gray-700">
                                        <div><span class="font-semibold">Mode:</span> ${esc(motLabel)}</div>
                                        <div><span class="font-semibold">Product:</span> ${esc(pdtLabel)}</div>
                                        ${
                                            pickup
                                                ? `<div><span class="font-semibold">Pickup:</span> ${esc(pickup.replace('T',' '))}</div>`
                                                : ''
                                        }
                                    </div>
                                </div>

                                <div class="border border-gray-200 rounded-md p-3 bg-gray-50 space-y-2 text-xs">
                                    <div class="flex justify-between">
                                        <span>Transit Time (TAT)</span>
                                        <span class="font-semibold text-gray-900">${tat} day${tat > 1 ? 's' : ''}</span>
                                    </div>
                                    ${
                                        approxDateText
                                            ? `
                                                <div class="flex justify-between">
                                                    <span>Approx. Delivery Date</span>
                                                    <span class="font-semibold text-gray-900">${esc(approxDateText)}</span>
                                                </div>
                                            `
                                            : ''
                                    }
                                </div>

                                <div class="text-[11px] text-gray-500">
                                    TAT is returned directly from Delhivery's expected_tat API and is indicative only.
                                </div>
                            </div>
                        `;

                        Swal.fire({
                            title: 'Expected Delivery (TAT)',
                            html: html,
                            icon: 'info',
                            showCloseButton: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal2-my-small-popup'
                            }
                        });
                    },
                    error: (err) => {
                        console.error('Error fetching TAT:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unable to fetch expected delivery at the moment.',
                            customClass: {
                                popup: 'swal2-my-small-popup'
                            }
                        });
                    }
                });
            });
        }

        function openShippingCostPopup() {
            Swal.fire({
                title: 'Check Shipping Cost',
                html: `
                    <div class="text-left text-sm">
                        <input type="hidden" id="ship-through" value="simple">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <!-- Origin -->
                            <div class="flex flex-col">
                                <label for="ship-origin-pin" class="mb-1 text-gray-700">Origin Pincode</label>
                                <input
                                    id="ship-origin-pin"
                                    class="swal2-input ship-input"
                                    placeholder="e.g. 713146"
                                    maxlength="6"
                                >
                            </div>

                            <!-- Destination -->
                            <div class="flex flex-col">
                                <label for="ship-destination-pin" class="mb-1 text-gray-700">Destination Pincode</label>
                                <input
                                    id="ship-destination-pin"
                                    class="swal2-input ship-input"
                                    placeholder="e.g. 700001"
                                    maxlength="6"
                                >
                            </div>

                            <!-- Weight -->
                            <div class="flex flex-col">
                                <label for="ship-weight" class="mb-1 text-gray-700">Charged Weight (kg)</label>
                                <input
                                    id="ship-weight"
                                    class="swal2-input ship-input"
                                    placeholder="e.g. 1"
                                    type="number"
                                    min="0.1"
                                    step="0.1"
                                >
                            </div>

                            <!-- Payment Type -->
                            <div class="flex flex-col">
                                <label for="ship-payment-type" class="mb-1 text-gray-700">Payment Type</label>
                                <select id="ship-payment-type" class="swal2-input ship-input">
                                    <option value="Pre-paid" selected>Pre-paid</option>
                                    <option value="COD">COD</option>
                                </select>
                            </div>

                            <!-- COD Amount (show only if COD) -->
                            <div class="flex flex-col sm:col-span-2" id="ship-cod-wrapper" style="display:none;">
                                <label for="ship-cod-amount" class="mb-1 text-gray-700">
                                    COD Amount (₹)
                                    <span class="text-xs text-gray-500">(required only for COD)</span>
                                </label>
                                <input
                                    id="ship-cod-amount"
                                    class="swal2-input ship-input"
                                    placeholder="e.g. 1500"
                                    type="number"
                                    min="0"
                                    step="0.01"
                                    value="0"
                                >
                            </div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Check',
                cancelButtonText: 'Close',
                focusConfirm: false,
                customClass: {
                    popup: 'swal2-my-small-popup swal2-small-popup',   // smaller popup
                    confirmButton: 'swal2-confirm-blue',               // blue button
                    cancelButton: 'swal2-cancel-red'                   // red button
                },
                didOpen: () => {
                    const paymentSelect = document.getElementById('ship-payment-type');
                    const codWrapper    = document.getElementById('ship-cod-wrapper');
                    const codInput      = document.getElementById('ship-cod-amount');

                    function toggleCod() {
                        if (paymentSelect.value === 'COD') {
                            codWrapper.style.display = 'block';
                            codInput.removeAttribute('disabled');
                            codInput.classList.remove('opacity-60');
                        } else {
                            codWrapper.style.display = 'none';
                            codInput.value = '0';
                            codInput.setAttribute('disabled', 'disabled');
                            codInput.classList.add('opacity-60');
                        }
                    }

                    toggleCod();
                    paymentSelect.addEventListener('change', toggleCod);
                },
                preConfirm: () => {
                    const originPin      = (document.getElementById('ship-origin-pin').value || '').trim();
                    const destinationPin = (document.getElementById('ship-destination-pin').value || '').trim();
                    const weightStr      = (document.getElementById('ship-weight').value || '').trim();
                    const paymentType    = (document.getElementById('ship-payment-type').value || 'Pre-paid').trim();
                    const codAmountStr   = (document.getElementById('ship-cod-amount').value || '').trim();

                    // Basic validation
                    if (!/^\d{6}$/.test(originPin)) {
                        Swal.showValidationMessage('Please enter a valid 6-digit Origin Pincode.');
                        return false;
                    }
                    if (!/^\d{6}$/.test(destinationPin)) {
                        Swal.showValidationMessage('Please enter a valid 6-digit Destination Pincode.');
                        return false;
                    }

                    const weight = parseFloat(weightStr);
                    if (isNaN(weight) || weight <= 0) {
                        Swal.showValidationMessage('Please enter a valid weight (kg).');
                        return false;
                    }

                    let codAmount = 0;
                    if (paymentType === 'COD') {
                        codAmount = parseFloat(codAmountStr);
                        if (isNaN(codAmount) || codAmount <= 0) {
                            Swal.showValidationMessage('Please enter a valid COD Amount for COD shipments.');
                            return false;
                        }
                    }

                    return {
                        through: 'simple',
                        origin_pin: originPin,
                        destination_pin: destinationPin,
                        weight: weight,
                        cod_amount: codAmount,
                        payment_type: paymentType
                    };
                }
            }).then((result) => {
                if (!result.isConfirmed) return;

                const payload = result.value;

                Swal.fire({
                    title: 'Fetching shipping cost...',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'swal2-my-small-popup'
                    }
                });

                $.ajax({
                    url: `<?php echo BASE_URL; ?>/delivery/shipping-cost`,
                    type: 'POST',
                    headers: {
                        Authorization: `Bearer ${token}`
                    },
                    contentType: 'application/json',
                    data: JSON.stringify(payload),
                    success: (res) => {
                        if (!res || !res.success || !Array.isArray(res.data) || !res.data.length) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unable to fetch',
                                text: res?.message || 'No shipping cost returned.',
                                customClass: {
                                    popup: 'swal2-my-small-popup'
                                }
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
                                    Values are returned directly from Delhivery's invoice/charges API for the given inputs.
                                </div>
                            </div>
                        `;

                        Swal.fire({
                            title: 'Shipping Cost',
                            html: html,
                            icon: 'info',
                            showCloseButton: true,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'swal2-my-small-popup'
                            }
                        });
                    },
                    error: (err) => {
                        console.error('Error fetching shipping cost:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unable to fetch shipping cost at the moment.',
                            customClass: {
                                popup: 'swal2-my-small-popup'
                            }
                        });
                    }
                });
            });
        }

        $btnCheckShippingCost.on("click", function () {
            openShippingCostPopup();
        });
        $btnCheckTat.on("click", function () {
            openTatPopup();
        });

        /* ---------------------------------------------------
         *  B. PINCODE SERVICEABILITY (existing code)
         * --------------------------------------------------*/

        function renderPincodeServiceability(data, pincode) {
            if (!data || !Array.isArray(data.delivery_codes) || !data.delivery_codes.length) {
                $svcResult.addClass("hidden").find("> .grid").empty();
                $svcCentersWrap.addClass("hidden");
                $svcCenters.empty();
                $svcStatus.text(`No serviceability information found for ${pincode}.`);
                return;
            }

            const postal = data.delivery_codes[0].postal_code || {};
            const safe = (v) => esc(v == null ? "" : String(v));

            const cod     = postal.cod === "Y" ? "Available" : "Not available";
            const prepaid = postal.pre_paid === "Y" ? "Available" : "Not available";
            const pickup  = postal.pickup === "Y" ? "Available" : "Not available";
            const cash    = postal.cash === "Y" ? "Available" : "Not available";
            const oda     = (postal.is_oda === "Y" || postal.is_oda === true) ? "ODA Location" : "Regular";
            const sunTat  = postal.sun_tat ? "Yes" : "No";

            const maxWeight = postal.max_weight ? postal.max_weight + " kg" : "—";
            const maxAmount = postal.max_amount ? "₹ " + parseFloat(postal.max_amount).toFixed(2) : "—";

            const $grid = $svcResult.find("> .grid");
            $grid.html(`
                <div>
                    <div class="svc-label">Pincode</div>
                    <div class="shipment-value">${safe(postal.pin || pincode)}</div>
                </div>
                <div>
                    <div class="svc-label">City</div>
                    <div class="shipment-value">${safe(postal.city)}</div>
                </div>
                <div>
                    <div class="svc-label">District</div>
                    <div class="shipment-value">${safe(postal.district)}</div>
                </div>
                <div>
                    <div class="svc-label">State / INC</div>
                    <div class="shipment-value">${safe(postal.inc || postal.state_code)}</div>
                </div>

                <div>
                    <div class="svc-label">COD</div>
                    <div class="shipment-value">${safe(cod)}</div>
                </div>
                <div>
                    <div class="svc-label">Prepaid</div>
                    <div class="shipment-value">${safe(prepaid)}</div>
                </div>
                <div>
                    <div class="svc-label">Pickup</div>
                    <div class="shipment-value">${safe(pickup)}</div>
                </div>
                <div>
                    <div class="svc-label">Cash</div>
                    <div class="shipment-value">${safe(cash)}</div>
                </div>

                <div>
                    <div class="svc-label">ODA</div>
                    <div class="shipment-value">${safe(oda)}</div>
                </div>
                <div>
                    <div class="svc-label">Sort Code</div>
                    <div class="shipment-value">${safe(postal.sort_code)}</div>
                </div>
                <div>
                    <div class="svc-label">Sunday Delivery</div>
                    <div class="shipment-value">${safe(sunTat)}</div>
                </div>
                <div>
                    <div class="svc-label">Covid Zone</div>
                    <div class="shipment-value">${safe(postal.covid_zone)}</div>
                </div>

                <div>
                    <div class="svc-label">Max Weight</div>
                    <div class="shipment-value">${safe(maxWeight)}</div>
                </div>
                <div>
                    <div class="svc-label">Max Amount</div>
                    <div class="shipment-value">${safe(maxAmount)}</div>
                </div>
                <div>
                    <div class="svc-label">Country</div>
                    <div class="shipment-value">${safe(postal.country_code || "IN")}</div>
                </div>
                <div>
                    <div class="svc-label">Remarks</div>
                    <div class="shipment-value">${safe(postal.remarks)}</div>
                </div>
            `);

            $svcStatus.text(`Serviceability for pincode ${pincode}`);
            $svcResult.removeClass("hidden");

            // Centers on right side
            const centers = Array.isArray(postal.center) ? postal.center : [];
            if (centers.length) {
                $svcCenters.empty();
                centers.forEach(c => {
                    $svcCenters.append(`
                        <div class="svc-center-card">
                            <div class="svc-center-name">${safe(c.cn || c.code)}</div>
                            <div class="svc-center-row">
                                <span class="svc-center-label">Code:</span>
                                <span class="svc-center-value">${safe(c.code)}</span>
                            </div>
                            <div class="svc-center-row">
                                <span class="svc-center-label">Sort Code:</span>
                                <span class="svc-center-value">${safe(c.sort_code)}</span>
                            </div>
                            <div class="svc-center-row">
                                <span class="svc-center-label">Updated By:</span>
                                <span class="svc-center-value">${safe(c.u)}</span>
                            </div>
                            <div class="svc-center-row">
                                <span class="svc-center-label">Start:</span>
                                <span class="svc-center-value">${safe(c.s)}</span>
                            </div>
                            <div class="svc-center-row">
                                <span class="svc-center-label">End:</span>
                                <span class="svc-center-value">${safe(c.e || "-")}</span>
                            </div>
                        </div>
                    `);
                });
                $svcCentersWrap.removeClass("hidden");
            } else {
                $svcCentersWrap.addClass("hidden");
                $svcCenters.empty();
            }
        }

        function fetchPincodeServiceability(pincode) {
            const pin = (pincode || "").trim();

            if (!pin) {
                $svcStatus.text("Please enter a pincode.");
                $svcResult.addClass("hidden").find("> .grid").empty();
                $svcCentersWrap.addClass("hidden");
                $svcCenters.empty();
                return;
            }

            // Basic validation: numeric & 6 digits
            if (!/^\d{6}$/.test(pin)) {
                $svcStatus.text("Please enter a valid 6-digit pincode.");
                $svcResult.addClass("hidden").find("> .grid").empty();
                $svcCentersWrap.addClass("hidden");
                $svcCenters.empty();
                return;
            }

            $svcStatus.text("Checking serviceability...");
            $svcResult.addClass("hidden").find("> .grid").empty();
            $svcCentersWrap.addClass("hidden");
            $svcCenters.empty();

            $.ajax({
                url: `<?php echo BASE_URL; ?>/delivery/pincode-serviceability?pincode=${encodeURIComponent(pin)}`,
                type: 'GET',
                headers: { Authorization: `Bearer ${token}` },
                success: (res) => {
                    if (res && res.success && res.data) {
                        renderPincodeServiceability(res.data, pin);
                    } else {
                        $svcStatus.text(res?.message || `No serviceability found for ${pin}.`);
                        $svcResult.addClass("hidden").find("> .grid").empty();
                        $svcCentersWrap.addClass("hidden");
                        $svcCenters.empty();
                    }
                },
                error: (err) => {
                    console.error("Error fetching pincode serviceability:", err);
                    $svcStatus.text("Unable to check serviceability at the moment.");
                    $svcResult.addClass("hidden").find("> .grid").empty();
                    $svcCentersWrap.addClass("hidden");
                    $svcCenters.empty();
                }
            });
        }

        // Button click
        $svcBtn.on("click", function () {
            fetchPincodeServiceability($svcPincode.val());
        });

        // Enter key in input
        $svcPincode.on("keyup", function (e) {
            if (e.key === "Enter") {
                fetchPincodeServiceability($svcPincode.val());
            }
        });
    });
</script>

<style>
    /* Existing (from your code) */
div:where(.swal2-container) .swal2-input {
    width:25rem;
}
div:where(.swal2-container).swal2-center>.swal2-popup {
    width:40rem;
}

/* Make this shipping popup small */
.swal2-small-popup {
    width: 420px !important;
    max-width: 90vw !important;
    padding: 18px 22px !important;
}

/* Override width for shipping-cost popup inputs inside grid */
div:where(.swal2-container) .swal2-popup .ship-input {
    width: 100% !important;
    box-sizing: border-box;
    margin: 0.25rem 0 !important;
}

/* Button colors for this popup */
.swal2-confirm.swal2-confirm-blue {
    background-color: #2563eb !important; /* Tailwind blue-600 style */
    border-color: #2563eb !important;
    color: #ffffff !important;
    font-size: 0.85rem !important;
    padding: 0.5rem 1.1rem !important;
}

.swal2-cancel.swal2-cancel-red {
    background-color: #dc2626 !important; /* red-600 */
    border-color: #dc2626 !important;
    color: #ffffff !important;
    font-size: 0.85rem !important;
    padding: 0.5rem 1.1rem !important;
}

/* Optional: slightly smaller overall font for this popup */
.swal2-my-small-popup {
    font-size: 0.85rem;
    line-height: 1.3;
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

  .svc-label{
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

  .svc-center-card{
    border:1px solid #e5e7eb;
    border-radius:6px;
    padding:6px 8px;
    background:#f9fafb;
  }

  .svc-center-name{
    font-size:12px;
    font-weight:600;
    margin-bottom:4px;
    color:#111827;
  }

  .svc-center-row{
    display:flex;
    justify-content:space-between;
    gap:6px;
    font-size:11px;
    margin-bottom:2px;
  }

  .svc-center-label{
    color:#6b7280;
  }

  .svc-center-value{
    color:#111827;
    text-align:right;
  }
</style>

<?php include "footer1.php"; ?>
