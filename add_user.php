<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password =$_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];

    $sql = "INSERT INTO users (username, password, first_name, last_name, gender, birth_date)
            VALUES ('$username', '$password', '$first_name', '$last_name', '$gender', '$birth_date')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>add user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container mb-4 mt-4">
    <h4>Add User</h4>

    <form method="POST" action="">
        <div class="mb-3 col-6">
            <label for="name" class="form-label">Username</label>
            <input class="form-control" id="name" type="text" name="username" required>

        </div>
        <div class="mb-3 col-6">
            <label for="pass" class="form-label">Password</label>
            <input class="form-control" id="pass" type="password" name="password" required>
        </div>
        <div class="mb-3 col-6">
            <label for="first_name" class="form-label">First Name </label>
            <input class="form-control" id="first_name" type="text" name="first_name" required>
        </div>
        <div class="mb-3 col-6">
            <label for="last_name" class="form-label">Last Name </label>
            <input class="form-control" id="last_name" type="text" name="last_name" required>
        </div>
        <div class="mb-3 col-6">
            <label for="gender" class="form-label">Gender </label>
            <select class="form-control" id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="mb-3 col-6">
            <label for="date" class="form-label">Birth day</label>
            <input class="form-control" id="date" type="date" name="birth_date" required>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>

