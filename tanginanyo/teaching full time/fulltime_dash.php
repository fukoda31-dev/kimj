<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PLSP Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Fonts & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

:root{
    --green:#1f8a2b;
    --gray:#f0f0f0;
}

/* ===== HEADER ===== */
.top-header{
    height:140px;
    background:var(--green);
    color:#fff;
    display:flex;
    align-items:center;
    padding:20px 30px;
}

.logo{
    display:flex;
    align-items:center;
    gap:20px;
}

.logo img{
    width:90px;
    height:90px;
    border-radius:50%;
    border:2px solid #fff;
}

.logo h1{font-size:24px;}
.logo span{font-size:14px;font-style:italic;}

/* ===== LAYOUT ===== */
.wrapper{
    display:flex;
    height:calc(100vh - 140px);
    overflow: hidden;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:250px;
    background:var(--gray);
    padding:25px 15px;
    display:flex;
    flex-direction:column;
    align-items:center;
    position:relative;
    z-index:2;
    transition: width 0.3s;
    overflow-y:auto;
}

.profile{margin-bottom:30px;}
.profile-circle{
    width:120px;
    height:120px;
    border:2px solid #ccc;
    border-radius:50%;
    overflow:hidden;
    display:flex;
    justify-content:center;
    align-items:center;
    margin-bottom:20px;
    cursor:pointer;
}
.profile-circle img{
    width:100%; 
    height:100%; 
    object-fit:cover; 
    border-radius:50%;
}

/* SIDEBAR MAIN BUTTONS */
.sidebar-icon{
    width:100%;
    margin-bottom:10px;
    cursor:pointer;
    display:flex;
    flex-direction:row;
    justify-content:flex-start;
    align-items:center;
    gap:12px;
    transition:all 0.3s;
    background:#fff;
    padding:8px 12px;
    border-radius:70px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
    text-decoration:none;
    color:inherit;
}

/* DROPDOWN SECTIONS */
.sub-buttons{
    width:100%;
    display:flex;
    flex-direction:column;
    margin-bottom:10px;
    gap:10px;
    max-height:0;
    overflow:hidden;
    opacity:0;
    transition: max-height 0.4s ease, opacity 0.4s ease;
}
.sub-buttons.show{
    max-height:500px;
    opacity:1;
}

.sub-buttons a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:10px;
    text-align:left;
    border-radius:15px;
    background:#e8e8e8;
    font-weight:500;
    position:relative;
    transition: transform 0.2s;
}
.sub-buttons a:hover{
    transform: scale(1.03);
}

.sub-buttons a .inbox-dot{
    position:absolute;
    top:8px;
    right:12px;
    width:10px;
    height:10px;
    background:red;
    border-radius:50%;
    display:none;
}

/* ===== MAIN CONTENT ===== */
.main{
    flex:1;
    padding:30px;
    overflow-y:auto;
}

.greeting{
    font-size:32px;
    font-weight:700;
    color:var(--green);
    margin-bottom:25px;
    font-family:"Times New Roman", serif;
}

/* ===== CARDS ===== */
.cards{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

/* REPORT */
.report{
    flex:1;
    background:#e5e5e5;
    border-radius:12px;
    padding:20px;
    position:relative;
    min-height:420px;
}

.report-title{
    position:absolute;
    bottom:15px;
    left:50%;
    transform:translateX(-50%);
    background:#fff;
    padding:8px 18px;
    border-radius:30px;
    font-size:18px;
    box-shadow:0 2px 6px rgba(0,0,0,.2);
}

.report canvas{
    width:100% !important;
    height:100% !important;
}

/* SCHEDULE */
.schedule{
    flex:1;
    background:#dcdcdc;
    border-radius:12px;
    padding:10px;
    overflow:auto;
}

.schedule table{
    width:100%;
    border-collapse:collapse;
    background:#eee;
}

.schedule th,
.schedule td{
    border:1px solid #000;
    padding:8px;
    text-align:center;
    font-size:14px;
}

.schedule th{
    background:#cfcfcf;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="top-header">
    <div class="logo">
        <img src="download.png">
        <div>
            <h1>Pamantasan ng Lungsod ng San Pablo</h1>
            <span>Prime to Lead and Serve for Progress!</span>
        </div>
    </div>
</div>

<!-- BODY -->
<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="profile">
            <div class="profile-circle" onclick="window.location.href='profile.php'">
                <img src="profile.png" alt="Profile Picture">
            </div>
        </div>

        <div class="sidebar-icon" onclick="toggleDropdown('forms')">
            <i data-feather="file-text"></i>
            <span class="icon-label">Forms</span>
        </div>
        <div class="sub-buttons" id="forms">
            <a href="sick.php"><i data-feather="thermometer"></i> Sick Leave</a>
            <a href="coc.php"><i data-feather="file"></i> COC</a>
        </div>

        <div class="sidebar-icon" onclick="toggleDropdown('inbox')">
            <i data-feather="inbox"></i>
            <span class="icon-label">Inbox</span>
        </div>
        <div class="sub-buttons" id="inbox">
            <a href="drafts.php"><i data-feather="edit"></i> Drafts <span class="inbox-dot" id="dot-drafts"></span></a>
            <a href="sent.php"><i data-feather="send"></i> Sent <span class="inbox-dot" id="dot-sent"></span></a>
            <a href="spam.php"><i data-feather="alert-circle"></i> Spam <span class="inbox-dot" id="dot-spam"></span></a>
            <a href="trash.php"><i data-feather="trash-2"></i> Trash <span class="inbox-dot" id="dot-trash"></span></a>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="greeting">Good Morning !!!</div>

        <div class="cards">

            <!-- REPORT -->
            <div class="report">
                <canvas id="reportChart"></canvas>
                <div class="report-title">Report</div>
            </div>

            <!-- SCHEDULE -->
            <div class="schedule">
                <table>
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>8:00–9:00</td>
                            <td>Class</td>
                            <td></td>
                            <td>Class</td>
                            <td></td>
                            <td>Class</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>9:00–10:00</td>
                            <td></td>
                            <td>Class</td>
                            <td></td>
                            <td>Class</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

<script>
feather.replace();

/* DROPDOWN FUNCTION */
function toggleDropdown(id){
    const el = document.getElementById(id);
    el.classList.toggle('show');
}

/* REPORT CHART */
new Chart(document.getElementById('reportChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May'],
        datasets: [{
            label: 'Reports',
            data: [10, 14, 12, 20, 18],
            borderColor: '#1f8a2b',
            backgroundColor: 'rgba(31,138,43,0.2)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive:true,
        maintainAspectRatio:false
    }
});
</script>

</body>
</html>
