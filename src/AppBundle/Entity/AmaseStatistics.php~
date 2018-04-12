<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseStatistics
 *
 * @ORM\Table(name="amase_statistics")
 * @ORM\Entity
 */
class AmaseStatistics
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
     * @ORM\Column(name="lastname", type="string", length=100, nullable=false)
     */
    private $lastname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=100, nullable=false)
     */
    private $firstname = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="university", type="boolean", nullable=false)
     */
    private $university = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="average_grade", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $averageGrade = '0.00';

    /**
     * @var boolean
     *
     * @ORM\Column(name="choice", type="boolean", nullable=false)
     */
    private $choice = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="student_id", type="integer", nullable=false)
     */
    private $studentId = '0';



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
     * Set lastname
     *
     * @param string $lastname
     *
     * @return AmaseStatistics
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return AmaseStatistics
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set university
     *
     * @param boolean $university
     *
     * @return AmaseStatistics
     */
    public function setUniversity($university)
    {
        $this->university = $university;

        return $this;
    }

    /**
     * Get university
     *
     * @return boolean
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * Set averageGrade
     *
     * @param string $averageGrade
     *
     * @return AmaseStatistics
     */
    public function setAverageGrade($averageGrade)
    {
        $this->averageGrade = $averageGrade;

        return $this;
    }

    /**
     * Get averageGrade
     *
     * @return string
     */
    public function getAverageGrade()
    {
        return $this->averageGrade;
    }

    /**
     * Set choice
     *
     * @param boolean $choice
     *
     * @return AmaseStatistics
     */
    public function setChoice($choice)
    {
        $this->choice = $choice;

        return $this;
    }

    /**
     * Get choice
     *
     * @return boolean
     */
    public function getChoice()
    {
        return $this->choice;
    }

    /**
     * Set studentId
     *
     * @param integer $studentId
     *
     * @return AmaseStatistics
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;

        return $this;
    }

    /**
     * Get studentId
     *
     * @return integer
     */
    public function getStudentId()
    {
        return $this->studentId;
    }
}
