<?php

namespace Sgdng\RestBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Sgdng\RestBundle\Entity\Dependencia;
use Sgdng\RestBundle\Form\DependenciaType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Rest controller para Dependencias
 *
 * @package Sgdng\RestBundle\Controller
 * @author Jorge Alberto Arocha Munoz <jorge.arocha@gmail.com>
 */

class DependenciaController extends FOSRestController implements ClassResourceInterface
{
	/**
     * Muestra la colección de dependencias. Devuelve un objeto de la forma:
     * 
     * {
     *     "dependencias":
     *       [
     *         {
     *           "id": ​int,
     *           "sigla": string,
     *           "nombre": string,
     *           "color": string,
     *           "hijo":
     *             [
     *               Dependencias Hijo
     *             ]
     *           "padre": { Dependencia padre} 
     *          "entidad" : { Entgidad a la que pertenece}
     *           },
      *        ....   
     *       ]
     *   }
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Devuelve un listado de las dependencias.",
     *  statusCodes = {
     *    200 = "Es retornado cuando la dependencia se encuentra"
     *  } 
     * )
     * 
     * Collection get action
     * @var Request $request
     * @return array
     *
     * @Rest\View()
     */
    public function cgetAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $dependencias = $em->getRepository('SgdngRestBundle:Dependencia')->findAll();

        return array(
            'dependencias' => $dependencias,
        );
    }

    /**
     *  Muestra una determinada dependencia. Devuelve un objeto de la forma:
     * 
     * {
     *     "dependencia":
     *       [
     *         {
     *           "id": ​int,
     *           "sigla": string,
     *           "nombre": string,
     *           "color": string,
     *           "hijo":
     *             [
     *               Dependencias Hijo
     *             ]
     *           "padre": { Dependencia padre} 
     *          "entidad" : { Entgidad a la que pertenece}
     *           }
     *       ]
     *   }
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Devuelve una dependencias identificada por su Id.",
     *  output = "Sgdng\RestBundle\Entity\Dependencia",
     *  statusCodes = {
     *    200 = "Es retornado cuando la dependencia se encuentra",
     *    404 = "Es retornado cuando no se encuentra la dependencia"
     *  } ,
     *   requirements={
     *      { "name"="id", "dataType"="integer", "requirement"="\d+", "description"="id de la Dependencia." }
     *   }
     * )
     * 
     * @param int     $id      Id de la Dependencia
     *
     * Get action
     * @var integer $id Id of the entity
     * @return array
     *
     * @Rest\View()
     */
    public function getAction($id)
    {
        $dependencia = $this->getEntity($id);

        return array(
            'dependencia' => $dependencia,
        );
    }

    /**
     *
     * Crea una nueva dependencia.
     *
     * @ApiDoc(
     *  description="Crea una nueva dependencia.",
     *  input="Sgdng\RestBundle\Form\DependenciaType",
     *  output="Sgdng\RestBundle\Form\Dependencia",
     *  statusCodes = {
     *    201 = "Es retornado cuando la dependencia es creada sin errores."
     *  } 
     * )
     * 
     * Collection post action
     * @var Request $request
     * @return View|array
     */
    public function cpostAction(Request $request)
    {
        $dependencia = new Dependencia();
        $form = $this->createForm(new DependenciaType(), $dependencia);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dependencia);
            $em->flush();

            return $this->redirectView(
                $this->generateUrl(
                    'get_dependencia',
                    array('id' => $dependencia->getId())
                ),
                Codes::HTTP_CREATED
            );
        }

        return array(
            'dependencia' => $dependencia,
        );
    }

    /**
     * 
     * Modifica una depoendencia derterminada por su id.
     * 
     * @ApiDoc(
     *  description="Modifica una dependencia, determinanda por su id.",
     *  input="Sgdng\RestBundle\Form\DependenciaType",
     *  output="Sgdng\RestBundle\Form\Dependencia",
     *  statusCodes = {
     *    204 = "Es retornado cuando la dependencia es actualizada sin errores."
     *  } 
     * )
     * 
     * Put action
     * @var Request $request
     * @var integer $id Id of the entity
     * @return View|array
     */
    public function putAction(Request $request, $id)
    {
        $dependencia = $this->getEntity($id);
        $form = $this->createForm(new DependenciaType(), $dependencia);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dependencia);
            $em->flush();

            return $this->view(null, Codes::HTTP_NO_CONTENT);
        }

        return array(
            'dependencia' => $dependencia,
        );
    }

    /**
     *
     * Elimina la Dependencia determinada por el Id.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Es retornado cuando se eliminadsa la dependencia  "
     *   },
     *   requirements={
     *      { "name"="id", "dataType"="integer", "requirement"="\d+", "description"="id de la Dependencia a eliminar" }
     *   }
     * )
     *
     *
     * Delete action
     * @var integer $id Id of the entity
     * @return View
     */
    public function deleteAction($id)
    {
        $dependencia = $this->getEntity($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($dependencia);
        $em->flush();

        return $this->view(null, Codes::HTTP_NO_CONTENT);
    }

    /**
     * Get entity instance
     * @var integer $id Id of the entity
     * @return Dependencia
     */
    protected function getEntity($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SgdngRestBundle:Dependencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encontraron registros de Dependencia.');
        }

        return $entity;
    }
}
