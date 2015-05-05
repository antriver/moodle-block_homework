<?php

/**
 * @package    block_homework
 * @copyright  Anthony Kuske <www.anthonykuske.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_homework;

class CourseManager
{
    private $hwblock;

    public function __construct(Block $hwblock)
    {
        $this->hwblock = $hwblock;
    }

    /**
     * Getting courses a user is in...
     */

    /**
     * Returns every teaching and learning course
     */
    public function getAllCourses()
    {

        global $DB;
        $values = array();
        $sql = 'SELECT
            crs.id,
            crs.fullname
        FROM {course} crs
        LEFT JOIN {context} ct ON ct.instanceid = crs.id AND ct.contextlevel = 50';
        // context level 50 = a course

        if ($categoryCtx = $this->hwblock->getCategoryContext()) {
            $path = $categoryCtx->path . '/%';
            $sql .= " WHERE ct.path LIKE ?";
            $values[] = $path;
        }

        $sql .= ' ORDER BY crs.fullname';

        return $DB->get_records_sql($sql, $values);
    }

    public function getUsersCourses($userId, $roleid = null)
    {
        global $DB;

        $values = array(
            $userId
        );

        $sql = 'SELECT
            crs.id,
            crs.fullname
        FROM {role_assignments} ra
        JOIN {context} ct ON ct.id = ra.contextid
        JOIN {course} crs ON crs.id = ct.instanceid
        WHERE ra.userid = ?';

        if ($categoryCtx = $this->hwblock->getCategoryContext()) {
            $path = $categoryCtx->path . '/%';
            $sql .= " AND ct.path LIKE ?";
            $values[] = $path;
        }

        if (!is_null($roleid)) {
            $sql .= ' AND ra.roleid = ? ';
            $values[] = $roleid;
        }

        $sql .= 'ORDER BY crs.fullname';

        return $DB->get_records_sql($sql, $values);
    }

    public function coursesToIDs($courses)
    {
        $ids = array();
        foreach ($courses as $course) {
            $ids[] = intval($course->id);
        }
        return $ids;
    }

    /**
     * Returns all course IDs that the user is enrolled in
     */
    public function getUsersCourseIDs($userId, $roleid = null)
    {
        $courses = $this->getUsersCourses($userId, $roleid);
        return $this->coursesToIDs($courses);
    }

    public function getUsersTaughtCourses($userId)
    {
        return $this->getUsersCourses($userId, 3);
    }

    public function getUsersTaughtCourseIDs($userId)
    {
        return $this->getUsersCourseIDs($userId, 3);
    }

}
