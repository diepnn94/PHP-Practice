
<?php

$phoneErr=$nameErr=$emailErr=$name=$email=$phone=$message=$result="";
$emailBox = "amy94nguyen@gmail.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["message"];
  $valid = 0;
  $name = trim($name);
  $message = trim($message);
  $phone = trim($phone);
  $email = trim($email);

  if (!preg_match("/^[a-zA-Z\s-]*$/", $name)){
    $nameErr = "Name should contain only letters.";
    $valid++;
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $emailErr = "Invalid email format.";
    $valid++;
  }
  if (strlen($phone) != 10 || !preg_match("/^[0-9]*$/", $phone) ) {
    $phoneErr = "Please include the area code with 10 digits total and no spaces or dashes in between.";
    $valid++;
  }

  if ($valid == 0){
    $result = '<div class="alert alert-success">Thank You, someone will get back to you shortly.</div>';
    $subject = "Contact Form: Request from $name";
    $header = "From: $email \r\n";
    $customMessage = "\nSender Name: $name \nEmail: $email \nPhone: $phone \n\nMessage: \n$message";
    mail($emailBox, $subject, $customMessage, $header);
    $phoneErr=$name=$email=$phone=$message="";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
  .error {color: #FF0000;}
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <div class="row"style="background-color:black; color:white;width:100%;">
    <div class="col-lg-offset-5 col-lg-4 col-md-offset-5 col-md-4 col-sm-offset-5 col-sm-6 col-xs-offset-4 col-xs-8">
      <h2>Contact Form</h2>
        <br>
    </div>
  </div>

  <div class="container">
    <br>
  <form class="form-horizontal" method="post" action="contactForm.php">
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-8 col-md-offset-3 col-md-8 col-sm-offset-2 col-sm-8">
        <?php echo $result;?>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-md-offset-1 col-lg-offset-1 col-sm-4 col-md-4 col-lg-4">
        <h3>Send an <b>EMAIL</b></h3>
        <br>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-md-3 col-lg-2" >Name:</label>
      <div class="col-sm-10 col-md-8 col-lg-8">
        <input type="text" class="form-control" placeholder="Enter Full Name"
        name="name" value="<?php echo $name;?>"required>
        <?php echo "<p class='text-danger'> $nameErr </p>"; ?>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-md-3 col-lg-2" >Email:</label>
      <div class="col-sm-10 col-md-8 col-lg-8">
        <input type="email" class="form-control" placeholder="Enter Email" name="email"
        value="<?php echo $email;?>" required>
        <?php echo "<p class='text-danger'> $emailErr </p>"; ?>

      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-md-3 col-lg-2"  >Phone:</label>
      <div class="col-sm-10 col-md-8 col-lg-8">
        <input type="tel" class="form-control" placeholder="Enter Phone Number with Area Code"
        name="phone" value="<?php echo $phone;?>"required>
        <?php echo "<p class='text-danger'> $phoneErr </p>"; ?>
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2 col-md-3 col-lg-2">Message:</label>
      <div class="col-sm-10 col-md-8 col-lg-8">
        <textarea class="form-control" rows="5" name="message"
           placeholder="Enter Message Here...."
          required><?php echo htmlspecialchars($message);?></textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10 col-md-offset-3 col-md-4 col-lg-offset-2 col-lg-3">
        <button type="submit" class="btn btn-default">Send</button>
      </div>
    </div>
  </form>

  <br><br><br><hr>
  <section style="bottom:0;">
    <br>
    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-4">
      <h3>Office</h3>
      <p>WebDesign Institution</p>
      <p class="small">1234 Huntington Beach</p>
      <p class="small">California, CA 92647</p>
    </div>
    <div class="col-lg-offset-2 col-lg-5 col-md-offset-2 col-md-5 col-sm-offset-2 col-sm-4 col-xs-offset-2 col-xs-4">
      <h3 >Follow us on </h3>
        <a href="#"><span class="fa fa-facebook" aria-hidden="true"></span> Facebook</a><br>
        <a href="#"><span class="fa fa-instagram" aria-hidden="true"></span> Instagram</a><br>
        <a href="#"><span class="fa fa-twitter" aria-hidden="true"></span> Twitter</a><br>
    </div>
  </section>
  <br>
</div>


</body>
</html>
