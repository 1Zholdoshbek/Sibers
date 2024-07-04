<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
include('config.php');

// Пагинация и сортировка
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$sql = "SELECT * FROM users ORDER BY $sort $order";
$result = $conn->query($sql);

$total_sql = "SELECT COUNT(*) as count FROM users";
$total_result = $conn->query($total_sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    .pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
    }
    .pagination li {
    display: inline-block;
    list-style: none;
    margin: 0 5px;
    padding: 0;
    }
    .pagination li a {
    display: block;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 3px;
    text-decoration: none;
    color: #333;
    }
    .pagination li a:hover {
    background-color: #f1f1f1;
    }
    .pagination li.active a {
    background-color: #4CAF50;
    color: white;
    }
    .pagination li.disabled a {
    color: #ccc;
    cursor: not-allowed;
    }
    </style>
</head>
<body>
<div class="container d-flex justify-content-between mt-4">
    <div>
        <a class="btn btn-primary" href="add_user.php">Add New User</a>

    </div>
    <div>
        <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
</div>

<div class="container mt-5">
    <h3>Users table</h3>
    <table  class="table table-bordered border-primary" border="1">
        <tr>
            <th><a href="?sort=id&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>">ID</a></th>
            <th><a href="?sort=username&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>">Username</a></th>
            <th>
                <a href="?sort=first_name&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>">First Name</a>
            </th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Birth Date</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['birth_date']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
