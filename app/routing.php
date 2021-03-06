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
        ['download', '/download', 'GET'], // action, url, method
    ],
    'Contact' => [ // Controller
        ['index', '/contact', ['GET', 'POST']], // action, url, method
        ['deleteContact', '/admin/delete-contact/{id}', 'GET'], // action, url, method
    ],
    'Passion' => [ // Controller
        ['index', '/passion', 'GET'], // action, url, method
        ['addPassion', '/admin/add-passion', ['GET', 'POST']], // action, url, method
        ['editPassion', '/admin/edit-passion/{id}', ['GET', 'POST']], // action, url, method
        ['deletePassion', '/admin/delete-passion/{id}', 'GET']
    ],
    'User' => [ // Controller
        ['userConnexion', '/connexion', ['GET', 'POST']], // action, url, method
        ['index', '/admin', 'GET'], // action, url, method
        ['logout', '/logout', 'GET'], // action, url, method
    ],
];
