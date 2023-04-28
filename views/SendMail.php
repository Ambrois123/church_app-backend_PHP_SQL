<?php 

        header("Access-Control-Allow-Origin: *");//laissser l'étoile signifie que tout le monde peut accéder à l'API
        header("Access-Control-Allow-Headers: Content-Type");
        header("Content-Type: Application/json");

        $rest_json = file_get_contents("php://input");
        $_POST = json_decode($rest_json, true);

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            if (empty($_POST['email'])){
                $errors[] = "Veuillez saisir votre email.";
            }else{
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Veuillez saisir un email valide.";
                }
             }

            if (empty($_POST['username'])){
                $errors[] = "Veuillez saisir votre nom.";
            }

            if (empty($_POST['message'])){
                $errors[] = "Veuillez saisir votre message.";
            }
        
            if (empty($errors)){
                $date = date("Y-m-d H:i:s");
                $emailBody = "
                <html>
                    <head>
                        <title>Message de ".$_POST['username']."</title>
                    </head>
                    <body>
                        <p>".$_POST['message']."</p>
                        <p>Envoyé le ".$date."</p>
                    </body>
                </html>
                ";
                $headers = 'From: Contact Form <admin@aegtoulouse.fr>' ."\r\n".
                'Reply-To: '.$_POST['email']."\r\n".
                'MIME-Version: 1.0'."\r\n".
                'Content-Type: text/html; charset=utf-8'."\r\n".
                $to = "adanledjiambroise@gmail.com";
                $subject = "Merci de nous avoir vous contacté";
                if(mail($to, $subject, $emailBody, $headers)){
                    $sent = true;
                }
            
            }
        }

?>

        <?php if (!empty($errors)): ?>
        {
            "status": "fail",
            "error": <?php echo json_encode($errors); ?>
        }
        <?php endif; ?>
        <?php if (isset($sent) && $sent === true): ?>
        {
            "status": "success",
            "message": "Votre message a bien été envoyé."
        }
        <?php endif; ?>
            
        