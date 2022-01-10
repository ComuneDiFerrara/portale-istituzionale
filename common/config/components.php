<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\basic\template
 * @category   CategoryName
 */

$psrLogger = new \Monolog\Logger('logger');
$psrHandler = new \Monolog\Handler\RotatingFileHandler(__DIR__. '/../runtime/logs'.'/main_' . date('Y-m-d') . '.log', 5, \Monolog\Logger::DEBUG);
$psrFormatter = new \Monolog\Formatter\LineFormatter(null, 'Y-m-d H::i::s', true);
$psrFormatter->includeStacktraces();
$psrHandler->setFormatter($psrFormatter);
$psrLogger->pushHandler($psrHandler);
$psrLogger->pushProcessor(new \Monolog\Processor\PsrLogMessageProcessor());

return [

    'workflowSource' => [
        'class' => 'open20\amos\core\workflow\ContentDefaultWorkflowDbSource',
    ],
    'imageUtility' => [
        'class' => 'open20\amos\core\components\ImageUtility',
    ],
    'formatter' => [
        'class' => 'open20\amos\core\formatter\Formatter',
        'dateFormat' => 'php:d/m/Y',
        'datetimeFormat' => 'php:d/m/Y H:i',
        'timeFormat' => 'php:H:i',
        'defaultTimeZone' => 'Europe/Rome',
        'timeZone' => 'Europe/Rome',
        'locale' => 'it-IT',
        'thousandSeparator' => '.',
        'decimalSeparator' => ',',
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'samdark\log\PsrTarget',
                'logger' => $psrLogger,
                // It is optional parameter. The message levels that this target is interested in.
                // The parameter can be an array.
                'levels' => [Psr\Log\LogLevel::CRITICAL, yii\log\Logger::LEVEL_ERROR],
                // It is optional parameter. Default value is false. If you use Yii log buffering, you see buffer write time, and not real timestamp.
                // If you want write real time to logs, you can set addTimestampToContext as true and use timestamp from log event context.
                'addTimestampToContext' => true,
            ],
        ],
    ],
    'translatemanager' => [
        'class' => 'lajax\translatemanager\Component'
    ],
    'i18n' => [
        'translations' => [
            '*' => [
                'class' => 'open20\amos\core\i18n\MessageSource',
                'db' => 'db',
                'sourceLanguage' => 'it-IT', // Developer language
                'sourceMessageTable' => '{{%language_source}}',
                'messageTable' => '{{%language_translate}}',
                'cachingDuration' => 86400,
                'enableCaching' => false,
                'forceTranslation' => true,
                'autoUpdate' => true,
                'extraCategoryPaths' => [
                    'amoscore' => '@vendor/open20/amos-core/i18n',
                    'amos' => '@common/translation/amos/i18n',
                    'amosplatform' => '@common/translation/amosplatform/i18n',
                    'amosapp' => '@common/translation/amosapp/i18n',
                    'cruds' => '@common/translation/cruds/i18n',
                    'giiamos' => '@common/translation/giiamos/i18n',
                    'javascript' => '@common/translation/javascript/i18n',
                    'site' => '@common/translation/site/i18n',
                    'wizard' => '@common/translation/wizard/i18n',
                    'amosevents' => '@common/translation/amosevents/i18n',
                    'amosdocumenti' => '@common/translation/amosdocumenti/i18n',
                    'amosnews' => '@common/translation/amosnews/i18n',
                ],
            ],
        ],
    ],
    'authManager' => [
        'class' => 'yii\rbac\DbManager',
    ],
    'breadcrumbcache' => [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@runtime/breadcrumbcache'
    ],
    'cache' => [
        //'class' => 'yii\caching\FileCache',
        'class' => 'yii\caching\DummyCache',
    ],
    'rbacCache' => [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@runtime/rbacCache'
    ],
    'schemaCache' => [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@runtime/schemaCache'
    ],
    'translateCache' => [
        'class' => 'yii\caching\FileCache',
        'cachePath' => '@runtime/translateCache'
    ],

    'rss' => [
        'class' => 'amos\rss\components\RssFeed',
    ],

];
