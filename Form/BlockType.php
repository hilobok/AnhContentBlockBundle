<?php

namespace Anh\ContentBlockBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Anh\ContentBlockBundle\Entity\Block;

class BlockType extends AbstractType
{
    protected $blockClass;

    protected $groupClass;

    public function __construct($blockClass, $groupClass)
    {
        $this->blockClass = $blockClass;
        $this->groupClass = $groupClass;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visibility', 'choice', array(
                'choices' => array(
                    Block::VISIBILITY_EVERYWHERE => 'Everywhere',
                    Block::VISIBILITY_INDEX_ONLY => 'Only on idex page',
                    Block::VISIBILITY_NOT_ON_INDEX => 'Not on index'
                )
            ))
        ;

        $builder
            ->add('group', 'entity', array(
                'class' => $this->groupClass,
                'property' => 'title',
            ))
        ;

        $builder
            ->add('title', 'text')
        ;

        $builder
            ->add('content', 'textarea', array(
                'attr' => array(
                    'class' => 'markup-html',
                ),
                'required' => false,
            ))
        ;

        $builder
            ->add('isDraft', 'checkbox', array(
                'required' => false,
            ))
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
            'data_class' => $this->blockClass,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'anh_content_block_block';
    }
}
