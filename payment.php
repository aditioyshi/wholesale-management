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

                <?php echo $_SESSION['pnum'];

                $_SESSION['pnum'] = $_SESSION['pnum'] - 1;
                ?>
                <?php if ($_SESSION['BILL'] == "True") { ?>
                    <fieldset>
                        <legend>
                            <h3> Total Amount Until Now is <?php echo $_SESSION['TotalAmt'] ?></h3>
                        </legend>
                        <table>
                            <tr>
                                <th>TransactionID</th>
                                <th>ProductID</th>
                                <th>ProductAmt</th>
                            </tr>

                            <?php while ($_SESSION['pnum'] >= 0) { ?>
                                <tr>
                                    <td><?php echo $_SESSION['TransID']; ?></td>
                                    <td><?php echo $_SESSION['ProductID'][$_SESSION['pnum']]; ?></td>
                                    <td><?php echo $_SESSION['PAmt'][$_SESSION['pnum']]; ?></td>
                                </tr>
                                <?php $_SESSION['pnum'] = $_SESSION['pnum'] - 1; ?>
                            <?php } ?>
                        </table>
                    </fieldset>
                    <?php $_SESSION['BILL'] = "False"; ?>
                    <fieldset>
                       
                        <legend>
                            <strong>
                                <h3>Details</h3>
                            </strong>
                        </legend>
                        <form action="payment.php" method="POST">
                            <p><label for="name"><strong>AmountPaid:</strong></label>
                                <input type="text" name="AmtPaid" id="name" placeholder="AmountPaid" required /><b /></p>

                            <p><label for="CustomerID">Mode-of-Payment:</label>
                                <input type="text" name="Mode" id="CustomerID" placeholder="Ex:- 1.Cash 2.Debit Card 3.Credit Card" required /><br /></p>

                            <p><input type="submit" name="Confirm" class="formbutton" value="Confirm Transaction" /></p>
                        </form>

                    </fieldset>
                <?php } else if ($_SESSION['BILL'] == "False") { ?>
                    <?php
                    $amtpaid = $_POST['AmtPaid'];
                    $mode = $_POST['Mode'];

                    $sql1 = "INSERT INTO payment (Mode,Amount_Paid,TransactionID,Transaction_Date)
                        VALUES('$mode','$amtpaid','" . $_SESSION['TransID'] . "','" . $_SESSION['TID'] . "')";

                    $result2 = mysqli_query($db_conn, $sql1) or die("Error in query: $sql1. " . mysqli_error($db_conn));

                    mysqli_close($db_conn);

                    ?>
                    <fieldset>
                        <legend><strong>
                                <h3>The Transaction is Done</h3>
                            </strong></legend>
                        <form action="add_transaction_page.php" method="POST">
                            <p><input type="submit" name="Completed" class="formbutton" value="Go Back to NewTransactions" /></p>
                        </form>
                    </fieldset>

                    <fieldset>
                        <form action="logout.php" method="POST">
                            <p><input type="submit" name="Logout" class="formbutton" value="logOut" /></p>
                        </form>
                    </fieldset>
                <?php } ?>


            </article>
            <?php require 'footer.html'; ?>
        </section>

        <div class="clear"></div>
    </section>
</body>

</html>