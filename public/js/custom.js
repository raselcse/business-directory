jQuery(document).ready(function($){





       	// Get the modal

		var approve_membership_modal = document.getElementById('approve_membership_modal');

		var messageErrorModal = document.getElementById('messageErrorModal');

		var membershipSuccessModal = document.getElementById('membershipSuccessModal');

		var membership_modal = document.getElementById('membership_modal');

		// Get the button that opens the modal



		$( ".approve_disapprove_btn" ).click(function(e) {

			e.preventDefault();

			var directory_id = $(this).data("id");

			var status=  $(this).data("status");

			approve_membership_modal.style.display = "block";

				var $input = $("<input>", {

					'type': 'hidden',

					'name': 'directory_id',

					'class': 'directory_id',

					'value': directory_id

				});

				var $status = $("<input>", {

					'type': 'hidden',

					'name': 'status',

					'class': 'status',

					'value': status

				});

				// var event_data ="<h3>Event: "+ event_title +"Title</h3> <h5>Date: "+ event_start_date +"</h5><h5>Location: "+ event_location +"</h5>";

				// var added_input = $( "#booking_form input[type='hidden']" ).length;



				

				// if(added_input == 0){

				// 	$( "#booking_form input[type='hidden']" ).remove();

				// 	$('#booking_form').append($input);

				// }
             
				$( "#approve_membership_modal input[type='hidden']" ).remove();

				$('#approve_membership_form').append($input);

				$('#approve_membership_form').append($status);
				if(status== 1)
                {
					$('.approve-membership-btn').val('Confirm for Disapproval');
					$('.directory_category').hide();
				}else
				{
					$('.directory_category').show();
					$('.approve-membership-btn').val('Confirm for Approval');
				}
				

			

         });





	

		var btn = document.getElementById("book-now");



		// Get the <span> element that closes the modal

		var span = document.getElementsByClassName("close")[0];

        

		$( ".medlemskap-button" ).click(function(e) {

			e.preventDefault();

			

			membership_modal.style.display = "block";

			var open_true = true;

	

		 });

		 

		 $( "#directory_category" ).hide();

		 $(".sort_show_hide_button button").click(function(){

			

			$( "#directory_category" ).toggle();

		

		 

	   });

	   

	

		$( ".close,.close-success-button" ).click(function(e) {

			e.preventDefault();

			$(this).parents('.modal').hide();

		});



	



		// When the user clicks anywhere outside of the modal, close it

		window.onclick = function(event) {

			if (event.target == membership_modal) {

				membership_modal.style.display = "none";

			}

			if (event.target == membershipSuccessModal) {

				membershipSuccessModal.style.display = "none";

			}

			if (event.target == messageErrorModal) {

				messageErrorModal.style.display = "none";

			}

			if (event.target == approve_membership_modal) {

				approve_membership_modal.style.display = "none";

			}



		}

		 

		$('.search-by-event').change(function(){

			var id = $(this).val();

			var changeUrl = $(this).parent().find('#event_title_filter').attr("href", "admin.php?page=event_booking&event_id="+id);

			console.log(changeUrl);

        });

		



	

		$('#datatable-event').DataTable();

		$('#datatable-directory').DataTable();





});



