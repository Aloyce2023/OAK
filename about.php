<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - NESO Car Company</title>
    <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <?php require("partial.php"); ?>

    <!-- Hero Section -->
    <div class="relative bg-purple-600 h-64 flex flex-col items-center justify-center text-center">
        <h1 class="text-5xl font-bold text-white mb-4 animate-bounce">About NESO Car Company</h1>
        <p class="text-xl text-purple-100">Your Trusted Partner in Quality Japanese Imports</p>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        
        <!-- Mission & Vision -->
        <div class="grid md:grid-cols-2 gap-12 mb-16">
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                <div class="text-purple-500 text-4xl mb-4"><i class="fas fa-bullseye"></i></div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Mission</h2>
                <p class="text-gray-600 leading-relaxed">
                    To provide our customers with high-quality, reliable, and affordable vehicles imported directly from Japan. 
                    We strive to make the car buying process transparent, efficient, and enjoyable for every client.
                </p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                <div class="text-purple-500 text-4xl mb-4"><i class="fas fa-eye"></i></div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Vision</h2>
                <p class="text-gray-600 leading-relaxed">
                    To be the leading car dealership in the region, known for our integrity, exceptional customer service, 
                    and a vast selection of premium vehicles that cater to all needs and budgets.
                </p>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="mb-16">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Why Choose Us?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-purple-600 text-3xl">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Quality Assurance</h3>
                    <p class="text-gray-600">Every vehicle undergoes a rigorous inspection process before it reaches our showroom.</p>
                </div>
                <div class="text-center p-6">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-purple-600 text-3xl">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Best Prices</h3>
                    <p class="text-gray-600">We offer competitive pricing on all our imported vehicles without compromising on quality.</p>
                </div>
                <div class="text-center p-6">
                    <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 text-purple-600 text-3xl">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Our dedicated support team is available around the clock to assist you with any inquiries.</p>
                </div>
            </div>
        </div>

        <!-- Team Section (Placeholder) -->
        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-12">
            <div class="md:flex">
                <div class="md:w-1/2 bg-purple-200 h-64 md:h-auto flex items-center justify-center">
                    <i class="fas fa-users text-6xl text-purple-400"></i>
                </div>
                <div class="p-8 md:w-1/2 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Meet Our Team</h2>
                    <p class="text-gray-600 mb-6">
                        Our team of automotive experts is passionate about cars and committed to helping you find your perfect ride. 
                        With years of experience in the industry, we offer professional advice and personalized service.
                    </p>
                    <a href="form.php" class="bg-purple-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-purple-700 transition duration-300 w-fit">
                        Contact Us Today
                    </a>
                </div>
            </div>
        </div>

    </div>

    <?php require("partial/footer.php"); ?>

</body>
</html>
