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

                <?php if ($_SESSION['TI'] == "Active") {
                    $customerID = $_POST['CustomerID'];
                    $hmany = $_POST['Howmany'];
                    $TID = $_POST['Trans_Int_Date'];
                    
                    $sql = "INSERT INTO transaction_information(customerID,Trans_Init_Date)
                            VALUES('$customerID','$TID')";
                    $result = mysqli_query($db_conn, $sql);

                    $sql1 = "SELECT TransactionID FROM transaction_information
                            WHERE CustomerID = '$customerID' AND Trans_Init_Date = '$TID'";
                    $result1 = mysqli_query($db_conn, $sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    echo $row1['TransactionID'];

                    $_SESSION['PAmt'] = array();
                    $_SESSION['ProductID'] = array();
                    $_SESSION['pnum'] = 0;
                    $_SESSION['TID'] = $TID;
                    $_SESSION['TransID']  = $row1['TransactionID'];
                    $_SESSION['hmany'] = $hmany;
                    echo $hmany;
                    echo $_SESSION['hmany'];
                    $_SESSION['TI'] =  "DeActive";
                    $_SESSION['TD'] = "DeActive";
                }
                ?>
                <?php if ($_SESSION['TD'] == "Active") {
                    $ProductID    = $_POST['ProductID'];
                    $Quantity  = $_POST['Quantity'];

                    $sql3 = "SELECT USP FROM price_list WHERE ProductID = '$ProductID'";

                    $result3 = mysqli_query($db_conn, $sql3);

                    $row2  = mysqli_fetch_assoc($result3);

                    $amt  = ($Quantity) * ($row2['USP']);
                    array_push($_SESSION['ProductID'], $ProductID);
                    array_push($_SESSION['PAmt'], $amt);
                    $_SESSION['TotalAmt'] = $_SESSION['TotalAmt'] + ($Quantity) * ($row2['USP']);

                    $sql2 = "INSERT INTO transaction_detail(TransactionID,ProductID,Quantity,Total_Amount,Trans_Init_Date)
                            VALUES('" . $_SESSION['TransID'] . "',' $ProductID','$Quantity','" . ($Quantity) * ($row2['USP']) . "','" . $_SESSION['TID'] . "')";

                    $result2 = mysqli_query($db_conn, $sql2);
                    if ($result2 === false) {
                        //Need to delete the transaction entered in transaction_information
                        $result4 = mysqli_query($db_conn, "DELETE FROM transaction_information WHERE TransactionID = '" . $_SESSION['TransID'] . "'");
                        echo "The Row has been deleted from the transaction_information"; ?>
                        <a href="add_transaction_page.php" class="button">Back</a>
                    <?php die("Error:" . mysqli_error($db_conn));
                    }
                    $_SESSION['TD'] = "DeActive";
                    ?>
                <?php } ?>

                <p>Total Amount Until Now <?php echo $_SESSION['TotalAmt'] ?></p>

                <?php if ($_SESSION['hmany'] > 0) { ?>
                    <fieldset>
                        <!--YOU NEED TO WRITE AN ACTION HERE...-->
                        <?php $_SESSION['pnum'] = $_SESSION['pnum']  + 1;  ?>

                        <legend><strong>Product<?php echo $_SESSION['pnum'] ?></strong></legend>
                        <form action="multi_products.php" method="POST">

                            <p><label for="StockID">Product-ID:</label>
                                <input type="integer" name="ProductID" id="StockID" Placeholder="Product-ID" required /><br /></p>

                            <p><label for="Quantity">Quantity:</label>
                                <input type="integer" name="Quantity" id="Quantity" Placeholder="How Much??" required /><br /></p>

                            <p><label for="TotalAmount">Total-Amount:</label>
                                <input type="integer" name="TotalAmount" id="TotalAmount" placeholder="TotalAmount" disabled value="<?php
                                echo $_SESSION['TotalAmt'] ?>"></input><br /></p>

                            <p><input type="submit" name="Add Product" class="formbutton" value="Next Product" /></p>

                            <?php
                            $_SESSION['hmany'] = $_SESSION['hmany'] - 1;

                            $_SESSION['TD'] = "Active"; ?>
                            <p>the while loop <?php echo $_SESSION['hmany'] ?> </p>

                        </form>

                    </fieldset>
                <?php } else {
                    $_SESSION['BILL'] = "True";
                    header("location:payment.php");
                } ?>

            </article>
            <?php require 'footer.html'; ?>
        </section>

        <div class="clear"></div>
    </section>
</body>

</html>