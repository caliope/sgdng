<?php

namespace Sgdng\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;

use Symfony\Component\HttpFoundation\Request;

use Sgdng\ApiBundle\Entity\Dependencia;
use Sgdng\ApiBundle\Form\DependenciaType;

class DependenciaController extends FOSRestController implements ClassResourceInterface
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
        $dependencias = $em->getRepository('SgdngApiBundle:Dependencia')->findAll();
        return array(
            'dependencias' => $dependencias,
        );
    }

    /**
     * Get action
     * @var integer $id Id de la Dependencia
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
            'form' => $form,
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
            'form' => $form,
        );
    }

    /**
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
     * @var integer $id Id de la Dependencia
     * @return Dependencia
     */
    protected function getEntity($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SgdngApiBundle:Dependencia')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No se ha encontrado el registro.');
        }
        return $entity;
    }
}
