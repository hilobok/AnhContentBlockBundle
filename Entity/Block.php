<?php

namespace Anh\ContentBlockBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Block
 *
 * @ORM\Table(name="AnhContentBlock_Block", indexes={
 *      @ORM\Index(name="idx_title", columns={ "title" }),
 *      @ORM\Index(name="idx_createdAt", columns={ "createdAt" }),
 *      @ORM\Index(name="idx_updatedAt", columns={ "updatedAt" }),
 *      @ORM\Index(name="idx_visibility", columns={ "visibility" })
 * })
 * @ORM\Entity(repositoryClass="Anh\ContentBlockBundle\Entity\BlockRepository")
 */
class Block
{
    const VISIBILITY_EVERYWHERE = 'everywhere';
    const VISIBILITY_INDEX_ONLY = 'index_only';
    const VISIBILITY_NOT_ON_INDEX = 'not_on_index';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank
     */
    protected $title;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="blocks", fetch="EAGER")
     * @ORM\JoinColumn(name="groupId", referencedColumnName="id")
     */
    protected $group;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(type="string")
     */
    protected $visibility;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDraft", type="boolean")
     */
    protected $isDraft = false;

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     * @param string $title
     * @return Block
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get group
     * @return Group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set group
     * @param  Gropu $group
     * @return Block
     */
    public function setGroup(Group $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get createdAt
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     * @param  \DateTime $createdAt
     * @return Block
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get updatedAt
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     * @param  \DateTime $updatedAt
     * @return Block
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get visibility
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set visibility
     * @param string $visibility
     * @return Block
     */
    public function setVisibility($visibility)
    {
        if (!$this->isVisibilityValid($visibility)) {
            throw new \InvalidArgumentException(
                sprintf("Visiblity '%s' is not valid.", $visibility)
            );
        }

        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get content
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content
     * @param  string $content
     * @return Block
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get isDraft
     * @return boolean
     */
    public function getIsDraft()
    {
        return $this->isDraft;
    }

    /**
     * Set isDraft
     * @param  boolean $isDraft
     * @return Block
     */
    public function setIsDraft($isDraft)
    {
        $this->isDraft = $isDraft;

        return $this;
    }

    /**
     * Check if visibility is valid
     * @param  string  $visibility
     * @return boolean
     */
    protected function isVisibilityValid($visibility)
    {
        return in_array($visibility, array(
            self::VISIBILITY_EVERYWHERE,
            self::VISIBILITY_INDEX_ONLY,
            self::VISIBILITY_NOT_ON_INDEX
        ), true);
    }
}
