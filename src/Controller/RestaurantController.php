<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Restaurant;
use App\Entity\City;
use Doctrine\Persistence\ManagerRegistry;

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

    /**
     * @Route("/restaurant", name="app_restaurant3")
     */
    public function restadd()
    {
        return $this->render('restaurant/add.html.twig');
    }

     /**
     * @Route("/restaurant/res", name="app_restaurant4")
     */
    public function create(Request $request,ManagerRegistry $doctrine)
    {
        $restaurant = new Restaurant();
        $entityManager = $this->getDoctrine()->getManager();


        $idcity=$request->get('id');
        $name=$request->get('name');
        $description=$request->get('desc');
        $createdat=$request->get('datecreat');

        $restaurant->setName($name);
        $restaurant->setDescription($description);
        $restaurant->setCreatedat(\DateTime::createFromFormat('Y-m-d', $createdat));
        $city = $doctrine->getRepository(City::class)->find($idcity);
        $restaurant->setCityid($city);

        // Enregistrement //
        $entityManager->persist($restaurant);
        // Execution des enregistrement //
        $entityManager->flush();

        return $this->render('restaurant/add.html.twig');
    }
    /**
     * @Route("/restaurant/{restaurant}", name="app_restaurant5")
     */
    public function restaurant(Restaurant $restaurant,ManagerRegistry $doctrine)
    {
        $res = $doctrine->getRepository(Restaurant::class)->find($restaurant);

        return $this->render('restaurant/search.html.twig',
        [
            'restaurant' => $res,
        ]);
    }
}
