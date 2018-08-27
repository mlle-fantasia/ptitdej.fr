<?php

namespace PtitdejBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use PtitdejBundle\Entity\Evenement;
use PtitdejBundle\Form\Model\InscriptionEntrepriseEtape2;
use PtitdejBundle\Form\Model\InscriptionEtape1;
use PtitdejBundle\Form\Type\InscriptionEtape1Type;
use PtitdejBundle\Form\Type\InscriptionEntrepriseEtape2Type;
use PtitdejBundle\Form\Model\Contact;
use PtitdejBundle\Form\Type\ContactType;
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
    public function erreurAction()
    {
        return $this->render('@Ptitdej/Default/erreur.html.twig');
    }

    public function indexAction()
    {
        return $this->render('@Ptitdej/Default/index.html.twig');
    }

    public function formulaireEntrepriseAction(Request $request)
    {
        $entreprise = new Entreprise();
        $referent = new Referent();

        $formEntreprise = $this->generateFormEtap1($request, 'entreprise', $entreprise, $referent);

        if ($formEntreprise->isSubmitted()) {

            $idReferent = $referent->getId();
            $idEntreprise = $entreprise->getId();

            return $this->redirectToRoute('form_entreprise_etape2', array(
                'idReferent' => $idReferent,
                'idEntreprise' => $idEntreprise,
            ));
        }

        return $this->render('@Ptitdej/Default/formulaireEntreprise.html.twig', array(
            'formEntreprise' => $formEntreprise->createView(),
        ));

    }


    private function generateFormEtap1(Request $request, $source, Entreprise $entreprise, Referent $referent)
    {

        $entreprise->setNature($source);

        $formStep1 = new InscriptionEtape1();
        $formStep1->populate($entreprise, $referent);


        //on crée le formulaire
        $form = $this->createForm(InscriptionEtape1Type::class, $formStep1);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
//
//            if (!$form->isValid()) {
//                $string = (string) $form->getErrors(true, false);
//                echo $string;
//                exit;
//            }
            $entreprise->sinceArray($formStep1->extractEntreprise());
            $referent->sinceArray($formStep1->extractReferent());

            $entityManager = $this->getDoctrine()->getManager();
            $entreprise->addReferent($referent);
            $entityManager->persist($referent);
            $entityManager->persist($entreprise);
            $entityManager->flush();

            return $form;

        }

//        if ($form->isSubmitted() && !$form->get('nature')->isValid()) {
//            return $this->redirectToRoute('form_erreur');
//        }

        return $form;
    }


    public function formulairePrestataireAction(Request $request)
    {
        $entreprise = new Entreprise();
        $referent = new Referent();

        $formEntreprise = $this->generateFormEtap1($request, 'prestataire', $entreprise, $referent);

        if ($formEntreprise->isSubmitted()) {
            return $this->redirectToRoute('ptitdej_homepage');
        }

        return $this->render('@Ptitdej/Default/formulairePrestataire.html.twig', array(
            'formEntreprise' => $formEntreprise->createView(),
        ));

    }


    public function formulaireEntrepriseEtape2Action(Request $request)
    {

        $evenement = new Evenement();

        $repository = $this->getDoctrine()->getManager()->getRepository('PtitdejBundle:Entreprise');
        $entreprise = $repository->find($_GET['idEntreprise']);
        $evenement->setEntreprise($entreprise);

        $repository = $this->getDoctrine()->getManager()->getRepository('PtitdejBundle:Referent');
        $referent = $repository->find($_GET['idReferent']);
        $evenement->setReferent($referent);

        $formStep2 = new InscriptionEntrepriseEtape2();
        $formStep2->populate($evenement);


        //on crée le formulaire
        $formEntreprise2 = $this->createForm(InscriptionEntrepriseEtape2Type::class, $formStep2);
        $formEntreprise2->handleRequest($request);

        if ($formEntreprise2->isSubmitted() && $formEntreprise2->isValid()) {

            $evenement->sinceArray($formStep2->extractEvenement());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            $this->addFlash("info", "votre demande a bien été enregistrée");
            return $this->redirectToRoute('ptitdej_homepage');
        }
        return $this->render('@Ptitdej/Default/formulaireEntrepriseEtape2.html.twig', array(
            'formEven' => $formEntreprise2->createView(),
        ));

    }


    public function pageContactAction(Request $request)
    {

        $formContact = new Contact();

        $formulaireContact = $this->createForm(ContactType::class, $formContact);
        $formulaireContact->handleRequest($request);

        if ($formulaireContact->isSubmitted()) {
            return $this->redirectToRoute('ptitdej_homepage');
        }

        return $this->render('@Ptitdej/Default/contact.html.twig', array(
            'formContact' => $formulaireContact->createView(),
        ));


    }

}
