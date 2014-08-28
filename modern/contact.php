<?php

$EmailFrom = "rafaelvelez.us";
$EmailTo = "rafael.velez.c@gmail.com";
$Name = Trim(stripslashes($_POST['Name'])); 
$Email = Trim(stripslashes($_POST['Email'])); 
$Subject = Trim(stripslashes($_POST['Subject'])); 
$Message = Trim(stripslashes($_POST['Message'])); 

// validation
$validationOK=true;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
  exit;
}

// prepare email body text
$Body = "";
$Body .= "Website: modern\n";
$Body .= "Name: ";
$Body .= $Name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $Email;
$Body .= "\n";
$Body .= "Subject: ";
$Body .= $Subject;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $Message;
$Body .= "\n";

// send email 
#$success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");
$success = 1;

// redirect to success page 
if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=http://rafaelvelez.us/\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
}
?>