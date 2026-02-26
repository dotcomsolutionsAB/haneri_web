<script>
  const authhhToken = localStorage.getItem("auth_token");
  const userhhRole = localStorage.getItem("user_role");

  if (!authhhToken || userhhRole !== "admin") {
    window.location.href = "../login.php";
  }
</script>
<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" dir="ltr" lang="en">

<head>
    <!-- <base href="../"> -->
    <title>
        HANERI - Admin
    </title>
    <meta charset="utf-8" />
    <meta content="follow, index" name="robots" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <meta content="en_US" property="og:locale" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="uploads/H.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="assets/vendors/apexcharts/apexcharts.css" rel="stylesheet" />
    <link href="assets/vendors/keenicons/styles.bundle.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="custom/custom_style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body
    class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] [--tw-page-bg-dark:var(--tw-coal-500)] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]">
    <!-- Theme Mode -->
    <script>
        const defaultThemeMode = 'light'; // light|dark|system
        let themeMode;

        if (document.documentElement) {
            if (localStorage.getItem('theme')) {
                themeMode = localStorage.getItem('theme');
            } else if (document.documentElement.hasAttribute('data-theme-mode')) {
                themeMode = document.documentElement.getAttribute('data-theme-mode');
            } else {
                themeMode = defaultThemeMode;
            }

            if (themeMode === 'system') {
                themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }

            document.documentElement.classList.add(themeMode);
        }
    </script>
    <!-- End of Theme Mode -->
    <!-- Page -->
    <!-- Main -->
    <div class="flex grow">
        <!-- Sidebar -->
        <?php include("../admin_inc/sidebar.php"); ?>
        <!-- End of Sidebar -->
        <!-- Wrapper -->
        <div class="wrapper flex grow flex-col">
            <!-- Header -->
            <header class="header fixed top-0 z-10 start-0 end-0 flex items-stretch shrink-0 bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]"
                data-sticky="true" data-sticky-class="shadow-sm" data-sticky-name="header" id="header">
                <!-- Container -->
                <div class="container-fixed flex justify-between items-stretch lg:gap-4" id="header_container">
                    <!-- Mobile Logo -->
                    <div class="flex gap-1 lg:hidden items-center -ms-1">
                        <a class="shrink-0" href="index">
                            <img class="max-h-[25px] w-full" src="uploads/H.jpg" />
                        </a>
                        <div class="flex items-center">
                            <button class="btn btn-icon btn-light btn-clear btn-sm" data-drawer-toggle="#sidebar">
                                <i class="ki-filled ki-menu">
                                </i>
                            </button>
                        </div>
                    </div>
                    <!-- End of Mobile Logo -->
                    <!-- Breadcrumbs -->
                    <nav aria-label="breadcrumb" class="flex items-center">
                        <ol class="breadcrumb flex items-center gap-2 text-xs lg:text-sm font-medium mb-2.5 lg:mb-0">
                            <li class="breadcrumb-item text-gray-700">
                                <a href="index.php" class="text-gray-700 hover:text-primary">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item text-gray-500">
                                <i class="ki-filled ki-right text-gray-500 text-3xs"></i>
                            </li>
                            <li class="breadcrumb-item text-gray-700 active" aria-current="page">
                                <?php echo $current_page; ?>
                            </li>
                        </ol>
                    </nav>
                    <!-- End of Breadcrumbs -->
                    <!-- Topbar -->
                    <div class="flex items-center gap-2 lg:gap-3.5">
                        <div class="menu" data-menu="true">
                            <div class="menu-item" data-menu-item-offset="20px, 10px"
                                data-menu-item-offset-rtl="-20px, 10px" data-menu-item-placement="bottom-end"
                                data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown"
                                data-menu-item-trigger="click|lg:click">
                                <div class="menu-toggle btn btn-icon rounded-full">
                                    <!-- <img alt="" class="size-9 rounded-full border-2 border-success shrink-0"
                                        src="../images/default/df001.png">
                                    </img> -->
                                    <span class="size-9 rounded-full border-2 border-success shrink-0 flex items-center justify-center" 
                                        style="background-color: #2e7575; color: white; font-size: 20px; width: 40px; height: 40px; text-align: center; line-height: 40px;">
                                        <span id="userInitialsh2"></span>  <!-- First letter will go here -->
                                    </span>
                                </div>
                                <div class="menu-dropdown menu-default light:border-gray-300 w-screen max-w-[250px]">
                                    <div class="flex items-center justify-between px-5 py-1.5 gap-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="size-9 rounded-full border-2 border-success flex items-center justify-center" 
                                                style="background-color: #2e7575; color: white; font-size: 20px; width: 40px; height: 40px; text-align: center; line-height: 40px;">
                                                <span id="userInitialsDropdownh2"></span>  <!-- First letter will go here -->
                                            </span>
                                            <div class="flex flex-col gap-1.5">
                                                <span class="text-sm text-gray-800 font-semibold leading-none" id="userNameh2">
                                                    <!-- User name will go here -->
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-separator">
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="menu-item px-4 py-1.5">
                                            <a class="btn btn-sm btn-light justify-center"
                                                id="ad-logout">
                                                Log out
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Topbar -->
                </div>
                <!-- End of Container -->
            </header>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.getElementById("ad-logout").addEventListener("click", function () {
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

                            // Redirect to login page (update with correct login URL)
                            // window.location.href = "index.php";
                            location.reload(); // Reload the logout page
                        }
                    });
                });
            </script>
            <script>
                // Get user name from local storage
                const userName = localStorage.getItem('user_name') || 'ADMIN';  // Default to 'ADMIN' if no name exists

                // Get the first letter of the user name
                const userInitial = userName.charAt(0).toUpperCase();

                // Set the first letter in the menu toggle
                document.getElementById('userInitialsh2').textContent = userInitial;

                // Set the first letter in the dropdown
                document.getElementById('userInitialsDropdownh2').textContent = userInitial;

                // Set the user name in the dropdown
                document.getElementById('userNameh2').textContent = userName;
            </script>
