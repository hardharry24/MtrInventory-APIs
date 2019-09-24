<?php

class Utils
{
	public function saveImage($img)
	{
		$target_dir = "../Images";
		$filename = rand()."_".time().".jpeg";

		$target_dir = $target_dir ."/".$filename;

		$response = array();

		if (file_put_contents($target_dir,base64_decode($img)))
		{
			return $filename;
		}
	}
}

?>