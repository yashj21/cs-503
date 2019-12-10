<?php
if(isset($_GET['logout'])){
    unset($_SESSION['id']);
    session_destroy();
    header('Location:signIn.php');
}
if(isset($_POST['author'])) {

    $author = $_POST['author'];
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $bookid = $_POST['bookid'];
    $conn = new mysqli("localhost", "root", "", 'library');
    $insertqry = "insert into books(bID,publication,author,title,stock) value (?,?,?,?,1)";
    $prepareqry = $conn->prepare($insertqry);
    $prepareqry->bind_param('isss', $bookid, $author, $title,$publisher);
    $prepareqry->execute();
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

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="addBookStyles.css">

    </head>
    <style>
        .title{
            text-align: center;
            color: white;
            font-size: 50px;
            padding-top: 20px;
        }
        form{
            width: 50%;
            margin-left: 300px;
        }

        input[type=text], input[type=password],input[type=number] {
            width: 90%;
            padding: 12px 20px;
            margin: 8px 20px;
            display: grid;
            border: 2px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #288db5;
            color: white;
            padding: 15px 20px;
            margin: 8px 20px;
            cursor: pointer;
            width: 50%;
        }

        .container {
            padding: 16px;
        }

        h2{
            text-align: center;
            font-family: Arial, Helvetica, sans-serif
        }
        label{
            display: grid;
            max-width: 40%;!important;
            margin-bottom: 5px;!important;
            font-size: large;!important;
            margin-left: 20px;!important;
        }

    </style>
    <body>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php?id=<?php
                if(isset($_SESSION['id']))echo urlencode($_SESSION['id']);?>">Library</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="addbook.php"><span class="glyphicon glyphicon-plus"></span>Add Books</a>
                </li>
                <li><a href="removebook.php"><span class="glyphicon glyphicon-log-in"></span>Remove Books</a></li>
                <li><a href="addbook.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
            </ul>
        </div>
    </nav>

    <h2 align="center"><font size="10">Add A Book</font></h2>
    <form action="addbook.php" style="border:1px solid #ccc" method="post">

            <label><b>Author</b></label>
            <input type="text" placeholder="Enter Author" name="author" required>

            <label><b>Title</b></label>
            <input type="text" placeholder="Enter Title" name="title" required>

            <label><b>Publisher</b></label>
            <input type="text" placeholder="Enter Publisher" name="publisher" required>

            <label><b>Book ID</b></label>

            <input type="number" placeholder="Enter Book ID" name="bookid" required>

            <div>
                <button type="submit" class="signupbtn">Add</button>
            </div>

    </form>
    </body>
    </html>
