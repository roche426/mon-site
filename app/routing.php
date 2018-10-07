<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'Curriculum' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
    ],
    'Contact' => [ // Controller
        ['index', '/contact', ['GET', 'POST']], // action, url, method
    ],
    'User' => [ // Controller
        ['userConnexion', '/connexion', ['GET', 'POST']], // action, url, method
        ['index', '/admin', ['GET', 'POST']], // action, url, method
        ['logout', '/logout', ['GET', 'POST']], // action, url, method
    ],
];
