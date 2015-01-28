<?php

namespace Stampi\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stampi\AdminBundle\Entity\Inventory;
use Stampi\AdminBundle\Form\InventoryType;

/**
 * Inventory controller.
 *
 */
class InventoryController extends Controller
{

    /**
     * Lists all Inventory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StampiAdminBundle:Inventory')->findAll();

        return $this->render('StampiAdminBundle:Inventory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Inventory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Inventory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inventory_show', array('id' => $entity->getId())));
        }

        return $this->render('StampiAdminBundle:Inventory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Inventory entity.
     *
     * @param Inventory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Inventory $entity)
    {
        $form = $this->createForm(new InventoryType(), $entity, array(
            'action' => $this->generateUrl('inventory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Inventory entity.
     *
     */
    public function newAction()
    {
        $entity = new Inventory();
        $form   = $this->createCreateForm($entity);

        return $this->render('StampiAdminBundle:Inventory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Inventory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Inventory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inventory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StampiAdminBundle:Inventory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Inventory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Inventory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inventory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StampiAdminBundle:Inventory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Inventory entity.
    *
    * @param Inventory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Inventory $entity)
    {
        $form = $this->createForm(new InventoryType(), $entity, array(
            'action' => $this->generateUrl('inventory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Inventory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Inventory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inventory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('inventory_edit', array('id' => $id)));
        }

        return $this->render('StampiAdminBundle:Inventory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Inventory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StampiAdminBundle:Inventory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Inventory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('inventory'));
    }

    /**
     * Creates a form to delete a Inventory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inventory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
