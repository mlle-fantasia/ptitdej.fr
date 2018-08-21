<?php

namespace PtitdejBundle\Controller;

use PtitdejBundle\Entity\Evenement;
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
        //on crée un nouvel objet Entreprise
        $entreprise = new Entreprise();
        $referent = new Referent();
        $even = new Evenement();


        //on crée le formulaire avec le service form factory
//        $formEntreprise = $this->get('form.factory')->create(EntrepriseType::class, $entreprise);
//        $formEven = $this->get('form.factory')->create(EvenementType::class, $evenement);
        $formEntreprise = $this->createForm(EntrepriseType::class, $entreprise);
        $formReferent = $this->createForm(ReferentType::class, $referent);
        $formEven = $this->createForm(EvenementType::class, $even);


        if($request->isMethod('POST')){
            $formReferent->handleRequest($request);
            $formEntreprise->handleRequest($request);
            $formEven->handleRequest($request);

            if($formEntreprise->isSubmitted()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($referent);
                $em->persist($entreprise);

                $em->flush();

                if ($formEntreprise->get('save')->isClicked()) {
                    $this->addFlash("info", "votre demande a bien été enregistrée");
                    return $this->redirectToRoute('ptitdej_homepage');
                }
                if ($formEntreprise->get('nextStep')->isClicked()) {
                    return $this->render('@Ptitdej/Default/formulaireEntrepriseEtape2.html.twig', array(
                        'formEntreprise' => $formEntreprise->createView(),
                        'formReferent' => $formReferent ->createView(),
                        'formEven' => $formEven ->createView()
                    ));
                }

//                return new Response('votre demande à bien été envoyée');
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
            'formReferent' => $formReferent ->createView()
        ));

    }

    public function formulairePrestataireAction(Request $request){
        //on crée un nouvel objet Entreprise
        $entreprise = new Entreprise();
        $referent = new Referent();

        $formEntreprise = $this->createForm(EntrepriseType::class, $entreprise);
        $formReferent = $this->createForm(ReferentType::class, $referent);



        if($request->isMethod('POST')){
            $formReferent->handleRequest($request);
            $formEntreprise->handleRequest($request);


            if($formEntreprise->isSubmitted()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($referent);
                $em->persist($entreprise);

                $em->flush();

                if ($formEntreprise->get('save')->isClicked()) {
                    $this->addFlash("info", "votre demande a bien été enregistrée");
                    return $this->redirectToRoute('ptitdej_homepage');
                }
                if ($formEntreprise->get('nextStep')->isClicked()) {
                    return $this->render('@Ptitdej/Default/formulairePrestataireEtape2.html.twig', array(
                        'formEntreprise' => $formEntreprise->createView(),
                        'formReferent' => $formReferent ->createView(),

                    ));
                }

//                return new Response('votre demande à bien été envoyée');
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

        return $this->render('@Ptitdej/Default/formulairePrestataire.html.twig', array(
            'formEntreprise' => $formEntreprise->createView(),
            'formReferent' => $formReferent ->createView()
        ));

    }

}
