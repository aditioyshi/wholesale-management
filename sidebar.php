<?php
$current_file_name = basename($_SERVER['PHP_SELF']);
?>
<aside id=sidebar class="column-left">
    <header>
        <h1>WholeSaler Management</h1>
    </header>

    <nav id="mainnav">
    <?php if(!isset($_SESSION['CID'])) { ?>
        <ul>
            <li class="<?php if($current_file_name=='wholesaler_login.php'){echo 'selected-item';}?>"> 
                <a href="wholesaler_login.php">Home</a>
            </li>
            <li class="<?php if($current_file_name=='add_customer_page.php'){echo 'selected-item';}?>">
                <a href="add_customer_page.php">Customers</a>
            </li>
            <li class="<?php if($current_file_name=='add_transaction_page.php'){echo 'selected-item';}?>">
                <a href="add_transaction_page.php">New Transaction</a>
            </li>
            <li class="<?php if($current_file_name=='multi_products.php'){echo 'selected-item';}?>">
                <a href="multi_products.php">All Transactions</a>
            </li>
            <li class="<?php if($current_file_name=='all_stocks.php') {echo 'selected-item';} ?>">
                <a href="all_stocks.php">All Stocks</a>
            </li>
            <li class="<?php if($current_file_name=='depleted_stock.php') {echo 'selected-item';} ?>">
                <a href="depleted_stock.php">Depleted Stocks</a>
            </li>
            <li class="<?php if($current_file_name=='add_category.php') {echo 'selected-item';} ?>">
                <a href="add_category.php">Add Category</a>
            </li>
            <li class="<?php if($current_file_name=='update_stocks.php') {echo 'selected-item';} ?>">
                <a href="update_stocks.php">Add or Update Stock</a>
            </li>
            <li class="<?php if($current_file_name=='add_suppliers.php') {echo 'selected-item';} ?>">
                <a href="add_suppliers.php">Add or Update Supplier</a>
            </li>
            <li class="<?php if($current_file_name=='bills.php') {echo 'selected-item';} ?>">
                <a href="bills.php">Orders</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    <?php }?>
    <?php if(isset($_SESSION['CID'])) { ?>
        <ul>
            <li class="<?php if($current_file_name=='customer_login.php') 
                {echo 'selected-item';} ?>">
                <a href="customer_login.php">Home</a>
            </li>
            <li class="<?php if($current_file_name=='catag.php') {echo 'selected-item';} ?>">
                <a href="catag.php">Category</a>
            </li>
            <li class="<?php if($current_file_name=='cus_transaction.php') {echo 'selected-item';} ?>">
                <a href="cus_transaction.php">Transactions</a>
            </li>
            <li><a href="logout.php">Logout</a></li>
        </ul> 
    <?php }?>
    </nav>
</aside>