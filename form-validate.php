<?php
// To make sure the user hasn't accessed this page by mistake, check to see if the user has submitted the form
if(isset($_POST["submit"])){
  $validForm = true;

  //if the user hasn't completed the email field set $validForm to false
  if(empty($_POST["email"])){
    $validForm = false;
  }else{
    $email = $_POST["email"];
  }

  //add some more if statements in here to test the other form controls.

}else{
  //terminates the current script see https://www.php.net/manual/en/function.exit.php
  exit("You shouldn't have got to this page.");
}


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>Basic Form Processing</title>
</head>
<body>
<?php

if($validForm){
  //we have passed all the tests so we can display the form data
  echo "<p> You entered an email address of {$email}.</p>";
}else{
  echo "<p>You need to complete all the fields. <a href='html-forms.html'>Go back and try again.</a></p>";
}



?>
</body>
</html>
