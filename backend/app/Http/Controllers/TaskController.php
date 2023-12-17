<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\TaskService;

Use Exception;

class TaskController extends Controller
{
    public function index()
    {
        $list               = (new TaskService())->Tasksql();

        if(request()->limit){
            $list           = $list->paginate(request()->limit);
        }else{
            $list           = $list->get();
        }

        return response()->json([
            'oke'   => true,
            'data'  => $list,
            'limit' => request()->limit
        ]);
    }
    public function store(Request $request, TaskService $task)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'remind_at' => 'required',
            'event_at' => 'required',
        ],[
            'title.required' => 'title is required !',
            'description.required' => 'description is required !',
            'remind_at.required' => 'Reminder is required !',
            'event_at.required' => 'Event is required !',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json([
                'message'   => $error,
            ], 400);
        }

        return $task->store($request);
    }
    public function view($id)
    {
        try{
            $task               = (new TaskService())->Tasksql()->find($id);
    
            return response()->json([
                'oke'   => true,
                'data'  => $task
            ], 200);
        }catch(Exception $e) {
            return response()->json([
                'oke'   => false,
                'msg'   => $e->getMessage()
            ], 400);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'remind_at' => 'required',
            'event_at' => 'required',
        ],[
            'title.required' => 'title is required !',
            'description.required' => 'description is required !',
            'remind_at.required' => 'Reminder is required !',
            'event_at.required' => 'Event is required !',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json([
                'message'   => $error,
            ], 400);
        }
        $request->merge(array(
            'task_id'=> $id
        ));
        return (new TaskService())->update($request);
    }
    public function destroy($id)
    {
        try{
            return (new TaskService())->delete($id);
        }catch(Exception $e) {
            return response()->json([
                'oke'   => false,
                'msg'   => $e->getMessage()
            ], 400);
        }
    }
}
