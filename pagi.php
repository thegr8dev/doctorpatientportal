<?php
include('includes/conn.php');
$item_per_page = 5;

$results = mysqli_query($con,"SELECT COUNT(*) FROM feedback");
$get_total_rows = mysqli_fetch_array($results); //total records

//break total records into pages
$pages = ceil($get_total_rows[0]/$item_per_page);
?>
<script type="text/javascript">
$(document).ready(function() {
    $("#results").load("fetch_pages.php");  //initial page number to load
    $(".pagination").bootpag({
       total: <?php echo $pages; ?>, // total number of pages
       page: 1, //initial page
       maxVisible: 5 //maximum visible links
    }).on("page", function(e, num){
        e.preventDefault();
        $("#results").prepend('<div class="loading-indication"><img src="ajax-loader.gif" /> Loading...</div>');
        $("#results").load("fetch_pages.php", {'page':num});
    });
});
</script>