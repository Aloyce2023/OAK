<?php
require("database.php");
require("user_input.php");

$username = $email = $password = $confirm_password = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $username = trim($_POST['username'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $password = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirm_password'] ?? "";

    // Validation
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Check if username or email already exists
        $check_query = "SELECT id FROM user_input WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Username or email already exists";
        } else {
            // Insert new user
            $insert_query = "INSERT INTO user_input (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            
            if ($stmt->execute()) {
                $success = true;
                $username = $email = $password = $confirm_password = "";
            } else {
                $errors[] = "Error registering user. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NESO CARS | Register</title>
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
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        .bg-car {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150%;
            height: 150%;
            object-fit: cover;
            opacity: 0.1;
            z-index: -1;
            animation: moveBg 60s infinite alternate;
        }
        @keyframes moveBg {
            from { transform: translate(-55%, -50%) scale(1.1); }
            to { transform: translate(-45%, -50%) scale(1.2); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    
    <!-- Dynamic Background Image -->
    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=2000" class="bg-car" alt="Sports Car">

    <div class="w-full max-w-lg">
        <div class="glass-card rounded-3xl p-8 md:p-12 text-white">
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-white/10 rounded-2xl mb-4">
                    <i class="fas fa-user-plus text-4xl text-white"></i>
                </div>
                <h1 class="text-4xl font-bold tracking-tight mb-2">Create Account</h1>
                <p class="text-white/60">Join the elite NESO family</p>
            </div>

            <!-- Success Message -->
            <?php if ($success): ?>
                <div class="bg-green-500/20 border border-green-500/50 text-green-200 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
                    <i class="fas fa-circle-check"></i>
                    <p class="text-sm font-medium">Account created! <a href="form.php" class="underline font-bold">Login now</a></p>
                </div>
            <?php endif; ?>

            <!-- Error Messages -->
            <?php if (!empty($errors)): ?>
                <div class="bg-red-500/20 border border-red-500/50 text-red-200 px-4 py-3 rounded-xl mb-6 space-y-1">
                    <?php foreach ($errors as $error): ?>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-circle-exclamation text-xs"></i>
                            <p class="text-sm font-medium"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" id="registerForm" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative group">
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="<?php echo htmlspecialchars($username); ?>"
                            placeholder="Username"
                            class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all"
                            required
                        >
                    </div>

                    <div class="relative group">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="<?php echo htmlspecialchars($email); ?>"
                            placeholder="Email Address"
                            class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all"
                            required
                        >
                    </div>
                </div>

                <div class="relative group">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Create Password"
                        class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all"
                        required
                    >
                </div>

                <div class="relative group">
                    <input 
                        type="password" 
                        id="confirm_password" 
                        name="confirm_password" 
                        placeholder="Confirm Password"
                        class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all"
                        required
                    >
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-white text-purple-700 font-bold py-4 px-6 rounded-xl hover:bg-opacity-90 hover:scale-[1.02] transform transition-all duration-200 shadow-xl mt-4"
                >
                    Register Now <i class="fas fa-rocket ml-2"></i>
                </button>
            </form>

            <div class="text-center mt-8">
                <p class="text-white/60 text-sm">
                    Already have an account? <a href="form.php" class="text-white hover:underline font-bold transition-all">Login here</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
