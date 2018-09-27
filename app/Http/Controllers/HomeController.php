<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($groupSlug = 'general')
    {
    	$currentGroup = auth()->user()->groups->where('url_slug', $groupSlug)->first();
    	$priorities = ['Low', 'Normal', 'High'];
    	$priorityClasses = ['primary', 'warning', 'danger'];
    	$pageData = [
    		'title' => 'Tasks',
			'groups' => auth()->user()->groups,
			'incompleteTasks' => $currentGroup->tasks()->orderBy('priority', 'desc')->orderBy('created_at', 'desc')->where('completed', 0)->get(),
			'completeTasks' => $currentGroup->tasks()->orderBy('priority', 'desc')->orderBy('updated_at', 'desc')->where('completed', 1)->get(),
			'urlSlug' => $groupSlug,
			'currentGroup' => $currentGroup,
			'priorities' =>$priorities,
			'priorityClasses' =>$priorityClasses,
		];

        return view('home')->with($pageData);
    }
}
