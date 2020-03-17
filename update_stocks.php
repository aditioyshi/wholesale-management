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
            <article style="height: 1150px">
                <fieldset>     
                    <legend><strong>NEW STOCK</strong></legend>
                    <form action="new_stock.php" method="post">
                        <p><label for="StockID">Product-ID:</label>
                            <input type="integer" name="StockID" id="StockID" value="" required /><br /></p>

                        <p><label for="Stockname">Product-Name:</label>
                            <input type="integer" name="Stockname" id="Stockname" value="" required /><br /></p>

                        <p><label for="CatID">Catagory-ID:</label>
                            <input type="integer" name="CatID" id="CatID" value="" required /><br /></p>

                        <p><label for="SupID">Supplier-ID:</label>
                            <input type="integer" name="SupplierID" id="SupID" value="" required /><br /></p>

                        <p><label for="Quantity">Quantity:</label>
                            <input type="integer" name="Quantity" id="Quantity" value="" required /><br /></p>

                        <p><label for="Price">Cost Price:</label>
                            <input type="integer" name="Cost" id="Price" value="" required /><br /></p>

                        <p><label for="PriceSold">Selling Price:</label>
                            <input type="integer" name="sell" id="PriceSold" value="" required /><br /></p>

                        <p><label for="ROL">Re-Order-Level:</label>
                            <input type="integer" name="ROL" id="ROL" value="" required /><br /></p>

                        <p><input type="submit" name="send" class="formbutton" value="Add" /></p>
                    </form>
                </fieldset>

                <fieldset>    
                    <legend><strong>UPDATE STOCK QUANTITY</strong></legend>
                    <form action="update_stocks.php" method="POST">
                        <p><label for="Stock-ID1">Stock-ID:</label>
                            <input type="integer" name="Stock-ID1" id="Stock-ID1" value="" required /><br /></p>

                        <p><label for="Quantity1">Quantity:</label>
                            <input type="integer" name="Quantity1" id="Quantity1" value="" required /><br /></p>

                        <p><input type="submit" name="UpdateQ" class="formbutton" value="ADD Quantity" /></p>
                    </form>
                    <?php if(isset($_POST['UpdateQ'])) {
                    $StockID    = $_POST['Stock-ID1'];
                    $Quantity = $_POST['Quantity1'];
                    $sql = "UPDATE product
                            SET Quantity_in_stock = Quantity_in_stock +'$Quantity'
                            WHERE ProductID = '$StockID' ";
                        $result = mysqli_query($db_conn,$sql);
                    }?>

                    <fieldset>
                        
                        <legend><strong>UPDATE STOCK COST</strong></legend>
                        <form action="update_stocks.php" method="POST">

                            <p><label for="Stock-ID2">Stock-ID:</label>
                                <input type="integer" name="Stock-ID2" id="Stock-ID2" value="" required /><br /></p>

                            <p><label for="Cost1">Cost:</label>
                                <input type="integer" name="Cost1" id="Cost1" value="" required /><br /></p>

                            <p><input type="submit" name="UpdateC" class="formbutton" value="Update" /></p>

                        </form>
                        <?php if(isset($_POST['UpdateC'])) {

                        $StockID    = $_POST['Stock-ID2'];
                        $UnitPrice = $_POST['Cost1'];
                        $sql  = "UPDATE product
                                    SET  UnitPrice = '$UnitPrice'
                                    WHERE ProductID = '$StockID' ";
                        $result = mysqli_query($db_conn,$sql);
                        }?>

                    </fieldset>
                </fieldset>

                <fieldset>
                    <legend><strong>UPDATE STOCK SELL</strong></legend>
                    <form action="update_stocks.php" method="POST">

                        <p><label for="Stock-ID3">Stock-ID:</label>
                            <input type="integer" name="Stock-ID3" id="Stock-ID3" value="" required /><br /></p>

                        <p><label for="Sell Price1">Sell Price:</label>
                            <input type="integer" name="SellPrice1" id="Sell Price1" value="" required /><br /></p>

                        <p><input type="submit" name="UpdateS" class="formbutton" value="UpdateS" /></p>

                    </form>
                    <?php if(isset($_POST['UpdateS'])) {
                    $StockID = $_POST['Stock-ID3'];
                    $SellPrice = $_POST['SellPrice1'];
                    $sql = "UPDATE price_list
                                SET  USP = '$SellPrice'
                                WHERE ProductID = '$StockID' ";
                        $result = mysqli_query($db_conn,$sql);
                    }?>
                </fieldset>
            </article>
            <?php require 'footer.html'; ?>
        </section>

        <div class="clear"></div>
    </section>
</body>

</html>