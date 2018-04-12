<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseGrades
 *
 * @ORM\Table(name="amase_grades", indexes={@ORM\Index(name="name", columns={"name"})})
 * @ORM\Entity
 */
class AmaseGrades
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
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="university", type="string", length=20, nullable=false)
     */
    private $university = '';

    /**
     * @var string
     *
     * @ORM\Column(name="coursename", type="text", length=65535, nullable=false)
     */
    private $coursename;

    /**
     * @var integer
     *
     * @ORM\Column(name="course_id", type="integer", nullable=false)
     */
    private $courseId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = 'grade';

    /**
     * @var string
     *
     * @ORM\Column(name="student_id", type="string", length=15, nullable=false)
     */
    private $studentId = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ex_date", type="date", nullable=true)
     */
    private $exDate;

    /**
     * @var string
     *
     * @ORM\Column(name="modul", type="string", length=100, nullable=false)
     */
    private $modul = '';

    /**
     * @var string
     *
     * @ORM\Column(name="local_grade", type="string", length=12, nullable=false)
     */
    private $localGrade = 'none';

    /**
     * @var string
     *
     * @ORM\Column(name="ects_grade", type="string", length=12, nullable=false)
     */
    private $ectsGrade = '0.0';

    /**
     * @var string
     *
     * @ORM\Column(name="credits", type="decimal", precision=3, scale=1, nullable=false)
     */
    private $credits = '0.0';

    /**
     * @var string
     *
     * @ORM\Column(name="try", type="string", length=11, nullable=false)
     */
    private $try = '1st attempt';

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
     * @return AmaseGrades
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
     * Set university
     *
     * @param string $university
     *
     * @return AmaseGrades
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
     * Set coursename
     *
     * @param string $coursename
     *
     * @return AmaseGrades
     */
    public function setCoursename($coursename)
    {
        $this->coursename = $coursename;

        return $this;
    }

    /**
     * Get coursename
     *
     * @return string
     */
    public function getCoursename()
    {
        return $this->coursename;
    }

    /**
     * Set courseId
     *
     * @param integer $courseId
     *
     * @return AmaseGrades
     */
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;

        return $this;
    }

    /**
     * Get courseId
     *
     * @return integer
     */
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return AmaseGrades
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
     * @return AmaseGrades
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
     * Set exDate
     *
     * @param \DateTime $exDate
     *
     * @return AmaseGrades
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
     * Set modul
     *
     * @param string $modul
     *
     * @return AmaseGrades
     */
    public function setModul($modul)
    {
        $this->modul = $modul;

        return $this;
    }

    /**
     * Get modul
     *
     * @return string
     */
    public function getModul()
    {
        return $this->modul;
    }

    /**
     * Set localGrade
     *
     * @param string $localGrade
     *
     * @return AmaseGrades
     */
    public function setLocalGrade($localGrade)
    {
        $this->localGrade = $localGrade;

        return $this;
    }

    /**
     * Get localGrade
     *
     * @return string
     */
    public function getLocalGrade()
    {
        $localGrade = $this->localGrade;
        str_replace(',', '.', $localGrade);
        return $localGrade;
    }

    /**
     * Set ectsGrade
     *
     * @param string $ectsGrade
     *
     * @return AmaseGrades
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
     * Set credits
     *
     * @param string $credits
     *
     * @return AmaseGrades
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get credits
     *
     * @return string
     */
    public function getCredits()
    {
        $credits = $this->credits;
        str_replace(',', '.', $credits);
        return $credits;
    }

    /**
     * Set try
     *
     * @param string $try
     *
     * @return AmaseGrades
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
     * @return AmaseGrades
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
     * @return AmaseGrades
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
     * @return AmaseGrades
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
