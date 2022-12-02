<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/signlasuite.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
  <?php
function displayError()
{
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == "emp_value") {
            echo "<span style='color:red;'>Place in all values</span>";
        } else if ($error == "mail") {
            echo "<span style='color:red;'>This email has been used</span>";
        } else if ($error == "uname") {
            echo "<span style='color:red;'>This username has been used</span>";
        } else if ($error == "mail_err") {
            echo "<span style='color:red;'>Kindly make sure your email is typed properly</span>";
        } else if ($error == "input_err") {
            echo "<span style='color:red;'>Username should contain characters</span>";
        } else if ($error == "pwd_len") {
            echo "<span style='color:red;'>Password should contain atleast 7 characters for the safety of your account</span>";
        } else if ($error == "access") {
            echo "<span style='color:red;'>Inputs are neccessary</span>";

        } else if ($error == "wrngtkn") {
            echo "<span style='color:red;'>Expired or Wrong token</span>";
        } else if ($error == "none") {
            echo "<span style='color:green;'>Succesful!! </span>click the<span style='color:white;'>sign in &darr;</span>";
        } else if ($error == "gettknerr") {
            echo "<span style='color:red;'>Token Does Not Exist Regenerate!</span>";
        } else if ($error == "logusermail_exist") {
            echo "<span style='color:red;'>You have entered the wrong email or pasword</span>";
        } else if ($error == "logpwd_err") {
            echo "<span style='color:red;'>You have entered the wrong password Sign in</span>";
        } else if ($error == "empt_log") {
            echo "<span style='color:red;'>You should fill in all input</span>";
        } else if ($error == "logusermail_exist") {
            echo "<span style='color:red;'>We are cureently working on the site please try again later</span>";
        } else {
            echo "<span></span>";
        }
    } else {
        echo "<span></span>";
    }
}
?>
<div class="main_cont">
    <div class="welcome">
        What's up Lasuite? <br>Share Whats happening around you and Keep up with other Lasuites!!!
    </div>
        <div class="form_cont">
            <form method="POST" action="signlasuite.c.php">
                    <input name="username" type="text" placeholder="Username">
                    <input name="email"  type="email" placeholder="Email">
                    <input name="p_word"  type="password" minlength="6" placeholder="Password">
                    <button name="submit" type="submit" >SIGN UP</button>
                    <b><?php displayError()?></b>
                    <span>Have an account?<a href=""> sign in</a></span>
            <i><a href="">Forgot your password?</a></i>
            </form>
        </div>
 </div>
 <!-- DESKTOP SIGNUP AND LOGIN PAGE-->
 <div class="desk_main_cont">
    <div class="desk_img">
        <div class="desk_welcome">
       <p> WHAT'S UP LASUITE?</p>
       <p>*SHARE WHATS HAPPENING AROUND YOU</p>
       <p>*KEEP UP WITH OTHER LASUITE </p>
        <p>*A SOCIAL SPACE FOR ALL LASUITES!!!</p>
        </div>
    </div>
    <div class="desk_form">
    <form method="POST" action="signlasuite.c.php">
    <input name="username" type="text" placeholder="Username">
                    <input name="email" type="email" placeholder="Email">
                    <input name="p_word"  type="password" placeholder="Password" minlength="6">
                    <button name="submit" type="submit" >SIGN UP</button>
                    <b><?php displayError()?></b>
                    <span>Have an account?<a href=""> sign in</a></span>
            <i><a href="">Forgot your password?</a></i>
            </form>
    </div>
 </div>

</body>
<!-- JAVASCRIPT -->
<script>
  let signup=  document.querySelector("form span a");
  let getStatus=  document.querySelectorAll("form span ")[1];
  let getButton=  document.querySelector("button");
  let form =document.querySelector("form");
let stat = true;
    //MOBILE JS
  signup.addEventListener('click',((e)=>{
    e.preventDefault()
   let inputs= document.querySelectorAll("form input");
   if(stat == true ){
  inputs.forEach((element)=>{
    if(element.type == "email"){
        element.value ="";
    element.style.display ="none";
   getStatus.innerHTML ='Dont have an account?<a href=" "> sign up</a>';
   form.setAttribute("action","loglasuite.c.php");
   getButton.textContent = "SIGN IN";
   console.log("clicked");
   inputs[0].setAttribute("placeholder","username/email");
  //  document.querySelectorAll("form span ")[0].innerHTML="";
    stat=false;
  }
  })
}
else{
    getStatus.innerHTML ='Have an account?<a href=""> sign in</a>';
    form.setAttribute("action","signlasuite.c.php");
    getButton.textContent = "SIGN UP";
    console.log("clicked");
    element.style.display ="block";
    inputs[0].setAttribute("placeholder","Username");
    stat = true;
}
  }));
  //DESKTOP JS
  let desktop = ()=>
  {
    let signup=  document.querySelector(".desk_form form span a");
  let getStatus=  document.querySelectorAll(".desk_form form span ")[1];
  let getButton=  document.querySelector(".desk_form button");
  let form =document.querySelector(".desk_form form");
  signup.addEventListener('click',((e)=>{
    e.preventDefault()
   let inputs= document.querySelectorAll(".desk_form form input");
  inputs.forEach((element)=>{
  if(stat == true ){
    if(element.type == "email"){
    element.style.display ="none";
   stat=false;
   getStatus.innerHTML ='Dont have an account?<a href=" "> sign up</a>';
   form.setAttribute("action","loglasuite.c.php");
   getButton.textContent = "SIGN IN";
   console.log("clicked");
}
  }
  else{
    if(element.type == "email")
  {
    element.style.display ="block";
    stat = true;
    getStatus.innerHTML ='Have an account?<a href=""> sign in</a>';
    form.setAttribute("action","signlasuite.c.php");
    getButton.textContent = "SIGN UP";
}
  }
  })
  }))
  }
  desktop();
</script>

</html>
