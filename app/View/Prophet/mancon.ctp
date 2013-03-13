<table>
    <tr>
        <td>
	Cid
        </td>
        <td>
	Name
        </td>
	<td>
	Operate
	</td>
    </tr>
<?php
     foreach($category as $row){
	echo "<tr><td>
		".$row['Category']['id']."
	      </td>
	      <td>
		".$row['Category']['name']."
	      </td>
	      <td>
		".$row['Category']['nick']."
	      </td>
	      <td>
		<a href='delcon/".$row['Category']['id']."'> Delete </a>
	      </td></tr>
 	     ";
     }
?>
</table>
