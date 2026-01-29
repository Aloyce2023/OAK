<!DOCTYPE html>
<html>
    <head>
 <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script> <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    

    </head>
    <body>
 
    <div class="grid shadow:bg-blue-400 sm:grid-cols-12 bg-[#00FFFF]  gap-4 w-full items-center  ml-2 rounded-lg">
        <label class="sm:col-span-3">
            <img  class="  w-40 h-40 rounded-lg  " src="image/logo.jpg">
        </label>
        <div class="sm:col-span-8 items-center">
        <ul class=" flex  space-x-4 items-center cursor:pointer font-md font-bold  text-center text-[#000000]  text-3xl m-2 justify-between">
            <li class="hover:bg-[#F2F3F4] hover:rounded-lg"><a href="/"> Home</a></li>
            <li class="hover:bg-[#F2F3F4] hover:rounded-lg "><a href="About.php">About</a></li>
            <li class="hover:bg-[#F2F3F4] hover:rounded-lg "><a href="galley.php"> Galley</a></li>
            <li class="hover:bg-[#F2F3F4] hover:rounded-lg "><a href="Contact.html">Contact</a></li>
        </ul>
    </div>
    </div>

    </body>
</html>

<?php
require("about.views.php");
?>