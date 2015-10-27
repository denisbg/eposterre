<?php
namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCategory", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategory;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCategoryUp", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idcategoryup;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="selectable", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $selectable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="online", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $online;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;

    /**
     * @var string
     *
     * @ORM\Column(name="dateAdd", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateadd;

    /**
     * @var string
     *
     * @ORM\Column(name="dateUpdate", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateupdate;


}

