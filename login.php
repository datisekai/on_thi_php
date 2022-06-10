<?php
$username = '';
$password = '';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    require_once('./db.php');
    $db = new Database();
    $query = "select * from user where username = '" . $username . "' and password = '" . md5($password) . "'";
    $result = $db->excuteCustom($query);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['id'] = $user['id'];
        echo '<p>Login successfull, id: ' . $_SESSION['id'] . '</p>';
    } else {
        echo '<p>Incorrect username or password</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>

<body>
    <form action="" method="POST">
        <h1>Login</h1>
        <input type="text" required placeholder="username" name="username" id="username" value="<?php echo $username; ?>">
        <input type="text" required placeholder="password" name="password" id="password" value="<?php echo $password; ?>">
        <button type="submit">Login</button>
    </form>
</body>

</html>