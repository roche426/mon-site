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
class CurriculumController extends AbstractController
{

    public function index()
    {
        $page = 'home';
        return $this->twig->render('index.html.twig', ['page' => $page]);
    }
}
