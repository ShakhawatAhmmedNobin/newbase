<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseCountries
 *
 * @ORM\Table(name="amase_countries")
 * @ORM\Entity
 */
class AmaseCountries
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=2)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $code = '';

    /**
     * @var string
     *
     * @ORM\Column(name="en", type="string", length=50, nullable=false)
     */
    private $en = '';

    /**
     * @var string
     *
     * @ORM\Column(name="de", type="string", length=50, nullable=false)
     */
    private $de = '';



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
     * Set en
     *
     * @param string $en
     *
     * @return AmaseCountries
     */
    public function setEn($en)
    {
        $this->en = $en;

        return $this;
    }

    /**
     * Get en
     *
     * @return string
     */
    public function getEn()
    {
        return $this->en;
    }

    /**
     * Set de
     *
     * @param string $de
     *
     * @return AmaseCountries
     */
    public function setDe($de)
    {
        $this->de = $de;

        return $this;
    }

    /**
     * Get de
     *
     * @return string
     */
    public function getDe()
    {
        return $this->de;
    }
}
