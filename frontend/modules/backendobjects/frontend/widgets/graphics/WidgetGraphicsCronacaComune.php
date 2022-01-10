<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\events\widgets\graphics
 * @category   CategoryName
 */

namespace frontend\modules\backendobjects\frontend\widgets\graphics;

use DateTime;
use Exception;
use Throwable;
use yii\db\Query;
use SimpleXMLElement;
use Zend\Feed\Reader\Reader;
use open20\amos\core\widget\WidgetGraphic;
use Zend\Http\Client\Adapter\Exception\TimeoutException;
use open20\amos\notificationmanager\base\NotifyWidgetDoNothing;


/**
 * Class WidgetGraphicsCronacaComune
 */
class WidgetGraphicsCronacaComune extends WidgetGraphic
{

	/**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel('Cronaca Comune');
        $this->setDescription("Widget per la visualizzazione dei contenuti RSS");
    }

	/**
	 * Metodo per l'estrazione dei contenuti dal portale Cronaca Comune
	 *
	 * @param integer $number_contents
	 * @param string $rss_feed_url
	 * @return render to view 
	 */
	public function renderViewWidget($number_content_items = 9, $rss_feed_url = 'https://www.cronacacomune.it/feedlabel/home-page/'){

		// array for Rss Contents
		$list_item = array();
		// file path and name
		$file_path = \Yii::getAlias('@frontend') . "/web/uploads/rss";
		$file_name = "rss_cronacacomune";


		// check if is correct url and check for validate rss feed content
		if( $this->isUrlOnline($rss_feed_url) && $this->validateRssFeed($rss_feed_url) ){

			// get rss feed content
			$content = $this->getRssFeedContent($rss_feed_url);

			// create rss file and save the rss contents
			$this->saveRssFile($rss_feed_url, $file_path, $file_name);
		
		}else{

			// in case the feed url is not reachable, I proceed with the extraction of the content from the file 
			$content = simplexml_load_file($file_path . "/" . $file_name . ".xml");
			$content = json_decode(json_encode((array)$content), TRUE);
		}

		// get only specified number of items
		$list_item = $this->getItemList($content, $number_content_items);

		return $this->render("rss_contenuti_cronaca_comune", [
			'list_item' => $list_item,
			'number_content_items' => $number_content_items,
			'widget' => $this,
		]);
	}


	/**
	 * Method to create and save rss contents in to xml file
	 *
	 * @param string $rss_feed_url -> url to rss
	 * @param string $file_path -> path to save the file
	 * @param string $file_name -> name of file
	 * 
	 * @return void
	 */
	public function saveRssFile($rss_feed_url, $file_path, $file_name){

		$file_name_old_rss = $file_path . "/old_" . $file_name . ".xml";
		$file_name_rss = $file_path . "/" . $file_name . ".xml";

		// create a directory with permission 0755 / if is not, then directory already exists
		if(!mkdir($file_path, 0755, true)){

			// then directory exist, rename the file 
			rename($file_name_rss, $file_name_old_rss);
		}

		// create a file for rss contest
		$file_rss = fopen($file_name_rss, 'a+'); 

		// get the rss contents to save in the file 
		$rss_contents = file_get_contents($rss_feed_url);

		// save the rss contents 
		fwrite($file_rss, $rss_contents);

		fclose($file_rss);
		
		// change file permissions
		chmod($file_rss, 0755); 
	}


	/**
	 * Method to extract Rss feed content from rss feed url
	 *
	 * @param string $rss_feed_url
	 * @return array | $content
	 */
	public function getRssFeedContent($rss_feed_url){

		// estrazione del contenuto
		$feed = implode(file($rss_feed_url));
		$xml = simplexml_load_string($feed);
		$json = json_encode($xml);
		$content = json_decode($json,TRUE);

		return $content;
	}


	/**
	 * Method to get specific number of content items 
	 *
	 * @param array | rss | $content
	 * @param integer | $number_content_items
	 * @return array $list_item
	 */
	public function getItemList($content, $number_content_items){
		
		$list_item = array();
		$count = 0;

		foreach ($content['channel']['item'] as $key => $item) {

			if( $count < $number_content_items){
				$count++;

				$list_item[] = $item;

			}else{

				break;
			}
		}

		return $list_item;
	}


	/**
	 * Method to check if exist the url
	 *
	 * @param string $url
	 * @return boolean
	 */
	public function isUrlOnline($rss_feed_url){

		$array = get_headers($rss_feed_url);
		$string = $array[0];

		if( strpos($string,"200") ){

			return true;

		}else{

			return false;
		}
	}

	
	/**
	 * Method to check if rss feed content is valid
	 *
	 * @param string $url
	 * @return boolean
	 */
	public function validateRssFeed($rss_feed_url){

		$content = file_get_contents($rss_feed_url); 

		try {

			$rss = new SimpleXmlElement($content); 

			return isset($rss->channel->item) ? true : false;

		} catch (TimeoutException $e) {

			return false;
			
		} catch(Exception $e){ 
			
			/* the data provided is not valid XML */
			return false; 
		}
	}

}



