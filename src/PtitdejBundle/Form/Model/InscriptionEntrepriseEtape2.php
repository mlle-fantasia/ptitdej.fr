<?php
/**
 * Created by PhpStorm.
 * User: Marina
 * Date: 21/08/2018
 * Time: 19:36
 */

namespace PtitdejBundle\Form\Model;

use PtitdejBundle\Entity\Evenement;
use Symfony\Component\Validator\Constraints as Assert;

class InscriptionEntrepriseEtape2
{

    /**
     * @Assert\NotBlank()
     * @Assert\Date()
     * @var string
     */
    public $date;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $lieu;

    /**
     * @Assert\NotBlank()
     * @var int
     */
    public $nbPersonne;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $budget;

    public function extractEvenement()
    {
        return [
            'date' => $this->date,
            'lieu' => $this->lieu,
            'nbPersonne' => $this->nbPersonne,
            'budget' => $this->budget,
        ];
    }


    public function populate(Evenement $even)
    {
        $this->date = $even->getDate();
        $this->lieu = $even->getLieu();
        $this->nbPersonne = $even->getNbPersonne();
        $this->budget = $even->getBudjet();
    }



}