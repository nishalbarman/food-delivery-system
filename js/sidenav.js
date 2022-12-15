function openNav() {
  let loggedin = window.localStorage.getItem("authToken");
  if (!(loggedin !== "" && loggedin === "success")) {
    document.getElementById("mySidenav1").style.width = "240px";
  } else {
    document.getElementById("mySidenav").style.width = "240px";
  }

  document.getElementById("main").style.marginLeft = "240px";
}

function closeNav() {
  let loggedin = window.localStorage.getItem("authToken");
  if (!(loggedin !== "" && loggedin === "success")) {
    document.getElementById("mySidenav1").style.width = "0";
  } else {
    document.getElementById("mySidenav").style.width = "0";
  }

  document.getElementById("main").style.marginLeft = "0";
}
