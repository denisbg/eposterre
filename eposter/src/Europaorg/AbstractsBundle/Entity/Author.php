<?php

namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity
 */
class Author
{
    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $order;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAbstract", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idabstract;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $firstname;

    /**
     * @var integer
     *
     * @ORM\Column(name="idSpeciality", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idspeciality;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=30, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="initials", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $initials;

    /**
     * @var string
     *
     * @ORM\Column(name="institution", type="string", length=5000, precision=0, scale=0, nullable=false, unique=false)
     */
    private $institution;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=5000, precision=0, scale=0, nullable=false, unique=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=5000, precision=0, scale=0, nullable=false, unique=false)
     */
    private $country;

    /**
     * @var boolean
     *
     * @ORM\Column(name="main", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $main;

    /**
     * @var boolean
     *
     * @ORM\Column(name="presenting", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $presenting;

    /**
     * @var boolean
     *
     * @ORM\Column(name="corresponding", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $corresponding;

    /**
     * @var string
     *
     * @ORM\Column(name="function", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $function;

    /**
     * @var string
     *
     * @ORM\Column(name="emailPresenting", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $emailpresenting;


}

