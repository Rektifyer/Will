<?php
/**
 * PHP Version 5
 * 
 * Asdfgsadfgdsfgdsg.
 * 
 * @file 
 * Sugmaballs
 * 
 * @category Tag
 * @package  Tag
 * @author   William Smith <will1996@live.com.au>
 * @license  https://www.webcodesniffer.net/report.php lig
 * @version  CVS:1.11 <Sugma>
 * @link     https://www.webcodesniffer.net/report.php sug
 **/
require "./templates/head.php";
$dbhost        = "localhost";
$dbuser        = "root";
$dbpass        = "usbw";
$db            = "movies";
$TimesSearched = 0;
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
if (!isset($_POST['submit'])) {
    ?>
           <h1>Movie Search</h1>
            <form action="<?php
            echo $_SERVER['PHP_SELF'];
            ?>"
            method="post" class='centre'>
            <label for="Title">Title</Title></label>
            <input type="text" name="Title"/>
            <label for="Genre">Genre</label>
            <input type="text" name="Genre"/>
            <label for="Rating">Rating</label>
            <input type="text" name="Rating"/>
            <label for="Year">Year</label>
            <input type="text" name="Year"/>

            <label for="submit">&nbsp;</label>
            <input type="submit" name="submit" value="Submit"/>
            </form>
    <?php
} else {
    
    //get all of the form data
    $Title  = $_POST['Title'];
    $Genre  = $_POST['Genre'];
    $Rating = $_POST['Rating'];
    $Year   = $_POST['Year'];
    
    $sql2 = "UPDATE movies_table SET TimesSearched = TimesSearched + 1 Where Title Like '%$Title%' AND Genre Like '%$Genre%' AND Rating Like '%$Rating%' AND `year` Like '%$Year%'";
    $conn->query($sql2);
    
    
    $sql = "SELECT Title, Genre, Rating, Year FROM movies_table WHERE Title Like '%$Title%' AND Genre Like '%$Genre%' AND Rating Like '%$Rating%' AND `year` Like '%$Year%'";
    
    $result = $conn->query($sql);
    
    if (mysqli_num_rows($result) > 0) {
        
        //tells you if the name exists
        //display the table
        echo "<table style='text-align: center; width: 50%; border-style: 
    solid; border-color:green;' class ='centre'>";
        
        //display the header row of the table
        echo "    <tr>
                            <th>Title</th>
                            <th>Genre</th> 
                            <th>Rating</th>
                            <th>Year</th>
                        </tr>";
        
        //diplay eac from the selected supplier
        while ($row = mysqli_fetch_row($result)) {
            
            echo "<tr>";
            
            
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            
            echo "</tr>";
            
        } //end while
        //need to add somethinghere
        
        
        echo "</table>";
    } else {
        echo "Movie Not Found, Please try again";
    }
}
$conn->close();
require "./templates/foot.php";
?>