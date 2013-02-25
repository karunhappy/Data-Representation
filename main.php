<?php  
function show($root_node) {  
    // It will retrieve the left and right value of the $root_node node  
    $output = mysql_query('SELECT lft, rgt FROM category '. 'WHERE name="'.$root_node.'";');  
    $row = mysql_fetch_array($output);
    // start with an empty $right stack  
    $right = array();  
    // now, retrieve all data of the $root_node node  
   $output = mysql_query('SELECT name, lft, rgt FROM category '. 'WHERE lft BETWEEN '.$row['lft'].' AND '. $row['rgt'].' ORDER BY lft ASC;');  
     // display each row  
   while ($row = mysql_fetch_array($output)) {  
        // only check stack if there is one  
     if (count($right)>0) {  
            // check if we should remove a node from the stack  
           while ($right[count($right)-1]<$row['rgt']) {  
                array_pop($right);  
            }  
       }  
        // display indented node title  
        echo str_repeat('  ',count($right)).$row['title']."\n";  
        // add this node to the stack  
        $right[] = $row['rgt'];  
    }   
}  
//Establishes connection 
$mys = new mysqli("localhost", "aggarwal", "123", "work");
    //Check whether Database is connected or not
  if ($mys === false)
	{
                //If Database is not connected displays an error message
		die("Error: couldnot connect ");		
		}
                //Call the defined function
		show("Electronics");
?>
