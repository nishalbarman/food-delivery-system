// let loggedin = window.localStorage.getItem("authToken");
let loggedin =
  "<?php if (isset($_SESSION['logged'])) { echo $_SESSION['logged'];} else {echo '';} ?>";
if (loggedin !== "") {
  window.location = "index.html";
}

const regBtn = document.getElementById("loginBtn");
const otpBtn = document.getElementById("otpBtn");
const uidEl = document.getElementById("uid");
const passEl = document.getElementById("pass");
const API = "http://localhost/food/api/send-mail.php";
let otp;

regBtn.addEventListener("click", () => {
  document.getElementById("formWrapper").style.display = "none";
  document.getElementById("otpForm").style.display = "block";
  let email = document.getElementById("email").value;
  otp = Math.floor(100000 + Math.random() * 900000);

  const xhr = new XMLHttpRequest();

  xhr.open("GET", API + "?email=" + email + "&otp=" + otp, true);

  xhr.onload = function () {
    if (this.status === 200) {
      console.log(this.responseText);
      let jsonObj = JSON.parse(this.responseText);
      if (jsonObj.success === true) {
        alert("Otp has been sent.");
      } else {
        alert("Otp failed.");
      }
    } else {
      console.log("Error");
    }
  };

  xhr.send();
});

otpBtn.addEventListener("click", () => {
  let userOtp = document.getElementById("otp").value;
  if (userOtp == otp) {
    regMe();
  } else {
    document.getElementById("errorTxt").style.display = "block";
    document.getElementById("otp").value = "";
  }
});

function regMe() {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/food/api/register.php", true);
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.status === 200) {
      console.log(this.responseText);
      let jsonObj = JSON.parse(this.responseText);
      if (jsonObj["success"] === true) {
        alert("Registration Successfull");
        window.localStorage.setItem("authToken", "success");
        window.localStorage.setItem("userId", jsonObj["userid"]);
        window.location = "index.html";
      } else {
        alert(jsonObj["message"]);
      }
    } else {
      alert("Server error, Please try again later.");
    }
  };

  let formData = new FormData(document.getElementById("loginForm"));

  xhr.send(formData);
}
