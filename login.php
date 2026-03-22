<?php include("header.php"); ?>
<script>
/** Relative in-app path only (e.g. profile.php#address); blocks open redirects */
window.haneriGetSafeRedirect = function () {
    try {
        var raw = new URLSearchParams(window.location.search).get("redirect");
        if (!raw) return null;
        var decoded = decodeURIComponent(raw);
        if (/^https?:/i.test(decoded)) return null;
        if (decoded.indexOf("://") !== -1) return null;
        if (!String(decoded).trim()) return null;
        if (/^(javascript|data|vbscript):/i.test(decoded.trim())) return null;
        return decoded;
    } catch (e) {
        return null;
    }
};
(function () {
    try {
        if (localStorage.getItem("auth_token")) {
            var next = window.haneriGetSafeRedirect() || "profile.php";
            window.location.replace(next);
        }
    } catch (e) {}
})();
</script>
<?php include("configs/config.php"); ?> 
<!-- Firebase App (core) -->
<script src="https://www.gstatic.com/firebasejs/10.13.2/firebase-app-compat.js"></script>
<!-- Firebase Auth -->
<script src="https://www.gstatic.com/firebasejs/10.13.2/firebase-auth-compat.js"></script>

<script>
  // PHP array → JS object
  const firebaseConfig = <?php echo json_encode($FIREBASE_CONFIG, JSON_UNESCAPED_SLASHES); ?>;

  // Initialize Firebase once
  if (!firebase.apps.length) {
      firebase.initializeApp(firebaseConfig);
  }
</script>

<main class="main">
    <div class="page-header"></div>
    <div class="container login-container padding_top_100">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="login_reg_container">
                    <div class="col-md-6">
                        <div class="heading mb-1">
                            <h2 class="title">Login</h2>
                        </div>

                        <form id="loginForm">
                            <label for="login-email">
                                Username or email address <span class="required">*</span>
                            </label>
                            <input type="email" class="form-input form-wide" id="login-email" required />

                            <div class="password-field">
                                <label for="login-password">
                                    Password <span class="required">*</span>
                                </label>
                                <input type="password" class="form-input form-wide" id="login-password" required />
                                <i id="toggle-pw" class="fa-regular fa-eye pw-toggle" aria-hidden="true"></i>
                            </div>

                            <div class="form-footer form-footer-inline">
                              <div class="custom-control custom-checkbox mb-0">
                                  <input type="checkbox" class="custom-control-input" id="remember-me" />
                                  <label class="custom-control-label mb-0" for="remember-me">Remember me</label>
                              </div>
                              <a href="forget-password.php" class="forget-password text-dark">
                                  Forgot Password?
                              </a>
                            </div>
                            <button type="submit" class="btn login_btn btn-md w-100 mb-1">LOGIN</button>

                            <br>

                            <!-- OTP Login Button -->
                            <div class="social-login mb-1">
                                <button type="button" id="otpLoginBtn" class="otp-btn">
                                    Login with OTP
                                </button>
                            </div>

                            <!-- Custom Google Button -->
                            <div class="social-login">
                                <button type="button" id="googleCustomLogin" class="google-custom-btn">
                                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google">
                                    <span>Continue With Google</span>
                                </button>
                            </div>

                            <br>
                            <p class="">
                                Don't have an account yet?
                                <a href="register.php" class="forget-password text-dark form-footer-right">
                                    Register
                                </a>
                            </p>
                        </form>

                        <p id="error-message" class="text-danger mt-2" style="display: none;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
  .form-footer-inline {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 2rem;
    margin-top: 2rem;
  }
  input[type="checkbox"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #ccc;
    border-radius: 3px;
    background-color: #fff;
    /* position: relative; */
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }
  .form-footer-inline .custom-control {
    display: flex;
    align-items: center;
    gap: 0px;
    margin-top: 0rem;
    padding-left: 1rem;
  }

  .form-footer-inline .forget-password {
    margin-left: auto;
    font-size: 13px;
    white-space: nowrap;
  }

  :root {
    --primary-green: #005d5a;
    --login-font: "Barlow Condensed", ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  }

  .password-field {
    position: relative;
  }
  .pw-toggle {
    position: absolute;
    right: 12px;
    top: 58%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666;
    font-size: 18px;
  }
  .pw-toggle:hover {
    color: #000;
  }
  .forget-password {
    color: #005d5a !important;
  }
  .login_btn {
    border-radius: 10px !important;
    background: var(--primary-green);
    border-color: var(--primary-green);
  }
  .login_btn:hover {
    background: #00352f;
    border-color: #00352f;
  }

  .social-login {
    margin: 0px;
    width: 100%;
  }

  .google-custom-btn {
    width: 100%;
    height: 40px;
    background: #fff;
    border: 1px solid #dadce0;
    border-radius: 10px;       /* Same as login_btn */
    font-size: 16px;
    font-weight: 500;
    color: #444;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    cursor: pointer;
    transition: 0.2s ease;
  }
  .google-custom-btn img {
    width: 22px;
  }
  .google-custom-btn:hover {
    background: #f7f7f7;
    border-color: #c6c6c6;
  }

  /* OTP main button */
  .otp-btn {
    width: 100%;
    height: 40px;
    border-radius: 10px;
    border: 1px solid #dadce0;
    /*background: var(--primary-green);*/
    font-size: 15px;
    font-weight: 500;
    color: #000;
    cursor: pointer;
    transition: 0.2s ease;
  }
  .otp-btn:hover {
    background: #000000ba;
    border-color: #00352f;
    color:#fff;
  }

  /* Overlays for OTP */
  .otp-overlay {
    display: none;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0,0,0,0.4);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    padding: 16px;
    box-sizing: border-box;
  }
  .otp-modal {
    background: #fff;
    padding: 22px 24px;
    border-radius: 14px;
    max-width: 420px;
    width: 100%;
    margin: 0 auto;
    box-shadow: 0 18px 40px rgba(0,0,0,0.25);
    border-top: 4px solid var(--primary-green);
    box-sizing: border-box;
  }
  .otp-modal h4 {
    margin-top: 0;
    margin-bottom: 6px;
    font-size: 18px;
    font-weight: 600;
    color: #222;
  }
  .otp-modal p {
    margin-bottom: 8px;
    font-size: 14px;
    color: #555;
  }
  .otp-subtext {
    font-size: 12px;
    color: #888;
    margin-bottom: 14px;
  }
  .otp-actions {
    margin-top: 16px;
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    align-items: center;
  }

  .otp-prefix {
    display: flex;
    align-items: center;
    gap: 0;
    width: 100%;
    margin-top: 4px;
    border: 1px solid #dde2e4;
    border-radius: 8px;
    overflow: hidden;
    background: #fff;
  }
  .otp-prefix span {
    padding: 0 12px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    background: #f7f7f7;
    border-right: 1px solid #dde2e4;
    font-size: 14px;
    font-weight: 600;
    color: #333;
    letter-spacing: normal;
  }
  .otp-prefix input {
    flex: 1;
    height: 40px;
    border: none;
    padding: 0 10px;
    font-size: 15px;
    letter-spacing: 0.02em;
    outline: none;
    margin-bottom: 0 !important;
  }
  #otp-mobile-cancel{
    border-radius: 10px;
    padding: 10px 20px;
  }

  /* OTP code inputs */
  .otp-input-wrapper {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 10px;
  }
  .otp-input {
    width: 40px;
    height: 45px;
    font-size: 20px;
    text-align: center;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
    font-family: var(--login-font);
    transition: 0.15s;
    letter-spacing: 0.12em;   /* 🔹 letter spacing between digits */
  }
  .otp-input:focus {
    border-color: var(--primary-green);
    box-shadow: 0 0 0 1px #005d5a1c;
  }

  .otp-link-btn {
    background: transparent;
    border: none;
    color: #555;
    font-size: 13px;
    text-decoration: underline;
    cursor: pointer;
    padding: 0;
  }

  .otp-primary-btn {
    background: var(--primary-green);
    border-color: var(--primary-green);
    color: #fff;
    border-radius: 10px;
    padding: 10px 20px;
  }
  .otp-primary-btn:hover {
    background: #00352f;
    border-color: #00352f;
  }

  .otp-mobile-display-text {
    font-size: 13px;
    color: #777;
  }
  .otp-change-link {
    display: inline-block;
    margin-top: 2px;
    font-size: 12px;
    color: var(--primary-green);
    text-decoration: underline;
    cursor: pointer;
  }
  label {
    margin: 0px;
    color: #222529;
    font-family: "Open Sans", sans-serif;
    font-size: 14px;
    font-weight: 500;
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
  @media (max-width: 520px) {
    .otp-modal {
      max-width: 100%;
      padding: 18px 16px;
    }
    .otp-actions {
      gap: 8px;
    }
  }
</style>

<script>
  const API_BASE = "<?php echo BASE_URL; ?>";

  function handleLoginSuccessFromApi(data, errEl) {
      const ok    = (data.code === 200 || data.code === 201 || data.success);
      const token = data?.data?.token;
      const user  = data?.data?.user || data?.data;

      if (!ok || !token || !user) {
          if (errEl) {
              errEl.innerText = data.message || "Login failed. Please try again.";
              errEl.style.display = "block";
          }
          return false;
      }

      // Store in localStorage
      localStorage.setItem("auth_token", token);
      localStorage.setItem("user_name",  user.name   || "");
      localStorage.setItem("user_email", user.email  || "");
      localStorage.setItem("user_mobile", user.mobile || "");
      localStorage.setItem("user_role",  user.role   || "");
      if (user.id) {
          localStorage.setItem("user_id", user.id);
      }

      const afterLogin = (typeof window.haneriGetSafeRedirect === "function")
          ? window.haneriGetSafeRedirect()
          : null;
      if (afterLogin) {
          window.location.href = afterLogin;
          return true;
      }

      // Redirect by role
      const role = user.role || "";
      if (role === "admin") {
          window.location.href = "admin/index.php";
      } else if (["customer", "vendor", "architect", "dealer"].includes(role)) {
          window.location.href = "index.php";
      } else {
          window.location.href = "index.php";
      }

      return true;
  }

  // ---------- EMAIL + PASSWORD LOGIN ----------
  document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const email    = document.getElementById("login-email").value.trim();
      const password = document.getElementById("login-password").value;
      const remember = document.getElementById("remember-me").checked;
      const errEl    = document.getElementById("error-message");

      errEl.style.display = "none";
      errEl.innerText = "";

      if (!email || !password) {
          errEl.innerText = "Please enter both email and password.";
          errEl.style.display = "block";
          return;
      }

      fetch(API_BASE + "/login", {
          method: "POST",
          headers: {
              "Content-Type": "application/json",
              "Accept": "application/json"
          },
          body: JSON.stringify({
              auth_provider: "email",
              email: email,
              password: password,
              remember_me: remember ? 1 : 0
          })
      })
      .then(res => res.json())
      .then(data => {
          console.log("Email LOGIN API response:", data);
          handleLoginSuccessFromApi(data, errEl);
      })
      .catch(err => {
          console.error("Email login error:", err);
          errEl.innerText = "Something went wrong. Please try again.";
          errEl.style.display = "block";
      });
  });
</script>

<!-- ---------- GOOGLE LOGIN (FIREBASE POPUP) ---------- -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
      const errEl = document.getElementById("error-message");
      const googleBtn = document.getElementById("googleCustomLogin");

      if (!googleBtn) return;

      // Prepare Firebase Google provider
      const provider = new firebase.auth.GoogleAuthProvider();
      provider.setCustomParameters({ prompt: "select_account" });

      googleBtn.addEventListener("click", function () {
          errEl.style.display = "none";
          errEl.innerText = "";

          firebase.auth().signInWithPopup(provider)
              .then(async (result) => {
                  try {
                      const idToken = await result.user.getIdToken(true);

                      if (!idToken) {
                          console.error("No idToken from Firebase user");
                          errEl.innerText = "Unable to complete Google login. Please try again.";
                          errEl.style.display = "block";
                          return;
                      }

                      const user  = result.user;
                      const email = user.email;
                      const name  = user.displayName || "";
                      const uid   = user.uid;

                      if (!email) {
                          errEl.innerText = "Google did not return an email address. Please use email login.";
                          errEl.style.display = "block";
                          return;
                      }

                      return fetch(API_BASE + "/login", {
                          method: "POST",
                          headers: {
                              "Content-Type": "application/json",
                              "Accept": "application/json"
                          },
                          body: JSON.stringify({
                              auth_provider: "google",
                              idToken: idToken,
                              email: email,
                              name: name,
                              google_uid: uid
                          })
                      });
                  } catch (e) {
                      console.error("Error getting ID token from Firebase user:", e);
                      errEl.innerText = "Unable to complete Google login. Please try again.";
                      errEl.style.display = "block";
                  }
              })
              .then(res => {
                  if (!res) return;
                  return res.json();
              })
              .then(data => {
                  if (!data) return;
                  console.log("Google LOGIN API response:", data);
                  handleLoginSuccessFromApi(data, errEl);
              })
              .catch(err => {
                  console.error("Google login error:", err);
                  errEl.innerText = "Something went wrong during Google login.";
                  errEl.style.display = "block";
              });
      });
  });
</script>

<!-- ---------- OTP LOGIN POPUPS & LOGIC ---------- -->
<!-- Mobile Popup -->
<div id="otp-mobile-overlay" class="otp-overlay">
  <div class="otp-modal">
    <h4>Login using OTP</h4>
    <p>Enter your mobile number to receive a secure 6-digit code.</p>
    <p class="otp-subtext">We’ll send the OTP on WhatsApp/SMS to your number.</p>

    <label for="otp-mobile-input" style="font-size:13px; font-weight:500; color:#444;">
      Mobile Number
    </label>
    <div class="otp-prefix">
      <span>+91</span>
      <input type="tel" id="otp-mobile-input" class="form-input form-wide" placeholder="9876543210" />
    </div>

    <p id="otp-mobile-error" style="display:none; margin-top:8px; font-size:13px; color:red;"></p>

    <div class="otp-actions">
      <button type="button" id="otp-mobile-cancel" class="btn btn-sm btn-outline-secondary">
        Cancel
      </button>
      <button type="button" id="otp-mobile-continue" class="btn btn-sm otp-primary-btn">
        Send OTP
      </button>
    </div>
  </div>
</div>

<!-- OTP Code Popup -->
<div id="otp-code-overlay" class="otp-overlay">
  <div class="otp-modal">
    <h4>Enter OTP</h4>
    <p>We have sent a 6-digit code to your mobile number.</p>
    <p id="otp-mobile-display" class="otp-mobile-display-text"></p>
    <span id="otp-change-link" class="otp-change-link">Change number</span>

    <div class="otp-input-wrapper">
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
      <input type="text" maxlength="1" class="otp-input" />
    </div>

    <p id="otp-code-error" style="display:none; margin-top:8px; font-size:13px; color:red;"></p>

    <div class="otp-actions">
      <button type="button" id="otp-code-resend" class="otp-link-btn">
        Resend OTP
      </button>
      <button type="button" id="otp-code-submit" class="btn btn-sm otp-primary-btn">
        Verify
      </button>
    </div>
  </div>
</div>

<script>
  let otpMobile = ""; // will store the 10-digit mobile

  (function initOtpLogin() {
    const otpLoginBtn       = document.getElementById("otpLoginBtn");
    const mobileOverlay     = document.getElementById("otp-mobile-overlay");
    const mobileInput       = document.getElementById("otp-mobile-input");
    const mobileError       = document.getElementById("otp-mobile-error");
    const mobileCancelBtn   = document.getElementById("otp-mobile-cancel");
    const mobileContinueBtn = document.getElementById("otp-mobile-continue");

    const codeOverlay       = document.getElementById("otp-code-overlay");
    const codeInputs        = codeOverlay.querySelectorAll(".otp-input");
    const codeError         = document.getElementById("otp-code-error");
    const codeResendBtn     = document.getElementById("otp-code-resend");
    const codeSubmitBtn     = document.getElementById("otp-code-submit");
    const mobileDisplayEl   = document.getElementById("otp-mobile-display");
    const changeLink        = document.getElementById("otp-change-link");

    if (!otpLoginBtn) return;

    function openMobilePopup() {
      mobileError.style.display = "none";
      mobileError.innerText = "";
      mobileInput.value = "";
      otpMobile = "";
      mobileOverlay.style.display = "flex";
      mobileInput.focus();
    }

    function closeMobilePopup() {
      mobileOverlay.style.display = "none";
    }

    function openCodePopup() {
      codeError.style.display = "none";
      codeError.innerText = "";
      codeInputs.forEach(input => input.value = "");
      codeOverlay.style.display = "flex";
      if (mobileDisplayEl && otpMobile) {
        const pretty = otpMobile.replace(/(\d{5})(\d{5})/, "$1 $2");
        mobileDisplayEl.textContent = "Sent to +91 " + pretty;
      }
      if (codeInputs[0]) codeInputs[0].focus();
    }

    function closeCodePopup() {
      codeOverlay.style.display = "none";
    }

    otpLoginBtn.addEventListener("click", openMobilePopup);

    if (mobileCancelBtn) {
      mobileCancelBtn.addEventListener("click", function() {
        closeMobilePopup();
      });
    }

    function sendOtpToMobile() {
      mobileError.style.display = "none";
      mobileError.innerText = "";

      const raw = (mobileInput.value || "").trim();
      // simple 10 digit validation
      if (!/^[0-9]{10}$/.test(raw)) {
        mobileError.innerText = "Please enter a valid 10-digit mobile number.";
        mobileError.style.display = "block";
        return;
      }

      otpMobile = raw; // keep 10-digit, API expects "9876543210"

      mobileContinueBtn.disabled = true;

      fetch(API_BASE + "/generate-otp", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        body: JSON.stringify({ mobile: otpMobile })
      })
      .then(res => res.json())
      .then(data => {
        console.log("Generate OTP response:", data);
        const ok = (data.code === 200 || data.success);

        if (!ok) {
          mobileError.innerText = data.message || "Unable to send OTP. Please try again.";
          mobileError.style.display = "block";
        } else {
          closeMobilePopup();
          openCodePopup();
        }
      })
      .catch(err => {
        console.error("Generate OTP error:", err);
        mobileError.innerText = "Something went wrong. Please try again.";
        mobileError.style.display = "block";
      })
      .finally(() => {
        mobileContinueBtn.disabled = false;
      });
    }

    if (mobileContinueBtn) {
      mobileContinueBtn.addEventListener("click", sendOtpToMobile);
    }

    // OTP inputs behaviour
    codeInputs.forEach((input, idx) => {
        input.addEventListener("input", function(e) {
            const val = this.value.replace(/\D/g, "");
            this.value = val.slice(-1); // keep only last digit

            // move to next box if this one got a digit
            if (val && idx < codeInputs.length - 1) {
            codeInputs[idx + 1].focus();
            }

            // 🔥 NEW: auto submit when all 6 are filled
            const fullOtp = Array.from(codeInputs).map(i => i.value).join("");
            if (fullOtp.length === codeInputs.length) {
            submitOtpCode();   // uses the same function as Verify button
            }
        });

        input.addEventListener("keydown", function(e) {
            if (e.key === "Backspace" && !this.value && idx > 0) {
            codeInputs[idx - 1].focus();
            }
        });

        input.addEventListener("paste", function(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData("text").replace(/\D/g, "");
            if (!text) return;
            for (let i = 0; i < codeInputs.length; i++) {
            codeInputs[i].value = text[i] || "";
            }
            if (text.length >= codeInputs.length) {
            codeInputs[codeInputs.length - 1].focus();
            // optional: auto submit on paste as well
            const fullOtp = Array.from(codeInputs).map(i => i.value).join("");
            if (fullOtp.length === codeInputs.length) {
                submitOtpCode();
            }
            }
        });
    });


    // Change number link
    if (changeLink) {
      changeLink.addEventListener("click", function() {
        closeCodePopup();
        openMobilePopup();
      });
    }

    // Resend OTP
    if (codeResendBtn) {
      codeResendBtn.addEventListener("click", function() {
        if (!otpMobile) {
          codeError.innerText = "Mobile number is missing. Please go back and enter your number.";
          codeError.style.display = "block";
          return;
        }

        codeError.style.display = "none";
        codeError.innerText = "";
        codeResendBtn.disabled = true;

        fetch(API_BASE + "/generate-otp", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
          },
          body: JSON.stringify({ mobile: otpMobile })
        })
        .then(res => res.json())
        .then(data => {
          console.log("Resend OTP response:", data);
          const ok = (data.code === 200 || data.success);
          if (!ok) {
            codeError.innerText = data.message || "Unable to resend OTP. Please try again.";
            codeError.style.display = "block";
          }
        })
        .catch(err => {
          console.error("Resend OTP error:", err);
          codeError.innerText = "Something went wrong. Please try again.";
          codeError.style.display = "block";
        })
        .finally(() => {
          codeResendBtn.disabled = false;
        });
      });
    }

    function submitOtpCode() {
      codeError.style.display = "none";
      codeError.innerText = "";

      const otp = Array.from(codeInputs).map(i => i.value).join("");
      if (otp.length !== 6) {
        codeError.innerText = "Please enter the 6-digit OTP.";
        codeError.style.display = "block";
        return;
      }

      if (!otpMobile) {
        codeError.innerText = "Mobile number is missing. Please try again.";
        codeError.style.display = "block";
        return;
      }

      codeSubmitBtn.disabled = true;

      // Hit: {{base_url}}/login/123456  (POST)
      fetch(API_BASE + "/login/" + otp, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json"
        },
        body: JSON.stringify({ mobile: otpMobile })
      })
      .then(res => res.json())
      .then(data => {
        console.log("OTP LOGIN response:", data);
        const ok = handleLoginSuccessFromApi(data, codeError);
        if (!ok) {
          codeError.style.display = "block";
        }
      })
      .catch(err => {
        console.error("OTP login error:", err);
        codeError.innerText = "Something went wrong. Please try again.";
        codeError.style.display = "block";
      })
      .finally(() => {
        codeSubmitBtn.disabled = false;
      });
    }

    if (codeSubmitBtn) {
      codeSubmitBtn.addEventListener("click", submitOtpCode);
    }

    // Enter key support inside OTP inputs
    codeInputs.forEach(input => {
      input.addEventListener("keyup", function(e) {
        if (e.key === "Enter") {
          submitOtpCode();
        }
      });
    });
  })();
</script>

<script>
  // Password show/hide
  (function () {
      const pw = document.getElementById('login-password');
      const toggle = document.getElementById('toggle-pw');
      if (!pw || !toggle) return;

      toggle.addEventListener('click', function () {
          const showing = pw.type === 'text';
          pw.type = showing ? 'password' : 'text';
          this.classList.toggle('fa-eye');
          this.classList.toggle('fa-eye-slash');
      });
  })();
</script>

<?php include("footer.php"); ?>
