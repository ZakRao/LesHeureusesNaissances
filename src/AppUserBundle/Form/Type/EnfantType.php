<?php

namespace AppUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EnfantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom')
            ->add('sexe', ChoiceType::class,array('choices'=>array(
      'M'=>'M',
      'F'=>'F')))
            ->add('anniversaire', BirthdayType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppUserBundle\Entity\Enfant'
        ));
    }


     /**
     * @return string
     */
    public function getName()
    {
        return 'oc_userbundle_enfant';
    }
}
