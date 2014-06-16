<?php

namespace Anh\ContentBlockBundle\Entity;

use Anh\DoctrineResource\ORM\ResourceRepository;
use Anh\ContentBlockBundle\Entity\Block;
use Anh\ContentBlockBundle\Entity\Group;

class BlockRepository extends ResourceRepository
{
    public function findBlockInGroup(Group $group, $isIndex)
    {
        $criteria = array(
            array(
                'group' => $group,
                'isDraft' => false,
                'visibility' => array(
                    Block::VISIBILITY_EVERYWHERE,
                    Block::VISIBILITY_NOT_ON_INDEX
                )
            ),
            array(
                'group' => $group,
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