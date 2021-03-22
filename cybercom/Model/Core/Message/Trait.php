<?php 
Trait Model_Core_Message_Trait {

	public function setSuccess($message)
	{
		$this->success = $message;
		return $this;
	}

	public function getSuccess()
	{
		return $this->success;
	}
	
	public function setFailure($message)
	{
		$this->failure = $message;
		return $this;
	}

	public function getFailure()
	{
		return $this->failure;
	}
}