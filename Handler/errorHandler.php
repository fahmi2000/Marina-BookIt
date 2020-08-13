<?php

if (isset($_GET['signinerror']))
{
	if ($_GET['signinerror'] == 'emptyfields')
	{
		echo
		"<script>
            Swal.fire
            (
              'Error!',
              'All fields must not be empty.',
              'error'
            )        
        </script>";
		header ("Location: ../loginPage.php");
	}
}
