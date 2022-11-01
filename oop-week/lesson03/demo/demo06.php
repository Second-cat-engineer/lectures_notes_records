<?php
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\Controller;

class FilterHelper
{
    public static function filter($content) {
        return strip_tags($content);
    }
}

class Uploader
{
    private $path;

    public function __construct($path) {
        $this->path = $path;
    }

    public function upload($file) {
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
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->filter_content = FilterHelper::filter($this->content);
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
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->filter_content = FilterHelper::filter($this->content);
            return true;
        }
        return false;
    }
}

/**
 * @property int title
 * @property int create_at
 * @property string filter_content
 * @property mixed content
 * @property mixed image
 */
class Article extends ActiveRecord
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (empty($this->create_at)) {
                $this->create_at = time();
            }
            $this->filter_content = FilterHelper::filter($this->content);
            return true;
        }
        return false;
    }
}

//======================================================================================================================

class ArticleCreateForm extends Model
{
    public $title;
    public $content;
    public $file;

    // ...
}

#------------------------------

Yii::$app->set('uploader', function () {
    return new Uploader(Yii::getAlias('@web/uploads'));
});

#------------------------------

class ArticleController extends Controller
{
    public function actionCreate()
    {
        $form = new ArticleCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $uploader = Yii::$app->get('uploader');

            $article = Article::create(
                $form->title,
                $form->content,
                $uploader->upload($form->file)
            );
            $article->save();

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'createForm' => $form,
        ]);
    }
}
