<?php
session_start();
require 'db_connection.php';
if ($_SESSION['login'] != "Active") {
    header("location:login_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="WholeSaler/styles.css" type="text/css" />
    <title>Whole Saler Login</title>
</head>

<body>
    <section id="body" class="width">
        <?php require 'sidebar.php' ?>
        <section id="content" class="column-right">
            <article>

                <fieldset>
                    <legend>
                        <h3>Catagories of products</h3>
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
                    <form action="all_stocks.php" method="POST">
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
                            <th>SupplierID</th>
                            <th>Quantity</th>
                            <th>CostPrice</th>
                            <th>SellPrice</th>
                            <th>ReorderLevel</th>
                        </tr>
                    <?php
    				
                    $sql1 = "SELECT CategoryID,Pname,product.ProductID AS product,SupplierID,Quantity_in_stock,UnitPrice,USP,ReorderLevel
                    FROM product,price_list
                    WHERE price_list.ProductID = product.ProductID
                    AND CategoryID = '$catagoryID'";
    				$result = mysqli_query($db_conn,$sql1);

    				$row1 = mysqli_fetch_assoc($result);
    				do { ?>
                        <tr>
                            <td><?php echo $row1['CategoryID']; ?></td>
                            <td><?php echo $row1['Pname']; ?></td>
                            <td><?php echo $row1['product']; ?></td>
                            <td><?php echo $row1['SupplierID']; ?></td>
                            <td><?php echo $row1['Quantity_in_stock']; ?></td>
                            <td><?php echo $row1['UnitPrice']; ?></td>
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
            <?php require 'footer.html'; ?>
        </section>

        <div class="clear"></div>
    </section>
</body>

</html>