

<?php

if (!isset($_COOKIE["email"])) {
    header("location:login.php");
 }

$serverName = 'localhost';
$userName = 'root';
$password = '';
$dbName = 'fci';

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$fnameDb = isset($_POST["fname"]) ? $_POST["fname"] : "";
$lnameDb = isset($_POST["lname"]) ? $_POST["lname"] : "";
$emailDb = $_POST["email"];
$passwordDb = $_POST["password"];


if (isset($_POST["id"])) {
    $id = $_POST["id"];
}


$con = new mysqli($serverName, $userName, $password, $dbName);


if (isset($_POST["add"])) {

 echo "<pre>";
    print_r($_FILES["fileToUpload"]);
    echo "</pre>";



    $imgForm = $_FILES["fileToUpload"];
    $imgDb = $imgForm["name"];
    $oldPath = $imgForm["tmp_name"];
    $newPath = "uploadImages/" . $imgForm["name"];
    move_uploaded_file($oldPath, $newPath);

    $fnameDb = validate($fnameDb);
    $lnameDb = validate($lnameDb);
    $emailDb = validate($emailDb);

    $fnameDb = ucfirst(strtolower($fnameDb));
    $lnameDb = ucfirst(strtolower($lnameDb));

    $arrayError = [];

    if (strlen($fnameDb) < 2) {
        $arrayError["fname"] = "Not Valid First Name";
    }

    if (strlen($lnameDb) < 2) {
        $arrayError["lname"] = "Not Valid Last Name";
    }

    if (!filter_var($emailDb, FILTER_VALIDATE_EMAIL)) {
        $arrayError["email"] = "Not Valid Email Address";
    }
    if (!isImage($_FILES["fileToUpload"]["type"])) {
        $arrayError["image"] = "Uploaded  File Not Image Address";
        echo "ggggggggggggggggggggggg";
    }

    if (count($arrayError) > 0) {
        $err = json_encode($arrayError);
        header("location: register.php?errors=$err");
        
    // echo "<pre>";
    // print_r($err);
    // echo "</pre>";


    } else {
        $con->query("insert into student (fname,lname,email,password,img) values('$fnameDb','$lnameDb','$emailDb','$passwordDb','$imgDb')");
        header("location:display.php");
    }


    // echo "<pre>";
    // print_r($_FILES["fileToUpload"]);
    // echo "</pre>";




} elseif (isset($_POST["update"])) {




    $con->query("UPDATE student SET fname = '$fnameDb', lname= '$lnameDb', email= '$emailDb', password= '$passwordDb' WHERE id='$id' ");
    header("location:display.php");
} elseif (isset($_POST["login"])) {


    $checkAtrr = $con->query("select * from student where email='$emailDb' AND password ='$passwordDb'");
   
   $trans=$checkAtrr->fetch_assoc();
   if ($trans) {
 
    setcookie("fname",$trans["fname"]);
    setcookie("lname",$trans["lname"]);
    setcookie("email",$trans["email"]);
    setcookie("password",$trans["password"]);
    setcookie("img",$trans["img"]);
    setcookie("id",$trans["id"]);
    header("location:display.php");

   }else{
    header("location:login.php");

   }


    // $con->query("UPDATE student SET fname = '$fnameDb', lname= '$lnameDb', email= '$emailDb', password= '$passwordDb' WHERE id='$id' ");
    // header("location:display.php");
}


function validate($value)
{
    $validData = trim($value);
    $validData = stripslashes($value);
    $validData = htmlspecialchars($value);

    return $validData;
}

function isImage($image){
    $extension = $image ;
    $imgExtArr = ['image/jpg', 'image/jpeg', 'image/png'];
    if(in_array($extension, $imgExtArr)){
        return true;
    }
    return false;
}

?>

