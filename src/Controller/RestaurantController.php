<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Restaurant;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/restaurants", name="app_restaurant")
     */
    public function restaurants()
    {
        $restaurants = $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
        
        return $this->render('restaurant/index.html.twig', [
            'restaurants' => $restaurants,
        ]);
    }
    /**
     * @Route("/restaurant/new", name="app_restaurant2")
     */
    public function new()
    {
        $res= $this->getDoctrine()->getRepository(Restaurant::class)->findOneBy([],['createdat' => 'desc']);

        return $this->render('restaurant/new.html.twig', [
            'restaurant' => $res,
        ]);
    }
}
