let loggedin = window.localStorage.getItem("authToken");
if (loggedin !== "" && loggedin === "success") {
  window.location = "index.html";
}

const API = "./api/send-mail.php";

const logBtn = document.getElementById("loginBtn");
const regBtn = document.getElementById("regBtn");
const otpBtn = document.getElementById("otpBtn");
const uidEl = document.getElementById("uid");
const passEl = document.getElementById("pass");
let otp;

const forms = document.querySelector(".forms");
const pwShowHide = document.querySelectorAll(".eye-icon");
const links = document.querySelectorAll(".link");

logBtn.addEventListener("click", logMe);

pwShowHide.forEach((eyeIcon) => {
  eyeIcon.addEventListener("click", () => {
    let pwFields =
      eyeIcon.parentElement.parentElement.querySelectorAll(".password");

    pwFields.forEach((password) => {
      if (password.type === "password") {
        password.type = "text";
        eyeIcon.classList.replace("bx-hide", "bx-show");
        return;
      }
      password.type = "password";
      eyeIcon.classList.replace("bx-show", "bx-hide");
    });
  });
});

links.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    forms.classList.toggle("show-signup");
  });
});

regBtn.addEventListener("click", () => {
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

  document.getElementById("m-reg").style.display = "none";
  document.getElementById("reg-otp").style.display = "block";
});

otpBtn.addEventListener("click", () => {
  let userOtp = document.getElementById("otpField").value;
  if (userOtp == otp) {
    regMe();
  } else {
    alert("Invalid OTP");
    // document.getElementById("errorTxt").style.display = "block";
    document.getElementById("otpField").value = "";
  }
});

function regMe() {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/register.php", true);
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.status === 200) {
      console.log(this.responseText);
      let jsonObj = JSON.parse(this.responseText);
      if (jsonObj["success"] === true) {
        alert("Registration Successfull");
        window.localStorage.setItem("authToken", "success");
        window.localStorage.setItem("userId", jsonObj["email"]);
        window.location = "index.html";
      } else {
        alert(jsonObj["message"]);
      }
    } else {
      alert("Server error, Please try again later.");
    }
  };

  let formData = new FormData(document.getElementById("regForm"));

  xhr.send(formData);
}

function logMe() {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "./api/login.php", true);
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.status === 200) {
      console.log(this.responseText);
      let jsonObj = JSON.parse(this.responseText);
      if (jsonObj["success"] === true) {
        alert(jsonObj["message"]);
        window.localStorage.setItem("authToken", "success");
        window.localStorage.setItem("userId", jsonObj["email"]);
        window.location = "index.html";
      }
    } else {
      console.log("Error");
    }
  };

  let formData = new FormData(document.getElementById("loginForm"));
  xhr.send(formData);
}
