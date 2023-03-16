<!-- <div class="container">
  <h2>Dashboard</h2>
  	<div class="row">
  		<div class="col-md-9">
		  <ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">Property List</a></li>
		    <li><a data-toggle="tab" href="#menu1">Manage Properties</a></li>
		    <li><a data-toggle="tab" href="#menu2">Property Summery</a></li>
		    <li><a data-toggle="tab" href="#menu3">Settings</a></li>
		  </ul>

		  <div class="my-5 number"> <span> Show </span> <input type="number"> entries </div> 
		  <div class="input-group">
			  <div class="form-outline">
			  	<label class="form-label">Search:</label>
			    <input type="search"  />
			  </div>
		  </div>
 
		  <div class="tab-content">
		    <div id="home" class="tab-pane fade in active">
		      <h3>Property List</h3>
			    <table id="tab1" class="table table-light table-striped table-xl">
					<thead>
						<tr>
					      <td scope="col">#</th>
					      <td scope="col">First</th>
					      <td scope="col">Last</th>
					      <td scope="col">Handle</th>
						</tr>
					 </thead> 
					 <tbody>
						<tr>
					      <th scope="row">1</th>
					      <td>Mark</td>
					      <td>Otto</td>
					      <td>@mdo</td>
						</tr>
						<tr>
					      <th scope="row">2</th>
					      <td>Jacob</td>
					      <td>Thornton</td>
					      <td>@fat</td>
						</tr>
						<tr>
					      <th scope="row">3</th>
					      <td>Larry</td>
					      <td>the Bird</td>
					      <td>@twitter</td>
						</tr>
					</tbody> 
				</table>
		    </div>
		    <div id="menu1" class="tab-pane fade">
		      <h3>Manage Properties</h3>
		      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		    </div>
		    <div id="menu2" class="tab-pane fade">
		      <h3>Property Summery</h3>
		      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
		    </div>
		    <div id="menu3" class="tab-pane fade">
		      <h3>Settings</h3>
		      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
		    </div> 
		  </div>
		 </div>
		<div class="profile col-md-3">
			<form action="upload.php" method="post" enctype="multipart/form-data">
  			<div class="holder">
            <img id="imgPreview" src="#" alt="Avatar"/>
            <input type="file" name="photograph" id="photo" class="btn btn-primary"  /> 
            <h4 class="profile-name">Jon Credendino</h4>
        </div>
			</form>
			<div class="property">
				<div class="profile-detail"></div>
						<div class="total-property">
							<strong>Total Properties</strong>
						</div>
						<div class="balance-property">
							<strong>Balance</strong>
						</div>
						<div class="hearings-property">
							<strong>Hearings</strong>
						</div>
						<button type="button" class="btn btn-secondary text-light">Edit Profile</button>
				</div> 
		</div>
  </div>
</div>  -->  
	
<?php

// function admin_api()
// {
//     add_menu_page(
//         __('Conspiredminds - Conspiredminds', 'my-textdomain'),
//         __('Conspiredminds', 'my-textdomain'),
//         'manage_options',
//         'sample-page',
//         'admin_api_data',
//         3
//     );
// }
// add_action('admin_menu', 'admin_api');

function admin_api_data(){

	defined( 'ABSPATH' ) or die( 'Unauthorized Access' );

	$url = 'https://data.cityofnewyork.us/resource/3h2n-5cm9.json?bin=1079062';
	  
	  $arguments = array(
	    'method' => 'GET'
	  );

	$response = wp_remote_get( $url, $arguments );

	  if ( is_wp_error( $response ) ) {
	      $error_message = $response->get_error_message();
	      return "Something went wrong: $error_message";
	  } 
	  else {
	      echo '<pre>';
	      var_dump( wp_remote_retrieve_body( $response ) );	
	      echo '</pre>';
	  } 
}
  

?>

