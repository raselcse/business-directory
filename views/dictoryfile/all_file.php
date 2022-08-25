<?php include_once dirname(__FILE__).'../../../models/EventModel.php'; ?>
        <div id="opl-advertisement">
		
			<h2> All Event Booking list </h2>
			<!-- <a href="admin.php?page=add_booking" class="button button-primary"> Add New Book</a> -->
			 <?php 
				if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
			
			
			?>


			<div class="alignleft actions bulkactions">
				<label style="font-size:20px;">Filter By Book:</label>
				<?php
				global $wpdb;
				$tbl_event=$wpdb->prefix.'sem_event';
				$cats = $wpdb->get_results("select * from $tbl_event order by id asc", ARRAY_A);
				if( $cats ){
					?>
					<select name="cat-filter" class="search-by-event">
						<option value="">No Event Select</option>
						<?php
						foreach( $cats as $cat ){
							
						?>
						<option value="<?php echo $move_on_url . $cat['id']; ?>" <?php echo $selected; ?>><?php echo $cat['event_title']; ?></option>
						<?php   
						}
						?>
					</select>
					<a id="event_title_filter" href="admin.php?page=event_booking&event_id=7" class="button button-primary"> Search</a>
					<?php   
				}
				?>  
			</div>
			<table id="datatable-booking" class="display">
				<thead>
					<tr>
					  <th scope="col">Sl No.</th>
					  <th scope="col">Event Name</th>
					  <th scope="col"> First name</th>
					  <th scope="col">Last name</th>
					  <th scope="col">Email</th>
					  <th scope="col"></th>
					  <th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$html = null;
					$sl_no = 0;
					
					$event_obj = new EventModel();
					foreach( $types as $book ) {
						$sl_no =$sl_no+1; 
						$event_name = $event_obj->get_event_name($book->event_id);
						$html .= "<tr>
						  <td>$sl_no</td>
						  <td>$event_name</td>
						  <td>$book->person_first_name</td>
						  <td>$book->person_last_name</td>
						  <td>$book->person_email</td>
						  <td><a href='admin.php?page=getForUpdateType&id=$book->id'>Edit</a></td>
						  <td><a href='admin.php?page=deleteBooking&id=$book->id'>Delete</a></td>
						</tr>";
					}
					echo  $html;
					?>

				</tbody>
				<tfoot>
           			 <tr>
						<th scope="col">Sl No.</th>
					  <th scope="col">Event Name</th>
					  <th scope="col"> First name</th>
					  <th scope="col">Last name</th>
					  <th scope="col">Email</th>
					  <th scope="col"></th>
					  <th scope="col"></th>
            		</tr>
        		</tfoot>

			</table>

		</div>
        
        