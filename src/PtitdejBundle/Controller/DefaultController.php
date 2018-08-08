<?php

namespace PtitdejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PtitdejBundle\Entity\Entreprise;
use PtitdejBundle\Entity\Evenement;
use PtitdejBundle\Form\EntrepriseType;
use PtitdejBundle\Form\EvenementType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Ptitdej/Default/index.html.twig');
    }

    public function formulaireEntrepriseAction(Request $request)
    {
        //on crée un nouvel objet Entreprise
        $entreprise = new Entreprise();
        $evenement = new Evenement();

        //on crée le formulaire avec le service form factory
        $formEntreprise = $this->get('form.factory')->create(EntrepriseType::class, $entreprise);
        $formEven = $this->get('form.factory')->create(EvenementType::class, $evenement);

        if($request->isMethod('POST')){
            $formEntreprise->handleRequest($request);
            $formEven->handleRequest($request);

            if($formEntreprise->isValid() && $formEven->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($entreprise);
                $em->persist($evenement);
                $em->flush();

                $request->getSession()->getFlashbag()->add('notice','demande bien enregistée');

                return $this->rediectToRoute('ptitdej_homepage',array('id'=>$entreprise->getId()));
            }
        }
        return $this->render('@Ptitdej/Default/formulaireEntreprise.html.twig', array(
            'formEntreprise' => $formEntreprise->createView(),
            'formEvenement' => $evenement ->createView()
        ));

    }


}
