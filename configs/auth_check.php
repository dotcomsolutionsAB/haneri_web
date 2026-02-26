<script>
    // Fetch stored authentication details
    const authToken = localStorage.getItem("auth_token");
    const userRole = localStorage.getItem("user_role");

    // Get the current page URL
    const currentPage = window.location.pathname;

    // List of pages that only admins can access
    const adminPages = [
        "../admin/index.php",
        
        "../admin/pages/add_user.php",
        "../admin/pages/show_users.php",

        "../admin/pages/add_product.php",
        "../admin/pages/show_products.php",

        "../admin/pages/add_category.php",
        "../admin/pages/show_categories.php",

        "../admin/pages/add_brand.php",
        "../admin/pages/show_brands.php",

        "../admin/pages/add_discount.php",
        "../admin/pages/show_discounts.php",

        "../admin/pages/add_order.php",
        "../admin/pages/show_orders.php",
        "../admin/pages/view_order.php",
    ];

    // List of pages that only customers can access
    const customerPages = [
        "../order-complete.php",
        "../checkout.php",
        "../profile.php"
    ];

    // Check if the user is logged in
    if (!authToken) {
        // Redirect to login page if not authenticated
        window.location.href = "../login.php";
    } else {
        if (userRole === "admin" && customerPages.includes(currentPage)) {
            // Redirect admin users trying to access customer pages
            window.location.href = "../admin/index.php";
        } else if (userRole === "customer" && adminPages.includes(currentPage)) {
            // Redirect customer users trying to access admin pages
            window.location.href = "../index.php";
        }
    }
</script>
