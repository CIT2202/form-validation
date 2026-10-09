<?php
$errMsgs = [];
$validForm = true;
// To make sure the user hasn't accessed this page by mistake, check to see if the user has submitted the form
if(isset($_POST["submit"])){
  //To start with, assume the form is valid
  //if the user hasn't completed the email field set $validForm to false
  if(empty($_POST["email"])){
    $validForm = false;
    $errMsgs[] = "You need to enter an email address.";
  }else{
    $email = $_POST["email"];
  }

  //add some more if statements in here to test the other form controls.

}else{
  $validForm = false;
  $errMsgs[] = "You shouldn't have got to this page.";
}


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>Validating User Input</title>
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
  <h1>Validating Form Data</h1>
<?php

if($validForm){
  //we have passed all the tests so we can display the form data
  echo "<p> You entered an email address of <strong>{$email}</strong>.</p>";
}else{
  foreach($errMsgs as $msg){
    echo "<p>{$msg}</p>";
  }
  echo "<p><a href='index.html'>Go back to the form page.</a></p>";
}



?>
</body>
</html>
