<?php

namespace Controller;

class Index extends \Controller {

	/**
	 * GET /
	 * @param  \Base $fw
	 * @param  array $params
	 */
	function index(\Base $fw, array $params) {
		$this->_render('index.html');
	}

}
