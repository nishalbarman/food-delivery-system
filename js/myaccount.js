let loggedin = window.localStorage.getItem("authToken");
if (!(loggedin !== "" && loggedin === "success")) {
  alert(
    "You are not logged in, kindly log in or sign up to view account section."
  );
  window.location = "./log.html";
}
let userid = window.localStorage.getItem("userId");
console.log(userid);
const emails = document.querySelectorAll("[email]");
emails.forEach((element) => {
  element.value = userid;
});

function toogleMe(target) {
  if (target.textContent === "Give Feedback") {
    document.getElementById("profile-setting").style.display = "none";
    document.getElementById("feedback-form").style.display = "block";
  }
  if (target.textContent === "Profile Settings") {
    document.getElementById("profile-setting").style.display = "block";
    document.getElementById("feedback-form").style.display = "none";
  }
}
