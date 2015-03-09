<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  <title>Registration List</title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
.tg .tg-0ord{text-align:right}
.tg .tg-ifyx{background-color:#D2E4FC;text-align:right}
.tg .tg-s6z2{text-align:center}
.tg .tg-vn4c{background-color:#D2E4FC}
</style>
</head>
<body>
<h1>Registration List</h1>
<table class="tg">
	<th class="tg-s6z2" colspan="9">Registration List</th>
	<tr>
		<td class="tg-vn4c">First Name</td>
		<td class="tg-vn4c">Last Name</td>
		<td class="tg-vn4c">Address1</td>
		<td class="tg-vn4c">Address2</td>
		<td class="tg-vn4c">City</td>
		<td class="tg-vn4c">State</td>
		<td class="tg-vn4c">Zip</td>
		<td class="tg-vn4c">Country</td>
		<td class="tg-vn4c">Date</td>
	</tr>
	<?php 
	require('dbconfig.inc');
	db_connect();

	$qryNews="SELECT * FROM `Hworld` ORDER BY `Date` DESC";
	$result=mysql_query($qryNews);
	echo mysql_error();
	echo $result->num_rows;
	if ($result) //if we have entries in the table print out rows in table 
	{
    	while($row = mysql_fetch_array($result))
    	 {
	    	echo "<tr>";
	        echo "<td class=\"tg-vn4c\">" .$row['First_Name']. "</td>";
	        echo "<td class=\"tg-vn4c\">" .$row['Last_Name']. "</td>";
	        echo "<td class=\"tg-vn4c\">" .$row['Address1']. "</td>";
	        echo "<td class=\"tg-vn4c\">" .$row['Address2']. "</td>";
	        echo "<td class=\"tg-vn4c\">" .$row['City']. "</td>";
	        echo "<td class=\"tg-vn4c\">" .$row['State']. "</td>";
	        echo "<td class=\"tg-vn4c\">" .$row['Zip_Code']. "</td>";
	        echo "<td class=\"tg-vn4c\">" .$row['Country']. "</td>";
	        echo "<td class=\"tg-vn4c\">" .$row['Date']. "</td>";
	        echo "</tr>";
	    }
	} 
	
echo "</table>";
echo mysql_error();
	echo $result->num_rows;
db_close();
	?>
</body>
</html>