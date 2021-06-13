<?php 
   include_once '../phpProvjere/connect.php';
   define('UPLPATH', '../img/');
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Mihael Šestak" />
    <meta name="description" content="Projekt iz Programiranja Web Aplikacija" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../styles/style.min.css" />
    <link rel="icon" type="image/jpg" href="https://img.icons8.com/ios-filled/50/4a90e2/microsoft-admin.png"/>
    <script src="https://kit.fontawesome.com/1716a349d5.js" crossorigin="anonymous"></script>
    <title>Administracija</title>
  </head>
  <body>
    <header id="header">
      <section class="header-content">
        <a href="index.php"><h1 class="site-title">debate</h1></a>
        <nav id="header-nav">
          <ul class="nav-list">
            <li><a href="index.php">home</a></li>
            <li><a href="sport.php">sport</a></li>
            <li><a href="zabava.php">zabava</a></li>
            <li><a href="unos.php">unos</a></li>
            <li><a href="#!">administracija</a></li>
            <?php if(@$_SESSION['korisnickoIme']) {
              echo '<li>
              <form action="" method="post">
               <button name="deleteSession" class="btn-log-out">Odjavi se, ' . $_SESSION['korisnickoIme'] . '</button>
              </form>
            </li>';
            }?>
          </ul>
          <div class="menuToggle">
            <div class="line"></div>
          </div>
        </nav>
      </section>
    </header>

    <main id="page-wrapper">
      <h2 class="form-title">Administracija vijesti</h2>

      <section class="form-wrapper">
        <form id="login-form" class="form-check" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <h2 class="form-title">Prijavi se</h2>
          <input type="text" name="korisnickoIme" id="korisnickoIme" autofocus placeholder="Upišite korisničko ime" required />
          <input type="password" name="lozinka" id="lozinka" placeholder="Upišite lozinku" required />
          <button type="submit" name="login" id="btn-login" class="btn-form-check">Prijava</button>
          <a href="#!" id="create-acc-link" onclick="prikaziDruguFormu();"
            >Nemate račun? Stvorite ga ovdje.</a
          >
        </form>

        <form id="reg-form" class="form-check" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <h2 class="form-title">Registriraj se</h2>
          <input type="text" name="ime" id="ime"  placeholder="Upišite vlastito ime" required />
          <input type="text" name="prezime" id="prezime"  placeholder="Upišite vlastito prezime" required />
          <input type="text" name="novoKorisnickoIme" id="novoKorisnickoIme"  placeholder="Upišite korisničko ime" required />
          <input type="password" new-password name="novaLozinka" id="novaLozinka"   placeholder="Upišite lozinku" required />
          <input type="password" new-password name="novaLozinkaPonovo" id="novaLozinkaPonovo" placeholder="Ponovo upišite lozinku" required />
          <button type="submit" name="register" id="btn-reg" class="btn-form-check">Registracija</button>
          <a href="#!" id="create-acc-link" onclick="prikaziPrvuFormu();">Natrag na prijavu.</a>
        </form>
      </section>

      <?php 
      /* Registracija korisnika */
        if(isset($_POST["register"])) {
          if(isset($_POST["ime"],  $_POST["prezime"], $_POST["novoKorisnickoIme"], $_POST["novaLozinka"], $_POST["novaLozinkaPonovo"])) {
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $novoKorisnickoIme = $_POST["novoKorisnickoIme"];
            $novaLozinka = $_POST["novaLozinka"];
            $novaLozinkaPonovo = $_POST["novaLozinkaPonovo"];

            $hashNoveLozinke = password_hash($novaLozinka, CRYPT_BLOWFISH);

            $query_ime = "SELECT * FROM korisnik WHERE korisnickoIme = '$novoKorisnickoIme' LIMIT 1";
            $result_ime = mysqli_query($sqlConnect, $query_ime);

            if (mysqli_num_rows($result_ime) == 1) {
              echo "<script type='text/javascript'>
                    alert('Korisnik s tim korisničkim imenom već postoji!');
                </script>";
            } else {
              if($novaLozinka == $novaLozinkaPonovo) {
                $query="INSERT INTO korisnik (ime, prezime, korisnickoIme, lozinka) values (?, ?, ?, ?)";
                $stmt=mysqli_stmt_init($sqlConnect);
  
                if (mysqli_stmt_prepare($stmt, $query)){
                  mysqli_stmt_bind_param($stmt,'ssss', $ime, $prezime, $novoKorisnickoIme, $hashNoveLozinke);
                  mysqli_stmt_execute($stmt);
                  echo "<script type='text/javascript'>
                    alert('Korisnik uspješno registriran!');
                  </script>";
                }
              } else {
                echo "<script type='text/javascript'>
                    alert('Lozinke moraju biti iste!');
                  </script>";
              }
            }
          }
        }


        /* Prijava korisnika */
        if(isset($_POST["login"])) {
          if(isset($_POST["korisnickoIme"], $_POST["lozinka"])) {
            $korisnickoIme = $_POST["korisnickoIme"];
            $lozinka = $_POST["lozinka"];

            $query = "SELECT korisnickoIme, lozinka, razinaDozvole FROM korisnik WHERE korisnickoIme = ? LIMIT 1"; 
            $stmt = mysqli_stmt_init($sqlConnect);
            if (mysqli_stmt_prepare($stmt, $query)) {
              mysqli_stmt_bind_param($stmt, 's', $korisnickoIme); 
              mysqli_stmt_execute($stmt); 
              mysqli_stmt_store_result($stmt);
            }
            mysqli_stmt_bind_result($stmt, $dbKorisnickoIme, $dbLozinka,
            $dbRazinaDozvole);
            mysqli_stmt_fetch($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0) {
              if (password_verify($lozinka, $dbLozinka)){
                if($dbRazinaDozvole) {
                  $_SESSION['korisnickoIme'] = $korisnickoIme;
                  $_SESSION['razinaDozvole'] = $dbRazinaDozvole;
                  echo "<script type='text/javascript'>
                    alert('Uspješno prijavljeni kao $korisnickoIme !');
                    location = location;
                  </script>";
                } else {
                  session_destroy();
                  echo "<script type='text/javascript'>
                    alert('Nemate administratorska prava! Odjavljeni ste.');
                    document.querySelector('.form-wrapper').style.display = 'inherit';
                    location = location;
                  </script>";
                }
              } else {
                echo "<script type='text/javascript'>
                alert('Unijeli ste pogrešno korisničko ime ili lozinku!');
              </script>";
              }
            } else {
              echo "<script type='text/javascript'>
                alert('Unijeli ste pogrešno korisničko ime ili lozinku!');
              </script>";
            }
          }
        }

        $odabirSlikeFinalMsg = "";
        /* Prikaz formi ako je sve u redu */
        if(@$_SESSION['korisnickoIme']) {
          $query2 = "SELECT * FROM članci";
          $result2 = mysqli_query($sqlConnect, $query2);

          echo "<script type='text/javascript'>
            document.querySelector('.form-wrapper').style.display = 'none';
          </script>";
  
          while($row2 = mysqli_fetch_array($result2)) {
            echo '
              <form novalidate action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post" enctype="multipart/form-data" class="adminForm">
  
            <label for="naslovVijesti" class="naslovLabel">
              <span class="errorInputMsg"></span>
              <input
                type="text"
                placeholder="Unesite naslov vijesti"
                class="naslovVijesti"
                name="naslovVijesti"
                required
                minlength="5"
                maxlength="30"
                value="' . $row2["naslov"] . '"
              />
            </label>
  
            <label for="sazetakVijesti" class="sazetakLabel">
              <span class="errorInputMsg" aria-live="polite"></span>
              <textarea
                placeholder="Unesite kratki sažetak.."
                class="sazetakVijesti"
                name="sazetakVijesti"
                required
                minlength="10"
                maxlength="100"
              >' . $row2['sazetak'] . '</textarea>
            </label>
  
            <label for="sadrzajVijesti" class="sadrzajLabel">
              <span class="errorInputMsg" aria-live="polite"></span>
              <textarea
                placeholder="Unesite sadržaj vijesti.."
                class="sadrzajVijesti"
                name="sadrzajVijesti"
                required
              >' . $row2['tekst'] . '</textarea>
            </label>
  
            <label for="kategorije" class="kategorijeLabel">
              <span class="errorInputMsg" aria-live="polite"></span>
              <select name="kategorije" class="kategorije" required>
                <option value="' . $row2['kategorija'] . '" selected>' . $row2['kategorija'] . '</option>
                <option value="politika">Politika</option>
                <option value="sport">Sport</option>
                <option value="kultura">Kultura</option>
                <option value="zabava">Zabava</option>
                <option value="Znanstvena fantastika">Znanstvena fantastika</option>
              </select>
            </label>
  
            <label for="odabirSlike" tabindex="0"  class="slikaLabel">
              <span class="odabirSlikeLabel" name="odabirSlikeLabel">Odaberite sliku </span>
              <input type="file" name="odabirSlike" class="odabirSlike" accept="image/jpeg, image/gif" required />
              <img src="' . UPLPATH . $row2['slika'] . '" width="100px" style="border-radius: 5px;">
            </label>
  
            <input type="checkbox" value="true" name="prikazNaStranici" class="prikazNaStranici"'; if($row2['arhiva'] == 0) echo "checked"; echo '/>
  
            <input type="hidden" name="id" value="' . $row2['id'] . '">
  
            <button type="reset" value="reset" name="reset" class="btn-reset btn-admin">Poništi</button>
  
            <button type="submit" name="delete" value="delete" class="btn-reset">Izbriši</button>
  
            <button type="submit" value="submit" name="submit" class="btn-send">Izmjeni</button>
          </form>';
          }

          if(isset($_POST["deleteSession"])) {
            session_destroy();
            echo "<script type='text/javascript'>
            location = location;
            </script>";
          }
  
          if(isset($_POST['delete'])) {
            $id = $_POST['id'];
            $query3 = "DELETE FROM članci WHERE id = $id ";
            $result3 = mysqli_query($sqlConnect, $query3);

            echo "<script type='text/javascript'>
            setTimeout(function () {
              location.href = 'administrator.php';
            }, 1000);
          </script>";
          $odabirSlikeFinalMsg = "Brisanje uspješno izvršeno!";
          }
  
          if(isset($_POST['submit'])) {
            $file = $_FILES['odabirSlike']['name'];
            $naslovVijesti=$_POST['naslovVijesti']; 
            $sazetakVijesti=$_POST['sazetakVijesti']; 
            $sadrzajVijesti=$_POST['sadrzajVijesti'];
            $kategorije = $_POST['kategorije']; 
  
            $datum = new DateTime();
            $stringDatum = $datum->format("d/m/Y H:i:s");
  
            if(isset($_POST['prikazNaStranici'])){ 
              $arhiva=0; 
            }else{ 
              $arhiva=1; 
            } 
            $target_dir = '../img/'.$file;
            move_uploaded_file($_FILES["odabirSlike"]["tmp_name"], $target_dir);
  
            $id=$_POST['id'];
            $query = "UPDATE članci SET datum = '$stringDatum', naslov='$naslovVijesti', sazetak='$sazetakVijesti', tekst='$sadrzajVijesti', slika='$file', kategorija='$kategorije', arhiva='$arhiva' WHERE id = $id ";
            $result = mysqli_query($sqlConnect, $query);

            echo "<script type='text/javascript'>
            setTimeout(function () {
              location.href = 'administrator.php';
            }, 0);
          </script>";
  
            $odabirSlikeFinalMsg = "Izmjena izvršena uspješno!";
          }
        }
      ?>
    </main>

    <div class="fileMsgContainer">
      <span id="odabirSlikeFinalMsg" name="odabirSlikeFinalMsg" class="spanMsg"
        ><?php echo $odabirSlikeFinalMsg?></span
      >
    </div>

    <div class="pre-footer"></div>

    <footer id="footer">
      <p>Mihael Šestak</p>
      <a href="mailto:msestak@tvz.hr?subject=Upit" class="footer-link">msestak@tvz.hr</a>
      <p>2021</p>
    </footer>

    <script type="text/javascript" src="../javascript/admin.js"></script>
    <script type="text/javascript" src="../javascript/responsiveNav.js"></script>
  </body>
</html>
