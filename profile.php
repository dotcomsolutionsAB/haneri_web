<script>
	document.addEventListener("DOMContentLoaded", function() {
		const authToken = localStorage.getItem("auth_token");

		if (!authToken) {
			// If no token, redirect to login page
			window.location.href = "login.php";
		}
	});
</script>


<?php include("header.php"); ?>
<?php include("configs/config.php"); ?> 
<style>
	.view-invoice{
		display: flex;
		gap: 2px;
		align-items: center;
		flex-direction: column;
		font-size: 10px;
		background: transparent;
		color: #005d5a;
		border: none;
	}
	.view-invoice i{
		font-size: 18px;
	}
</style>
<main class="main profile_page">
	<div class="container account-container custom-account-container padding_top_100">
		<div class="row">
			<div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
				<h2 class="text-uppercase">My Account</h2>
				<ul class="nav nav-tabs flex-column mb-0" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard"
							role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
							aria-controls="order" aria-selected="true">Orders</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="quotation-tab" data-toggle="tab" href="#quotation" role="tab"
							aria-controls="quotation" aria-selected="true">Quotation</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
							aria-controls="address" aria-selected="false">Addresses</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
							aria-controls="edit" aria-selected="false">Account
							details</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link" id="logout-btn">Logout</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-9 order-lg-last order-1 tab-content tab_data">
				<div class="tab-pane fade show active" id="dashboard" role="tabpanel">
					<div class="dashboard-content">
						<h6>
							Hello <strong class="text-dark" id="user-name">..</strong>
						</h6>

						<p>
							From your account dashboard you can view your
							<a class="btn btn-link alink link-to-tab" href="#order">recent orders</a>,
							manage your
							<a class="btn btn-link alink link-to-tab" href="#address">shipping and billing
								addresses</a>, and
							<a class="btn btn-link alink link-to-tab" href="#edit">edit your password and account
								details.</a>
						</p>

						<div class="mb-4"></div>

						<div class="row row-lg">
							<div class="col-6 col-md-3">
								<div class="feature-box text-center pb-4">
									<a href="#order" class="link-to-tab"><i
											class="sicon-social-dropbox"></i></a>
									<div class="feature-box-content">
										<h3>ORDERS</h3>
									</div>
								</div>
							</div>

							<div class="col-6 col-md-3">
								<div class="feature-box text-center pb-4">
									<a href="#address" class="link-to-tab"><i
											class="sicon-location-pin"></i></a>
									<div class="feature-box-content">
										<h3>ADDRESSES</h3>
									</div>
								</div>
							</div>

							<div class="col-6 col-md-3">
								<div class="feature-box text-center pb-4">
									<a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
									<div class="feature-box-content p-0">
										<h3>ACCOUNT DETAILS</h3>
									</div>
								</div>
							</div>

						</div><!-- End .row -->
					</div>
				</div><!-- End .tab-pane -->
				<script>
					document.getElementById("logout-btn").addEventListener("click", function () {
						Swal.fire({
							title: "Are you sure?",
							text: "You will be logged out.",
							icon: "warning",
							showCancelButton: true,
							confirmButtonColor: "#d33",
							cancelButtonColor: "#3085d6",
							confirmButtonText: "Yes, Logout"
						}).then((result) => {
							if (result.isConfirmed) {
								// Remove authentication token
								localStorage.removeItem("auth_token");
								localStorage.removeItem("user_name");
								localStorage.removeItem("user_role");
								localStorage.removeItem("user_id");
								localStorage.removeItem("unique_id");
								localStorage.removeItem("guest_id");

								// Redirect to login page (update with correct login URL)
								window.location.href = "login.php";
							}
						});
					});
				</script>

				<style>
					.table-order tbody {
						display: block;
						max-height: 300px; /* Adjust height as needed */
						overflow-y: auto;
					}
					.table-order thead, 
					.table-order tbody tr {
						display: table;
						width: 100%;
						table-layout: fixed;
					}
					.table td{

					}
					.table td, .table th {
						padding: .75rem;
						vertical-align: middle;
						border-top: 1px solid #dee2e6;
						text-align: center;
					}
					.table-order tbody tr .addressess{
						font-size:smaller;
						text-align: start;
					}
					@media (max-width: 520px) {
						.order-table-container {
							overflow-x: auto;
							width: 100%;
						}

						.table-order {
							min-width: 600px; /* Allow full columns to be scrollable */
						}

						.table-order thead {
							font-size: 14px;
						}

						.table-order tbody {
							max-height: 200px;
						}

						.table-order tbody tr .addressess {
							font-size: 12px;
							text-align: left;
						}

						.table-order td,
						.table-order th {
							font-size: 13px;
							padding: 0.5rem;
						}

						.btn.btn-dark {
							font-size: 14px;
							padding: 0.6rem 1rem;
						}
					}

				</style>
				<!-- Orders Showing For each Profile -->
				<div class="tab-pane fade" id="order" role="tabpanel">
					<div class="order-content">
						<h3 class="account-sub-title d-none d-md-block">
							<i class="sicon-social-dropbox align-middle mr-3"></i>Orders
						</h3>
						<div class="order-table-container text-center">
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
								tableBody.innerHTML = `<tr><td colspan="5" class="text-center">No Orders Found</td></tr>`;
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
						<h3 class="account-sub-title d-none d-md-block">
							<i class="sicon-doc align-middle mr-3"></i>Quotation
						</h3>
						<div class="quotation-table-container text-center">
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
					<h3 class="account-sub-title d-none d-md-block mb-1">
						<i class="sicon-location-pin align-middle mr-3"></i>Addresses</h3>
					<div class="addresses-content">
						<!-- <p class="mb-4">
							The following addresses will be used on the checkout page by
							default.
						</p> -->

						<div class="row">
							<div class="address col-md-6">
								<div class="heading d-flex">
									<h4 class="text-dark mb-0">Billing address</h4>
								</div>

								<div class="address-box">
									You have not set up this type of address yet.
								</div>

								<a class="btn btn-default address-action" href="javascript:void(0);" onclick="openAddAddressForm()">
									Add Address
								</a>
							</div>
						</div>
						<!-- Fetch Address Card-->
						<div id="addressList" class="add-List">

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
					<h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1"><i
							class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details</h3>
					<div class="account-content">
						<form id="profileForm">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="acc-name">First name <span class="required">*</span></label>
										<input type="text" class="form-control" placeholder="Editor"
											id="acc-name" name="acc-name" required />
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label for="acc-lastname">Last name <span
												class="required">*</span></label>
										<input type="text" class="form-control" id="acc-lastname"
											name="acc-lastname" />
									</div>
								</div>
							</div>

							<div class="form-group mb-2 pl-3">
								<label for="acc-text">Mobile Number <span class="required">*</span></label>
								<input type="text" class="form-control" id="acc-mobile" name="acc-mobile" readonly
									placeholder="Editor" required />
								<p>Mobile Number can not be changed</p>
							</div>


							<div class="form-group mb-4 pl-3">
								<label for="acc-email">Email address <span class="required">*</span></label>
								<input type="email" class="form-control" id="acc-email" name="acc-email"
									placeholder="editor@gmail.com" required />
							</div>

							<div class="change-password pl-3">
								<h3 class="text-uppercase mb-2">Password Change</h3>

								<div class="form-group">
									<label for="acc-password">Current Password (leave blank to leave
										unchanged)</label>
									<input type="password" class="form-control" id="acc-password"
										name="acc-password" />
								</div>

								<div class="form-group">
									<label for="acc-password">New Password (leave blank to leave
										unchanged)</label>
									<input type="password" class="form-control" id="acc-new-password"
										name="acc-new-password" />
								</div>

								<div class="form-group">
									<label for="acc-password">Confirm New Password</label>
									<input type="password" class="form-control" id="acc-confirm-password"
										name="acc-confirm-password" />
								</div>
							</div>

							<div class="form-footer mt-3 mb-0 pl-3">
								<button type="button" class="btn profile_save mr-0" id="saveProfileBtn">
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
			document.getElementById("acc-name").value = user.name || "";
			document.getElementById("acc-email").value = user.email || "";
			document.getElementById("acc-mobile").value = user.mobile || ""; // Mobile Number same as name
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
			document.getElementById("acc-name").value = user.name || "";
			document.getElementById("acc-email").value = user.email || "";
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
			const name = document.getElementById("acc-name").value.trim();
			const email = document.getElementById("acc-email").value.trim();

			if (!name || !email) {
				Swal.fire({
					title: "Missing Fields!",
					text: "Name and Email cannot be empty.",
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

		// Logout functionality
		const logoutBtn = document.getElementById("logout-btn");
		if (logoutBtn) {
			logoutBtn.addEventListener("click", logoutUser);
		}

		const logoutBtnAlt = document.getElementById("logout-btn-alt");
		if (logoutBtnAlt) {
			logoutBtnAlt.addEventListener("click", logoutUser);
		}

		function logoutUser() {
			localStorage.clear(); // Remove all localStorage data
			window.location.href = "login.php"; // Redirect to login page after logout
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
Quotation: profile.php#quotation
Orders: profile.php#order
Address: profile.php#address
Edit: profile.php#edit
 -->



