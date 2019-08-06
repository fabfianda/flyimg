<?php

namespace Tests\Core\Processor;

use Tests\Core\BaseTest;

/**
 * Class FaceDetectProcessorTest
 * @package Tests\Core\Processor
 */
class FaceDetectProcessorTest extends BaseTest
{
    /**
     * @throws \Exception
     */
    public function testProcessFaceCropping()
    {
        $image = $this->imageHandler->processImage('fc_1,o_jpg,rf_1', parent::FACES_TEST_IMAGE);
        $image1 = new \Imagick($image->getOutputImagePath());
        $image2 = new \Imagick(parent::FACES_CP0_TEST_IMAGE);
        $result = $image1->compareImages($image2, \Imagick::METRIC_MEANSQUAREERROR);
        $this->generatedImage[] = $image;
        $this->assertFileExists($image->getOutputImagePath());
        $this->assertEquals(0, $result[1]);
    }

    /**
     * @throws \Exception
     */
    public function testProcessFaceBlurring()
    {
        $image = $this->imageHandler->processImage('fb_1,o_jpg,rf_1', parent::FACES_TEST_IMAGE);
        $image1 = new \Imagick($image->getOutputImagePath());
        $image2 = new \Imagick(parent::FACES_BLUR_TEST_IMAGE);
        $result = $image1->compareImages($image2, \Imagick::METRIC_MEANSQUAREERROR);
        $this->generatedImage[] = $image;
        $this->assertFileExists($image->getOutputImagePath());
        $this->assertEquals(0, $result[1]);
    }
}
