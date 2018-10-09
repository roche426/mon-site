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

/**
 * Class PassionController
 *
 */
class PassionController extends AbstractController
{

    public function index()
    {
        $passionManager = new PassionManager();
        $passions = $passionManager->selectAll();

        $page = 'passion';
        return $this->twig->render('Passion/passion.html.twig', [
            'page' => $page,
            'passions' => $passions,
        ]);
    }

    public function addPassion()
    {
        session_start();

        if (!$_SESSION['email']) {
            return $this->twig->render('Admin/connexion.html.twig');
        }

        if ($_POST) {

            if (!empty($_POST['runningName'] && !empty($_POST['runningTime']) && !empty($_POST['dateRunning']) && !empty($_POST['distance'])
                && !empty($_POST['rank']) && !empty($_POST['participants']))) {

                $passion = [
                    'runningName' => $_POST['runningName'],
                    'runningTime' => $_POST['runningTime'],
                    'dateRunning' => $_POST['dateRunning'],
                    'distance' => $_POST['distance'],
                    'rank' => $_POST['rank'],
                    'participants' => $_POST['participants']
                ];

                $passionManager = new PassionManager();
                $passionManager->addPassion($passion);

                $message = 'Votre course à été ajoutée';
            }

            else {

                $errorMessage = [
                    'runningName' => $_POST['runningName'],
                    'runningTime' => $_POST['runningTime'],
                    'dateRunning' => $_POST['dateRunning'],
                    'distance' => $_POST['distance'],
                    'rank' => $_POST['rank'],
                    'participants' => $_POST['participants']
                ];
            }
        }

        return $this->twig->render('Admin/addPassion.html.twig', [
            'inputValue' => $errorMessage,
            'message' => $message
        ]);
    }


    public function editPassion($id)
    {
        session_start();

        if (!$_SESSION['email']) {
            return $this->twig->render('Admin/connexion.html.twig');
        }

        $passionManager = new PassionManager();
        $passion = $passionManager->selectOneById($id);

        if ($_POST) {

            if (!empty($_POST['runningName'] && !empty($_POST['runningTime']) && !empty($_POST['dateRunning']) && !empty($_POST['distance'])
                && !empty($_POST['rank']) && !empty($_POST['participants']))) {

                $passion = [
                    'name' => $_POST['runningName'],
                    'running_time' => $_POST['runningTime'],
                    'date' => $_POST['dateRunning'],
                    'distance' => $_POST['distance'],
                    'rank' => $_POST['rank'],
                    'participants' => $_POST['participants'],
                ];

                $passionManager->editPassion($passion, $id);

                $message = 'Votre course à été modifiée';
            }

            else {

                $errorMessage = [
                    'runningName' => $_POST['runningName'],
                    'runningTime' => $_POST['runningTime'],
                    'dateRunning' => $_POST['dateRunning'],
                    'distance' => $_POST['distance'],
                    'rank' => $_POST['rank'],
                    'participants' => $_POST['participants']
                ];
            }
        }


        return $this->twig->render('Admin/editPassion.html.twig', [
            'inputValue' => $errorMessage,
            'passion' => $passion,
            'message' => $message
        ]);
    }


    public function deletePassion($id)
    {
        $contactManager = new PassionManager();
        $contactManager->deletePassion($id);
        header('location: /admin');
    }

}
