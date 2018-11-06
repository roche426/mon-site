<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\ContactManager;
use Model\Validator;

/**
 * Class ContactController
 *
 */
class ContactController extends AbstractController
{

    public function index()
    {
        if ($_POST) {

            //Captcha
           /* $secret = GOOGLE_KEY;
            $response = $_POST['g-recaptcha-response'];
            $remoteip = $_SERVER['REMOTE_ADDR'];

            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $secret
                . "&response=" . $response
                . "&remoteip=" . $remoteip ;

            $decode = json_decode(file_get_contents($api_url), true);
            && $decode['success'] == true*/

            $errors = array();
            $formValue = array();

            $validator = new Validator();

            foreach ($_POST as $item=>$value) {

                if (!$validator->blank($value)) {
                    $errors[$item] .= 'Ce champs ne doit pas être vide ';
                }
                elseif ($validator->emailVerify($_POST['mail'])) {
                    $errors['email'] = 'Format de l\'email invalide';
                }

                $formValue[$item] .= htmlentities($value);
            }

            if (!count(array_filter(array_diff_key($errors, ['phoneNumber' => null])))) {

                $formValue['date'] .= date('Y/m/d');
                $contactManager = new ContactManager();
                $contactManager->addMessage($formValue);

                mail('aurelien.roche1@laposte.net',
                    'Mon-site : Message de ' . $formValue['firstName'] . ' ' . $formValue['lastName'] . ' ' . $formValue['email'] . ' '
                    . $formValue['numberPhone'], $formValue['messageContact']
                );

                $message = 'Votre message a bien été envoyé, je vous répondrai dans les plus brefs délais';
            }

            else {
                $errors['recaptcha'] = 'Merci de cocher "Je ne suis pas un robot"';
            }
        }

        $page = 'contact';
        return $this->twig->render('Contact/contact.html.twig', [
            'page' => $page,
            'message' => $message,
            'formValue' => $formValue,
            'errors' => $errors,
        ]);
    }

    public function deleteContact($id)
    {
        if ($_SESSION['email']) {

            $contactManager = new ContactManager();
            $contactManager->deleteContact($id);
        }

        header('location: /admin');
    }

}
