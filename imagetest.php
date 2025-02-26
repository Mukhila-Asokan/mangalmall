<?PHP 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ImageTest {
    public function testImageProcessing() {
        try {
            $manager = new ImageManager(new Driver());
            dd($manager->version()); // Check the version
        } catch (\Exception $e) {
            dd($e->getMessage()); // Dump the error message
        }
    }
}


$imageTest = new ImageTest();
$imageTest->testImageProcessing();
