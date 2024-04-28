<?php
    $prenom = $_SESSION['user']['first_name'];
?>
<nav>
    <h4><?php echo ' '.$prenom.'<br>(Connecté)' ?></h4>
    <ul>
        <li><a href ="entreprise_dashboard.php" class="active">Accueil</a></li>
        <li><a href ="">Projets</a></li>
        <li><a href ="logout.php">Déconnexion</a></li>
    </ul>
</nav>