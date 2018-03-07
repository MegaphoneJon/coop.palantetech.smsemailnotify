<?php

require_once 'smsemailnotify.civix.php';

function smsemailnotify_civicrm_post( $op, $objectName, $objectId, &$objectRef ) {
  if ($op == 'create' && $objectName == 'Activity') {
    // Activity Type ID 45 is inboard SMS.  51 is for testing.
    if($objectRef->activity_type_id == 45) { 
      $to = 'info@healthcare-now.org';
      $from = 'noreply@healthcare-now.org';
      // Get the contact's ID.
      $contactId = civicrm_api3('ActivityContact', 'getvalue', array(
        'sequential' => 1,
        'return' => "contact_id",
        'activity_id' => $objectRef->id,
        'record_type_id' => "Activity Source",
      ));
      $displayName = civicrm_api3('Contact', 'getvalue', array(
        'sequential' => 1,
        'return' => "display_name",
        'id' => $contactId,
      ));

      $subject = 'New inbound SMS from ' . $displayName;
      $headers = "From: $from" . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
      // Get a link to the contact's URL.
      $contactURL = CRM_Utils_System::url("civicrm/contact/view",
        'reset=1&cid=' . $contactId,
        TRUE,
	NULL,
	TRUE,
	FALSE,
	TRUE
      );
      $message = "New inbound message from $displayName\r\n$contactURL\r\n\r\nMessage: $objectRef->details";
      mail( $to, $subject, $message, $headers); 
    }
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function smsemailnotify_civicrm_config(&$config) {
  _smsemailnotify_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function smsemailnotify_civicrm_xmlMenu(&$files) {
  _smsemailnotify_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function smsemailnotify_civicrm_install() {
  _smsemailnotify_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function smsemailnotify_civicrm_uninstall() {
  _smsemailnotify_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function smsemailnotify_civicrm_enable() {
  _smsemailnotify_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function smsemailnotify_civicrm_disable() {
  _smsemailnotify_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function smsemailnotify_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _smsemailnotify_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function smsemailnotify_civicrm_managed(&$entities) {
  _smsemailnotify_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function smsemailnotify_civicrm_caseTypes(&$caseTypes) {
  _smsemailnotify_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function smsemailnotify_civicrm_angularModules(&$angularModules) {
_smsemailnotify_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function smsemailnotify_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _smsemailnotify_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function smsemailnotify_civicrm_preProcess($formName, &$form) {

}

*/
