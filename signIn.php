<?php
//require_once("dbconnection.php");
//$db_handle = new DBConection();
if(isset($_SESSION['id'])){
  header('Location:addbook.php');
}
if(isset($_POST["email"])){
  //  echo "here";
$emailid = $_POST["email"];
$password = $_POST["password"];
//echo $_POST['email'];
$conn = new mysqli("localhost","root","",'library');
//echo $emailid;
//echo $password;
$queryToValidate="select libID from librarian where email='$emailid' and password='$password';";
//echo $queryToValidate;
$result = $conn->query($queryToValidate);

if($result->num_rows > 0){
//    echo "now hee\n";
  //  $row = $result->fetch_row();
  $row = $result->fetch_row();
  //echo $_SESSION['id'];
    session_start();
    $_SESSION['id'] = $row[0];
    header('Location:addbook.php');
}else{
    echo '<script>';
    echo 'alert("Either your email id or password is wrong")';
    echo '</script>';
    header("Refresh:1;url=signIn.php");
}
}
 ?>
 <html>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="signupStyles.css">
 </head>


 <body>

 <nav class="navbar">
     <div class="container-fluid">
         <div class="navbar-header">
             <a class="navbar-brand" href="index.php">Library</a>
         </div>
         <ul class="nav navbar-nav navbar-right">
             <li><a href="signUp.php"><span class="glyphicon glyphicon-user"></span>Admin Sign Up</a></li>
             <li><a href="signIn.php"><span class="glyphicon glyphicon-log-in"></span>Admin Login</a></li>
         </ul>
     </div>
 </nav>

 <form action="signIn.php" method="post" name="login">

     <fieldset>
         <legend>Enter Email and Password</legend>
         <div>
             <label for="email">Enter Email Address:</label>
             <input type="text" name="email" id="email" class="txt" />
         </div>
         <div>
             <label for="password1">Enter Password:</label>
             <input type="password" name="password" id="password1" class="txt" />
         </div>
     <div>
         <input type="submit" name="btnSubmit" id="btnSubmit" value="Sign In" class="btn" />
     </div>
 </form>
 </body>
 </html>
