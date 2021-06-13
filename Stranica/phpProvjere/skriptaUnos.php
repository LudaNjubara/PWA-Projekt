<?php

  function validirajInput ($varijabla) {
      $varijabla = trim($varijabla);
      $varijabla = stripslashes($varijabla);
      $varijabla = htmlspecialchars($varijabla);
      $varijabla = mysqli_real_escape_string(trim($varijabla));

      return $varijabla;
  }

  $odabirSlikeError = "";
  $odabirSlikeFinalMsg = "";

  if(isset($_POST["submit"])) {

    /* Validacija slike */
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["odabirSlike"]["name"]);
    $uploadOk = 1;
    /* $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); */
    $imageFileType = strtolower($_FILES['odabirSlike']['type']);
    $imageFileType = explode('/', $imageFileType);
    $allowedTypes = ["jfif", "jpg", "jpeg", "pjp", "pjpeg", "gif"];

      if(!empty($_FILES["odabirSlike"]["name"])) {
        $check = getimagesize($_FILES["odabirSlike"]["tmp_name"]);
        if($check !== false) {
          $uploadOk = 1;
        } else {
          if($imageFileType[0] == "image" && !in_array($imageFileType[1], $allowedTypes)) {
            $odabirSlikeError = "Krivi format! Samo JPG, JPEG, JFIF, PJP, PJPEG & GIF datoteke su dozvoljene.";
            $uploadOk = 0;
          } 
        }
    } else {
        $odabirSlikeError = "Datoteka nije odabrana.";
        $uploadOk = 0;
    }

  /*   */

    if ($uploadOk == 0) {
      $odabirSlikeFinalMsg = "Nažalost, datoteka nije uploadana.";
    } else {

      if(isset($_POST["naslovVijesti"], $_POST["sazetakVijesti"], $_POST["sadrzajVijesti"], $_POST["kategorije"])) {

        /* Uzimanje vrijednosti iz forme */
          $naslovVijesti = validirajinput($_POST["naslovVijesti"]);
          $sazetakVijesti = validirajinput($_POST["sazetakVijesti"]);
          $sadrzajVijesti = validirajinput($_POST["sadrzajVijesti"]);
          $kategorije = validirajinput($_POST["kategorije"]);

          $datum = new DateTime();
          $stringDatum = $datum->format("d/m/Y H:i:s");

          if(isset($_POST["prikazNaStranici"])) {
            $arhiva = 0;
          } else $arhiva = 1;
      }

      $finalFileName = htmlspecialchars( basename($_FILES["odabirSlike"]["name"]));
      $finalFileDest = htmlspecialchars($target_dir . $_FILES["odabirSlike"]["name"]);
      $odabirSlikeFinalMsg = "Unos izvršen uspješno!";

          /* SQL  */
      include_once 'connect.php';

      move_uploaded_file($_FILES['odabirSlike']['tmp_name'], $finalFileDest);

      if($sqlConnect) {
        $query = "INSERT INTO članci (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES ('$stringDatum', '$naslovVijesti', '$sazetakVijesti', '$sadrzajVijesti', '$finalFileName', '$kategorije', '$arhiva')";

        $result = @mysqli_query($sqlConnect, $query) OR die('Error querying database!');

        mysqli_close($sqlConnect);
      }
      /* Kraj SQL-a */
      }
    }
  ?>