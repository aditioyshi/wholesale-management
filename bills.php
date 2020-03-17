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
                        <strong>
                            <h3>Bills for the transaction</h3>
                        </strong>
                    </legend>

                    <form action="bills.php" method="POST">
                        <p><label for="name"><strong>TransactionID:</strong></label>
                            <input type="interger" name="TransID" id="name" placeholder="Order-ID" required /><b /></p>
                        <br><br><br><br><br><br>
                        <p><input type="submit" name="show" class="formbutton" value="Show" /></p>
                    </form>
                </fieldset>
                <?php if(isset($_POST['show']))
                {
                $TransID = $_POST['TransID'];?>
                <fieldset>
                    <legend><strong>
                            <h3>Bill for TransactionID:<?php echo $TransID ?> </h3>
                        </strong></legend>
                    <table>
                        <tr>
                            <th>TransactionID</th>
                            <th>CustomerName</th>
                            <th>ProductName</th>
                            <th>Quantity</th>
                            <th>ProductAmt</th>
                            <th>TotalAmt</th>
                        </tr>
                        <?php
                        $sql = "SELECT transaction_information.TransactionID AS t1 ,customer_information.Name AS t2 ,product.Pname AS t3,transaction_detail.Quantity AS t4,transaction_detail.Total_Amount AS t5,payment.Amount_Paid AS t6
                                FROM transaction_detail,payment,transaction_information,customer_information,product
                                WHERE transaction_detail.TransactionID = transaction_information.TransactionID
                                AND  transaction_detail.TransactionID = payment.TransactionID
                                AND customer_information.CustomerID = transaction_information.CustomerID
                                AND product.ProductID = transaction_detail.ProductID
                                AND transaction_detail.TransactionID ='$TransID' ";
                        $result = mysqli_query($db_conn,$sql);
                        $row = mysqli_fetch_assoc($result);
                        do { ?>
                            <tr>
                                <td><?php echo $row['t1']; ?></td>
                                <td><?php echo $row['t2']; ?></td>
                                <td><?php echo $row['t3']; ?></td>
                                <td><?php echo $row['t4']; ?></td>
                                <td><?php echo $row['t5']; ?></td>
                                <td><?php echo $row['t6']; ?></td>
                            </tr>
                            <?php } while($row = mysqli_fetch_assoc($result)) ?>
                            <tr>
                    </table>
                </fieldset>
                <?php } ?>
                <br><br><br><br><br><br>
            </article>
        </section>
        <?php require 'footer.html';?>
    </section>
</body>

</html>