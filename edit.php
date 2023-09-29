
<?php


if (!isset($_COOKIE["email"])) {
    header("location:login.php");
 }


$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'fci';


$id = $_GET["id"];

$con = new mysqli($serverName, $userName, $password, $dbName);
if ($con->connect_errno) {
    die("vaild");
}
$resulte = $con->query("select * from student where id='$id'");
$data = $resulte->fetch_assoc();


    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Register</title>
</head>

<body>
    <div class="bo  min-vh-100 d-flex align-items-center">
        <div class="container  col-10 col-sm-8 col-md-6 col-lg-4 m-auto ">
            <div class="divForm p-3 rounded-3 border border-1 border-black ">
                <h1 class="text-center">-3N-</h1>
                <form method="POST" action="studentController.php">
                    <div class="mb-1">
                        <label for="ID" class="form-label fw-bold">ID </label>
                        <input type="text" value='<?= $data["id"]?>' name="id" class="form-control" readonly  id="ID" aria-describedby="fnameHelp" required>
                    </div>
                    <div class="mb-1">
                        <label for="fname" class="form-label fw-bold">First Name </label>
                        <input type="text" value='<?= $data["fname"]?>' name="fname" class="form-control" id="fname" aria-describedby="fnameHelp" required>
                    </div>
                    <div class="mb-1">
                        <label for="lname" class="form-label fw-bold">Last Name </label>
                        <input type="text" value='<?= $data["lname"]?>' name="lname" class="form-control" id="lname" aria-describedby="lnameHelp" required>
                    </div>
                    <div class="mb-1">
                        <label for="email" class="form-label fw-bold">Email Address </label>
                        <input type="email" value='<?= $data["email"]?>' name="email" class="form-control" id="email" aria-describedby="fnameHelp" required>
                    </div>

                    <div class="mb-1">
                        <label for="exampleInputPassword1" class="form-label fw-bold">Password</label>
                        <input type="password" value='<?= $data["password"]?>' name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-1">
                        <label for="file" class="form-label fw-bold">Upload</label>
                        <input type="file" name="fileToUpload" value='<?= $data["img"]?>'  class="form-control" id="file" required>
                    </div>
                    <div class="bt text-center mt-4">
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </div>
                </form>
            </div>



        </div>
    </div>

</body>

</html>