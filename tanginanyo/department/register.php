
<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data
    $full_name = $_POST['full_name'];
    $birth_date = $_POST['birth_date'];
    $age = $_POST['age'];
    $contact_number = $_POST['contact_number'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $civil_status = $_POST['civil_status'];
    $civil_date = $_POST['civil_date'];
    $id_number = $_POST['id_number'];
    $emergency_contact = $_POST['emergency_contact'];
    $emergency_number = $_POST['emergency_number'];

    // Handle profile photo upload
    $profile_photo = "";
    if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        $target_dir = "uploads/";
        if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $file_name = time() . "_" . basename($_FILES["profile_photo"]["name"]);
        $target_file = $target_dir . $file_name;

        if(move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
            $profile_photo = $target_file;
        }
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO users 
        (full_name, birth_date, age, contact_number, sex, address, civil_status, civil_date, id_number, emergency_contact, emergency_number) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssisssssssss",
        $full_name,
        $birth_date,
        $age,
        $contact_number,
        $sex,
        $address,
        $civil_status,
        $civil_date,
        $id_number,
        $emergency_contact,
        $emergency_number,
        
    );

    if($stmt->execute()){
        $_SESSION['success'] = "Registration successful!";
        header("Location: login.php"); // redirect to login
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="container">

    <!-- LEFT PANEL -->
    <div class="left-panel">
        <button class="left-back">&#8592;</button>

        <img src="plsp pic.jpg" alt="School Logo" class="logo">
        <h2>Pamantasan ng Lungsod<br>ng San Pablo</h2>
        <p>Prime to Lead and Serve for Progress!</p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
        <button class="right-back">&#8592;</button>

        <div class="form-container">
            <h3>Register</h3>

            <div class="profile-photo">
                <div class="circle">
                    <img id="profile-img" src="avatar.png" alt="Profile Preview">
                </div>
                <label for="profile-upload" class="camera-icon">&#128247;</label>
                <input type="file" id="profile-upload" accept="image/*" hidden>
            </div>

            <form action="register.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="full_name" placeholder="Full name" required>
    <div class="row">
        <input type="date" name="birth_date" required>
        <input type="number" name="age" placeholder="Age" min="1" max="120">
    </div>
    <div class="row">
        <input type="tel" name="contact_number" placeholder="Contact Number">
        <input type="text" name="sex" placeholder="Sex" list="sex-options">
    </div>
    <input type="text" name="address" placeholder="Address">
    <div class="row">
        <input type="text" name="civil_status" placeholder="Civil Status" list="civil-status-options">
        <input type="date" name="civil_date">
    </div>
    <input type="text" name="id_number" placeholder="Identification Number">
    <div class="row">
        <input type="text" name="emergency_contact" placeholder="Emergency Contact">
        <input type="tel" name="emergency_number" placeholder="Emergency Number">
    </div>
    
     <button type="submit" class="next-btn" onclick="window.location.href='register3.php'">Next</button>

</form>

        </div>
    </div>

</div>

<script>
    const upload = document.getElementById("profile-upload");
    const img = document.getElementById("profile-img");

    document.querySelector(".camera-icon").addEventListener("click", () => {
        upload.click();
    });

    upload.addEventListener("change", e => {
        const file = e.target.files[0];
        if (file) {
            img.src = URL.createObjectURL(file);
        }
    });
</script>

</body>
</html>