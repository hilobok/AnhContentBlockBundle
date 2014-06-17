<?php

namespace Anh\ContentBlockBundle\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Anh\DoctrineResource\ResourceRepositoryInterface;

class ContentBlockExtension extends \Twig_Extension
{
    protected $blockManager;

    protected $requestStack;

    public function __construct(RequestStack $requestStack, ResourceRepositoryInterface $blockRepository)
    {
        $this->requestStack = $requestStack;
        $this->blockRepository = $blockRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'contentBlock' => new \Twig_Function_Method($this, 'contentBlock', array('is_safe' => array('html'))),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'anh_content_block';
    }

    public function contentBlock($position)
    {
        $request = $this->requestStack->getCurrentRequest();
        $block = $this->blockRepository->findBlockInGroup($position, $request->getPathInfo() === '/');

        return $block ? $block->getContent() : '';
    }
}
