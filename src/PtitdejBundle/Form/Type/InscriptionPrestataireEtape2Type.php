<?php

namespace PtitdejBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use PtitdejBundle\Form\Type\OffreType;

class InscriptionPrestataireEtape2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offre', CollectionType::class, array(
                'entry_type'   => OffreType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'myButtonBis'),
            ))
            ->getForm();
    }

}
