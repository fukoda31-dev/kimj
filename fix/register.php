<?php
// register.php
session_start();
require 'db.php'; // Provides $conn (mysqli)

function e($v){ return htmlspecialchars(trim($v)); }

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'final_register') {

    // PANEL 1 fields
    $full_name = e($_POST['full_name'] ?? '');
    $birth_date = $_POST['birth_date'] ?? null;
    $age = $_POST['age'] ?? null;
    $contact_number = e($_POST['contact_number'] ?? '');
    $sex = e($_POST['sex'] ?? '');
    $address = e($_POST['address'] ?? '');
    $civil_status = e($_POST['civil_status'] ?? '');
    $civil_date = $_POST['civil_date'] ?? null;
    $id_number = e($_POST['id_number'] ?? '');
    $emergency_contact = e($_POST['emergency_contact'] ?? '');
    $emergency_number = e($_POST['emergency_number'] ?? '');

    // PANEL 2 fields
    $employee_selects = e($_POST['employee_selects'] ?? '');
    $position = e($_POST['position'] ?? '');
    $department = e($_POST['department'] ?? '');
    $employee_type = e($_POST['employee_type'] ?? '');
    $per_office = e($_POST['per_office'] ?? '');

    // Account info
    $email = e($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    $old = $_POST;

    // Validation
    if (!$full_name) $errors[] = "Full name is required.";
    if (!$birth_date) $errors[] = "Birth date is required.";

    if (!$email) $errors[] = "Email is required.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";

    if (!$password) $errors[] = "Password is required.";
    elseif ($password !== $password_confirm) $errors[] = "Passwords do not match.";

    // Check email if exists
    if (!$errors) {
        $chk = $conn->prepare("SELECT user_id FROM users WHERE email=?");
        $chk->bind_param("s", $email);
        $chk->execute();
        $chk->store_result();
        if ($chk->num_rows > 0) $errors[] = "Email already registered.";
        $chk->close();
    }

    if (empty($errors)) {
        // Start transaction
        $conn->begin_transaction();

        try {
            $pw_hash = password_hash($password, PASSWORD_DEFAULT);

            // auto username = id_number or full_name shortened
            $username = $id_number ?: strtolower(str_replace(' ', '_', $full_name));

            // Split first/last
            $fn = $full_name;
            $ln = "";
            if (strpos($full_name, ' ') !== false) {
                $parts = preg_split('/\s+/', $full_name);
                $fn = array_shift($parts);
                $ln = implode(' ', $parts);
            }

            // Insert users
            $stmt = $conn->prepare("INSERT INTO users (email, username, password_hash, first_name, last_name) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $email, $username, $pw_hash, $fn, $ln);
            if (!$stmt->execute()) throw new Exception($stmt->error);
            $user_id = $stmt->insert_id;
            $stmt->close();

            // Insert user_profiles
            $stmt = $conn->prepare("
                INSERT INTO user_profiles (user_id, full_name, birth_date, sex, contact_number, address, civil_status, civil_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("isssssss",
                $user_id, $full_name, $birth_date, $sex, $contact_number,
                $address, $civil_status, $civil_date
            );
            if (!$stmt->execute()) throw new Exception($stmt->error);
            $stmt->close();

            // Upload profile photo
            if (!empty($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
                $ext = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
                $fileName = "profile_{$user_id}_" . time() . "." . $ext;
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadDir . $fileName);

                $relPath = $uploadDir . $fileName;
                $stmt = $conn->prepare("INSERT INTO profile_pictures (user_id, file_path) VALUES (?, ?)");
                $stmt->bind_param("is", $user_id, $relPath);
                $stmt->execute();
                $stmt->close();
            }

            // Upload documents
            if (!empty($_FILES['documents'])) {
                for ($i = 0; $i < count($_FILES['documents']['name']); $i++) {
                    if ($_FILES['documents']['error'][$i] == 0) {
                        $orig = $_FILES['documents']['name'][$i];
                        $ext = pathinfo($orig, PATHINFO_EXTENSION);
                        $fileName = "doc_{$user_id}_" . time() . "_$i.$ext";

                        $uploadDir = "uploads/";
                        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                        move_uploaded_file($_FILES['documents']['tmp_name'][$i], $uploadDir . $fileName);

                        $relPath = $uploadDir . $fileName;
                        $stmt = $conn->prepare("INSERT INTO employee_files (user_id, file_url, file_name, uploaded_by) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("isss", $user_id, $relPath, $orig, $user_id);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            }

            // Log metadata
            $meta = "Employee Selects=$employee_selects | Position=$position | Department=$department | Employee Type=$employee_type | Per Office=$per_office";
            $stmt = $conn->prepare("INSERT INTO activity_logs (user_id, action, entity_type, details) VALUES (?, 'register', 'employee_meta', ?)");
            $stmt->bind_param("is", $user_id, $meta);
            $stmt->execute();
            $stmt->close();

            // Commit
            $conn->commit();

            // SUCCESS → Redirect to Index.php
            header("Location: Index.php");
            exit();

        } catch (Exception $e) {
            $conn->rollback();
            $errors[] = "Registration failed: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PLSP Registration</title>
<style>
/* Simplified styling for space */
body { font-family: Arial; background:#e8f0e6; margin:0; }
.container { display:flex; min-height:100vh; }
.left { width:40%; background:#197a2f; color:#fff; text-align:center; padding-top:60px; }
.left img { width:160px; }
.right { flex:1; background:#fff; padding:30px; }

.panel { display:none; }
.panel.active { display:block; }

input, select, button {
    padding:12px;
    border-radius:20px;
    border:1px solid #ccc;
    width:100%;
    margin-bottom:12px;
}
button { background:#197a2f; color:white; cursor:pointer; }
.row { display:flex; gap:10px; }
.profile-preview { width:120px; height:120px; border-radius:50%; overflow:hidden; }
.profile-preview img { width:100%; height:100%; object-fit:cover; }
.error { background:#ffd0d0; padding:12px; border-radius:10px; margin-bottom:12px; color:#900; }
</style>
</head>
<body>

<div class="container">
    <div class="left">
        <img src="plsp pic.jpg" alt="Logo">
        <h2>Pamantasan ng Lungsod<br>ng San Pablo</h2>
        <p>Prime to Lead and Serve for Progress!</p>
    </div>

    <div class="right">

        <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach($errors as $e) echo "<div>".e($e)."</div>"; ?>
        </div>
        <?php endif; ?>

<form method="POST" enctype="multipart/form-data">

<input type="hidden" name="action" value="final_register">

<!-- PANEL 1 -->
<div id="panel1" class="panel active">

    <div class="profile-preview"><img id="profile-img" src="avatar.png"></div>
    <input type="file" name="profile_photo" id="profile-upload">

    <input type="text" name="full_name" placeholder="Full Name" required>
    <div class="row">
        <input type="date" name="birth_date" required>
        <input type="number" name="age" placeholder="Age">
    </div>

    <div class="row">
        <input type="tel" name="contact_number" placeholder="Contact Number">
        <input type="text" name="sex" placeholder="Sex">
    </div>

    <input type="text" name="address" placeholder="Address">

    <div class="row">
        <input type="text" name="civil_status" placeholder="Civil Status">
        <input type="date" name="civil_date">
    </div>

    <input type="text" name="id_number" placeholder="Identification Number">

    <div class="row">
        <input type="text" name="emergency_contact" placeholder="Emergency Contact">
        <input type="tel" name="emergency_number" placeholder="Emergency Number">
    </div>

    <button type="button" onclick="gotoPanel2()">Next →</button>
</div>

<!-- PANEL 2 -->
<div id="panel2" class="panel">

    <div class="row">
        <input type="text" name="employee_selects" placeholder="Employee Selects">
        <input type="text" name="position" placeholder="Position">
    </div>

    <div class="row">
        <input type="text" name="department" placeholder="Department">
        <input type="text" name="employee_type" placeholder="Employee Type">
    </div>

    <input type="text" name="per_office" placeholder="Per Office">

    <label>Upload Documents:</label>
    <input type="file" name="documents[]" multiple>

    <input type="email" name="email" placeholder="Email" required>
    <div class="row">
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirm" placeholder="Confirm Password" required>
    </div>

    <button type="button" onclick="gotoPanel1()">← Back</button>
    <button type="submit">Submit Registration</button>

</div>

</form>
</div>
</div>

<script>
// Switch panels
function gotoPanel2(){
    document.getElementById("panel1").classList.remove("active");
    document.getElementById("panel2").classList.add("active");
}
function gotoPanel1(){
    document.getElementById("panel2").classList.remove("active");
    document.getElementById("panel1").classList.add("active");
}

// Profile image preview
document.getElementById('profile-upload').addEventListener('change', e=>{
    const file = e.target.files[0];
    if(file) document.getElementById('profile-img').src = URL.createObjectURL(file);
});
</script>

</body>
</html>
