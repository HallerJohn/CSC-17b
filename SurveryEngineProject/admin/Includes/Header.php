<!DOCTYPE html>
<head>
	<title><?php echo $page_title; ?></title>	
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
	<div id="header">
		<h1>Surveys R Us!</h1>
		<h2>We want your thoughts</h2>
	</div>
	<div id="navigation">
		<ul>
                    <li><a href="../index.php">Store Page</a></li>
                    <li><a href="view_users.php">View Users</a></li>
                    <li><a href="add_question.php">Add Question</a></li>
                    <li><a href="view_answers.php">View Answers</a></li>
                    <li><?php // Create a login/logout link:
                            if (isset($_SESSION['account_id'])) {
                                    echo '<a href="logout.php">Logout</a>';
                            } else {
                                    echo '<a href="login.php">Login</a>';
                            }
                        ?></li>
		</ul>
	</div>
	<div id="content"><!-- Start of the page-specific content. -->
<!-- Script 12.10 - header.html -->