<?
	var $components = array('Auth', 'Cookie');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('display');
		$this->Auth->loginAction = array('plugin'=>'user','controller' => 'users', 'action' => 'login', 'admin' => false);
		//App::import('Controller', 'User.UserAppController');
		//$this->Auth->userModel = 'User';
		//$this->Auth->autoRedirect = false;

		//$this->Auth->authorize = 'controller';
		//$this->Auth->userScope = array('User.active' => 1); //user needs to be active.
		$this->set('user_id', $this->Auth->user('id'));
		if ((Configure::read('User.debug')) > 0) {
			$this->Auth->allow();
		}
	}
	
	function beforeRender() {
		require(APP.'plugins'.DS.'user'.DS.'app_controller'.DS.'before_render.php');
	}

	/**
	 * isAuthorized
	 *
	 * Called by Auth component for establishing whether the current authenticated
	 * user has authorization to access the current controller:action
	 *
	 * @return true if authorised/false if not authorized
	 * @access public
	 */
	function isAuthorized(){
		return require(APP.'plugins'.DS.'user'.DS.'app_controller'.DS.'is_authorized.php');;
	}

	/**
	 * __permitted
	 *
	 * Helper function returns true if the currently authenticated user has permission
	 * to access the controller:action specified by $controllerName:$actionName
	 *
	 * Taken from {@link http://www.studiocanaria.com/articles/cakephp_auth_component_users_groups_permissions_revisited}
	 *
	 * @return
	 * @param $controllerName Object
	 * @param $actionName Object
	 */
	function __permitted($controllerName,$actionName){
		return require(APP.'plugins'.DS.'user'.DS.'app_controller'.DS.'__permitted.php');;
	}
?>