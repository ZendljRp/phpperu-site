<?php

namespace Alom\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $bodyType = new TextareaType();
        $builder
            ->add('title')
            ->add('slug')
            ->add('body')
            ->add('metaDescription')
            ->add('publishedAt')
            ->add('isActive', 'checkbox', array('required' => false))
            ->add('captcha', 'captcha')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alom\WebsiteBundle\Entity\Post'
        ));
    }

    public function getName()
    {
        return 'post';
    }
}
