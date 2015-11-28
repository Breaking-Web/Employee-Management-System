
<p>
<?php 
if (!isset($_POST['action2']) or isset($_POST['action2']) and $_POST['action2'] == 'Request_Control')
{

	include "leaving_request.html.php";
}
if (isset($_POST['action2']) and $_POST['action2'] == 'Work_Arrangement')
{
	include "work_arrangement.html.php";
}

if (isset($_POST['action2']) and $_POST['action2'] == 'Evaluation_of_this_month')
{
	// echo "still working on it";
	// include "evaluation_of_this_month.html.php";
	include "display_evaluation.php";
}

?>
</p>
