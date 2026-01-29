<?php
// Here we re
require("database.php");
require("user_input.php");


  ?>

  <?php
  // The syntax of fetch data stored from database.
  $sql = 'SELECT * FROM feed';
  $result = mysqli_query($conn, $sql);
  $user_input = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  ?>

<!DOCTYPE html>
<html>
    <head>
    <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script> <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class ="bg-">
         <?php 
         //syntax for display the out put from the database.
         // ?> 
        
        <div class="h-20 w-full bg-green-300 text-center  items-center">
         <h1 class = "text-center font-bold  py-4  font-lg text-4xl"> USER FEEDBACK </h1>
         </div>
       <?php foreach($user_input as $items ): ?>
        <div class = "card  my-2  bg-blue-400  w-full   rounded-lg ">
            <div  class = "text-center my-4 py-5 card-body ">
                <?php echo $items['username']; ?>  <h6>By</h6> <?php echo $items['password'];?>
       </div>
       </div>
       <?php endforeach;?> 
       </body>
       </html> 