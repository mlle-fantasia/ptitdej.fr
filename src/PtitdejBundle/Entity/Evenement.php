<?php

namespace PtitdejBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="PtitdejBundle\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPersonne", type="integer")
     */
    private $nbPersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=255)
     */
    private $duree;

    /**
     * @var int
     *
     * @ORM\Column(name="budjet", type="integer")
     */
    private $budjet;

    /**
     * @ORM\OneToOne(targetEntity="PtitdejBundle\Entity\Photo", cascade={"persist"})
     */
    private $photo;
    
    /**
     * @ORM\ManyToOne(targetEntity="PtitdejBundle\Entity\Entreprise")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Evenement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Evenement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set nbPersonne
     *
     * @param integer $nbPersonne
     *
     * @return Evenement
     */
    public function setNbPersonne($nbPersonne)
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    /**
     * Get nbPersonne
     *
     * @return int
     */
    public function getNbPersonne()
    {
        return $this->nbPersonne;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Evenement
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set budjet
     *
     * @param integer $budjet
     *
     * @return Evenement
     */
    public function setBudjet($budjet)
    {
        $this->budjet = $budjet;

        return $this;
    }

    /**
     * Get budjet
     *
     * @return int
     */
    public function getBudjet()
    {
        return $this->budjet;
    }

    /**
     * Set photo
     *
     * @param \PtitdejBundle\Entity\Photo $photo
     *
     * @return Evenement
     */
    public function setPhoto(\PtitdejBundle\Entity\Photo $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \PtitdejBundle\Entity\Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set entreprise
     *
     * @param \PtitdejBundle\Entity\Entreprise $entreprise
     *
     * @return Evenement
     */
    public function setEntreprise(\PtitdejBundle\Entity\Entreprise $entreprise)
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return \PtitdejBundle\Entity\Entreprise
     */
    public function getEntreprise()
    {
        return $this->entreprise;
    }
}
