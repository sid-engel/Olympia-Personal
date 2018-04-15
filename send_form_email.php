<?php

/* Set e-mail recipient */
$myemail  = "info@sidengel.com";

/* Check all form inputs using check_input function */
// if (isset($_POST["submit"])) {
$name = $_GET['name'];
$email = $_GET['email'];
$message = $_GET['message'];
$captcha = $_GET['captcha'];
//}
//else {
//  echo $myError;
//  }
$subject = "SidEngel.com Contact Form";

/* If input is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid.");
}

/* Let's prepare the message for the e-mail */
$emailmessage = "Hello,
This is a form entry message from sidengel.com. Below is the information...

Name: $name
E-mail: $email

Message: $message

End of message
";

/* Send the message using mail() function */
if ($captcha == 12) {
mail($myemail, $subject, $emailmessage);

/* Redirect visitor to the thank you page */
echo "<script>
window.location.href='index.html';
alert('Thanks, your report has been submitted.');
</script>";
exit();
}
else {
  echo "<script>
  window.location.href='index.html';
  alert('Sorry, you answered the captcha incorrectly. Try again...');
  </script>";
}

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>
