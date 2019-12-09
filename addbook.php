<?php
echo "it's here";
//if(isset($_GET['logout'])){
//    session_destroy();
//    header('Location:signIn.php');
//}
if(isset($_POST['author'])) {
    echo "its here";
    $author = $_POST['author'];
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $bookid = (int)$_POST['bookid'];
    $conn = new mysqli("localhost", "root", "", 'library');
    $insertqry = "insert into books(bID,publication,author,title,stock) value (?,?,?,?,1)";
    $prepareqry = $conn->prepare($insertqry);
    $prepareqry->bind_param('isss', $author, $title, $publisher, $bookid);
    $prepareqry->execute();
    echo $prepareqry->affected_rows;
    if ($prepareqry === false) {
        echo "<h1>record not inserted</h1>";
        header('Location:addbook.php');
    }

} ?>
    <!DOCTYPE html>
    <html>
    <title>
        Add A Book
    </title>
    <head>
        <link rel="stylesheet" href="addBookStyles.css">
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
                <li class="active"><a href="addbook.php"><span class="glyphicon glyphicon-plus"></span>Add Books</a>
                </li>
                <li><a href="removebook.php"><span class="glyphicon glyphicon-log-in"></span>Remove Books</a></li>
                <li><a href="addbook.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
            </ul>
        </div>
    </nav>
<!--    --><?php
    //echo $_SESSION['id'];
//    if(!isset($_SESSION['id'])){
//        echo '<script>window.alert("Log in First")</script>';
//        header('Location:signIn.php');
//    }
    ?>
    <div class="title">Add A Book</div>
    <form action="addbook.php" style="border:1px solid #ccc" method="post">
        <div class="container">
            <label><b>Author</b></label>
            <input type="text" placeholder="Enter Author" name="author" required>

            <label><b>Title</b></label>
            <input type="text" placeholder="Enter Title" name="title" required>

            <label><b>Publisher</b></label>
            <input type="text" placeholder="Enter Publisher" name="publisher" required>

            <label><b>Book ID</b></label>
            <br>
            <input type="number" placeholder="Enter Book ID" name="bookid" required>

            <div>
                <button type="submit" class="signupbtn">Add</button>
            </div>
        </div>
    </form>
    </body>
    </html>
