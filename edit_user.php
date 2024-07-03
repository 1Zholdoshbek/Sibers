<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
include('config.php');

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];

    $sql = "UPDATE users SET username=?, password=?, first_name=?, last_name=?, gender=?, birth_date=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $username, $password, $first_name, $last_name, $gender, $birth_date, $id);

    if ($stmt->execute() === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit User</title>
</head>
<body>
<div class="container mb-4 mt-4">
    <h5>Edit User</h5>
    <form method="POST" action="">
        <div class="mb-3 col-6">
            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" required>
        </div>
        <div class="mb-3 col-6">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
        </div>
        <div class="mb-3 col-6">
            <label for="first_name" class="form-label">First Name</label>
            <input id="first_name" type="text" name="first_name" class="form-control" value="<?php echo $user['first_name']; ?>" required>
        </div>
        <div class="mb-3 col-6">
            <label for="last_name" class="form-label">Last Name</label>
            <input id="last_name" type="text" name="last_name" class="form-control" value="<?php echo $user['last_name']; ?>" required>
        </div>
        <div class="mb-3 col-6">
            <label for="gender" class="form-label">Gender</label>
            <select id="gender" name="gender" class="form-select">
                <option value="male" <?php echo $user['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo $user['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="mb-3 col-6">
            <label for="birth_date" class="form-label">Birth Date</label>
            <input id="birth_date" type="date" name="birth_date" class="form-control" value="<?php echo $user['birth_date']; ?>" required>
        </div>
        <input class="btn btn-success" type="submit" value="Update User">
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
