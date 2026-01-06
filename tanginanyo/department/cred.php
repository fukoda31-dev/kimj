You ran out of storage 3 days ago … Not enough storage. Get more now, or remove files from Drive, Google Photos, or Gmail. Get 30 GB for ₱49/mo. Get 50% off annual plans for 1 year with a limited time offer.
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Credential Form</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
/* RESET + GLOBAL */
*{margin:0;padding:0;box-sizing:border-box;font-family:"Poppins",sans-serif;}
body{
  background:#f4f6f9;
  display:flex;
  min-height:100vh;
  color:#333;
}

/* LEFT PANEL */
.left-panel{
  width:38%;
  background:#0a7c12;
  color:#fff;
  padding:60px 40px;
  border-right:6px solid #ffffff;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  text-align:center;
  gap:12px;
}
.left-panel img{
  width:145px;
  margin-bottom:12px;
}
.left-panel h1{
  font-size:26px;
  font-weight:600;
}
.left-panel p{
  font-size:15px;
  opacity:0.9;
}

/* RIGHT PANEL */
.right-panel{
  flex:1;
  padding:35px;
  overflow-y:auto;
}
.back-arrow{
  font-size:30px;
  cursor:pointer;
  margin-bottom:12px;
  user-select:none;
  color:#222;
}

/* FORMS CONTAINER */
#formsContainer{
  display:flex;
  flex-direction:column;
  gap:20px;
}

/* FORM BOX */
.form-box{
  width:72%;
  background:#fff;
  padding:25px;
  border-radius:14px;
  border:1px solid #e1e1e1;
  box-shadow:0 4px 18px rgba(0,0,0,0.06);
  transition:0.3s ease;
  transform-origin:left center;
}

/* Animations */
.form-box.front{
  animation:bounceIn 450ms cubic-bezier(.16,.9,.3,1) forwards;
}
.form-box.old{
  opacity:0.85;
  transform:scale(0.97);
}

/* keyframes */
@keyframes bounceIn{
  0%{opacity:0;transform:translateX(40px) scale(0.95);}
  60%{opacity:1;transform:translateX(-5px) scale(1.02);}
  100%{opacity:1;transform:translateX(0) scale(1);}
}

/* UPLOAD */
.upload-row{
  display:flex;
  gap:14px;
  margin-bottom:15px;
}
.preview-box{
  flex:1;
  height:130px;
  background:#fafafa;
  border:1px dashed #B3B3B3;
  border-radius:10px;
  display:flex;
  justify-content:center;
  align-items:center;
  overflow:hidden;
  color:#777;
  font-size:14px;
}
.preview-box img{
  width:100%;
  height:100%;
  object-fit:contain;
}

.upload-icon-btn{
  width:22%;
  height:130px;
  background:#ffffff;
  color:#fff;
  font-size:26px;
  display:flex;
  justify-content:center;
  align-items:center;
  border-radius:10px;
  cursor:pointer;
  position:relative;
  user-select:none;
}
.upload-icon-btn input[type="file"]{
  position:absolute;
  inset:0;
  width:100%;
  height:100%;
  opacity:0;
  cursor:pointer;
}

/* INPUTS */
.form-box input,
.form-box select{
  width:100%;
  padding:12px;
  border:1px solid #ccc;
  border-radius:8px;
  margin-bottom:12px;
  font-size:14px;
}

/* BUTTONS */
.buttons{
  display:flex;
  justify-content:flex-end;
  gap:10px;
}
button{
  padding:10px 16px;
  border:none;
  border-radius:8px;
  font-weight:600;
  cursor:pointer;
  transition:0.2s;
}
.upload-btn{
  background:#0a7c12;
  color:#fff;
}
.upload-btn:hover{
  background:#085d0d;
}
.add-btn{
  background:#007bff;
  color:#fff;
}
.add-btn:hover{
  background:#0060c9;
}

/* RESPONSIVE */
@media(max-width:900px){
  .left-panel{display:none;}
  .form-box{width:100%;}
}
/* Stack system: forms sit on top of each other */
#formsContainer {
  position: relative;
  height: 550px; /* fixed height to prevent scrolling */
  overflow: hidden; /* no scrolling allowed */
}

/* both forms must overlap */
.form-box {
  position: absolute;
  top: 0;
  left: 0;
  width: 72%;
}

/* old form moves behind */
.form-box.back {
  transform: translateX(-40px) scale(0.9);
  opacity: 0.7;
  transition: 2.5s ease;
  position: absolute;
  width: 72%;
  left: 0;
  top: 0;
}


/* new form is in front */
.form-box.front {
  animation: slideIn 2.5s ease forwards;
  position: absolute;
  width: 72%;
  left: 0;
  top: 0;
}
@keyframes slideIn {
  0% { opacity: 0; transform: translateX(80px) scale(0.95); }
  40% { opacity: 1; transform: translateX(-10px) scale(1.03); }
  100% { opacity: 1; transform: translateX(0) scale(1); }
}



</style>
<style>
/* Make logo circular */
.left-panel img{
  width:145px;
  height:145px;
  border-radius:50%;
  object-fit:cover;
  margin-bottom:12px;
}

/* Label above input */
.input-group{
  margin-bottom:12px;
  display:flex;
  flex-direction:column;
}
.input-group label{
  font-size:14px;
  font-weight:500;
  color:#333;
  margin-bottom:5px;
}

</style>

</head>
<body>

<!-- LEFT PANEL -->
<div class="left-panel">
  <img src="plsp pic.jpg" alt="logo">
  <h1>Pamantasan ng Lungsod ng San Pablo</h1>
  <p>Prime to Lead and Serve for Progress!</p>
</div>

<!-- RIGHT PANEL -->
<div class="right-panel">
  <div class="back-arrow" onclick="goBack()">&#8592;</div>

  <div id="formsContainer"></div>
</div>

<script>let count = 0;

function addForm(){
  count++;

  const container = document.getElementById("formsContainer");
  const oldForm = container.querySelector(".form-box.front");

  // Push old form to back (do NOT remove)
  if(oldForm){
    oldForm.classList.remove("front");
    oldForm.classList.add("back");
  }

  // Create new active form
  const form = document.createElement("div");
  form.className = "form-box front";

  const prevID = "prev" + count;

  form.innerHTML = `
    <h2 style="margin-bottom:15px;font-weight:600;color:#222;">Credential Information</h2>

    <div class="upload-row">
      <div class="preview-box" id="${prevID}">No File</div>

      <label class="upload-icon-btn">
        📄
        <input type="file" accept="image/*" data-prev="${prevID}">
      </label>
    </div>

   <select> <option value="">Doc Type</option> <option>COC</option> <option>Sick Leave</option> <option>CV</option> <option>Seminar Certificate</option> <option>Others</option> </select> <input type="text" placeholder="Type of Document"> <input type="date"> <input type="text" placeholder="Issued By"> <div class="buttons"> <button class="upload-btn" type="button">Upload</button> <button class="add-btn" type="button">Add More</button> </div> 
`;
  container.appendChild(form);

  // Preview image
  form.querySelector('input[type="file"]').addEventListener("change", function(){
    if(!this.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById(this.dataset.prev).innerHTML = `<img src="${e.target.result}">`;
    };
    reader.readAsDataURL(this.files[0]);
  });

  // Add More button
  form.querySelector(".add-btn").addEventListener("click", addForm);

  // Keep only 2 forms
  const all = container.querySelectorAll(".form-box");
  if(all.length > 2){
    all[0].remove();
  }
}

function goBack(){
  addForm();
}

addForm();

</script>
</body>
</html>