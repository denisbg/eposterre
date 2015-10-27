<?php

namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * KeywordThemePcr
 *
 * @ORM\Table(name="keyword-theme-pcr")
 * @ORM\Entity
 */
class KeywordThemePcr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTheme", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtheme;

    /**
     * @var string
     *
     * @ORM\Column(name="themeData", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $themedata;

    /**
     * @var integer
     *
     * @ORM\Column(name="themeOrder", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $themeorder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;


}

