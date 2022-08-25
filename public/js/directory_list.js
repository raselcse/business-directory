jQuery(document).ready(function( $ ) {

	

	$('input.btn.membership-registration').on('click', function (e) {	

		e.preventDefault();

		var company_name = $(".company_name").val();

		var org_no = $(".org_no").val();

		var company_oparation = $(".company_oparation").val();

		var visiting_address = $('.visiting_address').val();

		var mailing_address = $(".mailing_address").val();

		var post_code = $(".post_code").val();

		var ort = $(".ort").val();

		var phone_no = $(".phone_no").val();

		var web_address = $('.web_address').val();

		var company_email = $(".company_email").val();

		var ceo_name = $(".ceo_name").val();

		var ceo_email = $(".ceo_email").val();

		var company_contact_name = $('.company_contact_name').val();

		var account_email = $(".account_email").val();

		var annual_financial_statement = $(".annual_financial_statement").val();

		var employee_total = $(".employee_total").val();

		var other_employee_total = $('.other_employee_total').val();

		var company_file = $("#image_url").val();

		// if(person_email!==NULL){

        // alert(company_file);

			jQuery.ajax({

				url: ajax_path.ajax_url,

				type:'post',

				data: {

					'action':'directorylist_save_action',

					'company_name': company_name,

					'org_no': org_no,

					'company_oparation': company_oparation,

					'person_first_name': company_name,

					'visiting_address': visiting_address,

					'mailing_address': mailing_address,

					'post_code': post_code,

					'ort': ort,

					'phone_no': phone_no,

					'web_address': web_address,

					'company_email': company_email,

					'ceo_name': ceo_name,

					'ceo_email': ceo_email,

					'company_contact_name': company_contact_name,

					'account_email': account_email,

					'annual_financial_statement': annual_financial_statement,

					'employee_total': employee_total,

					'other_employee_total': other_employee_total,

					'company_file': company_file,

				},

				success:function(result) {

				        if(result=='email has exist'){

						  	$("#membership_modal").css('display','none');

							 $("#membershipErrorModal").css('display','block');

							 $("#membershipErrorModal .form-section h3").text(' Din epost har existerat, så din katalog har inte skickat in. Vänligen skicka igen information.');

						}

						if(result=='added'){

							$("#membership_modal").css('display','none');

						    $("#membershipSuccessModal").css('display','block');

						 }

						 if(result=='email has empty'){

							$("#membership_modal").css('display','none');

							$("#membershipErrorModal").css('display','block');

							$("#membershipErrorModal .form-section h3").text('Din epost är tom. Du måste lägga till företagsadress, så din katalog har inte skickat in. Vänligen skicka igen information.');

						 }

						 

	

				},

				error: function(errorThrown){

						$("#membership_modal").css('display','none');

						$("#membershipErrorModal").css('display','block');

					

				}

			}); 

	

	});



	$('input.btn.approve-membership-btn').on('click', function (e) {	

			e.preventDefault();

			var directory_category = $(".directory_category").val();

			var directory_id = $(".directory_id").val();

			var status = $(".status").val();

			

			 if(status==0){

				 status=1;

			 }

			 else{

				 status=0;

			 }

				jQuery.ajax({

					url: ajax_path.ajax_url,

					type:'post',

					data: {

						'action':'directory_approve_disaprove_action',

						'directory_category': directory_category,

						'status': status,

						'id': directory_id

						

					},

					success:function(data) {

					    $("#approve_membership_modal").css('display','none');

						alert("Your action has done");
						window.location.reload();

						

					},

					error: function(errorThrown){

						// console.log(errorThrown);

						

					}

				}); 



		

	});





	$('#datatable-event').DataTable();

	



	$('#front-end-datatable').DataTable({

		"searching": false,

		"iDisplayLength": 10,

		"bLengthChange": false,

		"language": {

            "lengthMenu": "Display _MENU_ records per page",

            "zeroRecords": "No Data Found",

            "info": "Visar _START_  - _END_ av totalt _TOTAL_ medlemmar",

            "infoEmpty": "No records available",

            "infoFiltered": "(filtered from _MAX_ total records)"

        }

	});





	$('#directory_category .cat_list').click(function(){



		// declaring an array

		var choices = {};

		$('.contents').remove();

		$('.filter-output').empty()



		$('input[type=checkbox]:checked').each(function() {

			if (!choices.hasOwnProperty(this.name)) 

				choices[this.name] = [this.value];

			else 

				choices[this.name].push(this.value);

		});



		

		$('#front-end-datatable').DataTable().destroy();

		var datatable = jQuery('#front-end-datatable').DataTable({

			"processing":true,

			"serverSide":true,

			"searching": false,

			"iDisplayLength": 10,

			"bLengthChange": false,

			"paging": true,

			"language": {

				"lengthMenu": "Display _MENU_ records per page",

				"zeroRecords": "No Data Found",

				"info": "Visar _START_  - _END_ av totalt _TOTAL_ medlemmar",

				"infoEmpty": "No records available",

				"infoFiltered": "(filtered from _MAX_ total records)"

			},

			"ajax":{

				url:ajax_path.ajax_url,

				type:"post",

				data : {

					'action' : 'directory_filter_action',

					'choices' : choices,

						

				}

			}

			

		});

		



	});



	jQuery("#upload").on('change', function(e) {

		e.preventDefault();



		var fd = new FormData();

		var file = jQuery(document).find('input[type="file"]');

		var caption = jQuery(this).find('input[name=company_file]');

		var individual_file = file[0].files[0];

		fd.append("file", individual_file);

		var individual_capt = caption.val();

		fd.append("caption", individual_capt);  

		fd.append('action', 'fiu_upload_file');  



		jQuery.ajax({

			type: 'POST',

			url: ajax_path.ajax_url,

			data: fd,

			contentType: false,

			processData: false,

			success: function(response){



				var image_url = response;

				var $ip = $('<input>').attr({

					type: 'hidden',

					id: 'image_url',

					name: 'image_url',

					value: image_url 

				});

				$("input[type='hidden']").remove();



				$($ip).appendTo('#membership_form');
				$('.added_message').text('Din fil har lagts till');
				$('.added_message').show();

				//$(this).parent().find('.membership-registration').prop('disabled', false);

				// $(".membership-registration").attr("disabled", false);

			},

		error:function(){
			$('.added_message').text('Din fil har inte lagts till');
			
			$('.added_message').show();
			$('.added_message').css('color','red');
		}

		});

	});

	$('.js-example-basic-multiple').select2();



});