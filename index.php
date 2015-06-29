<?php


$flash = <<< FLASH
  <div id="flash_ok" class="alert alert-success" role="alert">
     <div class="text-center">
     <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
     <span class="sr-only">Success:</span>
     Danke!
     </div>
   </div>
FLASH;
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $key = $_POST['tokenkey'];
    $token = $_POST['token'];
    if ($token == $_SESSION[$key]) {

      $email = $_POST['sign_up_email'];
      $name = $_POST['sign_up_name'];

      if(preg_match("/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i",$email)
        && strlen(trim($name)) > 0){
          $mail_to = '### ADD Target E-Mail ###';
          $mail_subject = '### DEFINE SUBJECT LINE FOR MAILS';


        $mail_text = "## DEFINE TEXT FOR MAIL \r\n Name: ".$name." - E-Mail: ".$email;
        $headers = "From: ".$email."\r\n";
        $mail_was_sent = mail($mail_to,$mail_subject,$mail_text,$headers);

        if ($mail_was_sent) {
          header('Location: ./?done=success', true, 303);
          exit;

        }else {
          header('Location: ./?done=error',true,303);
          exit;

        }

      }else{
        header('Location: ./?done=error',true,303);
        exit;

      }

      exit;


    }else {
      header('Location: ./?done=error',true,303);
      exit;

    }

  }else{

      $token = md5(uniqid(rand(),TRUE));
      $key = substr(md5(microtime()),rand(0,26),5);
      $_SESSION[$key] = $token;
      $_SESSION['token_time'] = time();
      $done = $_GET['done'];

  }



 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Landing page title</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/styles.css" media="screen" charset="utf-8">
 </head>
 <body>
   <div class="container">

     <div class="row">
       <div class="col-md-6 col-md-offset-3 panel panel-default">
         <header>
           <p class="text-center">
              Put LOGO Image here
           </p>
         </header>
         <h3 class="text-center">Have some Header Text here</h3>

         <p class="text-center">
           Have some info teaser text here
         </p>

         <?php
               $showErrorFlash = $done != 'error' || $done == NULL ? ' hide':'';
               if ($done == 'success') {
                 echo $flash;
               }else{
                 ?>

                 <form action="index.php" method="post" id="signUpform" class="form-inline text-center">
                   <input type="hidden" name="token" value="<?php echo $token; ?>">
                   <input type="hidden" name="tokenkey" value="<?php echo $key; ?>">
                   <div class="form-group">
                       <label class="sr-only" for="name">Name</label>
                       <input name="sign_up_name" id="sign_up_name" type="text" class="form-control" placeholder="Name">
                   </div>
                   <div class="form-group">
                     <label class="sr-only" for="email">Name</label>
                     <input name="sign_up_email" id="sign_up_email" type="text" class="form-control" placeholder="E-Mail">
                   </div>
                 <button type="submit" class="btn btn-pink">und los!</button>
                 <p>
                   <div id="flash_err" class="alert alert-danger <?php echo $showErrorFlash ?>" role="alert">
                     <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                     <span class="sr-only">Error:</span>
                     Enter a valid name and email address
                   </div>
                </p>
              </form>

                 <?php
               }
               ?>


         <p class="text-center">Promise and do not sell or send the email</p>
         <p class="text-center footer">
           &copy; Add copy information here
         </p>


       </div>
     </div>
 </div>

 <script type="text/javascript" src="js/script.min.js"></script>
 </body>
 </html>
