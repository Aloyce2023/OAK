<?php
session_start();
require("database.php");
require("user_input.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: form.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

// Fetch all cars
$sql = "SELECT * FROM cars";
try {
    $result = $conn->query($sql);
    $cars = $result->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), "doesn't exist") !== false) {
        die("<div style='color:red; text-align:center; margin-top:50px;'>
                <h2>Database Setup Required</h2>
                <p>The 'cars' table is missing.</p>
                <p>Please <a href='setup_cars.php' style='color:blue; text-decoration:underline;'>Click Here to Run Setup</a></p>
             </div>");
    } else {
        die("Query failed: " . $e->getMessage());
    }
}

// Fetch orders if admin
$admin_orders = [];
if ($is_admin) {
    // Check if orders table has created_at, if not we'll just show what we have
    // This query joins orders, users (user_input), and cars
    $order_sql = "SELECT 
                    u.username, 
                    u.email, 
                    o.car_id, 
                    c.name as car_name, 
                    c.brand as car_brand,
                    c.image as car_image,
                    c.price as car_price, 
                    o.created_at as order_time 
                  FROM orders o
                  JOIN user_input u ON o.user_id = u.id
                  JOIN cars c ON o.car_id = c.id
                  ORDER BY o.created_at DESC";
    
    try {
        $order_result = $conn->query($order_sql);
        if ($order_result) {
            $admin_orders = $order_result->fetch_all(MYSQLI_ASSOC);
        }
    } catch (Exception $e) {
        // Fallback: This runs if the database schema is slightly different
        $order_sql_fallback = "SELECT 
                        u.username, 
                        u.email, 
                        o.car_id, 
                        c.name as car_name, 
                        c.brand as car_brand,
                        c.image as car_image,
                        c.price as car_price 
                      FROM orders o
                      JOIN user_input u ON o.user_id = u.id
                      JOIN cars c ON o.car_id = c.id";
        $order_result = $conn->query($order_sql_fallback);
        if ($order_result) {
            $admin_orders = $order_result->fetch_all(MYSQLI_ASSOC);
        }
    }
}

// Check for messages
$success_msg = "";
$error_msg = "";
if (isset($_GET['success'])) {
    $success_msg = "Order placed successfully!";
}
if (isset($_GET['error'])) {
    $error_msg = "Failed to place order. Please try again.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Responsive Navbar -->
    <nav class="bg-[#00FFFF] shadow-md w-full overflow-hidden">
        <div class="w-full flex items-center h-28">
            <!-- Left: Logo & Brand -->
            <div class="flex-none flex items-center h-full pr-8">
                <img class="h-full w-auto object-cover" src="image/logo.jpg" alt="Logo">
                <div class="hidden lg:block ml-4">
                    <span class="text-xs font-black uppercase tracking-widest text-black/40">Dashboard</span>
                    <h1 class="font-bold text-gray-900 leading-tight">NESO CARS</h1>
                </div>
            </div>

            <!-- Center: Navigation Links -->
            <div class="grow hidden md:flex justify-center">
                <ul class="flex items-center font-bold text-gray-900 gap-2">
                    <li class="hover:bg-black/10 px-6 py-2 rounded-lg transition-all"><a href="index.php">Home</a></li>
                    <li class="hover:bg-black/10 px-6 py-2 rounded-lg transition-all"><a href="about.php">About</a></li>
                    <li class="hover:bg-black/10 px-6 py-2 rounded-lg transition-all"><a href="galley.php">Galley</a></li>
                </ul>
            </div>

            <!-- Right: User Controls -->
            <div class="flex-none hidden md:flex items-center gap-4 pr-8">
                <?php if ($is_admin): ?>
                    <span class="bg-black text-yellow-400 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-crown"></i> Admin
                    </span>
                <?php endif; ?>
                
                <div class="flex items-center gap-3 bg-white/50 backdrop-blur-sm px-4 py-2 rounded-2xl border border-white/20">
                    <div class="w-2.5 h-2.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.5)]"></div>
                    <span class="text-sm font-black text-gray-900 tracking-tight"><?php echo htmlspecialchars($username); ?></span>
                </div>
                
                <a href="logout.php" class="bg-red-600 hover:bg-black text-white text-[10px] font-black py-3 px-6 rounded-xl transition-all duration-300 shadow-xl uppercase tracking-[0.2em]"> Logout </a>
            </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center gap-3">
                    <?php if ($is_admin): ?>
                        <div class="w-8 h-8 bg-black text-yellow-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-crown text-xs"></i>
                        </div>
                    <?php endif; ?>
                    <button id="dashboard-menu-btn" class="w-12 h-12 bg-white/50 rounded-xl flex items-center justify-center text-gray-900 focus:outline-none border border-white/20">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Dropdown -->
        <div id="dashboard-mobile-menu" class="hidden md:hidden bg-[#00FFFF] border-t border-black/5 animate-in slide-in-from-top duration-300">
            <div class="px-4 pt-4 pb-8 space-y-4">
                <div class="flex items-center justify-between pb-4 border-b border-black/5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/50 flex items-center justify-center font-black text-gray-900 shadow-sm">
                            <?php echo strtoupper(substr($username, 0, 1)); ?>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-widest">Active Member</div>
                            <div class="font-black text-gray-900"><?php echo htmlspecialchars($username); ?></div>
                        </div>
                    </div>
                    <?php if ($is_admin): ?>
                        <span class="bg-black text-yellow-500 text-[10px] font-black px-3 py-1 rounded-full uppercase">Admin</span>
                    <?php endif; ?>
                </div>

                <ul class="space-y-2 font-bold text-gray-900">
                    <li><a href="index.php" class="flex items-center gap-3 p-4 hover:bg-black/5 rounded-xl transition-all"><i class="fas fa-home w-5 text-gray-400"></i> Home</a></li>
                    <li><a href="about.php" class="flex items-center gap-3 p-4 hover:bg-black/5 rounded-xl transition-all"><i class="fas fa-info-circle w-5 text-gray-400"></i> About</a></li>
                    <li><a href="galley.php" class="flex items-center gap-3 p-4 hover:bg-black/5 rounded-xl transition-all"><i class="fas fa-images w-5 text-gray-400"></i> Gallery</a></li>
                </ul>

                <a href="logout.php" class="block w-full bg-red-600 text-white text-center font-black py-4 rounded-xl shadow-lg shadow-red-500/20">
                    <i class="fas fa-sign-out-alt mr-2"></i> LOGOUT
                </a>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('dashboard-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('dashboard-mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    <div class="container mx-auto mt-0 p-4">
        
        <!-- Alerts -->
        <?php if ($success_msg): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $success_msg; ?></span>
            </div>
        <?php endif; ?>

        <?php if ($error_msg): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $error_msg; ?></span>
            </div>
        <?php endif; ?>

        <!-- Admin Table Section -->
        <?php if ($is_admin): ?>
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-yellow-400 rounded-lg">
                        <i class="fas fa-clipboard-list text-xl text-black"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Customer Orders</h2>
                </div>
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Customer Info</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Vehicle Details</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Cost</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Order Timeline</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php if (empty($admin_orders)): ?>
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                            <i class="fas fa-box-open text-4xl mb-3 block"></i>
                                            No orders have been placed yet.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($admin_orders as $order): ?>
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-bold">
                                                        <?php echo strtoupper(substr($order['username'], 0, 1)); ?>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-gray-900"><?php echo htmlspecialchars($order['username']); ?></div>
                                                        <div class="text-xs text-gray-500"><?php echo htmlspecialchars($order['email']); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <img src="<?php echo htmlspecialchars($order['car_image'] ?? 'image/default.jpg'); ?>" class="w-16 h-10 object-cover rounded-md shadow-sm border border-gray-100">
                                                    <div>
                                                        <div class="text-xs font-black text-purple-600 uppercase tracking-tighter"><?php echo htmlspecialchars($order['car_brand'] ?? 'Unknown'); ?></div>
                                                        <div class="font-bold text-gray-800"><?php echo htmlspecialchars($order['car_name'] ?? 'Car'); ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-lg font-black text-green-600">$<?php echo number_format($order['car_price']); ?></div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-600">
                                                    <div class="flex items-center gap-1">
                                                        <i class="far fa-calendar-alt text-gray-400"></i>
                                                        <?php echo isset($order['order_time']) ? date('M j, Y', strtotime($order['order_time'])) : 'N/A'; ?>
                                                    </div>
                                                    <div class="text-xs text-gray-400">
                                                        <i class="far fa-clock text-gray-400"></i>
                                                        <?php echo isset($order['order_time']) ? date('H:i', strtotime($order['order_time'])) : ''; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button class="bg-gray-900 text-white text-xs font-bold py-2 px-4 rounded-lg hover:bg-black transition-colors">
                                                    Details
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr class="border-gray-200 mb-10">
        <?php endif; ?>

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Available Cars</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($cars as $car): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img class="w-full h-48 object-cover" src="<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['name']); ?>">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($car['brand'] . ' ' . $car['name']); ?></h2>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($car['description']); ?></p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-green-600">$<?php echo number_format($car['price']); ?></span>
                            
                            <form action="process_order.php" method="POST">
                                <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                                <button type="submit" class="bg-purple-600 hover:bg-purple-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300">
                                    <i class="fas fa-shopping-cart mr-2"></i> Order Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2026 NESO Car Company. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
