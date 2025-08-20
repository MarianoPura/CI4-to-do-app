<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>To-Do</title>
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

    form.add-task {
      padding: 16px 28px 20px;
      display: flex;
      gap: 10px;
    }
    .input {
      flex: 1;
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

    .tasks {
      display: grid;
      gap: 10px;
      padding: 0 28px 24px;
      list-style: none;
      margin: 0;
    }
    .task {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #0b1220;
      padding: 12px 14px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.08);
      transition: background .2s, transform .05s;
    }
    .task:hover { background: #0a0f1b; transform: translateY(-1px); }
    .task span { flex: 1; }
    .task.complete span { text-decoration: line-through; color: var(--muted); }
    .task button {
      background: none;
      border: 0;
      color: var(--muted);
      cursor: pointer;
      font-size: .9rem;
    }
    .task button:hover { color: #f87171; }

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
      <h1 class="title">Your tasks</h1>
      <p class="subtitle">Stay organized and productive</p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('failed')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('failed') ?>
    </div>
    <?php endif; ?>
    
    <form method="post" action="/addTask" class="add-task">
      <input type="text" name="task" class="input" placeholder="Enter a task..." required />
      <button type="submit" class="btn">Add</button>
    </form>

    <ul class="tasksList">
    </ul>

    
    <div class="footer">
      <form method="POST" id="logout">
        <button type="submit" class="logout">Sign out</button>
      </form>
    </div>
  </div>

  <script src="<?= base_url('js/script.js')?>"></script>
</body>
</html>
