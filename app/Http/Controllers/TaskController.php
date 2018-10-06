<?php

namespace App\Http\Controllers;

use App\Group;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
	public function setComplete($taskID) {
		$task = Task::find($taskID);
		$task->completed = true;

		if ($task->save()) {
			session()->flash('status', 'Task has been marked as completed.');
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors('Cannot change the status. Please try again.');
		}
	}

	public function setIncomplete($taskID) {
		$task = Task::find($taskID);
		$task->completed = false;

		if ($task->save()) {
			session()->flash('status', 'Task has been re-added to to-do list.');
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors('Cannot change the status. Please try again.');
		}
	}

	public function create(Request $request, $urlSlug) {
		//dd($request);
		$this->validate($request, [
			'details' => 'required|min:10',
			'due_date' => 'required|date'
		]);

		$group = Group::where('url_slug', $urlSlug)->first();

		$taskDB = Task::where('details', $request->details)
					  ->where('group_id', $group->id);
		if ($taskDB->count() > 0) {
			return redirect()->back()->withErrors('This task is already present in the current group.');
		}

		$task = new Task();
		$task->details = $request->details;
		$task->priority = $request->priority;
		$task->due_date = $request->due_date;
		$task->group_id = $group->id;

		if ($task->save()) {
			session()->flash('status', 'Task added.');
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors('Cannot save the task. Please try again.');
		}
	}

	public function archive($taskID) {
		$task = Task::find($taskID);
		$task->archived = true;

		if ($task->save()) {
			session()->flash('status', 'Task has been archived.');
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors('Cannot archive. Please try again.');
		}
	}

	public function restore($taskID) {
		$task = Task::find($taskID);
		$task->archived = false;

		if ($task->save()) {
			session()->flash('status', 'Task has been restored.');
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors('Cannot restore. Please try again.');
		}
	}

	public function delete($taskID) {
		$task = Task::find($taskID);
		$task->deleted = true;

		if ($task->save()) {
			session()->flash('status', 'Task has been deleted.');
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors('Cannot delete. Please try again.');
		}
	}
}
