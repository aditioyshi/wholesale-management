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
            <article style="height: 1150px">
                <fieldset>
                    <legend><strong>NEW Supplier</strong></legend>
                    <form action="add_supplier.php" method="Post">

                        <p><label for="Name">Name:</label>
                            <input name="Name" id="Name" required></input><br /></p>

                        <p><label for="IndustryID">Supplier-ID:</label>
                            <input type="integer" name="IndustryID" id="IndustryID" value="" required /><br /></p>

                        <p><label for="Phone">Phone:</label>
                            <input type="text" name="Phone" id="Phone" value="" required /><br /></p>

                        <p><label for="Address">Address:</label>
                            <textarea cols="60" rows="8" name="Address" id="Address"></textarea><br /></p>

                        <p><input type="submit" name="send" class="formbutton" value="Send" /></p>
                    </form>
                </fieldset>

                <fieldset>
                    <legend><strong>Suppliers</strong></legend>
                    <table>
                        <tr>
                            <th>SupplierID</th>
                            <th>SName</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                        <?php
                    $sql = "SELECT * FROM supplier_information ";
                    $result = mysqli_query($db_conn,$sql) or die ("Error in query: $sql. ".mysql_error($db_conn));
                    $row = mysqli_fetch_assoc($result);
                    do { ?>
                        <tr>
                            <td><?php echo $row['SupplierID']; ?></td>
                            <td><?php echo $row['SName']; ?></td>
                            <td><?php echo $row['Phone']; ?></td>
                            <td><?php echo $row['Address']; ?></td>
                        </tr>
                    <?php } while($row = mysqli_fetch_assoc($result)) ?>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><strong>UPDATE SUPPLIER NAME</strong></legend>
                    <form action="add_suppliers.php" method="POST">

                        <p><label for="SupplierID1">SupplierID:</label>
                            <input type="integer" name="SupplierID1" id="SupplierID1" value="" required /><br /></p>

                        <p><label for="SupName">SupplierName:</label>
                            <input type="integer" name="SupName" id="SupName" value="" required /><br /></p>

                        <p><input type="submit" name="UpdateSup" class="formbutton" value="Update" /></p>

                    </form>
                    <?php if(isset($_POST['UpdateSup'])) {

                    $SupplierID   = $_POST['SupplierID1'];
                    $SupName = $_POST['SupName'];
                    $sql  = "UPDATE supplier_information
                                SET SName = '$SupName'
                                WHERE SupplierID = '$SupplierID' ";
                    $result = mysqli_query($db_conn,"UPDATE supplier_information SET SName = '$SupName' WHERE SupplierID = '$SupplierID' ");
                    }?>
                </fieldset>

                <fieldset>
                    <legend><strong>UPDATE SUPPLIER PHONE</strong></legend>
                    <form action="add_suppliers.php" method="POST">
                        <p><label for="SupplierID2">SupplierID:</label>
                            <input type="integer" name="SupplierID2" id="SupplierID2" value="" required /><br /></p>

                        <p><label for="SupNamePh">SupplierPhone:</label>
                            <input type="integer" name="SupNamePh" id="SupNamePh" value="" required /><br /></p>

                        <p><input type="submit" name="UpdateSupPh" class="formbutton" value="Update" /></p>

                    </form>
                    <?php if(isset($_POST['UpdateSupPh'])) {
                    $SupplierID   = $_POST['SupplierID2'];
                    $SupNamePh = $_POST['SupNamePh'];
                    $sql = "UPDATE supplier_information
                            SET Phone = '$SupNamePh'
                            WHERE SupplierID = '$SupplierID' ";
                    $result = mysqli_query($db_conn,$sql);
                    }?>
                </fieldset>
            </article>
        </section>
        <?php require 'footer.html';?>
    </section>
</body>

</html>