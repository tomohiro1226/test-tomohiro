<?php

class CartController
{
    private $request;

    public function __construct()
    {
        // リクエスト
        echo "request初期化";
        $this->request = new Request();
    }

    public function displayAction()
    {
        // カート内容表示処理
        echo "displayActionやってるでー!!";

        // 追加する商品の商品IDをPOSTから取得
        $post = $this->request->getPost();

        $productId = $post['product_id'];
        echo "productId = " . $productId;
    }

    public function inputAction()
    {
        // 購入情報入力フォーム表示処理
        echo "inputAvtionやってるでー!!";
    }

    public function buyAction()
    {
        // 購入処理
        echo "buyAvtionやってるでー!!";

        // 購入処理後、記事表示画面へリダイレクト
        header('Location: http://127.0.0.1/cart/thanks');
    }

    public function thanksAction()
    {
        // 購入完了画面表示処理
        echo "thanksActionやってるでー!!";
    }
}

?>