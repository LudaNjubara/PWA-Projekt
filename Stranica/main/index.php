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
    <link rel="icon" type="image/jpg" href="https://img.icons8.com/ultraviolet/40/000000/home--v2.png"/>
    <script src="https://kit.fontawesome.com/1716a349d5.js" crossorigin="anonymous"></script>
    <title>Home</title>
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
      <section class="sport-wrapper news">
        <h2 class="news-title">Sport</h2>
        <div class="news-articles">

          <?php 
          
            if($sqlConnect) {
              $query = "SELECT * FROM članci WHERE kategorija = 'sport' AND arhiva = 0 LIMIT 8";
              $result = @mysqli_query($sqlConnect, $query);

              while ($row = mysqli_fetch_array($result)) {
                echo "
                
                  <article class='article'>
                    <a href='clanak.php?id=" . $row['id'] . "'>
                      <div class='img-container'>
                        <img
                          src='" . UPLPATH . $row['slika'] . "'
                          alt='news article'
                        />
                      </div>
                      <h3 class='article-title'>" . $row['naslov'] . "</h3>
                      <p class='article-time'>" . $row['datum'] . "</p>
                    </a>
                  </article>
                
                ";
              }
            }
          ?>

        </div>
      </section>

      <hr class="line" />

      <section class="zabava-wrapper news">
        <h2 class="news-title">Zabava</h2>
        <div class="news-articles">

          <?php 
            
            if($sqlConnect) {
              $query = "SELECT * FROM članci WHERE kategorija = 'zabava' AND arhiva = 0 LIMIT 8";
              $result = @mysqli_query($sqlConnect, $query);

              while ($row = mysqli_fetch_array($result)) {
                echo "
                
                  <article class='article'>
                    <a href='clanak.php?id=" . $row['id'] . "'>
                      <div class='img-container'>
                        <img
                          src='" . UPLPATH . $row['slika'] . "'
                          alt='news article'
                        />
                      </div>
                      <h3 class='article-title'>" . $row['naslov'] . "</h3>
                      <p class='article-time'>" . $row['datum'] . "</p>
                    </a>
                  </article>
                
                ";
              }
            }
          ?>

        </div>
      </section>

      <hr class="line" />

      <section class="politika-wrapper news">
        <h2 class="news-title">Politika</h2>
        <div class="news-articles">

          <?php 
            
            if($sqlConnect) {
              $query = "SELECT * FROM članci WHERE kategorija = 'politika' AND arhiva = 0 LIMIT 8";
              $result = @mysqli_query($sqlConnect, $query);

              while ($row = mysqli_fetch_array($result)) {
                echo "
                
                  <article class='article'>
                    <a href='clanak.php?id=" . $row['id'] . "'>
                      <div class='img-container'>
                        <img
                          src='" . UPLPATH . $row['slika'] . "'
                          alt='news article'
                        />
                      </div>
                      <h3 class='article-title'>" . $row['naslov'] . "</h3>
                      <p class='article-time'>" . $row['datum'] . "</p>
                    </a>
                  </article>
                
                ";
              }

              mysqli_close($sqlConnect);
            }
          ?>

        </div>
      </section>

      <hr class="line" />
    </main>

    <div class="pre-footer"></div>

    <footer id="footer">
      <p>Mihael Šestak</p>
      <a href="mailto:msestak@tvz.hr?subject=Upit" class="footer-link">msestak@tvz.hr</a>
      <p>2021</p>
    </footer>

    <script type="text/javascript" src="../javascript/responsiveNav.js"></script>
  </body>
</html>