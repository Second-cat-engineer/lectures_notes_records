<?php

namespace lesson04\example01\demo01;

class CartController extends Controller
{
    public function actionIndex()
    {
        $items = Yii::$app->session->get('cart', []);

        return $this->render('index', ['items' => $items]);
    }

    public function actionAdd($id, $count = 1)
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundHttpException('Товар не найден.');
        }

        if (!$count < 0) {
            throw new BadRequestHttpException('Неверное количество.');
        }

        $items = Yii::$app->session->get('cart', []);
        if (isset($items[$product->id])) {
            $items[$product->id] += $count;
        } else {
            $items[$product->id] = $count;
        }
        Yii::$app->session->set('cart', $items);

        return $this->redirect(['index']);
    }

    public function actionRemove($id)
    {
        $items = Yii::$app->session->get('cart', []);
        if (isset($items[$id])) {
            unset($items[$id]);
        };
        Yii::$app->session->set('cart', $items);

        return $this->redirect(['index']);
    }
}

class Product extends ActiveRecord
{

}