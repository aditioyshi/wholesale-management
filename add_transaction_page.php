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
                    <!--YOU NEED TO WRITE AN ACTION HERE...-->
                    <legend><strong>NEW TRANSACTION</strong></legend>
                    <form action="multi_products.php" method="POST">

                        <p><label for="CustomerID">Customer-ID:</label>
                            <input type="text" name="CustomerID" id="CustomerID" Placeholder="CustomerID" required /><br /></p>

                        <p><label for="hmany">How-Many:</label>
                            <input type="integer" name="Howmany" id="hmany" Placeholder="How Many Products" required /><br /></p>

                        <p><label for="Tran_Int_Date">Tran_Int_Date</label>
                            <input type="Date" name="Trans_Int_Date" id="BalanceAmount" placeholder="BalanceAmount" required></input><br /></p>

                        <p><input type="submit" name="send" class="formbutton" value="Add Transaction" /></p>
                        <?php $_SESSION['TI'] = "Active";
                        $_SESSION['TotalAmt'] = 0;
                        $_SESSION['PAmt'] = array();
                        ?>
                    </form>
                </fieldset>
                <br><br><br><br><br><br><br>
            </article>
            <?php require 'footer.html'; ?>
        </section>
        
        <div class="clear"></div>
    </section>
</body>

</html>