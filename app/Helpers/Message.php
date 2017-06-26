<?php
namespace App\Helpers;

use App\Helpers\Contracts\MessageContract;

class Message implements MessageContract
{
	function pushMessage($message, $level, $important)
	{
		session()->flash('flash_message', $message);
		session()->flash('flash_message_level', $level);
		session()->flash('flash_message_important', $important);
	}
}