<?php


// Home page
$app->get('/', function () use ($app) {
    $books = $app['dao.book']->findBooks();
    return $app['twig']->render('index.html.twig', array('books' => $books));
});
