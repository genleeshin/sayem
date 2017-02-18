<?php 

namespace App\Controllers;

use App\Thread;

use App\Database;

class ThreadsController extends Controller{

	public function index()
	{
		// if url has id then show thread posts, else threads list

		$id = get_int('id', false);

		if($id)
			return $this->posts($id);

		return $this->threads();
	
	}

	public function threads()
	{
		// list 20 threads per page

		// get sort type


		$query = Thread::where('parent_id', null)->with('user')->limit(20);

		$sort = get_string('sort', 'newest');

		Thread::setOrder($query, $sort);

		$threads = $query->get();

		return view('threads.index', compact('threads', 'sort'));
	
	}

	public function posts($id)
	{
		// get main thread post with user information

		$post = Thread::with('user')->find($id);

		// get all thread replies with their user information

		$replies = Thread::with('user')->where('parent_id', $id)->get();

		// generate output

		return view('threads.posts', compact('post', 'replies'));
	
	}

	// reply to a thread

	public function reply()
	{
		// user must be logged in to post a reply
		if(!is_logged())
			forbidden();

		$id = post_int('id', false);

		if(!$id) die('Invalid post');

		// check if reply is empty, must have atleast 2 characters

		// if error redirect back to form

		$this->validate([
				'body' => 'text|min:2'
			], '/threads?id=' . $id . '#form-reply');


		// validation is OK

		// remove all html tags from reply body, keep only p,b,i,strong

		$body = sanitize_rich_text_input($_POST['body']);

		// insert to db

		$reply = Thread::create([
				'parent_id' => $id,
				'user_id' => user()->id,
				'body' => $body
			]);

		// recount replies

		(new Thread)->updateTotalReplies($id);

		redirect('/threads?id=' . $id . '#reply-id' . $reply->id);
	
	}

	// create new thread

	public function add()
	{
	
		// user must be logged in
		if(!is_logged())
			forbidden();

		// empty instance
		$post = null;

		return view('threads.form', compact('post'));
	
	}

	// edit post

	public function edit()
	{
		// user must be logged in to post a reply
		if(!is_logged())
			forbidden();

		$id = get_int('id', false);

		if(!$id) die('Invalid post');

		// get post details

		$post = Thread::find($id);

		// check if user own this post

		if($post->user_id != user()->id)
			die('You are not authrized to edit this post');

		// it's his own post so let him edit

		// post a reply or main thread title

		$is_main_post = $post->parent_id>0?false:true;

		return view('threads.form', compact('post', 'is_main_post'));
	
	}

	// create a new thread

	public function create()
	{

		// user must be logged in

		if(!is_logged())
			forbidden();

	
		$valid = $this->validate([

			'title' => 'text|min:2',

			'body' => 'text|min:2'
		], '/thread/new');

		$data['title'] = filter_var(trim($_POST['title']), FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);

		$data['body'] = sanitize_rich_text_input($_POST['body']);

		$data['user_id'] = user()->id;

		$post = Thread::create($data);

		redirect('/threads?id=' . $post->id);
	}

	// save post

	public function save()
	{
	
		// user must be logged in
		if(!is_logged())
			forbidden();

		// check if post has a valid id

		$id = post_int('id', false);

		if(!$id) die('Invalid post');

		// validate

		$rules['body'] = 'text|min:2';

		if($title = post_string('title', false))
			$rules['title'] = 'text|min:2';

		$valid = $this->validate($rules, '/thread/edit?id=' . $id);

		// get post details

		$post = Thread::find($id);

		// check if user own this post

		if($post->user_id != user()->id)
			die('You are not authrized to edit this post');

		if($title)
			$data['title'];

		$data['body'] = sanitize_rich_text_input($_POST['body']);

		Thread::update($data, ['id' => $id]);

		if($post->parent_id>0){
			redirect('/threads?id=' . $post->parent_id . '#reply' . $id);
		}

		redirect('/threads?id=' . $id);
	
	}

	// delete reply or thread

	public function remove()
	{
	
		// get post id from url

		$id = get_int('id', false);

		if(!$id) die('Invalid post id');

		// user must be logged in to perform this action

		if(!is_logged())
			die('You are not authorized to perform this action');

		// get post details

		$post = Thread::find($id);

		// check if user own this post

		if(!$post || $post->user_id != user()->id )
			die('You are not authorized to perform this action');

		// remove the post and all it's replies

		// if parent delete all it's replies first

		if(is_null($post->parent_id))
			Thread::where('parent_id', $id)->remove();

		// remove post

		Thread::where('id', $id)->remove();



		// if it was a reply update thread's replies count

		if($post->parent_id>0)
			(new Thread)->updateTotalReplies($post->parent_id);

		// if it was a thread return to thread list, else return to thread

		if($post->parent_id>0)
			return redirect('/threads?id=' . $post->parent_id);

		return redirect();
	
	}

}