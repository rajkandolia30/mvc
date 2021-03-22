<div id="tab">
	<?php 
	$child = $this->getChildren();
		if(!$child){
			echo '';
		} else  {
			foreach ($child as $key => $value){
				echo $value->toHtml();
			}
	}?>
</div>