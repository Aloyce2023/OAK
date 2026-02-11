const submit = document.getElementById("submit");
submit.addEventListener("click" , () => {

const Myform = document.getElementById("Myform");
const username = document.getElementById("username").value;
const body = document.getElementById("body").value;
const password = document.getElementById("password").value;

if(validate(username , body , password))
{
    Myform.reset();
}



});

function validate( username , body , password){

if(username.trim() ==="")
{
    alert("Please provide the username!");
    username.focus();
    return false;
}

if(body.trim() ==="")
{
    alert("Please provide the email!");
    body.focus();
    return false;
}

 if(password.trim() ==="")
 {
    alert("Please provide the Password!");
    password.focus();
    return false;
 }


return true;

}