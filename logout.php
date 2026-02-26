<script>
    // Clear authentication data from localStorage
    localStorage.removeItem("auth_token");
    localStorage.removeItem("user_name");
    localStorage.removeItem("user_role");
    localStorage.removeItem("user_id");

    // Redirect to login page after logout
    window.location.href = "../login.php";
</script>
