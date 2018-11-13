<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\PassionManager;
use Model\Validator;

/**
 * Class PassionController
 *
 */
class PassionController extends AbstractController
{

    public function index()
    {
        $passionManager = new PassionManager();
        $passions = $passionManager->selectAllByDate();

        $page = 'passion';
        return $this->twig->render('Passion/passion.html.twig', [
            'page' => $page,
            'passions' => $passions,
        ]);
    }

    public function addPassion()
    {
        session_start();

        if ($_SESSION['email']) {

            $errors = array();
            $formValue = array();
            $message = '';

            $validator = new Validator();

            if ($_POST) {

                foreach ($_POST as $item => $value) {

                    if (!$validator->blank($value)) {
                        $errors[$item] .= 'Ce champs ne doit pas être vide ';
                    }

                    if (!$validator->minNumber($value) && is_numeric($value)) {
                        $errors[$item] .= 'La valeur minimal doit être égale à 1';
                    }

                    $formValue[$item] .= htmlspecialchars($value);
                }

                if (!count(array_filter($errors))) {

                    $passionManager = new PassionManager();
                    $passionManager->addPassion($formValue);

                    $message = 'Votre course à été ajoutée';
                    $formValue = null;
                }
            }

            return $this->twig->render('Admin/addPassion.html.twig', [
                'errors' => $errors,
                'formValue' => $formValue,
                'message' => $message
            ]);
        }

        header('location: /admin');
    }


    public function editPassion($id)
    {
        session_start();

        if ($_SESSION['email']) {

            $passionManager = new PassionManager();

            $errors = array();
            $formValue = array();
            $message = '';

            $validator = new Validator();

            if ($_POST) {

                foreach ($_POST as $item => $value) {

                    if (!$validator->blank($value)) {
                        $errors[$item] .= 'Ce champs ne doit pas être vide ';
                    }

                    if (!$validator->minNumber($value) && is_numeric($value)) {
                        $errors[$item] .= 'La valeur minimal doit être égale à 1';
                    }

                    $formValue[$item] .= htmlspecialchars($value);
                }

                if (!count(array_filter($errors))) {

                    $passionManager = new PassionManager();
                    $passionManager->editPassion($formValue, $id);

                    $message = 'Votre course à été modifiée';
                }
            }

            $passion = $passionManager->selectOneById($id);

            return $this->twig->render('Admin/editPassion.html.twig', [
                'passion' => $passion,
                'errors' => $errors,
                'message' => $message
            ]);
        }

        header('location: /admin');
    }


    public function deletePassion($id)
    {
        session_start();

        if ($_SESSION['email']) {

            $contactManager = new PassionManager();
            $contactManager->deletePassion($id);
        }

        header('location: /admin');
    }
}
