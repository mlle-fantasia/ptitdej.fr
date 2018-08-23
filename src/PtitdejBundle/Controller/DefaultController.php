<?php

namespace PtitdejBundle\Controller;

use PtitdejBundle\Entity\Evenement;
use PtitdejBundle\Form\Model\InscriptionEtape1;
use PtitdejBundle\Form\Type\InscriptionEtape1Type;
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
    public function erreurAction(){
        return $this->render('@Ptitdej/Default/erreur.html.twig');
    }

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
        ));

    }


    private function generateFormEtap1(Request $request, $source){
        //on crée un nouvel objet Entreprise
        $entreprise = new Entreprise();
        $referent = new Referent();
        $entreprise->setNature($source);

        $formPrestataireStep1 = new InscriptionEtape1();
        $formPrestataireStep1->populate($entreprise, $referent);


        //on crée le formulaire
        $formEntreprise = $this->createForm(InscriptionEtape1Type::class, $formPrestataireStep1);
        $formEntreprise->handleRequest($request);


        if ($formEntreprise->isSubmitted()) {

            // On récupère le service validator
            $validator = $this->get('validator');
            // On déclenche la validation sur notre object
            $listErrors = $validator->validate($entreprise);
            // Si $listErrors n'est pas vide, on affiche les erreurs
            if(count($listErrors) > 0) {
                // $listErrors est un objet, sa méthode __toString permet de lister joliement les erreurs
                return $this->render('@Ptitdej/Default/erreur.html.twig', array(
                    'errors' => $listErrors,
                ));
            }
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
        ));

    }


    public function formulaireEntrepriseEtape2Action(Request $request, Entreprise $entreprise, Referent $referent){

    }

}
