<?php 
$tabs = $this->getTabs();
	foreach ($tabs as $key => $value) { ?>
		<div style="padding: 10px;">
			<button class="btn btn-primary" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl(null,null,['tab'=>$key]); ?>').resetParams().load()">
				<?php print_r($value['label']); ?>
			</button></br>
		</div>	
<?php } ?>