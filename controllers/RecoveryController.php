<?php

class RecoveryController extends Controller
{
	public $defaultAction = 'recovery';
	
	/**
	 * Recovery password
	 */
	public function actionRecovery () {
		$form = new UserRecoveryForm;
		if (Yii::app()->user->id) {
    	$this->redirect(Yii::app()->controller->module->returnUrl);
    }else{
			$email = ((isset($_GET['email']))?$_GET['email']:'');
			$activkey = ((isset($_GET['activkey']))?$_GET['activkey']:'');
			if($email&&$activkey){
				$form2 = new UserChangePassword;
	   		$find = User::model()->notsafe()->findByAttributes(array('email'=>$email));
	   		if(isset($find)&&$find->activkey==$activkey){
	    		if(isset($_POST['UserChangePassword'])){
						$form2->attributes=$_POST['UserChangePassword'];
						if($form2->validate()){
							$find->password = Yii::app()->controller->module->encrypting($form2->password);
							$find->activkey=Yii::app()->controller->module->encrypting(microtime().$form2->password);
							if($find->status==0){
								$find->status = 1;
							}
							$find->save();
							Yii::app()->user->setFlash('recoveryMessage',UserModule::t("New password is saved."));
							$this->redirect(Yii::app()->controller->module->loginUrl);
						}
					}
					$this->render('changepassword',array('form'=>$form2));
	   		}else{
	   			Yii::app()->user->setFlash('recoveryMessage',UserModule::t("Incorrect recovery link."));
					$this->redirect(Yii::app()->controller->module->recoveryUrl);
	   		}
	   	}else{
		   	if(isset($_POST['UserRecoveryForm'])){
		   		$form->attributes=$_POST['UserRecoveryForm'];
	    		if($form->validate()){
		   			$user = User::model()->notsafe()->findbyPk($form->user_id);
						$activation_url = 'http://' . $_SERVER['HTTP_HOST'].$this->createUrl(implode(Yii::app()->controller->module->recoveryUrl),array("activkey" => $user->activkey, "email" => $user->email));
						$subject = UserModule::t("New password at {site_name}",
	  					array('{site_name}'=>Yii::app()->name)
						);
	    			$message = UserModule::t("You have requested a new password for {site_name}. To change your password, click here: {activation_url}.",
		 					array(
		 						'{site_name}'=>Yii::app()->name,
		 						'{activation_url}'=>$activation_url,
		 					));
	    			UserModule::sendMail($user->email,$subject,$message);	    			
						Yii::app()->user->setFlash('recoveryMessage',UserModule::t("Please check your email! A message was sent with instructions to obtain a new password."));
		    		$this->refresh();
		    	}
		    }
	    	$this->render('recovery',array('form'=>$form));
	    }
   	}
	}

}