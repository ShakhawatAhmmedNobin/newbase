<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseUserlog
 *
 * @ORM\Table(name="amase_userlog")
 * @ORM\Entity
 */
class AmaseUserlog
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
     * @ORM\Column(name="uip", type="string", length=15, nullable=false)
     */
    private $uip = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ustatus", type="string", nullable=false)
     */
    private $ustatus = 'login';



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
     * @return AmaseUserlog
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
     * @return AmaseUserlog
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
     * Set uip
     *
     * @param string $uip
     *
     * @return AmaseUserlog
     */
    public function setUip($uip)
    {
        $this->uip = $uip;

        return $this;
    }

    /**
     * Get uip
     *
     * @return string
     */
    public function getUip()
    {
        return $this->uip;
    }

    /**
     * Set ustatus
     *
     * @param string $ustatus
     *
     * @return AmaseUserlog
     */
    public function setUstatus($ustatus)
    {
        $this->ustatus = $ustatus;

        return $this;
    }

    /**
     * Get ustatus
     *
     * @return string
     */
    public function getUstatus()
    {
        return $this->ustatus;
    }
}
