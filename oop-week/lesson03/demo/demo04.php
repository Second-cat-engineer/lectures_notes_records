<?php
namespace lesson03\example3\demo02;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property $title
 * @property $slug
 * @property $content
 * @property $filter_content
 * @property $image
 */
class Post extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->filter_content = $this->filter($this->content);
            return true;
        }
        return false;
    }

    private function filter($content)
    {
        return strip_tags($content);
    }
}

/**
 * @property $content
 * @property $filter_content
 */
class Page extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->filter_content = $this->filter($this->content);
            return true;
        }
        return false;
    }

    private function filter($content)
    {
        return strip_tags($content);
    }
}

/**
 * @property $file
 */
class Article extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->file && $this->file instanceof UploadedFile) {
                $this->file = $this->upload($this->file);
            }
            return true;
        }
        return false;
    }

    private function upload(UploadedFile $file)
    {
        $fileName = uniqid() . '.' . $file->getExtension();
        $file->saveAs(Yii::getAlias('@web/uploads') . DIRECTORY_SEPARATOR . $fileName);
        return $fileName;
    }
}