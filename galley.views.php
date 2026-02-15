<!DOCTYPE html>
<html>
    <head>
        <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script> <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body>

    <?php require("partial.php"); ?>
    <div class="bg-[#722F37] w-full min-h-[5rem] flex items-center justify-center px-4">
        <h1 class="text-center text-white text-3xl md:text-5xl py-4 font-bold">Our Certain Items</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4 md:p-8 bg-gray-50">
        <?php
        $gallery_cars = [
            ['Dualis', 'Toyota', '721', 'image/duali.jpg'],
            ['Harier', 'Toyota', '560', 'image/harier3.jpg'],
            ['Aventador', 'Lamborghini', '271k', 'image/harier1.jpg'],
            ['Huracan', 'Lamborghini', '14k', 'image/lambugin.webp'],
            ['Land Cruiser', 'Toyota', '40k', 'image/w6.jpg'],
            ['Suzuki', 'Toyota', '820', 'image/mouse2.jpg'],
            ['Pajero', 'Mitsubishi', '900', 'image/mouse1.jpg'],
            ['Benz', 'Mercedes', '10k', 'image/w2.jpg'],
            ['Gallardo', 'Lamborghini', '12k', 'image/mouse3.jpg']
        ];

        foreach ($gallery_cars as $car): ?>
            <div class="bg-white border-2 border-purple-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="relative h-64 overflow-hidden">
                    <img class="w-full h-full object-cover" src="<?php echo $car[3]; ?>" alt="<?php echo $car[0]; ?>">
                    <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-md text-[#FFBF00] px-3 py-1 rounded-full text-sm font-black">
                        $<?php echo $car[2]; ?>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <div class="text-[10px] font-black text-purple-600 uppercase tracking-[0.2em] mb-1"><?php echo $car[1]; ?></div>
                    <h2 class="text-2xl font-bold text-gray-800 tracking-tight uppercase"><?php echo $car[0]; ?></h2>
                    <div class="mt-4 pt-4 border-t border-gray-50 flex justify-center">
                        <a href="Dashbord.php" class="bg-purple-600 hover:bg-gray-900 text-white text-xs font-bold py-2 px-6 rounded-lg transition-all">ORDER NOW</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
        <?php
        require("partial/footer.php");
        ?>

    </body>

</html>