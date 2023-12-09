<?php

use Core\Database;

$params   = "";

if(isset($_GET['schedule_group_id']))
{
    $params = " WHERE exam_group_member.group_id = (SELECT group_id FROM exam_schedule_groups WHERE id = $_GET[schedule_group_id])";
}

$db = new Database;

$db->query  = "SELECT 
                 users.id user_id,
                 users.name, 
                 username,
                 exam_groups.id group_id,
                 exam_groups.name group_name
                FROM 
                 users
                JOIN
                 exam_group_member ON user_id = users.id
                JOIN
                 exam_groups ON exam_groups.id = exam_group_member.group_id
                $params
                ";
$member     = $db->exec('all');

return view('exam/views/schedules/groups/presence-list', compact('member'));