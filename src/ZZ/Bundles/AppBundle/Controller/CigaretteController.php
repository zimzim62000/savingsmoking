<?php

namespace ZZ\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ZZ\Bundles\AppBundle\Entity\Cigarette;
use ZZ\Bundles\AppBundle\Form\CigaretteType;

/**
 * Cigarette controller.
 *
 */
class CigaretteController extends Controller
{

    /**
     * Lists all Cigarette entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ZZBundlesAppBundle:Cigarette')->findAll();

        return $this->render('ZZBundlesAppBundle:Cigarette:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Cigarette entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Cigarette();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zz_app_cigarette_show', array('id' => $entity->getId())));
        }

        return $this->render('ZZBundlesAppBundle:Cigarette:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Cigarette entity.
    *
    * @param Cigarette $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Cigarette $entity)
    {
        $form = $this->createForm(new CigaretteType(), $entity, array(
            'action' => $this->generateUrl('zz_app_cigarette_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cigarette entity.
     *
     */
    public function newAction()
    {
        $entity = new Cigarette();
        $form   = $this->createCreateForm($entity);

        return $this->render('ZZBundlesAppBundle:Cigarette:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cigarette entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZZBundlesAppBundle:Cigarette')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cigarette entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZZBundlesAppBundle:Cigarette:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Cigarette entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZZBundlesAppBundle:Cigarette')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cigarette entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ZZBundlesAppBundle:Cigarette:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Cigarette entity.
    *
    * @param Cigarette $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cigarette $entity)
    {
        $form = $this->createForm(new CigaretteType(), $entity, array(
            'action' => $this->generateUrl('zz_app_cigarette_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cigarette entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZZBundlesAppBundle:Cigarette')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cigarette entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('zz_app_cigarette_edit', array('id' => $id)));
        }

        return $this->render('ZZBundlesAppBundle:Cigarette:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cigarette entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZZBundlesAppBundle:Cigarette')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cigarette entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('zz_app_cigarette'));
    }

    /**
     * Creates a form to delete a Cigarette entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zz_app_cigarette_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
