<?php
/**
 * Created by PhpStorm.
 * User: Marina
 * Date: 21/08/2018
 * Time: 19:36
 */

namespace PtitdejBundle\Form\Model;

use PtitdejBundle\Entity\Entreprise;
use PtitdejBundle\Entity\Referent;
use Symfony\Component\Validator\Constraints as Assert;

class InscriptionEtape1
{

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $nom;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @var string
     */
    public $mail;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $nomEntreprise;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $nature;

    public function extractEntreprise()
    {
        return [
            'nom' => $this->nomEntreprise,
            'nature' => $this->nature,
        ];
    }

    public function extractReferent()
    {
        return [
            'nom' => $this->nom,
            'mail' => $this->mail,
        ];
    }

    public function populate(Entreprise $entreprise, Referent $referent)
    {
        $this->nomEntreprise = $entreprise->getNom();
        $this->nature = $entreprise->getNature();
        $this->mail = $referent->getMail();
        $this->nom = $referent->getNom();
    }



}