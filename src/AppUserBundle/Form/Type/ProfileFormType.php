<?php


namespace AppUserBundle\Form\Type;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use Symfony\Component\Form\FormBuilder;
use AppBundle\Form\ImageType;
use AppBundle\Form\CategoryType;
use AppUserBundle\Form\Type\EnfantType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Intranet\UserBundle\Form\Type\UserLangueType as UserLangueType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
 
class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
		$builder
			->add('nom')
			->add('adresse')
			->add('prenom')
      		->add('parrain', EmailType::class)
			->add('telephone')
			->add('image', ImageType::class)
			->add('ville')
			->add('departement', ChoiceType::class,array('choices'=>array(
      '75 - Paris'=>'75 - Paris',
      '77 - Seine et Marne'=>'77 - Seine et Marne',
      '78 - Yvelines'=>'78 - Yvelines',
      '91 - Essonne'=>'91 - Essonne',
      '92 - Hauts de Seine'=>'92 - Hauts de Seine',
      '93 - Seine St Denis'=>'93 - Seine St Denis',
      '94 - Val de Marne'=>'94 - Val de Marne',
      '95 - Val d\'Oise'=>'95 - Val d\'Oise')))
			->add('loca', TextType::class)
			->add('profession')
      ->add('enfants', CollectionType::class, array(
        'entry_type'         => EnfantType::class,
        'allow_add'    => true,
        'allow_delete' => true
      ))
      ->add('enceinte', CheckboxType::class, array(
    'label'    => 'Êtes vous enceinte ?',
    'required' => false,))
			->add('datef')
			->add('personnalite', ChoiceType::class,array('choices'=>array(
      'Rêveuse'=>'Rêveuse',
      'Gourmande'=>'Gourmande',
      'Passionée'=>'Passionée',
      'Sportive'=> 'Sportive',
      'Enthousiaste'=>'Enthousiaste',
      'Curieuse'=>'Curieuse',
      'Autre'=>'Autre')))
			->add('description', TextareaType::class)
      ->add('save',      SubmitType::class)
			
	;
    }
	
	public function getName(){
        return 'oc_user_profile';
	}	


 
	
	
}