<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Restaurant;
use App\Entity\User;
use App\Entity\Review;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review", name="app_review")
     */
    public function revadd()
    {
        return $this->render('review/index.html.twig');
    }
     /**
     * @Route("/review/rev", name="app_review2")
     */
    public function addReview(Request $request,ManagerRegistry $doctrine)
    {
        $review = new Review();
        $entityManager = $this->getDoctrine()->getManager();


        $idrestau=$request->get('idr');
        $iduser=$request->get('idu');
        $message=$request->get('message');
        $rating=$request->get('rating');
        $createdat=$request->get('datecreat');

        $review->setMessage($message);
        $review->setRating($rating);
        $review->setCreatedat(\DateTime::createFromFormat('Y-m-d', $createdat));
        $restaurant = $doctrine->getRepository(Restaurant::class)->find($idrestau);
        $User = $doctrine->getRepository(User::class)->find($iduser);

        $review->setRestaurantid($restaurant);
        $review->setUserid($User);


        // Enregistrement //
        $entityManager->persist($review);
        // Execution des enregistrement //
        $entityManager->flush();

        return $this->render('review/add.html.twig');
    }
}
