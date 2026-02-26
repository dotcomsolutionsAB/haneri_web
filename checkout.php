
<?php include("header.php"); ?>
<?php include("configs/config.php"); ?> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* Tablet view: Set address card width to 350px */
    @media (min-width: 768px) and (max-width: 1024px) {
        .address-card {
            width: 350px !important;
            margin: 10px auto !important;
        }
    }
    .checkout-container .order-summary {
        padding: 2.8rem 3.2rem 3.1rem;
        margin-top: 1px;
        border-radius: 5px;
    }
    .checkout-progress-bar li.active a{
        font-family: 'Barlow Condensed';
        font-size: 20px !important;
        color: #00473E !important;
        letter-spacing: 0.02em;
    }
    .checkout-progress-bar li.disabled a {
        color: #919292;
        font-family: 'Barlow Condensed';
        font-size: 20px !important;
        letter-spacing: 0.02em;
    }
    .checkout-progress-bar li a {
        font-family: 'Barlow Condensed';
        font-size: 20px !important;
        letter-spacing: 0.02em;
    }
    .step-title{
        font-family: 'Barlow Condensed';
        font-size: 25px !important;
        letter-spacing: 0.02em ;
        margin-bottom: 12px;
    }
    .order-summary h3 {
        font-family: 'Barlow Condensed' !important;
        font-size: 18px !important;
        letter-spacing: 0.02em;
    }
    .product-col .order-summary h3 {
        font-family: 'Barlow Condensed' !important;
        font-size: 20px !important;
        letter-spacing: 0.02em;
    }
    .table-mini-cart td, .table-mini-cart th, .table-mini-cart thead th, .table-mini-cart tr {
        padding:0px !important;
        font-family: 'Barlow Condensed' !important;
        letter-spacing: normal;
        font-size: 18px !important;
    }
    .order-summary h4 {
        padding:0px !important;
        font-family: 'Barlow Condensed' !important;
        letter-spacing: normal;
        font-size: 18px !important;
    }
    .table-mini-cart .price-col, .table-mini-cart .product-col {
        padding: 10px 0px !important;
    }
    .table-mini-cart .product-title{
 
    }
    .order-total td, .order-shipping td {
        padding: 10px 0px !important;
    }
    @media (max-width: 520px) {
        footer {
            margin-bottom: 0px !important;
        }
    }
    .btn-place-order {
        width: 100%;
        font-family: 'Barlow Condensed' !important;
        font-size: 20px !important;
        letter-spacing: 0.02em !important;
        padding: 10px 0 !important;
        margin-bottom: 0.6rem;
        border-radius: 10px !important;
        font-size: 18px !important;
    }
</style>
<!-- no address animation -->
<style>
    .no-address-box {
        width: 100%;
        padding: 40px 20px;
        background: #f9fbff;
        border-radius: 10px;
        border: 1px solid #e3e8ff;
        text-align: center;
        animation: fadeIn 0.6s ease-out forwards;
        font-family:'Barlow Condensed';
    }

    .no-address-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 15px;
        background: #eef2ff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: floatUp 2.4s ease-in-out infinite;
    }

    .no-address-icon i {
        font-size: 45px;
        color: #00473E ;
    }

    .no-address-title {
        font-size: 20px;
        font-weight: 600;
        color: #2d2d2d;
        margin-bottom: 8px;
    }

    .no-address-text {
        font-size: 14px;
        color: #555;
        margin-bottom: 20px;
    }

    .no-address-btn {
        padding: 10px 20px;
        background: #00473E ;
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s ease;
        letter-spacing: 0.02em !important;
    }
    .no-address-btn:hover {
        background: #00473E ;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes floatUp {
        0%   { transform: translateY(0px); }
        50%  { transform: translateY(-6px); }
        100% { transform: translateY(0px); }
    }
</style>

<main class="main main-test checkout_page">
    <div class="container checkout-container padding_top_100">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li>
                <a href="cart.php">Shopping Cart</a>
            </li>
            <li class="active">
                <a href="checkout.php">Checkout</a>
            </li>
            <!-- <li class="disabled"> -->
            <li class="disabled">
                <a href="order-complete.php">Order Complete</a>
            </li>
        </ul>
        <!-- Your existing jQuery script with minimal changes -->
        <script>
            $(document).ready(function () {
                const authToken = localStorage.getItem('auth_token'); // Replace with actual token
                const tempId = localStorage.getItem('temp_id');
                const baseUrl = "<?php echo BASE_URL; ?>/address";
                let addressList = []; // Store addresses in memory

                // If not logged in, don't call /address. Go straight to Add Address form.
                if (!authToken) {
                    // Hide the normal address section completely
                    $(".addresses").hide();

                    // Show no-address animation box
                    $(".no_address").html(`
                        <div class="no-address-box">
                            <div class="no-address-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>

                            <div class="no-address-title">No Address Found</div>

                            <div class="no-address-text">
                                You haven’t added any address yet.<br>
                                Add your first shipping address to continue.
                            </div>

                            <button class="no-address-btn" onclick="openAddAddressForm()">
                                + Add New Address
                            </button>
                        </div>
                    `).show();

                    // Open modal
                    setTimeout(() => {
                        openAddAddressForm();
                    }, 800);
                    
                } else {
                    fetchAddresses(); // logged-in users only
                }


                function fetchAddresses() {
                    $.ajax({
                        url: baseUrl,
                        type: "GET",
                        headers: { "Authorization": `Bearer ${authToken}` },
                        success: function (response) {
                            if (response.data.length > 0) {
                                // SHOW addresses
                                $(".addresses").show();
                                // HIDE no-address box
                                $(".no_address").html("").hide();

                                addressList = response.data;

                                let addressHTML = "";

                                response.data.forEach((address, index) => {
                                    let isChecked = address.is_default ? "checked" : "";

									let addressLine2HTML = address.address_line2 
										? `<p><strong>Address 2:</strong> ${address.address_line2}</p>` 
										: "";
                                    addressHTML += `
                                        <label class="address-card" for="addressRadio${index}">
                                            <div class="card-header">
                                                <h3 class="card-title">${address.name}</h3>
                                                <p class="card-phone">${address.contact_no}</p>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Address 1:</strong> ${address.address_line1}</p>
                                                ${addressLine2HTML}
                                                <p><strong>Location:</strong> ${address.country}, ${address.state}, ${address.city}</p>
                                                <p><strong>Postal Code:</strong> ${address.postal_code}</p>
                                            </div>
                                            <div class="card-footer cardf">
                                                <div class="red">
                                                    <input
                                                        type="radio"
                                                        id="addressRadio${index}"
                                                        name="address_select"
                                                        class="select-radio"
                                                        ${isChecked}
                                                    >
                                                    <span class="footer-label">Select Address</span>
                                                </div>
                                                <div class="btbt">
                                                    <button class="btn btn-primary btn-sm edit-add" onclick="openUpdateModal(${address.id})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm del-add" onclick="deleteAddress(${address.id})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>                                            
                                                </div>
                                            </div>
                                        </label>
                                    `;
                                });

                                $("#collapseNew").html(addressHTML).addClass("show");
                                // ✅ trigger shipping calc for default selected address
                                setTimeout(() => {
                                    $("input[name='address_select']:checked").trigger("change");
                                }, 100);
                            } else {
                                // HIDE the address area
                                $(".addresses").hide();

                                // SHOW the no-address animation box
                                $(".no_address").html(`
                                    <div class="no-address-box">
                                        <div class="no-address-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>

                                        <div class="no-address-title">No Address Found</div>

                                        <div class="no-address-text">
                                            You haven’t added any address yet.<br>
                                            Add your first shipping address to continue.
                                        </div>

                                        <button class="no-address-btn" onclick="openAddAddressForm()">
                                            + Add New Address
                                        </button>
                                    </div>
                                `).show();

                                // Auto open modal
                                setTimeout(() => openAddAddressForm(), 800);
                            }
                        },
                        error: function () {
                            console.error("Error fetching addresses.");
                        }
                    });
                }

                window.deleteAddress = function (id) { 
                    $.ajax({
                        url: `${baseUrl}/${id}`,
                        type: "DELETE",
                        headers: { "Authorization": `Bearer ${authToken}` },
                        success: function (response) {
                            if (response.message.includes("success")) {
                                // alert("Address deleted successfully.");
                                fetchAddresses(); // Refresh address list
                            } else {
                                alert("Failed to delete address. Please try again.");
                            }
                        },
                        error: function () {
                            alert("Failed to delete address. Please try again.");
                        }
                    });
                };

                // fetchAddresses();

                window.openUpdateModal = function (id) {
                    const address = addressList.find(addr => addr.id === id); // Get data from memory

                    if (!address) {
                        Swal.fire({
                            title: "Error!",
                            text: "Address not found.",
                            icon: "error"
                        });
                        return;
                    }

                    Swal.fire({
                        title: 'Update Address',
                        width: '700px',
                        customClass: {
                            confirmButton: 'update-address-btn',
                            cancelButton: 'cancel-address-btn'
                        },
                        html: `
                            <style>
                                .swal-form-grid {
                                    display: grid;
                                    grid-template-columns: 1fr 1fr;
                                    gap: 15px;
                                }
                                .swal-form-grid input,
                                .swal-form-grid select {
                                    width: 100%;
                                    height: 45px;
                                    padding: 10px;
                                    font-size: 14px;
                                    border-radius: 5px;
                                    border: 1px solid #ccc;
                                }
                                .swal2-actions {
                                    justify-content: flex-end;
                                    margin-top: 20px;
                                }
                            </style>

                            <form id="swal-update-form" class="swal-form-grid">
                                <input type="hidden" id="update_address_id" value="${address.id}">
                                <input type="text" id="update_name" value="${address.name || ''}" placeholder="Name">
                                <input type="text" id="update_contact_no" inputmode="numeric" pattern="\\d{10}" maxlength="10"value="${address.contact_no || ''}" placeholder="Contact No">
                                <input type="text" id="update_address_line1" maxlength="250" value="${address.address_line1 || ''}" placeholder="Address Line 1">
                                <input type="text" id="update_address_line2" maxlength="250" value="${address.address_line2 || ''}" placeholder="Address Line 2 (optional)">
                                <input type="text" id="update_city" value="${address.city || ''}" placeholder="City">
                                <select id="update_state">
                                    <option value="">Select State</option>
                                    <option value="Andhra Pradesh" ${address.state === "Andhra Pradesh" ? "selected" : ""}>Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh" ${address.state === "Arunachal Pradesh" ? "selected" : ""}>Arunachal Pradesh</option>
                                    <option value="Assam" ${address.state === "Assam" ? "selected" : ""}>Assam</option>
                                    <option value="Bihar" ${address.state === "Bihar" ? "selected" : ""}>Bihar</option>
                                    <option value="Chhattisgarh" ${address.state === "Chhattisgarh" ? "selected" : ""}>Chhattisgarh</option>
                                    <option value="Goa" ${address.state === "Goa" ? "selected" : ""}>Goa</option>
                                    <option value="Gujarat" ${address.state === "Gujarat" ? "selected" : ""}>Gujarat</option>
                                    <option value="Haryana" ${address.state === "Haryana" ? "selected" : ""}>Haryana</option>
                                    <option value="Himachal Pradesh" ${address.state === "Himachal Pradesh" ? "selected" : ""}>Himachal Pradesh</option>
                                    <option value="Jharkhand" ${address.state === "Jharkhand" ? "selected" : ""}>Jharkhand</option>
                                    <option value="Karnataka" ${address.state === "Karnataka" ? "selected" : ""}>Karnataka</option>
                                    <option value="Kerala" ${address.state === "Kerala" ? "selected" : ""}>Kerala</option>
                                    <option value="Madhya Pradesh" ${address.state === "Madhya Pradesh" ? "selected" : ""}>Madhya Pradesh</option>
                                    <option value="Maharashtra" ${address.state === "Maharashtra" ? "selected" : ""}>Maharashtra</option>
                                    <option value="Manipur" ${address.state === "Manipur" ? "selected" : ""}>Manipur</option>
                                    <option value="Meghalaya" ${address.state === "Meghalaya" ? "selected" : ""}>Meghalaya</option>
                                    <option value="Mizoram" ${address.state === "Mizoram" ? "selected" : ""}>Mizoram</option>
                                    <option value="Nagaland" ${address.state === "Nagaland" ? "selected" : ""}>Nagaland</option>
                                    <option value="Odisha" ${address.state === "Odisha" ? "selected" : ""}>Odisha</option>
                                    <option value="Punjab" ${address.state === "Punjab" ? "selected" : ""}>Punjab</option>
                                    <option value="Rajasthan" ${address.state === "Rajasthan" ? "selected" : ""}>Rajasthan</option>
                                    <option value="Sikkim" ${address.state === "Sikkim" ? "selected" : ""}>Sikkim</option>
                                    <option value="Tamil Nadu" ${address.state === "Tamil Nadu" ? "selected" : ""}>Tamil Nadu</option>
                                    <option value="Telangana" ${address.state === "Telangana" ? "selected" : ""}>Telangana</option>
                                    <option value="Tripura" ${address.state === "Tripura" ? "selected" : ""}>Tripura</option>
                                    <option value="Uttar Pradesh" ${address.state === "Uttar Pradesh" ? "selected" : ""}>Uttar Pradesh</option>
                                    <option value="Uttarakhand" ${address.state === "Uttarakhand" ? "selected" : ""}>Uttarakhand</option>
                                    <option value="West Bengal" ${address.state === "West Bengal" ? "selected" : ""}>West Bengal</option>
                                </select>
                                <select id="update_country">
                                    <option value="India" ${address.country === "India" ? "selected" : ""}>India</option>
                                    <option value="Australia" ${address.country === "Australia" ? "selected" : ""}>Australia</option>
                                </select>
                                <input type="text" id="update_postal_code" pattern="\\d{6}" maxlength="6" inputmode="numeric" value="${address.postal_code || ''}" placeholder="Pincode">
                            </form>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Save Changes',
                        cancelButtonText: 'Cancel',
                        // customClass: {
                        //     confirmButton: 'swal-orange-btn'
                        // },
                        focusConfirm: false,
                        preConfirm: () => {
                            return {
                                id: document.getElementById("update_address_id").value,
                                name: document.getElementById("update_name").value,
                                contact_no: document.getElementById("update_contact_no").value,
                                address_line1: document.getElementById("update_address_line1").value,
                                address_line2: document.getElementById("update_address_line2").value || null,
                                city: document.getElementById("update_city").value,
                                state: document.getElementById("update_state").value,
                                country: document.getElementById("update_country").value,
                                postal_code: document.getElementById("update_postal_code").value
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value) {
                            updateAddress(result.value);
                        }
                    });
                };

                window.updateAddress = function (data) {
                    if (!data || !data.id) {
                        Swal.fire("Error", "Invalid data", "error");
                        return;
                    }

                    const updatedData = {
                        name: data.name,
                        contact_no: data.contact_no,
                        address_line1: data.address_line1,
                        address_line2: data.address_line2,
                        city: data.city,
                        state: data.state,
                        postal_code: data.postal_code,
                        country: data.country,
                        is_default: true
                    };

                    Swal.fire({
                        title: "Updating...",
                        text: "Please wait",
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: `${baseUrl}/update/${data.id}`,
                        type: "POST",
                        headers: {
                            "Authorization": `Bearer ${authToken}`,
                            "Content-Type": "application/json"
                        },
                        data: JSON.stringify(updatedData),
                        success: function (response) {
                            Swal.close();
                            if (response.message && response.message.includes("success")) {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Address updated successfully. ",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    fetchAddresses(); // refresh list
                                });
                            } else {
                                Swal.fire("Error", response.message || "Failed to update address.", "error");
                            }
                        },
                        error: function () {
                            Swal.close();
                            Swal.fire("Error", "Something went wrong. Please try again.", "error");
                        }
                    });
                };               

                window.openAddAddressForm = function () {
                    const authToken = localStorage.getItem('auth_token');
                    const tempId = localStorage.getItem('temp_id');
                    const showCreateUserCheckbox = !authToken;

                    Swal.fire({
                        title: 'Add New Address',
                        width: '700px',
                        customClass: {
                            confirmButton: 'add-address-btn',
                            cancelButton: 'cancel-address-btn'
                        },
                        html: `
                            <form id="swal-address-form">
                                <input type="text" id="swal_name" placeholder="Name*" required>

                                <input
                                    type="text"
                                    id="swal_contact_no"
                                    placeholder="Contact No*"
                                    required
                                    inputmode="numeric"
                                    pattern="\\d{10}"
                                    maxlength="10"
                                    title="Please enter a valid 10-digit mobile number"
                                >

                                <input type="email" id="swal_email" placeholder="Email*" required>

                                <input
                                    type="text"
                                    id="swal_address_line1"
                                    placeholder="Address Line 1*"
                                    required
                                    maxlength="250"
                                >

                                <input
                                    type="text"
                                    id="swal_address_line2"
                                    placeholder="Address Line 2 (optional)"
                                    maxlength="250"
                                >

                                <input type="text" id="swal_city" placeholder="City*" required>

                                <select id="swal_state" required>
                                    <option value="">Select State*</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>

                                <select id="swal_country" required>
                                    <option value="India" selected>India</option>
                                </select>

                                <input
                                    type="text"
                                    id="swal_postal_code"
                                    placeholder="Pincode*"
                                    required
                                    pattern="\\d{6}"
                                    maxlength="6"
                                    inputmode="numeric"
                                    title="Please enter a valid 6-digit pincode"
                                />

                                <div id="swal_live_warning" style="display:none;margin-top:10px;color:#d33;font-size:12px;"></div>

                                ${showCreateUserCheckbox ? `
                                <div class="create_user_checkbox">
                                    <label for="swal_create_user">Create as User</label>
                                    <input type="checkbox" id="swal_create_user" name="create_user" checked>
                                </div>` : ''}
                            </form>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Add Address',
                        cancelButtonText: 'Cancel',
                        focusConfirm: false,

                        didOpen: () => {
                            const ids = [
                                'swal_name',
                                'swal_contact_no',
                                'swal_email',
                                'swal_address_line1',
                                'swal_address_line2',
                                'swal_city',
                                'swal_state',
                                'swal_country',
                                'swal_postal_code'
                            ];

                            const els = ids.map(id => document.getElementById(id)).filter(Boolean);

                            const warningEl = document.getElementById('swal_live_warning');
                            const confirmBtn = Swal.getConfirmButton();

                            const showWarning = (msg) => {
                                if (!warningEl) return;
                                if (!msg) {
                                    warningEl.style.display = 'none';
                                    warningEl.textContent = '';
                                    return;
                                }
                                warningEl.style.display = 'block';
                                warningEl.textContent = msg;
                            };

                            const disableOthersExcept = (allowedIds) => {
                                const allowed = new Set(allowedIds);
                                els.forEach(el => {
                                    el.disabled = (allowedIds.length > 0) && !allowed.has(el.id);
                                });
                            };

                            const validateLive = () => {
                                const contactEl = document.getElementById('swal_contact_no');
                                const pinEl = document.getElementById('swal_postal_code');
                                const addr1El = document.getElementById('swal_address_line1');
                                const addr2El = document.getElementById('swal_address_line2');

                                // Force numeric typing + max length (live)
                                if (contactEl) contactEl.value = contactEl.value.replace(/\D/g, '').slice(0, 10);
                                if (pinEl) pinEl.value = pinEl.value.replace(/\D/g, '').slice(0, 6);

                                // Enforce 250 chars live
                                if (addr1El && addr1El.value.length > 250) addr1El.value = addr1El.value.slice(0, 250);
                                if (addr2El && addr2El.value.length > 250) addr2El.value = addr2El.value.slice(0, 250);

                                const contact = contactEl ? contactEl.value.trim() : '';
                                const pin = pinEl ? pinEl.value.trim() : '';
                                const addr1 = addr1El ? addr1El.value : '';
                                const addr2 = addr2El ? addr2El.value : '';

                                const invalidIds = [];

                                // If user started typing and it's not valid yet, lock others until fixed
                                if (contact && !/^\d{10}$/.test(contact)) invalidIds.push('swal_contact_no');
                                if (pin && !/^\d{6}$/.test(pin)) invalidIds.push('swal_postal_code');
                                if (addr1.length > 250) invalidIds.push('swal_address_line1');
                                if (addr2.length > 250) invalidIds.push('swal_address_line2');

                                if (invalidIds.length) {
                                    disableOthersExcept(invalidIds);
                                    confirmBtn.disabled = true;

                                    if (invalidIds.includes('swal_contact_no')) {
                                        showWarning('Mobile number must be exactly 10 digits.');
                                    } else if (invalidIds.includes('swal_postal_code')) {
                                        showWarning('Pincode must be exactly 6 digits.');
                                    } else {
                                        showWarning('Address Line 1 / 2 must be within 250 characters.');
                                    }
                                    return;
                                }

                                disableOthersExcept([]);
                                confirmBtn.disabled = false;
                                showWarning('');
                            };

                            validateLive();

                            els.forEach(el => {
                                el.addEventListener('input', validateLive);
                                el.addEventListener('change', validateLive);
                            });
                        },

                        preConfirm: () => {
                            const name = document.getElementById('swal_name').value.trim();
                            const email = document.getElementById('swal_email').value.trim();
                            const contact_no = document.getElementById('swal_contact_no').value.trim();
                            const address_line1 = document.getElementById('swal_address_line1').value.trim();
                            const address_line2 = document.getElementById('swal_address_line2').value.trim();
                            const city = document.getElementById('swal_city').value.trim();
                            const state = document.getElementById('swal_state').value;
                            const country = document.getElementById('swal_country').value;
                            const postal_code = document.getElementById('swal_postal_code').value.trim();

                            if (!name || !contact_no || !email || !address_line1 || !city || !state || !country || !postal_code) {
                                Swal.showValidationMessage('Please fill all required fields.');
                                return false;
                            }

                            // strict validations
                            if (!/^\d{10}$/.test(contact_no)) {
                                Swal.showValidationMessage('Mobile number must be exactly 10 digits.');
                                return false;
                            }

                            if (!/^\d{6}$/.test(postal_code)) {
                                Swal.showValidationMessage('Pincode must be exactly 6 digits.');
                                return false;
                            }

                            if (address_line1.length > 250 || address_line2.length > 250) {
                                Swal.showValidationMessage('Address Line 1 / 2 must be within 250 characters.');
                                return false;
                            }

                            let create_user = false;
                            if (showCreateUserCheckbox) {
                                const createUserChecked = document.getElementById('swal_create_user').checked;
                                if (!createUserChecked) {
                                    Swal.showValidationMessage('Please check "Create as User" to proceed.');
                                    return false;
                                }
                                create_user = true;
                            }

                            return {
                                name,
                                email,
                                contact_no,
                                address_line1,
                                address_line2,
                                city,
                                state,
                                country,
                                postal_code,
                                create_user
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value) {
                            submitAddress(result.value);
                        }
                    });
                };

                // verify Otp for mobile helpers
                // ✅ OTP endpoints
                const OTP_REQUEST_URL = "<?php echo BASE_URL; ?>/request-otp";
                const OTP_VERIFY_URL  = "<?php echo BASE_URL; ?>/verify-otp";

                function showOtpOverlay(mobile) {
                  $("#otp-mobile-display").text(mobile);
                  $("#otp-code-error").hide().text("").css("color", "red");

                  // clear boxes
                  $("#otp-code-overlay .otp-input").val("");
                  $("#otp-code-overlay").css("display", "flex");

                  // focus first input
                  setTimeout(() => {
                    $("#otp-code-overlay .otp-input").first().focus();
                  }, 50);
                }

                function hideOtpOverlay() {
                  $("#otp-code-overlay").hide();
                }

                function setOtpError(msg, color) {
                  $("#otp-code-error").show().text(msg || "Something went wrong.").css("color", color || "red");
                }

                function getOtpValue() {
                  let otp = "";
                  $("#otp-code-overlay .otp-input").each(function () {
                    otp += ($(this).val() || "").trim();
                  });
                  return otp;
                }

                function bindOtpInputsOnce() {
                  if ($("#otp-code-overlay").data("bound")) return;
                  $("#otp-code-overlay").data("bound", true);

                  const $inputs = $("#otp-code-overlay .otp-input");

                  // numeric only + auto move next
                  $inputs.on("input", function () {
                    let v = ($(this).val() || "").replace(/\D/g, "").slice(0, 1);
                    $(this).val(v);

                    if (v && $(this).next(".otp-input").length) {
                      $(this).next(".otp-input").focus();
                    }
                  });

                  // backspace focus prev
                  $inputs.on("keydown", function (e) {
                    if (e.key === "Backspace" && !$(this).val() && $(this).prev(".otp-input").length) {
                      $(this).prev(".otp-input").focus();
                    }
                  });

                  // paste full OTP
                  $inputs.first().on("paste", function (e) {
                    const pasted = (e.originalEvent.clipboardData || window.clipboardData).getData("text");
                    const digits = (pasted || "").replace(/\D/g, "").slice(0, 6);

                    if (digits.length === 6) {
                      e.preventDefault();
                      $inputs.each(function (i) {
                        $(this).val(digits[i] || "");
                      });
                      $inputs.last().focus();
                    }
                  });

                  // change number => close overlay and focus mobile input in swal
                  $("#otp-change-link").on("click", function () {
                    hideOtpOverlay();
                    const mobileEl = document.getElementById("swal_contact_no");
                    if (mobileEl) mobileEl.focus();
                  });

                  // (optional) click outside modal: do nothing
                  $("#otp-code-overlay").on("click", function (e) {
                    if (e.target.id === "otp-code-overlay") {
                      // keep open
                    }
                  });
                }

                function requestOtp(mobile) {
                  return fetch(OTP_REQUEST_URL, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ mobile: mobile })
                  }).then(res => res.json());
                }

                function verifyOtp(mobile, otp) {
                  return fetch(OTP_VERIFY_URL, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ mobile: mobile, otp: otp })
                  }).then(res => res.json());
                }

                // ✅ Full OTP flow:
                // - request-otp
                //   - "Mobile already validated." => proceed immediately (no overlay)
                //   - "OTP sent successfully!"    => open overlay
                //   - else (failed)               => show error, do not open overlay
                // - verify-otp
                //   - "OTP verified successfully!" or "OTP already verified." => proceed
                //   - else => show error inside overlay
                function startOtpFlow(mobile, onVerified) {
                  bindOtpInputsOnce();

                  const proceed = () => {
                    if (typeof onVerified === "function") onVerified();
                  };

                  // Always reset error state when starting
                  $("#otp-code-error").hide().text("").css("color", "red");

                  // 1) REQUEST OTP
                  requestOtp(mobile)
                    .then(res => {
                      const msg  = (res && res.message) ? String(res.message) : "";
                      const msgL = msg.toLowerCase();

                      // ✅ Mobile already validated => skip OTP UI and continue
                      if (res && res.success && msgL.includes("mobile already validated")) {
                        // proceed();
                        Swal.fire("Info", msg || "Mobile already there, use another mobile number.", "info");
                        return;
                      }

                      // ✅ OTP sent => show overlay
                      if (res && res.success && msgL.includes("otp sent")) {
                        showOtpOverlay(mobile);
                        return;
                      }

                      // ❌ Failed to generate OTP or any other fail response
                      Swal.fire("Error", msg || "Failed to request OTP. Please try again.", "error");
                    })
                    .catch(err => {
                      console.error(err);
                      Swal.fire("Error", "Failed to request OTP. Please try again.", "error");
                    });

                  // 2) RESEND OTP
                  $("#otp-code-resend").off("click").on("click", function () {
                    $("#otp-code-error").hide().text("").css("color", "red");

                    requestOtp(mobile)
                      .then(res => {
                        const msg  = (res && res.message) ? String(res.message) : "";
                        const msgL = msg.toLowerCase();

                        // ✅ validated => proceed
                        if (res && res.success && msgL.includes("mobile already validated")) {
                          hideOtpOverlay();
                          // proceed();
                          Swal.fire("Info", msg || "Mobile already there, use another mobile number.", "info");
                          return;
                        }

                        // ✅ sent => show green message and clear boxes
                        if (res && res.success && msgL.includes("otp sent")) {
                          $("#otp-code-overlay .otp-input").val("");
                          $("#otp-code-overlay .otp-input").first().focus();
                          setOtpError(msg || "OTP sent successfully!", "green");
                          // restore red after a while
                          setTimeout(() => $("#otp-code-error").css("color", "red"), 1200);
                          return;
                        }

                        // ❌ fail
                        setOtpError(msg || "Failed to resend OTP.");
                      })
                      .catch(err => {
                        console.error(err);
                        setOtpError("Failed to resend OTP. Please try again.");
                      });
                  });

                  // 3) VERIFY OTP
                  $("#otp-code-submit").off("click").on("click", function () {
                    $("#otp-code-error").hide().text("").css("color", "red");

                    const otp = getOtpValue();
                    if (!/^\d{6}$/.test(otp)) {
                      setOtpError("Please enter a valid 6-digit OTP.");
                      return;
                    }

                    verifyOtp(mobile, otp)
                      .then(res => {
                        const msg  = (res && res.message) ? String(res.message) : "";
                        const msgL = msg.toLowerCase();

                        // ✅ verified or already verified => continue
                        if (res && res.success && (msgL.includes("otp verified successfully") || msgL.includes("otp already verified"))) {
                          hideOtpOverlay();
                          proceed();
                          return;
                        }

                        // ❌ record not found / invalid / expired / any other failure
                        setOtpError(msg || "OTP verification failed.");
                      })
                      .catch(err => {
                        console.error(err);
                        setOtpError("OTP verification failed. Please try again.");
                      });
                  });
                }

                function submitAddress(data) {
                  const authToken = localStorage.getItem("auth_token");
                  const tempId = localStorage.getItem("temp_id");

                  // ✅ mobile already client-validated in preConfirm, but double-safe:
                  const mobileToVerify = (data.contact_no || "").trim();
                  if (!/^\d{10}$/.test(mobileToVerify)) {
                    Swal.fire("Error", "Mobile number must be exactly 10 digits.", "error");
                    return;
                  }

                  const addressData = {
                    name: data.name,
                    contact_no: data.contact_no,
                    address_line1: data.address_line1,
                    address_line2: data.address_line2,
                    city: data.city,
                    state: data.state,
                    country: data.country,
                    postal_code: data.postal_code,
                    is_default: true
                  };

                  // ✅ Continue your existing flow ONLY after OTP verified
                  const proceedAfterOtpVerified = () => {
                    if (authToken) {
                      sendAddress(addressData, authToken);
                    } else if (tempId) {
                      Swal.fire({ title: "Wait...", allowOutsideClick: false, didOpen: () => Swal.showLoading() });

                      fetch("<?php echo BASE_URL; ?>/make_user", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({
                          name: data.name,
                          email: data.email,
                          mobile: data.contact_no,
                          cart_id: tempId
                        })
                      })
                      .then(res => res.json())
                      .then(resData => {
                        if (resData.token && resData.user) {
                          localStorage.setItem("auth_token", resData.token);
                          localStorage.setItem("user_name", resData.user.name);
                          localStorage.setItem("user_email", resData.user.email);
                          localStorage.setItem("user_mobile", resData.user.mobile);
                          localStorage.setItem("user_role", resData.user.role);
                          localStorage.setItem("pwd_000", resData.password);

                          sendAddress(addressData, resData.token);
                        } else {
                          Swal.close();
                          Swal.fire("Error", resData.message || "Failed to register user.", "error");
                        }
                      })
                      .catch(err => {
                        Swal.close();
                        console.error(err);
                        Swal.fire("Error", "Registration failed. Please try again.", "error");
                      });
                    } else {
                      Swal.fire("Error", "User not logged in or cart session expired.", "error");
                    }
                  };

                  // ✅ Start OTP flow FIRST
                  startOtpFlow(mobileToVerify, proceedAfterOtpVerified);
                }

                function sendAddress(addressData, token) {
                    fetch("<?php echo BASE_URL; ?>/address/register", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Authorization": `Bearer ${token}`
                        },
                        body: JSON.stringify(addressData)
                    })
                    .then(res => res.json())
                    .then(responseData => {
                        Swal.close();
                        if (responseData.success || (responseData.message && responseData.message.toLowerCase().includes("success"))) {
                            Swal.fire({
                                title: "Success",
                                text: "Address added successfully!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire("Error", responseData.message || "Failed to add address.", "error");
                        }
                    })
                    .catch(err => {
                        Swal.close();
                        console.error(err);
                        Swal.fire("Error", "Something went wrong. Please try again.", "error");
                    });
                }

                // Load addresses on page load
                // fetchAddresses();
            });
        </script>
        <style>
            .create_user_checkbox{
                height: 45px;
                display: flex;
                justify-content: flex-start;
                align-items: center;
                gap: 15px;
                display:none;
            }
            .create_user_checkbox input{
                width: 15px !important;
                height: 20px !important;
            }
            .create_user_checkbox label{
                margin: 0px;
                font-weight: 600;
                font-family: sans-serif !important;
                color: #1b4e47;
            }
            .add_address{
                color: #00473e !important;
            }
            
        </style>
        <div class="row">
            <div class="col-lg-8">
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Billing details</h2>
                        <div class="form-group">
                            <a href="javascript:void(0);" onclick="openAddAddressForm()" class="add_address">
                                Add another Address?
                            </a>
                        </div>

                        <div class="addresses">
                            <div class="address">                            
                                <div class="vvv">
                                    <button data-toggle="collapse" data-target="#collapseNew" aria-expanded="true" aria-controls="collapseNew" class="btn btn-link btn-toggle"></button>
                                </div>
                                <div id="collapseNew" class="collapse">
                                    <!-- Addresses will be dynamically added here -->
                                </div>
                            </div>
                        </div>
                        <div class="no_address">

                        </div>
                    </li>
                </ul>
            </div>
            <!-- End .col-lg-8 -->
            <script>
                $(document).ready(function () {
                    const authToken = localStorage.getItem('auth_token'); // Replace with actual token
                    const authTemp = localStorage.getItem('temp_id');
                    const cartUrl = "<?php echo BASE_URL; ?>/cart/fetch";
                    const orderUrl = "<?php echo BASE_URL; ?>/orders";
                    const shippingUrl = "<?php echo BASE_URL; ?>/delivery/shipping-cost";
                    const COUPON_CHECK_URL = "<?php echo BASE_URL; ?>/coupons/check";
                    const couponUse = true; // ✅ true = coupon enabled, false = coupon disabled
                    // Coupon setup
                    let appliedCoupon = null;     // stores API coupon data
                    let discountAmount = 0;       // numeric
                    let payableTotal = 0;         // numeric

                    function money(n) {
                        const x = Number(n || 0);
                        return `₹ ${x.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    }
                    // grand total BEFORE coupon
                    function getGrandTotalBeforeCoupon() {
                        const items = Number(cartItemsTotal || 0);
                        const ship  = Number(currentShippingCharge || 0);
                        return Number((items + ship).toFixed(2));
                    }
                    function computeDiscount(grandTotal, coupon) {
                        if (!coupon) return 0;

                        const type = String(coupon.discount_type || "").toLowerCase();
                        const val  = Number(coupon.discount_value || 0);

                        let disc = 0;

                        if (type === "percentage") {
                            disc = (grandTotal * val) / 100;
                        } else if (type === "price") {
                            disc = val;
                        }

                        disc = Number(disc.toFixed(2));

                        // never allow discount > grand total
                        if (disc > grandTotal) disc = grandTotal;

                        // never negative
                        if (disc < 0) disc = 0;

                        return disc;
                    }
                    function renderTotalsWithCoupon() {
                        if (!couponUse) appliedCoupon = null;

                        const grand = getGrandTotalBeforeCoupon();
                        discountAmount = computeDiscount(grand, appliedCoupon);
                        payableTotal = Number((grand - discountAmount).toFixed(2));

                        // UI: discount row
                        if (discountAmount > 0) {
                            $("#discountRow").show();
                            $("#discountAmount").text(`- ${money(discountAmount)}`);
                        } else {
                            $("#discountRow").hide();
                            $("#discountAmount").text(money(0));
                        }

                        // UI: old total strike + new total
                        if (appliedCoupon && discountAmount > 0) {
                            $("#total_old").show().text(money(grand));
                        } else {
                            $("#total_old").hide().text(money(0));
                        }

                        $("#total").text(money(payableTotal));
                    }
                    function clearCouponUI() {
                        appliedCoupon = null;
                        discountAmount = 0;

                        $("#couponAppliedBox").hide();
                        $("#couponAppliedText").text("");
                        $("#couponCodeInput").val("");

                        renderTotalsWithCoupon();
                    }
                    function showAppliedCouponUI(coupon) {
                        const type = String(coupon.discount_type || "").toLowerCase();
                        const val  = Number(coupon.discount_value || 0);

                        const pretty = (type === "percentage") ? `${val}% OFF` : `₹${val} OFF`;
                        $("#couponAppliedText").text(`Applied: ${coupon.coupon_code} (${pretty})`);
                        $("#couponAppliedBox").show();
                    }
                    function getAppliedCouponCode() {
                        return appliedCoupon?.coupon_code ? String(appliedCoupon.coupon_code).trim().toUpperCase() : null;
                    }
                    $("#couponForm").on("submit", function (e) {
                        e.preventDefault();

                        if (!couponUse) {
                            Swal.fire("Coupon is not Available", "Try Without Coupon", "info");
                            return;
                        }
                        const authTokenNow = localStorage.getItem("auth_token");
                        if (!authTokenNow) {
                            Swal.fire({
                            icon: "info",
                            title: "Login required",
                            html: `Please login first to apply a coupon.`,
                            showCancelButton: true,
                            confirmButtonText: "Login",
                            cancelButtonText: "Cancel"
                            }).then((r) => {
                            if (r.isConfirmed) window.location.href = "login.php?redirect=checkout.php";
                            });
                            return;
                        }
                        const code = String($("#couponCodeInput").val() || "").trim().toUpperCase();
                        if (!code) return;

                        $("#applyCouponBtn").prop("disabled", true).text("Applying...");

                            fetch(COUPON_CHECK_URL, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "Authorization": `Bearer ${authTokenNow}`
                                },
                                body: JSON.stringify({ coupon_code: code })
                            })
                            .then(r => r.json())
                            .then(res => {
                                const msg = String(res?.message || "");
                                const msgL = msg.toLowerCase();

                                // ✅ VALID
                                if (res?.success && res?.code === 200 && res?.data) {
                                appliedCoupon = res.data;
                                showAppliedCouponUI(appliedCoupon);
                                renderTotalsWithCoupon();
                                return;
                                }

                                // ❌ INVALID flows
                                if (msgL.includes("inactive") || msgL.includes("not found")) {
                                Swal.fire("Invalid coupon", "Coupon is invalid or inactive.", "error");
                                clearCouponUI();
                                return;
                                }

                                if (msgL.includes("expired")) {
                                Swal.fire("Coupon expired", msg || "Coupon expired.", "warning");
                                clearCouponUI();
                                return;
                                }

                                if (msgL.includes("usage limit reached")) {
                                Swal.fire("Limit reached", msg || "Coupon usage limit reached.", "warning");
                                clearCouponUI();
                                return;
                                }

                                Swal.fire("Invalid coupon", msg || "Unable to apply coupon.", "error");
                                clearCouponUI();
                            })
                            .catch(err => {
                                console.error(err);
                                Swal.fire("Error", "Coupon check failed. Please try again.", "error");
                                clearCouponUI();
                            })
                            .finally(() => {
                                $("#applyCouponBtn").prop("disabled", false).text("Apply Coupon");
                            });
                        });

                        $("#removeCouponLink").on("click", function () {
                            if (!couponUse) return;
                            clearCouponUI();
                        });


                    let cartTotalWeight = 0;
                    let cartItemsTotal = 0;
                    let currentShippingCharge = 0;

                    // ✅ TEMP: disable shipping calculation (keep code, just bypass)
                    const SHIPPING_API_ENABLED = false;
                    
                    function getSelectedPinCode() {
                        let selectedRadio = $("input[name='address_select']:checked").closest(".address-card");
                        if (selectedRadio.length === 0) return "";

                        let postalCode = selectedRadio.find(".card-body p:contains('Postal Code')").text()
                            .replace("Postal Code:", "")
                            .trim();

                        return postalCode || "";
                    }

                    function updateShippingCostFromApi() {

                        // ✅ TEMP: force free shipping (0) and skip API call
                        if (!SHIPPING_API_ENABLED) {
                            currentShippingCharge = 0;

                            $(".order-shipping td .form-group-custom-control").html(`
                                <div class="custom-control custom-radio d-flex">
                                    <input type="radio" class="custom-control-input" name="radio" checked />
                                    <label class="custom-control-label">Free Shipping</label>
                                </div>
                            `);

                            // Total = items total only
                            // $("#total").text(`₹ ${Number(cartItemsTotal || 0).toLocaleString(undefined, {
                            //     minimumFractionDigits: 2,
                            //     maximumFractionDigits: 2
                            // })}`);
                            renderTotalsWithCoupon(); // ✅ keeps shipping=0, applies coupon if any

                            return; // ✅ stop here, don’t hit shipping API
                        }

                        const originPin = getSelectedPinCode();

                        // If no address selected yet
                        if (!originPin) {
                            $(".order-shipping td .form-group-custom-control").html(`
                                <div class="custom-control custom-radio d-flex">
                                    <input type="radio" class="custom-control-input" name="radio" checked />
                                    <label class="custom-control-label">Select address to calculate shipping</label>
                                </div>
                            `);

                            // Total = items total only (until shipping comes)
                            // $("#total").text(`₹ ${cartItemsTotal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`);
                            renderTotalsWithCoupon();
                            return;
                        }

                        // weight from cart fetch response (2 decimals)
                        const weight2 = Number(cartTotalWeight || 0).toFixed(2);

                        const payload = {
                            through: "simple",
                            origin_pin: originPin,
                            destination_pin: "700001",
                            weight: parseFloat(weight2),    // keep numeric, 2-dec
                            cod_amount: 0,
                            payment_type: "Pre-paid"         // as you said: prepaid
                        };

                        $.ajax({
                            url: shippingUrl,
                            type: "POST",
                            headers: authToken ? { "Authorization": `Bearer ${authToken}` } : {}, 
                            contentType: "application/json",
                            data: JSON.stringify(payload),
                            success: function (res) {

                                // ✅ Extract cost from your response shape
                                let cost = 0;

                                if (res && Array.isArray(res.data) && res.data.length > 0) {
                                    cost = res.data[0].total_amount;     // ✅ this is the correct field
                                } else if (res?.data?.total_amount) {
                                    cost = res.data.total_amount;        // fallback if backend changes to object
                                }

                                cost = Number(cost) || 0;
                                currentShippingCharge = cost;

                                // ✅ always show 2 decimals
                                const costDisplay = cost.toFixed(2);

                                // Update Shipping UI
                                if (cost <= 0) {
                                    $(".order-shipping td .form-group-custom-control").html(`
                                        <div class="custom-control custom-radio d-flex">
                                            <input type="radio" class="custom-control-input" name="radio" checked />
                                            <label class="custom-control-label">Free Shipping</label>
                                        </div>
                                    `);
                                } else {
                                    $(".order-shipping td .form-group-custom-control").html(`
                                        <div class="custom-control custom-radio d-flex">
                                            <input type="radio" class="custom-control-input" name="radio" checked />
                                            <label class="custom-control-label">Shipping Charges ₹${costDisplay}</label>
                                        </div>
                                    `);
                                }

                                // ✅ Total = items total + shipping
                                // const grandTotal = Number(cartItemsTotal) + Number(cost);
                                // $("#total").text(`₹ ${grandTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`);
                                renderTotalsWithCoupon();
                            },
                            error: function () {
                                console.error("Error fetching shipping cost.");

                                // fallback UI
                                $(".order-shipping td .form-group-custom-control").html(`
                                    <div class="custom-control custom-radio d-flex">
                                        <input type="radio" class="custom-control-input" name="radio" checked />
                                        <label class="custom-control-label">Unable to calculate shipping</label>
                                    </div>
                                `);

                                // keep total as items total only
                                // $("#total").text(`₹ ${cartItemsTotal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`);
                                renderTotalsWithCoupon();
                            }
                        });
                    }
                    // ✅ when user selects an address => recalc shipping
                    $(document).on("change", "input[name='address_select']", function () {
                        updateShippingCostFromApi();
                    });

                    function fetchCartItems() {
                        const authToken = localStorage.getItem('auth_token');
                        const authTemp = localStorage.getItem('temp_id');
                        const cartUrl = "<?php echo BASE_URL; ?>/cart/fetch";

                        const ajaxOptions = {
                            url: cartUrl,
                            type: "POST",
                            contentType: "application/json",
                            success: function (response) {
                                if (response.data.length > 0) {
                                    let cartHTML = "";
                                    let subtotal = 0;
                                    let totalTax = 0;
                                    let total = 0;
                                    const GST_RATE = 0.18; // 18% GST

                                    response.data.forEach(item => {                                        
                                        const quantity = item.quantity;

                                        // Remove commas from price string before parsing
                                        const fullPrice = parseFloat(item.selling_price.replace(/,/g, '')); // inclusive of tax

                                        // Calculate base price and tax per unit
                                        const basePrice = fullPrice / (1 + GST_RATE);
                                        const tax = fullPrice - basePrice;

                                        // Totals for this line item
                                        const itemBaseTotal = basePrice * quantity;
                                        const itemTaxTotal = tax * quantity;
                                        const itemTotal = fullPrice * quantity;

                                        // Add to overall totals
                                        subtotal += itemBaseTotal;
                                        totalTax += itemTaxTotal;
                                        total += itemTotal;

                                        // Build HTML for cart
                                        cartHTML += `
                                            <tr>
                                                <td class="product-col">
                                                    <h3 class="product-title">
                                                        ${item.product_name} - ${item.variant_value} × <span class="product-qty">${quantity}</span>
                                                    </h3>
                                                </td>
                                                <td class="price-col">
                                                    <span>₹ ${itemTotal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>
                                                </td>
                                            </tr>
                                        `;
                                    });
                                    // ✅ store cart totals for shipping calculation (after total is calculated)
                                    cartItemsTotal = Number(total) || 0;
                                    renderTotalsWithCoupon(); // ✅ total reflects coupon even before shipping update runs

                                    // ✅ total weight from API (best)
                                    cartTotalWeight = Number(response.total_weight ?? response.totalWeight ?? response.totalWeightKg ?? 0) || 0;

                                    // ✅ fallback: if item has weight fields (only if your API returns it)
                                    if (!cartTotalWeight && Array.isArray(response.data)) {
                                        cartTotalWeight = response.data.reduce((sum, it) => {
                                            const w = Number(it.weight || it.total_weight || it.weight_kg || 0) || 0;
                                            const q = Number(it.quantity || 1) || 1;
                                            return sum + (w * q);
                                        }, 0);
                                    }

                                    // ✅ keep 2 decimals
                                    cartTotalWeight = Number(cartTotalWeight.toFixed(2));

                                    // Shipping Logic (must match backend)
                                    let shippingCharge = 0;
                                    let shippingHTML = "";

                                    if (total > 5000) {
                                        shippingCharge = 0;
                                        shippingHTML = `
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="radio" checked />
                                                <label class="custom-control-label">Free Shipping</label>
                                            </div>
                                        `;
                                    } else {
                                        shippingCharge = 0;
                                        total += shippingCharge;
                                        shippingHTML = `
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="radio" checked />
                                                <label class="custom-control-label">Shipping Charges ₹${shippingCharge.toFixed(2)}</label>
                                            </div>
                                        `;
                                    }


                                    // Render to DOM
                                    $("#cart-items").html(cartHTML);
                                    $("#subtotal").text(`₹ ${subtotal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`);
                                    $("#total-tax").text(`₹ ${totalTax.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`);
                                    // $("#total").text(`₹ ${total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`);
                                    // ✅ Set base amount (items total) and let renderTotalsWithCoupon() decide final total
                                    cartItemsTotal = Number(total) || 0;
                                    renderTotalsWithCoupon();
                                    $(".order-shipping td .form-group-custom-control").html(shippingHTML);
                                    // ✅ override the old shipping UI with API shipping
                                    updateShippingCostFromApi();
                                } else {
                                    cartTotalWeight = 0;
                                    cartItemsTotal = 0;
                                    currentShippingCharge = 0;
                                    // Empty cart
                                    $("#cart-items").html("<tr><td colspan='2'>No items in cart.</td></tr>");
                                    $("#subtotal").text("₹ 0.00");
                                    $("#total-tax").text("₹ 0.00");
                                    $("#total").text("₹ 0.00");
                                    $(".order-shipping td .form-group-custom-control").html(`
                                        <div class="custom-control custom-radio d-flex">
                                            <input type="radio" class="custom-control-input" name="radio" checked />
                                            <label class="custom-control-label">Free Shipping</label>
                                        </div>
                                    `);
                                }
                            },
                            error: function () {
                                console.error("Error fetching cart items.");
                            }
                        };

                        // Determine how to send credentials
                        if (authToken) {
                            ajaxOptions.headers = { "Authorization": `Bearer ${authToken}` };
                            ajaxOptions.data = JSON.stringify({});
                        } else if (authTemp) {
                            ajaxOptions.data = JSON.stringify({ cart_id: authTemp });
                        } else {
                            $("#cart-items").html("<tr><td colspan='2'>No items in cart.</td></tr>");
                            $("#subtotal").text("₹ 0.00");
                            $("#total-tax").text("₹ 0.00");
                            $("#total").text("₹ 0.00");
                            $(".order-shipping td .form-group-custom-control").html(`
                                <div class="custom-control custom-radio d-flex">
                                    <input type="radio" class="custom-control-input" name="radio" checked />
                                    <label class="custom-control-label">Free Shipping</label>
                                </div>
                            `);
                            return;
                        }

                        $.ajax(ajaxOptions);
                    }

                    function getSelectedAddress() {
                      let selectedRadio = $("input[name='address_select']:checked").closest(".address-card");

                      if (selectedRadio.length === 0) {
                        alert("Please select a shipping address.");
                        return null;
                      }

                      let name = selectedRadio.find(".card-header h3").text().trim();
                      let contactNo = selectedRadio.find(".card-header .card-phone").text().trim();
                      let address1 = selectedRadio.find(".card-body p:contains('Address 1')").text()
                        .replace("Address 1:", "")
                        .trim();

                      // Raw add2
                      let address2Raw = selectedRadio.find(".card-body p:contains('Address 2')").text()
                        .replace("Address 2:", "")
                        .trim();

                      // Clean + check add2 ("" / " " / "NA" / "na" etc. → treat as empty)
                      let address2 = address2Raw;
                      let address2Upper = address2Raw.toUpperCase();
                      let hasAddress2 = address2 && address2Upper !== "NA";

                      // Extract Location (Country, State, City)
                      let locationText = selectedRadio.find(".card-body p:contains('Location')").text()
                        .replace("Location:", "")
                        .trim();

                      let locationParts = locationText.split(",").map(item => item.trim());

                      let country = locationParts[0] || "";
                      let state   = locationParts[1] || "";
                      let city    = locationParts[2] || "";

                      let postalCode = selectedRadio.find(".card-body p:contains('Postal Code')").text()
                        .replace("Postal Code:", "")
                        .trim();

                      // 🔹 New required format:
                      // name, mobile, city, state, country, pin, add1, add2(if valid)
                      let shippingAddress = `${name}, ${contactNo}, ${city}, ${state}, ${country}, ${postalCode}, ${address1}`;

                      if (hasAddress2) {
                        shippingAddress += `, ${address2}`;
                      }

                      return shippingAddress;
                    }

                    $("#placeOrderBtn").click(function (event) {
                        event.preventDefault();

                        let shippingAddress = getSelectedAddress();
                        if (!shippingAddress) return;
                        // ✅ Ensure shipping charge is numeric + 2 decimals
                        const shippingCharge = Number(currentShippingCharge || 0);

                        let orderData = {
                            status: "pending",
                            payment_status: "pending",
                            shipping_address: shippingAddress,
                            shipping_charge: Number(shippingCharge.toFixed(2)) // ✅ send to API
                        };
                        // ✅ send coupon only when coupon feature enabled and coupon applied
                        if (couponUse) {
                            const couponCode = getAppliedCouponCode();
                            if (couponCode) orderData.coupon_code = couponCode;
                        }

                        $.ajax({
                            url: orderUrl,
                            type: "POST",
                            headers: {
                                "Authorization": `Bearer ${authToken}`,
                                "Content-Type": "application/json"
                            },
                            data: JSON.stringify(orderData),
                            success: function (response) {
                                if (response.message.includes("success")) {
                                    let orderDetails = response.data.data;

                                    let orderId = orderDetails.order_id;
                                    let razorpayOrderId = orderDetails.razorpay_order_id;
                                    let totalAmount = orderDetails.total_amount;
                                    let userName = orderDetails.name;
                                    let userEmail = orderDetails.email;
                                    let userPhone = orderDetails.phone;
                                    let userId = orderDetails.user_id;

                                    // ✅ Start Razorpay
                                    openRazorpayPopup(razorpayOrderId, totalAmount, orderId, userId, userName, userEmail, userPhone, shippingAddress);
                                } else {
                                    alert("Failed to place order. Please try again.");
                                }
                            },
                            error: function () {
                                alert("Failed to place order. Please try again.");
                            }
                        });
                    });

                    // Check if user_role in localStorage is 'vendor'
                    if (localStorage.getItem("user_role") === "vendor") {
                        $("#get_quotation").show();
                    } else {
                        $("#get_quotation").hide();
                    }

                    // Quotation button click event
                    $("#get_quotation").click(function(event) {
                        event.preventDefault();

                        let shippingAddress = getSelectedAddress();
                        if (!shippingAddress) return;

                        let quoteData = {
                            status: "pending",
                            payment_status: "pending",
                            shipping_address: shippingAddress
                        };

                        $.ajax({
                            url: "<?php echo BASE_URL; ?>/quotation",
                            type: "POST",
                            headers: {
                                "Authorization": `Bearer ${authToken}`,
                                "Content-Type": "application/json"
                            },
                            data: JSON.stringify(quoteData),
                            success: function(response) {
                                // Check if the message indicates success
                                if (response.data && response.data.message && response.data.message.includes("Quotation created successfully")) {
                                    // Access the actual quotation data
                                    let quotationData = response.data.data;  // Accessing the nested 'data' field

                                    // Build query parameters from the returned data
                                    let params = new URLSearchParams();
                                    for (let key in quotationData) {
                                        if (quotationData.hasOwnProperty(key)) {
                                            params.append(key, quotationData[key]);
                                        }
                                    }

                                    // Redirect to the quotation page with all data passed as query parameters
                                    window.location.href = "quotation.php?" + params.toString();
                                } else {
                                    // If quotation creation fails, show error
                                    Swal.fire("Error", "Failed to create quotation. Please try again.", "error");
                                }
                            },
                            error: function() {
                                Swal.fire("Error", "Failed to get quotation. Please try again.", "error");
                            }
                        });
                    });

                    function openRazorpayPopup(order_id, amount, orderId, userId, name, email, phone, shippingAddress) {
                        const amountNumber = parseFloat(amount);
                        if (isNaN(amountNumber) || amountNumber <= 0) {
                            alert("Something went wrong with the order amount. Please try again.");
                            return;
                        }
                        const amountPaise = Math.round(amountNumber * 100);

                        var options = {
                            key: "rzp_live_OYEz8EFvKlVIEq",
                            amount: amountPaise,
                            currency: "INR",
                            name: "HANERI ELECTRICALS LLP",
                            description: `Order ID: ${orderId}`,
                            image: "https://haneri.com/images/Haneri_Favicon.jpg",
                            order_id: order_id,

                            // 🔴 REMOVE this:
                            // handler: function (response) { ... },

                            // ✅ ADD this instead:
                            callback_url: "<?php echo BASE_URL; ?>/razorpay/callback?order_id=" 
                                        + encodeURIComponent(orderId)
                                        + "&shipping_address=" 
                                        + encodeURIComponent(shippingAddress),

                            redirect: true, // important
                            // ✅ ADD THIS
                            modal: {
                                ondismiss: function () {
                                    window.location.href =
                                        "order-complete.php"
                                        + "?status=pending"
                                        + "&method=Razorpay"
                                        + "&payment_id=" + encodeURIComponent("N/A")
                                        + "&amount=" + encodeURIComponent(amountNumber)
                                        + "&order_id=" + encodeURIComponent(orderId)
                                        + "&shipping_address=" + encodeURIComponent(shippingAddress);
                                }
                            },
                            prefill: {
                                name: name,
                                email: email,
                                contact: phone
                            },
                            theme: {
                                color: "#f0f8fe"
                            }
                        };

                        var rzp = new Razorpay(options);

                        // You can keep payment.failed if you want an immediate redirect on explicit failure:
                        rzp.on("payment.failed", function (response) {
                            console.error("Razorpay payment failed:", response);

                            // Show user the real reason (for now, for debugging)
                            const desc =
                                response?.error?.description ||
                                response?.error?.reason ||
                                response?.error?.code ||
                                "Unknown error";
                            alert("Payment failed: " + desc);

                            // Redirect to failed page with real info
                            window.location.href =
                                "order-complete.php"
                                + "?status=failed"
                                + "&method=Razorpay"
                                + "&payment_id=" + encodeURIComponent(
                                    response?.error?.metadata?.payment_id || "N/A"
                                )
                                + "&amount=" + encodeURIComponent(amountNumber)
                                + "&order_id=" + encodeURIComponent(orderId)
                                + "&error_code=" + encodeURIComponent(response?.error?.code || "")
                                + "&error_desc=" + encodeURIComponent(desc)
                                + "&shipping_address=" + encodeURIComponent(shippingAddress);
                        });


                        try {
                            rzp.open();
                        } catch (e) {
                            console.error("Error while opening Razorpay:", e);
                            alert("Could not open payment window. Please try again.");
                        }
                    }

                    function processPayment(paymentId, orderId, razorpayOrderId, amount, userId, shippingAddress) {
                        // 1) Save payment in your /payments API
                        let paymentData = {
                            method: "upi",
                            razorpay_payment_id: paymentId,
                            amount: amount,
                            status: "paid",              // ✅ match your backend: 'pending', 'paid', 'failed', 'refunded'
                            order_id: orderId,
                            razorpay_order_id: razorpayOrderId,
                            user_id: userId
                        };

                        $.ajax({
                            url: `<?php echo BASE_URL; ?>/payments`,
                            type: "POST",
                            headers: {
                                "Authorization": `Bearer ${authToken}`,
                                "Content-Type": "application/json"
                            },
                            data: JSON.stringify(paymentData),
                            success: function (response) {
                                if (response.message.includes("success")) {
                                    let paymentDetails = response.data;

                                    // 2) Immediately update order payment_status => 'paid'
                                    $.ajax({
                                        url: `<?php echo BASE_URL; ?>/orders/${orderId}/update-status`,
                                        type: "POST",
                                        headers: {
                                            "Authorization": `Bearer ${authToken}`,
                                            "Content-Type": "application/json"
                                        },
                                        data: JSON.stringify({
                                            payment_status: "paid"      // 👈 as per your API
                                        }),
                                        success: function (updateRes) {
                                            // Optional: you can check updateRes.success here
                                            // 3) Finally redirect to order-complete page
                                            window.location.href = `order-complete.php?status=success`
                                                + `&method=${encodeURIComponent(paymentDetails.method)}`
                                                + `&payment_id=${encodeURIComponent(paymentDetails.razorpay_payment_id)}`
                                                + `&amount=${encodeURIComponent(paymentDetails.amount)}`
                                                + `&order_id=${encodeURIComponent(paymentDetails.order_id)}`;
                                        },
                                        error: function () {
                                            // If update-status fails, still redirect (so user doesn't get stuck)
                                            console.warn("Failed to update order payment_status, but payment is saved.");
                                            window.location.href = `order-complete.php?status=success`
                                                + `&method=${encodeURIComponent(paymentDetails.method)}`
                                                + `&payment_id=${encodeURIComponent(paymentDetails.razorpay_payment_id)}`
                                                + `&amount=${encodeURIComponent(paymentDetails.amount)}`
                                                + `&order_id=${encodeURIComponent(paymentDetails.order_id)}`;
                                        }
                                    });

                                } else {
                                    alert("Payment processing failed. Please contact support.");
                                }
                            },
                            error: function () {
                                alert("Payment processing failed. Please contact support.");
                            }
                        });
                    }

                    fetchCartItems(); // Load cart items on page load
                });
            </script>
            <!-- Order Summary Section -->
            <div class="col-lg-4">
                <div class="order-summary">
                    <h3>YOUR ORDER</h3>

                    <table class="table table-mini-cart">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- Cart items will be inserted here dynamically -->
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <td><h4>Subtotal</h4></td>
                                <td class="price-col"><span id="subtotal">₹ 0.00</span></td>
                            </tr>

                            <tr class="cart-tax">
                                <td><h4>Tax</h4></td>
                                <td class="price-col"><span id="total-tax">₹ 0.00</span></td>
                            </tr>

                            <tr class="order-total">
                                <td><h4>Total</h4></td>
                                <td>
                                    <b class="total-price">
                                    <!-- Old total (cross) -->
                                    <span id="total_old" style="display:none; text-decoration: line-through; opacity:.65;font-weight: 500;">
                                        ₹ 0.00
                                    </span>
                                    <br>
                                    <!-- Final payable total -->
                                    <span id="total">₹ 0.00</span>
                                    </b>
                                </td>
                            </tr>
                            <tr class="order-discount" id="discountRow" style="display:none; ">
                                <td><h4 style="color: red;">Discount</h4></td>
                                <td class="price-col"><span id="discountAmount" style="color: red;">₹ 0.00</span></td>
                            </tr>
                            <tr class="order-shipping">
                                <td>
                                    <h4 class="m-b-sm">Shipping</h4>                                    
                                </td>
                                <td>
                                    <div class="form-group m-0 form-group-custom-control">
                                        <div class="custom-control custom-radio d-flex">
                                            <input type="radio" class="custom-control-input" name="radio" checked />
                                            <label class="custom-control-label">Free Shipping</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <style>
                        @media (max-width: 479px) {
                            .cart-discount .input-group {
                                flex-direction: row !important;
                            }
                            .checkout-container .form-control, .checkout-container select.form-control:not([size]):not([multiple]) {
                                height: 100% !important;
                            }
                        }
                        .apply_coupon{
                            padding: 1rem 0rem;
                            border-bottom: 0px solid #e7e7e7 !important;
                        }
                        .cart-discount {
                            margin-bottom: 0rem !important;
                        }
                        .cart-discount form {
                            margin-bottom: 0px !important;
                            max-width: 100% !important;
                        }
                        .payment-methods {
                            padding: 1rem 0em !important;
                            border-bottom: 0px solid #e7e7e7 !important;
                            margin-bottom: 2.6rem !important;
                        }
                        .payment-option {
                            transition: box-shadow 0.2s ease, border-color 0.2s ease;
                            background: #fff;
                            border: 1px solid #e8e8e8 !important;
                            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
                        }
                        .payment-option:hover {
                            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
                            border-color: #ddd !important;
                        }
                        .razorpay-logo-wrap {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            width: 120px;
                            height: 44px;
                            padding: 8px 12px;
                            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                            border-radius: 10px;
                            border: 1px solid #e2e8f0;
                            overflow: hidden;
                        }
                        .razorpay-logo-wrap img {
                            width: auto;
                            height: 100%;
                            max-width: 100%;
                            object-fit: contain;
                        }
                        .razorpay-label {
                            display: flex;
                            flex-direction: column;
                            gap: 2px;
                        }
                        .razorpay-tagline {
                            font-size: 0.8rem;
                            font-weight: 400;
                            color: #64748b;
                        }
                    </style>
                    <div class="apply_coupon">
                        <div class="float-rights">
                            <div class="cart-discount">
                            <form id="couponForm" action="#">
                                <div class="input-group">
                                <input
                                    id="couponCodeInput"
                                    type="text"
                                    class="form-control form-control-sm"
                                    placeholder="Coupon Code"
                                    autocomplete="off"
                                    style="text-transform:uppercase;"
                                    required
                                >
                                <div class="input-group-append">
                                    <button id="applyCouponBtn" class="btn btn-sm" type="submit">Apply Coupon</button>
                                </div>
                                </div>

                                <!-- Applied coupon info -->
                                <div id="couponAppliedBox" style="display:none; margin-top:8px; font-size:13px;">
                                <span id="couponAppliedText" style="font-weight:600;"></span>
                                <a href="javascript:void(0)" id="removeCouponLink" style="margin-left:10px; text-decoration:underline;">Remove</a>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="payment-methods">
                        <h4 class="mb-1">Payment Methods</h4>
                        <div class="payment-option rounded p-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="razorpay-label">
                                <span class="fw-bold fs-6 text-dark">Razorpay</span>
                                <span class="razorpay-tagline">UPI, Cards, Netbanking & more</span>
                            </div>
                            <div class="razorpay-logo-wrap">
                                <img src="assets/images/payments/razorpay.png" alt="Razorpay" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-place-order" id="placeOrderBtn">
                        Place order
                    </button>
                    <button type="submit" class="btn btn-dark btn-get-quotation" id="get_quotation">
                        Get Quotation
                    </button>
                </div>
            </div>
            <!-- End .col-lg-4 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->
</main>
<!-- End .main -->
<style>
    @media (max-width: 520px) {
        #swal-address-form {
            display: grid;
            grid-template-columns: repeat(1, 1fr) !important;
            gap: 5px !important;
        }
        .swal2-container .swal2-popup {
            padding: 10px;
            top: -25px !important;
        }
        .swal2-actions {
            justify-content: flex-end;
            margin-top: 0px !important;
        }
    }
</style>


<div id="otp-code-overlay" class="otp-overlay">
  <div class="otp-modal">
    <h4>Enter OTP</h4>
    <p>We have sent a 6-digit code to your mobile number.</p>
    <p id="otp-mobile-display" class="otp-mobile-display-text"></p>
    <span id="otp-change-link" class="otp-change-link">Change number</span>

    <div class="otp-input-wrapper">
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
    </div>

    <p id="otp-code-error" style="display:none; margin-top:8px; font-size:13px; color:red;"></p>

    <div class="otp-actions">
      <button type="button" id="otp-code-resend" class="otp-link-btn">
        Resend OTP
      </button>
      <button type="button" id="otp-code-submit" class="btn btn-sm otp-primary-btn">
        Verify
      </button>
    </div>
  </div>
</div>

<!-- Otp css -->
<style>
  :root {
    --primary-green: #00473E;
    --login-font: "Open Sans", sans-serif;
  }

  .otp-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.4);
    z-index: 9999;
    justify-content: center;
    align-items: center;
  }
  .otp-modal {
    background: #fff;
    padding: 22px 24px;
    border-radius: 14px;
    max-width: 450px;
    width: 90%;
    box-shadow: 0 18px 40px rgba(0,0,0,0.25);
    border-top: 4px solid var(--primary-green);
  }
  .otp-modal h4 {
    margin-top: 0;
    margin-bottom: 6px;
    font-size: 18px;
    font-weight: 600;
    color: #222;
  }
  .otp-modal p {
    margin-bottom: 8px;
    font-size: 14px;
    color: #555;
  }
  .otp-actions {
    margin-top: 16px;
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    align-items: center;
  }

  .otp-input-wrapper {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 10px;
  }
  .otp-input {
    width: 40px;
    height: 45px;
    font-size: 20px;
    text-align: center;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
    font-family: var(--login-font);
    transition: 0.15s;
    letter-spacing: 0.12em;
  }
  .otp-input:focus {
    border-color: var(--primary-green);
    box-shadow: 0 0 0 1px #00473e1c;
  }

  .otp-link-btn {
    background: transparent;
    border: none;
    color: #555;
    font-size: 13px;
    text-decoration: underline;
    cursor: pointer;
    padding: 0;
  }

  .otp-primary-btn {
    background: var(--primary-green);
    border: 1px solid var(--primary-green);
    color: #fff;
    border-radius: 10px !important;
    padding: 10px 20px !important;
  }
  .otp-primary-btn:hover {
    background: #00352f;
    border-color: #00352f;
  }

  .otp-mobile-display-text {
    font-size: 13px;
    color: #777;
  }
  .otp-change-link {
    display: inline-block;
    margin-top: 2px;
    font-size: 12px;
    color: var(--primary-green);
    text-decoration: underline;
    cursor: pointer;
  }
</style>

<link rel="stylesheet" href="assets/css/style.min.css">
<?php include("footer.php"); ?>
