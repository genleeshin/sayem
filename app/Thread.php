<?php 

namespace App;

class Thread extends Model{
	protected $fillable = ['parent_id', 'user_id', 'title', 'body', 'replies'];
}
