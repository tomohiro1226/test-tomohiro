<?php

class ModelBase
{
    private static $connInfo;
    protected $pdoIns;
    protected $name;

    public function __construct()
    {
        echo "ModelBase init<br>";
        $this->initDb();
    }
    
    /** 
     * データベースの初期設定 
    */
    public function initDb()
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;port=3306;',
            self::$connInfo['host'],
            self::$connInfo['dbname']
        );
        $this->pdoIns = new PDO($dsn, self::$connInfo['dbuser'], self::$connInfo['password']);
    }

    /**
     * インスタンスを作成する前に、必要事項を記入して
     * "setConnectionInfo()" を実行する事
     * 
     * @param   'host'     => 'localhost',
     *          'dbname'   => 'sample',
     *          'dbuser'   => 'hoge',
     *          'password' => 'xxxx'
    */
    public static function setConnectionInfo($connInfo)
    {
        self::$connInfo = $connInfo;
    }

     // クエリ結果を取得
     public function query($sql, array $params = array())
     {
         $stmt = $this->pdoIns->prepare($sql);
         if ($params != null) {
             foreach ($params as $key => $val) {
                 $stmt->bindValue(':' . $key, $val);
             }
         }
         $stmt->execute();
         $rows = $stmt->fetchAll();
 
         return $rows;
     }
 
     // INSERTを実行
     public function insert($data)
     {
         $fields = array();
         $values = array();
         foreach ($data as $key => $val) {
             $fields[] = $key;
             $values[] = ':' . $key;
         }
         $sql = sprintf(
             "INSERT INTO %s (%s) VALUES (%s)", 
             $this->name,
             implode(',', $fields), // $fields(配列)を','で連結する
             implode(',', $values)  // $values(配列)を','で連結する
         );
         $stmt = $this->pdoIns->prepare($sql);
         foreach ($data as $key => $val) {
             $stmt->bindValue(':' . $key, $val);
         }
         $res  = $stmt->execute();
 
         return $res;        
     }
 
     // DELETEを実行
     public function delete($where, $params = null)
     {
         $sql = sprintf("DELETE FROM %s", $this->name);
         if ($where != "") {
             $sql .= " WHERE " . $where;
         }
         $stmt = $this->pdoIns->prepare($sql);
         if ($params != null) {
             foreach ($params as $key => $val) {
                 $stmt->bindValue(':' . $key, $val);
             }
         }
         $res = $stmt->execute();
         
         return $res;
     }
}

?>