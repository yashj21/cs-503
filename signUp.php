<?php
if((isset($_POST['email']))){
    echo $_POST['email'];
    $emailid = $_POST['email'];
    $password = $_POST['password1'];
    $lid= $_POST['LID'];
    $name = $_POST['name'];
    $conn = new mysqli('localhost',"root","",'library');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql="INSERT INTO librarian (libID,email,password,name) VALUES (?,?,?,?);";
    echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss",$lid,$emailid,$password,$name);
    $stmt->execute();
    session_start();
    header('Location:signIn.php');
}
?>

<html>
<title>
    Librarian Sign Up
</title>
<head>
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
<h1>Sign In</h1>
<form method="post" action="signUp.php">
    <fieldset>
        <legend>Personal Information</legend>
        <div>
            <label for="name">Enter Name:</label>
            <input type="text" name="name"  class="txt" />
        </div>
        <div>
            <label for="ID">Enter Librarian ID:</label>
            <input type="text" name="LID" id="LID" class="txt" />
        </div>
        <div>
            <label for="email">Enter Email Address:</label>
            <input type="text" name="email" id="email" class="txt" />
        </div>
        <div>
            <label for="password1">Enter Password:</label>
            <input type="password" name="password1" id="password1" class="txt" />
        </div>
        <div>
            <label for="passwordconfirm">Confirm Password:</label>
            <input type="password" name="passwordconfirm" id="passwordconfirm" class="txt" />
        </div>
    </fieldset>
    <div>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Sign Up" class="btn" />
    </div>
</form>
</body>

</html>