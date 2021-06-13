/* Span element za prikaz errora */
var errorInputMsg = document.getElementsByClassName("errorInputMsg");

/* Forma */
var forma = document.getElementsByClassName("adminForm");

/* Input polja */
const naslovVijesti = document.getElementById("naslovVijesti");
const sazetakVijesti = document.getElementById("sazetakVijesti");
const sadrzajVijesti = document.getElementById("sadrzajVijesti");
const kategorije = document.getElementById("kategorije");
const odabirSlike = document.getElementById("odabirSlike");

/* Labeli */
const odabirSlikeLabel = document.getElementById("odabirSlikeLabel");

/* Poruke za neuspješno uploadanje datoteke */
const odabirSlikeError = document.getElementById("odabirSlikeError");
const odabirSlikeFinalMsg = document.getElementById("odabirSlikeFinalMsg");

/* Submit/Reset btn */
const sendBtn = document.getElementsByClassName("btn-send");
const btnReset = document.getElementsByClassName("btn-reset");

/* Animiranje poruka prilikom neuspješnog uploadanja datoteke */
if (odabirSlikeError.innerHTML) {
  odabirSlikeError.style.animationName = "pojavaPoruke";
  odabirSlikeError.style.pointerEvents = "all";
} else {
  odabirSlikeError.style.animationName = "";
}

if (odabirSlikeFinalMsg.innerHTML) {
  odabirSlikeFinalMsg.style.animationName = "pojavaPoruke";
} else {
  odabirSlikeFinalMsg.style.animationName = "";
}

/* Promjena teksta u label prilikom odabira datoteke */
odabirSlike.addEventListener("change", function (e) {
  odabirSlikeLabel.innerHTML = "Odabrana datoteka: " + e.target.value.split(/(\\|\/)/g).pop();
});

btnReset[0].addEventListener("click", () => {
  odabirSlikeLabel.innerHTML = "Odaberite sliku";
});

/* Promjena pozadinske boje finalne poruke ako je uspješan upload */
var str_pos = odabirSlikeFinalMsg.innerHTML.indexOf("uspješno");
if (str_pos > -1) {
  odabirSlikeFinalMsg.style.backgroundColor = "#1BF52C";
}

/* ------------------ Validacija forme -------------------*/

naslovVijesti.addEventListener("input", function (event) {
  if (naslovVijesti.validity.valid) {
    errorInputMsg[0].textContent = "";
    errorInputMsg[0].className = "errorInputMsg";
  } else {
    errorMsg(naslovVijesti);
  }
});

sazetakVijesti.addEventListener("input", function (event) {
  if (sazetakVijesti.validity.valid) {
    errorInputMsg[1].textContent = "";
    errorInputMsg[1].className = "errorInputMsg";
  } else {
    errorMsg(sazetakVijesti);
  }
});

sadrzajVijesti.addEventListener("input", function (event) {
  if (sadrzajVijesti.validity.valid) {
    errorInputMsg[2].textContent = "";
    errorInputMsg[2].className = "errorInputMsg";
  } else {
    errorMsg(sadrzajVijesti);
  }
});

kategorije.addEventListener("change", function (event) {
  if (!kategorije.validity.selected) {
    errorInputMsg[3].textContent = "";
    errorInputMsg[3].className = "errorInputMsg";
  } else {
    errorMsg(kategorije);
  }
});

odabirSlike.addEventListener("change", function (event) {
  if (odabirSlike.files.length != 0) {
    odabirSlikeLabel.style.color = "#031a32";
  } else {
    errorMsg(odabirSlike);
  }
});

form.addEventListener("reset", function (event) {
  for (var i = 0; i < errorInputMsg.length; i++) {
    errorInputMsg[i].textContent = "";
    errorInputMsg[i].classList.remove("active");
  }
  odabirSlikeLabel.style.color = "#031a32";
});

form.addEventListener("submit", function (event) {
  var dontSend = 0;
  if (!naslovVijesti.validity.valid) {
    errorMsg(naslovVijesti);
    dontSend = 1;
  }
  if (!sazetakVijesti.validity.valid) {
    errorMsg(sazetakVijesti);
    dontSend = 1;
  }
  if (!sadrzajVijesti.validity.valid) {
    errorMsg(sadrzajVijesti);
    dontSend = 1;
  }
  if (!kategorije.validity.valid) {
    errorMsg(kategorije);
    dontSend = 1;
  }
  if (odabirSlike.files.length == 0) {
    errorMsg(odabirSlike);
    dontSend = 1;
  }

  if (dontSend === 1) {
    event.preventDefault();
  }
});

function errorMsg(object) {
  if (object.parentNode.id) {
    var parent_id = object.parentNode.id;
  }
  if (parent_id == "naslovLabel") {
    if (object.validity.valueMissing) {
      errorInputMsg[0].textContent = "Morate upisati naslov";
    } else if (object.validity.tooShort) {
      errorInputMsg[0].textContent = `Naslov prekratak. Min: ${object.minLength}, Max: ${object.maxLength}; unijeli ste ${object.value.length}.`;
    } else if (object.validity.tooLong) {
      errorInputMsg[0].textContent = `Naslov predug. Najviše dopušteno ${object.maxLength} znakova; unijeli ste ${object.value.length}.`;
    }

    errorInputMsg[0].className = "errorInputMsg active";
  }

  if (parent_id == "sazetakLabel") {
    if (object.validity.valueMissing) {
      errorInputMsg[1].textContent = "Morate upisati sažetak";
    } else if (object.validity.tooShort) {
      errorInputMsg[1].textContent = `Sažetak prekratak. Min: ${object.minLength}, Max: ${object.maxLength}; unijeli ste ${object.value.length}.`;
    } else if (object.validity.tooLong) {
      errorInputMsg[1].textContent = `Sažetak predug. Najviše dopušteno ${object.maxLength} znakova; unijeli ste ${object.value.length}.`;
    }

    errorInputMsg[1].className = "errorInputMsg active";
  }

  if (parent_id == "sadrzajLabel") {
    if (object.validity.valueMissing) {
      errorInputMsg[2].textContent = "Morate upisati sadržaj";
    }

    errorInputMsg[2].className = "errorInputMsg active";
  }

  if (parent_id == "kategorijeLabel") {
    if (object.validity.valueMissing) {
      errorInputMsg[3].textContent = "Morate odabrati kategoriju";
    }

    errorInputMsg[3].className = "errorInputMsg active";
  }

  if (parent_id == "slikaLabel") {
    if (object.files.length == 0) {
      odabirSlikeLabel.style.color = "#f41e18";
    }
  }
}
