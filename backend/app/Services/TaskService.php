<?php

namespace App\Services;

use App\Models\MTask;

Use Exception;
/**
 * Class TaskService.
 */
class TaskService
{
    public function Tasksql()
    {
        return MTask::query();
    }
    public function store(object $data)
    {
        $data->action           = 'create';
        return $this->insertOrUpdate($data);
    }
    public function update(object $data)
    {
        $data->action           = 'update';
        return $this->insertOrUpdate($data);
    }
    public function insertOrUpdate(object $data)
    {
        try{
            $task               = $data->action == 'create' ? new MTask : MTask::find($data->task_id);
    
            $task->title        = $data->title;
            $task->description  = $data->description;
            $task->remind_at    = $data->remind_at;
            $task->event_at     = $data->event_at;
    
            $task->save();

            return response()->json([
                'oke'   => true,
                'data'   => $task
            ]);
        }catch(Exception $e) {
            return response()->json([
                'oke'   => false,
                'msg'   => $e->getMessage()
            ], 400);
        }
    }
    public function delete($id)
    {
        $finddata                   = MTask::findOrFail($id);

        if(!empty($finddata)){
            $finddata->delete();
            return response()->json([
                'oke'   => true,
            ], 200);
        }else{
            return response()->json([
                'oke'   => false,
                'msg'   => 'error delete!'
            ], 400);
        }
    }
}
