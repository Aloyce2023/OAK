<!DOCTYPE html>
<html>
    <head>
        <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script> <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body>

    <?php
    
    require("partial.php");
    ?>
        <div class="bg-[#722F37]  w-full h-20   items-center">
            <h1 class="text-center  text-white text-5xl py-4  font-md font-bold"> Our certain items</h1>
        </div>
        <div class="grid sm:grid-cols-3 hover:purple-200   mt-0  ">
            <card  class="border-2 border-purple-400 hover:red-400  rounded-lg h-120 w-full shadow-gray-500">
                <div>
                <img class="w-full  h-70 "src="image/duali.jpg">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 ">TOYOTA DUALIS </h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-3xl text-[#FFBF00] "> Price USA$,721 </p>
                
                </div>

            </card>

            <card  class="border-2 border-purple-400 rounded-lg h-120 w-full shadow-gray-500">
                <div>
                <img class="w-full rounded-lg h-70 "src="image/harier3.jpg">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 ">  TOYOTA HARIER </h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-3xl text-[#FFBF00]"> Price USA$,560 </p>
                
                </div>

            </card>


            <card class="border-2 border-purple-400 rounded-lg h-120 w-full shadow-gray-500">
                <div >
                <img class="w-full rounded-lg  h-70"src="image/harier1.jpg">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 "> LAMBUGIN</h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-[#FFBF00] text-3xl "> Price USA$,271 </p>
                
                </div>

            </card>

            <card  class="border-2 border-purple-400 rounded-lg h-120 w-full shadow-gray-500">
                <div>
                <img class="w-full  m-6 ml-0 h-70 rounded-lg"src="image/lambugin.webp">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 ">LAMBUGIN </h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-3xl text-[#FFBF00] "> Price USA$,14K </p>
                
                </div>

            </card>


            <card  class="border-2 border-purple-400 rounded-lg h-120 w-full shadow-gray-500">
                <div>
                <img class="w-full  m-6 ml-0 h-70 rounded-lg"src="image/w6.jpg">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 ">LAND CRUISER </h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-3xl text-[#FFBF00] "> Price USA$,400 </p>
                
                </div>

            </card>

             <card  class="border-2 border-purple-400 rounded-lg h-120 w-full shadow-gray-500">
                <div>
                <img class="w-full  m-6 ml-0 h-70 rounded-lg"src="image/mouse2.jpg">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 ">TOYOTA SUZUKI </h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-3xl text-[#FFBF00] "> Price USA$,820 </p>
                
                </div>

            </card>
 <card  class="border-2 border-purple-400 rounded-lg h-120 w-full shadow-gray-500">
                <div>
                <img class="w-full  m-6 ml-0 h-70 rounded-lg "src="image/mouse1.jpg">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 ">TOYOTA PAJERO </h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-3xl text-[#FFBF00] "> Price USA$,900 </p>
                
                </div>

            </card>

             <card  class="border-2 border-purple-400 rounded-lg h-120 w-full shadow-gray-500">
                <div>
                <img class="w-full  m-6 ml-0  h-70 rounded-lg"src="image/w2.jpg">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 ">TOYOTA BENZI </h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-3xl text-[#FFBF00] "> Price USA$,10K </p>
                
                </div>

            </card>

             <card  class="border-2 border-purple-400 rounded-lg h-120 w-full shadow-gray-500">
                <div>
                <img class="w-full  m-6 ml-0 h-70 rounded-lg"src="image/mouse3.jpg">
                <h2 class="text-center font-medium font-bold  text-4xl text-purple-400 ">LAMBUGIN </h2>
                </div>
                <div>
                <p class="text-center font-md font-bold text-3xl text-[#FFBF00] "> Price USA$,12K </p>
                
                </div>

            </card>
        </div>
        <?php
        require("partial/footer.php");
        ?>

    </body>

</html>