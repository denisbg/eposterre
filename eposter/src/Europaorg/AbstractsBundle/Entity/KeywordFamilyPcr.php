<?php

namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * KeywordFamilyPcr
 *
 * @ORM\Table(name="keyword-family-pcr")
 * @ORM\Entity
 */
class KeywordFamilyPcr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idFamily", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfamily;

    /**
     * @var integer
     *
     * @ORM\Column(name="idTheme", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idtheme;

    /**
     * @var string
     *
     * @ORM\Column(name="familyData", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $familydata;

    /**
     * @var integer
     *
     * @ORM\Column(name="familyOrder", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $familyorder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="multipleChoice", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $multiplechoice;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;


}

