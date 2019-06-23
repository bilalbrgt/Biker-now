<?php

namespace App\Controller;



use App\Entity\Reservations;
use App\Form\InscriType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/reservations", name="reservations")

     */
    public function reserver(Request $request,ObjectManager $manager)
    {
        $Reservations = new Reservations();

        $form = $this->createForm(InscriType::class,$Reservations);
        $form->handleRequest($request); // reception de la requete (apres clic sur bouton envoyé)
        if ($form->isSubmitted()&& $form ->isValid()) {
            $manager ->persist($Reservations);
            $manager->flush();
            return $this->redirectToRoute('reservations');
        }

        return $this->render('blog/reservations.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
