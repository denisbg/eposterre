<?php

namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idComment", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcomment;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAbstract", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idabstract;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateAdd", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateadd;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;


}
