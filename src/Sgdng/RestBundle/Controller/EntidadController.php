<?php

namespace Sgdng\RestBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Sgdng\RestBundle\Entity\Entidad;
use Sgdng\RestBundle\Form\EntidadType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Rest controller para Entidades
 *
 * @package Sgdng\RestBundle\Controller
 * @author Jorge Alberto Arocha Munoz <jorge.arocha@gmail.com>
 */

class EntidadController extends FOSRestController implements ClassResourceInterface
{
	/**
     *
     * Muestra la colección de Entidades. Devuelve un objeto de la forma:
     * 
     * {
     *   "entidades":[
     *      {
     *        "id":1,
     *        "sigla":"A&A",
     *        "nombre":"Arocha & Arocha Ltda.",
     *        "direccion":"Calle 53 # 35 - 60 Apto 402",
     *        "dependencia": { Objeto Dependencia}
     *     }
     *  ]
     * }
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Devuelve un listado de las Entidades.",
     *  statusCodes = {
     *    200 = "Es retornado cuando encuentra las entidades."
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

        $entidades = $em->getRepository('SgdngRestBundle:Entidad')->findAll();

        return array(
            'entidades' => $entidades,
        );
    }

    /**
     *
     * Muestra una determinada entidad. Devuelve un objeto de la forma:
     * 
     * {
     *     "entidad":
     *       [
     *         {
     *           "id": ​int,
     *           "sigla": string,
     *           "nombre": string,
     *           "direccion": string,
     *           "dependencia": { dependencia inicial del organigrama }
     *           }
     *       ]
     *   }
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Devuelve una entidad identificada por su Id.",
     *  output = "Sgdng\RestBundle\Entity\entidad",
     *  statusCodes = {
     *    200 = "Es retornado cuando la entidad se encuentra",
     *    404 = "Es retornado cuando no se encuentra la entidad"
     *  } ,
     *   requirements={
     *      { "name"="id", "dataType"="integer", "requirement"="\d+", "description"="id de la entidad." }
     *   }
     * )
     *
     * Get action
     * @var integer $id Id of the entity
     * @return array
     *
     * @Rest\View()
     */
    public function getAction($id)
    {
        $entidad = $this->getEntity($id);

        return array(
            'entidad' => $entidad,
        );
    }

    /**
     *
     * Crea una nueva entidad.
     *
     * @ApiDoc(
     *  description="Crea una nueva entidad.",
     *  input="Sgdng\RestBundle\Form\EntidadType",
     *  output="Sgdng\RestBundle\Form\Entidad",
     *  statusCodes = {
     *    201 = "Es retornado cuando la entidad es creada sin errores."
     *  } 
     * )
     * 
     * Collection post action
     * @var Request $request
     * @return View|array
     */
    public function cpostAction(Request $request)
    {
        $entidad = new Entidad();
        $form = $this->createForm(new EntidadType(), $entidad);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entidad);
            $em->flush();

            return $this->redirectView(
                $this->generateUrl(
                    'get_entidad',
                    array('id' => $entidad->getId())
                ),
                Codes::HTTP_CREATED
            );
        }

        return array(
            'entidad' => $entidad,
        );
    }

    /**
     *
     * Modifica una entidad dada por su Id.
     *
     * @ApiDoc(
     *  description="Modifica una entidad, determinanda por su id.",
     *  input="Sgdng\RestBundle\Form\EntidadType",
     *  output="Sgdng\RestBundle\Form\Entidad",
     *  statusCodes = {
     *    204 = "Es retornado cuando la entidad es actualizada sin errores."
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
        $entidad = $this->getEntity($id);
        $form = $this->createForm(new EntidadType(), $entidad);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entidad);
            $em->flush();

            return $this->view(null, Codes::HTTP_NO_CONTENT);
        }

        return array(
            'entidad' => $entidad,
        );
    }

    /**
     *
     * Elimina la Entiodad determinada por el Id.
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
     * Delete action
     * @var integer $id Id of the entity
     * @return View
     */
    public function deleteAction($id)
    {
        $entidad = $this->getEntity($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($entidad);
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

        $entity = $em->getRepository('SgdngRestBundle:Entidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encontraron registros de Dependencia.');
        }

        return $entity;
    }
}