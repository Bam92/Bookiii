<?php


// Home page
$app->get('/', function () use ($app) {
    $books = $app['dao.book']->findBooks();
    return $app['twig']->render('index.html.twig', array('books' => $books));
})->bind('home');

// Book matching id
$app->get('/book/{id}', function ($id) use ($app) {
    //$books = $app['dao.book']->findBooks();
    $book = $app['dao.book']->find($id);
    return $app['twig']->render('book.html.twig', array(
      'book' => $book
    ));
})->bind('book_show');
