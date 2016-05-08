<?php 

namespace MeetUpBundle\Form;


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

class MeetUpType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
		->add('departement', ChoiceType::class,array('choices'=>array(
		'75 - Paris'=>'75 - Paris',
      '77 - Seine et Marne'=>'77 - Seine et Marne',
      '78 - Yvelines'=>'78 - Yvelines',
      '91 - Essonne'=>'91 - Essonne',
      '92 - Hauts de Seine'=>'92 - Hauts de Seine',
      '93 - Seine St Denis'=>'93 - Seine St Denis',
      '94 - Val de Marne'=>'94 - Val de Marne',
      '95 - Val d\'Oise'=>'95 - Val d\'Oise')))
		->add('localisation', TextType::class)
		->add('theme', ChoiceType::class, array('choices'=>array(
			'Un cafe'=>'Un cafe',
			'Une balade'=>'Une balade',
			'Une exposition'=>'Une exposition',
			'Un atelier'=>'Un atelier')) )
		->add('jour1', DateType::class)
		->add('jour2', DateType::class)
		->add('jour3', DateType::class)
		->add('description', TextareaType::class)
		->add('image', ImageType::class, array('required' => false))
		->add('save', SubmitType::class);
	}
}	
?>