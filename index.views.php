<!DOCTYPE html>
<html>
<head>
     <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script> <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
</head>
<body>
    <?php require("partial.php"); ?>

    <div class="grid sm:grid sm:w-full bg-purple-500 sm:justify-center text-center items-center sm:h-40 m-0">
        <h2 class="text-center text-4xl font-bold animate-bounce text-black-400">WELCOME TO NESO CAR COMPANY LIMITED</h2>
    </div>

  

    <div class="grid sm:mt-0 sm:items-center sm:w-full sm:text-center sm:grid-cols-2 bg-black overflow-hidden min-h-[500px]">
        <!-- Image Slider Section -->
        <div class="relative h-[400px] sm:h-[500px] w-full overflow-hidden">
            <div id="hero-slider" class="h-full w-full">
                <img class="hero-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-100" src="image/lambugin1.webp" alt="Car 1">
                <img class="hero-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0" src="image/lambugin.webp" alt="Car 2">
                <img class="hero-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0" src="image/harier1.jpg" alt="Car 3">
                <img class="hero-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0" src="image/harier3.jpg" alt="Car 4">
            </div>
            <!-- Slider Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent"></div>
        </div>

        <!-- Text Section -->
        <div class="p-8 sm:p-12 flex flex-col justify-center bg-cyan-400 h-full">
            <h2 class="text-4xl lg:text-6xl text-center text-white drop-shadow-lg font-black animate-pulse mb-6"> NESO COMPANY </h2>
            <p class="text-center text-xl lg:text-2xl font-bold text-gray-900 leading-relaxed italic"> 
                "It deals with import, export and sell Quality cars and trucks from JAPAN. Our company is under certain protocols which ensure customers get good and quality services."
            </p> 
            <div class="mt-8 flex justify-center">
                <a href="galley.php" class="bg-black text-white px-10 py-4 rounded-full font-black hover:bg-white hover:text-black transition-all transform hover:scale-110 shadow-2xl">VIEW COLLECTION</a>
            </div>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        
        function showNextSlide() {
            slides[currentSlide].classList.replace('opacity-100', 'opacity-0');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.replace('opacity-0', 'opacity-100');
        }

        // Change slide every 5 seconds
        setInterval(showNextSlide, 5000);
    </script>
    
    <div class="grid grid-cols-1 md:grid-cols-3 w-full py-16 px-8 gap-8 bg-[#1a1a1a] text-white">
        <!-- Contact Us -->
        <div class="flex flex-col items-center p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300">
            <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/20">
                <i class="fas fa-map-marker-alt text-2xl text-white"></i>
            </div>
            <h2 class="text-3xl font-black mb-4 tracking-tight">Contact Us</h2>
            <div class="space-y-2 text-center text-gray-400 font-medium">
                <p class="hover:text-white transition-colors">Bibi Titi Mohammed Rd</p>
                <p class="hover:text-white transition-colors">P.O Box 1276, Dar Es Salaam</p>
                <p class="text-blue-400 font-black text-xl mt-4 tracking-wider"></p>
            </div>
        </div>

        <!-- Opening Hours -->
        <div class="flex flex-col items-center p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300">
            <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-purple-500/20">
                <i class="fas fa-clock text-2xl text-white"></i>
            </div>
            <h2 class="text-3xl font-black mb-4 tracking-tight">Opening Hours</h2>
            <div class="space-y-3 w-full">
                <div class="flex justify-between items-center px-4 py-2 bg-white/5 rounded-xl">
                    <span class="text-gray-400">Mon - Fri</span>
                    <span class="font-bold text-purple-400">8AM - 9PM</span>
                </div>
                <div class="flex justify-between items-center px-4 py-2 bg-white/5 rounded-xl">
                    <span class="text-gray-400">Saturday</span>
                    <span class="font-bold text-purple-400">7AM - 10PM</span>
                </div>
                <div class="flex justify-between items-center px-4 py-2 bg-white/5 rounded-xl border border-purple-500/30">
                    <span class="text-gray-400">Sunday</span>
                    <span class="font-bold text-purple-400">8AM - 9PM</span>
                </div>
            </div>
        </div>

        <!-- Follow Us -->
        <div class="flex flex-col items-center p-8 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300">
            <div class="w-16 h-16 bg-pink-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-pink-500/20">
                <i class="fas fa-share-alt text-2xl text-white"></i>
            </div>
            <h2 class="text-3xl font-black mb-4 tracking-tight">Follow Us</h2>
            <div class="flex flex-col gap-3 w-full mt-2">
                <a href="#" class="flex items-center justify-center gap-3 bg-[#e4405f]/10 hover:bg-[#e4405f] text-[#e4405f] hover:text-white p-4 rounded-2xl transition-all duration-300 font-bold group">
                    <i class="fab fa-instagram text-xl"></i>
                    Instagram
                </a>
                <a href="#" class="flex items-center justify-center gap-3 bg-[#1da1f2]/10 hover:bg-[#1da1f2] text-[#1da1f2] hover:text-white p-4 rounded-2xl transition-all duration-300 font-bold group">
                    <i class="fab fa-twitter text-xl"></i>
                    Twitter
                </a>
            </div>
        </div>
    </div>
    <?php
    require("partial/footer.php");
    ?>
    
   
   
</body>
</html>