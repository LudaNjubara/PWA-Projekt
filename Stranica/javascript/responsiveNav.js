/* Prikaz navigacije na manjim ekranima */
let menuToggler = document.querySelector(".menuToggle");
let nav = document.querySelector(".nav-list");
let navLink = document.querySelectorAll(".nav-list li a");

menuToggler.addEventListener("click", function (event) {
  menuToggler.classList.toggle("clicked");
  nav.classList.toggle("opened");
  /* document.body.classList.toggle("overflowHide"); */
});

navLink.forEach((link) => {
  link.addEventListener("click", function (event) {
    if (nav.classList.contains("opened")) {
      nav.classList.remove("opened");
      menuToggler.classList.remove("clicked");
    }
  });
});
