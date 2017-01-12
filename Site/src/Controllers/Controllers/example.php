<?php

namespace DUT\Controllers;

use DUT\Services\SessionStorage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use DUT\Models\Article;

class ItemsController
{
    /**
     * @param SessionStorage
     */
    private $store;

    public function __construct()
    {
    }

    /**
     * Affiche le formulaire d'ajout ainsi que la liste d'éléments
     * provenant de SessionStorage
     * @param Application $app
     */
    public function indexAction (Application $app)
    {
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Article');


        $truk = $repository->findAll();


        return $app['twig']->render('home.twig', ['items' => $truk]);
    }

    /**
     * Supprime un élément dans SessionStorage à partir de son index
     * @param Application $app
     * @param int $index
     */
    public function removeAction (Application $app, $index)
    {
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Article');

        $urlToRedirect = $app['url_generator']->generate('GET_');

        $itemToRemove = $entityManager->find('DUT\\Models\\Article', $index);
        $entityManager->remove($itemToRemove);
        $entityManager->flush();

        return $app->redirect($urlToRedirect);
    }

    /**
     * Ajoute un élément dans SessionStorage depuis les informations d'un
     * formulaire
     * @param Application $app
     * @param Request $request
     */
    /*public function addAction (Application $app, Request $request)
    {
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Article');

        $urlToRedirect = $app['url_generator']->generate('GET_');

        $newArticle = new Article($request->get('todo'));
        $entityManager->persist($newArticle);
        $entityManager->flush();

        return $app->redirect($urlToRedirect);
    }*/
}
