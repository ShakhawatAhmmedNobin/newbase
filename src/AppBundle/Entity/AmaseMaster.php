<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseMaster
 *
 * @ORM\Table(name="amase_master")
 * @ORM\Entity
 */
class AmaseMaster
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = 'open';

    /**
     * @var string
     *
     * @ORM\Column(name="student_id", type="string", length=15, nullable=false)
     */
    private $studentId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="projectname", type="text", length=65535, nullable=false)
     */
    private $projectname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ex_date", type="date", nullable=true)
     */
    private $exDate;

    /**
     * @var string
     *
     * @ORM\Column(name="university", type="string", length=40, nullable=false)
     */
    private $university = '';

    /**
     * @var string
     *
     * @ORM\Column(name="examiner1", type="string", length=60, nullable=false)
     */
    private $examiner1 = 'none';

    /**
     * @var string
     *
     * @ORM\Column(name="examiner2", type="string", length=60, nullable=false)
     */
    private $examiner2 = 'none';

    /**
     * @var string
     *
     * @ORM\Column(name="examiner_grade1", type="string", length=12, nullable=false)
     */
    private $examinerGrade1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="examiner_grade2", type="string", length=12, nullable=false)
     */
    private $examinerGrade2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="local_grade_master", type="string", length=6, nullable=false)
     */
    private $localGradeMaster = 'none';

    /**
     * @var string
     *
     * @ORM\Column(name="ects_grade", type="string", length=7, nullable=false)
     */
    private $ectsGrade = 'not set';

    /**
     * @var string
     *
     * @ORM\Column(name="credits_master", type="decimal", precision=3, scale=1, nullable=false)
     */
    private $creditsMaster = '0.0';

    /**
     * @var string
     *
     * @ORM\Column(name="try", type="string", length=11, nullable=false)
     */
    private $try = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="wer", type="string", length=40, nullable=false)
     */
    private $wer = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime", nullable=false)
     */
    private $datum = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="author_id", type="smallint", nullable=false)
     */
    private $authorId = '0';



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AmaseMaster
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return AmaseMaster
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set studentId
     *
     * @param string $studentId
     *
     * @return AmaseMaster
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;

        return $this;
    }

    /**
     * Get studentId
     *
     * @return string
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * Set projectname
     *
     * @param string $projectname
     *
     * @return AmaseMaster
     */
    public function setProjectname($projectname)
    {
        $this->projectname = $projectname;

        return $this;
    }

    /**
     * Get projectname
     *
     * @return string
     */
    public function getProjectname()
    {
        return $this->projectname;
    }

    /**
     * Set exDate
     *
     * @param \DateTime $exDate
     *
     * @return AmaseMaster
     */
    public function setExDate($exDate)
    {
        $this->exDate = $exDate;

        return $this;
    }

    /**
     * Get exDate
     *
     * @return \DateTime
     */
    public function getExDate()
    {
        return $this->exDate;
    }

    /**
     * Set university
     *
     * @param string $university
     *
     * @return AmaseMaster
     */
    public function setUniversity($university)
    {
        $this->university = $university;

        return $this;
    }

    /**
     * Get university
     *
     * @return string
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Set examiner1
     *
     * @param string $examiner1
     *
     * @return AmaseMaster
     */
    public function setExaminer1($examiner1)
    {
        $this->examiner1 = $examiner1;

        return $this;
    }

    /**
     * Get examiner1
     *
     * @return string
     */
    public function getExaminer1()
    {
        return $this->examiner1;
    }

    /**
     * Set examiner2
     *
     * @param string $examiner2
     *
     * @return AmaseMaster
     */
    public function setExaminer2($examiner2)
    {
        $this->examiner2 = $examiner2;

        return $this;
    }

    /**
     * Get examiner2
     *
     * @return string
     */
    public function getExaminer2()
    {
        return $this->examiner2;
    }

    /**
     * Set examinerGrade1
     *
     * @param string $examinerGrade1
     *
     * @return AmaseMaster
     */
    public function setExaminerGrade1($examinerGrade1)
    {
        $this->examinerGrade1 = $examinerGrade1;

        return $this;
    }

    /**
     * Get examinerGrade1
     *
     * @return string
     */
    public function getExaminerGrade1()
    {
        return $this->examinerGrade1;
    }

    /**
     * Set examinerGrade2
     *
     * @param string $examinerGrade2
     *
     * @return AmaseMaster
     */
    public function setExaminerGrade2($examinerGrade2)
    {
        $this->examinerGrade2 = $examinerGrade2;

        return $this;
    }

    /**
     * Get examinerGrade2
     *
     * @return string
     */
    public function getExaminerGrade2()
    {
        return $this->examinerGrade2;
    }

    /**
     * Set localGradeMaster
     *
     * @param string $localGradeMaster
     *
     * @return AmaseMaster
     */
    public function setLocalGradeMaster($localGradeMaster)
    {
        $this->localGradeMaster = $localGradeMaster;

        return $this;
    }

    /**
     * Get localGradeMaster
     *
     * @return string
     */
    public function getLocalGradeMaster()
    {
        return $this->localGradeMaster;
    }

    /**
     * Set ectsGrade
     *
     * @param string $ectsGrade
     *
     * @return AmaseMaster
     */
    public function setEctsGrade($ectsGrade)
    {
        $this->ectsGrade = $ectsGrade;

        return $this;
    }

    /**
     * Get ectsGrade
     *
     * @return string
     */
    public function getEctsGrade()
    {
        return $this->ectsGrade;
    }

    /**
     * Set creditsMaster
     *
     * @param string $creditsMaster
     *
     * @return AmaseMaster
     */
    public function setCreditsMaster($creditsMaster)
    {
        $this->creditsMaster = $creditsMaster;

        return $this;
    }

    /**
     * Get creditsMaster
     *
     * @return string
     */
    public function getCreditsMaster()
    {
        return $this->creditsMaster;
    }

    /**
     * Set try
     *
     * @param string $try
     *
     * @return AmaseMaster
     */
    public function setTry($try)
    {
        $this->try = $try;

        return $this;
    }

    /**
     * Get try
     *
     * @return string
     */
    public function getTry()
    {
        return $this->try;
    }

    /**
     * Set wer
     *
     * @param string $wer
     *
     * @return AmaseMaster
     */
    public function setWer($wer)
    {
        $this->wer = $wer;

        return $this;
    }

    /**
     * Get wer
     *
     * @return string
     */
    public function getWer()
    {
        return $this->wer;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return AmaseMaster
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set authorId
     *
     * @param integer $authorId
     *
     * @return AmaseMaster
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return integer
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }
}
