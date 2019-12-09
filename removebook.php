<?php
if(isset($_POST['title']) && $_POST['bookid']){
    $conn = new mysqli("localhost", "root", "", 'library');
    $title = $_POST['title'];
    $bookid = (int)$_POST['bookid'];
    $deleterecord = "delete from books where bID=? and title =?";
    $prepareqry = $conn->prepare($deleterecord);
    $prepareqry->bind_param('is', $bookid,$title);
    $prepareqry->execute();

    if ($prepareqry === false) {
        echo "<h1>record not inserted</h1>";
        header('Location:removebook.php');
    }else{
        echo "<script> alert('Data successfully deleted')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="removeBookStyles.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Library</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li ><a href="addbook.php"><span class="glyphicon glyphicon-plus"></span>Add Books</a></li>
            <li class="active"><a href="removebook.php"><span class="glyphicon glyphicon-remove"></span>Remove Books</a></li>
        </ul>
    </div>
</nav>
<h2 align="center"><font size="10">Remove A Book</font></h2>
<form action="removebook.php" style="border:1px solid #ccc" method="post">
    <div class="container">
        <label><b><font size="6">Title</font></b></label><br>
        <input type="text" placeholder="Enter Title" name="title" required>

        <br>

        <label><b><font size="6">Book ID</font></b></label>
        <br>
        <input type="number" placeholder="Enter Book ID" name="bookid" required>
        <div class="clearfix">
            <br>
            <button type="submit" class="signupbtn">Remove</button>
        </div>
    </div>
</form>

</body>

</html>
