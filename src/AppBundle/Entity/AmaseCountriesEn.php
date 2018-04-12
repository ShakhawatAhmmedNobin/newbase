<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseCountriesEn
 *
 * @ORM\Table(name="amase_countries_en")
 * @ORM\Entity
 */
class AmaseCountriesEn
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
     * @ORM\Column(name="country", type="string", length=200, nullable=false)
     */
    private $country = '';



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
     * Set country
     *
     * @param string $country
     *
     * @return AmaseCountriesEn
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
}
