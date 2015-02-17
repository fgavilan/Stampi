<?php

namespace ByHours\MediaBundle\Services;

use ByHours\MediaBundle\Entity\Image;
use ByHours\MediaBundle\Form\ImageType;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View as FOSView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Image controller.
 * @RouteResource("Image")
 */
class ImageService extends Controller
{
    protected $router;
    protected $security;
    protected $entityManager;
    protected $formFactory;

    public function __construct(\Symfony\Bundle\FrameworkBundle\Routing\Router $router, \Symfony\Component\Security\Core\SecurityContext $security, \Doctrine\ORM\EntityManager $entityManager, FormFactory $formFactory)
    {
        $this->router = $router;
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    /**
     * Get a Image entity
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @return Response
     *
     */
    public function getAction($image)
    {
        $entity = $this->entityManager->getRepository('MediaBundle:Image')->find($image);
        if($entity){
        //    $entity->setFullPath();
        }
        return $entity;
    }
    /**
     * Get all Image entities.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @return Response
     *
     * @QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @QueryParam(name="limit", requirements="\d+", default="20", description="How many notes to return.")
     * @QueryParam(name="order_by", nullable=true, array=true, description="Order by fields. Must be an array ie. &order_by[name]=ASC&order_by[description]=DESC")
     * @QueryParam(name="filters", nullable=true, array=true, description="Filter by fields. Must be an array ie. &filters[id]=3")
     */
    public function cgetAction($paramFetcher = null)
    {
        try {
            if (!isset($paramFetcher['offset'])) {
                $paramFetcher['offset'] = null;
            }

            if (!isset($paramFetcher['limit'])) {
                $paramFetcher['limit'] = null;
            }

            if (!isset($paramFetcher['order_by'])) {
                $paramFetcher['order_by'] = array();
            }



            $entities = $this->entityManager->getRepository('MediaBundle:Image')->findBy($paramFetcher['filters'], $paramFetcher['order_by'], $paramFetcher['limit'], $paramFetcher['offset']);
            foreach($entities as $entity){
                //$entity->setFullPath();
            }
            if ($entities) {
                return $entities;
            }

            return FOSView::create('Not Found', Codes::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Create a Image entity.
     *
     * @View(statusCode=201, serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     *
     * @return Response
     *
     */
    public function postAction(Request $request)
    {
        $entity = new Image();
        //return($request->request->all());
        $form = $this->formFactory->create(new ImageType(), $entity, array("method" => $request->getMethod()));
        //$this->removeExtraFields($request, $form);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->upload();
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            return $entity;
        }else{
            return "nope";
        }

        return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
    }
    /**
     * Update a Image entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
     */
    public function putAction(Request $request, Image $entity)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $request->setMethod('PATCH'); //Treat all PUTs as PATCH
            $form = $this->createForm(new ImageType(), $entity, array("method" => $request->getMethod()));
            $this->removeExtraFields($request, $form);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->flush();

                return $entity;
            }

            return FOSView::create(array('errors' => $form->getErrors()), Codes::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Partial Update to a Image entity.
     *
     * @View(serializerEnableMaxDepthChecks=true)
     *
     * @param Request $request
     * @param $entity
     *
     * @return Response
*/
    public function patchAction(Request $request, Image $entity)
    {
        return $this->putAction($request, $entity);
    }
    /**
     * Delete a Image entity.
     *
     * @View(statusCode=204)
     *
     * @param Request $request
     * @param $entity
     * @internal param $id
     *
     * @return Response
     */
    public function deleteAction(Image $entity)
    {
        try {
            $entity->delete();
            $this->entityManager->remove($entity);
            $this->entityManager->flush();

            return null;
        } catch (\Exception $e) {
            return FOSView::create($e->getMessage(), Codes::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
