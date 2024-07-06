<?php
include("dbconn.php");
	#receive values from the html form attributes 
	#in the viewData.php
	

	$movie_id = $_REQUEST['a_no']; #receive from the link : Edit.php?p_code=".$row["PARK_CODE"]
	
	#create SQL statement to retrieve data from the themepark table
	$sql= "SELECT * FROM movie WHERE idmovie= '$movie_id'";
	
	#execute SQL statement that assigned to the $sql variable
	$query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));
	#get the number of records from the attraction table
	$row = mysqli_num_rows($query);
	
	if($row == 0){
		echo "No record found";
	}
	else{ 
	#since the records exist in the table, 
	#then fetch the record of each column
        $r = mysqli_fetch_assoc($query);
        $movie_id = $r['idmovie']; # fetch a record value of the column idmovie
        $movie_name = $r['movie_name']; # fetch a record value of the column movie_name
        $movie_genre = $r['movie_genre']; # fetch a record value of the column movie_genre
        $movie_age = $r['movie_age']; # fetch a record value of the column movie_age
        $movie_image = $r['movie_image']; # fetch a record value of the column movie_image
        $movie_desc = $r['movie_desc']; # fetch a record value of the column movie_desc
        $movie_license_fee = $r['movie_licenseFee']; # fetch a record value of the column movie_licenseFee
        $movie_rating = $r['movie_rating']; # fetch a record value of the column movie_rating
        $movie_language = $r['movie_language']; # fetch a record value of the column movie_language
	}
	
?>
	<body>
	<form action= "processUpdateMovie.php" method = "post">
	<style>
            body{
				background-image: url(https://i.ibb.co/cFK2V6g/backG.png);
    			background-size: cover; 
			}
            table {
                margin: 0 auto;
                width: 50%;
                border-collapse: collapse;
            }
            th, td, input, textarea {
                padding: 10px;
                border: 1px solid #000;
				font-size: large;
            }
            th, tr, td {
                background-color: #f2f2f2;
            }
			input[type=submit] , input[type=button]{
				width: 300px;
				height: 50px;
				align-items: center;
				justify-items: center;
				margin: 0;
				padding: 8px 16px;
				font-size: 1em;
				color: white;
				background-color: gray;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			}

			input[type=submit]:hover {
				background-color: #b2beb5;
				color: black;
			}
        </style>
	
            
        <table border=1>
            <tr>
                <th colspan=3><h2>Movie Details</h2></th>
            </tr>
            <tr>
                <td>Movie ID</td>
                <td><input type="text" name="movieid" value="<?php echo $movie_id; ?>"></td>
            </tr>
            <tr>
                <td>Movie Name</td>
                <td><input type="text" name="moviename" value="<?php echo $movie_name; ?>"></td>
            </tr>
            <tr>
                <td>Movie Genre</td>
                <td><input type="text" name="moviegenre" value="<?php echo $movie_genre; ?>"></td>
            </tr>
            <tr>
                <td>Movie Age Rating</td>
                <td><input type="text" name="movieage" value="<?php echo $movie_age; ?>"></td>
            </tr>
            <tr>
                <td>Movie Image URL</td>
                <td><input type="text" name="movieimage" value="<?php echo $movie_image; ?>"></td>
            </tr>
            <tr>
                <td>Movie Description</td>
                <td><textarea name="moviedesc" rows="5" cols="40"><?php echo $movie_desc; ?></textarea></td>
            </tr>
            <tr>
                <td>Movie License Fee</td>
                <td><input type="text" name="movielicensefee" value="<?php echo $movie_license_fee; ?>"></td>
            </tr>
            <tr>
                <td>Movie Rating</td>
                <td><input type="text" name="movierating" value="<?php echo $movie_rating; ?>"></td>
            </tr>
            <tr>
                <td>Movie Language</td>
                <td><input type="text" name="movielanguage" value="<?php echo $movie_language; ?>"></td>
            </tr>

            <tr >
                <td colspan=3><input type="submit" name="update" value="Update">
                <input type="button" value="Cancel" onclick="window.location.href='admin.php';">
                <!-- <input type="submit" name = "delete" value = "Delete"></td> -->
		    </tr>
        </table>

</form>
</body>
