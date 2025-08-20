<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Register</title>
  <style>
    :root {
      --bg: #0f172a;
      --card: #111827;
      --muted: #94a3b8;
      --text: #e5e7eb;
      --accent: #3b82f6;
      --accent-hover: #2563eb;
      --ring: 0 0 0 3px rgba(59,130,246,.35);
      --radius: 16px;
      --shadow: 0 10px 30px rgba(0,0,0,.45);
    }
    * { box-sizing: border-box; }
    html,body { height: 100%; }
    body {
      margin: 0;
      font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
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
      max-width: 480px;
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
    .title { margin: 0 0 6px; font-size: 1.5rem; }
    .subtitle { margin: 0 0 8px; color: var(--muted); font-size: .95rem; }
    form {
      padding: 16px 28px 24px;
      display: grid;
      gap: 14px;
    }
    .field { display: grid; gap: 8px; }
    label { font-size: .9rem; color: #cbd5e1; }
    .input {
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
    .input-group { position: relative; display: grid; }
    .toggle {
      position: absolute;
      right: 10px; top: 50%;
      transform: translateY(-50%);
      border: 0; background: transparent;
      color: #9aa6b2; cursor: pointer; font-size: .9rem;
      padding: 6px 8px;
    }
    .btn {
      width: 100%;
      padding: 12px 16px;
      border: 0; border-radius: 12px;
      background: var(--accent); color: white;
      font-weight: 600; cursor: pointer;
      transition: transform .04s ease, background .15s ease;
    }
    .btn:hover { background: var(--accent-hover); }
    .btn:active { transform: translateY(1px); }
    .footer {
      padding: 0 28px 24px;
      color: var(--muted);
      font-size: .9rem;
      text-align: center;
    }
    .link { color: #c7d2fe; text-decoration: none; }
    .link:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="card" role="region" aria-labelledby="register-title">
    <div class="card-header">
      <h1 id="register-title" class="title">Create your account</h1>
      <p class="subtitle">Sign up to get started</p>
    </div>

    <form method="POST" id="registrationForm">
      <?= csrf_field() ?>
      <div class="field">
        <label for="name">Full Name</label>
        <input id="name" name="name" type="text" class="input" placeholder="John Doe" required />
      </div>

      <div class="field">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" class="input" placeholder="you@example.com" required />
      </div>

      <div class="field">
        <label for="password">Password</label>
        <div class="input-group">
          <input id="password" name="password" type="password" class="input" placeholder="••••••••" required />
          <button type="button" class="toggle" onclick="togglePwd('password', this)">Show</button>
        </div>
      </div>

      <div class="field">
        <label for="confirm">Confirm Password</label>
        <div class="input-group">
          <input id="confirm" name="confirm" type="password" class="input" placeholder="••••••••" required />
          <button type="button" class="toggle" onclick="togglePwd('confirm', this)">Show</button>
        </div>
      </div>

      <button class="btn" type="submit">Register</button>
      <?validation_list_errors()?>
    </form>

    <div class="footer">
      Already have an account? <a class="link" href="<?= base_url('loginPage')?>">Sign in</a>
    </div>
  </div>
<script>
    function togglePwd(id, btn) {
      const input = document.getElementById(id);
      const showing = input.type === 'text';
      input.type = showing ? 'password' : 'text';
      btn.textContent = showing ? 'Show' : 'Hide';
    }
</script>
  <script src=<?=base_url ('js/script.js')?>>
  </script>
  
</body>
</html>
