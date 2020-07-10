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
?>
