

<?php

	class DB
	{
		
		function openDp()
		{
			$db = mysqli_connect('localhost','root','','suvetracw');
			return $db;
		}
		
		function closeDb($openedDb)
		{
			mysqli_close($openedDb);
		}
	}

?>


	