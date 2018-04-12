<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseCourses
 *
 * @ORM\Table(name="amase_courses")
 * @ORM\Entity
 */
class AmaseCourses
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
     * @ORM\Column(name="modules_tracks", type="string", length=200, nullable=false)
     */
    private $modulesTracks = '';

    /**
     * @var string
     *
     * @ORM\Column(name="english_description", type="string", length=200, nullable=false)
     */
    private $englishDescription = '';

    /**
     * @var string
     *
     * @ORM\Column(name="local_description", type="string", length=200, nullable=false)
     */
    private $localDescription = '';

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20, nullable=false)
     */
    private $code = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="ects", type="integer", nullable=false)
     */
    private $ects = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="university", type="string", length=20, nullable=false)
     */
    private $university = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="semester", type="integer", nullable=false)
     */
    private $semester = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="wer", type="string", length=200, nullable=false)
     */
    private $wer = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime", nullable=false)
     */
    private $datum = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     *
     * @ORM\Column(name="author_id", type="boolean", nullable=false)
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
     * Set modulesTracks
     *
     * @param string $modulesTracks
     *
     * @return AmaseCourses
     */
    public function setModulesTracks($modulesTracks)
    {
        $this->modulesTracks = $modulesTracks;

        return $this;
    }

    /**
     * Get modulesTracks
     *
     * @return string
     */
    public function getModulesTracks()
    {
        return $this->modulesTracks;
    }

    /**
     * Set englishDescription
     *
     * @param string $englishDescription
     *
     * @return AmaseCourses
     */
    public function setEnglishDescription($englishDescription)
    {
        $this->englishDescription = $englishDescription;

        return $this;
    }

    /**
     * Get englishDescription
     *
     * @return string
     */
    public function getEnglishDescription()
    {
        return $this->englishDescription;
    }

    /**
     * Set localDescription
     *
     * @param string $localDescription
     *
     * @return AmaseCourses
     */
    public function setLocalDescription($localDescription)
    {
        $this->localDescription = $localDescription;

        return $this;
    }

    /**
     * Get localDescription
     *
     * @return string
     */
    public function getLocalDescription()
    {
        return $this->localDescription;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return AmaseCourses
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set ects
     *
     * @param integer $ects
     *
     * @return AmaseCourses
     */
    public function setEcts($ects)
    {
        $this->ects = $ects;

        return $this;
    }

    /**
     * Get ects
     *
     * @return integer
     */
    public function getEcts()
    {
        return $this->ects;
    }

    /**
     * Set university
     *
     * @param string $university
     *
     * @return AmaseCourses
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
     * Set semester
     *
     * @param integer $semester
     *
     * @return AmaseCourses
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;

        return $this;
    }

    /**
     * Get semester
     *
     * @return integer
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * Set wer
     *
     * @param string $wer
     *
     * @return AmaseCourses
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
     * @return AmaseCourses
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
     * @param boolean $authorId
     *
     * @return AmaseCourses
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return boolean
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }
}
