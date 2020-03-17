<?php
session_start();
require 'db_connection.php';
if($_SESSION['login']!="Active")
{
    header("location:login_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="WholeSaler/styles.css" type="text/css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <title>Whole Saler Login</title>
</head>

<body>
    <section id="body" class="width">
        <?php require 'sidebar.php' ?>
        <section id="content" class="column-right">
            <article>
                <fieldset>
                    <legend>
                        <h3>Categories of products</h3>
                    </legend>
                    <table>
                        <tr>
                            <th>CategoryID</th>
                            <th>CategoryName</th>
                        </tr>
                        <?php
                        $conn = mysqli_connect("localhost","root","","WholeSale_Management");
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn,$sql);

                        $row = mysqli_fetch_assoc($result);
                        do { ?>
                            <tr>
                                <td><?php echo $row['CategoryID']; ?></td>
                                <td><?php echo $row['CategoryName']; ?></td>
                            </tr>
                        <?php } while($row = mysqli_fetch_assoc($result)) ?>
                        <tr>
                    </table>
                </fieldset>

                <fieldset>
                    <legend>
                        <h3>Select Category</h3>
                    </legend>
                    <form action="catag.php" method="POST">
                        <p><label for="ID"><strong>CategoryID:</strong></label>
                            <input type="text" name="CategoryID" id="ID" placeholder="CatagoryID" required /><b /></p>
                        <p><input type="submit" name="pshow" class="formbutton" value="Show Products" /></p>
                    </form>
                </fieldset>

                <?php if(isset($_POST['pshow'])) {
                $catagoryID = $_POST['CategoryID'];
                ?>
                <fieldset>
                    <legend>
                        <h3>Products Under CategoryID <?php echo $catagoryID ?></h3>
                    </legend>
                    <table>
                        <tr>
                            <th>CategoryID</th>
                            <th>Pname</th>
                            <th>ProductID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>ReorderLevel</th>
                        </tr>
                        <?php
                            $sql1 = "SELECT CategoryID,Pname,product.ProductID AS product,Quantity_in_stock,USP,ReorderLevel
                                    FROM product,price_list
                                    WHERE  CategoryID = '$catagoryID'
                                    AND price_list.ProductID = product.ProductID";
                            $result = mysqli_query($db_conn,$sql1);
                            $row1 = mysqli_fetch_assoc($result);
    				do { ?>
                        <tr>
                            <td><?php echo $row1['CategoryID']; ?></td>
                            <td><?php echo $row1['Pname']; ?></td>
                            <td><?php echo $row1['product']; ?></td>
                            <td><?php echo $row1['Quantity_in_stock']; ?></td>
                            <td><?php echo $row1['USP']; ?></td>
                            <td><?php echo $row1['ReorderLevel']; ?></td>
                        </tr>
                        <?php } while($row1 = mysqli_fetch_assoc($result)) ?>
                        <tr>
                    </table>
                </fieldset>
                <?php } ?>
                <br> <br><br><br><br><br><br><br>
            </article>
        </section>
        <?php require 'footer.html';?>
    </section>
</body>

</html>