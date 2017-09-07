<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link type="text/css" rel="stylesheet"
	href="<?php echo base_url(); ?>assets/css/paintinggallery.css" />
<script type="text/javascript"
	src="<?php echo base_url(); ?>assets/js/paintingscript.js"></script>

</head>
<body>

	<section>
		<div class="container">


			<div class="row">

				<div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<br /> <br />
<!-- 
					<button class="btn btn-default filter-button active"
						data-filter="all">All</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						1</button>
					<button class="btn btn-default filter-button" data-filter="Cave2">
						2</button>
					<button class="btn btn-default filter-button" data-filter="Cave3">
						3</button>
					<button class="btn btn-default filter-button" data-filter="Cave4">
						4</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						5</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						6</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						7</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						8</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						9</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						10</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						11</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						12</button>
					<button class="btn btn-default filter-button" data-filter="Cave4">
						13</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						14</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						15</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						16</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						17</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						18</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						19</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						21</button>
					<button class="btn btn-default filter-button" data-filter="Cave1">
						22</button>
						<button class="btn btn-default filter-button" data-filter="Cave1">
						23</button>
						<button class="btn btn-default filter-button" data-filter="Cave1">
						24</button>
						<button class="btn btn-default filter-button" data-filter="Cave1">
						25</button>
						<button class="btn btn-default filter-button" data-filter="Cave1">
						26</button>
						<button class="btn btn-default filter-button" data-filter="Cave1">
						27</button>
						<button class="btn btn-default filter-button" data-filter="Cave1">
						28</button>
						<button class="btn btn-default filter-button" data-filter="Cave1">
						29</button>
						 -->
						 <blockquote class="blockquote-reverse">
				<p><a href="<?php echo site_url('home/index/painting');?>">Upload new Paintings</a></p>
				</blockquote>
			<?php
			// print_r($all_painting);
			echo "<br/><br/><br/><br/>";
			
			foreach ( $all_painting as $r ) {
				// print_r($r);
				foreach ( $r as $y ) {
					// if($r->cave_number==1){
					// $("img").addClass("Cave1");
					// }
					echo '<img src="' . $y->file_dir . '" alt="Error in loading Image" class="img-rounded col-lg-4 col-md-4 col-sm-4 col-xs-6 img-responsive filter Cave1">';
				}
			}
			?>
		</div>




				<!-- 
		<div
			class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Cave1">
			<img src="http://fakeimg.pl/365x365/" class="img-responsive">
		</div> 

		<div
			class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Cave2">
			<img src="http://fakeimg.pl/365x365/" class="img-responsive">
		</div>-->


			</div>
		</div>
		</div>
	</section>