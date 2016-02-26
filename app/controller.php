<?php

abstract class Controller {

	/**
	 * Get the currently logged in user, if any
	 * @return int|bool
	 */
	protected function _getUser() {
		return \App::fw()->get('user') ?: false;
	}

	/**
	 * Require a user to be logged in. Redirects to /login if a sesison is not found.
	 * @return int|bool
	 */
	protected function _requireLogin() {
		$id = $this->_getUser();
		if(!$id) {
			$fw = \App::fw();
			if(empty($_GET)) {
				$fw->reroute("/login?to=" . urlencode($fw->get("PATH")));
			} else {
				$fw->reroute("/login?to=" . urlencode($fw->get("PATH")) . urlencode("?" . http_build_query($_GET)));
			}
			$fw->unload();
		}
		return $id;
	}

	/**
	 * Render a view
	 * @param string  $file
	 * @param string  $mime
	 * @param array   $hive
	 * @param integer $ttl
	 */
	protected function _render($file, $mime = "text/html", array $hive = null, $ttl = 0) {
		echo \Template::instance()->render($file, $mime, $hive, $ttl);
	}

	/**
	 * Output JSON response and required headers
	 * @param mixed $response
	 */
	public function _json($response) {
		if(!headers_sent()) {
			header("Content-type: application/json");
		}
		echo json_encode($response);
	}

}
