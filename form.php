<?php
session_start();
require("database.php");

$username = "";
$login_error = "";
$role_request = $_POST['role'] ?? 'user';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? "");
    $password = $_POST['password'] ?? "";
    $role_request = $_POST['role'] ?? 'user';

    // Validation
    if (empty($username)) {
        $login_error = "Username is required";
    } elseif (empty($password)) {
        $login_error = "Password is required";
    } else {
        // Check user in database
        $query = "SELECT id, username, password, role FROM user_input WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                
                // BULLETPROOF ADMIN CHECK: 
                // If the username is 'Aloyce' (case-insensitive), we FORCE the role to 'admin'.
                // This bypasses any database column or sync issues.
                if (strtolower($user['username']) === 'aloyce') {
                    $user['role'] = 'admin';
                }

                // If logging in as Admin, check role
                if ($role_request === 'admin' && $user['role'] !== 'admin') {
                    $login_error = "Access denied. You do not have admin privileges.";
                } else {
                    // Login successful
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    
                    if ($user['role'] === 'admin') {
                        header('location: Dashbord.php?admin=true');
                    } else {
                        header('location: Dashbord.php');
                    }
                    exit;
                }
            } else {
                $login_error = "Invalid username or password";
            }
        } else {
            $login_error = "Invalid username or password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NESO CARS | Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0f172a;
            overflow: hidden;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
        }
        .role-toggle {
            transition: all 0.3s ease;
        }
        .role-toggle.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: white;
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .bg-car {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150%;
            height: 150%;
            object-fit: cover;
            opacity: 0.2;
            z-index: -1;
            animation: moveBg 80s infinite alternate;
        }
        @keyframes moveBg {
            from { transform: translate(-55%, -50%) scale(1.1); }
            to { transform: translate(-45%, -50%) scale(1.2); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    
    <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c3fb?auto=format&fit=crop&q=80&w=2000" class="bg-car" alt="Luxury Car">

    <div class="w-full max-w-lg">
        <div class="glass-card rounded-3xl p-8 md:p-12 text-white">
            <div class="text-center mb-10">
                <div class="inline-block p-4 bg-white/10 rounded-2xl mb-4">
                    <i class="fas fa-car-side text-4xl text-white"></i>
                </div>
                <h1 class="text-4xl font-bold tracking-tight mb-2">NESO CARS</h1>
                <p class="text-white/60">Choose your access level</p>
            </div>

            <!-- Role Selector -->
            <div class="flex bg-black/30 p-1.5 rounded-2xl mb-8">
                <button type="button" onclick="setRole('user')" id="userBtn" class="role-toggle flex-1 py-3 px-4 rounded-xl text-sm font-semibold text-white/50">
                    <i class="fas fa-user mr-2"></i>User Login
                </button>
                <button type="button" onclick="setRole('admin')" id="adminBtn" class="role-toggle flex-1 py-3 px-4 rounded-xl text-sm font-semibold text-white/50">
                    <i class="fas fa-shield-alt mr-2"></i>Admin Login
                </button>
            </div>

            <!-- Error Message -->
            <?php if (!empty($login_error)): ?>
                <div class="bg-red-500/20 border border-red-500/50 text-red-200 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                    <i class="fas fa-circle-exclamation"></i>
                    <p class="text-sm font-medium"><?php echo htmlspecialchars($login_error); ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" action="" id="loginForm" class="space-y-6">
                <input type="hidden" name="role" id="roleInput" value="<?php echo htmlspecialchars($role_request); ?>">
                
                <div class="relative">
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="<?php echo htmlspecialchars($username); ?>"
                        placeholder="Username"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-white/20 transition-all font-medium"
                        required
                    >
                </div>

                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Password"
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-white/20 transition-all font-medium"
                        required
                    >
                    <button type="button" onclick="togglePassword()" class="absolute right-4 top-4 text-white/20 hover:text-white transition-colors">
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </button>
                </div>

                <button 
                    type="submit" 
                    id="submitBtn"
                    class="w-full bg-white text-gray-900 font-bold py-4 px-6 rounded-xl hover:bg-gray-100 hover:scale-[1.02] transform transition-all duration-200 shadow-xl flex justify-center items-center gap-2"
                >
                    Sign In <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="text-center mt-8 space-y-4">
                <p class="text-white/40 text-sm">
                    Need an account? <a href="register.php" class="text-white hover:underline font-bold transition-all">Register</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function setRole(role) {
            document.getElementById('roleInput').value = role;
            const userBtn = document.getElementById('userBtn');
            const adminBtn = document.getElementById('adminBtn');
            const submitBtn = document.getElementById('submitBtn');
            
            if (role === 'admin') {
                adminBtn.classList.add('active');
                userBtn.classList.remove('active');
                submitBtn.classList.replace('bg-white', 'bg-yellow-500');
                submitBtn.classList.replace('text-gray-900', 'text-white');
            } else {
                userBtn.classList.add('active');
                adminBtn.classList.remove('active');
                submitBtn.classList.replace('bg-yellow-500', 'bg-white');
                submitBtn.classList.replace('text-white', 'text-gray-900');
            }
        }

        function togglePassword() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Initialize view based on current data
        setRole('<?php echo $role_request; ?>');
    </script>
</body>
</html>




 