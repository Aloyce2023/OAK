<?php
// login.php
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root {
      --bg: #0e1117;
      --card: #161b22;
      --text: #e6edf3;
      --muted: #9da7b1;
      --accent: #3fb950;
      --danger: #f85149;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100vh;
      display: grid;
      place-items: center;
      background: radial-gradient(1200px 600px at 10% 10%, #1f2937 0%, var(--bg) 55%);
      color: var(--text);
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
      width: min(420px, 92vw);
      background: var(--card);
      border: 1px solid #21262d;
      border-radius: 14px;
      padding: 28px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.35);
    }
    h1 { margin: 0 0 8px; font-size: 22px; }
    p { margin: 0 0 20px; color: var(--muted); }
    label { display: block; font-size: 12px; margin: 12px 0 6px; color: var(--muted); }
    input {
      width: 100%;
      padding: 12px;
      background: #0b0f14;
      border: 1px solid #2d333b;
      color: var(--text);
      border-radius: 10px;
      outline: none;
    }
    button {
      width: 100%;
      margin-top: 16px;
      padding: 12px;
      background: var(--accent);
      color: #0b0f14;
      border: 0;
      border-radius: 10px;
      font-weight: 600;
      cursor: pointer;
    }
    .error { color: var(--danger); margin-top: 10px; min-height: 18px; }
  </style>
</head>
<body>
  <div class="card">
    <h1>Welcome back</h1>
    <p>Sign in to continue</p>
    <form id="login-form">
      <label for="identifier">Email or Username</label>
      <input id="identifier" name="identifier" type="text" autocomplete="username" required>
      <label for="password">Password</label>
      <input id="password" name="password" type="password" autocomplete="current-password" required>
      <button type="submit">Sign in</button>
      <div id="error" class="error"></div>
    </form>
  </div>

  <script src="login.js"></script>
</body>
</html>




<?php
// api/login.php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // If you need CORS, uncomment the lines below.
    // header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Headers: Content-Type');
    // header('Access-Control-Allow-Methods: POST, OPTIONS');
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid JSON']);
    exit;
}

$identifier = trim((string)($data['email'] ?? $data['username'] ?? ''));
$password = (string)($data['password'] ?? '');

if ($identifier === '' || $password === '') {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Email/username and password are required']);
    exit;
}

require_once __DIR__ . '/../database.php';

// Support either $pdo (PDO) or $conn (mysqli)
$user = null;

if (isset($pdo) && $pdo instanceof PDO) {
    $stmt = $pdo->prepare(
        'SELECT id, email, username, password_hash, password
         FROM users
         WHERE email = :id OR username = :id
         LIMIT 1'
    );
    $stmt->execute([':id' => $identifier]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} elseif (isset($conn) && $conn instanceof mysqli) {
    $stmt = $conn->prepare(
        'SELECT id, email, username, password_hash, password
         FROM users
         WHERE email = ? OR username = ?
         LIMIT 1'
    );
    $stmt->bind_param('ss', $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result ? $result->fetch_assoc() : null;
} else {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Database connection not available']);
    exit;
}

if (!$user) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Invalid credentials']);
    exit;
}

// Prefer password_hash column; fall back to password if needed
$hash = $user['password_hash'] ?? $user['password'] ?? '';

if ($hash === '' || !password_verify($password, $hash)) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Invalid credentials']);
    exit;
}

session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $user['email'] ?? null;

echo json_encode([
    'ok' => true,
    'user' => [
        'id' => $user['id'],
        'email' => $user['email'] ?? null,
        'username' => $user['username'] ?? null,
    ],
]);

