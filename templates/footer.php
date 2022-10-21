<footer>
    <div class="footer">

        <?php 
            if(!isset($_SESSION['Connection'])) {
        ;?>
                <div class="sub_footer">
                    <div class="foot_img">
                        <img src="images/logo_connexion.png" />
                    </div>
                    <div>
                        <a href="index.php?action=accountcreation">Se connecter</a>
                    </div>
                </div>
        <?php 
            } else {
        ?>
                <div class="sub_footer">
                    <div class="foot_img">
                        <img src="images/logo_connexion.png" />
                    </div>
                    <div>
                        <a href="index.php?action=closesession">Se déconnecter</a>
                    </div>
                </div>
        <?php
            }
        ?>

        <div class="sub_footer">
            <div class="foot_img">   
                <img src="images/roue_crantee.png" />
            </div>
            <div>
                <a href="index.php?action=admin">Administration</a>
            </div>
        </div>

        <div class="sub_footer">
            <div class="foot_img">
                <img src="images/law_logo.png" />
            </div>
            <div>
                <a href="index.php?action=legalnotice">Mentions légales</a>
            </div>
        </div>

        <div class="social_bloc">
            <div class="footer_socialmedia">
                <a href="https://github.com/ErwanCarl"><img alt="Logo GitHub" src="images/Githublogo_footer.png"/></a>          
            </div>

            <div class="footer_socialmedia">
                <a href="https://www.linkedin.com/in/erwan-carlini-711a1a134/"><img alt="Logo LinkedIn" src="images/linkedinlogo_footer.png" /></a>          
            </div>
        </div>
    </div>	

    <div class="copyright">
        <p>
            Copyright 2022 - Site réalisé par <em>Erwan Carlini</em> - Développeur d'application PhP / Symfony<br>
        </p>
    </div>
    
</footer>