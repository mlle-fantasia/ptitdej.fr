<?php

namespace PtitdejBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PtitdejBundle\Entity\Entreprise;
use PtitdejBundle\Entity\Evenement;
use PtitdejBundle\Form\EntrepriseType;
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
        //on crée un nouvel objet Entreprise
        $entreprise = new Entreprise();
        $entreprise->setNom('marina');
        $entreprise->setAdresse('1658 che st martin');
        $entreprise->setCodePostal('83130');
        $entreprise->setMail('marina@hotmail.fr');
        $entreprise->setTel('0635968542');
        $evenement = new Evenement();
        $evenement->setBudjet('100');
        $evenement->setDuree('1');
        $evenement->setLieu('la garde');
        $evenement->setNbPersonne('25');

        //on crée le formulaire avec le service form factory
//        $formEntreprise = $this->get('form.factory')->create(EntrepriseType::class, $entreprise);
//        $formEven = $this->get('form.factory')->create(EvenementType::class, $evenement);
        $formEntreprise = $this->createForm(EntrepriseType::class, $entreprise);
        $formEven = $this->createForm(EvenementType::class, $evenement);


        if($request->isMethod('POST')){
            $formEntreprise->handleRequest($request);
            $formEven->handleRequest($request);

            if($formEntreprise->isSubmitted()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($entreprise);

                $em->flush();

                return new Response('votre demande à bien été envoyée');
            }

//            if($formEntreprise->isValid() && $formEven->isValid()){
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($entreprise);
//                $em->persist($evenement);
//                $em->flush();
//
//                $this->addFlash("info", "votre demande a bien été enregistrée");
//                return $this->redirectToRoute('ptitdej_homepage');
//            }
        }

        return $this->render('@Ptitdej/Default/formulaireEntreprise.html.twig', array(
            'formEntreprise' => $formEntreprise->createView(),
            'formEvenement' => $formEven ->createView()
        ));

    }


    public function formulaireEntrepriseDejaInscriteAction(Request $request)
    {
        //on crée un nouvel objet Entreprise
        $entreprise = new Entreprise();


        $formEntreprise = $this->createForm(EntrepriseType::class, $entreprise);


        if($request->isMethod('POST')){
            $formEntreprise->handleRequest($request);

            if($formEntreprise->isValid() ){
                $em = $this->getDoctrine()->getManager();

                return $this->redirectToRoute('form_entreprise');
            }
        }

        return $this->render('@Ptitdej/Default/formulaireEntrepriseDejaInscrite.html.twig', array(
            'formEntreprise' => $formEntreprise->createView(),
        ));

    }

    public function formulaireComAction()
    {

        return $this->render('@Ptitdej/Default/commentaire.html.twig');
    }


}
