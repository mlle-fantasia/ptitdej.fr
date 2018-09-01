<?php

namespace PtitdejBundle\Controller;

use PtitdejBundle\Form\Model\InscriptionPrestataireEtape2;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use PtitdejBundle\Entity\Evenement;
use PtitdejBundle\Form\Model\InscriptionEntrepriseEtape2;
use PtitdejBundle\Form\Model\InscriptionEtape1;
use PtitdejBundle\Form\Type\InscriptionEtape1Type;
use PtitdejBundle\Form\Type\InscriptionEntrepriseEtape2Type;
use PtitdejBundle\Form\Type\InscriptionPrestataireEtape2Type;
use PtitdejBundle\Form\Model\Contact;
use PtitdejBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PtitdejBundle\Entity\Entreprise;
use PtitdejBundle\Entity\Referent;
use PtitdejBundle\Entity\Offre;
use PtitdejBundle\Entity\Photo;
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

        if (!$form->isSubmitted() || !$form->isValid()) {

            return $form;
        }



        $entreprise->sinceArray($formStep1->extractEntreprise());
        $referent->sinceArray($formStep1->extractReferent());

        $entityManager = $this->getDoctrine()->getManager();
        $entreprise->addReferent($referent);
        $entityManager->persist($referent);
        $entityManager->persist($entreprise);
        $entityManager->flush();

        return $form;
    }

    protected function getRepository($className)
    {
        return $repository = $this->getDoctrine()->getManager()->getRepository($className);
    }

    public function formulaireEntrepriseEtape2Action(Request $request)
    {

        $evenement = new Evenement();

        $repository = $this->getRepository('PtitdejBundle:Entreprise');
        $entreprise = $repository->find($_GET['idEntreprise']);
        $evenement->setEntreprise($entreprise);

        $repository = $this->getRepository('PtitdejBundle:Referent');
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
    protected function getErrors($form){
        $string = (string) $form->getErrors(true, false);
                echo $string;
                exit;
    }

    public function formulairePrestataireAction(Request $request)
    {
        $entreprise = new Entreprise();
        $referent = new Referent();

        $form = $this->generateFormEtap1($request, 'prestataire', $entreprise, $referent);


        if ($form->isSubmitted()) {

            $idReferent = $referent->getId();
            $idEntreprise = $entreprise->getId();

            return $this->redirectToRoute('form_prestataire_etape2', array(
                'idReferent' => $idReferent,
                'idEntreprise' => $idEntreprise,
                'rfrerr' => 4545,
            ));
        }


        return $this->render('@Ptitdej/Default/formulairePrestataire.html.twig', array(
            'formEntreprise' => $form->createView(),
        ));

    }


    public function formulairePrestataireEtape2Action(Request $request)
    {
        $offre = new Offre();
        $photo = new Photo();

        $repositoryEntreprise = $this->getDoctrine()->getManager()->getRepository('PtitdejBundle:Entreprise');
        $entreprise = $repositoryEntreprise->find($request->get('idEntreprise'));
        $offre->setEntreprise($entreprise);

        $repositoryReferent = $this->getDoctrine()->getManager()->getRepository('PtitdejBundle:Referent');
        $referent = $repositoryReferent->find($request->get('idReferent'));

        $offre->setReferent($referent);

        $etape2 = new InscriptionPrestataireEtape2();
        $etape2->populate($offre);

        $formPrestaEtape2 = $this->createForm(InscriptionPrestataireEtape2Type::class, $etape2);
        $formPrestaEtape2->handleRequest($request);

        if ($formPrestaEtape2->isSubmitted() && $formPrestaEtape2->isValid()) {

            $offre->sinceArray($etape2->extractOffre());
            $photo->sinceArray($etape2->extractPhoto());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offre);
            $entityManager->persist($photo);
            $entityManager->flush();

            $this->addFlash("info", "Votre inscription a bien été validée");
            return $this->redirectToRoute('ptitdej_homepage');

        }

        return $this->render('@Ptitdej/Default/formulairePrestataireEtape2.html.twig', array(
            'formOffre' => $formPrestaEtape2->createView(),
        ));
    }


    public function pageContactAction(Request $request)
    {

        $formContact = new Contact();

        $formulaireContact = $this->createForm(ContactType::class, $formContact);
        $formulaireContact->handleRequest($request);

        if ($formulaireContact->isSubmitted() && $formulaireContact->isValid()) {
            if($request->isMethod('POST')){

                $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
                    ->setUsername('your username')
                    ->setPassword('your password')
                ;

                $request = Request::createFromGlobals();

                $nom = $formulaireContact['nom']->getData();
                $prenom = $formulaireContact['prenom']->getData();
                $objet = $formulaireContact['objet']->getData();
                $mail = $formulaireContact['mail']->getData();
                $messageClient = $formulaireContact['message']->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject($objet)
                    ->setForm('send@emple.com')
                    ->setTo('marinafront2@gmail.com')
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($this->container
                                ->get('templating')
                                ->render('@Ptitdej/Default/SwiftMailer/email.html.twig',
                                      array('nom' => $nom,
                                            'mail'=>$mail,
                                            'message'=>$messageClient,
                                            'prenom' => $prenom,
                                            'objet' => $objet)
                                        ));

                $this->get('mailer')->send($message);

                $this->addFlash("info", "Votre message a bien été envoyé");
                return $this->redirectToRoute('ptitdej_contact');

            }
            $this->addFlash("info", "erreur");
            return $this->redirectToRoute('ptitdej_homepage');



        }

        return $this->render('@Ptitdej/Default/contact.html.twig', array(
            'formContact' => $formulaireContact->createView(),
        ));


    }

    public function ContactAction(Request $request)
    {



    }

}
