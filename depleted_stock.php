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
				<legend><h3>Depleted Stocks</h3></legend>
				<table>
					<tr>
						<th>ProductID</th>
						<th>Quantity</th>
					</tr>
					<?php
						$sql = "SELECT * FROM Depleted_Product ";
						$result = mysqli_query($db_conn,$sql);
						$row = mysqli_fetch_assoc($result);
						do { ?>
                        <tr>
                            <td><?php echo $row['ProductID']; ?></td>
                            <td><?php echo $row['Quantity']; ?></td>
                        </tr>
                    <?php } while($row = mysqli_fetch_assoc($result)) ?>
					<tr>
				</table>
		</fieldset>
				<p>&nbsp;</p>
<br><br><br><br><br>

            </article>
            <?php require 'footer.html'; ?>
        </section>

        <div class="clear"></div>
    </section>
</body>

</html>