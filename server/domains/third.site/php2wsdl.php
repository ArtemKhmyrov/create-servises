<?php


include "vendor/autoload.php";

class Courses{
    /**
     * @soap
     */
    public function myCoursesMethod($id){
       return[];
    }
}

$class = "Courses";

$serviceURI = "https://third.site/soap";
$wsdlGenerator = new PHP2WSDL\PHPClass2WSDL($class, $serviceURI);
// Generate the WSDL from the class adding only the public methods that have @soap annotation.
$wsdlGenerator->generateWSDL(true);
// Dump as string
$wsdlXML = $wsdlGenerator->dump();
// Or save as file
$wsdlXML = $wsdlGenerator->save('courses.wsdl');