<?php

namespace Stampi\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stampi\AdminBundle\Entity\Edition;
use Stampi\AdminBundle\Form\EditionType;

/**
 * Edition controller.
 *
 */
class EditionController extends Controller
{

    /**
     * Lists all Edition entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StampiAdminBundle:Edition')->findAll();

        return $this->render('StampiAdminBundle:Edition:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Edition entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Edition();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('edition_show', array('id' => $entity->getId())));
        }

        return $this->render('StampiAdminBundle:Edition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Edition entity.
     *
     * @param Edition $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Edition $entity)
    {
        $form = $this->createForm(new EditionType(), $entity, array(
            'action' => $this->generateUrl('edition_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Edition entity.
     *
     */
    public function newAction()
    {
        $entity = new Edition();
        $form   = $this->createCreateForm($entity);

        return $this->render('StampiAdminBundle:Edition:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Edition entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Edition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StampiAdminBundle:Edition:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Edition entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Edition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edition entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StampiAdminBundle:Edition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Edition entity.
    *
    * @param Edition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Edition $entity)
    {
        $form = $this->createForm(new EditionType(), $entity, array(
            'action' => $this->generateUrl('edition_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Edition entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Edition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Edition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('edition_edit', array('id' => $id)));
        }

        return $this->render('StampiAdminBundle:Edition:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Edition entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StampiAdminBundle:Edition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Edition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('edition'));
    }

    /**
     * Creates a form to delete a Edition entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('edition_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
