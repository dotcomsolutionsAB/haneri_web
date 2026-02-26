<?php include("header.php"); ?>
<?php include("configs/config.php"); ?> 

<main class="main">
  <div class="page-header"></div>
  <div class="container login-container padding_top_100">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="login_reg_container forget_password_page">
          <div class="col-md-6">
            <div class="heading mb-1">
              <h2 class="title">Forget Password</h2>
            </div>

            <p>
              <strong>Lost your password?</strong><br>
              Please enter your username or email address. You will receive a link to create a new password via email.
            </p>

            <form id="loginForm">
              <label for="reset-email">
                Username or email address <span class="required">*</span>
              </label>
              <input type="email" class="form-input form-wide" id="reset-email" name="reset-email" required />

              <div class="form-footer">
                Remember Password?
                <a href="login.php" class="forget-password text-dark form-footer-right pr-1">Login </a> here
              </div>

              <button type="submit" id="resetBtn" class="btn reset_btn btn-md w-100 mb-2">Reset Password</button>
              <br>
            </form>

            <!-- Status message -->
            <div id="status-message" class="mt-0" style="display:none;"></div>

            <!-- Temporary password box -->
            <div id="tempPwBox" style="display:none;" class="mt-1 mb-2 p-3 border rounded" role="alert">
              <strong>Temporary Password Generated</strong>
              <p class="mb-2" style="margin-top:6px;">
                Please copy the password. This is auto-generated for security reasons.
                Change your password after login. Thank you.
              </p>
              <div style="display:flex;gap:8px;align-items:center;">
                <input type="text" id="tempPwInput" readonly style="flex:0 0 220px; margin-bottom: 0rem;" class="form-control">
                <button type="button" id="copyTempPw" class="btn btn-outline-dark">Copy</button>
                <span id="pwCountdown" class="text-muted" style="font-size:10px;"></span>
              </div>
            </div>

            <p id="error-message" class="text-danger mt-2" style="display:none;"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include("footer.php"); ?>
<style>
    .forget_password_page form {
        margin-bottom: 0rem;
    }
    .forget_password_page .alert {
        margin-bottom: 0rem;
    }
    .forget_password_page .form-footer {
        margin-bottom: 1rem;
    }
    #tempPwBox{
        border-radius: 10px !important;
    }
    .alert {
        display: flex;
        align-items: center;
        font-family: "Open Sans", sans-serif;
        margin-bottom: 1rem !important;
        padding: 1.6rem 1.5rem;
        border-radius: 10px;
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
    label {
        margin: 0px;
        color: #222529;
        font-family: "Open Sans", sans-serif;
        font-size: 14px;
        font-weight: 500;
    }
    .reset_btn {
        border-radius: 10px !important;
        background: #00473e;
        border-color: #00473e;
    }
    .forget-password {
        color: #00473E !important;
    }
</style>
<script>
(function () {
  const API_BASE = "<?php echo isset($base_url) ? $base_url : (defined('BASE_URL') ? BASE_URL : ''); ?>";
  const form = document.getElementById('loginForm');
  const emailInput = document.getElementById('reset-email');
  const btn = document.getElementById('resetBtn');

  const statusMsg = document.getElementById('status-message');
  const errMsg = document.getElementById('error-message');

  const tempPwBox = document.getElementById('tempPwBox');
  const tempPwInput = document.getElementById('tempPwInput');
  const copyBtn = document.getElementById('copyTempPw');
  const countdownEl = document.getElementById('pwCountdown');

  let hideTimer = null, countdownTimer = null;

  function showStatus(html, type = 'success') {
    statusMsg.style.display = 'block';
    statusMsg.className = `mt-0 alert alert-${type}`;
    statusMsg.innerHTML = html;
  }
  function hideStatus() {
    statusMsg.style.display = 'none';
    statusMsg.className = 'mt-2';
    statusMsg.innerHTML = '';
  }
  function showError(text) {
    errMsg.style.display = 'block';
    errMsg.textContent = text;
  }
  function hideError() {
    errMsg.style.display = 'none';
    errMsg.textContent = '';
  }

  async function copyToClipboard(text) {
    try {
      if (navigator.clipboard && window.isSecureContext) {
        await navigator.clipboard.writeText(text);
        return true;
      }
    } catch (_) {}
    // Fallback
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.setAttribute('readonly', '');
    ta.style.position = 'fixed';
    ta.style.left = '-9999px';
    document.body.appendChild(ta);
    ta.select();
    ta.setSelectionRange(0, ta.value.length);
    const ok = document.execCommand('copy');
    document.body.removeChild(ta);
    return ok;
  }

  function showTempPassword(pw, seconds = 30) {
    tempPwInput.value = pw;
    tempPwBox.style.display = 'block';

    // start countdown
    let remaining = seconds;
    countdownEl.textContent = `Closes in ${remaining}s`;
    clearInterval(countdownTimer);
    countdownTimer = setInterval(() => {
      remaining -= 1;
      if (remaining <= 0) {
        clearInterval(countdownTimer);
        tempPwBox.style.display = 'none';
        return;
      }
      countdownEl.textContent = `Closes in ${remaining}s`;
    }, 1000);

    clearTimeout(hideTimer);
    hideTimer = setTimeout(() => {
      tempPwBox.style.display = 'none';
    }, seconds * 1000);
  }

  copyBtn.addEventListener('click', async (e) => {
    e.preventDefault();
    tempPwInput.focus();
    tempPwInput.select();
    tempPwInput.setSelectionRange(0, tempPwInput.value.length);
    const ok = await copyToClipboard(tempPwInput.value);
    copyBtn.textContent = ok ? 'Copied!' : 'Copy failed';
    setTimeout(() => { copyBtn.textContent = 'Copy'; }, 1500);
  });

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    hideStatus(); hideError();

    const email = (emailInput.value || '').trim();
    if (!email) {
      showError('Please enter a valid email address.');
      return;
    }

    btn.disabled = true;
    btn.textContent = 'Please wait...';

    try {
      const fd = new FormData();
      fd.append('email', email); // API expects 'email' in form-data

      const res = await fetch(API_BASE + '/forgot_password', {
        method: 'POST',
        body: fd
        // Note: no manual 'Content-Type' header for FormData
      });

      const result = await res.json().catch(() => ({}));

      if (result && result.success) {
        // Show success text
        showStatus(result.message || 'Please check your email for further instructions.', 'success');

        // If API returns the password string in data, show the inline temp-password box
        if (typeof result.data === 'string' && result.data.length) {
          showTempPassword(result.data, 30);
        }
      } else {
        showStatus(result?.message || 'Unable to process your request.', 'danger');
      }
    } catch (err) {
      showStatus('Something went wrong. Please try again later.', 'danger');
    } finally {
      btn.disabled = false;
      btn.textContent = 'Reset Password';
    }
  });
})();
</script>
