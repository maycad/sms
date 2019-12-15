<?php
namespace MayCad\SMS\Providers;

/**
 * 
 */
interface IProvider
{
	function send(string $to, string $msg);
}