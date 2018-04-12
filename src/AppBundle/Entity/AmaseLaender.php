<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmaseLaender
 *
 * @ORM\Table(name="amase_laender", uniqueConstraints={@ORM\UniqueConstraint(name="land", columns={"land"})})
 * @ORM\Entity
 */
class AmaseLaender
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
     * @ORM\Column(name="land", type="string", length=255, nullable=false)
     */
    private $land = '';



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
     * Set land
     *
     * @param string $land
     *
     * @return AmaseLaender
     */
    public function setLand($land)
    {
        $this->land = $land;

        return $this;
    }

    /**
     * Get land
     *
     * @return string
     */
    public function getLand()
    {
        return $this->land;
    }
}
