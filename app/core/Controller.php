<?php
namespace App\core;

// spl_autoload_register(function($class) {
//     require_once($class.'.php');
// });

class Controller {
	protected $view;

	public function view( $viewname, $data=[] ) {
		$this->view = new View( $viewname, $data );
		return $this->view;
	}
}

