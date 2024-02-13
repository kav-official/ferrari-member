<?php
class HelpFunctions
{
    private $f3;
    public $db;
    function __construct()
	{
		$this->f3 = Base::instance();
        $this->db = DBConfig::config();
	}

    public function getFind($serviceName, $options)
    {
        $objectReflection = new ReflectionClass($serviceName);
        $Svr = $objectReflection->newInstanceArgs(array($this->db));
    	return $Svr->find($options);
    }

    public function getTitle($serviceName,$options,$callback)
    {
        $objectReflection = new ReflectionClass($serviceName);
        $Svr = $objectReflection->newInstanceArgs(array($this->db));
        $item = $Svr->load($options);
        if($item)
        {
            return $item->$callback;
        } else {
            return "-";
        }
    }

    public function getById($serviceName,$id)
    {
        $objectReflection = new ReflectionClass($serviceName);
        $Svr = $objectReflection->newInstanceArgs(array($this->db));
    	return $Svr->load(array('id = ?',$id));
    }

    public function getByOne($serviceName,$options)
    {
        $objectReflection = new ReflectionClass($serviceName);
        $Svr = $objectReflection->newInstanceArgs(array($this->db));
    	return $Svr->load($options);
    }

    public function getSQL($sql,$options=array())
    {
        return $this->db->exec($sql,$options);
    }

    public function productBaseUnit($product_no){
        $item = $this->db->exec("SELECT units.unit_name FROM units INNER JOIN product_sells ON(product_sells.unit_id = units.id) WHERE product_sells.product_no = ? AND product_sells.base_qty = ? LIMIT 1",array($product_no,1));
        $title = "-";
        foreach ($item as $value) {
            $title = $value['unit_name'];
        }
        return $title;
    }

    function percent_profit($cost,$base_qty,$price){
        if($cost > 0 && $base_qty > 0 && $price > 0){
            $base_price = $price/$base_qty;
            $percent = (($base_price-$cost)*100)/$cost;
            $percent = number_format($percent,2)."%";
        } else {
            $percent = 0;
        }
        return $percent;
    }
}