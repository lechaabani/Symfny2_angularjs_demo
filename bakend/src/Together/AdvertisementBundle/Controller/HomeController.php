<?php

namespace Together\AdvertisementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Together\AdvertisementBundle\Entity\Advertisement;
use Together\AdvertisementBundle\Form\AdvertisementType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class HomeController extends FOSRestController {  
    
    /**
     * List all advertisements.
     *
     * @ApiDoc(
     *   section="01. Advertisement services",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * 
     * 
     * @return array
     */
    public function getAdvertisementsAction(Request $request)
    {
        $advertisements = $this->getDoctrine()->getRepository("TogetherAdvertisementBundle:Advertisement")
            ->findAll();
        return array('advertisements' => $advertisements);
    }
    /**
     * Get a single advertisement.
     *
     * @ApiDoc(
     *   section="01. Advertisement services",
     *   output = "Advertisement\AdvertisementBundle\Model\Advertisement",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the advertisement is not found"
     *   }
     * )
     * 
     * @param Request $request the request object
     * @param int     $id      the advertisement id
     *
     * @return array
     *
     * @throws NotFoundHttpException when advertisement not exist
     */
    public function getAdvertisementAction(Request $request, $id)
    {
        
    } 
    
    /**
     * Creates a new advertisement from the submitted data.
     *
     * @ApiDoc(
     *   section="01. Advertisement services",
     *   resource = true,
     *   input = "Advertisement\AdvertisementBundle\Form\AdvertisementType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|RouteRedirectView
     */
    public function postAdvertisementsAction(Request $request)
    {
       
    }
    
    /**
     * Update existing advertisement from the submitted data or create a new advertisement at a specific location.
     *
     * @ApiDoc(
     *   section="01. Advertisement services",
     *   resource = true,
     *   input = "Together\AdvertisementBundle\Form\AdvertisementType",
     *   statusCodes = {
     *     201 = "Returned when a new resource is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * 
     *
     * @param Request $request the request object 
     * 
     * @return FormTypeInterface|RouteRedirectView
     * @ParamConverter("advertisement", class="TogetherAdvertisementBundle:Advertisement")
     * @throws NotFoundHttpException when advertisement not exist
     */
    public function putAdvertisementsAction(Request $request, Advertisement $advertisement)
    {
        
    }
    
    /**
     * Removes an advertisement.
     *
     * @ApiDoc(
     *   section="01. Advertisement services",
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful"
     *   }
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the advertisement id
     *
     * @return RouteRedirectView
     */
    public function deleteAdvertisementsAction(Request $request, $id)
    {
      
    }

    

}
