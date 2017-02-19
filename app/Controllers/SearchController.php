<?php 

namespace App\Controllers;

use App\Database\Db;

use App\Thread;

class SearchController extends Controller{

	protected $sort = 'newest';

	public function __construct()
	{
	
		$this->sort = get_string('sort', 'newest');
	
	}

	public function index()
	{
	
		$type = get_string('type', 'title');

		$q = get_string('q', false);

		$q = filter_var(trim($q), FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);

		if(!$q || empty($q))
			die('Invalid search');

		$method = 'search' . ucfirst($type);

		$threads = $this->$method($q);

		$sort = $this->sort;

		return view('search.index', compact('threads', 'sort', 'q'));
	}

	public function searchTitle($keys)
	{
	
		$cond = Db::whereLike('t.title', $keys);

		Thread::setOrder($cond, $this->sort, 't');

		return Db::query("select t.*,u.name as username from threads t 
			inner join users u on t.user_id=u.id " . 
			$cond->getCondition() . ' ' . 
			$cond->getOrder(), 
			$cond->getValues()
		)->get();
	
	}

	public function searchPost($keys)
	{
		$cond = Db::whereLike('t1.body', $keys);

		Thread::setOrder($cond, $this->sort, 't1');

		return Db::query(
			"select t1.*,u.name as username, t2.title as parent_title from threads t1 

			left join threads t2 on t1.parent_id=t2.id 

			inner join users u on t1.user_id=u.id " . 

			$cond->getCondition() . ' ' . 

			$cond->getOrder(), 

			$cond->getValues()

		)->get();

		dd($threads);
	
	}

	public function searchUser($keys)
	{
	
		$cond = Db::whereLike('u.name', $keys);

		Thread::setOrder($cond, $this->sort, 't1');

		return Db::query(
			"select u.name as username,t1.*,t2.title as parent_title from users u 

			inner join threads t1 on u.id=t1.user_id  

			left join threads t2 on t1.parent_id=t2.id " . 

			$cond->getCondition() . ' ' . 

			$cond->getOrder(), 

			$cond->getValues()

		)->get();
	
	}
}
