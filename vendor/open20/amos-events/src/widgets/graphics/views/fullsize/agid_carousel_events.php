<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    retecomuni\frontend\views\site\parts
 * @category   CategoryName
 */
use DateTime;
use DateTimeZone;
use IntlDateFormatter;
use open20\amos\events\AmosEvents;
use app\modules\backendobjects\frontend\Module;

$module = Module::getInstance();

?>

<div class="calendary" id="calendar_carousel_ev">

    <section class="pb-5">

        <div>
            <!-- 2 variabili: ognuna per dire quale è la label attivo/disattivo -->

           

                    <section class="calendar-section">
                        <div class=" pb-5 pt-0">
                            <div class="container">
                                <div class="row row-calendar">
                                    <div class="it-carousel-wrapper it-carousel-landscape-abstract-three-cols it-calendar-wrapper">
                                        <div class="it-header-block">
                                            <div class="it-header-block-title">

                                                <?php
                                                    // current date
                                                    $current_date = date('Y-m-d');

                                                    $month = \Yii::$app->formatter->asDate($current_date, 'php:m');
                                                    $count = 1;
                                                    foreach ($list_events_grouped as $key => $events) {

                                                        if( \Yii::$app->formatter->asDate($key, 'php:m') != \Yii::$app->formatter->asDate($current_date, 'php:m')){
                                                            
                                                            if($count == 1){
                                                                $month = ucfirst(\Yii::$app->formatter->asDate($key, 'php:F'))." ".\Yii::$app->formatter->asDate($key, 'php:Y');
                                                                break;
                                                            }else{
                                                                $month = ucfirst(\Yii::$app->formatter->asDate(date('Y-m-d', strtotime($key . '-1 month')), 'php:F')) . " / " . ucfirst(\Yii::$app->formatter->asDate($key, 'php:F')) . " " . \Yii::$app->formatter->asDate($key, 'php:Y');
                                                            }

                                                        }else{

                                                            $month = ucfirst(\Yii::$app->formatter->asDate($current_date, 'php:F'))." ".\Yii::$app->formatter->asDate($current_date, 'php:Y');
                                                        }

                                                        $count++;
                                                    }
                                                ?>

                                                <p id="p-calendar-two-month" class="mb-0 text-center text-white h4">
                                                    <?= $month ?>
                                                </p>
                                                
                                            </div>
                                        </div>
                                        <div class="it-carousel-all owl-carousel it-card-bg owl-loaded owl-drag">

                                            <div class="owl-stage-outer pt-0">
                                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1702px;">
                                                    <?php if (isset($list_events_grouped) && !empty($list_events_grouped)) : ?>
                                                        <?php
                                                            $count_events = 0;
                                                        ?>
                                                        
                                                        <?php foreach ($list_events_grouped as $key => $events) : ?>

                                                            <div class="owl-item active" style="width: 212.75px;">
                                                                <div class="it-single-slide-wrapper h-100 pt-0">
                                                                    <div class="card-wrapper h-100">
                                                                        <div class="card card-bg">
                                                                            <div class="card-body">
                                                                                <?php 
                                                                                    // event date
                                                                                    $event_begin_date_hour = new DateTime($key);
                                                                                ?>
                                                                                <div class="event_begin_date_hour" data-day="<?= $event_begin_date_hour->format('d') ?>" hidden></div>

                                                                                <h5 class="card-title my-0 border-bottom ">
                                                                                    <?php
                                                                                        echo $event_begin_date_hour->format('d');
                                                                                    ?>
                                                                                    <span>
                                                                                        <?= ucfirst(\Yii::$app->formatter->asDate($event_begin_date_hour, 'php:l')) ?>
                                                                                    </span>
                                                                                </h5>


                                                                                <?php if (!empty($events)): ?>
                                                                                    <?php foreach ($events as $key => $event) : ?>

                                                                                        <div class="py-3 w-100 border-bottom  event-calendar-text Scadenze" style="display: inline-block;">
                                                                                            <?php
                                                                                            $route = \Yii::$app->getModule('backendobjects')::getDetachUrl($event->id,
                                                                                                    $event->className(),
                                                                                                    $module->modelsDetailMapping[$event->className()]);
                                                                                            ?>
                                                                                            <a href="<?= $route ?>" class=" text-decoration-none small w-100 h-100 d-inline-block "><?= $event->title ?></a>
                                                                                        </div>

                                                                                    <?php endforeach; ?>
                                                                                <?php else: ?>
                                                                                    <div class="py-3 w-100 border-bottom small event-calendar-text ">
                                                                                        <?= AmosEvents::t('amosevents', '#no_events_day') ?>
                                                                                    </div>
                                                                                    
                                                                                <?php endif; ?>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <?php
                                                                $count_events++;
                                                            ?>

                                                        <?php endforeach; ?>

                                                        <?php if ($count_events != 4) : ?>
                                                            <?php
                                                                $last_event_begin_date_hour = $event_begin_date_hour;
                                                            ?>
                                                            <?php for ($i = 0; $i < (4 - $count_events); $i++) : ?>

                                                                <div class="owl-item active" style="width: 212.75px;">
                                                                    <div class="it-single-slide-wrapper h-100 pt-0">
                                                                        <div class="card-wrapper h-100">
                                                                            <div class="card card-bg">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title my-0 border-bottom ">
                                                                                        <?php
                                                                                        $last_event_begin_date_hour = $last_event_begin_date_hour->modify('+1 day');
                                                                                        echo $last_event_begin_date_hour->format('d');
                                                                                        ?>
                                                                                        <span>
                                                                                            <?=
                                                                                                ucfirst(\Yii::$app->formatter->asDate($last_event_begin_date_hour, 'php:l'))
                                                                                            ?>
                                                                                        </span>
                                                                                    </h5>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php endfor; ?>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                </div>
                                            </div>

                                            <div class="owl-nav eneabled">
                                                <?php
                                                $urlCurrent = strtok(\Yii::$app->request->url, '?');
                                                if ($next > 1) {
                                                    ?>
                                                    <a class="owl-prev btn" href="<?= $urlCurrent ?>?cal_next=<?= ($next - 2) ?>#calendar_carousel_ev"></a>
                                                <?php }else{ ?>
                                                    <a class="owl-prev btn disabled" href="#" ></a>
                                                <?php } ?>

                                                <a class="owl-next btn"  href="<?= $urlCurrent ?>?cal_next=<?= ($next + 2) ?>#calendar_carousel_ev"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                

            
        </div>
    </section>

</div>


