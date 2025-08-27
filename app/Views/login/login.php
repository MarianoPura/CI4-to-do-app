<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login</title>
  <style>
    :root {
      --bg: #0f172a;         /* slate-900 */
      --card: #111827;       /* gray-900 */
      --muted: #94a3b8;      /* slate-400 */
      --text: #e5e7eb;       /* gray-200 */
      --accent: #3b82f6;     /* blue-500 */
      --accent-hover: #2563eb;
      --ring: 0 0 0 3px rgba(59,130,246,.35);
      --radius: 16px;
      --shadow: 0 10px 30px rgba(0,0,0,.45);
    }
    * { box-sizing: border-box; }
    html,body { height: 100%; }
    body {
      margin: 0;
      font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
      background: radial-gradient(1200px 600px at 80% -10%, rgba(59,130,246,.15), transparent 60%),
                  radial-gradient(900px 500px at -10% 110%, rgba(168,85,247,.12), transparent 60%),
                  var(--bg);
      color: var(--text);
      display: grid;
      place-items: center;
      padding: 24px;
    }
    .card {
      width: 100%;
      max-width: 420px;
      background: linear-gradient(180deg, rgba(255,255,255,.03), rgba(255,255,255,.01));
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,.08);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    .card-header {
      padding: 24px 28px 8px;
    }
    .title {
      margin: 0 0 6px;
      font-size: 1.5rem;
      letter-spacing: .2px;
    }
    .subtitle {
      margin: 0 0 8px;
      color: var(--muted);
      font-size: .95rem;
    }
    form {
      padding: 16px 28px 24px;
      display: grid;
      gap: 14px;
    }
    .field { display: grid; gap: 8px; }
    label {
      font-size: .9rem;
      color: #cbd5e1;
    }
    .input {
      width: 100%;
      padding: 12px 14px;
      background: #0b1220;
      color: var(--text);
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 12px;
      outline: none;
      transition: border-color .15s, box-shadow .15s, background .15s;
    }
    .input::placeholder { color: #64748b; }
    .input:focus {
      border-color: var(--accent);
      box-shadow: var(--ring);
      background: #0a0f1b;
    }
    .input-group {
      position: relative;
      display: grid;
    }
    .toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      border: 0;
      background: transparent;
      color: #9aa6b2;
      cursor: pointer;
      font-size: .9rem;
      padding: 6px 8px;
    }
    .row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
      margin-top: 4px;
    }
    .checkbox {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      user-select: none;
      color: #cbd5e1;
      font-size: .9rem;
    }
    .forgot {
      color: var(--muted);
      text-decoration: none;
      font-size: .9rem;
    }
    .forgot:hover { color: #cbd5e1; }
    .btn {
      width: 100%;
      padding: 12px 16px;
      border: 0;
      border-radius: 12px;
      background: var(--accent);
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: transform .04s ease, background .15s ease;
    }
    .btn:hover { background: var(--accent-hover); }
    .btn:active { transform: translateY(1px); }
    .divider {
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: center;
      gap: 12px;
      color: var(--muted);
      font-size: .85rem;
      margin: 6px 0;
    }
    .divider::before, .divider::after {
      content: "";
      height: 1px;
      background: rgba(255,255,255,.12);
    }
    .alt {
      display: grid;
      gap: 10px;
    }
    .oauth {
      width: 100%;
      border: 1px solid rgba(255,255,255,.12);
      background: #0b1220;
      color: #e2e8f0;
      padding: 10px 14px;
      border-radius: 12px;
      cursor: pointer;
    }
    .footer {
      padding: 0 28px 24px;
      color: var(--muted);
      font-size: .9rem;
      text-align: center;
    }
    .link { color: #c7d2fe; text-decoration: none; }
    .link:hover { text-decoration: underline; }
    /* a11y helpers */
    .sr-only {
      position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px;
      overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0;
    }
  </style>
</head>
<body>
  <div class="card" role="region" aria-labelledby="login-title">
    <div class="card-header">
      <h1 id="login-title" class="title">Welcome back</h1>
      <p class="subtitle">Please sign in to continue</p>
    </div>

    <form method="POST" id="loginForm">
      <div class="field">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" class="input" placeholder="you@example.com" autocomplete="username" required />
      </div>

      <div class="field">
        <div class="row" style="justify-content:space-between">
          <label for="password">Password</label>
          <a class="forgot" href="#">Forgot password?</a>
        </div>
        <div class="input-group">
          <input id="password" name="password" type="password" class="input" placeholder="••••••••" autocomplete="current-password" required />
          <button type="button" class="toggle" aria-label="Show password" onclick="togglePwd()">Show</button>
        </div>
      </div>

      <div class="row">
        <label class="checkbox">
          <input type="checkbox" name="remember" />
          <span>Remember me</span>
        </label>
      </div>

      <button class="btn" type="submit">Sign in</button>

      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success" style="justify-content: center;">
          <?= session()->getFlashdata('success')?>
          <?php elseif(session()->getFlashData('error')):?>
            <?= session()->getFlashdata('error')?>
       <?php endif;?>
        </div>
      <div class="divider">or</div>
      <div class="alt">
        <button type="button" class="oauth">Continue with Google</button>
        <button type="button" class="oauth">Continue with GitHub</button>
      </div>
    </form>
    <div class="footer">
      Don’t have an account? <a class="link" href="<?= base_url('registration')?>">Create one</a>
    </div>
  </div>

  <script>
    function togglePwd() {
      const input = document.getElementById('password');
      const btn = event.currentTarget;
      const showing = input.type === 'text';
      input.type = showing ? 'password' : 'text';
      btn.textContent = showing ? 'Show' : 'Hide';
      btn.setAttribute('aria-label', showing ? 'Show password' : 'Hide password');
    }
  </script>

  <script src ="<?= base_url('js/script.js')?>"></script>
</body>
</html>
