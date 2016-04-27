<?php


namespace AppUserBundle\Form\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormBuilder;
use AppBundle\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Intranet\UserBundle\Form\Type\UserLangueType as UserLangueType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        		$builder
			->add('contenu')
			->add('image', ImageType::class)
			
	;
    }
	



  /**
     * @return string
     */
    public function getName()
    {
        return 'oc_userbundle_commentaire';
    }
	
	
}