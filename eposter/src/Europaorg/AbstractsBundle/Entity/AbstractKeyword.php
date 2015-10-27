<?php

namespace EuropaorgAbstractsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AbstractKeyword
 *
 * @ORM\Table(name="abstract-keyword")
 * @ORM\Entity
 */
class AbstractKeyword
{
    /**
     * @var integer
     *
     * @ORM\Column(name="abstract_idAbstract", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $abstractIdabstract;

    /**
     * @var integer
     *
     * @ORM\Column(name="keyword_idKeyword", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $keywordIdkeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="dataAbstractkeyword", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dataabstractkeyword;


}

