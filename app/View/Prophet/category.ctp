<table>
   <tr>
      <th>
	Add
      </th>
      <th>
	Category Name
      </th>
      <th>
	Nick Name
      </th>
   <tr>

<?php
foreach($data['resq']->item_cat as $item){
   echo "<tr>";
   echo "<form method='post'>";
   echo "<th>
	   <input type='hidden' name='data[cid]' value='".$item->cid."' />
	   <input type='hidden' name='data[category]' value='".$item->name."' />
	   <input type='submit' value='Add' />
	</th>";
   if($item->is_parent == 'true'){
 	echo "<th><a href='".$this->webroot."prophet/category/".$item->cid."'>".$item->name."</th>";
   }
   else {
   	echo "<th>".$item->name."</th>";
   }
   echo "<th><input name='data[content]' value='".$item->name."'</input></th>";
   echo "</form>";
   echo "<tr>";
}
?>
</table>

<?php
pr($_POST);
?>
