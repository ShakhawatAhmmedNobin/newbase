<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseUsers
 *
 * @ORM\Table(name="amase_users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 */
class AmaseUsers
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
     * @ORM\Column(name="fullname", type="string", length=50, nullable=false)
     */
    private $fullname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="firma", type="string", length=50, nullable=false)
     */
    private $firma = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=false)
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="passwort", type="string", length=32, nullable=false)
     */
    private $passwort = '';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = 'user';

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
     * Set fullname
     *
     * @param string $fullname
     *
     * @return AmaseUsers
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set firma
     *
     * @param string $firma
     *
     * @return AmaseUsers
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return string
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return AmaseUsers
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
     * Set passwort
     *
     * @param string $passwort
     *
     * @return AmaseUsers
     */
    public function setPasswort($passwort)
    {
        $this->passwort = $passwort;

        return $this;
    }

    /**
     * Get passwort
     *
     * @return string
     */
    public function getPasswort()
    {
        return $this->passwort;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return AmaseUsers
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
     * Set wer
     *
     * @param string $wer
     *
     * @return AmaseUsers
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
     * @return AmaseUsers
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
     * @return AmaseUsers
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
}
