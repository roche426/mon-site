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
        ['index', '/contact', 'GET'], // action, url, method
        ['contactUs', '/send', 'POST'], // action, url, method

    ],
];
