<?php

namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * KeywordPcr
 *
 * @ORM\Table(name="keyword-pcr")
 * @ORM\Entity
 */
class KeywordPcr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idKeyword", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idkeyword;

    /**
     * @var integer
     *
     * @ORM\Column(name="idFamily", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idfamily;

    /**
     * @var string
     *
     * @ORM\Column(name="keywordData", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $keyworddata;

    /**
     * @var integer
     *
     * @ORM\Column(name="keywordOrder", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $keywordorder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $deleted;


}

