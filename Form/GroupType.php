<?php

namespace Anh\ContentBlockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Anh\ContentBlockBundle\Entity\Block;

class GroupType extends AbstractType
{
    protected $groupClass;

    public function __construct($groupClass)
    {
        $this->groupClass = $groupClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
        ;

        $builder
            ->add('slug', 'text', array('required' => false))
        ;

        $builder
            ->add('submit', 'submit')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->groupClass,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'anh_content_block_group';
    }
}
