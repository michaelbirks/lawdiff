<?php
/**
 * Standard Change Password Form
 * @package sapphire
 * @subpackage security
 */
class ChangePasswordForm extends Form {

	/**
	 * Constructor
	 *
	 * @param Controller $controller The parent controller, necessary to
	 *                               create the appropriate form action tag.
	 * @param string $name The method on the controller that will return this
	 *                     form object.
	 * @param FieldSet|FormField $fields All of the fields in the form - a
	 *                                   {@link FieldSet} of {@link FormField}
	 *                                   objects.
	 * @param FieldSet|FormAction $actions All of the action buttons in the
	 *                                     form - a {@link FieldSet} of
	 */
	function __construct($controller, $name, $fields = null, $actions = null) {
		if(isset($_REQUEST['BackURL'])) {
			$backURL = $_REQUEST['BackURL'];
		} else {
			$backURL = Session::get('BackURL');
		}
		
		if(!$fields) {
			$fields = new FieldSet();
			if(Member::currentUser() && (!isset($_REQUEST['h']) || !Member::member_from_autologinhash($_REQUEST['h']))) {
				$fields->push(new PasswordField("OldPassword",_t('Member.YOUROLDPASSWORD', "Your old password")));
			}

			$fields->push(new PasswordField("NewPassword1", _t('Member.NEWPASSWORD', "New Password")));
			$fields->push(new PasswordField("NewPassword2", _t('Member.CONFIRMNEWPASSWORD', "Confirm New Password")));
		}
		if(!$actions) {
			$actions = new FieldSet(
				new FormAction("doChangePassword", _t('Member.BUTTONCHANGEPASSWORD', "Change Password"))
			);
		}

		if(isset($backURL)) {
			$fields->push(new HiddenField('BackURL', 'BackURL', $backURL));
		}

		parent::__construct($controller, $name, $fields, $actions);
	}


	/**
	 * Change the password
	 *
	 * @param array $data The user submitted data
	 */
	function doChangePassword(array $data) {
		if($member = Member::currentUser()) {
			// The user was logged in, check the current password
			if(empty($data['OldPassword']) || !$member->checkPassword($data['OldPassword'])->valid()) {
				$this->clearMessage();
				$this->sessionMessage(
					_t('Member.ERRORPASSWORDNOTMATCH', "Your current password does not match, please try again"), 
					"bad"
				);
				Director::redirectBack();
				return;
			}
		}

		if(!$member) {
			if(Session::get('AutoLoginHash')) {
				$member = Member::member_from_autologinhash(Session::get('AutoLoginHash'));
			}

			// The user is not logged in and no valid auto login hash is available
			if(!$member) {
				Session::clear('AutoLoginHash');
				Director::redirect('loginpage');
				return;
			}
		}

		// Check the new password
		if(empty($data['NewPassword1'])) {
			$this->clearMessage();
			$this->sessionMessage(
				_t('Member.EMPTYNEWPASSWORD', "The new password can't be empty, please try again"),
				"bad");
			Director::redirectBack();
			return;
		}
		else if($data['NewPassword1'] == $data['NewPassword2']) {
			$isValid = $member->changePassword($data['NewPassword1']);
			if($isValid->valid()) {
				$this->clearMessage();
				$this->sessionMessage(
					_t('Member.PASSWORDCHANGED', "Your password has been changed, and a copy emailed to you."),
					"good");
				Session::clear('AutoLoginHash');
				
				if (isset($_REQUEST['BackURL']) 
					&& $_REQUEST['BackURL'] 
					// absolute redirection URLs may cause spoofing 
					&& Director::is_site_url($_REQUEST['BackURL'])
				) {
					Director::redirect($_REQUEST['BackURL']);
				}
				else {
					// Redirect to default location - the login form saying "You are logged in as..."
					$redirectURL = HTTP::setGetVar('BackURL', Director::absoluteBaseURL(), Security::Link('login'));
					Director::redirect($redirectURL);					
				}
			} else {
				$this->clearMessage();
				$this->sessionMessage(
					sprintf(_t('Member.INVALIDNEWPASSWORD', "We couldn't accept that password: %s"), nl2br("\n".$isValid->starredList())), 
					"bad"
				);
				Director::redirectBack();
			}

		} else {
			$this->clearMessage();
			$this->sessionMessage(
				_t('Member.ERRORNEWPASSWORD', "You have entered your new password differently, try again"),
				"bad");
			Director::redirectBack();
		}
	}

}

?>