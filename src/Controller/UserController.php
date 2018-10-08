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

/**
 * Class UserController
 *
 */
class UserController extends AbstractController
{
    public function userConnexion()
    {
        session_start();

        $errorMessage = array();

        if ($_SESSION['email']) {
            return $this->twig->render('Admin/index.html.twig');
        }

        if ($_POST) {

            if (!empty($_POST['email'] && !empty($_POST['password']))) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $userManager = new UserManager();
                $user = $userManager->userConnexion($email);

                if ($user) {
                    if (password_verify($password, $user->getPassword())) {
                        $_SESSION['id'] = $user->getId();
                        $_SESSION['email'] = $email;

                        return $this->twig->render('Admin/welcome.html.twig');
                    }
                        $errorMessage = ['inputEmail' => $_POST['email'], 'inputPassword' => $_POST['password']];
                }

                else {
                    $errorMessage = ['inputEmail' => $_POST['email']];
                }
            }

            else {
                $errorMessage = ['inputEmail' => $_POST['email'], 'inputPassword' => $_POST['password']];
            }
        }

        return $this->twig->render('Admin/connexion.html.twig',[
            'errorMessage' => $errorMessage
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

    public function addPassion()
    {
        session_start();

        if (!$_SESSION['email']) {
            return $this->twig->render('Admin/connexion.html.twig');
        }

        if ($_POST) {

            if (!empty($_POST['runningName'] && !empty($_POST['runningTime']) && !empty($_POST['runningType']) && !empty($_POST['dateRunning'])
                && !empty($_POST['rank']) && !empty($_POST['participants']))) {

                $passion = [
                    'runningName' => $_POST['runningName'],
                    'runningTime' => $_POST['runningTime'],
                    'runningType' => $_POST['runningType'],
                    'dateRunning' => $_POST['dateRunning'],
                    'rank' => $_POST['rank'],
                    'participants' => $_POST['participants']
                ];

                $passionManager = new PassionManager();
                $passionManager->addPassion($passion);
            }

            else {
                var_dump($_POST);

                $errorMessage = [
                    'runningName' => $_POST['runningName'],
                    'runningTime' => $_POST['runningTime'],
                    'runningType' => $_POST['runningType'],
                    'dateRunning' => $_POST['dateRunning'],
                    'rank' => $_POST['rank'],
                    'participants' => $_POST['participants']
                ];
            }
        }


        return $this->twig->render('Admin/addPassion.html.twig',
            ['inputValue' => $errorMessage]);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        return header('location: /connexion');
    }



}
