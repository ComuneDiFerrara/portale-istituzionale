<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\attachments
 * @category   CategoryName
 */

namespace open20\amos\attachments\behaviors;

use open20\amos\attachments\components\CustomUploadFile;
use open20\amos\attachments\FileModule;
use open20\amos\attachments\FileModuleTrait;
use open20\amos\attachments\models\AttachGalleryImage;
use open20\amos\attachments\models\File;
use open20\amos\core\views\toolbars\StatsToolbarPanels;
use yii\base\Behavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\validators\FileValidator;
use yii\web\UploadedFile;

use yii\imagine\Image;
use yii\helpers\Json;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * Class FileBehavior
 * @property ActiveRecord $owner
 * @package file\behaviors
 */
class FileBehavior extends Behavior
{
    use FileModuleTrait;

    /**
     * @var array $permissions
     */
    public $permissions = [];

    /**
     * @var array $rules
     */
    var $rules = [];

    /**
     * @var array $fileValidators
     */
    private $fileValidators = [];

    /**
     * @var array $fileAttributes
     */
    private $fileAttributes = [];

    /**
     * @var array Attibutes to be overriden
     */
    private $overrideAttributes = [];

    /**
     * @var array $encryptedAttributes
     */
    public $encryptedAttributes = [];

    /**
     * Add files attributes as avaiable property for Getter
     * @return bool
     */
    public function canGetProperty($name, $checkVars = true)
    {
        $fileAttributes = self::getFileAttributes();

        if (in_array($name, $fileAttributes)) {
            return true;
        }

        return parent::canGetProperty($name, $checkVars);
    }

    /**
     * Add files attributes as avaiable property for Setter
     * @return bool
     */
    public function canSetProperty($name, $checkVars = true)
    {
        $fileAttributes = self::getFileAttributes();

        if (in_array($name, $fileAttributes)) {
            return true;
        }

        return parent::canSetProperty($name, $checkVars);
    }

    /**
     * Parse file behaviors and find for the choosed attribute for hasOne or hasMultiple files relation
     * @param string $name
     * @return array|mixed
     * @throws \yii\base\UnknownPropertyException
     */
    public function __get($name)
    {
        /**
         * @var FileValidator $fileValidator
         */
        $fileValidator = $this->getFileValidator($name);

        if ($fileValidator) {
            if(isset($this->overrideAttributes[$name])) {
                return $this->overrideAttributes[$name];
            }

            if ($fileValidator->maxFiles == 1) {
                return $this->hasOneFile($name);
            } else {
                return $this->hasMultipleFiles($name);
            }
        }

        //No results? return the parent getter
        return parent::__get($name); // TODO: Change the autogenerated stub
    }

    /**
     * Setter is an override tool for validation
     */
    public function __set($name, $value)
    {
        $this->overrideAttributes[$name] = $value;

        return true;
    }

    /**
     * @inheritdoc
     */
    public function events()
    {
        $events = [
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteUploads',
            ActiveRecord::EVENT_AFTER_INSERT => 'saveUploads',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveUploads',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'evalAttributes',
            ActiveRecord::EVENT_AFTER_VALIDATE => 'unevalAttributes'
        ];

        return $events;
    }

    /**
     * Iterate files and save by attribute
     * @param $event
     */
    public function saveUploads($event)
    {
        if (\Yii::$app->request->isConsoleRequest || !\Yii::$app->request->isPost) {
            return false;
        }

        $attributes = $this->getFileAttributes();

        if (!empty($attributes)) {
            foreach ($attributes as $attribute) {
                $this->saveAttributeUploads($attribute);
            }
        }
    }

    /**
     * Return array of attributes which may contain files
     * @return array
     */
    public function getFileAttributes()
    {
        $validators = $this->owner->getValidators();

        //Array of attributes
        $fileAttributes = [];

        //has file validator?
        $this->fileValidators = $this->getFileValidators($validators);

        foreach ($this->fileValidators as $fileValidator) {
            if (!empty($fileValidator)) {
                foreach ($fileValidator->attributes as $attribute) {
                    $fileAttributes[] = $attribute;
                }
            }
        }
        return $fileAttributes;
    }

    /**
     * @param $attributeName
     * @return bool|mixed|FileValidator|\yii\validators\Validator
     */
    public function getFileValidator($attributeName)
    {
        $fileValidators = $this->owner->getValidators();

        if (!empty($fileValidators)) {
            foreach ($fileValidators as $fileValidator) {
                /**
                 * @var FileValidator $fileValidator
                 */
                if (!empty($fileValidator) && $fileValidator instanceof FileValidator) {
                    foreach ($fileValidator->attributes as $attribute) {
                        if ($attribute == $attributeName) {
                            return $fileValidator;
                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * Check if owner model has file validator
     * @param ArrayObject|\yii\validators\Validator[]
     * @return \yii\validators\Validator[]
     */
    public function getFileValidators($validators)
    {
        $fileValidators = [];

        foreach ($validators as $validator) {
            /** @var \yii\validators\Validator $validator */
            $classname = $validator::className();

            if ($classname == 'yii\validators\FileValidator') {
                $fileValidators[] = $validator;
            }
        }

        return $fileValidators;
    }

    protected function saveAttributeUploads($attribute)
    {
        //Find shot model class name
        $ownerName = (new \ReflectionClass($this->owner))->getShortName();

        /**
         * @var UploadedFile[] $files
         */
        $files = UploadedFile::getInstancesByName($attribute) ?: UploadedFile::getInstancesByName("{$ownerName}[{$attribute}]");

        /**
         * BASE64 Encoded Files
         */
        $postData = \Yii::$app->request->post($ownerName);
        $fileAsString = isset($postData[$attribute]) ? $postData[$attribute] : null;

        if(!empty($fileAsString)) {
            $decodedFileTempName = md5(time().$attribute);
            $decodedFilePath = sys_get_temp_dir() . '/' . $decodedFileTempName;

            //Decode
            file_put_contents($decodedFilePath, base64_decode($fileAsString));

            //Get File Type
            $mime = mime_content_type($decodedFilePath);
            $mimes = new \Mimey\MimeTypes;
            $extension = $mimes->getExtension($mime);

            //Create new file instance
            $newFile = new CustomUploadFile();
            $newFile->name = $decodedFileTempName.'.'.$extension;
            $newFile->tempName = $decodedFilePath;
            $newFile->type = $mime;

            $files[] = $newFile;
        }

        /**
         * @var FileValidator $fileValidator
         */
        $fileValidator = $this->getFileValidator($attribute);

        //Crop data
        $cropData = \Yii::$app->request->post("{$attribute}_data");

        //Upload file from gallery
        $csrf = \Yii::$app->request->post("_csrf-backend");
        $dataImage = \Yii::$app->session->get($csrf);

        if(!empty($dataImage)) {
            $this->saveFileFormGallery($attribute, $csrf, $dataImage);
        }

        foreach ($files as $file) {
            if ($fileValidator && $fileValidator->maxFiles == 1 && file_exists($file->tempName)) {
                //Drop to make space for new image
                $this->deleteAttachments($this->owner,$attribute);
            }

            if ($cropData) {

                $cropInfo = Json::decode($cropData);
                if (((isset($cropInfo['width'])) &&  ($cropInfo['width'] > 0)) && ((isset($cropInfo['height'])) &&  ($cropInfo['height'] > 0))) {
                    $this->cropImage($file, $cropData);
                }
               
            }

            if (!$file->saveAs($this->getModule()->getUserDirPath($attribute) . $file->name)) {
                //pr($file,"Failed");die;
                continue;
            }
        }

        if ($this->owner->isNewRecord) {
            return true;
        }

        $userTempDir = $this->getModule()->getUserDirPath($attribute);

        //If the firectory doen't exists go out
        if(!is_dir($userTempDir)) {
            return false;
        }

        foreach (FileHelper::findFiles($userTempDir) as $file) {
            if (!$this->getModule()->attachFile($file, $this->owner, $attribute, true, false, (in_array($attribute, $this->encryptedAttributes)))) {
                $this->owner->addError($attribute, 'File upload failed.');
                return true;
            }
        }

        //Getting query
        //$getter = 'get' . ucfirst($attribute);

        /** @var ActiveQuery $activeQuery */
        /*$getResult = $this->owner->{$getter}();
        if ($getResult instanceof ActiveQuery) {
            $this->owner->{$attribute} = $getResult->multiple ? $getResult->all() : $getResult->one();
        } else {
            $this->owner->{$attribute} = $getResult;
        }*/
    }

    /**
     * Drop all attachaments (Workaround for multiple attachaments on single file input)
     * @param ActiveRecord $model
     * @param $attribute
     * @return bool
     */
    private function deleteAttachments($model, $attribute) {
        return File::deleteAll([
            'model' => get_class($model),
            'attribute' => $attribute,
            'item_id' => $model->id
        ]);
    }

    protected function cropImage(UploadedFile $file, $data)
    {
        //if temp file from post attributes is still present, the cropped image has to be saved
        if(file_exists($file->tempName)) {
            //The image file to be cropped
            $image = Image::getImagine()->open($file->tempName);

            // rendering information about crop of ONE option
            $cropInfo = Json::decode($data);

            if(isset($cropInfo['rotate'])) {
                $image->rotate($cropInfo['rotate']);
            }
            //$cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
            //$cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
            $cropInfo['x'] = abs($cropInfo['x']); //begin position of frame crop by X
            $cropInfo['y'] = abs($cropInfo['y']); //begin position of frame crop by Y
            $cropInfo['width'] = (int)$cropInfo['width']; //width of cropped image
            $cropInfo['height'] = (int)$cropInfo['height']; //height of cropped image
            // Properties bolow we don't use in this example
            //$cropInfo['ratio'] = $cropInfo['ratio'] == 0 ? 1.0 : (float)$cropInfo['ratio']; //ratio image.

            /*//delete old images
            $oldImages = FileHelper::findFiles($file->tempName, [
                'only' => [
                    $this->id . '.*',
                    'thumb_' . $this->id . '.*',
                ],
            ]);

            for ($i = 0; $i != count($oldImages); $i++) {
                @unlink($oldImages[$i]);
            }*/

            //saving thumbnail
            //$newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
            $cropSizeThumb = new Box($cropInfo['width'], $cropInfo['height']); //frame size of crop
            $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
            $pathThumbImage = $file->tempName . '_thumb_' . $file->name;//$file->tempName;

            $image
                //->resize($newSizeThumb)
                ->crop($cropPointThumb, $cropSizeThumb)
                ->save($pathThumbImage, ['quality' => 100]);

            @unlink($file->tempName);
            rename($pathThumbImage, $file->tempName);

            //saving original
            //$this->image->saveAs(Yii::getAlias('@path/to/save/image') . $this->id . '.' . $this->image->getExtension());
        }
    }

    /**
     * When update save files before the validation
     * @param $event
     * @return bool|void
     */
    public function evalAttributes($event)
    {
        $attributes = $this->getFileAttributes();

        if (!empty($attributes)) {
            foreach ($attributes as $attribute) {
                $files = UploadedFile::getInstancesByName($attribute);
                if (!empty($files)) {
                    $maxFiles = 1;

                    foreach ($this->fileValidators as $fileValidator) {
                        if (!empty($fileValidator)) {
                            if (in_array($attribute, $fileValidator->attributes)) {
                                $maxFiles = $fileValidator->maxFiles;
                            }
                        }
                    }
                    $setter = 'set' . ucfirst($attribute);
                    if (method_exists($this->owner, $setter)) {
                        $this->owner->{$setter}($maxFiles == 1 ? reset($files) : $files);
                    } else {
                        if ($maxFiles != 1) {
                            $this->owner->{$attribute} = [];

                            //List of files to be setted
                            $attributeFiles = [];

                            foreach ($files as $file) {
                                $attributeFiles[] = $file;
                            }

                            $this->owner->{$attribute} = $attributeFiles;
                        } else {
                            $this->owner->{$attribute} = reset($files);
                        }
                    }
                }
            }
        }
    }

    /**
     * Unset attributes from override
     * @return bool
     */
    public function unevalAttributes()
    {
        $attributes = $this->getFileAttributes();

        foreach ($attributes as $attribute) {
            //Enruse var is unsetted from override
            if (isset($this->overrideAttributes[$attribute])) {
                unset($this->overrideAttributes[$attribute]);
            }
        }

        return true;
    }

    /**
     * @param $event
     */
    public function deleteUploads($event)
    {
        $files = $this->getFiles();

        foreach ($files as $file) {
            $this->getModule()->detachFile($file->id);
        }
    }

    /**
     * @param string $andWhere
     * @return File[]
     */
    public function getFiles($andWhere = '')
    {
        return $this->getFilesQuery()->all();
    }

    /**
     * @param string $andWhere
     * @return \yii\db\ActiveQuery
     */
    public function getFilesQuery($andWhere = '')
    {
        $fileQuery = File::find()
            ->where(
                [
                    'item_id' => $this->owner->getAttribute('id'),
                    'model' => $this->getModule()->getClass($this->owner)
                ]
            );
        $fileQuery->orderBy('is_main DESC, sort DESC');

        if ($andWhere) {
            $fileQuery->andWhere($andWhere);
        }

        return $fileQuery;
    }

    /**
     * DEPRECATED
     */
    public function getSingleFileByAttributeName($attribute = 'file', $sort = 'id')
    {
        $query = $this->getFilesByAttributeName($attribute, $sort);

        //Single result mode
        $query->multiple = false;

        return $this->hasOneFile($attribute, $sort);
    }

    /**
     * DEPRECATED
     */
    public function getFilesByAttributeName($attribute = 'file', $sort = 'id')
    {
        return $this->hasMultipleFiles($attribute, $sort);
    }

    /**
     * @param string $attribute
     * @param string $sort
     * @return \yii\db\ActiveQuery
     */
    public function hasMultipleFiles($attribute = 'file', $sort = 'id')
    {
        $fileQuery = File::find()
            ->where([
                'item_id' => $this->owner->id,
                'model' => $this->getModule()->getClass($this->owner),
                'attribute' => $attribute,
            ]);

        $fileQuery->orderBy([$sort => SORT_ASC]);

        //Single result mode
        $fileQuery->multiple = true;

        return $fileQuery;
    }

    /**
     * @param string $attribute
     * @param string $sort
     * @return \yii\db\ActiveQuery
     */
    public function hasOneFile($attribute = 'file', $sort = 'id')
    {
        $query = $this->hasMultipleFiles($attribute, $sort);

        //Single result mode
        $query->multiple = false;

        return $query;
    }

    /**
     * @param string $attribute
     * @return array
     */
    public function getInitialPreviewByAttributeName($attribute = 'file', $size = null)
    {
        $initialPreview = [];
        $userTempDir = $this->getModule()->getUserDirPath($attribute);

        if(is_dir($userTempDir)) {
            foreach (FileHelper::findFiles($userTempDir) as $file) {

                if (substr(FileHelper::getMimeType($file), 0, 5) === 'image') {
                    $initialPreview[] = Html::img(['/' . FileModule::getModuleName() . '/file/download-temp', 'filename' => basename($file)], ['class' => 'file-preview-image']);
                } else {
                    $initialPreview[] = Html::beginTag('div', ['class' => 'file-preview-other']) 
                        . Html::beginTag('span', ['class' => 'file-other-icon']) 
                        . Html::tag('i', '', ['class' => 'glyphicon glyphicon-file']) 
                        . Html::endTag('span') 
                        . Html::endTag('div');
                }
            }
        }

        $files = $this->getFilesByAttributeName($attribute)->all();

        if (is_array($files)) {
            foreach ($files as $file) {
                /** @var File $file */

                if (substr($file->mime, 0, 5) === 'image') {
                    $initialPreview[] = Html::img($file->getUrl($size), ['class' => 'file-preview-image']);
                } else {
                    $initialPreview[] = Html::beginTag('div', ['class' => 'file-preview-other']) 
                        . Html::beginTag('span', ['class' => 'file-other-icon']) 
                        . Html::tag('i', '', ['class' => 'glyphicon glyphicon-file']) 
                        . Html::endTag('span') 
                        . Html::endTag('div');
                }
            }
            return $initialPreview;
        }
        
        return [];
    }

    /**
     * @param string $attribute
     * @return array
     */
    public function getInitialPreviewConfigByAttributeName($attribute = 'file')
    {
        $initialPreviewConfig = [];

        $userTempDir = $this->getModule()->getUserDirPath($attribute);

        if(is_dir($userTempDir)) {
            foreach (FileHelper::findFiles($userTempDir) as $file) {
                $filename = basename($file);
                $initialPreviewConfig[] = [
                    'caption' => $filename,
                    'showDrag' => false,
                    'indicatorNew' => false,
                    'showRemove' => true,
                    'size' => $file->size,
                    'url' => Url::to(['/' . FileModule::getModuleName() . '/file/delete-temp',
                        'filename' => $filename
                    ]),
                ];
            }
        }

        $files = $this->getFilesByAttributeName($attribute)->all();

        if (is_array($files)) {
            foreach ($files as $index => $file) {
                $initialPreviewConfig[] = [
                    'caption' => "$file->name.$file->type",
                    'showDrag' => false,
                    'indicatorNew' => false,
                    'showRemove' => true,
                    'size' => $file->size,
                    'url' => Url::toRoute(['/' . FileModule::getModuleName() . '/file/delete',
                        'id' => $file->id,
                        'item_id' => $this->owner->getAttribute('id'),
                        'model' => $this->getModule()->getClass($this->owner),
                        'attribute' => $attribute
                    ])
                ];
            }
        }

        return $initialPreviewConfig;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getFileCount()
    {
        $count = File::find()
            ->where([
                'item_id' => $this->owner->getAttribute('id'),
                'model' => $this->getModule()->getClass($this->owner)
            ])
            ->count();
        return (int)$count;
    }

    /**
     * @return mixed
     */
    public function getStatsToolbar()
    {
        return StatsToolbarPanels::getDocumentsPanel($this->owner, $this->getFileCount());
    }

    /**
     * @param $attribute
     * @param $csrf
     * @param $dataImage
     * @return bool
     * @throws \Exception
     */
    private function saveFileFormGallery($attribute, $csrf, $dataImage){
        $idGalleryImage = $dataImage['id'];
        $galleryAttribute = $dataImage['attribute'];

        if($attribute == $galleryAttribute){
            $imageGallery = AttachGalleryImage::findOne($idGalleryImage);
            if ($imageGallery) {
                $filePath = $imageGallery->attachImage->getPath();
                if(file_exists($filePath)) {
                    $this->deleteAttachments($this->owner, $attribute);
                    if($this->getModule()->attachFile($filePath, $this->owner, $attribute, false)){
                        \Yii::$app->session->remove($csrf);
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }
    }

}