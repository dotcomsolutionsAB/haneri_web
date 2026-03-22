<?php require_once __DIR__ . '/configs/canonical_host.php'; ?>
<script>
(function () {
	try {
		// Magic login link: profile.php?token=YOUR_JWT#address (hash is not sent to server; use for tab)
		// Or: profile.php?token=YOUR_JWT&tab=address
		var url = new URL(window.location.href);
		var token = url.searchParams.get("token");
		if (token !== null && String(token).replace(/\s/g, "") !== "") {
			localStorage.setItem("auth_token", String(token).trim());
			url.searchParams.delete("token");
			var qs = url.searchParams.toString();
			window.history.replaceState({}, document.title, url.pathname + (qs ? "?" + qs : "") + url.hash);
		}
	} catch (e) {}

	if (!localStorage.getItem("auth_token")) {
		var back = "profile.php" + window.location.search + window.location.hash;
		window.location.replace("login.php?redirect=" + encodeURIComponent(back));
	}
})();
</script>


<?php include("header.php"); ?>
<?php include("configs/config.php"); ?> 
<style>
	.view-invoice{
		display: flex;
		gap: 4px;
		align-items: center;
		flex-direction: column;
		font-size: 0.8125rem;
		background: transparent;
		color: #005d5a;
		border: none;
	}
	.view-invoice i{
		font-size: 1.25rem;
	}
</style>
<main class="main profile_page">
	<div class="container account-container custom-account-container padding_top_100 haneri-account-wrap">
		<div class="row haneri-account-row">
			<div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0 haneri-account-sidebar">
				<div class="haneri-account-sidebar-inner">
				<div class="haneri-account-sidebar-head">
					<h2 class="haneri-account-sidebar-title">My account</h2>
					<p class="haneri-account-sidebar-sub">Manage orders, addresses &amp; profile</p>
				</div>
				<ul class="nav nav-tabs flex-column mb-0 haneri-account-nav" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
							role="tab" aria-controls="dashboard" aria-selected="true">
							<span class="haneri-account-nav-icon" aria-hidden="true"><i class="icon-home"></i></span>
							<span class="haneri-account-nav-label">Dashboard</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
							aria-controls="order" aria-selected="true">
							<span class="haneri-account-nav-icon" aria-hidden="true"><i class="icon-bag-2"></i></span>
							<span class="haneri-account-nav-label">Orders</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="quotation-tab" data-toggle="tab" href="#quotation" role="tab"
							aria-controls="quotation" aria-selected="true">
							<span class="haneri-account-nav-icon" aria-hidden="true"><i class="sicon-doc"></i></span>
							<span class="haneri-account-nav-label">Quotation</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
							aria-controls="address" aria-selected="false">
							<span class="haneri-account-nav-icon" aria-hidden="true"><i class="sicon-location-pin"></i></span>
							<span class="haneri-account-nav-label">Addresses</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
							aria-controls="edit" aria-selected="false">
							<span class="haneri-account-nav-icon" aria-hidden="true"><i class="icon-user-2"></i></span>
							<span class="haneri-account-nav-label">Account details</span>
						</a>
					</li>
					<li class="nav-item haneri-account-nav-logout">
						<a href="#" class="nav-link haneri-account-logout" id="logout-btn">
							<span class="haneri-account-nav-icon" aria-hidden="true"><i class="icon-lock"></i></span>
							<span class="haneri-account-nav-label">Log out</span>
						</a>
					</li>
				</ul>
				</div>
			</div>
			<div class="col-lg-9 order-lg-last order-1 tab-content tab_data haneri-account-main">
				<div class="tab-pane fade show active" id="dashboard" role="tabpanel">
					<div class="dashboard-content haneri-account-dashboard">
						<div class="haneri-account-welcome">
							<h6 class="haneri-account-welcome-title">
								Hello <strong class="haneri-account-user-name" id="user-name">..</strong>
							</h6>
							<p class="haneri-account-welcome-text">
							From your account dashboard you can view your
							<a class="btn btn-link alink link-to-tab haneri-account-inline-link" href="#order">recent orders</a>,
							manage your
							<a class="btn btn-link alink link-to-tab haneri-account-inline-link" href="#address">shipping and billing
								addresses</a>, and
							<a class="btn btn-link alink link-to-tab haneri-account-inline-link" href="#edit">edit your password and account
								details.</a>
							</p>
						</div>

						<div class="row row-lg haneri-account-quicklinks">
							<div class="col-6 col-md-4 d-flex">
								<a href="#order" class="link-to-tab feature-box text-center pb-4 haneri-account-tile w-100 d-flex flex-column align-items-center justify-content-center">
									<i class="sicon-social-dropbox haneri-account-tile-icon" aria-hidden="true"></i>
									<span class="feature-box-content">
										<span class="haneri-account-tile-title">Orders</span>
									</span>
								</a>
							</div>

							<div class="col-6 col-md-4 d-flex">
								<a href="#address" class="link-to-tab feature-box text-center pb-4 haneri-account-tile w-100 d-flex flex-column align-items-center justify-content-center">
									<i class="sicon-location-pin haneri-account-tile-icon" aria-hidden="true"></i>
									<span class="feature-box-content">
										<span class="haneri-account-tile-title">Addresses</span>
									</span>
								</a>
							</div>

							<div class="col-6 col-md-4 d-flex">
								<a href="#edit" class="link-to-tab feature-box text-center pb-4 haneri-account-tile w-100 d-flex flex-column align-items-center justify-content-center">
									<i class="icon-user-2 haneri-account-tile-icon" aria-hidden="true"></i>
									<span class="feature-box-content">
										<span class="haneri-account-tile-title">Account details</span>
									</span>
								</a>
							</div>

						</div><!-- End .row -->
					</div>
				</div><!-- End .tab-pane -->

				<style>
					.profile_page .table-order tbody {
						display: block;
						max-height: 300px;
						overflow-y: auto;
					}
					.profile_page .table-order thead,
					.profile_page .table-order tbody tr {
						display: table;
						width: 100%;
						table-layout: fixed;
					}
					.profile_page .table-order td,
					.profile_page .table-order th {
						padding: 0.85rem 0.75rem;
						vertical-align: middle;
						border-top: 1px solid #dee2e6;
						text-align: center;
						font-size: 1rem;
					}
					.profile_page .table-order tbody tr .addressess {
						font-size: 0.9375rem;
						text-align: start;
					}
					@media (max-width: 520px) {
						.profile_page .order-table-container {
							overflow-x: auto;
							width: 100%;
						}
						.profile_page .table-order {
							min-width: 600px;
						}
						.profile_page .table-order thead {
							font-size: 0.9375rem;
						}
						.profile_page .table-order tbody {
							max-height: 200px;
						}
						.profile_page .table-order tbody tr .addressess {
							font-size: 0.875rem;
							text-align: left;
						}
						.profile_page .table-order td,
						.profile_page .table-order th {
							font-size: 0.9375rem;
							padding: 0.6rem 0.5rem;
						}
						.profile_page .table-order .btn.btn-dark {
							font-size: 1rem;
							padding: 0.65rem 1rem;
						}
					}
				</style>
				<!-- Orders Showing For each Profile -->
				<div class="tab-pane fade" id="order" role="tabpanel">
					<div class="order-content">
						<h3 class="account-sub-title haneri-account-section-title">
							<i class="sicon-social-dropbox align-middle mr-3"></i>Orders
						</h3>
						<div class="order-table-container text-center haneri-account-table-card">
							<table class="table table-order text-left">
								<thead>
									<tr>
										<th class="order-id">ORDER</th>
										<th class="order-date">BILLING</th>
										<th class="order-status">STATUS</th>
										<th class="order-payment-status">PAYMENT</th>
										<th class="order-price">TOTAL</th>
										<th class="order-action text-left">ACTIONS</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
							<hr class="mt-0 mb-3 pb-2" />
						</div>
						<!-- <a href="shop.php" class="btn btn-dark">Go Shop</a> -->
					</div>
				</div>
				<!--Orders Fetch Script -->
				<script>
					document.addEventListener("DOMContentLoaded", function () {
						const authToken = localStorage.getItem("auth_token");
						if (!authToken) {
							console.log("User not logged in.");
							return;
						}

						fetch("<?php echo BASE_URL; ?>/orders", {
						// fetch("<?php // echo rtrim(BASE_URL, '/api'); ?>/orders", {
							method: "GET",
							headers: {
								"Content-Type": "application/json",
								"Authorization": `Bearer ${authToken}`
							}
						})
						.then(response => response.json())
						.then(responseData => {
							console.log("API Response:", responseData); // Debugging - Check API response in Console

							// Extract actual orders from responseData
							const orders = responseData.data; // Now correctly accessing the orders array
							const tableBody = document.querySelector(".table-order tbody");
							tableBody.innerHTML = ""; // Clear table content

							if (!Array.isArray(orders) || orders.length === 0) {
								console.log("No orders found.");
								tableBody.innerHTML = `<tr><td colspan="6" class="text-center haneri-account-empty">No orders yet</td></tr>`;
								return;
							}

							orders.forEach(order => {
								const orderId = order.items.length > 0 ? order.items[0].order_id : "N/A"; 
								// const orderDate = new Date().toLocaleDateString(); 
								const orderStatus = order.status || "Pending";
								const orderPaymentStatus = order.payment_status || "Pending";
								const orderBill = order.shipping_address || "NA";
								const totalAmount = `₹${order.total_amount || '0.00'}`;
								const invoiceURL = order?.invoice?.url || null;
								// Debugging
								// console.log(`Order ID: ${orderId}, Total: ${totalAmount}`);

								tableBody.innerHTML += `
									<tr>
										<td class="text-center">#${orderId}</td>
										<td class="addressess">${orderBill}</td>
										<td class="text-center">${orderStatus}</td>
										<td class="text-center">${orderPaymentStatus}</td>
										<td class="text-center">${totalAmount}</td>
										<td class="text-center">
											${invoiceURL 
												? `<button class="btn btn-success view-invoice" data-url="${invoiceURL}">
														<i class="fa fa-download"></i> Download
												</button>` 
												: ``
											}
										</td>
									</tr>
								`;
							});
						})
						.catch(error => {
							console.error("Error fetching orders:", error);
						});

					});
				</script>

				<!-- Quotation Showing For each Profile -->
				<div class="tab-pane fade" id="quotation" role="tabpanel">
					<div class="quotation-content">
						<h3 class="account-sub-title haneri-account-section-title">
							<i class="sicon-doc align-middle mr-3"></i>Quotation
						</h3>
						<div class="quotation-table-container text-center haneri-account-table-card">
							<table class="table table-quotation text-left">
								<thead>
									<tr>
										<th class="quotation-id">##</th>
										<th class="quotation-status">QUOTE-NO</th>
										<th class="quotation-date">USER</th>										
										<th class="quotation-price">TOTAL</th>
										<th class="quotation-action">QUOTATION</th>										
										<th class="quotation-buy">BUY</th>
										<th class="quotation-action">ACTION</th>
									</tr>
								</thead>
								<tbody>
									<!--  -->
								</tbody>
							</table>
							<hr class="mt-0 mb-3 pb-2" />
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="address" role="tabpanel">
					<h3 class="account-sub-title haneri-account-section-title mb-1">
						<i class="sicon-location-pin align-middle mr-3"></i>Addresses</h3>
					<div class="addresses-content haneri-account-addresses">
						<!-- <p class="mb-4">
							The following addresses will be used on the checkout page by
							default.
						</p> -->

						<div class="row haneri-account-address-row">
							<div class="col-12 haneri-account-address-col address">
								<div class="heading d-flex mb-2">
									<h4 class="text-dark mb-0 haneri-account-address-heading">Billing address</h4>
								</div>

								<div class="address-box haneri-account-address-empty-msg mb-3">
									You have not set up this type of address yet.
								</div>

								<a class="btn address-action haneri-account-btn-primary haneri-account-add-address-btn d-inline-flex align-items-center" href="javascript:void(0);" onclick="openAddAddressForm()">
									Add Address
								</a>
								<!-- Fetch Address Card — same column so left edge matches heading & button -->
								<div id="addressList" class="add-List haneri-account-address-list mt-4"></div>
							</div>
						</div>
						<!-- Fetch & Create Address Script -->
						<script>
							let allAddresses = []; // Store all addresses globally

							document.addEventListener("DOMContentLoaded", function () {
								const authToken = localStorage.getItem("auth_token");
								if (!authToken) {
									console.log("User not logged in.");
									return;
								}

								// Function to fetch and display all addresses
								function fetchAddresses() {
									fetch("<?php echo BASE_URL; ?>/address", {
										method: "GET",
										headers: {
											"Content-Type": "application/json",
											"Authorization": `Bearer ${authToken}`
										}
									})
									.then(response => response.json())
									.then(responseData => {
										console.log("Fetched Addresses:", responseData);

										allAddresses = responseData.data; // Store addresses globally

										const addresses = responseData.data;
										const addressContainer = document.getElementById("addressList"); 
										addressContainer.innerHTML = ""; 

										if (!Array.isArray(addresses) || addresses.length === 0) {
											addressContainer.innerHTML = `<p class="text-center">No Address Found</p>`;
											return;
										}

										addresses.forEach((address, index) => {
											const isChecked = address.is_default ? "checked" : ""; 
											const addressLine2HTML = address.address_line2 
													? `<p><strong>Address 2:</strong> ${address.address_line2}</p>` 
													: "";

											addressContainer.innerHTML += `
												<label class="address-card" for="addressRadio${index}">
													<div class="card-header">
														<h3 class="card-title">${address.name}</h3>
														<p class="card-phone">${address.contact_no}</p>
													</div>
													<div class="card-body">
														<p><strong>Address 1:</strong> ${address.address_line1}</p>
														${addressLine2HTML}
														<p><strong>Location:</strong> ${address.city}, ${address.state}, ${address.country}</p>
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
									})
									.catch(error => {
										console.error("Error fetching addresses:", error);
									});
								}
								// Fetch addresses on page load
								fetchAddresses();

								window.openAddAddressForm = function () {
									Swal.fire({
										title: 'Add New Address',
										width: '700px', // Wider popup
										customClass: {
											confirmButton: 'add-address-btn',
											cancelButton: 'cancel-address-btn'
										},
										html: `			
											<form id="swal-address-form">
												<input type="text" id="swal_name" placeholder="Name*" required>
												<input type="text" id="swal_contact_no" placeholder="Contact No*" required>
												<input type="text" id="swal_address_line1" placeholder="Address Line 1*" required>
												<input type="text" id="swal_address_line2" placeholder="Address Line 2 (optional)">
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
													<option value="India">India</option>
												</select>
												<input type="text" id="swal_postal_code" placeholder="Pincode*" required>
											</form>
										`,
										showCancelButton: true,
										confirmButtonText: 'Add Address',
										cancelButtonText: 'Cancel',
										focusConfirm: false,
										preConfirm: () => {
											const name = document.getElementById('swal_name').value.trim();
											const contact_no = document.getElementById('swal_contact_no').value.trim();
											const address_line1 = document.getElementById('swal_address_line1').value.trim();
											// const address_line2 = document.getElementById('swal_address_line2').value.trim();
											const address_line2_value = document.getElementById('swal_address_line2').value.trim();
											const address_line2 = address_line2_value !== "" ? address_line2_value : null;
											const city = document.getElementById('swal_city').value.trim();
											const state = document.getElementById('swal_state').value;
											const country = document.getElementById('swal_country').value;
											const postal_code = document.getElementById('swal_postal_code').value.trim();

											if (!name || !contact_no || !address_line1 || !city || !state || !country || !postal_code) {
												Swal.showValidationMessage('Please fill all required fields.');
												return false;
											}

											return {
												name,
												contact_no,
												address_line1,
												address_line2: address_line2,
												city,
												state,
												country,
												postal_code
											};
										}
									}).then((result) => {
										if (result.isConfirmed && result.value) {
											submitAddress(result.value);
										}
									});
								};

								function submitAddress(data) {
									const authToken = localStorage.getItem("auth_token");
									if (!authToken) {
										Swal.fire("Error", "User not logged in.", "error");
										return;
									}

									const addressData = {
										...data,
										is_default: true
									};

									Swal.fire({
										title: "Saving...",
										text: "Please wait",
										allowOutsideClick: false,
										didOpen: () => Swal.showLoading()
									});

									fetch("<?php echo BASE_URL; ?>/address/register", {
										method: "POST",
										headers: {
											"Content-Type": "application/json",
											"Authorization": `Bearer ${authToken}`
										},
										body: JSON.stringify(addressData)
									})
									.then(response => response.json())
									.then(responseData => {
										Swal.close();
										if (responseData.message && responseData.message.includes("success")) {
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
									.catch(error => {
										console.error("Error:", error);
										Swal.close();
										Swal.fire("Error", "Something went wrong. Please try again.", "error");
									});
								}
							});
						</script>
						<!-- Delete Address Script -->
						<script>
							function deleteAddress(addressId) {
								Swal.fire({
									title: "Are you sure?",
									text: "You won't be able to revert this!",
									icon: "warning",
									showCancelButton: true,
									confirmButtonColor: "#d33",
									cancelButtonColor: "#3085d6",
									confirmButtonText: "Yes, delete it!"
								}).then((result) => {
									if (result.isConfirmed) {
										const authToken = localStorage.getItem("auth_token");
										if (!authToken) {
											console.log("User not logged in.");
											return;
										}

										fetch(`<?php echo BASE_URL; ?>/address/${addressId}`, {
											method: "DELETE",
											headers: {
												"Authorization": `Bearer ${authToken}`
											}
										})
										.then(response => response.json())
										.then(responseData => {
											console.log("Delete Response:", responseData);

											if (responseData.message && responseData.message.includes("deleted successfully")) {
												Swal.fire({
													title: "Deleted!",
													text: "Your address has been deleted.",
													icon: "success",
													timer: 2000,
													showConfirmButton: false
												}).then(() => {
													location.reload(); // Refresh the list AFTER alert closes
												});
											} else {
												Swal.fire({
													title: "Error!",
													text: responseData.message || "Failed to delete address.",
													icon: "error"
												});
											}
										})
										.catch(error => {
											console.error("Error deleting address:", error);
											Swal.fire({
												title: "Error!",
												text: "Something went wrong. Please try again.",
												icon: "error"
											});
										});
									}
								});
							}
						</script>

						<!-- Open Update Modal  -->
						<script>
							function openUpdateModal(addressId) {
								const address = allAddresses.find(addr => addr.id == addressId);
								console.log(address);
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
												font-size: 1rem;
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
											<input type="text" id="update_contact_no" value="${address.contact_no || ''}" placeholder="Contact No">
											<input type="text" id="update_address_line1" value="${address.address_line1 || ''}" placeholder="Address Line 1">
											<input type="text" id="update_address_line2" value="${address.address_line2 || ''}" placeholder="Address Line 2 (optional)">
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
											</select>

											<input type="text" id="update_postal_code" value="${address.postal_code || ''}" placeholder="Pincode">
										</form>
									`,
									showCancelButton: true,
									confirmButtonText: 'Update Address',
									cancelButtonText: 'Cancel',
									focusConfirm: false,
									preConfirm: () => {
										const address_line2_value = document.getElementById("update_address_line2").value.trim();
										const address_line2 = address_line2_value !== "" ? address_line2_value : null;

										return {
											id: document.getElementById("update_address_id").value,
											name: document.getElementById("update_name").value.trim(),
											contact_no: document.getElementById("update_contact_no").value.trim(),
											address_line1: document.getElementById("update_address_line1").value.trim(),
											address_line2: address_line2,
											city: document.getElementById("update_city").value.trim(),
											state: document.getElementById("update_state").value,
											country: document.getElementById("update_country").value,
											postal_code: document.getElementById("update_postal_code").value.trim()
										};
									}
								}).then((result) => {
									if (result.isConfirmed && result.value) {
										submitUpdatedAddress(result.value);
									}
								});
							}

							function submitUpdatedAddress(data) {
								const authToken = localStorage.getItem("auth_token");
								if (!authToken) {
									Swal.fire("Error", "User not logged in.", "error");
									return;
								}

								const updatedData = {
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

								Swal.fire({
									title: "Updating...",
									text: "Please wait",
									allowOutsideClick: false,
									didOpen: () => Swal.showLoading()
								});

								fetch(`<?php echo BASE_URL; ?>/address/update/${data.id}`, {
									method: "POST",
									headers: {
										"Content-Type": "application/json",
										"Authorization": `Bearer ${authToken}`
									},
									body: JSON.stringify(updatedData)
								})
								.then(response => response.json())
								.then(responseData => {
									Swal.close();
									if (responseData.message && responseData.message.includes("updated successfully")) {
										Swal.fire({
											title: "Updated!",
											text: "Your address has been updated.",
											icon: "success",
											timer: 2000,
											showConfirmButton: false
										}).then(() => {
											location.reload();
										});
									} else {
										Swal.fire("Error!", responseData.message || "Failed to update address.", "error");
									}
								})
								.catch(error => {
									console.error("Error updating address:", error);
									Swal.close();
									Swal.fire("Error", "Something went wrong. Please try again.", "error");
								});
							}
						</script>
						<!-- Save update Modal -->

					</div>
				</div><!-- End .tab-pane -->

				<div class="tab-pane fade" id="edit" role="tabpanel">
					<h3 class="account-sub-title haneri-account-section-title haneri-account-edit-title">
						<i class="icon-user-2 align-middle mr-3"></i>Account Details</h3>
					<div class="account-content haneri-account-form-card">
						<form id="profileForm" class="haneri-account-profile-form" novalidate>
							<div class="row haneri-account-form-row">
								<div class="col-md-6">
									<div class="form-group haneri-account-field mb-md-3">
										<label for="acc-name">First name <span class="required">*</span></label>
										<input type="text" class="form-control" placeholder="First name"
											id="acc-name" name="acc-name" required autocomplete="given-name" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group haneri-account-field mb-md-3">
										<label for="acc-lastname">Last name <span class="required">*</span></label>
										<input type="text" class="form-control" id="acc-lastname"
											name="acc-lastname" placeholder="Last name" autocomplete="family-name" />
									</div>
								</div>
							</div>

							<div class="form-group haneri-account-field">
								<label for="acc-mobile">Mobile number <span class="required">*</span></label>
								<input type="text" class="form-control haneri-account-input-readonly" id="acc-mobile" name="acc-mobile" readonly
									placeholder="Mobile" required inputmode="numeric" autocomplete="tel" />
								<p class="haneri-account-form-hint mb-0">Mobile number cannot be changed.</p>
							</div>

							<div class="form-group haneri-account-field">
								<label for="acc-email">Email address <span class="required">*</span></label>
								<input type="email" class="form-control" id="acc-email" name="acc-email"
									placeholder="you@example.com" required autocomplete="email" />
							</div>

							<div class="haneri-account-password-section" aria-labelledby="haneri-password-heading">
								<h3 id="haneri-password-heading" class="haneri-account-password-heading">Password change</h3>

								<div class="form-group haneri-account-field mb-3">
									<label for="acc-current-password">Current password <span class="text-muted font-weight-normal">(optional)</span></label>
									<input type="password" class="form-control" id="acc-current-password"
										name="acc-password" placeholder="Leave blank to keep current password" autocomplete="current-password" />
								</div>

								<div class="form-group haneri-account-field mb-3">
									<label for="acc-new-password">New password <span class="text-muted font-weight-normal">(optional)</span></label>
									<input type="password" class="form-control" id="acc-new-password"
										name="acc-new-password" placeholder="Leave blank to keep current password" autocomplete="new-password" />
								</div>

								<div class="form-group haneri-account-field mb-0">
									<label for="acc-confirm-password">Confirm new password</label>
									<input type="password" class="form-control" id="acc-confirm-password"
										name="acc-confirm-password" placeholder="Repeat new password" autocomplete="new-password" />
								</div>
							</div>

							<div class="haneri-account-form-actions">
								<button type="button" class="btn profile_save haneri-account-save-btn" id="saveProfileBtn">
									Save changes
								</button>
							</div>
						</form>
					</div>
				</div><!-- End .tab-pane -->
			</div><!-- End .tab-content -->
		</div><!-- End .row -->
	</div><!-- End .container -->

	<div class="mb-5"></div><!-- margin -->
</main><!-- End .main -->


<script>
	document.addEventListener("DOMContentLoaded", function () {
		const authToken = localStorage.getItem("auth_token");
		if (!authToken) {
			console.log("User not logged in.");
			return;
		}

		// Fetch user profile details
		fetch("<?php echo BASE_URL; ?>/profile", {
			method: "GET",
			headers: {
				"Content-Type": "application/json",
				"Authorization": `Bearer ${authToken}`
			}
		})
		.then(response => response.json())
		.then(responseData => {
			console.log("Profile Data:", responseData);

			if (!responseData.data) {
				Swal.fire({
					title: "Error!",
					text: "Failed to fetch profile details.",
					icon: "error"
				});
				return;
			}

			const user = responseData.data;

			// Populate form fields
			document.getElementById("acc-name").value = user.first_name || user.firstname || user.name || "";
			document.getElementById("acc-lastname").value = user.last_name || user.lastname || "";
			document.getElementById("acc-email").value = user.email || "";
			document.getElementById("acc-mobile").value = user.mobile || user.contact_no || "";
		})
		.catch(error => {
			console.error("Error fetching profile:", error);
			Swal.fire({
				title: "Error!",
				text: "Something went wrong while fetching profile.",
				icon: "error"
			});
		});
	});
</script>

<script>
	document.addEventListener("DOMContentLoaded", function () {
		const authToken = localStorage.getItem("auth_token");

		if (!authToken) {
			console.log("User not logged in.");
			return;
		}

		// Fetch user profile and fill the form
		fetch("<?php echo BASE_URL; ?>/profile", {
			method: "GET",
			headers: {
				"Content-Type": "application/json",
				"Authorization": `Bearer ${authToken}`
			}
		})
		.then(response => response.json())
		.then(responseData => {
			console.log("Fetched Profile Data:", responseData);

			if (!responseData.data) {
				Swal.fire({
					title: "Error!",
					text: "Failed to fetch profile data.",
					icon: "error"
				});
				return;
			}

			const user = responseData.data;

			// Fill input fields with user data
			document.getElementById("acc-name").value = user.first_name || user.firstname || user.name || "";
			document.getElementById("acc-lastname").value = user.last_name || user.lastname || "";
			document.getElementById("acc-email").value = user.email || "";
			document.getElementById("acc-mobile").value = user.mobile || user.contact_no || "";
		})
		.catch(error => {
			console.error("Error fetching profile:", error);
			Swal.fire({
				title: "Error!",
				text: "Something went wrong while fetching your profile.",
				icon: "error"
			});
		});

		// Attach event listener to the Save Changes button
		document.getElementById("saveProfileBtn").addEventListener("click", function () {
			const firstName = document.getElementById("acc-name").value.trim();
			const lastName = document.getElementById("acc-lastname").value.trim();
			const email = document.getElementById("acc-email").value.trim();
			const name = [firstName, lastName].filter(Boolean).join(" ").trim() || firstName;

			if (!firstName || !email) {
				Swal.fire({
					title: "Missing Fields!",
					text: "First name and email are required.",
					icon: "warning"
				});
				return;
			}

			const updatedData = { name, email };

			console.log("Updating Profile Data:", updatedData);

			fetch("<?php echo BASE_URL; ?>/users/update", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
					"Authorization": `Bearer ${authToken}`
				},
				body: JSON.stringify(updatedData)
			})
			.then(response => response.json())
			.then(responseData => {
				console.log("Profile Update Response:", responseData);

				if (responseData.message && responseData.message.includes("success")) {
					Swal.fire({
						title: "Updated!",
						text: "Your profile has been updated successfully.",
						icon: "success",
						timer: 2000,
						showConfirmButton: false
					}).then(() => {
						location.reload(); // Reload the page after update
					});
				} else {
					Swal.fire({
						title: "Error!",
						text: responseData.message || "Failed to update profile.",
						icon: "error"
					});
				}
			})
			.catch(error => {
				console.error("Error updating profile:", error);
				Swal.fire({
					title: "Error!",
					text: "Something went wrong. Please try again.",
					icon: "error"
				});
			});
		});
	});
</script>

<!-- Logout Logic -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const authToken = localStorage.getItem("auth_token");
		const userName = localStorage.getItem("user_name");
		const userEmail = localStorage.getItem("user_email");

		if (!authToken) {
			// Redirect to login page if not logged in
			window.location.href = "login.php";
		} else {
			// Update Profile Details
			const userNameEl = document.getElementById("user-name");
			if (userNameEl) userNameEl.textContent = userName ? userName : "Not Showing !";
		}

		// Logout (no confirmation — single handler)
		function logoutUser(e) {
			if (e) e.preventDefault();
			[
				"auth_token",
				"user_name",
				"user_email",
				"user_mobile",
				"user_role",
				"user_id",
				"unique_id",
				"guest_id",
				"pwd_000",
				"temp_id"
			].forEach(function (k) {
				localStorage.removeItem(k);
			});
			window.location.href = "login.php";
		}

		const logoutBtn = document.getElementById("logout-btn");
		if (logoutBtn) {
			logoutBtn.addEventListener("click", logoutUser);
		}

		const logoutBtnAlt = document.getElementById("logout-btn-alt");
		if (logoutBtnAlt) {
			logoutBtnAlt.addEventListener("click", logoutUser);
		}

		// Hide Quotation tab for customers
		const role = localStorage.getItem("user_role");
		if (role === "customer") {
			const quotationTab = document.querySelector("#quotation-tab");
			if (quotationTab) quotationTab.parentElement.style.display = "none";
		}
	});
</script>

<!-- Quotations Fetch Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const authToken = localStorage.getItem("auth_token");
        if (!authToken) {
            console.log("User not logged in.");
            return;
        }

        fetch("<?php echo BASE_URL; ?>/quotation/fetch", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${authToken}`
            }
        })
        .then(response => response.json())
        .then(responseData => {
            console.log("API Response:", responseData); // Debugging - Check API response in Console

            // Extract quotations from responseData
            const quotations = responseData.data; // Now correctly accessing the quotations array
            const tableBody = document.querySelector(".table-quotation tbody");
            tableBody.innerHTML = ""; // Clear table content

            if (!Array.isArray(quotations) || quotations.length === 0) {
                console.log("No quotations found.");
                tableBody.innerHTML = `<tr><td colspan="6" class="text-center">No Quotations Found</td></tr>`; // Updated for 6 columns
                return;
            }
            quotations.forEach(quotation => {
                const quotationId = quotation.items.length > 0 ? quotation.items[0].quotation_id : "N/A"; 
                const quotationNO = quotation.quotation_no || "##"; // Set dynamic status here
                const quotationBill = quotation.q_address || "NA";
                const totalAmount = `₹${quotation.total_amount || '0.00'}`;

                // Debugging
                // console.log(`Quotation ID: ${quotationId}, Total: ${totalAmount}`);

                tableBody.innerHTML += `
                    <tr>
                        <td class="text-center">#${quotationId}</td>
                        <td class="text-center">${quotationNO}</td>
                        <td class="addressess">${quotationBill}</td>
                        <td class="text-center">${totalAmount}</td>
                        <td class="text-center">
                            <a href="${quotation.invoice_quotation || '#'}" class="btn btn-default" target="_blank">
                                ${quotation.invoice_quotation ? "View Quotation" : "No Invoice Available"}
                            </a>
                        </td>
						<td class="text-center">
                            <div class="flex gap-2">
                              <button class="btn btn-success purchase-quotation" data-id="${quotationId}"><i class="fa fa-shopping-bag"></i> Buy Now</button>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex gap-2">
                              <button class="btn btn-danger delete-quotation" data-id="${quotationId}"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                `;
            });

            // Attach event listeners for delete buttons
            const deleteButtons = document.querySelectorAll(".delete-quotation");
            deleteButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const quotationId = this.getAttribute("data-id");

                    // SweetAlert for delete confirmation
                    Swal.fire({
                      title: 'Are you sure?',
                      text: `Do you want to delete quotation #${quotationId}?`,
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#d33',
                      cancelButtonColor: '#3085d6',
                      confirmButtonText: 'Yes, delete it!',
                      customClass: {
                        title: 'swal-title-custom',
                        htmlContainer: 'swal-text-custom',
                        confirmButton: 'swal-confirm-btn-custom',
                        cancelButton: 'swal-cancel-btn-custom'
                      }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send DELETE request to API
                            fetch(`<?php echo BASE_URL; ?>/quotation/${quotationId}`, {
                                method: "DELETE",
                                headers: {
                                    "Content-Type": "application/json",
                                    "Authorization": `Bearer ${authToken}`
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Successfully deleted, remove the row from the table
                                    this.closest("tr").remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'Quotation has been deleted successfully.',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete quotation. Please try again.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error("Error deleting quotation:", error);
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the quotation.',
                                    'error'
                                );
                            });
                        }
                    });
                });
            });

			// ✅ Attach event listeners for "Buy Now" buttons
			const buyButtons = document.querySelectorAll(".purchase-quotation");
			buyButtons.forEach(btn => {
				btn.addEventListener("click", function () {
					const quotationId = this.getAttribute("data-id");

					Swal.fire({
						title: "Add quotation to cart?",
						text: "Choose how you want to add products to your cart.",
						icon: "question",
						showCancelButton: true,
						showDenyButton: true,

						// ✅ Button texts
						confirmButtonText: "Merge Cart",
						denyButtonText: "Replace Cart",
						cancelButtonText: "Cancel",

						confirmButtonColor: "#28a745",
						denyButtonColor: "#dc3545",
						cancelButtonColor: "#6c757d",
					}).then((result) => {

						// Cancel
						if (result.isDismissed) return;

						// ✅ mode based on click
						const mode = result.isConfirmed ? "merge" : "replace";

						Swal.fire({
							title: "Processing...",
							text: "Please wait",
							allowOutsideClick: false,
							didOpen: () => Swal.showLoading()
						});

						fetch(`<?php echo BASE_URL; ?>/cart/cart-from-quotation`, {
							method: "POST",
							headers: {
								"Content-Type": "application/json",
								"Authorization": `Bearer ${authToken}`
							},
							body: JSON.stringify({
								quotation_id: parseInt(quotationId, 10),
								mode: mode
							})
						})
						.then(res => res.json())
						.then(data => {
							Swal.close();

							// ✅ Unauthorized handling (your API returns message "Unauthorized.")
							if (data.message && data.message.toLowerCase().includes("unauthorized")) {
								Swal.fire("Unauthorized", "Please login again.", "error").then(() => {
									window.location.href = "login.php";
								});
								return;
							}

							// ✅ Success handling
							if (data.message && data.message.toLowerCase().includes("success")) {
								Swal.fire({
									title: "Success!",
									text: data.message,
									icon: "success",
									timer: 1200,
									showConfirmButton: false
								}).then(() => {
									// ✅ Redirect to cart page
									window.location.href = "cart.php";
								});
							} else {
								Swal.fire("Error", data.message || "Failed to create cart from quotation.", "error");
							}
						})
						.catch(err => {
							console.error("cart-from-quotation error:", err);
							Swal.close();
							Swal.fire("Error", "Something went wrong. Please try again.", "error");
						});
					});
				});
			});

        })
        .catch(error => {
            console.error("Error fetching quotations:", error);
        });
    });
</script>

<?php include("footer.php"); ?>
<script>
	document.addEventListener("DOMContentLoaded", function () {

	function openTabByHash(hash) {
		if (!hash) return;

		// Find the tab link that targets this pane
		const tabLink = document.querySelector(`a.nav-link[href="${hash}"]`);
		if (!tabLink) return;

		// Bootstrap 5 (if used)
		if (window.bootstrap && bootstrap.Tab) {
		const tab = new bootstrap.Tab(tabLink);
		tab.show();
		return;
		}

		// Bootstrap 4 (jQuery)
		if (window.jQuery && typeof jQuery(tabLink).tab === "function") {
		jQuery(tabLink).tab("show");
		return;
		}

		// Fallback (no bootstrap tab JS): manually toggle classes
		document.querySelectorAll(".nav-link").forEach(a => a.classList.remove("active"));
		document.querySelectorAll(".tab-pane").forEach(p => p.classList.remove("show", "active"));
		tabLink.classList.add("active");
		const pane = document.querySelector(hash);
		if (pane) pane.classList.add("show", "active");
	}

	// 1) Open tab from URL hash: profile.php#quotation
	if (window.location.hash) {
		openTabByHash(window.location.hash);
	}

	// 2) Optional: support query param too: profile.php?tab=quotation
	const tabParam = new URLSearchParams(window.location.search).get("tab");
	if (tabParam) {
		openTabByHash("#" + tabParam);
	}

	// 3) When user clicks a tab, update the URL hash (so copy/paste link works)
	// Bootstrap 4 event
	if (window.jQuery) {
		jQuery('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
		const target = e.target.getAttribute("href");
		if (target) history.replaceState(null, "", target);
		});
	}

	// Also make your "link-to-tab" anchors open the tab properly
	document.addEventListener("click", function (e) {
		const a = e.target.closest('a.link-to-tab[href^="#"]');
		if (!a) return;
		e.preventDefault();
		const hash = a.getAttribute("href");
		openTabByHash(hash);
		history.replaceState(null, "", hash);
	});

	});
</script>

<!-- 
Tabs: profile.php#quotation | #order | #address | #edit
Or: profile.php?tab=address
Magic login + Addresses tab: profile.php?token=YOUR_JWT#address
  (JWT must be in ?token=… ; #address selects the tab — do not put # inside the token value)
 -->



