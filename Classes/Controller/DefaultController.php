<?php
namespace SAGA\WebpageFromHal\Controller;

use SAGA\WebpageFromHal\Util\Hal;
use SAGA\WebpageFromHal\Exceptions;

class DefaultController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    public function showAction()
    {
        $data = $this->configurationManager->getContentObject()->data;
        $url = $data['url'];

        $hal = new Hal();
        
        try {
            $publications = $hal
                ->setUrl($url)
                ->getHtml()
                ;

            $this->view->assign('publications', $publications);

        } catch(Exceptions\HalException $e) {
            return null;

        }
    }
}