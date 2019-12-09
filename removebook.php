<?php
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
<form action="/action_page.php" style="border:1px solid #ccc">
    <div class="container">
        <label><b><font size="6">Title</font></b></label>
        <input type="text" placeholder="Enter Title" name="Title" required>

        <br></br>

        <label><b><font size="6">Book ID</font></b></label>
        <br>
        <input type="number" placeholder="Enter Book ID" name="BookID" required>
        <div class="clearfix">
            <br>
            <button type="submit" class="signupbtn">Remove</button>
        </div>
    </div>
</form>

</body>

</html>
