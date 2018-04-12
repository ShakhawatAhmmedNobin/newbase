<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseCountrylist
 *
 * @ORM\Table(name="amase_countrylist")
 * @ORM\Entity
 */
class AmaseCountrylist
{
    /**
     * @var string
     *
     * @ORM\Column(name="ccode", type="string", length=2)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ccode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name = '';



    /**
     * Get ccode
     *
     * @return string
     */
    public function getCcode()
    {
        return $this->ccode;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AmaseCountrylist
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
}
