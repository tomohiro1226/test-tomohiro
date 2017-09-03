<?php

class Sponsor extends ModelBase
{
    protected $name = "sponsor_detail";

    public function getList()
    {
        $sql = sprintf('SELECT * FROM %s' , $this->name);
        $stmt = $this->pdoIns->query($sql);
        // $stmt->bindValue(':cart_id', $cartId);
        $rows = $stmt->fetchAll();
        return $rows;
    }
}
?>