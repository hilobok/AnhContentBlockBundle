<?php

namespace Anh\ContentBlockBundle\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Anh\DoctrineResource\ResourceRepositoryInterface;

class ContentBlockExtension extends \Twig_Extension
{
    protected $blockManager;

    protected $groupManager;

    protected $requestStack;

    public function __construct(
        RequestStack $requestStack,
        ResourceRepositoryInterface $blockRepository,
        ResourceRepositoryInterface $groupRepository
    ) {
        $this->requestStack = $requestStack;
        $this->blockRepository = $blockRepository;
        $this->groupRepository = $groupRepository;
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

    public function contentBlock($group)
    {
        $request = $this->requestStack->getCurrentRequest();
        $group = $this->groupRepository->findOneBy(array('slug' => $group));
        $block = $group ? $this->blockRepository->findBlockInGroup($group, $request->getPathInfo() === '/') : null;

        return $block ? $block->getContent() : '';
    }
}
