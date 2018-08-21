<?php

namespace PtitdejBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EntrepriseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('adresse', TextType::class)
            ->add('codePostal', NumberType::class)
            ->add('tel', NumberType::class, array('required' => false))
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
            ))
            ->getForm();


    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PtitdejBundle\Entity\Entreprise'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ptitdejbundle_entreprise';
    }


}
