<?php
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

//======================================================================================================================
trait FilterTrait
{
    protected function filter($content)
    {
        return strip_tags($content);
    }
}
trait UploadTrait
{
    protected function upload($file)
    {
        $fileName = uniqid() . '.' . $file->getExtension();
        $file->saveAs(Yii::getAlias('@web/uploads') . DIRECTORY_SEPARATOR . $fileName);
        return $fileName;
    }
}

//======================================================================================================================
/**
 * @property $title
 * @property $slug
 * @property $content
 * @property $filter_content
 * @property $image
 */
class Post extends ActiveRecord
{
    use FilterTrait, UploadTrait;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->filter_content = $this->filter($this->content);
            $this->image = $this->upload($this->image);
            return true;
        }
        return false;
    }
}
/**
 * @property mixed content
 * @property string filter_content
 */
class Page extends ActiveRecord
{
    use FilterTrait;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->filter_content = $this->filter($this->content);
            return true;
        }
        return false;
    }
}

/**
 * @property int create_at
 * @property string filter_content
 * @property mixed content
 * @property mixed image
 */
class Article extends ActiveRecord
{
    use FilterTrait, UploadTrait;

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (empty($this->create_at)) {
                $this->create_at = time();
            }
            $this->filter_content = $this->filter($this->content);
            if ($this->image && $this->image instanceof UploadedFile) {
                $this->image = $this->upload($this->image);
            }
            return true;
        }
        return false;
    }
}