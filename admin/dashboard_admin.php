<?php
    require "../proses/session.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Halo <?php echo $_SESSION['username']; ?></h2>
</body>
</html>