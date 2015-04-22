<?php

/**
 * Display a list of the groups the user is enrolled in
 */

require 'include/header.php';
echo $OUTPUT->header();

echo $hwblock->display->tabs('classes');

switch ($hwblock->getMode()) {

	case 'pastoral-student':
	case 'student':
	case 'parent':
	case 'teacher':

		/**
		 * Show the timetable view of the student's homework due in the next 2 weeks
		 */
		echo $hwblock->display->sign('group', 'View by Class', 'Find a summary of homework information (including upcoming and due) by class only.');
		$groups = $hwblock->groups->getAllUsersGroups($hwblock->getUserId());
		echo $hwblock->display->classList($groups);

		break;

	case 'pastoral':

		/**
		 * Show all classes in the school
		 */
		echo '<h2><i class="icon-group"></i> All Classes</h2>';
		$groups = $hwblock->groups->getAllGroups();
		echo $hwblock->display->classList($groups);

		break;
}

echo $OUTPUT->footer();
