<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseNationalities
 *
 * @ORM\Table(name="amase_nationalities")
 * @ORM\Entity
 */
class AmaseNationalities
{
    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=100)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nationality = '';



    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }
}
