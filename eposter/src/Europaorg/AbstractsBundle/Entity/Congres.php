<?php

namespace EuropaorgAbstractsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Congres
 *
 * @ORM\Table(name="congres")
 * @ORM\Entity
 */
class Congres
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCongres", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcongres;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="article", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=2, precision=0, scale=0, nullable=false, unique=false)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=150, precision=0, scale=0, nullable=false, unique=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="cssFile", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $cssfile;

    /**
     * @var string
     *
     * @ORM\Column(name="headerFile", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $headerfile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDisplayedHeaderTitle", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isdisplayedheadertitle;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="nameResponsible", type="string", length=150, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nameresponsible;

    /**
     * @var string
     *
     * @ORM\Column(name="emailResponsible", type="string", length=150, precision=0, scale=0, nullable=false, unique=false)
     */
    private $emailresponsible;

    /**
     * @var string
     *
     * @ORM\Column(name="dateBegin", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $datebegin;

    /**
     * @var string
     *
     * @ORM\Column(name="dateEnd", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateend;

    /**
     * @var string
     *
     * @ORM\Column(name="dateBeginSubmit", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $datebeginsubmit;

    /**
     * @var string
     *
     * @ORM\Column(name="dateEndSubmit", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateendsubmit;

    /**
     * @var string
     *
     * @ORM\Column(name="dateBeginSelect", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $datebeginselect;

    /**
     * @var string
     *
     * @ORM\Column(name="dateEndSelect", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateendselect;

    /**
     * @var string
     *
     * @ORM\Column(name="dateResults", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateresults;

    /**
     * @var string
     *
     * @ORM\Column(name="durationchoicePost", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $durationchoicepost;

    /**
     * @var string
     *
     * @ORM\Column(name="durationPost", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
     */
    private $durationpost;

    /**
     * @var boolean
     *
     * @ORM\Column(name="anonymousPost", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $anonymouspost;

    /**
     * @var string
     *
     * @ORM\Column(name="maxAbstractSize", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
     */
    private $maxabstractsize;

    /**
     * @var boolean
     *
     * @ORM\Column(name="withSpaces", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $withspaces;

    /**
     * @var string
     *
     * @ORM\Column(name="acceptUpload", type="string", length=50, precision=0, scale=0, nullable=false, unique=false)
     */
    private $acceptupload;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceptEditor", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $accepteditor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceptPrivateComments", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $acceptprivatecomments;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceptAuthorComments", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $acceptauthorcomments;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceptConflict", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $acceptconflict;

    /**
     * @var string
     *
     * @ORM\Column(name="authorsSelection", type="string", length=40, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authorsselection;

    /**
     * @var boolean
     *
     * @ORM\Column(name="authorsResults", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $authorsresults;

    /**
     * @var boolean
     *
     * @ORM\Column(name="authorsResultsWithComments", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $authorsresultswithcomments;

    /**
     * @var string
     *
     * @ORM\Column(name="authorsGroupBy", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $authorsgroupby;

    /**
     * @var boolean
     *
     * @ORM\Column(name="authorsLastNameInFirst", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $authorslastnameinfirst;

    /**
     * @var string
     *
     * @ORM\Column(name="abstractsTitle", type="string", length=40, precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractstitle;

    /**
     * @var string
     *
     * @ORM\Column(name="urlInscription", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $urlinscription;

    /**
     * @var boolean
     *
     * @ORM\Column(name="idInstructionsLoginDisplay", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $idinstructionslogindisplay;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsLogin", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionslogin;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsLogin2", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionslogin2;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsLogin3", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionslogin3;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsLogin4", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionslogin4;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsIndexWriters", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionsindexwriters;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsWriters1", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionswriters1;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsWriters2", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionswriters2;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsWriters2-supp", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionswriters2Supp;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsWriters3", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionswriters3;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsWriters4", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionswriters4;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsWriters5", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionswriters5;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsWriters5-supp", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionswriters5Supp;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsWriters6", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionswriters6;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsReaders", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionsreaders;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsSuperReader", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $instructionssuperreader;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsAbstractRefused", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $instructionsabstractrefused;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsAbstractWaitingList", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $instructionsabstractwaitinglist;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsFAQ", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionsfaq;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsInvitationemptyabstract", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionsinvitationemptyabstract;

    /**
     * @var string
     *
     * @ORM\Column(name="attestationTexte", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $attestationtexte;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmationMail", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $confirmationmail;

    /**
     * @var string
     *
     * @ORM\Column(name="deletionMail", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $deletionmail;

    /**
     * @var string
     *
     * @ORM\Column(name="acceptanceMail", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $acceptancemail;

    /**
     * @var string
     *
     * @ORM\Column(name="passwordMail", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $passwordmail;

    /**
     * @var string
     *
     * @ORM\Column(name="registrationMail", type="text", length=65535, precision=0, scale=0, nullable=false, unique=false)
     */
    private $registrationmail;

    /**
     * @var string
     *
     * @ORM\Column(name="custom1", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom1;

    /**
     * @var string
     *
     * @ORM\Column(name="custom1Negative", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom1negative;

    /**
     * @var string
     *
     * @ORM\Column(name="custom2", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom2;

    /**
     * @var string
     *
     * @ORM\Column(name="custom2Negative", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom2negative;

    /**
     * @var string
     *
     * @ORM\Column(name="custom3", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom3;

    /**
     * @var string
     *
     * @ORM\Column(name="custom3Negative", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom3negative;

    /**
     * @var string
     *
     * @ORM\Column(name="custom4", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom4;

    /**
     * @var string
     *
     * @ORM\Column(name="custom4Negative", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom4negative;

    /**
     * @var string
     *
     * @ORM\Column(name="custom5", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom5;

    /**
     * @var string
     *
     * @ORM\Column(name="custom5Negative", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $custom5negative;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultCustom1", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $defaultcustom1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultCustom2", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $defaultcustom2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultCustom3", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $defaultcustom3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultCustom4", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $defaultcustom4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultCustom5", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $defaultcustom5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data1", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data1Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data1required;

    /**
     * @var string
     *
     * @ORM\Column(name="data1Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data1title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data1AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data1acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data1AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data1accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data1Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data1limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data2", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data2Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data2required;

    /**
     * @var string
     *
     * @ORM\Column(name="data2Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data2title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data2AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data2acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data2AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data2accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data2Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data2limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data3", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data3Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data3required;

    /**
     * @var string
     *
     * @ORM\Column(name="data3Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data3title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data3AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data3acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data3AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data3accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data3Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data3limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data4", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data4;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data4Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data4required;

    /**
     * @var string
     *
     * @ORM\Column(name="data4Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data4title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data4AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data4acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data4AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data4accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data4Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data4limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data5", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data5;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data5Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data5required;

    /**
     * @var string
     *
     * @ORM\Column(name="data5Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data5title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data5AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data5acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data5AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data5accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data5Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data5limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data6", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data6;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data6Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data6required;

    /**
     * @var string
     *
     * @ORM\Column(name="data6Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data6title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data6AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data6acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data6AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data6accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data6Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data6limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data7", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data7;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data7Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data7required;

    /**
     * @var string
     *
     * @ORM\Column(name="data7Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data7title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data7AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data7acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data7AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data7accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data7Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data7limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data8", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data8;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data8Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data8required;

    /**
     * @var string
     *
     * @ORM\Column(name="data8Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data8title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data8AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data8acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data8AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data8accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data8Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data8limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data9", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data9;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data9Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data9required;

    /**
     * @var string
     *
     * @ORM\Column(name="data9Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data9title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data9AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data9acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data9AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data9accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data9Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data9limitation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data10", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data10;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data10Required", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data10required;

    /**
     * @var string
     *
     * @ORM\Column(name="data10Title", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $data10title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data10AcceptImages", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data10acceptimages;

    /**
     * @var boolean
     *
     * @ORM\Column(name="data10AcceptTables", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $data10accepttables;

    /**
     * @var integer
     *
     * @ORM\Column(name="data10Limitation", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $data10limitation;

    /**
     * @var string
     *
     * @ORM\Column(name="abstractHeaderShow", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheadershow;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderIdentifier", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheaderidentifier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderIdDefinitive", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheaderiddefinitive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderCategory", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheadercategory;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderContact", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheadercontact;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderPreference", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheaderpreference;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderSubmissionDate", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheadersubmissiondate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderAdditional", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheaderadditional;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderCustoms", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheadercustoms;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractTitleShow", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstracttitleshow;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractAuthorsShow", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractauthorsshow;

    /**
     * @var string
     *
     * @ORM\Column(name="abstractTitleStyle", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstracttitlestyle;

    /**
     * @var string
     *
     * @ORM\Column(name="abstractTextStyle", type="string", length=250, precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstracttextstyle;

    /**
     * @var string
     *
     * @ORM\Column(name="abstractName", type="string", length=30, precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractname;

    /**
     * @var string
     *
     * @ORM\Column(name="assessName", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $assessname;

    /**
     * @var string
     *
     * @ORM\Column(name="acceptFormats", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $acceptformats;

    /**
     * @var boolean
     *
     * @ORM\Column(name="renameFiles", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $renamefiles;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showInstructions", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showinstructions;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceptSubscriptions", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $acceptsubscriptions;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showCategories", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showcategories;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showKeywords", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showkeywords;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showAuthors", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showauthors;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showTitlePrefs", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showtitleprefs;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showTexts", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showtexts;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showFiles", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showfiles;

    /**
     * @var boolean
     *
     * @ORM\Column(name="otherKeyword", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $otherkeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="typeKeyword", type="string", length=15, precision=0, scale=0, nullable=false, unique=false)
     */
    private $typekeyword;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbKeywordMin", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $nbkeywordmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbKeywordMax", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $nbkeywordmax;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractHeaderKeyword", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractheaderkeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="minAbstractSize", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
     */
    private $minabstractsize;

    /**
     * @var boolean
     *
     * @ORM\Column(name="superReaderModify", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $superreadermodify;

    /**
     * @var boolean
     *
     * @ORM\Column(name="superReaderAssign", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $superreaderassign;

    /**
     * @var boolean
     *
     * @ORM\Column(name="authorsConfirmationParticipation", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $authorsconfirmationparticipation;

    /**
     * @var string
     *
     * @ORM\Column(name="readerinvitationMail", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $readerinvitationmail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emailReviewer", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $emailreviewer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="phoneRequired", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $phonerequired;

    /**
     * @var boolean
     *
     * @ORM\Column(name="authorSpeciality", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $authorspeciality;

    /**
     * @var boolean
     *
     * @ORM\Column(name="titleIncludeSymbols", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $titleincludesymbols;

    /**
     * @var boolean
     *
     * @ORM\Column(name="institutionMultiple", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $institutionmultiple;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defaultForm", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $defaultform;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notation", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $notation;

    /**
     * @var string
     *
     * @ORM\Column(name="abstractsOrderOnReaderPage", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractsorderonreaderpage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="passageOrderComptageAuto", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $passageordercomptageauto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="denyAccessReaderSameCountry", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $denyaccessreadersamecountry;

    /**
     * @var boolean
     *
     * @ORM\Column(name="showUploadPDFResults", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $showuploadpdfresults;

    /**
     * @var string
     *
     * @ORM\Column(name="instructionsUploadPDFResults", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $instructionsuploadpdfresults;

    /**
     * @var boolean
     *
     * @ORM\Column(name="institutionMandatory", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $institutionmandatory;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dateEndSubmitShow", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $dateendsubmitshow;

    /**
     * @var boolean
     *
     * @ORM\Column(name="abstractContactAuthorShow", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $abstractcontactauthorshow;

    /**
     * @var string
     *
     * @ORM\Column(name="programSystem", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $programsystem;

    /**
     * @var string
     *
     * @ORM\Column(name="sentenceFirstConnection", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $sentencefirstconnection;

    /**
     * @var string
     *
     * @ORM\Column(name="sentenceConnection", type="text", length=65535, precision=0, scale=0, nullable=true, unique=false)
     */
    private $sentenceconnection;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sentenceFirstConnectionShow", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sentencefirstconnectionshow;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sentenceConnectionShow", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $sentenceconnectionshow;

    /**
     * @var boolean
     *
     * @ORM\Column(name="titleExportShow", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $titleexportshow;

    /**
     * @var boolean
     *
     * @ORM\Column(name="headerUcfirst", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $headerucfirst;

    /**
     * @var boolean
     *
     * @ORM\Column(name="emailPresentingMandatory", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $emailpresentingmandatory;


}

