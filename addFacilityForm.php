<?php
	echo '<form name="addNewFacilityForm" action="addFacilityProcess.php" method="post">';
	echo '<label for="RoomId">Room ID</label>';
	echo '<br><input type="text" name="RoomId" required>';
	echo '<br><label for="RoomName">Room Name</label>';
	echo '<br><input type="text" name="RoomName">';
	echo '<br><label for="RoomStatus">Room Status</label>';
	echo '<br><input type="text" name="RoomStatus">';
	echo '<br><label for="RatePerHour">Rate Per Hour</label>';
	echo '<br><input type="number" step="any" name="RatePerHour">';
	echo '<br><input type="submit" value="submit" name="addButton">';
?>