<?php

require_once('./db.php');
$db = new Database();
$selectAll = 'select * from user';
$table = $db->excuteCustom($selectAll);
$username = '';
$password = '';
?>

<?php

if (isset($_GET['id'])) {
    while ($row = $table->fetch_assoc()) {
        if ($row['id'] == $_GET['id']) {
            $username  = $row['username'];
            $password = $row['password'];
        }
    }
}
?>

<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $checkExist = "select * from user where username = '" . $username . "'";
    $exist = $db->excuteCustom($checkExist);
    if ($exist->num_rows > 0) {
        echo 'Username is already';
    } else {
        $insert = "insert into user values('0','" . $username . "','" . md5($password) . "')";
        $result = $db->excuteCustom($insert);
        if ($result) {
            echo 'ADD successfull';
        } else {
            echo 'ADD failed';
        }
        header('Location: manager.php');
    }
}
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = 'delete from user where id = ' . $id;
    $result = $db->excuteCustom($delete);
    if ($result) {
        echo 'Delete successfull';
    } else {
        echo 'Delete failed';
    }
    header('Location: manager.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>

        <?php
        if ($table->num_rows > 0) {
            while ($row = $table->fetch_assoc()) {
                echo ' <tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['password'] . '</td>
                    <td><button class="delete" onclick="loadIdUrl(' . $row['id'] . ')">Delete</button></td>
                </tr>';
            }
        }
        ?>
        <tbody>

        </tbody>
    </table>
    <form action="" method="post">
        <input type="text" name="username" required value="<?php echo $username; ?>" placeholder="Username">
        <input type="text" name="password" required value="<?php echo $password; ?>" placeholder="Password">
        <button type="submit">Submit</button>
        <script>
            const loadIdUrl = (id) => {
                window.location = `?id=${id}`;
            }
        </script>
    </form>
</body>

</html>