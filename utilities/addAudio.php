<?php 

function addAudio($file, $dir){
    if(!isset($file['name']) || empty($file['name']))
        throw new Exception("Vous devez sélectionner un fichier son");

    if(!file_exists($dir)) mkdir($dir,0777);

    $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
    $random = rand(0,99999);
    $target_file = $dir.$random."_".$file['name'];
    
    if($extension !== "mpeg3" && $extension !== "mp4" && $extension !== "wav" && $extension !== "mp3")
        throw new Exception("L'extension du fichier n'est pas reconnu");
    if(file_exists($target_file))
        throw new Exception("Le fichier existe déjà");
    if(!move_uploaded_file($file['tmp_name'], $target_file))
        throw new Exception("l'ajout du fichier son n'a pas fonctionné");
    else return ($random."_".$file['name']);
}