<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseLog
 *
 * @ORM\Table(name="amase_log")
 * @ORM\Entity
 */
class AmaseLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime", nullable=false)
     */
    private $datum = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15, nullable=false)
     */
    private $ip = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="datensatz", type="integer", nullable=false)
     */
    private $datensatz = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="dtabelle", type="string", length=20, nullable=false)
     */
    private $dtabelle = '';

    /**
     * @var string
     *
     * @ORM\Column(name="dstatus", type="string", nullable=false)
     */
    private $dstatus = 'change';

    /**
     * @var string
     *
     * @ORM\Column(name="ddiff", type="text", length=65535, nullable=false)
     */
    private $ddiff;



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
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return AmaseLog
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
     * Set name
     *
     * @param string $name
     *
     * @return AmaseLog
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
     * Set ip
     *
     * @param string $ip
     *
     * @return AmaseLog
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set datensatz
     *
     * @param integer $datensatz
     *
     * @return AmaseLog
     */
    public function setDatensatz($datensatz)
    {
        $this->datensatz = $datensatz;

        return $this;
    }

    /**
     * Get datensatz
     *
     * @return integer
     */
    public function getDatensatz()
    {
        return $this->datensatz;
    }

    /**
     * Set dtabelle
     *
     * @param string $dtabelle
     *
     * @return AmaseLog
     */
    public function setDtabelle($dtabelle)
    {
        $this->dtabelle = $dtabelle;

        return $this;
    }

    /**
     * Get dtabelle
     *
     * @return string
     */
    public function getDtabelle()
    {
        return $this->dtabelle;
    }

    /**
     * Set dstatus
     *
     * @param string $dstatus
     *
     * @return AmaseLog
     */
    public function setDstatus($dstatus)
    {
        $this->dstatus = $dstatus;

        return $this;
    }

    /**
     * Get dstatus
     *
     * @return string
     */
    public function getDstatus()
    {
        return $this->dstatus;
    }

    /**
     * Set ddiff
     *
     * @param string $ddiff
     *
     * @return AmaseLog
     */
    public function setDdiff($ddiff)
    {
        $this->ddiff = $ddiff;

        return $this;
    }

    /**
     * Get ddiff
     *
     * @return string
     */
    public function getDdiff()
    {
        return $this->ddiff;
    }
}
