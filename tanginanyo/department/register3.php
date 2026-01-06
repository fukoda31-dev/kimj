You ran out of storage 3 days ago … Not enough storage. Get more now, or remove files from Drive, Google Photos, or Gmail. Get 30 GB for ₱49/mo. Get 50% off annual plans for 1 year with a limited time offer.
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>PLSP Registration UI</title>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #e8f0e6;
    }

    .container {
        display: flex;
        height: 100vh;
    }

    /* Left Panel */
    .left {
        width: 40%;
        background: #197a2f;
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        text-align: center;
        box-shadow: 3px 0 10px rgba(0,0,0,0.2);
    }

    .left img {
        width: 170px;
        margin-bottom: 15px;
    }

    .left h1 {
        font-size: 30px;
        margin: 0;
        font-weight: bold;
    }

    .left p {
        margin-top: 8px;
        font-size: 16px;
        opacity: 0.9;
        font-style: italic;
    }

    /* Right Panel */
    .right {
        width: 60%;
        background: white;
        padding: 40px 50px;
        overflow-y: auto;
    }

    .back-btn {
        font-size: 26px;
        cursor: pointer;
        margin-bottom: 10px;
        transition: 0.2s;
    }

    .back-btn:hover {
        transform: translateX(-5px);
    }

    h2 {
        text-align: center;
        background: #197a2f;
        padding: 12px 0;
        color: white;
        border-radius: 25px;
        width: 220px;
        font-size: 22px;
        margin: 0 auto 25px auto;
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    }

    /* Input Rows */
    .row {
        padding: 0 10px;
        display: flex;
        gap: 15px;
        margin-bottom: 18px;
    }

    input {
        flex: 1;
        padding: 12px;
        border-radius: 25px;
        border: 1px solid #bfbfbf;
        background: #fafafa;
        transition: 0.2s;
    }

    input:focus {
        border-color: #197a2f;
        background: white;
        box-shadow: 0 0 5px rgba(25,122,47,0.4);
        outline: none;
    }

    /* Upload Section */
    .upload-section {
        padding: 20px 20px;
        border-radius: 15px;
        background: #f8f8f8;
        margin-top: 15px;
        box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
    }

    .upload-btn {
        background: #197a2f;
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        transition: 0.2s;
    }

    .upload-btn:hover {
        background: #155f27;
    }

    .box-row {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .box-row div {
        width: 45px;
        height: 45px;
        background: #e2e2e2;
        border-radius: 10px;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.15);
    }

    /* Register Button */
    .register-btn {
        width: 230px;
        padding: 14px;
        background: #197a2f;
        color: white;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        display: block;
        margin: 25px auto;
        font-size: 17px;
        transition: 0.2s;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .register-btn:hover {
        background: #155f27;
        transform: scale(1.05);
    }

    /* Hide Per Office Smoothly */
    .hidden {
        display: none;
    }
    .left-panel .logo {
    width: 140px;
    margin: 0 auto 20px;
}
</style>
</head>

<body>

<div class="container">

    <!-- LEFT -->
    <div class="left">
        <img src="plsp pic.jpg" alt="PLSP Logo">
        <h1>Pamantasan ng Lungsod<br>ng San Pablo</h1>
        <p>Prime to Lead and Serve for Progress!</p>
    </div>

    <!-- RIGHT -->
    <div class="right">

        <div class="back-btn">←</div>
        <h2>Register</h2>

        <!-- Employee Selection -->
        <div class="row">
            <input id="empSelect" type="text" placeholder="Employee Selects" list="employee-selects">
            <datalist id="employee-selects">
                <option value="Non-Teaching">
                <option value="Teaching">
            </datalist>

            <input type="text" placeholder="Position">
        </div>

        <!-- Department + Employee Type -->
        <div class="row">
            <input type="text" placeholder="Department" list="department-list">
            <datalist id="department-list">
                <option value="CCSE">
                <option value="CBAM">
                <option value="CNAHS">
                <option value="CTED">
                <option value="CAS">
                <option value="COA">
                <option value="CTHM">
            </datalist>

            <input type="text" placeholder="Employee Type" list="employee-type">
            <datalist id="employee-type">
                <option value="Full-Time">
                <option value="Part-Time">
            </datalist>
        </div>

        <!-- Per Office (HIDE when selecting Non-Teaching) -->
        <div class="row" id="perOfficeRow">
            <input type="text" placeholder="Per Office" list="per-office">
            <datalist id="per-office">
                <option value="OSAS">
                <option value="Sinag">
                <option value="Registrar">
                <option value="EMIS">
                <option value="Finance">
                <option value="Admin">
                <option value="HR">
                <option value="Librarian">
                <option value="Clinic">
                <option value="Payroll">
                <option value="Guidance">
            </datalist>
        </div>

        <!-- Upload Section -->
        <div class="upload-section">
            <p><b>Upload Required Documents:</b></p>
            <ul>
                <li>Resume or CV</li>
                <li>Seminar or Training Certificates</li>
                <li>Skills and other certificates</li>
            </ul>

            <button class="upload-btn" onclick="window.location.href='cred.php'">Upload</button>

            <div class="box-row">
                <div></div><div></div><div></div><div></div><div></div>
            </div>
        </div>

        <!-- Email + Password -->
        <div class="row">
            <input type="email" placeholder="Email Address">
            <input type="password" placeholder="Password">
            <input type="password" placeholder="Confirm Password">
        </div>

        <button class="register-btn">Register</button>

    </div>
</div>

<!-- JavaScript: Hide Per Office if Non-Teaching -->
<script>
    const empSelect = document.getElementById("empSelect");
    const perOfficeRow = document.getElementById("perOfficeRow");

    empSelect.addEventListener("input", function () {
        if (empSelect.value === "Non-Teaching") {
            perOfficeRow.classList.add("hidden");
        } else {
            perOfficeRow.classList.remove("hidden");
        }
    });
</script>

</body>
</html>