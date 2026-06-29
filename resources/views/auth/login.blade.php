<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SINERGI FLOWINDO — Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600,700&display=fallback">
  <link rel="stylesheet" href="/lte/plugins/fontawesome-free/css/all.min.css">
  <style>
    :root {
      --brand-primary: #1a56a0;
      --accent: #f0a500;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: #f0f4f8;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Source Sans Pro', sans-serif;
    }

    .login-wrapper {
      width: 100%;
      max-width: 380px;
      padding: 1rem;
    }

    /* Brand */
    .login-brand {
      text-align: center;
      margin-bottom: 1.25rem;
    }
    .brand-icon {
      width: 60px;
      height: 60px;
      background: #fff;
      border-radius: 14px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 0.6rem;
      box-shadow: 0 4px 14px rgba(0,0,0,0.10);
    }
    .brand-icon i {
      font-size: 26px;
      color: var(--brand-primary);
    }
    .brand-name {
      color: #1a1a2e;
      font-size: 1rem;
      font-weight: 700;
      margin: 0;
    }
    .brand-sub {
      color: #7a8599;
      font-size: 0.78rem;
      margin: 0;
    }

    /* Card */
    .login-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.10);
      overflow: hidden;
    }
    .card-top-bar {
      height: 4px;
      background: linear-gradient(90deg, var(--accent) 0%, #f5c842 100%);
    }
    .card-inner {
      padding: 1.75rem 1.75rem 1.5rem;
    }

    /* Heading */
    .card-heading {
      text-align: center;
      margin-bottom: 1.5rem;
    }
    .card-heading h1 {
      font-size: 1.3rem;
      font-weight: 700;
      color: #1a1a2e;
      margin: 0 0 3px;
    }
    .card-heading p {
      color: #7a8599;
      font-size: 0.875rem;
      margin: 0;
    }

    /* Alert error */
    .alert-error {
      background: #fff5f5;
      border: 1px solid #fed7d7;
      border-radius: 8px;
      padding: 10px 14px;
      margin-bottom: 1rem;
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }
    .alert-error i {
      color: #e53e3e;
      font-size: 14px;
      margin-top: 2px;
      flex-shrink: 0;
    }
    .alert-error p {
      color: #c53030;
      font-size: 0.875rem;
      margin: 0;
    }

    /* Fields */
    .field-block {
      margin-bottom: 1rem;
    }
    .field-block label {
      display: block;
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      color: #4a5568;
      margin-bottom: 5px;
    }
    .input-wrap {
      position: relative;
    }
    .input-wrap .field-icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: #b0bec5;
      font-size: 13px;
      pointer-events: none;
      transition: color 0.2s;
    }
    .input-wrap input {
      width: 100%;
      height: 44px;
      padding: 0 40px 0 38px;
      border: 1.5px solid #e2e8f0;
      border-radius: 9px;
      font-size: 0.9rem;
      font-family: inherit;
      color: #1a202c;
      background: #f8fafc;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }
    .input-wrap input::placeholder { color: #c5cdd8; }
    .input-wrap input:focus {
      border-color: var(--brand-primary);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(26,86,160,0.10);
    }
    .input-wrap:focus-within .field-icon { color: var(--brand-primary); }
    .input-wrap .toggle-pw {
      position: absolute;
      right: 11px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #b0bec5;
      font-size: 13px;
      padding: 4px;
      transition: color 0.2s;
    }
    .input-wrap .toggle-pw:hover { color: var(--brand-primary); }

    /* Options */
    .form-options {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 0.25rem 0 1.25rem;
    }
    .remember-label {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 0.875rem;
      color: #4a5568;
      cursor: pointer;
    }
    .remember-label input[type="checkbox"] {
      width: 15px;
      height: 15px;
      accent-color: var(--brand-primary);
      cursor: pointer;
    }
    .forgot-link {
      font-size: 0.875rem;
      color: var(--brand-primary);
      text-decoration: none;
      font-weight: 600;
    }
    .forgot-link:hover { text-decoration: underline; }

    /* Button */
    .btn-login {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      height: 46px;
      background: var(--brand-primary);
      color: #fff;
      border: none;
      border-radius: 9px;
      font-size: 0.95rem;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: background 0.15s, transform 0.1s, box-shadow 0.15s;
      box-shadow: 0 3px 10px rgba(26,86,160,0.30);
    }
    .btn-login:hover {
      background: #154d8f;
      box-shadow: 0 5px 16px rgba(26,86,160,0.38);
    }
    .btn-login:active { transform: scale(0.98); }

    /* Footer */
    .card-footer-note {
      text-align: center;
      font-size: 0.78rem;
      color: #a0aec0;
      margin-top: 1.25rem;
      padding-top: 1rem;
      border-top: 1px solid #f0f4f8;
    }
    .card-footer-note a {
      color: var(--brand-primary);
      text-decoration: none;
      font-weight: 600;
    }
  </style>
</head>
<body>

  <div class="login-wrapper">

    <!-- Brand -->
    <div class="login-brand">
      <div class="brand-icon">
        <i class="fas fa-globe-asia"></i>
      </div>
      <p class="brand-name">SINERGI FLOWINDO</p>
      <p class="brand-sub">Management System</p>
    </div>

    <!-- Card -->
    <div class="login-card">
      <div class="card-top-bar"></div>
      <div class="card-inner">

        <div class="card-heading">
          <h1>Selamat Datang</h1>
          <p>Masuk untuk memulai sesi Anda</p>
        </div>

        @error('loginError')
          <div class="alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <p>{{ $message }}</p>
          </div>
        @enderror

        <form method="POST" action="/login">
          @csrf
           @error('email')
           <small style ="color:red">{{$message}}</small>
          @enderror
          <div class="field-block">
            <label for="email">Email</label>
            <div class="input-wrap">
              <i class="fas fa-envelope field-icon"></i>
              <input type="text" id="email" name="email"
                     placeholder="nama@perusahaan.com"
                     value="{{ old('email') }}"
                     autocomplete="username">
            </div>
          </div>
           @error('password')
           <small style ="color:red">{{$message}}</small>

        @enderror
          <div class="field-block">
            <label for="password">Password</label>
            <div class="input-wrap">
              <i class="fas fa-lock field-icon"></i>
              <input type="password" id="password" name="password"
                     placeholder="••••••••"
                     autocomplete="current-password">
              <button type="button" class="toggle-pw" onclick="togglePassword()">
                <i class="fas fa-eye" id="pw-eye"></i>
              </button>
            </div>
          </div>
          <button type="submit" class="btn-login">
            <i class="fas fa-sign-in-alt"></i>
            Masuk
          </button>

        </form>

        <div class="card-footer-note">
          Butuh bantuan? Hubungi <a href="mailto:admin@sinergiflowindo@gmail.com">admin@sinergiflowindo@gmail.com</a>
        </div>

      </div>
    </div>

  </div>

  <script>
    function togglePassword() {
      var input = document.getElementById('password');
      var eye   = document.getElementById('pw-eye');
      if (input.type === 'password') {
        input.type = 'text';
        eye.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        input.type = 'password';
        eye.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
  </script>

</body>
</html>