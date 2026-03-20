<?php include("header.php"); ?>
<!-- Firebase App (core) -->
<script src="https://www.gstatic.com/firebasejs/10.13.2/firebase-app-compat.js"></script>
<!-- Firebase Auth -->
<script src="https://www.gstatic.com/firebasejs/10.13.2/firebase-auth-compat.js"></script>

<?php include("configs/config.php"); ?> 
<script>
  // ⬇️ PHP array → JS object
  const firebaseConfig = <?php echo json_encode($FIREBASE_CONFIG, JSON_UNESCAPED_SLASHES); ?>;

  // Initialize Firebase once
  firebase.initializeApp(firebaseConfig);
</script>


<main class="main">
    <div class="container login-container padding_top_100">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="login_reg_container">
                    <div class="col-md-6">
                        <div class="heading mb-1">
                            <h2 class="title">Register</h2>
                        </div>

                        <form id="registerForm">
                            <label for="register-name">
                                Full Name <span class="required">*</span>
                            </label>
                            <input type="text" class="form-input form-wide" id="register-name" required />

                            <label for="register-mobile">
                                Mobile <span class="required">*</span>
                            </label>
                            <input type="tel" class="form-input form-wide" id="register-mobile" required />

                            <label for="register-email">
                                Email address <span class="required">*</span>
                            </label>
                            <input type="email" class="form-input form-wide" id="register-email" required />

                            <label for="register-password">
                                Password <span class="required">*</span>
                            </label>
                            <div class="password-field">
                              <input type="password" class="form-input form-wide" id="register-password" required />
                              <i id="toggle-register-pw" class="fa-regular fa-eye pw-toggle" aria-hidden="true"></i>
                            </div>

                            <label for="user-role">
                                You are a
                            </label>
                            <select class="form-input form-wide" id="user-role" name="role">
                                <option value="customer" selected>Customer</option>
                                <option value="architect">Architect</option>
                                <option value="dealer">Dealer</option>
                            </select>

                            <div id="gstin-wrapper" style="display:none;">
                                <label for="register-gstin">GSTIN <span class="required">*</span></label>
                                <input type="text" class="form-input form-wide" id="register-gstin" maxlength="15" placeholder="Enter 15-digit GSTIN" />
                                <p id="gstin-status" style="margin-top:6px;font-size:14px;"></p>
                            </div>

                            <div class="form-footer mb-1 mt-1">
                                <button type="submit" class="btn register_btn btn-md w-100 mr-0">REGISTER</button>                                        
                            </div>
                            <!-- Custom Google Button -->
                            <div class="social-login mb-1">
                                <button type="button" id="googleCustomLogin" class="google-custom-btn">
                                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
                                <span>Continue with Google</span>
                                </button>
                            </div>

                            <p>Already have an account?
                                <a href="login.php" class="forget-password text-dark form-footer-right">Login</a>
                            </p>
                        </form>

                        <p id="error-message" class="text-danger mt-2" style="display: none;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Styles -->
<style>
  .password-field { position: relative; }
  .pw-toggle {
    position: absolute;
    right: 12px;
    top: 42%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666;
    font-size: 18px;
  }
  .pw-toggle:hover { color: #000; }
  .forget-password{
    color: #00473E !important;
  }
  .register_btn {
    border-radius: 10px !important;
    height: 44px;
    line-height: 44px;
    padding-top: 0;
    padding-bottom: 0;
  }

  .google-custom-btn {
    width: 100%;
    height: 44px;
    border-radius: 10px;
    border: 1px solid #ddd;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: .2s;
  }
  .google-custom-btn img {
    width: 20px;
    height: 20px;
  }
  .google-custom-btn:hover {
    background: #f7f7f7;
    border-color: #ccc;
  }
  .form-input {
    height: 40px;
    border-radius: 5px;
    border: 1px solid #dde2e4;
    padding: 0 10px;
    font-size: 16px;
    letter-spacing: 0.12em;
    margin-bottom: 10px !important;
  }
  .btn-primary {
    background: #00473e;
    border-color: #00473e;
    color: #fff;
    border-radius: 10px;
    padding: 10px 20px;
  }
  .btn-outline-secondary {
    border-radius: 10px;
    padding: 10px 20px;
  }
  label {
    margin: 0px;
    color: #222529;
    font-family: "Open Sans", sans-serif;
    font-size: 14px;
    font-weight: 500;
  }
</style>

<!-- Validate GSTIN -->
<script>
    (function() {
        const userRole   = document.getElementById("user-role"); // changed
        const gstWrap    = document.getElementById("gstin-wrapper");
        const gstInput   = document.getElementById("register-gstin");
        const gstStatus  = document.getElementById("gstin-status");
        const registerBtn = document.querySelector(".register_btn");

        const gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/i;

        userRole.addEventListener("change", function() {
            const role = this.value;
            if (role === "architect" || role === "dealer") {
            gstWrap.style.display = "block";
            } else {
            gstWrap.style.display = "none";
            gstInput.value = "";
            gstStatus.textContent = "";
            registerBtn.disabled = false;
            }
        });

        let debounceTimer;
        gstInput?.addEventListener("input", function() {
            clearTimeout(debounceTimer);
            const gstin = gstInput.value.trim().toUpperCase();
            gstStatus.textContent = "";
            registerBtn.disabled = true;

            if (gstin.length < 15) return; // wait for full GSTIN

            debounceTimer = setTimeout(() => {
            if (!gstRegex.test(gstin)) {
                gstStatus.textContent = "❌ Invalid GSTIN format";
                gstStatus.style.color = "red";
                registerBtn.disabled = true;
                return;
            }

            gstStatus.textContent = "Checking GSTIN validity...";
            gstStatus.style.color = "#555";

            fetch(`https://api.gst.dev/gstin/${gstin}`)
                .then(r => r.json())
                .then(data => {
                if (data?.gstin && data?.tradeName) {
                    gstStatus.textContent = "✅ Valid GSTIN — " + (data.tradeName || "");
                    gstStatus.style.color = "green";
                    registerBtn.disabled = false;
                } else {
                    gstStatus.textContent = "❌ Invalid or not found GSTIN";
                    gstStatus.style.color = "red";
                    registerBtn.disabled = true;
                }
                })
                .catch(err => {
                console.error("GST API error:", err);
                gstStatus.textContent = "⚠️ Unable to verify GSTIN online. Try again.";
                gstStatus.style.color = "orange";
                // you can decide: disable or allow submit
                registerBtn.disabled = false;
                });
            }, 600);
        });
    })();
</script>

<!-- Register User -->
<script>
    function getRegisterErrorMessage(status, data, fallbackMessage) {
        const errors = (data && data.errors) ? data.errors : {};
        const emailMsg = Array.isArray(errors.email) && errors.email.length ? errors.email[0] : "";
        const mobileMsg = Array.isArray(errors.mobile) && errors.mobile.length ? errors.mobile[0] : "";

        if (status === 422) {
            if (emailMsg) return "Email already registered. Please login or use another email.";
            if (mobileMsg) return "Mobile already registered. Please login or use another mobile.";
            return data?.message || fallbackMessage;
        }

        return data?.message || fallbackMessage;
    }

    function parseApiJsonSafe(res) {
        return res.text().then(function(text) {
            try {
                return text ? JSON.parse(text) : {};
            } catch (e) {
                return {};
            }
        });
    }

    document.getElementById("registerForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const name      = document.getElementById("register-name").value.trim();
        const mobile    = document.getElementById("register-mobile").value.trim();
        const email     = document.getElementById("register-email").value.trim();
        const password  = document.getElementById("register-password").value;
        const role      = document.getElementById("user-role").value;
        const gstin     = document.getElementById("register-gstin")?.value?.trim() || "";
        const errorEl   = document.getElementById("error-message");

        // ❗Stop user if Architect/Dealer but no GSTIN entered
        if ((role === "architect" || role === "dealer") && !gstin) {
            errorEl.innerText = "GSTIN is required for Architect/Dealer.";
            errorEl.style.display = "block";
            return;
        }

        const apiUrl = "<?php echo BASE_URL; ?>/register";

        const requestData = {
            auth_provider: "email",
            name,
            mobile,
            email,
            password,
            role
        };

        if ((role === "architect" || role === "dealer") && gstin) {
            requestData.gstin = gstin;
        }

        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(requestData)
        })
        .then(function(res) {
            return parseApiJsonSafe(res).then(function(data) {
                return { status: res.status, ok: res.ok, data: data };
            });
        })
        .then(({ status, ok, data }) => {
            console.log(data);
          // ✅ allow both: {data: {token, user:{...}}} OR {data: {token, name, email, ...}}
          const apiOk = ok || (data.code === 200 || data.code === 201 || data.success);
          const token = data?.data?.token;
          const user  = data?.data?.user || data?.data; 

          if (apiOk && token && user) {
              localStorage.setItem("auth_token", token);
              localStorage.setItem("user_name",  user.name  || "");
              localStorage.setItem("user_email", user.email || "");
              localStorage.setItem("user_mobile", user.mobile || "");
              localStorage.setItem("user_role",  user.role  || "");
              if (user.id) {
                localStorage.setItem("user_id", user.id);
              }

              window.location.href = "index.php";
          } else {
              errorEl.innerText = getRegisterErrorMessage(status, data, "Registration failed.");
              errorEl.style.display = "block";
          }
        })
        .catch(() => {
            errorEl.innerText = "Something went wrong. Try again.";
            errorEl.style.display = "block";
        });
    });
</script>


<!-- Google Custom Button + Popup Flow (Firebase version) -->
<script>
  let pendingGoogleIdToken = null;

  // Re-use your existing helpers
  function setRegisterFormDisabled(disabled) {
    const ids = [
      "register-name",
      "register-email",
      "register-password",
      "register-mobile",
      "user-role",
      "register-gstin"
    ];
    ids.forEach(id => {
      const el = document.getElementById(id);
      if (el) el.disabled = disabled;
    });
    const btn = document.querySelector(".register_btn");
    if (btn) btn.disabled = disabled;
  }

  function openGoogleMobilePopup() {
    const overlay   = document.getElementById("google-mobile-overlay");
    const errorEl   = document.getElementById("google-mobile-error");
    const inputMob  = document.getElementById("google-mobile-input");
    const gstStatus = document.getElementById("google-gstin-status");

    if (!overlay || !inputMob || !errorEl) return;

    errorEl.style.display = "none";
    errorEl.textContent   = "";
    gstStatus.textContent = "";

    inputMob.value = "";
    overlay.style.display = "flex";
    inputMob.focus();
  }

  function closeGoogleMobilePopup() {
    const overlay = document.getElementById("google-mobile-overlay");
    if (overlay) overlay.style.display = "none";
    setRegisterFormDisabled(false);
    pendingGoogleIdToken = null;
  }

  document.addEventListener("DOMContentLoaded", function () {
    // 🔹 Prepare Google provider (Firebase)
    const provider = new firebase.auth.GoogleAuthProvider();
    provider.setCustomParameters({ prompt: "select_account" });

    const googleBtn  = document.getElementById("googleCustomLogin");

    if (googleBtn) {
      googleBtn.disabled = false;           // no need to wait for GIS now
      googleBtn.style.opacity = "";
      googleBtn.style.cursor = "pointer";

      googleBtn.addEventListener("click", function () {
        // 🔥 Sign in with Google via Firebase popup
        firebase.auth().signInWithPopup(provider)
          .then(async (result) => {
            try {
              // 🔥 Get the Google ID token from the signed-in user
              const idToken = await result.user.getIdToken(/* forceRefresh = */ true);

              if (!idToken) {
                console.error("No idToken returned from result.user.getIdToken()", result);
                alert("Unable to complete Google sign-in. Please try again.");
                return;
              }

              // Store it so the popup can send to your PHP backend
              pendingGoogleIdToken = idToken;

              setRegisterFormDisabled(true);
              openGoogleMobilePopup();
            } catch (e) {
              console.error("Error getting ID token from Firebase user:", e);
              alert("Unable to complete Google sign-in. Please try again.");
            }
          })
          .catch((err) => {
            console.error("Firebase Google sign-in error:", err.code, err.message, err);
            alert("Google sign-in failed. Please try again.");
          });
      });
    }

    // ------------- POPUP LOGIC (same as before, just re-used) -------------
    const btnCancel  = document.getElementById("google-mobile-cancel");
    const btnSubmit  = document.getElementById("google-mobile-submit");
    const inputMob   = document.getElementById("google-mobile-input");
    const errorEl    = document.getElementById("google-mobile-error");
    const roleSelect = document.getElementById("google-role");
    const gstWrapper = document.getElementById("google-gstin-wrapper");
    const gstInput   = document.getElementById("google-gstin");
    const gstStatus  = document.getElementById("google-gstin-status");
    const gstRegex   = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/i;

    let gstDebounceTimer;
    let isPopupGstinValid = false;

    function setPopupSubmitDisabled(disabled) {
      if (btnSubmit) btnSubmit.disabled = disabled;
    }

    // Role change inside popup
    if (roleSelect) {
      roleSelect.addEventListener("change", function () {
        const role = this.value;
        if (role === "architect" || role === "dealer") {
          gstWrapper.style.display = "block";
          isPopupGstinValid = false;
          gstStatus.textContent = "";
          gstStatus.style.color = "";
          setPopupSubmitDisabled(false);
        } else {
          gstWrapper.style.display = "none";
          if (gstInput) gstInput.value = "";
          if (gstStatus) {
            gstStatus.textContent = "";
            gstStatus.style.color = "";
          }
          isPopupGstinValid = true;
          setPopupSubmitDisabled(false);
        }
      });
      roleSelect.dispatchEvent(new Event("change"));
    }

    // GSTIN validation in popup
    if (gstInput) {
      gstInput.addEventListener("input", function () {
        clearTimeout(gstDebounceTimer);

        const role = roleSelect?.value || "customer";
        const raw  = (gstInput.value || "").trim().toUpperCase();

        gstStatus.textContent = "";
        isPopupGstinValid = false;

        if (role !== "architect" && role !== "dealer") {
          return;
        }

        setPopupSubmitDisabled(true);

        if (raw.length < 15) {
          gstStatus.textContent = "";
          return;
        }

        gstDebounceTimer = setTimeout(() => {
          if (!gstRegex.test(raw)) {
            gstStatus.textContent = "❌ Invalid GSTIN format";
            gstStatus.style.color = "red";
            isPopupGstinValid = false;
            setPopupSubmitDisabled(true);
            return;
          }

          gstStatus.textContent = "Checking GSTIN validity...";
          gstStatus.style.color = "#555";

          fetch(`https://api.gst.dev/gstin/${raw}`)
            .then(r => r.json())
            .then(data => {
              if (data?.gstin && data?.tradeName) {
                gstStatus.textContent = "✅ Valid GSTIN — " + (data.tradeName || "");
                gstStatus.style.color = "green";
                isPopupGstinValid = true;
                setPopupSubmitDisabled(false);
              } else {
                gstStatus.textContent = "❌ Invalid or not found GSTIN";
                gstStatus.style.color = "red";
                isPopupGstinValid = false;
                setPopupSubmitDisabled(true);
              }
            })
            .catch(err => {
              console.error("GST API error (popup):", err);
              gstStatus.textContent = "⚠️ Unable to verify GSTIN online. Try again.";
              gstStatus.style.color = "orange";
              isPopupGstinValid = true;  // allow submit on network error
              setPopupSubmitDisabled(false);
            });
        }, 600);
      });
    }

    if (btnCancel) {
      btnCancel.addEventListener("click", function () {
        closeGoogleMobilePopup();
      });
    }

    function submitGoogleWithMobile() {
      if (!pendingGoogleIdToken) {
        console.error("No pending Google token");
        errorEl.textContent = "Google sign-in not completed. Please click the button again.";
        errorEl.style.display = "block";
        return;
      }

      const mobile = (inputMob.value || "").trim();
      const role   = roleSelect?.value || "customer";
      const gstin  = (gstInput?.value || "").trim().toUpperCase();

      if (!mobile || mobile.length < 10) {
        errorEl.textContent = "Please enter a valid mobile number.";
        errorEl.style.display = "block";
        return;
      }

      if (role === "architect" || role === "dealer") {
        if (!gstin) {
          errorEl.textContent = "GSTIN is required for Architect/Dealer.";
          errorEl.style.display = "block";
          return;
        }
        if (!gstRegex.test(gstin) || !isPopupGstinValid) {
          errorEl.textContent = "Please enter a valid GSTIN.";
          errorEl.style.display = "block";
          return;
        }
      }

      const apiUrl = "<?php echo BASE_URL; ?>/register";

      const body = {
        auth_provider: "google",
        idToken: pendingGoogleIdToken,   // 🔥 from Firebase + Google
        mobile: mobile,
        role: role
      };
      if (role === "architect" || role === "dealer") {
        body.gstin = gstin;
      }

      btnSubmit.disabled = true;
      errorEl.style.display = "none";

      fetch(apiUrl, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        body: JSON.stringify(body)
      })
      .then(function(res) {
        return parseApiJsonSafe(res).then(function(data) {
          return { status: res.status, ok: res.ok, data: data };
        });
      })
      .then(({ status, ok, data }) => {
        console.log("Google register API Response:", data);
        btnSubmit.disabled = false;

        const apiOk = ok || (data.code === 200 || data.code === 201 || data.success);
        const token = data?.data?.token;
        const user  = data?.data?.user || data?.data;

        if (apiOk && token && user) {
            localStorage.setItem("auth_token", token);
            localStorage.setItem("user_name",  user.name  || "");
            localStorage.setItem("user_email", user.email || "");
            localStorage.setItem("user_mobile", user.mobile || "");
            localStorage.setItem("user_role",  user.role  || "");
            if (user.id) {
              localStorage.setItem("user_id", user.id);
            }

            window.location.href = "index.php";
        } else {
            errorEl.textContent = getRegisterErrorMessage(status, data, "Google registration failed.");
            errorEl.style.display = "block";
        }
      })
      .catch(err => {
        console.error("Google register error:", err);
        btnSubmit.disabled = false;
        errorEl.textContent = "Something went wrong with Google sign-in.";
        errorEl.style.display = "block";
      });
    }

    if (btnSubmit) {
      btnSubmit.addEventListener("click", submitGoogleWithMobile);
    }
    if (inputMob) {
      inputMob.addEventListener("keyup", function (e) {
        if (e.key === "Enter") submitGoogleWithMobile();
      });
    }
  });
</script>


<script>
  (function () {
    const pw = document.getElementById('register-password');
    const toggle = document.getElementById('toggle-register-pw');
    if (!pw || !toggle) return;

    toggle.addEventListener('click', function () {
      const showing = pw.type === 'text';
      pw.type = showing ? 'password' : 'text';
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  })();
</script>

<!-- 🔹 Simple overlay popup for Google Mobile -->

<div id="google-mobile-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:9999; justify-content:center; align-items:center;">
  <div style="background:#fff; padding:20px 24px; border-radius:10px; max-width:380px; width:90%; box-shadow:0 10px 30px rgba(0,0,0,0.2);">
    
    <h4 style="margin-top:0; margin-bottom:10px;">Complete Google Signup</h4>
    <p style="font-size:14px; color:#555; margin-bottom:12px;">
      Please enter your mobile number and details to complete registration.
    </p>

    <!-- Mobile -->
    <label for="google-mobile-input">
      Mobile <span style="color:red">*</span>
    </label>
    <input type="tel" id="google-mobile-input" class="form-input form-wide" placeholder="Enter mobile number" />

    <!-- Role -->
    <label for="google-role" style="margin-top:12px;">
      You are a
    </label>
    <select id="google-role" class="form-input form-wide">
      <option value="customer" selected>Customer</option>
      <option value="architect">Architect</option>
      <option value="dealer">Dealer</option>
    </select>

    <!-- GSTIN (only for architect / dealer) -->
    <div id="google-gstin-wrapper" style="display:none; margin-top:10px;">
      <label for="google-gstin">
        GSTIN <span style="color:red">*</span>
      </label>
      <input type="text"
             id="google-gstin"
             class="form-input form-wide"
             maxlength="15"
             placeholder="Enter 15-digit GSTIN" />
      <p id="google-gstin-status" style="margin-top:6px;font-size:13px;"></p>
    </div>

    <p id="google-mobile-error" style="display:none; margin-top:8px; font-size:13px; color:red;"></p>

    <div style="margin-top:16px; display:flex; gap:10px; justify-content:flex-end;">
      <button type="button" id="google-mobile-cancel" class="btn btn-sm btn-outline-secondary">
        Cancel
      </button>
      <button type="button" id="google-mobile-submit" class="btn btn-sm btn-primary">
        Continue
      </button>
    </div>
  </div>
</div>


<?php include("footer.php"); ?>
