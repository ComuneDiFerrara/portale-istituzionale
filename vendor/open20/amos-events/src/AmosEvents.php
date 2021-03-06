<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\events
 * @category   CategoryName
 */

namespace open20\amos\events;

use open20\amos\core\interfaces\CmsModuleInterface;
use open20\amos\core\interfaces\SearchModuleInterface;
use open20\amos\core\module\AmosModule;
use open20\amos\core\module\ModuleInterface;
use open20\amos\events\models\Event;
use open20\amos\events\models\search\EventSearch;
use open20\amos\events\widgets\icons\WidgetIconEvents;
use open20\amos\events\widgets\icons\WidgetIconEventsCreatedBy;
use open20\amos\events\widgets\icons\WidgetIconEventsManagement;
use open20\amos\events\widgets\icons\WidgetIconEventsToPublish;
use open20\amos\events\widgets\icons\WidgetIconEventTypes;
use open20\amos\events\widgets\InviteUserToEventWidget;
use yii\helpers\ArrayHelper;

/**
 * Class AmosEvents
 * @package open20\amos\events
 */
class AmosEvents extends AmosModule implements ModuleInterface, SearchModuleInterface, CmsModuleInterface
{

    /**
     * @var array $defaultListViews This set the default order for the views in lists
     */
    public $defaultListViews = ['calendar', 'grid'];
    
    /**
     * @var string $defaultView Set the default view for module
     */
    public $defaultView = 'calendar';


    public static $CONFIG_FOLDER = 'config';
    
    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'open20\amos\events\controllers';
    
    public $newFileMode = 0666;
    public $name = 'Events';
    
    /**
     * If this attribute is true the validation of the publication date is active
     * @var boolean $validatePublicationDateEnd
     */
    public $validatePublicationDateEnd = true;
    
    /**
     * @var bool|false $enableGoogleMap
     */
    public $enableGoogleMap = true;
    
    /**
     * @var bool|false $enableInvitationManagement
     */
    public $enableInvitationManagement = true;
    
    /**
     * @var bool|false $hidePubblicationDate
     */
    public $hidePubblicationDate = false;
    
    /**
     * This param enable or disable the export button in lists.
     * @var bool $enableExport
     */
    public $enableExport = true;
    
    /**
     * This param enables enables multiple recording for the same event.
     * @var bool $multipleRecording
     */
    public $multipleRecording = false;
    
    /**
     * @var array $eventsRequiredFields
     */
    public $eventsRequiredFields = [
        'title',
        'summary',
        'description',
        'begin_date_hour',
        'event_type_id',
        'publish_in_the_calendar',
        'event_management',
        'event_commentable',
    ];
    
    /**
     * @var bool $eventLengthRequired If true enable the required validator on field "length"
     */
    public $eventLengthRequired = false;
    
    /**
     * @var bool $eventMURequired If true enable the required validator on length measurement unit
     */
    public $eventMURequired = false;
    
    /**
     * @var bool $forceEventCommentable
     */
    public $forceEventCommentable = '1';
    
    /**
     * @inheritdoc
     */
    public $db_fields_translation = [
        [
            'namespace' => 'open20\amos\events\models\EventType',
            'attributes' => ['title'],
            'category' => 'amosevents',
        ],
        [
            'namespace' => 'open20\amos\events\models\AgidEventTypology',
            'attributes' => ['name'],
            'category' => 'amosevents',
        ],
    ];
    
    public $viewPathEmailSummary = [
        'open20\amos\events\models\Event' => '@vendor/open20/amos-events/src/views/email/notify_summary'
    ];
    
    public $viewPathEmailSummaryTitle = [
        'open20\amos\events\models\Event' => '@vendor/open20/amos-events/src/views/email/notify_summary_title'
    ];
    
    /**
     * @var bool $enableSeatsManagement
     */
    public $enableSeatsManagement = true;
    
    /**
     * @var bool $enableAutoInviteUsers If true enable the auto invite of the event recipients when the event is published.
     */
    public $enableAutoInviteUsers = false;
    
    public $tempPath = '@backend/web/ticket_download';
    
    /**
     * @var bool $enableGdpr If true enable the GDPR in all the plugin.
     */
    public $enableGdpr = true;
    
    /**
     * @var bool $enableCommunitySections If true enable the community sections in all the plugin.
     */
    public $enableCommunitySections = true;
    
    /**
     * @var bool $actionCreatedByOnlyViewGrid If true the only list view for the action created by is the grid view.
     */
    public $actionCreatedByOnlyViewGrid = true;
    
    /**
     * @var bool
     */
    public $enableCalendarsManagement = false;
    
    /**
     * @var bool $forceEventSubscription if true the user is immediatly subscribed to event
     */
    public $forceEventSubscription = false;
    
    /**
     * @var bool $viewEventSignupLinkInForm If true enable a read only field that show the event sign-up generic link
     */
    public $viewEventSignupLinkInForm = false;
    
    /**
     * @var bool $enableContentDuplication If true enable the content duplication on each row in table view
     */
    public $enableContentDuplication = false;
    
    /**
     * @var bool $enableEventRooms If true enable the event rooms management and event rooms select in event form
     */
    public $enableEventRooms = false;
    
    /**
     * @var bool $showInvitationsInEventView With this parameter true, the plugin show the invitations list in event view.
     */
    public $showInvitationsInEventView = false;
    
    /**
     * @var bool $saveExternalInvitations With this parameter true, the plugin save the external excel invitations, like old style plugin.
     */
    public $saveExternalInvitations = false;
    
    /**
     * @var bool $enableAgid This parameter enable the plugin to be compliant with AGID events.
     */
    public $enableAgid = false;
    
    /**
     * @var bool $enableAgid This parameter allow the user to select a custom end of the event instead of select duration with duration unit.
     */
    public $freeSelectEndOfTheEvent = false;
    
    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return 'events';
    }
    
    /**
     * @inheritdoc
     */
    public static function getModuleIconName()
    {
        return 'calendar';
    }
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        \Yii::setAlias('@open20/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers/');
        // custom initialization code goes here
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php');
        \Yii::configure($this, ArrayHelper::merge($config, ["params" => $this->params]));
    }
    
    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return null;
    }
    
    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [
            WidgetIconEvents::className(),
            WidgetIconEventTypes::className(),
            WidgetIconEventsCreatedBy::className(),
            WidgetIconEventsToPublish::className(),
            WidgetIconEventsManagement::className(),
        ];
    }
    
    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [
            'AgidAdministrativePersonsMm' => __NAMESPACE__ . '\\' . 'models\AgidAdministrativePersonsMm',
            'AgidEventDocumentsMm' => __NAMESPACE__ . '\\' . 'models\AgidEventDocumentsMm',
            'AgidEventTypology' => __NAMESPACE__ . '\\' . 'models\AgidEventTypology',
            'AgidRelatedEventMm' => __NAMESPACE__ . '\\' . 'models\AgidRelatedEventMm',
            'Event' => __NAMESPACE__ . '\\' . 'models\Event',
            'EventAccreditationList' => __NAMESPACE__ . '\\' . 'models\EventAccreditationList',
            'EventCalendars' => __NAMESPACE__ . '\\' . 'models\EventCalendars',
            'EventCalendarsSlots' => __NAMESPACE__ . '\\' . 'models\EventCalendarsSlots',
            'EventInvitation' => __NAMESPACE__ . '\\' . 'models\EventInvitation',
            'EventInvitationPartner' => __NAMESPACE__ . '\\' . 'models\EventInvitationPartner',
            'EventInvitationsUpload' => __NAMESPACE__ . '\\' . 'models\EventInvitationsUpload',
            'EventLengthMeasurementUnit' => __NAMESPACE__ . '\\' . 'models\EventLengthMeasurementUnit',
            'EventMembershipType' => __NAMESPACE__ . '\\' . 'models\EventMembershipType',
            'EventParticipantCompanion' => __NAMESPACE__ . '\\' . 'models\EventParticipantCompanion',
            'EventParticipantCompanionDynamic' => __NAMESPACE__ . '\\' . 'models\EventParticipantCompanionDynamic',
            'EventRoom' => __NAMESPACE__ . '\\' . 'models\EventRoom',
            'EventSeats' => __NAMESPACE__ . '\\' . 'models\EventSeats',
            'EventType' => __NAMESPACE__ . '\\' . 'models\EventType',
            'EventTypeContext' => __NAMESPACE__ . '\\' . 'models\EventTypeContext',
            'FormAssignSeat' => __NAMESPACE__ . '\\' . 'models\FormAssignSeat',
            'RegisterGroupForm' => __NAMESPACE__ . '\\' . 'models\RegisterGroupForm',
            'EventAccreditationListSearch' => __NAMESPACE__ . '\\' . 'models\search\EventAccreditationListSearch',
            'EventCalendarsSearch' => __NAMESPACE__ . '\\' . 'models\search\EventCalendarsSearch',
            'EventCalendarsSlotsSearch' => __NAMESPACE__ . '\\' . 'models\search\EventCalendarsSlotsSearch',
            'EventRoomSearch' => __NAMESPACE__ . '\\' . 'models\search\EventRoomSearch',
            'EventSearch' => __NAMESPACE__ . '\\' . 'models\search\EventSearch',
            'EventTypeSearch' => __NAMESPACE__ . '\\' . 'models\search\EventTypeSearch',
        ];
    }
    
    /**
     * @param \Google_Service_Calendar $serviceGoogle
     * @param string $calendarId
     * @param string $message
     * @return string $message
     */
    public function synchronizeEvents($serviceGoogle, $calendarId, $message = '')
    {
        /** @var EventSearch $eventSearch */
        $eventSearch = $this->createModel('EventSearch');
        $all = $eventSearch->buildQuery([], 'all')->select('event.id')->column();
        $createdBy = $eventSearch->buildQuery([], 'created-by')->select('event.id')->column();
        /** @var Event[] $events */
        $events = $eventSearch->baseSearch([])->andWhere([
            'event.id' => ArrayHelper::merge($all, $createdBy)
        ])->all();
        $eventList = $serviceGoogle->events->listEvents($calendarId);
        $items = $eventList->getItems();
        $insertAll = false;
        if (empty($items)) {
            $insertAll = true;
            $isUpdate = false;
        } else {
            $isUpdate = true;
        }
        
        $insertCount = 0;
        $updatedCount = 0;
        foreach ($events as $event) {
            if ($event->begin_date_hour) {
                $eventId = $event->getGoogleEventId();
                $eventCalendar = null;
                if (!$insertAll) {
                    try {
                        $eventCalendar = $serviceGoogle->events->get($calendarId, $eventId);
                        $isUpdate = true;
                    } catch (\Google_Service_Exception $ex) {
                        $isUpdate = false;
                    }
                }
                $eventCalendar = $event->getGoogleEvent($eventCalendar);
                try {
                    if ($insertAll || !$isUpdate) {
                        $serviceGoogle->events->insert($calendarId, $eventCalendar);
                        $insertCount++;
                    } else {
                        $serviceGoogle->events->update($calendarId, $eventId, $eventCalendar);
                        $updatedCount++;
                    }
                } catch (\Google_Service_Exception $e) {
                    $message .= '<br/>' . $e->getMessage() . '<br/>';
                }
            }
        }
        if ($insertCount) {
            $message .= '<br/>' . AmosEvents::t('amosevents', 'Events added:') . ' ' . $insertCount;
        }
        if ($updatedCount) {
            $message .= '<br/>' . AmosEvents::t('amosevents', 'Events updated:') . ' ' . $updatedCount;
        }
        
        return $message;
    }
    
    /**
     * @inheritdoc
     */
    public static function getModelSearchClassName()
    {
        return AmosEvents::instance()->model('EventSearch');
    }
    
    /**
     * @inheritdoc
     */
    public static function getModelClassName()
    {
        return AmosEvents::instance()->model('Event');
    }
    
    /**
     * Same as calling AmosEvents::t('amosevents', ...$args)
     * @return string
     */
    public static function txt($txt, ...$args)
    {
        return self::t('amosevents', $txt, ...$args);
    }
    
    /**
     * Same as calling AmosEvents::tHtml('amosevents', ...$args)
     * @return string
     */
    public static function txtHtml($txt, ...$args)
    {
        return self::tHtml('amosevents', $txt, ...$args);
    }
    
    /**
     * @param \open20\amos\admin\models\UserProfile $model
     * @return string
     * @throws \Exception
     */
    public function getInviteUserToEventWidget($model)
    {
        return InviteUserToEventWidget::widget(['model' => $model]);
    }
    
    /**
     * @return bool|string
     */
    public function getTempPath()
    {
        return \Yii::getAlias($this->tempPath);
    }
    
    /**
     * @inheridoc
     */
    public function getFrontEndMenu($dept = 1)
    {
        $menu = parent::getFrontEndMenu();
        $app = \Yii::$app;
        if (!$app->user->isGuest && (\Yii::$app->user->can('EVENTS_READER')||\Yii::$app->user->can('REDACTOR_EVENTS')) ) {
            $menu .= $this->addFrontEndMenu(AmosEvents::t('amosevents', '#menu_front_events'), AmosEvents::toUrlModule('/event/all-events'), $dept);
        }
        return $menu;
    }
}
