<?php

namespace PtitdejBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity(repositoryClass="PtitdejBundle\Repository\EntrepriseRepository")
 */
class Entreprise extends AbstractEntity
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;



    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=255)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\ManyToMany(targetEntity="PtitdejBundle\Entity\Referent")
     */
    private $referent;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Entreprise
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }


    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Entreprise
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Entreprise
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Entreprise
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->referent = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add referent
     *
     * @param \PtitdejBundle\Entity\Referent $referent
     *
     * @return Entreprise
     */
    public function addReferent(\PtitdejBundle\Entity\Referent $referent)
    {
        $this->referent[] = $referent;

        return $this;
    }

    /**
     * Remove referent
     *
     * @param \PtitdejBundle\Entity\Referent $referent
     */
    public function removeReferent(\PtitdejBundle\Entity\Referent $referent)
    {
        $this->referent->removeElement($referent);
    }

    /**
     * Get referent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferent()
    {
        return $this->referent;
    }

    public function _set($clef, $value)
    {
        $this->{$clef} = $value;
    }

}
