<?php

namespace ZZ\Bundles\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ZZ\Bundles\AppBundle\Entity\UserSmoke;
use ZZ\Bundles\AppBundle\Form\UserSmokeType;

/**
 * UserSmoke controller.
 *
 */
class UserSmokeController extends Controller
{

    /**
     * Lists all UserSmoke entities.
     *
     */
    public function indexAction()
    {
        /** @var $user \ZZ\Bundles\userBundle\Entity\User */
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user->getUsersmoke() === null) {
            return $this->redirect($this->generateUrl('zz_app_usersmoke_new'));
        }

        return $this->showAction();
        /*
        return $this->render(
            'ZZBundlesAppBundle:UserSmoke:index.html.twig',
            array(
                'user' => $user,
            )
        );
        */
    }

    /**
     * Creates a new UserSmoke entity.
     *
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        /** @var $user \ZZ\Bundles\userBundle\Entity\User */
        $user = $this->container->get('security.context')->getToken()->getUser();

        $entity = new UserSmoke();
        $entity->setUser($user);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('zz_app_usersmoke_show'));
        }

        return $this->render(
            'ZZBundlesAppBundle:UserSmoke:new.html.twig',
            array(
                'entity' => $entity,
                'form'   => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a UserSmoke entity.
     *
     * @param UserSmoke $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserSmoke $entity)
    {
        $form = $this->createForm(
            new UserSmokeType(),
            $entity,
            array(
                'action' => $this->generateUrl('zz_app_usersmoke_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'form.usersmoketype.submit.label'));

        return $form;
    }

    /**
     * Displays a form to create a new UserSmoke entity.
     *
     */
    public function newAction()
    {
        $entity = new UserSmoke();
        $form = $this->createCreateForm($entity);

        return $this->render(
            'ZZBundlesAppBundle:UserSmoke:new.html.twig',
            array(
                'entity' => $entity,
                'form'   => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a UserSmoke entity.
     *
     */
    public function showAction()
    {
        /** @var $user \ZZ\Bundles\userBundle\Entity\User */
        $user = $this->container->get('security.context')->getToken()->getUser();

        $calculate = $this->container->get('zz_bundles.app.calculatesaving');
        $calculate->setDateEnd(new \Datetime('now'))->setUser($user);

        return $this->render(
            'ZZBundlesAppBundle:UserSmoke:show.html.twig',
            array(
                'savingsmoking' => $calculate->calculateSaving(),
                'user' => $user
            )
        );
    }

    /**
     * Displays a form to edit an existing UserSmoke entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZZBundlesAppBundle:UserSmoke')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserSmoke entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZZBundlesAppBundle:UserSmoke:edit.html.twig',
            array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a UserSmoke entity.
     *
     * @param UserSmoke $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UserSmoke $entity)
    {
        $form = $this->createForm(
            new UserSmokeType(),
            $entity,
            array(
                'action' => $this->generateUrl('zz_app_usersmoke_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing UserSmoke entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ZZBundlesAppBundle:UserSmoke')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserSmoke entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('zz_app_usersmoke_edit', array('id' => $id)));
        }

        return $this->render(
            'ZZBundlesAppBundle:UserSmoke:edit.html.twig',
            array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a UserSmoke entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ZZBundlesAppBundle:UserSmoke')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserSmoke entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('zz_app_usersmoke'));
    }

    /**
     * Creates a form to delete a UserSmoke entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zz_app_usersmoke_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
