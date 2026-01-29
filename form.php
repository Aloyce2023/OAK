<?php
require("partial.php");
require("database.php");
require("user_input.php");

?>
<!DOCTYPE html>
<html>
    <head>
         <script src="https://kit.fontawesome.com/64fd86125c.js" crossorigin="anonymous"></script> <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class = "bg-purple-400">
        <form class = "w-full h-120 bg-purple-400 " action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "POST">
            
            <?php
            $head = "USER LOGIN FORM";
            echo"<h1 class='text-center mt-10 font-bold text-3xl font-lg'>".$head."</h1>";            
            ?>
         

             <div class = "ml-10 ">  
            <label for = "Username">Username:</label><br> 
            <input type = "text" name = "username" class= " py-4 w-45 form-control bg-white rounded-md text-center " placeholder= "Enter Username" >
            </div>

           
             <div class = "ml-10 ">  
            <label for = "Password">Password:</label><br> 
            <input type = "password" name = "password" class= " py-4 w-45 bg-white form-control rounded-md text-center " placeholder= "Enter password" >
            </div>

            
            <div class = "ml-10 py-5">
                <label for = "feedback" class = "form-label font-lg font-bold text-2xl ">Feedback:</label><br>
                <textarea class = "form-control   bg-gray-200 rounded-lg w-75  py-5 w-70 text-center text-2xl <?php echo $bodyErr ? 'is-invalid' : null ;?>" placeholder = "Please enter feedback" name = "body"></textarea>
            </div>
            <div class = "text-red-500 ml-10 ">
            </div>

                   
              <div class = "ml-10 ">  
            <label for = "Login">Login:</label><br> 
            <input type = "submit" name = "submit" class= " py-4 w-45 bg-black  text-white rounded-md text-center "  >
            </div>  
                         
        </form>
     </body>
</html>

<?php


$password=$username = $body = "";
if(isset($_POST['submit']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(empty($_POST['username']))
  {
    echo"username name is required.<br></br>";

  }
  else{

    $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
  }

  if(empty($_POST['password']))
  {
    echo"Password is required!.<br>";
  }
  else{
    $password = $_POST['password'];
    $hash = password_hash($_POST['password'] , PASSWORD_DEFAULT);

  }
 

  

  if(empty($_POST['body']))
  {
    echo"feedback is required!.<br> ";
  }
  else{
    $body = filter_input(INPUT_POST , 'body' , FILTER_SANITIZE_SPECIAL_CHARS);
  }

  if(isset($username) && isset($password) && isset($body) )
  {
    $sql ="INSERT INTO feed( username , password , body) VALUES('$username','$password','$body')";

     if(mysqli_query($conn, $sql))
            {
                header('location: Dashbord.php');
                
                exit;
            }
            else{
                echo  "Not connected";
            }
  }

  }


?>



 