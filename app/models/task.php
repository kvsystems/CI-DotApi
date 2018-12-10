<?

namespace Evie\App\Models;

use Evie\System\Kernel\Model;

class Task extends Model  {

    public function __construct() {
        parent::__construct();
    }

    public function getTasks($locale = false)  {
        return $this->db['tasks']->SelectTable(
            "SELECT t.taskId, td.taskName, t.taskDate FROM task t 
             LEFT JOIN task_description td ON (t.taskId = td.taskId) 
             LEFT JOIN `language` l ON (l.languageId = td.languageId) 
             WHERE l.languageCode = {?} AND t.taskStatus = {?}",
            [$locale, 1]
        );
    }

    public function getTaskById($locale = false)   {
        $taskId = isset($this->Route['params'][0]) ? (int) $this->Route['params'][0] : 0;
        return $this->db['tasks']->SelectString(
            "SELECT t.taskId, td.taskName, t.taskDate, a.authorName, s.statusValue, td.taskDescription FROM task t 
             LEFT JOIN task_description td ON (t.taskId = td.taskId) 
             LEFT JOIN `language` l ON (l.languageId = td.languageId) 
             LEFT JOIN author a ON (a.authorId = t.authorId)
             LEFT JOIN `status` s ON (s.statusId = t.taskStatus)
             WHERE l.languageCode = {?} AND t.taskId = {?} AND t.taskStatus = {?} LIMIT 1",
            [$locale, $taskId, 1]
        );
    }

    public function countTasks($locale = false)    {
        return $this->db['tasks']->SelectCell(
            "SELECT COUNT(t.taskId) FROM task t 
             LEFT JOIN task_description td ON (t.taskId = td.taskId) 
             LEFT JOIN `language` l ON (l.languageId = td.languageId) 
             WHERE l.languageCode = {?} AND t.taskStatus = {?}",
            [$locale, 1]
        );
    }

    public function pushTasks() {
        for($i = 3; $i < 1000; $i++)   {

            $taskDate = date("Y-m-d H:i:s");

            $inserted = $this->db['tasks']->Modify(
                "INSERT INTO task VALUES(NULL, {?}, {?}, {?})",
                [$taskDate, rand(1,2), 1]
            );

            $this->db['tasks']->Modify(
                "INSERT INTO task_description VALUES(NULL, {?}, {?}, {?},{?})",
                [$inserted, "Задание " . $i, "Описание задания " . $i, 1]
            );

            $this->db['tasks']->Modify(
                "INSERT INTO task_description VALUES(NULL, {?}, {?}, {?},{?})",
                [$inserted, "Task " . $i, "Task " . $i . " description", 2]
            );
        }
    }

    public function getTasksPage($limit = 10, $locale = false)  {

        $taskStart = isset($this->Route['params'][0]) ? (int) $this->Route['params'][0] : 0;
        if($taskStart > 0) $taskStart--;

        return $this->db['tasks']->SelectTable(
            "SELECT t.taskId, td.taskName, t.taskDate FROM task t 
             LEFT JOIN task_description td ON (t.taskId = td.taskId) 
             LEFT JOIN `language` l ON (l.languageId = td.languageId) 
             WHERE l.languageCode = {?} AND t.taskStatus = {?} LIMIT " . $taskStart * $limit . ", " . $limit,
            [$locale, 1]
        );
    }

    public function getTasksByName($locale = false)    {
        $string = isset($this->Route['params'][0]) ? $this->Route['params'][0] : false;

        return $this->db['tasks']->SelectTable(
            "SELECT t.taskId, td.taskName, t.taskDate FROM task t 
             LEFT JOIN task_description td ON (t.taskId = td.taskId) 
             LEFT JOIN `language` l ON (l.languageId = td.languageId) 
             WHERE l.languageCode = {?} AND t.taskStatus = {?}  AND td.taskName LIKE '%".urldecode($string)."%' LIMIT 10",
            [$locale, 1 ]
        );
    }

}