<?php
/**
 * Created by PhpStorm.
 * User: Marina
 * Date: 21/08/2018
 * Time: 19:36
 */

namespace PtitdejBundle\Form\Model;

use PtitdejBundle\Entity\Offre;
use Symfony\Component\Validator\Constraints as Assert;

class InscriptionPrestataireEtape2
{

        /**
        * @Assert\NotBlank()
        * @var string
        */
        public $nom;

        /**
        * @Assert\NotBlank()
        *
        */
        public $prix;

        /**
        *
        *
        */
        public $detail;

        /**
         * @Assert\NotBlank()
         *
         */
        public $type;

        /**
        *@Assert\File(mimeTypes={ "image/jpeg" })
        *
        */
        public $photo;


        public function extractPhoto(){
            return [
                'photo' => $this->photo,
            ];
        }

        public function extractOffre()
        {
            return [
                'nom' => $this->nom,
                'prix' => $this->prix,
                'type' => $this->type,
                'detail' => $this->detail,
            ];
        }


        public function populate(Offre $offre)
        {
            $this->nom = $offre->getNom();
            $this->prix = $offre->getPrix();
            $this->type = $offre->getType();
            $this->photo = $offre->getPhoto();
            $this->detail = $offre->getDetail();

        }

}

