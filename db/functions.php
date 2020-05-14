  
<?php
	function redirect_to($location) {
			$URL="http://localhost/DuckShop/views/";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL .$location. '">';
	}
?>