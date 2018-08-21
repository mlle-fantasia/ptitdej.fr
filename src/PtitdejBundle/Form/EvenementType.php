<?php

namespace PtitdejBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class)
            ->add('lieu',TextType::class)
            ->add('nbPersonne', NumberType::class)
            ->add('duree', NumberType::class)
            ->add('budjet', NumberType::class)
            ->add('save',SubmitType::class, array(
                'attr' => array('class' => 'myButtonBis'),
            ))
            ->add('previousStep', SubmitType::class, array(
                'validation_groups' => false,
                'attr' => array('class' => 'myButtonBis'),
            ))
            ->add('nextStep', SubmitType::class, array(
                'validation_groups' => array('Registration'),
                'attr' => array('class' => 'myButtonBis'),
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PtitdejBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ptitdejbundle_evenement';
    }


}
