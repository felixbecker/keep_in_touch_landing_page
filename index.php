<?php


  if (isset($_POST) && isset($_SESSION)) {
    $mail_to = 'enter mail address here';
    $mail_subject = 'Neuer E-Mail Subscriber';
    $flash = <<< EOT
      <div id="flash_ok" class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
        <span class="sr-only">Success:</span>
        Danke!
      </div>
    EOT;

    if ($_POST['token'] == $_SESSION['token']) {

      foreach ($_POST as $key => $value) {
        # code...

      }

      $mail_text = "Neuer Newsletter Subscriber: ".$name." mit E-Mail: ".$email;

      $mail_was_sent = @mail($mail_to,$mail_subject,$mail_text);
      if ($mail_was_sent) {

      }
    }

  }else {
    session_start();

    $token = md5(uniqid(rand(),TRUE));
    $_SESSION['token'] = $token;
    $_SESSION['token_time'] = time();
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
           <form action="" id="signUpform" class="form-inline text-center">
             <input type="hidden" name="token" value="<?php echo $token; ?>">
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
             <div id="flash_err" class="alert alert-danger" role="alert">
               <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
               <span class="sr-only">Error:</span>
               Enter a valid name and email address
             </div>

             <?php
              if ($mail_was_sent) { echo $flash;}
              ?>
           </p>

           </form>
         <p class="text-center">Promise and do not sell or send the email</p>
         <p class="text-center footer">
           &copy; Add copy information here
         </p>


       </div>
     </div>
 </div>

 <script type="text/javascript" src="scripts/main.js"></script>
 </body>
 </html>
