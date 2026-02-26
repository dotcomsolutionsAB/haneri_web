<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php 
    $current_page = "Add Brands"; // Dynamically set this based on the page
?>
<?php include("header1.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <!-- End of Header -->
            <!-- Content -->
            <main class="grow content pt-5" id="content" role="content">
                <!-- Container -->
                <div class="container-fixed" id="content_container">
                </div>
                <!-- End of Container -->

                <!-- Container -->
                <div class="container-fixed">
                    <div class="grid gap-5 grid-cols-1 lg:gap-7.5 xl:w-[68.75rem] mx-auto">
                        <div class="card pb-2.5">
                            <div class="card-header" id="basic_settings">
                                <h3 class="card-title">
                                    General Settings
                                </h3>
                            </div>
                            <div class="card-body grid gap-5">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                    <!-- Brand Name -->
                                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                        <label class="form-label max-w-56">Brand Name</label>
                                        <input class="input" type="text" id="brandName" placeholder="Brand Name">
                                    </div>

                                    <!-- Sort Number -->
                                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                        <label class="form-label max-w-56">Sort Number</label>
                                        <input class="input" type="text" id="sortNumber" placeholder="Sort Number">
                                    </div>

                                    <!-- Description -->
                                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                        <label class="form-label max-w-56">Description</label>
                                        <div class="card cardx">
                                            <textarea class="note-codable text-edit" id="description" aria-multiline="true"></textarea>
                                        </div>
                                    </div>

                                    <!-- Brand Logo -->
                                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5">
                                        <label class="form-label max-w-56">Photo</label>
                                        <div class="flex items-center justify-between flex-wrap grow gap-2.5">
                                            <span class="text-2sm">150x150px JPEG, PNG Image</span>
                                            <input type="file" id="brandLogo" accept=".png, .jpg, .jpeg">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end gap-5">
                                    <button class="btn btn-primary" id="saveBrand">Save Brand</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Container -->
            </main>

            <!-- End of Content -->
            <!-- Footer -->
<?php include("footer1.php"); ?>

<!-- <script>
  document.getElementById('saveBrand').addEventListener('click', function() {
    // 1) Get the token from localStorage
    const token = localStorage.getItem('auth_token'); // e.g. "abc123"

    // 2) Collect field values
    const name = document.getElementById('brandName').value.trim();
    const custom_sort = document.getElementById('sortNumber').value.trim();
    const description = document.getElementById('description').value.trim();
    
    // NOTE: For demonstration, we’ll treat `logo` as an integer ID,
    // but in practice you may need to handle file uploads differently.
    const logo = 2;

    // 3) Build the request payload
    const payload = {
      name,
      logo,
      custom_sort,
      description
    };

    // 4) Send the POST request
    fetch('<?php echo BASE_URL; ?>/brands', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      body: JSON.stringify(payload)
    })
      .then(response => response.json())
      .then(data => {
        // Check if there's an error (depending on your API's response format)
        if (data.error) {
          // Show error alert
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: data.error,
          });
        } else {
          // 5) If success, show success alert
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: data.message || 'Brand created successfully!',
            confirmButtonText: 'OK'
          }).then(() => {
            // Clear the form fields
            document.getElementById('brandName').value = '';
            document.getElementById('sortNumber').value = '';
            document.getElementById('description').value = '';
            document.getElementById('brandLogo').value = '';
            window.location.href = 'pages/show_brands.php';
          });
        }
      })
      .catch(error => {
        // Show error alert if fetch fails
        console.error('Error:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Something went wrong while saving brand.'
        });
      });
  });
</script> -->
<script>
  document.getElementById('saveBrand').addEventListener('click', function() {
    const token = localStorage.getItem('auth_token');

    // Collect input values
    const name = document.getElementById('brandName').value.trim();
    const custom_sort = document.getElementById('sortNumber').value.trim() || 0;
    const description = document.getElementById('description').value.trim();
    const photoInput = document.getElementById('brandLogo');

    // Simple validation
    if (!name) {
      Swal.fire({
        icon: 'warning',
        title: 'Missing Name',
        text: 'Please enter a brand name.'
      });
      return;
    }

    // Prepare payload
    const formData = new FormData();
    formData.append('name', name);
    formData.append('custom_sort', custom_sort);
    formData.append('description', description || '');
    if (photoInput.files.length > 0) {
      formData.append('photo', photoInput.files[0]);
    }

    // Submit API
    fetch('<?php echo BASE_URL; ?>/brands', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`
      },
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (!data.success) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.message || 'Unable to create brand.'
          });
          return;
        }

        // ✅ Success — redirect after showing success alert
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: data.message || 'Brand created successfully!',
          confirmButtonText: 'OK'
        }).then(() => {
          // Redirect to show_brands.php
          window.location.href = 'pages/show_brands.php';
        });
      })
      .catch(error => {
        console.error('Error:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Something went wrong while saving brand.'
        });
      });
  });
</script>


<style>
    .cardx{
        width:100%;
    }
    .text-edit{
        width: 100%;
        min-height: 120px;
        border: 1px solid rgba(128, 128, 128, 0.34);
        border-radius: 10px;
        background: #fcfcfc;
        padding: 2px 10px;
        text-align: justify;
    }
</style>