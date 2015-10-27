<?php
namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity
 */
class Note
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idNote", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnote;

    /**
     * @var integer
     *
     * @ORM\Column(name="idAbstract", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idabstract;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="dateAdd", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateadd;


}

