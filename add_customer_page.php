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
                    <legend><strong>
                            <h3>NEW CUSTOMER</h3>
                        </strong>
                    </legend>
                    <form action="add_customer.php" method="POST">
                        <p><label for="name"><strong>Name:</strong></label>
                            <input type="text" name="Cname" id="name" placeholder="Name" required /><br /></p>

                        <p><label for="CustomerID">Customer-ID:</label>
                            <input type="text" name="CustomerID" id="CustomerID" placeholder="Login_ID" required /><br /></p>

                        <p><label for="Phone">Phone-No:</label>
                            <input type="text" name="Phone" id="Phone" placeholder="Phone-No" required /><br /></p>

                        <p><label for="password">Password:</label>
                            <input type="password" name="Password" id="password" placeholder="**********" required /><br /></p>

                        <p><label for="Address">Address:</label>
                            <textarea cols="60" rows="4" name="Address" id="Address" placeholder="XYZ Area,Home town, street" required></textarea><br /></p>

                        <input type="submit" name="Add" class="formbutton" value="Add Customer" />
                    </form>
                </fieldset>
                <br><br>
                <fieldset>
                    <legend><strong>
                            <h3>All Customers</h3>
                        </strong></legend>
                    <table>
                        <tr>
                            <th>CustomerID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Password</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM customer_information";
                        $result = mysqli_query($db_conn, $sql) or die("Error: $sql. " . mysqli_error($db_conn));

                        $row = mysqli_fetch_assoc($result);
                        do { ?>

                            <tr>
                                <td><?php echo $row['CustomerID']; ?></td>
                                <td><?php echo $row['Name']; ?></td>
                                <td><?php echo $row['Address']; ?></td>
                                <td><?php echo $row['Phone']; ?></td>
                                <td><?php echo $row['Password']; ?></td>
                            </tr>
                        <?php } while ($row = mysqli_fetch_assoc($result)) ?>
                        <tr>
                    </table>
                </fieldset>
            </article>
            <?php require 'footer.html'; ?>
        </section>
        <div class="clear"></div>
    </section>
</body>

</html>