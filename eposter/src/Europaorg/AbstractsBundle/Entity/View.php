<?php

namespace EuropaorgAbstractsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * View
 *
 * @ORM\Table(name="view")
 * @ORM\Entity
 */
class View
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAbstract", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idabstract;

    /**
     * @var integer
     *
     * @ORM\Column(name="view", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $view;


}

