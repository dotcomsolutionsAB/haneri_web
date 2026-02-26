const authToken = localStorage.getItem("auth_token");

fetch("<?php echo BASE_URL; ?>/some-endpoint", {
    method: "GET",
    headers: {
        "Content-Type": "application/json",
        "Authorization": `Bearer ${authToken}`
    }
})
.then(response => response.json())
.then(data => {
    console.log(data);
})
.catch(error => console.error("Error:", error));
