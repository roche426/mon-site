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
use Model\PassionManager;
use Model\UserManager;
use Model\Validator;

/**
 * Class UserController
 *
 */
class UserController extends AbstractController
{
    public function userConnexion()
    {
        session_start();

        if ($_SESSION['email']) {
            return $this->twig->render('Admin/index.html.twig');
        }

        $connexionError = null;
        $errors = array();
        $formValue = array();

        if ($_POST) {

            $validator = new Validator();

            foreach ($_POST as $item=>$value) {

                if (!$validator->blank($value)) {
                    $errors[$item] .= 'Ce champs ne doit pas être vide ';
                }

                elseif ($validator->emailVerify($_POST['email'])) {
                    $errors['email'] = 'Format de l\'email invalide';
                }

                $formValue[$item] .= htmlentities($value);
            }

            if (!count(array_filter($errors))) {
                $userManager = new UserManager();
                $user = $userManager->userConnexion(htmlentities($_POST['email']));

                if ($user && password_verify(htmlentities($_POST['password']), $user->getPassword())) {
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['email'] = $_POST['email'];

                    return $this->twig->render('Admin/welcome.html.twig');
                }

                $connexionError = 'Mot de passe ou email invalide';
            }
        }

        return $this->twig->render('Admin/connexion.html.twig',[
            'errors' => $errors,
            'formValue' => $formValue,
            'connexionError' => $connexionError
        ]);
    }

    public function index()
    {
        session_start();

        if (!$_SESSION['email']) {
            return $this->twig->render('Admin/connexion.html.twig');
        }

        $contactManager = new ContactManager();
        $contacts = $contactManager->selectAll();

        $passionManager = new PassionManager();
        $passions = $passionManager->selectAll();

        return $this->twig->render('Admin/index.html.twig', [
            'contacts' => $contacts,
            'passions' => $passions
            ]);

    }


    public function logout()
    {
        if ($_SESSION['email']) {
            return $this->twig->render('Admin/index.html.twig');
        }

        session_start();
        session_destroy();
        return header('location: /connexion');
    }



}
