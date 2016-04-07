<?php

namespace Sgdng\RestBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;
use Sgdng\RestBundle\Entity\Entidad;
use Sgdng\RestBundle\Form\EntidadType;

class EntidadController extends FOSRestController implements ClassResourceInterface
{
	/**
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