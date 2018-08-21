<?php

namespace PtitdejBundle\Form\Type;

use PtitdejBundle\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class PrestataireStep1Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('nomEntreprise', TextType::class)
            ->add('mail', TextType::class)
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'myButtonBis'),
            ))
            ->getForm();
    }

}
