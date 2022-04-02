<?php
if (!$conn =  mysqli_connect("localhost", "id18456817_basicbank", "7%9zzK@T<u2DR?m", "id18456817_localhost")) {
  die("the connection failed");
}

$query = "select * from customers";
$result = mysqli_query($conn, $query);
if( isset($_POST['send']) ){
    $main = "SELECT * from  `customers` where email ='$_POST[sender]'";
    $main2 = "SELECT * from  `customers` where email='$_POST[reciever]'";
    $main_run = mysqli_query($conn, $main);
    $main2_run = mysqli_query($conn, $main2);
    $fetched = mysqli_fetch_assoc($main_run);
    $fetched2 = mysqli_fetch_assoc($main2_run);
    $amount = "SELECT `balance` from `customers` where`customers` . `email` = '$_POST[sender]' ";
    $amount_run = mysqli_query($conn, $amount);
    $fetched3 = mysqli_fetch_assoc($amount_run);
    
    if( $fetched['email'] && $fetched2['email']){
        if($fetched3['balance'] >= $_POST['amount'] ){
        $query1 = "UPDATE `customers` SET balance=balance - '$_POST[amount]' where email='$_POST[sender]' ";
        $query2 = "UPDATE `customers` SET balance= balance +'$_POST[amount]' where email='$_POST[reciever]' ";
        $query1_run = mysqli_query($conn, $query1);
        $query2_run = mysqli_query($conn, $query2);
        $query3 = "INSERT INTO transactions(froom, too, amount) VALUES ('$_POST[sender]','$_POST[reciever]', '$_POST[amount]')";
        $query3_run = mysqli_query($conn, $query3);
        header('Location: ./veiw.php');
        }
        else{
            echo " <script type='text/javascript'>alert('there is not enough money')</script>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('enter valid emails')</script>";
    }
}
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="secon.css">
        <title>bank</title>
    </head>
<body>
    <header>
        <h1 class="logo">Not a Bank</h1>
        <nav class="navi">
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
        </nav>
        <a href="" class="Home">Home</a>
    </header>
        
    <div class="N_b">
        <a href="transactions.php" class="first-button">See all transactions</a>

        <button onclick="togglePopup()" class="first-button" id="w">Send money</button>
    </div>
    <div class="popup" id="popup1">
        <div class="content">
            <div class="close-btn" onclick="togglePopup()"> x</div>
            <h1>Send money</h1>
                    <form action="" method= "POST"> 
                        <div class="input-field">
                            <label for="Sender">Sender</label>
                            <input placeholder="Sender" class="validate" id="Sender" name="sender">
                        </div>
                        <div class="input-field">
                            <label for="Reciever">Reciever</label> 
                            <input placeholder="Reciever" class="validate" id="Reciever" name="reciever">
                        </div>
                        <div class="input-field">
                            <label for="Amount">Amount</label>
                            <input placeholder="Amount" class="validate" id="Amount" name="amount">
                        </div>
                        <input type="submit" name="send" class="submit" value="Submit">
                    </form>
            </div>
    </div>
            <div class="workplz">
            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                    <td class="column1"><?php echo $rows['id']; ?></td>
                    <td class="column2"><?php echo $rows['name']; ?></td>
                    <td class="column3"><?php echo $rows['email']; ?></td>
                    <td class="column4"><?php echo $rows['balance']; ?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            </div>
            <script>
                function togglePopup() {
                document.getElementById("popup1")
                .classList.toggle("active");
}
            </script>  
</body>
    </html>