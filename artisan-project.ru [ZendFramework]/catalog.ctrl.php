<?php
class CatalogController extends Site_Controller
{
	public function run()
	{
		header('Location: '.preg_replace('/^\/catalog\//i', '/cat/', $_SERVER['REQUEST_URI']), null, 301);
	}
}