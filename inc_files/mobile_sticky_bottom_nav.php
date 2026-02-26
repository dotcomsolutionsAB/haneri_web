<div class="sticky-info">
    <a href="index">
        <i class="icon-home"></i>Home
    </a>
</div>
<div class="sticky-info">
    <a href="shop" class="">
        <i class="icon-bars"></i>Shop
    </a>
</div>
<!-- Dynamic account button will replace here -->
<div id="sticky-account"></div>

<div class="sticky-info">
    <a href="contact" class="">
        <i class="sicon-earphones-alt"></i>Support
    </a>
</div>
<div class="sticky-info wpp-btn">
    <a href="#" class="wpp">
        <i class="fab fa-whatsapp"></i>Whatsapp
    </a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const token = localStorage.getItem("auth_token");
        // console.log(token);
        let html = `
            <div class="sticky-info">
                <a href="${token ? 'profile' : 'login'}" class="">
                    <i class="icon-user-2"></i>Account
                </a>
            </div>
        `;
    
        document.getElementById("sticky-account").innerHTML = html;
    });
</script>
