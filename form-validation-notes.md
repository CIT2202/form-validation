# Validating user input
When a user submits a form we usually need to check:
* Has the user submitted the form (or have they somehow managed to get to the processing page without completing the form first)?
* Has the user completed all the fields
* Have they entered sensible values? We'll consider this later in the module.

## Has the user submitted the form?
A commonly used approach is to test for the existence of the submit button variable.

To do this we use a PHP function, *isset()*. Here's a simple (and pointless) example that doesn't involve HTML forms:

```php
<?php
$someVar;
if(isset($someVar)){
    echo "someVar exists"; //echo statement is run, $someVar exists
}
if(isset($aDifferentVar)){
    echo "aDifferentVar exists"; //echo statement not run, $aDifferentVar doesn't exist
}
?>
```

Here's another example showing how we can test if the user has submitted a form:

```html
<form action="formchecker.php" method="POST">
<p>
<label for="uname">Name:</label><input type="text" name="uname" id="uname">
<label for="col">Favourite colour:</label><input type="text" name="col" id="col">
<input type="submit" name="submitBtn">
</p>
</form>

```
Here's the page that will process the form, *formchecker.php*.
```php
<?php
if(isset($_POST["submitBtn"])){
    echo "You submitted the form";
}else{
    echo "You shouldn't have got to this page";
}
?>
```
By checking for the existence of ```$_POST["submitBtn"]``` we can tell if the user has submitted the form.

## Using *isset* to test radio buttons
We can also *isset* to check if the user has selected from a group of radio buttons.

```html
...
<form action="city_test.php" method="POST">
<fieldset>
<legend>What is the capital city of Venezuela?</legend>
<label for="sucre_rb">Sucre</label>
<input type="radio" id="sucre_rb" value="Sucre" name="answer">
<label for="sucre_rb">Caracas</label>
<input type="radio" id="caracas_rb" value="Caracas" name="answer">
<label for="sucre_rb">Lima</label>
<input type="radio" id="lima_rb" value="Lima" name="answer">
<input type="submit"/>
</form>
...
```

Here's the page that will process the form, *city_test.php*.

```php
<?php
if(isset($_POST["answer"])){
    $answer=$_POST["answer"];
    if($answer==='Caracas'){
        echo 'Well done you are correct';
    }else{
        echo "You answered {$answer} that's not right";
    }
}else{
    echo "You didn't answer, go back and try again";
}
?>
```

* If the user didn’t answer the question ```$_POST["answer"]``` doesn't exist and the else action is executed.
* If they did answer the question a second (nested) if statement tests if they answered correctly
* We can test checkboxes, radio buttons and submit buttons to see if they have been set


## Using *empty* to test text fields
We can't use *isset* with text fields because text fields will always have a value. If the user doesn't enter anything this value will be an empty string i.e. "". Instead we need to test if the variable is *empty*, the variable exists but doesn't have a value. Have a look at the following example.

```html
<form action="somepage.php" method="POST">
<p>
<label for="uname">Name:</label><input type="text" name="uname" id="uname">
<label for="col">Favourite colour:</label><input type="text" name="col" id="col">
<input type="submit" name="submitBtn">
</p>
</form>
```

This is the page that will process the form, *somepage.php*.
```php
<?php
if(empty($_POST["uname"])){
    echo "You need to enter a username";
}else{
    $uname = $_POST["uname"];
    echo $uname;
}
?>

```

In this example, if the user hasn't entered anything into the text box, the error message will be triggered.

## Form processing - good practices

### Use shorter variable names
A common approach when form processing is to store values from ```$_POST``` in another variable. This variable will be shorter in length so will be easier to work with. Here's an example:
```php
<?php
$uname=$_POST["uname"];
$col=$_POST["col"];
echo "Your favourite colour is {$col}.";
?>
```

### Separate PHP code from HTML
Form processing code can quickly become messy. We should try to keep the PHP code as separate as we can from the HTML code.
* Do the bulk of the PHP code at the top of the page before the HTML.
* Assign values to variables.
* The PHP in the HTML is used for displaying messages.

Have a look at the following example. The large block of PHP at the top of the page doesn't feature any echo statements. Instead we store messages in variables e.g. ```$err_msg```. See how we concatenate the error messages i.e. ```$err_msg.=```. This means add to the existing string. The PHP in the actual HTML page is simply used to display messages for the user.

```html
<form action="somepage.php" method="POST">
<p>
<label for="uname">Name:</label><input type="text" name="uname" id="uname">
<label for="col">Favourite colour:</label><input type="text" name="col" id="col">
<input type="submit" name="submitBtn">
</p>
</form>
```

This is the page that will process the form, somepage.php.

```php
<?php
$uname;
$col;
$err_msg="";
$errors=false;
if(isset($_POST['submitBtn'])){ //has the form been submitted
    $uname=trim($_POST['uname']); //trim removes whitespace form the start and end of a string
    $col=trim($_POST['col']);
    if(empty($uname)){ //have they entered a username
        $errors=true;
        $err_msg.="<p>You need to enter a username.</p>";
    }
    if(empty($col)){ //have they entered a colour
        $errors=true;
        $err_msg.="<p>You need to enter a colour.</p>";
    }
}else{
    $errors=true;
    $err_msg.="<p>You shouldn't have got to this page</p>";
}   
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Your page</title>
</head>
<body>
<?php
if($errors){
    echo $err_msg;
}else{
    echo "Welcome {$uname}. Your favourite colour is {$col}.</p>";
}
?>
</body>
</html>
```
