<?php

namespace Europaorg\AbstractsBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Abstracts
 *
 * @ORM\Table(name="abstracts")
 * @ORM\Entity
 */
class Abstracts
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
     * @ORM\Column(name="idUser", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCategory", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idcategory;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPassage", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idpassage;

    /**
     * @var string
     *
     * @ORM\Column(name="idDefinitive", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
     */
    private $iddefinitive;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="data1", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data1;

    /**
     * @var string
     *
     * @ORM\Column(name="data2", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data2;

    /**
     * @var string
     *
     * @ORM\Column(name="data3", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data3;

    /**
     * @var string
     *
     * @ORM\Column(name="data4", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data4;

    /**
     * @var string
     *
     * @ORM\Column(name="data5", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data5;

    /**
     * @var string
     *
     * @ORM\Column(name="data6", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data6;

    /**
     * @var string
     *
     * @ORM\Column(name="data7", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data7;

    /**
     * @var string
     *
     * @ORM\Column(name="data8", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data8;

    /**
     * @var string
     *
     * @ORM\Column(name="data9", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data9;

    /**
     * @var string
     *
     * @ORM\Column(name="data10", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data10;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="additional", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $additional;

    /**
     * @var string
     *
     * @ORM\Column(name="custom1", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom1;

    /**
     * @var string
     *
     * @ORM\Column(name="custom2", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom2;

    /**
     * @var string
     *
     * @ORM\Column(name="custom3", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom3;

    /**
     * @var string
     *
     * @ORM\Column(name="custom4", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom4;

    /**
     * @var string
     *
     * @ORM\Column(name="custom5", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="viewedByAdmin", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $viewedbyadmin;

    /**
     * @var string
     *
     * @ORM\Column(name="viewedBySuperReader", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $viewedbysuperreader;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allowModification", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $allowmodification;

    /**
     * @var string
     *
     * @ORM\Column(name="commentsAdmin", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $commentsadmin;

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
     * @ORM\Column(name="dateDeleted", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $datedeleted;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUserDeleted", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $iduserdeleted;

    /**
     * @var string
     *
     * @ORM\Column(name="dateUpdate", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateupdate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mailReviewerSent", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $mailreviewersent;

    /**
     * @return int
     */
    public function getIdabstract()
    {
        return $this->idabstract;
    }

    /**
     * @param int $idabstract
     */
    public function setIdabstract($idabstract)
    {
        $this->idabstract = $idabstract;
    }

    /**
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param int $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return int
     */
    public function getIdcategory()
    {
        return $this->idcategory;
    }

    /**
     * @param int $idcategory
     */
    public function setIdcategory($idcategory)
    {
        $this->idcategory = $idcategory;
    }

    /**
     * @return int
     */
    public function getIdpassage()
    {
        return $this->idpassage;
    }

    /**
     * @param int $idpassage
     */
    public function setIdpassage($idpassage)
    {
        $this->idpassage = $idpassage;
    }

    /**
     * @return string
     */
    public function getIddefinitive()
    {
        return $this->iddefinitive;
    }

    /**
     * @param string $iddefinitive
     */
    public function setIddefinitive($iddefinitive)
    {
        $this->iddefinitive = $iddefinitive;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getData1()
    {
        return $this->data1;
    }

    /**
     * @param string $data1
     */
    public function setData1($data1)
    {
        $this->data1 = $data1;
    }

    /**
     * @return string
     */
    public function getData2()
    {
        return $this->data2;
    }

    /**
     * @param string $data2
     */
    public function setData2($data2)
    {
        $this->data2 = $data2;
    }

    /**
     * @return string
     */
    public function getData3()
    {
        return $this->data3;
    }

    /**
     * @param string $data3
     */
    public function setData3($data3)
    {
        $this->data3 = $data3;
    }

    /**
     * @return string
     */
    public function getData4()
    {
        return $this->data4;
    }

    /**
     * @param string $data4
     */
    public function setData4($data4)
    {
        $this->data4 = $data4;
    }

    /**
     * @return string
     */
    public function getData5()
    {
        return $this->data5;
    }

    /**
     * @param string $data5
     */
    public function setData5($data5)
    {
        $this->data5 = $data5;
    }

    /**
     * @return string
     */
    public function getData6()
    {
        return $this->data6;
    }

    /**
     * @param string $data6
     */
    public function setData6($data6)
    {
        $this->data6 = $data6;
    }

    /**
     * @return string
     */
    public function getData7()
    {
        return $this->data7;
    }

    /**
     * @param string $data7
     */
    public function setData7($data7)
    {
        $this->data7 = $data7;
    }

    /**
     * @return string
     */
    public function getData8()
    {
        return $this->data8;
    }

    /**
     * @param string $data8
     */
    public function setData8($data8)
    {
        $this->data8 = $data8;
    }

    /**
     * @return string
     */
    public function getData9()
    {
        return $this->data9;
    }

    /**
     * @param string $data9
     */
    public function setData9($data9)
    {
        $this->data9 = $data9;
    }

    /**
     * @return string
     */
    public function getData10()
    {
        return $this->data10;
    }

    /**
     * @param string $data10
     */
    public function setData10($data10)
    {
        $this->data10 = $data10;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * @param string $additional
     */
    public function setAdditional($additional)
    {
        $this->additional = $additional;
    }

    /**
     * @return string
     */
    public function getCustom1()
    {
        return $this->custom1;
    }

    /**
     * @param string $custom1
     */
    public function setCustom1($custom1)
    {
        $this->custom1 = $custom1;
    }

    /**
     * @return string
     */
    public function getCustom2()
    {
        return $this->custom2;
    }

    /**
     * @param string $custom2
     */
    public function setCustom2($custom2)
    {
        $this->custom2 = $custom2;
    }

    /**
     * @return string
     */
    public function getCustom3()
    {
        return $this->custom3;
    }

    /**
     * @param string $custom3
     */
    public function setCustom3($custom3)
    {
        $this->custom3 = $custom3;
    }

    /**
     * @return string
     */
    public function getCustom4()
    {
        return $this->custom4;
    }

    /**
     * @param string $custom4
     */
    public function setCustom4($custom4)
    {
        $this->custom4 = $custom4;
    }

    /**
     * @return string
     */
    public function getCustom5()
    {
        return $this->custom5;
    }

    /**
     * @param string $custom5
     */
    public function setCustom5($custom5)
    {
        $this->custom5 = $custom5;
    }

    /**
     * @return boolean
     */
    public function isViewedbyadmin()
    {
        return $this->viewedbyadmin;
    }

    /**
     * @param boolean $viewedbyadmin
     */
    public function setViewedbyadmin($viewedbyadmin)
    {
        $this->viewedbyadmin = $viewedbyadmin;
    }

    /**
     * @return string
     */
    public function getViewedbysuperreader()
    {
        return $this->viewedbysuperreader;
    }

    /**
     * @param string $viewedbysuperreader
     */
    public function setViewedbysuperreader($viewedbysuperreader)
    {
        $this->viewedbysuperreader = $viewedbysuperreader;
    }

    /**
     * @return boolean
     */
    public function isAllowmodification()
    {
        return $this->allowmodification;
    }

    /**
     * @param boolean $allowmodification
     */
    public function setAllowmodification($allowmodification)
    {
        $this->allowmodification = $allowmodification;
    }

    /**
     * @return string
     */
    public function getCommentsadmin()
    {
        return $this->commentsadmin;
    }

    /**
     * @param string $commentsadmin
     */
    public function setCommentsadmin($commentsadmin)
    {
        $this->commentsadmin = $commentsadmin;
    }

    /**
     * @return boolean
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param boolean $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return string
     */
    public function getDateadd()
    {
        return $this->dateadd;
    }

    /**
     * @param string $dateadd
     */
    public function setDateadd($dateadd)
    {
        $this->dateadd = $dateadd;
    }

    /**
     * @return string
     */
    public function getDatedeleted()
    {
        return $this->datedeleted;
    }

    /**
     * @param string $datedeleted
     */
    public function setDatedeleted($datedeleted)
    {
        $this->datedeleted = $datedeleted;
    }

    /**
     * @return int
     */
    public function getIduserdeleted()
    {
        return $this->iduserdeleted;
    }

    /**
     * @param int $iduserdeleted
     */
    public function setIduserdeleted($iduserdeleted)
    {
        $this->iduserdeleted = $iduserdeleted;
    }

    /**
     * @return string
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * @param string $dateupdate
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;
    }

    /**
     * @return boolean
     */
    public function isMailreviewersent()
    {
        return $this->mailreviewersent;
    }

    /**
     * @param boolean $mailreviewersent
     */
    public function setMailreviewersent($mailreviewersent)
    {
        $this->mailreviewersent = $mailreviewersent;
    }


}

