<?php
session_start();
include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <style>
        th,
        td,
        tbody,
        caption {
            border: 1px solid #5218d0;
            border-collapse: collapse;
            padding: 0.5rem;
        }

       
    </style>

    <script>
        async function loadData() {
            const url = 'http://localhost:4000/home';
            const response = await fetch(url);
            const data = await response.json();
            let userInfo = document.querySelector(".tbody");


            data.forEach(element => {
                const {
                    shoeName,
                    brand,
                    releaseDate,
                    thumbnail
                } = element;
                let newRow =
                    `
        <tr>
        <td>${shoeName}</td>
        <td>${brand}</td>
        <td>${releaseDate}</td>
        <td><image src="${thumbnail}" width="200px" height="100px"></td>
        </tr>
        `
                userInfo.innerHTML += newRow

            });
        }

        loadData()
    </script>


</head>

<body>

    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Shoes-Commerce</a> </p>
        </div>
        <div class="right-links">
            <div class="action_nav">
                <?php
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT*FROM users WHERE Id=$id");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $res_id = $result['Id'];
                }
                echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
                ?>
                <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
                <b><?php echo $res_Email ?></b>
            </div>
        </div>
    </div>

    <div class="container2">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Make_Date</th>
                    <th>Picture</th>
                </tr>
            </thead>
            <tbody class="tbody"></tbody>
        </table>
    </div>

    <!-- <div class="container2">
    <table>
        <tr>
            <th>Name</th>
            <th>Brand</th>
            <th>Description</th>
            <th>Picture</th>
        </tr>
        <tbody class="tbody">
        </tbody>
    </table>
    </div> -->

    <!-- <div class="mt-3 mr-3 ml-3">
        <table class="table table-bordered" id="users-list">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>
        </table>
    </div> -->


</body>

</html>