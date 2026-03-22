<base href="../">
<?php include("../../configs/config.php"); ?>
<?php 
    $current_page = "Add Category"; // Dynamically set this based on the page
?>
<?php include("header1.php"); ?>

<style>
    .cardx{
        width:100%;
    }
</style>
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
                            <!-- Category Name -->
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">Category Name</label>
                                <input class="input" type="text" id="categoryName" placeholder="Category Name">
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

                            <!-- Parent Category Name -->
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">Parent Category</label>
                                <select class="select" id="parentCategory">
                                    <option value="">Loading categories...</option>
                                </select>
                            </div>

                            <!-- Category Logo -->
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5">
                                <label class="form-label max-w-56">Photo</label>
                                <div class="flex items-center justify-between flex-wrap grow gap-2.5">
                                    <span class="text-2sm">150x150px JPEG, PNG Image</span>
                                    <input type="file" id="photo" accept=".png, .jpg, .jpeg">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-5">
                            <button class="btn btn-primary" id="saveCategory">Save Category</button>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const parentCategorySelect = document.querySelector("#parentCategory");
        const saveButton = document.querySelector("#saveCategory");
        const categoryNameInput = document.querySelector("#categoryName");
        const sortNumberInput = document.querySelector("#sortNumber");
        const descriptionInput = document.querySelector("#description");
        const photoInput = document.querySelector("#photo");

        const apiUrl = `<?php echo BASE_URL; ?>/categories/fetch`;
        const authToken = localStorage.getItem('auth_token'); // Replace with actual token

        /** FETCH CATEGORIES **/
        function fetchCategories() {
            fetch(apiUrl, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${authToken}`,
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data && data.data) {
                    parentCategorySelect.innerHTML = ""; // Clear existing options

                    // Default option
                    const defaultOption = document.createElement("option");
                    defaultOption.value = "";
                    defaultOption.textContent = "Select Parent Category";
                    parentCategorySelect.appendChild(defaultOption);

                    // Populate dropdown with ALL categories (parent & child)
                    data.data.forEach(category => {
                        const option = document.createElement("option");
                        option.value = category.parent_id; // Use category parent_id as the value
                        option.textContent = category.name;
                        parentCategorySelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error("Error fetching categories:", error);
            });
        }

        /** SUBMIT CATEGORY **/
        function submitCategory() {
            const formData = {
                name: categoryNameInput.value.trim(),
                parent_id: parentCategorySelect.value !== "" ? parentCategorySelect.value : null,
                photo: photoInput.files.length > 0 ? photoInput.files[0].name : null,
                custom_sort: sortNumberInput.value.trim() || 0,
                description: descriptionInput.value.trim() || null
            };

            console.log("Submitting Data:", formData); // Debugging

            fetch(`<?php echo BASE_URL; ?>/categories`, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${authToken}`,
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                console.log("Success Response:", data);
                if (data.message) {
                    // Show success SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        clearFields();      // Clear input fields after submission
                        // Redirect to the show categories page after success
                        window.location.href = "pages/show_categories.php";
                    });
                }
            })
            .catch(error => {
                console.error("Error submitting category:", error);
                // Show error SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Error submitting category: ' + error.message
                });
            });
        }

        function clearFields() {
            categoryNameInput.value = "";
            sortNumberInput.value = "";
            descriptionInput.value = "";
            parentCategorySelect.value = ""; // Reset dropdown
            photoInput.value = "";           // Reset file input
        }

        // Event listener for save button
        saveButton.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent default behavior
            submitCategory();
        });

        // Load categories on page load
        fetchCategories();
    });
</script>


<style>
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