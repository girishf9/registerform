<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$collage = $_POST['collage'];
$country = $_POST['country'];
$city = $_POST['city'];
$year = $_POST['year'];
$work = $_POST['work'];
$file = $_POST['file'];
if (!empty($firstname) || !empty($lastname) || !empty($email) || !empty($phone) || !empty($gender) || !empty($collage) || !empty($country) || !empty($city) || !empty($year) || !empty($work) || !empty($file)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "test1";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (firstname, lastname, email, phone, gender, collage, country, city, year, work,file) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssisssssss", $firstname, $lastname, $email, $phone, $gender, $collage, $country, $city, $year ,$work, $file);
      $stmt->execute();
      echo "New registration sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>