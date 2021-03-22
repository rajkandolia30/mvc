<?php 
namespace Model\Product;
\Mage::loadfileByClassName('Model\core\Table');
class GroupPrice extends \Model\Core\Table{
	public function __construct(){
		$this->setPrimaryKey('entityId');
		$this->setTableName('productGroupPrice');
	}

	public function getStatusOption(){
        return [
            "Disable" => "Disable",
            "Enable" => "Enable"
        ];
    }

    public function fetchPrice($id, $price){
 		$query = "
 		SELECT cg.*,pgp.productId,pgp.entityId,pgp.groupPrice,
 		if(p.price IS NULL, '{$price}',p.price) as price
 		FROM `customerGroup` as cg
 		LEFT JOIN productGroupPrice as pgp
 			ON pgp.groupId = cg.customerGroupId
 				AND pgp.productId = '{$id}'
 		LEFT JOIN product as p
 			ON pgp.productId = p.productId
 			";
 		$row = $this->fetchAll($query);
 		return $row;
 	}


}
?>