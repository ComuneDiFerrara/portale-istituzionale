<?php

namespace luya\admin\controllers;

use Yii;
use luya\admin\Module;
use luya\admin\models\StorageFile;
use luya\admin\events\FileDownloadEvent;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * File Download Controller
 *
 * @since 1.0.0
 */
class FileController extends \luya\web\Controller
{
    /**
     * File Download Action.
     *
     * @param integer $id
     * @param string $hash
     * @param string $fileName
     * @return \yii\web\Response
     */
    public function actionDownload($id, $hash, $fileName)
    {
        // find file in file query
        $fileData = Yii::$app->storage->findFile(['id' => $id, 'hash_name' => $hash, 'is_deleted' => false]);
        // proceed when file exists
        if ($fileData && $fileData->fileExists) {
            // verify again against database to add counter
            $model = StorageFile::findOne($fileData->id);
            // proceed when model exists
            if ($model) {
                $event = new FileDownloadEvent(['file' => $fileData]);
                
                Yii::$app->trigger(Module::EVENT_BEFORE_FILE_DOWNLOAD, $event);
                
                if (!$event->isValid) {
                    throw new BadRequestHttpException('Unable to perform this file download request due to access restrictions.');
                }
                
                // update the model count stats
                $model->updateCounters(['passthrough_file_stats' => 1]);

                return Yii::$app->response->sendContentAsFile($fileData->content, $model->name_original, [
                    'inline' => (bool) $model->inline_disposition,
                    'mimeType' => $model->mime_type,
                ]);
            }
        }
        
        // throw not found http exception, will not trigger error api transfer.
        throw new NotFoundHttpException("Unable to find requested file '{$fileName}'.");
    }
}
