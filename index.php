<?php

$conn = new mysqli("localhost","root","","library");//this gets a database connection
if(isset($_POST['search'])){//this checks if the data record search is in the POST array
    $tosearch = $_POST['search'];// we store it in a local variable
    $queryToRun = "select * from books where title like '%". $tosearch . "%';" ; //string query to match for similar book title
    $result=$conn->query($queryToRun);//run the query
    while($row=mysqli_fetch_assoc($result)) {
        $product_array[] = $row;//store in product array
    }
    unset($_POST['search']);
}


if(isset($_GET["action"])) {
    //$_GET['bid']=140177396;

    $bookid = $_GET['bid'];

    $stockquery = "select stock from books where bID=$bookid;";
    $result = $conn->query($stockquery);

    $row = $result->fetch_row();
    if ($_GET["action"] == "checkout") {
        $updatecount = $row[0] - 1;
    } else if ($_GET["action"] == "return") {
        $updatecount = $row[0] + 1;
    }

    $fireQuery = "update books set stock =? where bID=?;";
    $statement = $conn->prepare($fireQuery);
    $statement->bind_param('is', $updatecount, $bookid);
    $statement->execute();
    header("url:http://localhost/index.php");

    if ($statement === false) {
        echo trigger_error($this->mysqli->error, E_USER_ERROR);
    }
//            $result = $conn->query("SELECT * FROM books ORDER BY bID ASC");
//            while ($row = mysqli_fetch_assoc($result)) {
//                $product_array[] = $row;
//            }
//
//        }
    header("url=index.php");

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
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
            <?php
            if(isset($_GET['id'])){
                ?>
                <li><a href="addbook.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>Log Out</a></li>
                <?php
            }else{
            ?>
            <li><a href="signUp.php"><span class="glyphicon glyphicon-user"></span>Admin Sign Up</a></li>
            <li><a href="signIn.php"><span class="glyphicon glyphicon-log-in"></span>Admin Login</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</nav>

<form class="example" action="/index.php" method="post">
    <!-- should search and show results -->
    <input type="text" placeholder="Search.." name="search">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>

<br></br>

<table id="myTable">
    <tr class="header">
        <th >BookId</th>
        <th >Title</th>
        <th >Author</th>
        <th >Publisher</th>
        <th >Stock</th>
        <th ></th>
        <th ></th>
        </tr>
    <?php
    if(!isset($product_array)) {
        $result = $conn->query("SELECT * FROM books ORDER BY bID ASC");
        while ($row = mysqli_fetch_assoc($result)) {
            $product_array[] = $row;
        }
    }
    if (!empty($product_array)) {
    foreach($product_array as $key=>$value){
    ?>
    <tr>
        <td><?php echo $product_array[$key]["bID"]; ?></td>
        <td><?php echo $product_array[$key]["title"]; ?></td>
        <td><?php echo $product_array[$key]["author"]; ?></td>
        <td><?php echo $product_array[$key]["publication"]; ?></td>
        <td><?php echo $product_array[$key]["stock"]; ?></td>
        <td>
           <!--<form name = "test" action = "index.php?action=checkout&bid=<?php /*echo $product_array[$key]["bID"]; */?>" method="post">-->
            <a href="index.php?action=checkout&bid=<?php echo $product_array[$key]["bID"];?>" type="submit" id="btntoclick"
               class="bton">Check out</a>
               <!--value=<?php /*echo $product_array[$key]["bID"]; */?> >Check Out</a>
               --> <!-- should delete 1 from Stock & update on screen -->
      <!--      </form>-->

        </td>
        <td>
            <a href="index.php?action=return&bid=<?php echo $product_array[$key]["bID"];?>" type="submit" id="btntoclick"
               class="bton">Return</a>
        </td>
        <td>

    </tr>
        <?php
    }
    }
    ?>

</table>

<script>

function callMe(){
    var xhttp = new XMLHttpRequest();
    // xhttp.onreadystatechange = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //         document.getElementById("demo").innerHTML = this.responseText;
    //     }
    // };
    var bId = document.getElementById("btntoclick").value;
    xhttp.open("POST", "./index.php",true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("act=checkout&bid="+bId);
    //xhttp.send();
}
</script>
</body>

</html>
