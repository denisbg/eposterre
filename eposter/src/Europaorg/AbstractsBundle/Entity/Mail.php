<?php

namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Mail
 *
 * @ORM\Table(name="mail")
 * @ORM\Entity
 */
class Mail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMail", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmail;

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
     * @ORM\Column(name="message", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $message;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateAdd", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateadd;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, precision=0, scale=0, nullable=true, unique=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $subject;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $etat;


}

