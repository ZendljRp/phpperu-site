<?php

namespace Alom\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostCommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname', 'text', array(
                'label' => 'Fullname *'
            ))
            ->add('email', 'email', array(
                'label' => 'Email *'
            ))
            ->add('website', 'url', array(
                'label'    => 'Website',
                'required' => false
            ))
            ->add('body', 'textarea', array(
                'label' => 'Comment *'
            ))
            ->add('captcha', 'captcha')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alom\WebsiteBundle\Entity\PostComment'
        ));
    }

    public function getName()
    {
        return 'postcomment';
    }
}
