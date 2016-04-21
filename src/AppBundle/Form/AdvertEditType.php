<?php
// src/OC/PlatformBundle/Form/AdvertEditType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use AppBundle\Form\AdvertType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AdvertEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date',DateType::class);
  }

  public function getName()
  {
    return 'oc_platformbundle_advert_edit';
  }

  public function getParent()
  {
    return  AdvertType::class;
  }
}