<?php
if (!$conn =  mysqli_connect("localhost", "id18456817_basicbank", "7%9zzK@T<u2DR?m", "id18456817_localhost")) {
  die("the connection failed");
}
$query = "select * from transactions";
$result = mysqli_query($conn, $query);
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
        <a href="#" class="Home">Home</a>
    </header>
    <div class="workplz">
            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>from</th>
                    <th>to</th>
                    <th>amount</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                    <td class="column3"><?php echo $rows['id']; ?></td>
                    <td class="column1"><?php echo $rows['froom']; ?></td>
                    <td class="column2"><?php echo $rows['too']; ?></td>
                    <td class="column3"><?php echo $rows['amount']; ?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            </div>
</body>
</html>