<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseStudents
 *
 * @ORM\Table(name="amase_students", indexes={@ORM\Index(name="vorname", columns={"nachname"}), @ORM\Index(name="nachname", columns={"vorname"})})
 * @ORM\Entity
 */
class AmaseStudents
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
     * @ORM\Column(name="nachname", type="string", length=150, nullable=false)
     */
    private $nachname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="vorname", type="string", length=150, nullable=false)
     */
    private $vorname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", nullable=false)
     */
    private $gender = 'male';

    /**
     * @var string
     *
     * @ORM\Column(name="university1", type="string", length=10, nullable=false)
     */
    private $university1 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="matrikel1", type="string", length=20, nullable=false)
     */
    private $matrikel1 = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="university2", type="string", length=10, nullable=false)
     */
    private $university2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="matrikel2", type="string", length=20, nullable=false)
     */
    private $matrikel2 = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="universitymaster", type="string", length=20, nullable=false)
     */
    private $universitymaster = '';

    /**
     * @var string
     *
     * @ORM\Column(name="start_semester", type="string", length=20, nullable=false)
     */
    private $startSemester = '';

    /**
     * @var string
     *
     * @ORM\Column(name="study_semester", type="string", nullable=false)
     */
    private $studySemester = 'not set';

    /**
     * @var string
     *
     * @ORM\Column(name="complete", type="string", length=6, nullable=false)
     */
    private $complete = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date", nullable=false)
     */
    private $birthDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="birth_place", type="string", length=100, nullable=false)
     */
    private $birthPlace = '';

    /**
     * @var string
     *
     * @ORM\Column(name="country_birth", type="string", length=100, nullable=false)
     */
    private $countryBirth = '';

    /**
     * @var string
     *
     * @ORM\Column(name="geburtsort", type="string", length=100, nullable=false)
     */
    private $geburtsort = '';

    /**
     * @var string
     *
     * @ORM\Column(name="geburtsland", type="string", length=100, nullable=false)
     */
    private $geburtsland = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=100, nullable=false)
     */
    private $nationality = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="wer", type="string", length=100, nullable=false)
     */
    private $wer = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="author_id", type="integer", nullable=false)
     */
    private $authorId = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime", nullable=false)
     */
    private $datum = 'CURRENT_TIMESTAMP';



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
     * Set nachname
     *
     * @param string $nachname
     *
     * @return AmaseStudents
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;

        return $this;
    }

    /**
     * Get nachname
     *
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * Set vorname
     *
     * @param string $vorname
     *
     * @return AmaseStudents
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;

        return $this;
    }

    /**
     * Get vorname
     *
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return AmaseStudents
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set university1
     *
     * @param string $university1
     *
     * @return AmaseStudents
     */
    public function setUniversity1($university1)
    {
        $this->university1 = $university1;

        return $this;
    }

    /**
     * Get university1
     *
     * @return string
     */
    public function getUniversity1()
    {
        return $this->university1;
    }

    /**
     * Set matrikel1
     *
     * @param string $matrikel1
     *
     * @return AmaseStudents
     */
    public function setMatrikel1($matrikel1)
    {
        $this->matrikel1 = $matrikel1;

        return $this;
    }

    /**
     * Get matrikel1
     *
     * @return string
     */
    public function getMatrikel1()
    {
        return $this->matrikel1;
    }

    /**
     * Set university2
     *
     * @param string $university2
     *
     * @return AmaseStudents
     */
    public function setUniversity2($university2)
    {
        $this->university2 = $university2;

        return $this;
    }

    /**
     * Get university2
     *
     * @return string
     */
    public function getUniversity2()
    {
        return $this->university2;
    }

    /**
     * Set matrikel2
     *
     * @param string $matrikel2
     *
     * @return AmaseStudents
     */
    public function setMatrikel2($matrikel2)
    {
        $this->matrikel2 = $matrikel2;

        return $this;
    }

    /**
     * Get matrikel2
     *
     * @return string
     */
    public function getMatrikel2()
    {
        return $this->matrikel2;
    }

    /**
     * Set universitymaster
     *
     * @param string $universitymaster
     *
     * @return AmaseStudents
     */
    public function setUniversitymaster($universitymaster)
    {
        $this->universitymaster = $universitymaster;

        return $this;
    }

    /**
     * Get universitymaster
     *
     * @return string
     */
    public function getUniversitymaster()
    {
        return $this->universitymaster;
    }

    /**
     * Set startSemester
     *
     * @param string $startSemester
     *
     * @return AmaseStudents
     */
    public function setStartSemester($startSemester)
    {
        $this->startSemester = $startSemester;

        return $this;
    }

    /**
     * Get startSemester
     *
     * @return string
     */
    public function getStartSemester()
    {
        return $this->startSemester;
    }

    /**
     * Set studySemester
     *
     * @param string $studySemester
     *
     * @return AmaseStudents
     */
    public function setStudySemester($studySemester)
    {
        $this->studySemester = $studySemester;

        return $this;
    }

    /**
     * Get studySemester
     *
     * @return string
     */
    public function getStudySemester()
    {
        return $this->studySemester;
    }

    /**
     * Set complete
     *
     * @param string $complete
     *
     * @return AmaseStudents
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;

        return $this;
    }

    /**
     * Get complete
     *
     * @return string
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return AmaseStudents
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set birthPlace
     *
     * @param string $birthPlace
     *
     * @return AmaseStudents
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    /**
     * Get birthPlace
     *
     * @return string
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * Set countryBirth
     *
     * @param string $countryBirth
     *
     * @return AmaseStudents
     */
    public function setCountryBirth($countryBirth)
    {
        $this->countryBirth = $countryBirth;

        return $this;
    }

    /**
     * Get countryBirth
     *
     * @return string
     */
    public function getCountryBirth()
    {
        return $this->countryBirth;
    }

    /**
     * Set geburtsort
     *
     * @param string $geburtsort
     *
     * @return AmaseStudents
     */
    public function setGeburtsort($geburtsort)
    {
        $this->geburtsort = $geburtsort;

        return $this;
    }

    /**
     * Get geburtsort
     *
     * @return string
     */
    public function getGeburtsort()
    {
        return $this->geburtsort;
    }

    /**
     * Set geburtsland
     *
     * @param string $geburtsland
     *
     * @return AmaseStudents
     */
    public function setGeburtsland($geburtsland)
    {
        $this->geburtsland = $geburtsland;

        return $this;
    }

    /**
     * Get geburtsland
     *
     * @return string
     */
    public function getGeburtsland()
    {
        return $this->geburtsland;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return AmaseStudents
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return AmaseStudents
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set wer
     *
     * @param string $wer
     *
     * @return AmaseStudents
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
     * Set authorId
     *
     * @param integer $authorId
     *
     * @return AmaseStudents
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

    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return AmaseStudents
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
     * @param string $language
     * @param string $gender
     * @return mixed
     */
    private function translateGenderToText($language, $gender)
    {
        $genderMapping = array(
            'de' => array('male' => 'Herr', 'female' => 'Frau'),
            'en'=> array('male' => 'Mr.', 'female' => 'Ms.'),);
        if (array_key_exists($language, $genderMapping)) {
            if (array_key_exists($gender, $genderMapping[$language])) {
                return $genderMapping[$language][$gender];
            }
        }
        die("unknown gender: ". $language . " - " . $gender);
    }

    public function getAnrede($language='de'){
        return $this->translateGenderToText($language,$this->getGender());
    }

    public function getPartnerUniversity($university='UdS'){
        if($this->getUniversity1() == $university){
            return $this->getUniversity2();
        }else{
            return $this->getUniversity1();
        }
    }

}
