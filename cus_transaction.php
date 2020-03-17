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
                    <legend><strong>
                            <h3>From Date to To Date Transactions</h3>
                        </strong></legend>
                    <form action="cus_Transations.php" method="POST">
                        <p><label for="FDate"><strong>From Date:</strong></label>
                            <input type="Date" name="FDate" id="FDate" placeholder="Start Date" required /><b /></p>

                        <p><label for="TDate">To Date:</label>
                            <input type="Date" name="TDate" id="TDate" placeholder="Login_ID" required /><br /></p>

                        <p><input type="submit" name="Show" class="formbutton" value="Show Transactions" /></p>
                    </form>

                </fieldset>

                <?php
                echo $_SESSION['CID'];
                if(isset($_POST['Show']))
                {
                $fdate = $_POST['FDate'];
                $tdate = $_POST['TDate'];
                ?>

                <!--Printing the transactions from Start date to end Date-->
                <fieldset>
                    <legend>
                        <h3>Customer Transactions</h3>
                    </legend>
                    <table>
                        <tr>
                            <th>Transaction_ID</th>
                            <th>Product_ID</th>
                            <!--<th>Customer_ID</th>-->
                            <th>Total_Amount</th>
                            <th>Transaction_Date</th>
                        </tr>
                        <?php
                        $CID = $_SESSION['CID'];
                        echo $CID;
                        $sql = "SELECT transaction_detail.TransactionID AS t1,transaction_detail.ProductID AS t2,transaction_detail.Total_Amount AS t3,transaction_detail.Trans_Init_Date AS t4
                                FROM transaction_detail , transaction_information
                                WHERE  transaction_information.CustomerID = '$CID'
                                AND transaction_detail.TransactionID = transaction_information.TransactionID
                                AND transaction_detail.Trans_Init_Date>='$fdate'
                                AND transaction_detail.Trans_Init_Date<='$tdate'  ";

						$result = mysqli_query($db_conn,$sql);
						$row = mysqli_fetch_assoc($result);
						do { ?>
                        <tr>
                            <td><?php echo $row['t1']; ?></td>
                            <td><?php echo $row['t2']; ?></td>
                            <td><?php echo $row['t3']; ?></td>
                            <td><?php echo $row['t4']; ?></td>
                        </tr>

                        <?php } while($row = mysqli_fetch_assoc($result)) ?>

                        <?php
                        
                        $sql = "SELECT SUM(transaction_detail.Total_Amount) AS t6
                            FROM transaction_detail, transaction_information
                            WHERE  transaction_information.CustomerID = '$CID'
                            AND transaction_detail.TransactionID = transaction_information.TransactionID
                            AND transaction_detail.Trans_Init_Date>='$fdate'
                            AND transaction_detail.Trans_Init_Date<='$tdate'  ";
                        $result1 = mysqli_query($db_conn,$sql);
                        $row = mysqli_fetch_assoc($result1);

                        ?>
                        <p>The Total Amount you Spent from <?php echo $fdate  ?> to <?php echo $tdate ?> is
                        <?php echo $row['t6'] ?> </p>
                        <?php } ?>
                    </table>
                </fieldset>
                <p>&nbsp;</p>
                <br><br><br><br>

            </article>
        </section>
        <?php require 'footer.html';?>
    </section>
</body>

</html>