// Checking if the user already logged in or not;
let loggedin = window.localStorage.getItem("authToken");
if (loggedin !== "" && loggedin === "success") {
  window.location = "index.html";
}
const logBtn = document.getElementById("loginBtn");
const uidEl = document.getElementById("uid");
const passEl = document.getElementById("pass");

logBtn.addEventListener("click", logMe);

function logMe() {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/food/api/login.php", true);
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (this.status === 200) {
      console.log(this.responseText);
      let jsonObj = JSON.parse(this.responseText);
      if (jsonObj["success"] === true) {
        alert("Login Successfull");
        window.localStorage.setItem("authToken", "success");
        window.localStorage.setItem("userId", jsonObj["userid"]);
        window.location = "index.html";
      }
    } else {
      console.log("Error");
    }
  };

  let formData = new FormData(document.getElementById("loginForm"));
  xhr.send(formData);
}
