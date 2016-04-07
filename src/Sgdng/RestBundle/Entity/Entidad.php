<?php

namespace Sgdng\RestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidad
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sgdng\RestBundle\Entity\EntidadRepository")
 */
class Entidad
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
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @ORM\OneToOne(targetEntity="Dependencia", mappedBy="entidad")
     */
    private $dependencia;


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
     * @return Entidad
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
     * @return Entidad
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
     * Set direccion
     *
     * @param string $direccion
     * @return Entidad
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set dependencia
     *
     * @param \Sgdng\RestBundle\Entity\Dependencia $dependencia
     * @return Entidad
     */
    public function setDependencia(\Sgdng\RestBundle\Entity\Dependencia $dependencia = null)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return \Sgdng\RestBundle\Entity\Dependencia 
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Override toString() method to return the name of the group
     * @return string name
     */
    public function __toString()
    {
        return $this->nombre;
    }
}
