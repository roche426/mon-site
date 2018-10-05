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
        $page = 'contact';
        return $this->twig->render('Contact/contact.html.twig', ['page' => $page]);
    }

    public function contactUs()
    {

        if ($_POST) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['mail'];
            $numberPhone = $_POST['phoneNumber'];
            $message = $_POST['message'];

            mail('aurelien.roche1@laposte.net', "$firstName $lastName $numberPhone", $message );
        }

        header('location: /');
    }
}
