<?php
namespace Commentics;

class SettingsEmailEditorController extends Controller {
	public function index() {
		$this->loadLanguage('settings/email_editor');

		$this->loadModel('settings/email_editor');

		$this->loadModel('common/language');

		$frontend_languages = $this->model_common_language->getFrontendLanguages();

		$backend_languages = $this->model_common_language->getBackendLanguages();

		if (isset($this->request->get['type'])) {
			$type = $this->request->get['type'];

			switch ($type) {
				case 'ban':
					$this->data['lang_heading'] 	= $this->data['lang_heading_ban'];
					$this->data['lang_description']	= $this->data['lang_description_ban'];
					$this->data['languages']		= $backend_languages;
					$this->data['keywords']			= '<span>username</span> <span>ip address</span> <span>reason</span> <span>admin link</span> <span>signature</span>';
					break;
				case 'comment_approve':
					$this->data['lang_heading']		= $this->data['lang_heading_comment_approve'];
					$this->data['lang_description']	= $this->data['lang_description_comment_approve'];
					$this->data['languages']		= $backend_languages;
					$this->data['keywords']			= '<span>username</span> <span>page reference</span> <span>page url</span> <span>comment url</span> <span>poster</span> <span>comment</span> <span>reason</span> <span>admin link</span> <span>signature</span>';
					break;
				case 'comment_success':
					$this->data['lang_heading']		= $this->data['lang_heading_comment_success'];
					$this->data['lang_description']	= $this->data['lang_description_comment_success'];
					$this->data['languages']		= $backend_languages;
					$this->data['keywords']			= '<span>username</span> <span>page reference</span> <span>page url</span> <span>comment url</span> <span>poster</span> <span>comment</span> <span>admin link</span> <span>signature</span>';
					break;
				case 'flag':
					$this->data['lang_heading']		= $this->data['lang_heading_flag'];
					$this->data['lang_description']	= $this->data['lang_description_flag'];
					$this->data['languages']		= $backend_languages;
					$this->data['keywords']			= '<span>username</span> <span>page reference</span> <span>page url</span> <span>comment url</span> <span>poster</span> <span>comment</span> <span>admin link</span> <span>signature</span>';
					break;
				case 'password_reset':
					$this->data['lang_heading']		= $this->data['lang_heading_password_reset'];
					$this->data['lang_description']	= $this->data['lang_description_password_reset'];
					$this->data['languages']		= $backend_languages;
					$this->data['keywords']			= '<span>username</span> <span>password</span> <span>admin link</span> <span>signature</span>';
					break;
				case 'setup_test':
					$this->data['lang_heading']		= $this->data['lang_heading_setup_test'];
					$this->data['lang_description']	= $this->data['lang_description_setup_test'];
					$this->data['languages']		= $backend_languages;
					$this->data['keywords']			= '<span>username</span> <span>admin link</span> <span>signature</span>';
					break;
				case 'subscriber_confirmation':
					$this->data['lang_heading']		= $this->data['lang_heading_subscriber_confirmation'];
					$this->data['lang_description']	= $this->data['lang_description_subscriber_confirmation'];
					$this->data['languages']		= $frontend_languages;
					$this->data['keywords']			= '<span>name</span> <span>page reference</span> <span>page url</span> <span>confirmation link</span> <span>signature</span>';
					break;
				case 'subscriber_notification_admin':
					$this->data['lang_heading']		= $this->data['lang_heading_subscriber_notification_admin'];
					$this->data['lang_description']	= $this->data['lang_description_subscriber_notification_admin'];
					$this->data['languages']		= $frontend_languages;
					$this->data['keywords']			= '<span>name</span> <span>page reference</span> <span>page url</span> <span>comment url</span> <span>poster</span> <span>comment</span> <span>signature</span> <span>user url</span>';
					break;
				case 'subscriber_notification_basic':
					$this->data['lang_heading']		= $this->data['lang_heading_subscriber_notification_basic'];
					$this->data['lang_description']	= $this->data['lang_description_subscriber_notification_basic'];
					$this->data['languages']		= $frontend_languages;
					$this->data['keywords']			= '<span>name</span> <span>page reference</span> <span>page url</span> <span>comment url</span> <span>poster</span> <span>comment</span> <span>signature</span> <span>user url</span>';
					break;
				case 'subscriber_notification_reply':
					$this->data['lang_heading']		= $this->data['lang_heading_subscriber_notification_reply'];
					$this->data['lang_description']	= $this->data['lang_description_subscriber_notification_reply'];
					$this->data['languages']		= $frontend_languages;
					$this->data['keywords']			= '<span>name</span> <span>page reference</span> <span>page url</span> <span>comment url</span> <span>poster</span> <span>comment</span> <span>signature</span> <span>user url</span>';
					break;
				case 'user_comment_approved':
					$this->data['lang_heading']		= $this->data['lang_heading_user_comment_approved'];
					$this->data['lang_description']	= $this->data['lang_description_user_comment_approved'];
					$this->data['languages']		= $frontend_languages;
					$this->data['keywords']			= '<span>name</span> <span>page reference</span> <span>page url</span> <span>comment url</span> <span>comment</span> <span>signature</span> <span>user url</span>';
					break;
				default:
					$this->response->redirect('main/dashboard');
			}
		} else {
			$this->response->redirect('main/dashboard');
		}

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ($this->validate()) {
				$this->model_settings_email_editor->update($this->request->post, $this->request->get['type']);
			}
		}

		$this->data['type'] = $type;

		$this->data['types'] = array(
			$this->data['lang_select_admin']							=> 'admin',
			$this->data['lang_select_ban']								=> 'ban',
			$this->data['lang_select_comment_approve']					=> 'comment_approve',
			$this->data['lang_select_comment_success']					=> 'comment_success',
			$this->data['lang_select_flag']								=> 'flag',
			$this->data['lang_select_password_reset']					=> 'password_reset',
			$this->data['lang_select_setup_test']						=> 'setup_test',
			$this->data['lang_select_subscriber']						=> 'subscriber',
			$this->data['lang_select_subscriber_confirmation']			=> 'subscriber_confirmation',
			$this->data['lang_select_subscriber_notification_admin']	=> 'subscriber_notification_admin',
			$this->data['lang_select_subscriber_notification_basic']	=> 'subscriber_notification_basic',
			$this->data['lang_select_subscriber_notification_reply']	=> 'subscriber_notification_reply',
			$this->data['lang_select_user']								=> 'user',
			$this->data['lang_select_user_comment_approved']			=> 'user_comment_approved'
		);

		if (isset($this->request->post['field'])) {
			$this->data['field'] = $this->request->post['field'];
		} else {
			$this->data['field'] = $this->model_settings_email_editor->getEmail($this->request->get['type']);
		}

		if (isset($this->error['subject'])) {
			$this->data['error_subject'] = $this->error['subject'];
		} else {
			$this->data['error_subject'] = '';
		}

		if (isset($this->error['from_name'])) {
			$this->data['error_from_name'] = $this->error['from_name'];
		} else {
			$this->data['error_from_name'] = '';
		}

		if (isset($this->error['from_email'])) {
			$this->data['error_from_email'] = $this->error['from_email'];
		} else {
			$this->data['error_from_email'] = '';
		}

		if (isset($this->error['reply_to'])) {
			$this->data['error_reply_to'] = $this->error['reply_to'];
		} else {
			$this->data['error_reply_to'] = '';
		}

		if (isset($this->error['text'])) {
			$this->data['error_text'] = $this->error['text'];
		} else {
			$this->data['error_text'] = '';
		}

		if (isset($this->error['html'])) {
			$this->data['error_html'] = $this->error['html'];
		} else {
			$this->data['error_html'] = '';
		}

		if ($this->setting->get('notice_settings_email_editor')) {
			$this->data['info'] = $this->data['lang_notice'];
		}		

		$this->components = array('common/header', 'common/footer');

		$this->loadView('settings/email_editor');
	}

	public function dismiss() {
		$this->loadModel('settings/email_editor');

		$this->model_settings_email_editor->dismiss();
	}

	private function validate() {
		$this->loadModel('common/poster');

		$unpostable = $this->model_common_poster->unpostable($this->data);

		if ($unpostable) {
			$this->data['error'] = $unpostable;

			return false;
		}

		foreach ($this->request->post['field'] as $key => $value) {
			if (!isset($value['subject']) || $this->validation->length($value['subject']) < 1 || $this->validation->length($value['subject']) > 250) {
				$this->error['subject'][$key] = sprintf($this->data['lang_error_length'], 1, 250);
			}

			if (!isset($value['from_name']) || $this->validation->length($value['from_name']) < 1 || $this->validation->length($value['from_name']) > 250) {
				$this->error['from_name'][$key] = sprintf($this->data['lang_error_length'], 1, 250);
			}

			if (isset($value['from_email']) && !empty($value['from_email']) && !$this->validation->isEmail($value['from_email'])) {
				$this->error['from_email'][$key] = $this->data['lang_error_email_invalid'];
			}

			if (!isset($value['from_email']) || $this->validation->length($value['from_email']) < 1 || $this->validation->length($value['from_email']) > 250) {
				$this->error['from_email'][$key] = sprintf($this->data['lang_error_length'], 1, 250);
			}

			if (isset($value['reply_to']) && !empty($value['reply_to']) && !$this->validation->isEmail($value['reply_to'])) {
				$this->error['reply_to'][$key] = $this->data['lang_error_email_invalid'];
			}

			if (!isset($value['reply_to']) || $this->validation->length($value['reply_to']) < 1 || $this->validation->length($value['reply_to']) > 250) {
				$this->error['reply_to'][$key] = sprintf($this->data['lang_error_length'], 1, 250);
			}

			if (!isset($value['text']) || $this->validation->length($value['text']) < 1 || $this->validation->length($value['text']) > 5000) {
				$this->error['text'][$key] = sprintf($this->data['lang_error_length'], 1, 5000);
			}

			if (!isset($value['html']) || $this->validation->length($value['html']) < 1 || $this->validation->length($value['html']) > 5000) {
				$this->error['html'][$key] = sprintf($this->data['lang_error_length'], 1, 5000);
			}
		}

		if ($this->error) {
			$this->data['error'] = $this->data['lang_message_error'];

			return false;
		} else {
			$this->data['success'] = $this->data['lang_message_success'];

			return true;
		}
	}
}
?>