<?php

namespace PtitdejBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class InscriptionEtape1Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('mail', EmailType::class)
            ->add('nomEntreprise', TextType::class)
            ->add('nature', ChoiceType::class,[
                'choices' =>[
                   'Entreprise  (vous souhaitez organiser un p\'it dej)' => 'entreprise',
                   'Prestataire  (vous vendez des p\'it dej)' => 'prestataire',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'myButtonBis'),
            ))
            ->getForm();
    }

}
