<?php

namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Decision
 *
 * @ORM\Table(name="decision")
 * @ORM\Entity
 */
class Decision
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAbstract", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idabstract;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="decision", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $decision;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPassage", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idpassage;

    /**
     * @var integer
     *
     * @ORM\Column(name="idSession", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idsession;

    /**
     * @var string
     *
     * @ORM\Column(name="passageOrder", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
     */
    private $passageorder;

    /**
     * @var string
     *
     * @ORM\Column(name="speachTime", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $speachtime;

    /**
     * @var string
     *
     * @ORM\Column(name="discussionTime", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $discussiontime;

    /**
     * @var string
     *
     * @ORM\Column(name="starttime", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $starttime;

    /**
     * @var string
     *
     * @ORM\Column(name="endtime", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $endtime;

    /**
     * @var string
     *
     * @ORM\Column(name="writerComments", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $writercomments;

    /**
     * @var string
     *
     * @ORM\Column(name="comityComments", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $comitycomments;

    /**
     * @var string
     *
     * @ORM\Column(name="otherComments", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $othercomments;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptance", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptance;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceDateReply", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptancedatereply;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceEmailOtherPresenter", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceemailotherpresenter;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceOtherPresenter", type="string", length=150, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceotherpresenter;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceOtherPresenterTitle", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceotherpresentertitle;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceOtherPresenterLastName", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceotherpresenterlastname;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceOtherPresenterFirstName", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceotherpresenterfirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceOtherPresenterCity", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceotherpresentercity;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceOtherPresenterCountry", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceotherpresentercountry;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceOtherPresenterEmail", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceotherpresenteremail;

    /**
     * @var string
     *
     * @ORM\Column(name="authorAcceptanceOtherPresenterPhone", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authoracceptanceotherpresenterphone;

    /**
     * @var string
     *
     * @ORM\Column(name="adminComments", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $admincomments;

    /**
     * @var boolean
     *
     * @ORM\Column(name="viewedByUser", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $viewedbyuser;

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

    /**
     * @var string
     *
     * @ORM\Column(name="uploadFilePdf", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $uploadfilepdf;


}

