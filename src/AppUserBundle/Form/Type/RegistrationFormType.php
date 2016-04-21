<?php
namespace AppUserBundle\Form\Type;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Intranet\UserBundle\Form\Type\UserLangueType as UserLangueType;
 
class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
		$builder
			->add('nom')
			->add('adresse')
      		->add('parrain');
    }
	
	public function getName(){
        return 'oc_user_registration';
	}

	
	
	
}