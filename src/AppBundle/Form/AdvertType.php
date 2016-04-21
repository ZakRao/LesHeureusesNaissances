<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Form\ImageType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class AdvertType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
    ->add('date',      DateType::class)
    ->add('title',     TextType::class)
    ->add('author',    ChoiceType::class,array('choices'=>array(
      '75 - Paris'=>'75 - Paris',
      '77 - Seine et Marne'=>'77 - Seine et Marne',
      '78 - Yvelines'=>'78 - Yvelines',
      '91 - Essonne'=>'91 - Essonne',
      '92 - Hauts de Seine'=>'92 - Hauts de Seine',
      '93 - Seine St Denis'=>'93 - Seine St Denis',
      '94 - Val de Marne'=>'94 - Val de Marne',
      '95 - Val d\'Oise'=>'95 - Val d\'Oise')))


    ->add('content',   TextareaType::class)
    ->add('published', CheckboxType::class, array('required' => false))
    ->add('image',     ImageType::class)
    ->add('categories', CollectionType::class, array(
        'entry_type'         => CategoryType::class,
        'allow_add'    => true,
        'allow_delete' => true
      ))
    ->add('save',      SubmitType::class)
    ;

     // On ajoute une fonction qui va écouter l'évènement PRE_SET_DATA
    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,
      function(FormEvent $event) {
        // On récupère notre objet Advert sous-jacent
        $advert = $event->getData();

        if (null === $advert) {
          return;
        }

        if (!$advert->getPublished() || null === $advert->getId()) {
          $event->getForm()->add('published', CheckboxType::class, array('required' => false));
        } else {
          $event->getForm()->remove('published');
        }
      }
    );
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Advert'
        ));
    }

    public function getName()
  {
    return 'oc_platformbundle_advert';
  }



}
