let x = document.getElementById("login"), y = document.getElementById("register"),
    z = document.getElementById("btn")

function register() {
    if (window.innerWidth <= 600) {
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "75px";
    } else {
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "110px";
    }
}
function login() {
    x.style.left = "50px";
    y.style.left = "450px";
    z.style.left = "0";
}