<?php

namespace Core\Controller;

use Core\Entity\Response;

class DefaultController extends CoreController
{
    /**
     * @return string
     */
    public function indexAction()
    {
        return $this->render('Default/index');
    }

    /**
     * @param string $options
     * @param string $imageSrc
     *
     * @return Response
     * @throws \Exception
     */
    public function uploadAction(string $options, string $imageSrc = null): Response
    {
	if (strstr($imageSrc,'url=')){
		$imageSrc=explode('url=',$imageSrc);
		$imageSrc=array_pop($imageSrc);	
		$imageSrc=urldecode($imageSrc);
		$imageSrc=explode('&cfs',$imageSrc);
		$imageSrc=array_shift($imageSrc);	
	}

        $image = $this->imageHandler()->processImage($options, $imageSrc);

        $this->response->generateImageResponse($image);

        return $this->response;
    }

    /**
     * @param string $options
     * @param string $imageSrc
     *
     * @return Response
     * @throws \Exception
     */
    public function pathAction(string $options, string $imageSrc = null): Response
    {
        $image = $this->imageHandler()->processImage($options, $imageSrc);

        $this->response->generatePathResponse($image);

        return $this->response;
    }
}
