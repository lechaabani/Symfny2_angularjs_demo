<?php

namespace Together\AdvertisementBundle\Controller;

use Together\AdvertisementBundle\ApiException\ApiException;
use Together\AdvertisementBundle\ApiResponse\ApiResponse;
use Together\AdvertisementBundle\Entity\Advertisement;
use Together\AdvertisementBundle\Form\AdvertisementType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class AdvertisementController extends FOSRestController {

    /**
     * @ApiDoc(
     *  section="01 Advertisement services",
     *  resource = true,
     *  description = "List all avertisements",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     500 = "Error"
     *   }
     * )
     * @return \Symfony\Component\HttpFoundation\\Symfony\Component\HttpFoundation\Response
     */
    public function getAdvertisementsAction() {
        $em = $this->getDoctrine()->getManager();
        $avertisements = $em->getRepository('TogetherAdvertisementBundle:Advertisement')->findAll();
        if ($avertisements === null) {
            throw new ApiException(404);
        }
        return new ApiResponse(array('avertisements'=>$avertisements));
    }

    /**
     * @ApiDoc(
     *  section="01 Advertisement services",
     *  resource = true,
     *  description = "Get a avertisement",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the deal is not found"
     *   }
     * )
     * @ParamConverter("avertisement", class="TogetherAdvertisementBundle:Advertisement")
     * @param Advertisement $avertisement
     * @return \Symfony\Component\HttpFoundation\\Symfony\Component\HttpFoundation\Response
     */
    public function getAdvertisementAction(Advertisement $avertisement) {

        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('TogetherAdvertisementBundle:Advertisement');

        $result = $repository->find($avertisement);
        
        if ($result === null) {
            throw new ApiException(404);
        } 

        return new ApiResponse(array('avertisement'=>$result));
    }

    /**
     * @ApiDoc(
     *  section="01 Advertisement services",
     *  resource=true,
     *  input="Together\AdvertisementBundle\Form\AdvertisementType",
     *  description="Creates a new avertisement",
     *  statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\\Symfony\Component\HttpFoundation\Response
     */
    public function postAdvertisementsAction(Request $request) {
        $avertisement = new Advertisement();
        $form = $this->createForm(new AdvertisementType(), $avertisement);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($avertisement);
            $em->flush();

            return new ApiResponse(array('avertisement'=>$avertisement));
            } else {
            throw new ApiException(404);
        } 
    }

    /**
     * @ApiDoc(
     *  section="01 Advertisement services",
     *  resource=true,
     *  description="Update partially existing avertisement from the submitted data.",
     *  input="Together\AdvertisementBundle\Form\AdvertisementType",
     *  statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )  
     * @param Request $request 
     */
    public function patchAdvertisementAction(Advertisement $avertisement, Request $request) {
         if ($avertisement === null) {
            throw new ApiException(404);
        } 
        $form = $this->createForm(new AdvertisementType(), $avertisement, array('method' => 'PATCH'));
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new ApiResponse(array('avertisement'=>$avertisement));
        } else {
            throw new ApiException(400);
        }

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  section="01 Advertisement services",
     *  resource=true,
     *  description="Deletes an avertisement",
     *  statusCodes={
     *     204="Returned when successful",
     *     404="Returned when the avertisement is not found"
     *   }
     * )
     * @ParamConverter("avertisement", class="TogetherAdvertisementBundle:Advertisement")
     * @param Advertisement $avertisement
     * @return \Symfony\Component\HttpFoundation\\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAdvertisementAction(Advertisement $avertisement) {
        if ($avertisement === null) {
            throw new ApiException(404);
        } 
        $em = $this->getDoctrine()->getManager();
        $em->remove($avertisement);
        $em->flush();

        return new ApiResponse(array('avertisement'=>$avertisement));
    } 

}
