<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

/**
 * Class ContactController
 *
 */
class ContactController extends AbstractController
{

    public function index()
    {
        // Ma clé privée
        $secret = "6Lf6sHMUAAAAALV4k6RZcWaogxkIGCoVjqvRLbKf";
        // Paramètre renvoyé par le recaptcha
        $response = $_POST['g-recaptcha-response'];
        // On récupère l'IP de l'utilisateur
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
            . $secret
            . "&response=" . $response
            . "&remoteip=" . $remoteip ;

        $decode = json_decode(file_get_contents($api_url), true);

        if ($_POST) {

                if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['mail']) && !empty($_POST['message'])
                && $decode['success'] == true) {

                    $firstName = htmlentities($_POST['firstName']);
                    $lastName = htmlentities($_POST['lastName']);
                    $email = htmlentities($_POST['mail']);
                    $message = htmlentities($_POST['message']);
                    $numberPhone = htmlentities($_POST['phoneNumber']);

                    mail('aurelien.roche1@laposte.net', "$firstName $lastName $numberPhone", $message );

                    $message = 'Votre message a bien été envoyé, je vous répondrai dans les plus brefs délais';
                }
                else {
                    $inputValue = [
                        'firstName' => $_POST['firstName'],
                        'lastName' => $_POST['lastName'],
                        'mail' => $_POST['mail'],
                        'message' => $_POST['message'],
                        'phoneNumber' => $_POST['phoneNumber'],
                        'recaptcha' => $decode['success']
                    ];
                }

        }

        $page = 'contact';
        return $this->twig->render('Contact/contact.html.twig', [
            'page' => $page,
            'message' => $message,
            'inputValue' => $inputValue
        ]);
    }

}
