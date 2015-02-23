<?php
namespace Alom\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug')
            ->add('description')
            ->add('readAt')
            ->add('isActive', null, array('required' => false))
            ->add('illustrationUpload', 'file', array('required' => false))
            ->add('externalLink', 'text', array('required' => false))
            ->add('captcha', 'captcha')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alom\WebsiteBundle\Entity\Book'
        ));
    }

    public function getName()
    {
        return 'book';
    }
}
