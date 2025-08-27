<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Account Settings</title>
  <style>
    :root {
      --bg: #0f172a;         /* slate-900 */
      --card: #111827;       /* gray-900 */
      --muted: #94a3b8;      /* slate-400 */
      --text: #e5e7eb;       /* gray-200 */
      --accent: #3b82f6;     /* blue-500 */
      --accent-hover: #2563eb;
      --radius: 16px;
      --shadow: 0 10px 30px rgba(0,0,0,.45);
      --ring: 0 0 0 3px rgba(59,130,246,.35);
    }

    * { box-sizing: border-box; }
    html,body { height: 100%; }
    body {
      margin: 0;
      font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: radial-gradient(1000px 500px at 80% -10%, rgba(59,130,246,.15), transparent 60%),
                  radial-gradient(800px 400px at -10% 110%, rgba(168,85,247,.12), transparent 60%),
                  var(--bg);
      color: var(--text);
      display: grid;
      place-items: center;
      padding: 24px;
    }

    .card {
      width: 100%;
      max-width: 540px;
      background: linear-gradient(180deg, rgba(255,255,255,.03), rgba(255,255,255,.01));
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,.08);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .card-header {
      padding: 24px 28px 12px;
    }
    .title {
      margin: 0 0 6px;
      font-size: 1.5rem;
    }
    .subtitle {
      margin: 0;
      color: var(--muted);
      font-size: .95rem;
    }

    form.settings-form {
      padding: 20px 28px 24px;
      display: grid;
      gap: 16px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    label {
      font-size: .9rem;
      color: var(--muted);
    }
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

    .btn {
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

    .footer {
      border-top: 1px solid rgba(255,255,255,.08);
      padding: 16px 28px;
      text-align: right;
    }
    .logout {
      background: transparent;
      border: 1px solid rgba(255,255,255,.2);
      border-radius: 12px;
      color: var(--muted);
      padding: 8px 14px;
      cursor: pointer;
      font-size: .9rem;
    }
    .logout:hover { color: var(--text); border-color: var(--text); }

    .alert {
      margin: 12px 28px;
      padding: 10px 14px;
      border-radius: 10px;
      background: rgba(16,185,129,.15);
      border: 1px solid rgba(16,185,129,.3);
      color: #6ee7b7;
      font-size: .9rem;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="card-header">
      <h1 class="title">Account Settings</h1>
      <p class="subtitle">Update your personal information</p>
    </div>

    <!-- Example alert -->
    <!-- <div class="alert">Profile updated successfully!</div> -->

    <form method="post" class="settings-form" id="settings-form">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="input" placeholder="Enter your name" required />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="input" placeholder="Enter your email" required />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="input" placeholder="Enter a new password" />
      </div>

      <div class="form-group">
        <label for="confirm">Confirm Password</label>
        <input type="password" id="confirm" name="confirm" class="input" placeholder="Confirm your password" />
      </div>

      <button type="submit" class="btn">Save Changes</button>
    </form>

    <div class="footer">
      <form method="POST" id="logout">
        <button type="submit" class="logout">Sign out</button>
      </form>
    </div>
  </div>
  <script src="<?= base_url('js/script.js')?>"></script>
</body>
</html>
