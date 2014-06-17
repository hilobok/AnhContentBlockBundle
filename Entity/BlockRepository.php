<?php

namespace Anh\ContentBlockBundle\Entity;

use Anh\DoctrineResource\ORM\ResourceRepository;
use Anh\ContentBlockBundle\Entity\Block;

class BlockRepository extends ResourceRepository
{
    public function findBlockForPosition($position, $isIndex)
    {
        $criteria = array(
            array(
                'position' => $position,
                'isDraft' => false,
                'visibility' => array(
                    Block::VISIBILITY_EVERYWHERE,
                    Block::VISIBILITY_NOT_ON_INDEX
                )
            ),
            array(
                'position' => $position,
                'isDraft' => false,
                'visibility' => array(
                    Block::VISIBILITY_EVERYWHERE,
                    Block::VISIBILITY_INDEX_ONLY
                )
            )
        );

        $blocks = $this->prepareQueryBuilder($criteria[$isIndex])
            ->getQuery()
            ->getResult()
        ;

        return $blocks ? $blocks[array_rand($blocks, 1)] : null;
    }
}