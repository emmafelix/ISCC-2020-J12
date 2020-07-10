<?php

if ($_FILES['userfile']['name']) {

    if (strlen(explode('.', $_FILES['userfile']['name'])[0]) < 5) {
        echo "Le nom du fichier doit faire plus de 4 caractères hors extension. ";
    } else {
        $extention = explode('.', $_FILES['userfile']['name'])[1];
        $extention_possible = array("jpg", "jpeg", "png", "JPG", "JPEG", "PNG");

        if (in_array($extention, $extention_possible)) {
            echo "<p><strong>Nom du fichier:</strong>" . $_FILES['userfile']['name'] . ".</p>";
            echo "<p><strong>Type du fichier:</strong>" . $_FILES['userfile']['type'] . ".</p>";
            echo "<p><strong>Taille du fichier:</strong>" . $_FILES['userfile']['size'] . ".</p>";
            $_SESSION['description'] = $_POST['description'];
            $_SESSION['titre'] = $_POST['titre'];
        } else {
            echo "Le fichier ne correspond pas aux attentes.";
        }
    }
}


function upload_file($upload)
{
    if (isset($_FILES['userfile'])) {
        $name_file = $_FILES['userfile']['name'];
        $tmp_name = $_FILES['userfile']['tmp_name'];
        $local_image = "uploaded/";
        $upload = move_uploaded_file($tmp_name, $local_image . $name_file);
        
        
        if ($upload) {
            echo 'Le fichier <strong>' . $name_file . '</strong> a été téléchargé.';
        } else {
            echo 'Le téléchargement a échoué.';
        }
    }
}

upload_file($upload);


function connect_to_database()
{
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $databasename = "base-site-rooting";

  try {
    $pdo = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Vous êtes connectés <br>";
    return($pdo);
  } catch (PDOException $e) {
    echo "La connexion a échoué" . $e->getMessage();
  }
}

function login_form($pdo)
{
  try {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {


      $login = $_POST['login'];
      $password = $_POST['password'];
     
      $requete=$pdo->query("SELECT loginn
      FROM utilisateurs ");
    $res=$requete->fetchAll();
     

      if ($res) {
    

        if ($login == $res[0]['loginn']) {
          echo "Connexion au compte déjà existant";
          $sql = "UPDATE utilisateurs
          SET passwordd='$password'
          WHERE loginn='$login'";
          $pdo->exec($sql);
          echo 'Mot de passe mis à jour.';
        } else {
            
            $sql = "INSERT INTO
            utilisateurs (loginn,passwordd,imgpath)
            VALUES('$login','$password',' ')";
                    $pdo->exec($sql);
                    echo 'Entrée ajoutée dans la table';
        }
      } else {
        echo "Le nouvel utilisateur n'a pas pu être ajouté.";
      }
    }
  } catch (PDOException $e) {
    echo "Login erreur" . $e->getMessage();
  }
}

$pdo=connect_to_database();
login_form($pdo);
?>
