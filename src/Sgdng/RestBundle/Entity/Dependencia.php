<?php

namespace Sgdng\RestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Dependencia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sgdng\RestBundle\Entity\DependenciaRepository")
 */
class Dependencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=12)
     */
    private $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=12)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="Dependencia", mappedBy="padre")
     */
    private $hijo;

    /**
     * @ORM\ManyToOne(targetEntity="Dependencia", inversedBy="hijo")
     * @ORM\JoinColumn(name="id_padre", referencedColumnName="id")
     */
    private $padre;

    /**
     * @ORM\OneToOne(targetEntity="Entidad", inversedBy="dependencia")
     * @ORM\JoinColumn(name="id_entidad", referencedColumnName="id")
     */
    private $entidad;


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
     * Set sigla
     *
     * @param string $sigla
     * @return Dependencia
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string 
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Dependencia
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Dependencia
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hijo = new ArrayCollection();
    }

    /**
     * Add hijo
     *
     * @param \Sgdng\RestBundle\Entity\Dependencia $hijo
     * @return Dependencia
     */
    public function addHijo(\Sgdng\RestBundle\Entity\Dependencia $hijo)
    {
        $this->hijo[] = $hijo;

        return $this;
    }

    /**
     * Remove hijo
     *
     * @param \Sgdng\RestBundle\Entity\Dependencia $hijo
     */
    public function removeHijo(\Sgdng\RestBundle\Entity\Dependencia $hijo)
    {
        $this->hijo->removeElement($hijo);
    }

    /**
     * Get hijo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHijo()
    {
        return $this->hijo;
    }

    /**
     * Set padre
     *
     * @param \Sgdng\RestBundle\Entity\Dependencia $padre
     * @return Dependencia
     */
    public function setPadre(\Sgdng\RestBundle\Entity\Dependencia $padre = null)
    {
        $this->padre = $padre;

        return $this;
    }

    /**
     * Get padre
     *
     * @return \Sgdng\RestBundle\Entity\Dependencia 
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Override toString() method to return the name of the group
     * @return string name
     */
    public function __toString()
    {
        return $this->nombre;
    }


    /**
     * Set entidad
     *
     * @param \Sgdng\RestBundle\Entity\Entidad $entidad
     * @return Dependencia
     */
    public function setEntidad(\Sgdng\RestBundle\Entity\Entidad $entidad = null)
    {
        $this->entidad = $entidad;

        return $this;
    }

    /**
     * Get entidad
     *
     * @return \Sgdng\RestBundle\Entity\Entidad 
     */
    public function getEntidad()
    {
        return $this->entidad;
    }
}
