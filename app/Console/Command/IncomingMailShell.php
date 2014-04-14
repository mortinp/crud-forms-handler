<?php
class IncomingMailShell extends AppShell {
	public function main() {
		$this->out('Incoming Mail shell reporting.');
	}
	
	public function processMail() {
		$this->out('Processing incoming mail');
	}
	
	public $uses = array('User');
	public function show() {
		$user = $this->User->findByUsername($this->args[0]);
		$this->out(print_r($user, true));
	}
}
?>
