<?php

namespace Stampi\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Stampi\AdminBundle\Entity\Seller;
use Stampi\AdminBundle\Form\SellerType;

/**
 * Seller controller.
 *
 */
class SellerController extends Controller
{

    /**
     * Lists all Seller entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StampiAdminBundle:Seller')->findAll();

        return $this->render('StampiAdminBundle:Seller:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Seller entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Seller();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seller_show', array('id' => $entity->getId())));
        }

        return $this->render('StampiAdminBundle:Seller:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Seller entity.
     *
     * @param Seller $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Seller $entity)
    {
        $form = $this->createForm(new SellerType(), $entity, array(
            'action' => $this->generateUrl('seller_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Seller entity.
     *
     */
    public function newAction()
    {
        $entity = new Seller();
        $form   = $this->createCreateForm($entity);

        return $this->render('StampiAdminBundle:Seller:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Seller entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Seller')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seller entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StampiAdminBundle:Seller:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Seller entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Seller')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seller entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('StampiAdminBundle:Seller:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Seller entity.
    *
    * @param Seller $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Seller $entity)
    {
        $form = $this->createForm(new SellerType(), $entity, array(
            'action' => $this->generateUrl('seller_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Seller entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StampiAdminBundle:Seller')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seller entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('seller_edit', array('id' => $id)));
        }

        return $this->render('StampiAdminBundle:Seller:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Seller entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StampiAdminBundle:Seller')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Seller entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('seller'));
    }

    /**
     * Creates a form to delete a Seller entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seller_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
