<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cocktail-machine</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<?php 
		@mysql_connect("localhost", "root", "debollevanplus")
		or die (mysql_error());

		mysql_select_db("drinks");
		$sql = "SELECT * FROM cocktailtable";
	?>

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Cocktail-machine</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					<li>
                        <a class="page-scroll" href="#order">Cocktail bestellen</a>
                    </li>
                    <li>
                        <a class="page-scroll" href=add_cocktail_page.php>Cocktail toevoegen</a>
                    </li>
					<li>
						<a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

	
    <header>
        <div class="header-content">
			
				<div class="header-content-inner">
					<div class="container-fluid">	
						<h1 id="homeHeading">Dynamixe</h1>
						<hr>
						<p class ="main">Since 1888<p>
						<a href="#order" class="btn btn-primary btn-xl page-scroll">Bestellen</a>
					</div>
				</div>
		</div>
    </header>

    <section id="order">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Cocktails</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
		
		<?php	
			$result = mysql_query($sql);
		?>
		
        <div class="container">
            <div class="row row-eq-height">
				<?php
					while($row = mysql_fetch_array($result))
					{
				?>	
					
				
					<div class="col-xs-12 col-sm-6 col-md-3 text-center col-container">
							<img class = "img-responsize"src="/img/<?php echo $row['Photo'] ;?>" width="auto" height="200">
							<h3><?php echo $row['Namecocktail']; ?></h3>
							<p class="text-muted"><?php echo $row['ShortDescription'];?></p>
							<form name="form" method="post" action="order_cocktail_post.php" class = "form-horizontal">
							
								<input type="hidden" name="ingredient2" value="<?php echo $row['Ingredient2'];?>">
								<input type="hidden" name="ingredient3" value="<?php echo $row['Ingredient3'];?>">
								<input type="hidden" name="ingredient4" value="<?php echo $row['Ingredient4'];?>">
								<input type="hidden" name="ingredient5" value="<?php echo $row['Ingredient5'];?>">
								<input type="hidden" name="ingredient6" value="<?php echo $row['Ingredient6'];?>">
								<input type="hidden" name="ingredient7" value="<?php echo $row['Ingredient7'];?>">
								<input type="hidden" name="ingredient8" value="<?php echo $row['Ingredient8'];?>">
								<input type="hidden" name="ingredient9" value="<?php echo $row['Ingredient9'];?>">
								<input type="hidden" name="ingredient10" value="<?php echo $row['Ingredient10'];?>">
								
								<input type="hidden" name="amount1" value="<?php echo $row['Amount1'];?>">
								<input type="hidden" name="amount2" value="<?php echo $row['Amount2'];?>">
								<input type="hidden" name="amount3" value="<?php echo $row['Amount3'];?>">
								<input type="hidden" name="amount4" value="<?php echo $row['Amount4'];?>">
								<input type="hidden" name="amount5" value="<?php echo $row['Amount5'];?>">
								<input type="hidden" name="amount6" value="<?php echo $row['Amount6'];?>">
								<input type="hidden" name="amount7" value="<?php echo $row['Amount7'];?>">
								<input type="hidden" name="amount8" value="<?php echo $row['Amount8'];?>">
								<input type="hidden" name="amount9" value="<?php echo $row['Amount9'];?>">
								<input type="hidden" name="amount10" value="<?php echo $row['Amount10'];?>"></p>
							
							<div>
								&nbsp;
							</div>
							<div>
								<input type="submit" name="order_cocktail" class = "btn btn-primary" ></input>
								<button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">More information</button>
							</div>
						
						<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<?php echo $row['LongDescription'];?>
								</div>
							</div>
						</div>
					</div>
					<?php
					}	
					echo "</div>";
					?>
			</div>
			</form>
        </div>
	</div>
    </section>

	
<footer>
    <div class="footer-bottom">
        <div class="container">
			<a class="page-scroll" href="#order"> Cocktail bestellen </a>
			&nbsp;
			<a class="page-scroll" href="add_cocktail_page.php">Cocktail toevoegen</a> 
		</div>
    
	
	</footer> <!--/.footerbuttom-->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>
	


</body>

</html>