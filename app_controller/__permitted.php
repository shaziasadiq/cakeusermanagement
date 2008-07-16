<?
		//Ensure checks are all made lower case
		$controllerName = low($controllerName);
		$actionName = low($actionName);
		//If permissions have not been cached to session...
		if(!$this->Session->check('Permissions')){
			//...then build permissions array and cache it
			$permissions = array();
			//everyone gets permission to logout
			$permissions[]='users:logout';
			
			// var $uses forces weird behavior
			App::import('Model', 'User.User'); 
			App::import('Model', 'User.Group');
			$this->User = new User;
			$this->Group = new Group;
			
			//Now bring in the current users full record along with groups
			$this->User->contain(array('Group.id'));
			$thisGroups = $this->User->find(array('User.id'=>$this->Auth->user('id')), 'id');
			$thisGroups = $thisGroups['Group'];
			$this->Group->contain(false, array('Permission.name'));
			foreach($thisGroups as $thisGroup){
				$thisPermissions = $this->Group->find(array('Group.id'=>$thisGroup['id']), 'id');
				$thisPermissions = $thisPermissions['Permission'];
				foreach($thisPermissions as $thisPermission){
					$permissions[]=low($thisPermission['name']);
				}
			}
			//write the permissions array to session
			$this->Session->write('Permissions',$permissions);
		}else{
			//...they have been cached already, so retrieve them
			$permissions = $this->Session->read('Permissions');
		}
		//Now iterate through permissions for a positive match
		foreach($permissions as $permission){
			if($permission == '*'){
				return true;//Super Admin Bypass Found
			}
			if($permission == $controllerName.':*'){
				return true;//Controller Wide Bypass Found
			}
			if($permission == $controllerName.':'.$actionName){
				return true;//Specific permission found
			}
		}
		return false;
?>