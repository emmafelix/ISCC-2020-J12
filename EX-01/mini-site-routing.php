<html>

<head>
    <title>mini-site-routing</title>
</head>

<body>
    <header>
        <nav>
            <a href="http://localhost:8888/ISSC%20-%202020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=1">Accueil</a>
            <a href="http://localhost:8888/ISSC%20-%202020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=2">Page1</a>
            <a href="http://localhost:8888/ISSC%20-%202020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=3">Page2</a>
            <a href="http://localhost:8888/ISSC%20-%202020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=connexion">Connexion</a>
            <?php
            
            if ($_COOKIE['id']){
                echo '<a href="http://localhost:8888/ISSC%20-%202020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=admin">Admin</a>';
           } 
           ?>
        </nav>
    </header>
    <h1>
        <?php
    

        if ($_GET['page'] == 1) {
            echo "Accueil !";
            include('Accueil.php');
        } elseif ($_GET['page'] == 2) {
            echo "Page 2 !";
            include('Page1.php');
        }
        elseif ($_GET['page'] == 3) {
            echo "Page 3 !";
            include('Page2.php');
        }elseif ($_GET['page'] == 'connexion') {
            echo "Connexion !";
            include('Connexion.php');
        }elseif ($_GET['page'] == 'admin') {
           
        ?>
        <form method="post" action="admin.php" enctype="multipart/form-data">
<input type="texte" name="login" placeholder="Login"/>
<input type="password" name="password" placeholder="Password"/>
<input type="hidden" name="taille_maximale" value="2097152"/>
<input name="userfile" type="file" accept="image/x-png,image/jpg,image/jpeg"/>
<input type="submit" name="bouton" value="Charger le fichier"/>
    </form>
<?php
 include('admin.php');
        }
?>

    </h1>
    <p>
        <?php
        if (isset($_SESSION["id"])) {
            echo 'Login: ' . $_SESSION["id"] . '.';
        }elseif(isset($_COOKIE["id"])) {
        $_SESSION['id']=$_POST['login'];
        $SESSION['mdp']=$_POST['password'];
            } 
            else {
                header('Location:http://localhost:8888/ISSC%20-%202020/ISCC-2020-J12/EX-01/mini-site-routing.php?page=connexion');
            exit();
            }
        
        ?>


    </p>
</body>

</html>