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

use Exception;
use Throwable;
use yii\db\Query;
use SimpleXMLElement;
use Zend\Feed\Reader\Reader;
use open20\amos\core\widget\WidgetGraphic;
use Zend\Http\Client\Adapter\Exception\TimeoutException;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetGraphicsExternalRss
 */
class WidgetGraphicsExternalRss extends WidgetGraphic
{

	/**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel('External RSS');
        $this->setDescription("Widget for viewing RSS content");
    }


    /**
     * Method to extract RSS Content Items
     *
     * @param array | $rss_parameters | Array with parameters to save the contents to a file 
     * @key string  |type                    | "file" or "db"
     * @key string  |file_path               | file save path
     * @key string  |file_name               | file name 
     * @key array   |number_content_elements | number of content elements to extract 
     * 
     * @return void
     */
    public function renderWidget($rss_parameters = null){

        $rss_contents = null;
        $rss_content_list = null;

        // check if exist url and get rss contents
        if( $this->isValidUrl($rss_parameters['url']) && ($rss_contents = $this->getRssContents($rss_parameters['url'])) ){

            // check if type of save is file or db
            if( $rss_parameters['type'] == 'file' ){

                $this->saveRssFile($rss_parameters['file_name'], $rss_parameters['file_path'], $rss_parameters['url']);
            }

        }else{

            // in case the feed url is not reachable, I proceed with the extraction of the content from the file 
            if( $rss_parameters['type'] == 'file' ){
               
                $rss_contents = $this->getRssContentsFromFile($rss_parameters['file_name'], $rss_parameters['file_path']);
            }
        }

        // get only specified number of items
        $rss_content_list = $this->getRssItemsFromContent($rss_contents, $rss_parameters['number_content_elements']);


        
		return $this->render("widget_graphics_external_rss", [
			'rss_content_list' => $rss_content_list,
			'widget' => $this,
		]);

    }


    /**
     * Method to get Rss Content from file
     *
     * @param string $file_name
     * @param string $file_path
     * @param string $url
     * @return array | $rss_contents
     */
    public static function getRssContentsFromFile($file_name, $file_path){

        $rss_contents = null;

        if( file_exists($file_path . "/" . $file_name) ){

            $rss_contents = simplexml_load_file($file_path . "/" . $file_name);
            $rss_contents = json_decode(json_encode((array)$rss_contents), TRUE);
        }

        return $rss_contents;
    }


    /**
     * Method to get specific number of content items 
     *
     * @param [type] $rss_contents
     * @param integer $number_content_elements
     * @return array | $rss_content_list
     */
    public static function getRssItemsFromContent($rss_contents, $number_content_elements){

        $rss_content_list = null;
        $count = 0;

		foreach ($rss_contents['channel']['item'] as $key => $item) {

			if( $count < $number_content_elements){

				$count++;

				$rss_content_list[] = $item;

			}else{

				break;
			}
		}

        return $rss_content_list;
    }


	/**
	 * Method to create and save rss contents in to xml file
	 *
	 * @param string $url       | url to rss
	 * @param string $path_file | path to save the file
	 * @param string $file_name | name of file with extension
	 * 
	 * @return boolean
	 */
    public static function saveRssFile($file_name, $file_path, $url){

        $file_name_old = $file_path . "/old_" . $file_name;
		$file_name = $file_path . "/" . $file_name;

        // create a directory with permission 0755 / if is not, then directory already exists
		if(!mkdir($file_path, 0755, true)){

			// then directory exist, rename the file 
			rename($file_name, $file_name_old);
		}

        // create a file for rss contest
        if( !$file = fopen($file_name, 'a+') ){
            return false;
        }

        // get the rss contents to save in the file 
		$rss_contents = file_get_contents($url);

		// save the rss contents 
		fwrite($file, $rss_contents);

		fclose($file);
		
		// change file permissions
		chmod($file, 0755); 

        return true;
    }


    /**
     * Method to check if rss feed content is valid and return it
     *
     * @param string $url
     * @return array $rss_contents
     */
    public static function getRssContents($url){

        $rss_contents = file_get_contents($url); 

		try {

			$rss_contents = new SimpleXmlElement($rss_contents); 

            if( isset($rss_contents->channel->item) ){

                // estrazione del contenuto
                $feed = implode(file($url));
                $xml = simplexml_load_string($feed);
                $json = json_encode($xml);
                $rss_contents = json_decode($json,TRUE);

                return $rss_contents;
            }

		} catch (TimeoutException $e) {

			return null;
			
		} catch(Exception $e){ 
			
			/* the data provided is not valid XML */
			return null; 
		}

        return null;
    }


    /**
     * Method to check if exist the url
     *
     * @param string $url
     * @return boolean
     */
    public static function isValidUrl($url){

        $array = get_headers($url);
		$string = $array[0];

		if( strpos($string, "200") ){

			return true;
		}

        return false;
    }



}