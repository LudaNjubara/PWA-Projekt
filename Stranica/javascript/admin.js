/* Span element za prikaz errora */
var errorInputMsg = document.getElementsByClassName("errorInputMsg");

/* Forma */
var forma = document.getElementsByClassName("adminForm");

/* Input polja */
const odabirSlike = document.getElementsByClassName("odabirSlike");

/* Labeli */
const odabirSlikeLabel = document.getElementsByClassName("odabirSlikeLabel");

/* Poruke za neuspješno uploadanje datoteke */
const odabirSlikeFinalMsg = document.getElementById("odabirSlikeFinalMsg");

/* Submit/Reset btn */
const sendBtn = document.getElementsByClassName("btn-send");
const btnReset = document.getElementsByClassName("btn-admin");

/* Animiranje poruke prilikom uspješnog uploadanja datoteke */
if (odabirSlikeFinalMsg.innerHTML) {
  odabirSlikeFinalMsg.style.animationName = "pojavaPoruke";
} else {
  odabirSlikeFinalMsg.style.animationName = "";
}

for (let i = 0; i < forma.length; i++) {
  /* Promjena teksta u label prilikom odabira datoteke */
  odabirSlike[i].addEventListener("change", function (e) {
    odabirSlikeLabel[i].innerHTML = "Odabrana datoteka: " + e.target.value.split(/(\\|\/)/g).pop();
  });

  btnReset[i].addEventListener("click", function (event) {
    odabirSlikeLabel[i].innerHTML = "Odaberite sliku";
    odabirSlikeLabel[i].style.color = "inherit";
  });

  /* ------------------ Validacija forme -------------------*/
  sendBtn[i].addEventListener("click", function (event) {
    var dontSend = 0;
    if (odabirSlike[i].files.length == 0) {
      odabirSlikeLabel[i].style.color = "#f41e18";
      dontSend = 1;
    }

    if (dontSend === 1) {
      event.preventDefault();
    }
  });
}

/* Promjena pozadinske boje finalne poruke ako je uspješan upload */
var str_pos = odabirSlikeFinalMsg.innerHTML.indexOf("uspješno");
if (str_pos > -1) {
  odabirSlikeFinalMsg.style.backgroundColor = "#1BF52C";
}

/* Micanje između login i registracijske forme */

/* Forme */
const loginForma = document.getElementById("login-form");
const regForma = document.getElementById("reg-form");
const formCheckWrapper = document.querySelector(".form-wrapper");

function prikaziDruguFormu() {
  loginForma.style.transform = "translateX(-110%)";
  regForma.style.right = "0%";
  regForma.style.pointerEvents = "all";
  formCheckWrapper.style.height = `${regForma.clientHeight}px`;
}

function prikaziPrvuFormu() {
  loginForma.style.transform = "translateX(0)";
  regForma.style.right = "-110%";
  regForma.style.pointerEvents = "none";
  formCheckWrapper.style.height = `${loginForma.clientHeight + 40}px`;
}

/* Validacija login/registracijske forme */
const korisnickoIme = document.querySelector("#korisnickoIme");
const lozinka = document.querySelector("#lozinka");
const novoKorisnickoIme = document.querySelector("#novoKorisnickoIme");
const novaLozinka = document.querySelector("#novaLozinka");

/* Prijava/registracija btn */
const btnLogin = document.querySelector("#btn-login");
const btnReg = document.querySelector("#btn-reg");
let send = true;

btnLogin.addEventListener("click", (event) => {
  korisnickoIme.addEventListener("input", function () {
    if (korisnickoIme.value.length == 0) {
      send = false;
    }
  });

  lozinka.addEventListener("input", function () {
    if (lozinka.value.length == 0) {
      send = false;
    }
  });

  if (send == false) {
    event.preventDefault();
  }
});

btnReg.addEventListener("click", (event) => {
  novoKorisnickoIme.addEventListener("input", function () {
    if (novoKorisnickoIme.value.length == 0) {
      send = false;
    }
  });

  novaLozinka.addEventListener("input", function () {
    if (novaLozinka.value.length == 0) {
      send = false;
    }
  });

  if (send == false) {
    event.preventDefault();
  }
});
