<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

	public function create(Request $request) {
		$this->validate($request, [
			'title' => 'required|min:2'
		]);

		$title = $request->title;
		$urlSlug = str_slug($title, '-');

		$groupDB = Group::where('title', $title)->orWhere('url_slug', $urlSlug);
		if ($groupDB->count() > 0) {
			return redirect()->back()->withErrors('Title already exists. Please choose a different one.');
		}

		$group = new Group();
		$group->title = $title;
		$group->url_slug = $urlSlug;
		$group->user_id = auth()->user()->id;

		if ($group->save()) {
			session()->flash('status', 'Group added.');
			return redirect()->back();
		}
		else {
			return redirect()->back()->withErrors('Cannot save the group. Please try again.');
		}
	}
}
