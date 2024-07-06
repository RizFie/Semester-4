<!DOCTYPE html>
<?php
    session_start();
    include("bakadbconn.php");

    if($_SESSION['privilege'] != "customer"){/*make sure user is sign in*/
        die("<script>alert('You have not login yet. Lets do that now!!')
            ;window.location.href='login.php';</script>");
    }
    $ord_id = htmlspecialchars($_GET['o_id']);
    $sql = "select o.food_id, f.food_name, o.qty, f.food_price, (o.qty * f.food_price) as total 
            from food_order o join food f on o.food_id = f.food_id
            where o.ord_id = '$ord_id';";
    $query = mysqli_query($dbconn, $sql) or die("Error :". mysqli_error($dbconn));
    $row = mysqli_fetch_assoc($query);
    $food_id = $row['food_id'];
    $food_name = $row['food_name'];
    $qty = $row['qty'];
    $food_price = $row['food_price'];
    $total = $row['total'];

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="paymentCSS.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Complete Your Payment</h1>
        </div>
    </header>
    <main class="container">
        <div class="payment-form">
            <form action="process_payment.php" method="POST">
                <!--
                <label for="quantity">Product Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
                -->
                <!-- 
                <label for="bankId">Bank ID:</label>
                <input type="text" id="bankId" name="bankId" required>
                -->
                
                <label for="bankName">Choose Your Bank:</label>
                <select id="bank_id" name="bank_id" required>
                    <option value="BI">Bank Islam</option>
                    <option value="BR">Bank Rakyat</option>
                    <option value="BSN">Bank Simpanan Nasional</option>
                    <option value="MYB">Maybank</option>
                    <option value="RHB">RHB Bank</option>
                </select>

                <label><?php echo $food_name ?></label>
                <label><?php echo 'Quantity: '.$qty ?></label>
                <label><?php echo 'Total: RM'.$total ?></label>

                <button type="submit" class="submitPayment" name="ord_id" value = <?php echo $ord_id; ?>>Pay Now</button>
            </form>
        </div>
    </main>`    
    <footer>
        <div class="container">
            <p>&copy; 2024 Baka Bakery. All rights reserved.</p>
        </div>
    </footer>
</body>
<?php
    mysqli_close($dbconn);
?>
</html>
