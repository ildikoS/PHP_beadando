<?php function bejelentkezes(){ ?>
    <header>
        <div class="container">
        <h1><a href="index.php"><span class="highlight">NemKoViD</span> - Nemzeti Koronavírus Depó</a></h1>
            <nav>
                <ul>
                    <li><a href="login.php">Bejelentkezés</a></li>
                    <li><a href="registration.php">Regisztráció</a></li>
                </ul>
            </nav>
        </div>
    </header>
<?php } ?>

<?php function kijelentkezes(){ ?>
    <header>
        <div class="container">
        <h1><a href="index.php"><span class="highlight">NemKoViD</span> - Nemzeti Koronavírus Depó</a></h1>
            <nav>
                <ul>
                    <li>Üdv, <?=$_SESSION['user']?></li>
                    <li><a href="logout.php">Kijelentkezés</a></li>
                </ul>
            </nav>
        </div>
    </header>
<?php } ?>

<?php function adminFunctions(){ ?>
    <header>
        <div class="container">
        <h1><a href="index.php"><span class="highlight">NemKoViD</span> - Nemzeti Koronavírus Depó</a></h1>
            <nav>
                <ul>
                    <li>Üdv, <?=$_SESSION['user']?></li>
                    <li><a href="newappointment.php">Új időpont meghirdetése</a></li>
                    <li><a href="logout.php">Kijelentkezés</a></li>
                </ul>
            </nav>
        </div>
    </header>
<?php } ?>


<?php function footer(){ ?>
    <br>
    <footer>
        <span>NemKoViD, Copyright &copy; 2020</span>
    </footer>
<?php } ?>


