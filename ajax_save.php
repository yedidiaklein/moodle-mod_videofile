<?php
define('AJAX_SCRIPT', true);
require __DIR__ . '/../../config.php';
if (!isloggedin() || isguestuser()) {
	print_error('No permissions');
}

if ($id = optional_param('delete', null, PARAM_INT)) {
	$DB->delete_records('videostreambookmarks', ['id' => $id, 'userid' => $USER->id]);
	die('1');
}

$moduleid = required_param('moduleid', PARAM_INT);
$bookmarkposition = required_param('bookmarkposition', PARAM_FLOAT);
$bookmarkname = required_param('bookmarkname', PARAM_RAW);
$bookmarkflag = required_param('bookmarkflag', PARAM_RAW);
$userid = $USER->id;
$object = compact('userid', 'bookmarkposition', 'bookmarkname', 'bookmarkflag', 'moduleid');
$id = $DB->insert_record('videostreambookmarks', $object);
echo json_encode($DB->get_record('videostreambookmarks', ['id' => $id]));
