<?php
namespace App\Controller;

use App\Entity\People;
use App\Form\PeopleType;
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
        $People = new People();

        $form = $this->createForm(PeopleType::class,$People);
        $form->handleRequest($request); // reception de la requete (apres clic sur bouton envoyé)
        if ($form->isSubmitted()&& $form ->isValid()) {
            $manager ->persist($People);
            $manager->flush();
            return $this->redirectToRoute('reservations');
        }

        return $this->render('blog/reservations.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
}
