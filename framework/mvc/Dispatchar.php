<?php

require_once("Request.php");
require_once("ControllerBase.php");
require_once(dirname(__FILE__) . "/../libs/Smarty.class.php");

class Dispatcher
{
    private $sysRoot;
    
    /** 
     * システムのルートディレクトリを設定
     * 
     * @param ディレクトリパス
    */
    public function setSystemRoot($path)
    {
        $this->sysRoot = rtrim($path, '/'); // $pathの空白と最後尾の"/"を取り除く
    }

    /** 
     * urlのrouteの振分け処理実行 
    */
    public function dispatch()
    {
        // パラメーター取得
        $param = preg_replace('/^\/?/', '', $_SERVER['REQUEST_URI']);
        // $param = preg_replace('/\/?$/', '', $_SERVER['REQUEST_URI']);        

        $param = rtrim($param, '/'); // $pathの空白と最後尾の"/"を取り除く

        echo "param = ".$param."<br>";
        
        $params = array();
        if ('' != $param) {
            // パラメーターを '/' で分割
            $params = explode('/', $param);
        }

        var_dump($params);
        echo "<br>";
        
        // １番目のパラメーターをコントローラーとして取得
        $controller = "index";
        if (0 < count($params)) {
            $controller = $params[0];
        }

        echo "controller = ".$controller."<br>";

        // １番目のパラメーターをもとにコントローラークラスインスタンス取得
        $controllerInstance = $this->getControllerInstance($controller);

        if (null == $controllerInstance) {
            echo "not found controller<br>";
            header("HTTP/1.0 404 Not Found");
            exit;
        }
        
        // 2番目のパラメーターをコントローラーとして取得
        $action= 'index';
        if (1 < count($params)) {
            $action= $params[1];
        }      
        
        echo "action = " . $action . "<br>";

        // アクションメソッドの存在確認
        if (false == method_exists($controllerInstance, $action . 'Action')) {
            echo "not found action<br>";
            header("HTTP/1.0 404 Not Found");
            exit;
        }

         // コントローラー初期設定
         $controllerInstance->setSystemRoot($this->sysRoot);
         $controllerInstance->setControllerAction($controller, $action);
         // 処理実行
         $controllerInstance->run();
    }


    /**
     * コントローラークラスのインスタンスを取得
     * 
     * @param   URLの第一パラメータ http://example.com/ここ/hoge/
     * @return  成功 : コントローラーのクラスインスタンス
     *          失敗 : null
    */
    private function getControllerInstance($controller)
    {
         // 一文字目のみ大文字に変換＋"Controller"
         $className = ucfirst(strtolower($controller)) . 'Controller';
         // コントローラーファイル名
         $controllerFileName = sprintf('%s/controllers/%s.php', $this->sysRoot, $className);
         // ファイル存在チェック
         if (false == file_exists($controllerFileName)) {
             echo "not find file<br>";
             return null;
         }
         // クラスファイルを読込
         require_once $controllerFileName;
         // クラスが定義されているかチェック
         if (false == class_exists($className)) {
             echo "not find class<br>";
             return null;
         }
         // クラスインスタンス生成
         $controllerInstarnce = new $className();

         echo "classname = ".$className."<br>";
 
         return $controllerInstarnce;
     }
}


?>