<?php
namespace SAGA\WebpageFromHal\Util;

use TYPO3\CMS\Core\Utility\GeneralUtility;

use SAGA\WebpageFromHal\Exceptions;

class Hal
{
    /**
     * String $url
     */
    private $url;

    /**
     * TYPO3\CMS\Core\Log\LogManager $logger
     */
    private $logger;

    public function __construct()
    {
        $this->logger = GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')
            ->getLogger(__CLASS__);
    }

    public function setUrl($url) 
    {
        $this->url = $url;

        return $this;
    }

    public function getHtml()
    {
        try {
            $this->isValidHost();
            $html = $this->sendRequest();
            $res = $this->extractHtml($html);
            
        } catch (Exceptions\HalException $e) {
            $this->logger->error($e->getMessage());
            
            throw $e;
        }

        return $res;
    }

    private function isValidHost()
    {
        $infos = parse_url($this->url);
        $ip = gethostbyname($infos['host']);

        if ($ip != '193.48.96.10') {
            throw new Exceptions\InvalidHostException(sprintf('Invalid host: [%s]', $this->url));
        } 
        
        return true;
    }

    private function sendRequest() 
    {
        $request = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            'TYPO3\\CMS\\Core\\Http\\HttpRequest',
            $this->url
        );
        
        try {
            $result = $request->send();

        } catch(\Exception $e) {
            throw new Exceptions\BadHttpRequestException(sprintf('Error to request Url: [%s] ; Error code: %s', $this->url, $e->getCode()));

        }

        return $result->getBody();
    }

    private function extractHtml($html)
    {
        $dom = new \DomDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;

        $dom->loadXML($html);
        $xpath = new \DOMXpath($dom);
        
        $entries = $xpath->query('//div[@id="res_script"]');

        if ($entries->length == 0) {
            throw new Exceptions\NoResultException();

            return;
        }

        $res = $dom->saveXML($entries->item(0));

        return $res;
    }
}