
    <nav class="bg-[#00FFFF] shadow-md w-full overflow-hidden">
        <div class="w-full flex items-center h-24 px-0">
            <!-- Left: Logo -->
            <div class="flex-none h-full">
                <img class="h-full w-auto object-cover" src="image/logo.jpg" alt="Logo">
            </div>

            <!-- Center: Nav Items -->
            <div class="grow hidden md:flex justify-center">
                <ul class="flex space-x-2 items-center font-bold text-[#000000]">
                    <li class="hover:bg-gray-900 hover:text-white px-6 py-2 rounded-lg transition-all duration-300"><a href="index.php">Home</a></li>
                    <li class="hover:bg-gray-900 hover:text-white px-6 py-2 rounded-lg transition-all duration-300"><a href="about.php">About</a></li>
                    <li class="hover:bg-gray-900 hover:text-white px-6 py-2 rounded-lg transition-all duration-300"><a href="galley.php">Galley</a></li>
                    <li class="hover:bg-gray-900 hover:text-white px-6 py-2 rounded-lg transition-all duration-300"><a href="Dashbord.php">Dashboard</a></li>
                </ul>
            </div>

            <!-- Right: Spacer (to keep center items perfectly centered) -->
            <div class="flex-none hidden md:block w-32 lg:w-48 invisible"></div>

            <!-- Mobile menu button - Still on the right -->
            <div class="md:hidden ml-auto pr-6">
                    <button id="mobile-menu-button" class="text-black hover:text-gray-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-[#00FFFF] px-4 pt-2 pb-6 border-t border-black/10">
            <ul class="flex flex-col space-y-2 font-bold text-[#000000]">
                <li class="hover:bg-gray-900 hover:text-white px-4 py-3 rounded-lg"><a href="index.php" class="block w-full">Home</a></li>
                <li class="hover:bg-gray-900 hover:text-white px-4 py-3 rounded-lg"><a href="about.php" class="block w-full">About</a></li>
                <li class="hover:bg-gray-900 hover:text-white px-4 py-3 rounded-lg"><a href="galley.php" class="block w-full">Galley</a></li>
                <li class="hover:bg-gray-900 hover:text-white px-4 py-3 rounded-lg"><a href="Dashbord.php" class="block w-full">Dashboard</a></li>
            </ul>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    