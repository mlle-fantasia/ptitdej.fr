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

class Prestataire
{

    public $nom;
    public $mail;
    public $nomEntreprise;

    public function extractEntreprise()
    {
        return [
            'nom' => $this->nomEntreprise,
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
        $this->mail = $referent->getMail();
        $this->nom = $referent->getNom();
    }



}