<?php
namespace Commentics;

class ReportPermissionsController extends Controller {
	public function index() {
		$this->loadLanguage('report/permissions');

		$this->loadModel('report/permissions');

		$this->data['files'] = array(
			array(
				'path'			=> '/commentics/config.php',
				'information' 	=> $this->data['lang_text_config'],
				'positive' 		=> ($this->model_report_permissions->isWritable(CMTX_DIR_ROOT . 'config.php')) ? false : true,
				'text' 			=> ($this->model_report_permissions->isWritable(CMTX_DIR_ROOT . 'config.php')) ? $this->data['lang_text_writable'] : $this->data['lang_text_not_writable']
			),
			array(
				'path'			=> '/commentics/system/backups/',
				'information' 	=> $this->data['lang_text_backups'],
				'positive' 		=> ($this->model_report_permissions->isWritable(CMTX_DIR_BACKUPS)) ? true : false,
				'text' 			=> ($this->model_report_permissions->isWritable(CMTX_DIR_BACKUPS)) ? $this->data['lang_text_writable'] : $this->data['lang_text_not_writable']
			),
			array(
				'path'			=> '/commentics/system/logs/',
				'information' 	=> $this->data['lang_text_logs'],
				'positive' 		=> ($this->model_report_permissions->isWritable(CMTX_DIR_LOGS)) ? true : false,
				'text' 			=> ($this->model_report_permissions->isWritable(CMTX_DIR_LOGS)) ? $this->data['lang_text_writable'] : $this->data['lang_text_not_writable']
			),
			array(
				'path'			=> '/commentics/system/logs/errors.log',
				'information' 	=> $this->data['lang_text_errors'],
				'positive' 		=> ($this->model_report_permissions->isWritable(CMTX_DIR_LOGS . 'errors.log')) ? true : false,
				'text' 			=> ($this->model_report_permissions->isWritable(CMTX_DIR_LOGS . 'errors.log')) ? $this->data['lang_text_writable'] : $this->data['lang_text_not_writable']
			),
			array(
				'path'			=> '/commentics/system/modification/cache/',
				'information' 	=> $this->data['lang_text_mod_cache'],
				'positive' 		=> ($this->model_report_permissions->isWritable(CMTX_DIR_MOD_CACHE)) ? true : false,
				'text' 			=> ($this->model_report_permissions->isWritable(CMTX_DIR_MOD_CACHE)) ? $this->data['lang_text_writable'] : $this->data['lang_text_not_writable']
			),
			array(
				'path'			=> '/commentics/upload/',
				'information' 	=> $this->data['lang_text_upload'],
				'positive' 		=> ($this->model_report_permissions->isWritable(CMTX_DIR_UPLOAD)) ? true : false,
				'text' 			=> ($this->model_report_permissions->isWritable(CMTX_DIR_UPLOAD)) ? $this->data['lang_text_writable'] : $this->data['lang_text_not_writable']
			)
		);

		if (!$this->setting->get('check_config')) {
			array_shift($this->data['files']);
		}

		$this->components = array('common/header', 'common/footer');

		$this->loadView('report/permissions');
	}
}
?>