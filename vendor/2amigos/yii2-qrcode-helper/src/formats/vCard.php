<?php
/**
 */
namespace dosamigos\qrcode\formats;

use dosamigos\qrcode\traits\EmailTrait;
use dosamigos\qrcode\traits\UrlTrait;
use yii\base\InvalidConfigException;

/**
 * Class vCard creates a valid vCard 4.0 QrCode string
 *
 * @package dosamigos\qrcode\formats
 */
class vCard extends FormatAbstract
{

    use EmailTrait;
    use UrlTrait;

    /**
     * @var string the name
     */
    public $name;
    /**
     * @var string the full name
     */
    public $fullName;
    /**
     * @var string the address
     */
    public $address;
    /**
     * @var string the nickname
     */
    public $nickName;
    /**
     * @var string the work phone
     */
    public $workPhone;
    /**
     * @var string the home phone
     */
    public $homePhone;
    /**
     * @var string a date in the format YYYY-MM-DD or ISO 860
     */
    public $birthday;
    /**
     * @var string a date in the format YYYY-MM-DD or ISO 860
     */
    public $anniversary;
    /**
     * @var string the gender
     */
    public $gender;
    /**
     * @var string the categories. A list of "tags" that can be used to describe the object represented by this vCard.
     * e.g., developer,designer,climber,swimmer
     */
    public $categories;
    /**
     * @var string the instant messaging and presence protocol (instant messenger id)
     */
    public $impp;
    /**
     * @var string the photo
     */
    public $photo;
    /**
     * @var string the role e.g., Executive
     */
    public $role;
    /**
     * @var string the name and optionally the unit(s) of the organization
     * associated with the vCard object. This property is based on the X.520 Organization Name
     * attribute and the X.520 Organization Unit attribute.
     */
    public $organization;
    /**
     * @var string notes
     */
    public $note;
    /**
     * @var string language of the user
     */
    public $lang;

    /**
     * @return string
     */
    public function getText()
    {
        $data = [];
        $data[] = "BEGIN:VCARD";
        $data[] = "VERSION:4.0";
        $data[] = "N:{$this->name}";
        $data[] = "FN:{$this->fullName}";
        $data[] = "ADR:{$this->address}";
        $data[] = "NICKNAME:{$this->nickName}";
        $data[] = "EMAIL;TYPE=PREF,INTERNET:{$this->email}";
        $data[] = "TEL;TYPE=WORK:{$this->workPhone}";
        $data[] = "TEL;TYPE=HOME:{$this->homePhone}";
        $data[] = "BDAY:{$this->birthday}";
        $data[] = "GENDER:{$this->gender}";
        $data[] = "IMPP:{$this->impp}";
        $data[] = $this->getFormattedPhoto();
        $data[] = "ROLE:{$this->role}";
        $data[] = "URL:{$this->url}";
        $data[] = "ORG:{$this->organization}";
        $data[] = "NOTE:{$this->note}";
        $data[] = "ORG:{$this->organization}";
        $data[] = "LANG:{$this->lang}";
        $data[] = "END:VCARD";

        return implode("\n", array_filter($data));
    }

    /**
     * @return string the formatted photo. Makes sure is of the right image extension.
     * @throws \yii\base\InvalidConfigException
     */
    protected function getFormattedPhoto()
    {
        if ($this->photo !== null) {
            $ext = strtolower(substr(strrchr($this->photo, '.'), 1));
            if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif')
                $ext = strtoupper($ext);
            else
                throw new InvalidConfigException('Invalid format Image!');

            return 'PHOTO;VALUE=URL;TYPE=' . $ext . ':' . $this->photo;
        }

        return null;
    }
}