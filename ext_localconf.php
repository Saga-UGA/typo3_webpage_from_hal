<?php
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'SAGA.'.$_EXTKEY,
    'WebpageFromHal',
    array('Default' => 'show'),
    array('Default' => ''),
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);