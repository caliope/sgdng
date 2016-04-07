<?php

namespace Sgdng\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dependencia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sgdng\ApiBundle\Entity\DependenciaRepository")
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
     * @var integer
     *
     * @ORM\Column(name="id_entidad", type="integer")
     */
    private $id_entidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_padre", type="integer")
     */
    private $id_padre;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=12)
     */
    private $color;


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
     * Set id_entidad
     *
     * @param integer $idEntidad
     * @return Dependencia
     */
    public function setIdEntidad($idEntidad)
    {
        $this->id_entidad = $idEntidad;

        return $this;
    }

    /**
     * Get id_entidad
     *
     * @return integer 
     */
    public function getIdEntidad()
    {
        return $this->id_entidad;
    }

    /**
     * Set id_padre
     *
     * @param integer $idPadre
     * @return Dependencia
     */
    public function setIdPadre($idPadre)
    {
        $this->id_padre = $idPadre;

        return $this;
    }

    /**
     * Get id_padre
     *
     * @return integer 
     */
    public function getIdPadre()
    {
        return $this->id_padre;
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
}
