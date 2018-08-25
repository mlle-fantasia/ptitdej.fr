<?php
/**
 * Created by PhpStorm.
 * User: Marina
 * Date: 21/08/2018
 * Time: 19:36
 */

namespace PtitdejBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
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
    * @var text
    */
    public $message;

}