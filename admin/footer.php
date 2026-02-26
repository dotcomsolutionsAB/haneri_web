            <footer class="footer">
                <!-- Container -->
                <div class="container-fixed">
                    <div class="flex flex-col md:flex-row justify-center md:justify-center items-center gap-3 py-5">
                        <div class="flex order-2 md:order-1 gap-2 font-normal text-2sm">
                            <span class="text-gray-500">
                                2025© 
                            </span>
                            <a class="text-gray-600 hover:text-primary" href="#">
                                Haneri
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End of Container -->
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Wrapper -->
    </div>
    <!-- End of Main -->
    <?php include("admin_inc/modals.php"); ?>
    <!-- End of Page -->
    <!-- Scripts -->
    <!-- <script>
        $(function () {
            const token = localStorage.getItem("auth_token");
            if (!token) {
                console.error("No auth_token found in localStorage");
                return;
            }

            $.ajax({
                url: '<?php echo BASE_URL; ?>/users/dashboard', // replace with your actual base URL
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                success: function (response) {
                    if (response.success && response.data) {
                        $('#total-products').text(response.data.total_products ?? 0);
                        $('#total-orders').text(response.data.total_orders ?? 0);
                        $('#total-brands').text(response.data.total_brands ?? 0);
                        $('#total-categories').text(response.data.total_categories ?? 0);
                    } else {
                        console.error('API returned success=false');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        });
    </script> -->
    <script src="assets/js/core.bundle.js">
    </script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js">
    </script>
    <script src="assets/js/widgets/general.js">
    </script>
    <script src="assets/js/layouts/demo1.js">
    </script>
    <!-- End of Scripts -->
</body>

</html>