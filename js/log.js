// let loggedin = window.localStorage.getItem("authToken");
let loggedin = "<?php echo $_SESSION['logged'];?>";
if (loggedin !== "" && loggedin === "true") {
  window.location = "index.php";
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
        document.getElementById("otp-status").innerHTML = "OTP sent on email";
      } else {
        document.getElementById("otp-status").innerHTML =
          "OTP sent failed, try again";
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
        // window.localStorage.setItem("authToken", "success");
        // window.localStorage.setItem("userId", jsonObj["email"]);
        // window.location = "index.html";
        window.location = "http://localhost/food/login.php";
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
  let string1 = removeSpaces(document.getElementById("mainCaptcha").value);
  let string2 = removeSpaces(document.getElementById("captcha").value);

  console.log(string1 + " = " + string2);

  if (string1 == string2) {
    // document.getElementById("success").innerHTML =
    //   "Form is validated Successfully";
    // alert("Form is validated Successfully");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "./api/login.php", true);
    xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (this.status === 200) {
        console.log(this.responseText);
        let jsonObj = JSON.parse(this.responseText);
        if (jsonObj["success"] === true) {
          alert(jsonObj["message"]);
          // window.localStorage.setItem("authToken", "success");
          // window.localStorage.setItem("userId", jsonObj["email"]);
          window.location = "./index.php";
          // window.location = "http://localhost/food/login.php";
        } else {
          alert("Invalid Username Or Password");
        }
      } else {
        console.log("Error");
        alert("Some error occured, try again later.");
      }
    };

    let formData = new FormData(document.getElementById("loginForm"));
    xhr.send(formData);

    return true;
  } else {
    // document.getElementById("error").innerHTML =
    //   "Please enter a valid captcha.";
    alert("Please enter a valid captcha.");
    return false;
  }
}
