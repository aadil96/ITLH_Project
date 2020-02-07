<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assignment;

class SearchController extends Controller
{

	public function search()
	{
		$assignment = Assignment::paginate(10);

		return $assignment;;
	}
    
}
