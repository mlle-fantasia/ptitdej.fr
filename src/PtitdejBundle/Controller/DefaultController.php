<?php

namespace PtitdejBundle\Controller;

use PtitdejBundle\Entity\Evenement;
use PtitdejBundle\Form\Model\Prestataire;
use PtitdejBundle\Form\Type\PrestataireStep1Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PtitdejBundle\Entity\Entreprise;
use PtitdejBundle\Entity\Referent;
use PtitdejBundle\Form\EntrepriseType;
use PtitdejBundle\Form\ReferentType;
use PtitdejBundle\Form\EvenementType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Ptitdej/Default/index.html.twig');
    }

    public function formulaireEntrepriseAction(Request $request)
    {

        $formEntreprise = $this->generateFormEtap1($request,'entreprise');

        if ($formEntreprise->isSubmitted()) {
            return $this->redirectToRoute('ptitdej_homepage');
        }

        return $this->render('@Ptitdej/Default/formulaireEntreprise.html.twig', array(
            'formEntreprise' => $formEntreprise->createView(),
//            'formReferent' => $formReferent ->createView()
        ));

    }


    private function generateFormEtap1(Request $request, $source){
        //on crée un nouvel objet Entreprise
        $entreprise = new Entreprise();
        $referent = new Referent();

        $formPrestataireStep1 = new Prestataire();
        $formPrestataireStep1->populate($entreprise, $referent);


        //on crée le formulaire avec le service form factory
        $formEntreprise = $this->createForm(PrestataireStep1Type::class, $formPrestataireStep1);
        $formEntreprise->handleRequest($request);


        if ($formEntreprise->isSubmitted()) {
            $entreprise->sinceArray($formPrestataireStep1->extractEntreprise());
            $referent->sinceArray($formPrestataireStep1->extractReferent());

            $entityManager = $this->getDoctrine()->getManager();
            $entreprise->addReferent($referent);
            $entityManager->persist($referent);
            $entityManager->persist($entreprise);
            $entityManager->flush();

        }
        return $formEntreprise;
    }


    public function formulairePrestataireAction(Request $request)
    {
        $formEntreprise = $this->generateFormEtap1($request,'prestataire');

        if ($formEntreprise->isSubmitted()) {
            return $this->redirectToRoute('ptitdej_homepage');
        }

        return $this->render('@Ptitdej/Default/formulairePrestataire.html.twig', array(
            'formEntreprise' => $formEntreprise->createView(),
//            'formReferent' => $formReferent ->createView()
        ));

    }

}
