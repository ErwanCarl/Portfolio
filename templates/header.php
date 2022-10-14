<header>

    <?php 
        if(isset($_SESSION['userInformations'])) {
    ;?>
        <div class="user_info">
            <div class="username">
                <?php echo htmlspecialchars('Bienvenue, '.$_SESSION['userInformations']['username'].'.'); ?>
            </div>  
        </div>
    <?php 
    } 
    ?>

    <div class="banner">

        <div class="nav1">
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?action=blogposts">Blog posts</a></li>
                    <li><a href="index.php?action=passions">Passions</a></li>
                    <li><a href="index.php?action=contact">Contact</a></li>
                </ul>
            </nav>
        </div>

        <?php 
            if(!isset($_SESSION['Connection'])) {
        ?>
            <div class="nav2">
                <nav>
                    <ul>
                        <li><a href="index.php?action=accountcreation">Connexion</a></li>
                    </ul>
                </nav>
            </div>
        <?php 
            } else {
        ?>
                
            <div class="nav2">
                <nav>
                    <ul>
                        <li><a href="index.php?action=closesession">Déconnexion</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

</header>