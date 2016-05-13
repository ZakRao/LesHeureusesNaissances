<?php

namespace AppUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DispoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Lundi_Matin', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Lundi_Midi', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Lundi_Soir', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Mardi_Matin', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Mardi_Midi', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Mardi_Soir', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Mercredi_Matin', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Mercredi_Midi', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Mercredi_Soir', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Jeudi_Matin', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Jeudi_Midi', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Jeudi_Soir', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Vendredi_Matin', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Vendredi_Midi', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Vendredi_Soir', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Samedi_Matin', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Samedi_Midi', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Samedi_Soir', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Dimanche_Matin', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Dimanche_Midi', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,)),
            ->add('Dimanche_Soir', CheckboxType::class, array(
            'label'    => 'Êtes vous enceinte ?',
           'required' => false,))
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppUserBundle\Entity\Dispos'
        ));
    }


     /**
     * @return string
     */
    public function getName()
    {
        return 'app_user_bundle_dispos';
    }
}
