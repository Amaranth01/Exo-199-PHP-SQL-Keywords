<?php


try {
    $server = 'localhost';
    $db = 'exo_199';
    $user = 'root';
    $pswd = '';

    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stm = $bdd->prepare("SELECT DISTINCT pays FROM users");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user)
        echo "Utilisateur" . $user['pays'] . "<br>";
    }

    $stm = $bdd->prepare("SELECT * FROM users ORDER BY nom ASC");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user)
            echo "Utilisateur par ordre alphabétique nom " . $user['nom'] . $user['prenom']. "<br>";
    }

    $stm = $bdd->prepare("SELECT * FROM users ORDER BY nom DESC");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user)
            echo "Utilisateur par ordre décroissant nom " . $user['nom'] . $user['prenom']. "<br>";
    }

    $stm = $bdd->prepare("SELECT MIN(argent) as argentMin FROM users");
    if($stm->execute()){
        $min = $stm->fetch();
            echo print_r($min);
    }

    $stm = $bdd->prepare("SELECT MAX(argent) as argentMax FROM users");
    if($stm->execute()){
        $max = $stm->fetch();
        echo print_r($max) . "<br>";
    }

    $stm = $bdd->prepare("SELECT count(*) as number FROM users WHERE argent < 50000");
    if($stm->execute()){
        $count = $stm->fetch();
        echo "il y a " . $count['number'] . "personnes qui ont moins de 50 000" . "<br>";
    }

    $stm = $bdd->prepare("SELECT AVG(argent) as moyenne FROM users");
    if($stm->execute()){
        $avg = $stm->fetch();
        echo "La moyenne de richesse est de " . $avg['moyenne'] . "<br>";
    }

    $stm = $bdd->prepare("SELECT SUM(argent) as somme FROM users");
    if($stm->execute()){
        $sum = $stm->fetch();
        echo "La somme des richesses est de " . $sum['somme'] . "<br>";
    }

    $stm = $bdd->prepare("SELECT * FROM users WHERE prenom LIKE'j%'");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user) {
            echo "Prenom des utilisateur qui commence par un j : " . $user['prenom'] . "<br>";
        }
    }

    $stm = $bdd->prepare("SELECT * FROM users WHERE prenom LIKE'%s'");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user) {
            echo "Prenom des utilisateur qui termine par un s : " . $user['prenom'] . "<br>";
        }
    }

    $stm = $bdd->prepare("SELECT * FROM users WHERE prenom LIKE'%a%'");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user) {
            echo "Utilisateur dont le prenom contient lettre a : " . $user['prenom'] . "<br>";
        }
    }
}
catch (PDOException $e) {
    echo $e->getMessage();
}