<?php

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin($_EXTKEY, 'WebpageFromHal', 'Webpage from HAL');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:webpage_from_hal/Configuration/TypoScript/pageTsConfig.ts">');

$TCA['tt_content']['types']['webpagefromhal_webpagefromhal'] = array(
    'showitem' => '--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.general;general,url',
);

$webpage_columns = array(
    'url' => array(
        'label' => 'Url',
        'config' => array(
            'type' => 'text',
            'cols' => 20,
            'rows' => 3,
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $webpage_columns);