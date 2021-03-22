<?php 
	if(!$this->getAdminMessage()->getSuccess()){
		echo "";
	} else {
		echo $this->getAdminMessage()->getSuccess();
		$this->getAdminMessage()->clearSuccess();		
	}
?>
