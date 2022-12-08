// Checking if the user already logged in or not;
let loggedin = window.localStorage.getItem("authToken");
if (loggedin !== "" && loggedin === "success") {
  window.location = "index.html";
}

// Geting the elements in form of variables
const regBtn = document.getElementById("loginBtn");
const uidEl = document.getElementById("uid");
const passEl = document.getElementById("pass");

// Setting an click listener
regBtn.addEventListener("click", regMe);

// Onclick functiont to authenticate the login
function regMe() {
  // XMLHttpRequest object initialization
  const xhr = new XMLHttpRequest();
  // Setting the method and url to the object
  xhr.open("POST", "http://localhost/food/api/register.php", true);
  // Setting the response header for the post method
  xhr.getResponseHeader("Content-type", "application/x-www-form-urlencoded");

  // After getting the response setting the authentication.
  xhr.onload = function () {
    if (this.status === 200) {
      console.log(this.responseText);
      let jsonObj = JSON.parse(this.responseText);
      if (jsonObj["success"] === true) {
        alert("Registration Successfull");
        window.localStorage.setItem("authToken", "success");
        window.localStorage.setItem("userId", jsonObj["userid"]);
        window.location = "index.html";
      }
    } else {
      console.log("Error");
    }
  };

  // Geting the form data with form data
  let formData = new FormData(document.getElementById("loginForm"));

  // Sending the request to the url
  xhr.send(formData);
}
