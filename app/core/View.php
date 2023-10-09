<?php
namespace App\core;

// ** FILE CURRENTLY NOT USED - Refactored Out **

class View {
	protected $view_file;
	protected $view_data;

	public function __construct($view_file, $view_data) {
		$this->view_file = $view_file;
		$this->view_data = $view_data;
	}
}

