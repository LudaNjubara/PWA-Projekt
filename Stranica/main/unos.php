<?php 
  include_once '../phpProvjere/skriptaUnos.php';
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
    <link rel="icon" type="image/jpg" href="https://img.icons8.com/pastel-glyph/64/4a90e2/note.png"/>
    <script src="https://kit.fontawesome.com/1716a349d5.js" crossorigin="anonymous"></script>
    <title>Unos</title>
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
            <li><a href="administrator.php">administracija</a></li>
            <?php if(@$_SESSION['korisnickoIme']) {
              echo '<li>
              <form action="" method="post">
               <button name="deleteSession" class="btn-log-out">Odjavi se, ' . $_SESSION['korisnickoIme'] . '</button>
              </form>
            </li>';
            }
            if(isset($_POST["deleteSession"])) {
              session_destroy();
              echo "<script type='text/javascript'>
              location = location;
              </script>";
            }?>
          </ul>
          <div class="menuToggle">
            <div class="line"></div>
          </div>
        </nav>
      </section>
    </header>

    <main id="page-wrapper">
      <h2 class="form-title">Unesite formu</h2>
      <form novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" id="form">

        <label for="naslovVijesti" id="naslovLabel">
          <span class="errorInputMsg"></span>
          <input
            type="text"
            placeholder="Unesite naslov vijesti"
            id="naslovVijesti"
            name="naslovVijesti"
            autofocus
            required
            minlength="5"
            maxlength="30"
          />
        </label>

        <label for="sazetakVijesti" id="sazetakLabel">
          <span class="errorInputMsg" aria-live="polite"></span>
          <textarea
            placeholder="Unesite kratki sažetak.."
            id="sazetakVijesti"
            name="sazetakVijesti"
            required
            minlength="10"
            maxlength="100"
          ></textarea>
        </label>

        <label for="sadrzajVijesti" id="sadrzajLabel">
          <span class="errorInputMsg" aria-live="polite"></span>
          <textarea
            placeholder="Unesite sadržaj vijesti.."
            id="sadrzajVijesti"
            name="sadrzajVijesti"
            required
          ></textarea>
        </label>

        <label for="kategorije" id="kategorijeLabel">
          <span class="errorInputMsg" aria-live="polite"></span>
          <select name="kategorije" id="kategorije" required>
            <option value="" selected disabled>Odaberite kategoriju</option>
            <option value="politika">Politika</option>
            <option value="sport">Sport</option>
            <option value="kultura">Kultura</option>
            <option value="zabava">Zabava</option>
            <option value="Znanstvena fantastika">Znanstvena fantastika</option>
          </select>
        </label>

        <label for="odabirSlike" tabindex="0"  id="slikaLabel">
          <span id="odabirSlikeLabel" name="odabirSlikeLabel">Odaberite sliku</span>
          <input type="file" name="odabirSlike" id="odabirSlike" accept="image/jpeg, image/gif" required />
        </label>
        <input type="checkbox" value="true" name="prikazNaStranici" id="prikazNaStranici" checked />
        <button type="reset" value="reset" name="reset" class="btn-reset">Poništi</button>
        <button type="submit" value="submit" name="submit" class="btn-send">Unesi</button>
      </form>
    </main>

    <div class="fileMsgContainer">
      <span id="odabirSlikeError" name="odabirSlikeError" class="spanMsg"><?php echo $odabirSlikeError?></span>
      <span id="odabirSlikeFinalMsg" name="odabirSlikeFinalMsg" class="spanMsg"><?php echo $odabirSlikeFinalMsg?></span>
    </div>

    <div class="pre-footer"></div>

    <footer id="footer">
      <p>Mihael Šestak</p>
      <a href="mailto:msestak@tvz.hr?subject=Upit" class="footer-link">msestak@tvz.hr</a>
      <p>2021</p>
    </footer>

    <script type="text/javascript" src="../javascript/app.js"></script>
    <script type="text/javascript" src="../javascript/responsiveNav.js"></script>
  </body>
</html>