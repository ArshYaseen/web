<?php 
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $uni_name = $_POST['uni_name'];
  $password = $_POST['password'];

  $conn = new mysqli('localhost', 'root', '', 'final');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$sql = "INSERT INTO stdinfo (name, email, age, universityName, password )
VALUES ($name, $email,  $age, $uni_name, $password )";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

if(isset($_POST['login_submit'])){
  session_start();
  $email = $_POST['login_email'];
  $password = $_POST['login_password'];
  $conn = new mysqli('localhost', 'root', '', 'final');


  $sql = $conn->prepare("SELECT * FROM stdinfo WHERE email='$email'");

  $sql->execute();

  $result = $sql->num_rows;
 
  if ($result > 0){
    
    $_SESSION["login_email"] = $email;
    $_SESSION["login_password"] = $password;
    header("location: dashboard.php");
  }
    
  return 0;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <!--<title> WAD Final Paper </title>-->
  <link rel="stylesheet" href="assets/loginstyle.css" />
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <div class="header">
    <img src="assets/logo.png" alt="" />
  </div>
  <div class="container">
    <input type="checkbox" id="flip" />
    <div class="cover">
      <div class="front">
        <div class="text">
          <span class="text-1">Web Application <br />Development</span>
          <span class="text-2">Select Login / Signup now button to coverup the page</span>
        </div>
      </div>

      <div class="back">
        <div class="text">
          <span class="text-1">Web Application <br />Development</span>
          <span class="text-2">Select Login / Signup now button to coverup the page</span>
        </div>
      </div>
    </div>
    <!-- These are the front-end files, so thats why their extension is .html, you will change them as required. -->
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <!-- Login section starts from here, make sure that you will add form action and method by your own choice.  -->
          <!-- Make sure that on Successful login, it will start the session, and add user details into the given database. -->
          <!-- For login - if the user find inside the given db, it will redirect the user to dashboard.php -->

          <div class="title">Login</div>
          <form action="" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" name="login_email" required />
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="login_password" required />
              </div>
              <div class="button input-box">
                <input type="submit" value="Sumbit" name="login_submit" />
              </div>
              <div class="text sign-up-text">
                Don't have an account? <label for="flip">Sigup now</label>
              </div>
            </div>
          </form>

          <!-- Login form ends from here -->
        </div>

        <div class="signup-form">
          <!-- registration form starts from here.  -->
          <div class="title">Signup</div>
          <!-- you can set action and method by your own choice to register the member -->
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your name" name="name" required />
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" name ="email" required />
              </div>
              <div class="input-box">
                <i class="fas fa-calendar"></i>
                <input type="text" placeholder="Enter your Age" name="age" required />
              </div>
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your University Name" name="uni_name" required />
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="password" required />
              </div>
              <div class="button input-box">
                <input type="submit" value="Sumbit" name="submit" />
              </div>
              <div class="text sign-up-text">
                Already have an account? <label for="flip">Login now</label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

