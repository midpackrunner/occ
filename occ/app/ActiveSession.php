<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveSession extends Model
{
    protected $fillable = [
    	'session'
    ];


    public function current_session() {
    	$session = $this::findOrFail(1);
    	return $session->session;
    }
}
