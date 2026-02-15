<!DOCTYPE html>
<html>
<head>
     <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script> <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
</head>
<body>
    <div class=" grid sm:grid sm:w-full bg-purple-500  sm:justify-center text-center items-center sm:h-40  sm:mt-0  ">
C        <h2 class="text-center text-4xl font-md  font-bold animate-bounce text-black-400">WELCOME TO NESO CAR COMPANY LIMITED</h2>

    </div>
    
    <?php require("partial.php");
    
    ?>

  

    <div class="grid   sm:mt-0 sm:items-center sm:w-full sm:text-center  sm:grid-cols-2 sm:gap-2     bg-cyan-400  ">
            <div>
                <img class="h-auto w-full " src="image/lambugin1.webp">
            </div>
            <div>
                <h2 class="text-4xl text-center text-[#CD7F32] font-md   animate-bounce hover:bg-blue-200 m-5 font-bold"> NESO COMPANY </h2>
                <p class="text-center text-lg font-md m-5 animate-bounce  font-bold"> It deals with import, export and sell Quality cars and trucks from JAPAN.Our company is under the certain protocol which ensure the customers get good and quality services. </p> 
            </div>
        </div>
    </div>
    
    <div class=" grid sm:grid-cols-3 sm:w-full  sm:h-90 sm:items-center sm:mt-0  bg-[#800000]  ">
        <card>
            <h2 class="text-center font-bold font-md hover:bg-blue-200 hover:rounded-lg  text-[#000000] text-4xl">Contact Us</h2>
            <p class="text-center text-lg font-md font-bold text-white">Bibi Titi</p>
             <p class="text-center text-lg font-md font-bold text-white">P.O Box 1276</p>
             <p class="text-center text-lg font-md font-bold text-white"> Phone: (+255) 125-876</p>
        </card>

        <card>
            <h2 class="text-center hover:bg-blue-200 hover:rounded-lg text-4xl font-md  font-bold text-[#000000]">Opening Hours</h2>
            <p class="text-center text-lg font-md font-bold text-white">Monday-Friday:8AM-9PM</p>
             <p class="text-center text-lg font-md font-bold text-white">Saturday:7AM-10PM</p>
             <p class="text-center text-lg font-md font-bold text-white">Sunday:8AM-9PM</p>
        </card>

        <card>
            <h2 class="text-center text-lg font-md font-bold  text-center text-4xl  hover:bg-blue-200 hover:rounded-lg font-4xl font-bold text-6xl text-[#000000]">Follow Us</h2>
             <p class="text-center text-lg font-md font-bold text-white">Instagram</p>
             <p class="text-center text-lg font-md font-bold text-white">Twitter</p>
             
            
        </card>
    </div>
    <?php
    require("partial/footer.php");
    ?>
    
   
   
</body>
</html>