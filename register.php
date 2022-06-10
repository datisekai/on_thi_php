<?php
$username = '';
$password = '';
$confirm = '';
require_once('./db.php');
$db = new Database();

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    if ($password != $confirm) {
        echo 'Password not match';
    } else {
        $checkExist = "select * from user where username = '" . $username . "'";
        $exist = $db->excuteCustom($checkExist);
        if ($exist->num_rows > 0) {
            echo 'Username is already';
        } else {
            $insert = "insert into user values('0','" . $username . "','" . md5($password) . "')";
            $result = $db->excuteCustom($insert);
            if ($result) {
                echo 'Register successfull';
            } else {
                echo 'Register failed';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
</head>

<body>
    <form action="" method="post">
        <h1>Register</h1>
        <input type="text" required placeholder="username" name="username" value="<?php echo $username; ?>">
        <input type="text" required placeholder="password" name="password" value="<?php echo $password; ?>">
        <input type="text" required placeholder="confirm" name="confirm" value="<?php echo $confirm; ?>">
        <button type="submit">register</button>
    </form>
</body>

</html>