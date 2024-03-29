<?php

    require 'functions.php';

    if(!empty($_FILES['file'])){
        $name = $_FILES['file']['name'];
        $type = $_FILES['file']['type'];
        $size = $_FILES['file']['size'];
        $tmpName = $_FILES['file']['tmp_name'];
        $error = $_FILES['file']['error'];

    $extensionsAllowed = ['png', 'jpg', 'jpeg'];

    $typeImage = ['image/png', 'image/jpg', 'image/jpeg'];

    $explodedFile = explode('.', $name);
    $extension = strtolower($explodedFile[1]);
    $maxSize = 900000;


    $imgId = uniqid();

    $tempFile = 'temp'.$imgId.'.'.$extension;
    move_uploaded_file($tmpName, './tmpUpload/'.$tempFile); // On déplace le fichier dans le dossier tmpUpload

    $logo = imagecreatefrompng('sources/img/logo.png'); // import du logo

    $sizeLogo = filesize('sources/img/logo.png'); // on récupère la taille du logo

    if(in_array($type, $typeImage)){ // on vérifie que le type est bon
        if(count($explodedFile) <=2 && in_array($extension, $extensionsAllowed)){ // on vérifie que l'extension est bonne
            if($size + $sizeLogo <= $maxSize){ // on vérifie que la taille mémoire n'est pas dépassée

                // Traitement ajoute du filigrane


                if($extension == 'jpeg' || $extension == 'jpg'){ // on créé une image jpg ou jpeg ou png selon l'extension
                    $image = imagecreatefromjpeg('./tmpUpload/'.$tempFile);
                }
                else if($extension == 'png'){ // seul le format png peut passer dans le else
                    $image = imagecreatefrompng('./tmpUpload/'.$tempFile);
                }

                $marge_right = 10;
                $marge_bottom = 10;

                $imageWidth = imagesx($image);
                $imageHeight = imagesy($image);

                $logoScale = imagescale($logo, $imageWidth/2, $imageHeight/2, IMG_BILINEAR_FIXED);

                $logoWidth = imagesx($logo);
                $logoHeight = imagesy($logo);

                $centerX=round(($imageWidth/2) - $logoWidth/2);
                $centerY=round(($imageHeight/2) - $logoHeight/2);

                // header('Content-type: image/jpeg');
                
                // imagedestroy($image);

                if(imagecopy($image, $logo, $centerX, $centerY, 0, 0, $logoWidth, $logoHeight)){ //On garde une trace des fichiers temporaires dans un dossier pour de la journalisation ou en cas d'injection de code malveillant à travers un fichier qui pourrait passer

                    imagepng($image, './uploadFiles/fili'.$imgId.'.'.strtolower($extension));
                    unlink('./tmpUpload/'.$tempFile);
                    setMessage('UploadImage', ['Le fichier a bien été uploadé'], 'success');
                }
                else{
                    unlink('./tmpUpload/'.$tempFile);
                    setMessage('UploadImage', ['Le fichier n\'a pas pu être uploadé'], 'warning');
                }
                header('Location: forum.php');
                die();
            }
            else
                setMessage('UploadImage', ['Fichier trop lourd'], 'warning');
                header('Location: forum.php');
                die();
        }
        else
            setMessage('UploadImage', ['Extension Incorrecte'], 'warning');
            header('Location: forum.php');
            die();
    }
    else
        setMessage('UploadImage', ['Type non autorisé'], 'warning');
        header('Location: forum.php');
        die();
    }
    else{
        setMessage('UploadImage', ['Impossible'], 'warning');
        header('Location: forum.php');
        die();
    }

    



// // Création des instances d'image
// $src = imagecreatefromjpeg('./tmpUpload/'.$tempFile);
// $dest = imagecreatetruecolor(80, 40);

// // Copie
// imagecopy($dest, $src, 0, 0, 20, 13, 80, 40);

// // Affichage et libération de la mémoire
// header('Content-Type: image/jpeg');
// imagegif($dest);

// imagedestroy($dest);
// imagedestroy($src);


?>
