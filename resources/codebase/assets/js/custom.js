var page="";
var url="";
var from_datevar="";
var to_datevar="";
var table;
function selectall(ele){
	var select_all = document.getElementById("select_all"); 
	if($(ele).is(':checked')){
		console.log('TRUE');
	}
	
	var checked = $(ele).prop('checked');
	 $(".checkbox").prop('checked',checked); 
	/* $('.checkbox').each(function(){  
		this.checked = status;
			
	}); */
}
function sendallcard(){
	 if($(".checkbox:checked").length > 0) {
		var selectedids= new Array(); 
		$('.checkbox:checked').each(function() {
		   console.log(this.value);
		   selectedids.push(this.value);
		}); 
		$.ajax({
            type:'POST',
            url:base_url+'admin/dashboard/sendvcards/',
            data:{id:selectedids},
            type:"post",
			dataType:"json",
            success:function(data){
				console.log(data);
				 
                Swal.fire({
					title: 'Done!',
					text: data.message,
					type: 'success'
				});
            }
        }); 
	 }else{
		 Swal.fire("Error!",'Please select the contact to send the vcard.', "error");   
	 }
	return false;
}
function sendallmail(){
	 if($(".checkbox:checked").length > 0) {
		var selectedids= new Array(); 
		$('.checkbox:checked').each(function() {
		   console.log(this.value);
		   selectedids.push(this.value);
		}); 
		$.ajax({
            type:'POST',
            url:base_url+'admin/dashboard/sendemails/',
            data:{id:selectedids},
            type:"post",
			dataType:"json",
            success:function(data){
				console.log(data);
				 
                Swal.fire({
					title: 'Done!',
					text: data.message,
					type: 'success'
				});
            }
        }); 
	 }else{
		 Swal.fire("Error!",'Please select the contact to send the vcard.', "error");   
	 }
	return false;
}
$(document).ready(function(){
	
	 
	
	$('body').on('click','.addNewRow',function(event){
		event.preventDefault();
		var element = $(this);
		var tbody = element.closest('tbody');
		var index = tbody.find('tr').length;
		var html = '';
		html+='<tr>';
			html+='<td>';
				html+='<select style="margin: 0px !important;" class="form-control" id="member_select" name="dependent['+index+'][dependent]" required>';
					html+='<option value="">--Please Select--</option>';
					/* html+='<option value="Member">Member</option>'; */
					html+='<option value="Spouse">Spouse</option>';
					html+='<option value="Dependent">Dependent</option>';
				html+='</select>';
			html+='</td>';
			html+='<td>';
				html+='<input type="text" class="form-control" value="" name="dependent['+index+'][dependant_name]">';
			html+='</td>';
			html+='<td>';
				html+='<input type="text" class="form-control" value="" name="dependent['+index+'][dep_f_name]">';
			html+='</td>';
			html+='<td>';
				html+='<input type="text" class="form-control" value="" name="dependent['+index+'][phone]">';
			html+='</td>';
			html+='<td>';
				html+='<input type="date" class="form-control" value="" name="dependent['+index+'][dob]">';
			html+='</td>';
			html+='<td>';
				html+='<a href="javascript:void(0)" class="btn btn-danger btn-xs delete_row"><i class="fa fa-trash"></i></a>';
			html+='</td>';
		html+='</tr>';
		tbody.append(html);

	});
	$('body').on('click','.delete_row',function(event){
		var element = $(this);
		element.closest('tr').remove();
	});


	$('body').on("click",".send_contacts_email_vcard",function (event){
        event.preventDefault();
        var href = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "vCard will be send on provided number",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.value) {
                $.ajax({
	                url: href,
	                method: 'GET',
	                success: function(result) {
	                    result = jQuery.parseJSON(result);
	                    if(result.status == 1) {
	                        Swal.fire({
	                            title: 'Done!',
	                            text: result.message,
	                            type: 'success'
	                        }, function() {
	                            window.location.reload();
	                        });    
	                    } else {
	                        Swal.fire("Error!", result.message, "error");    
	                    }
	                }
	            });
            }
        })

        // swal({
        //     title: "Are you sure?",
        //     text: "vCard will be send on provided number",
        //     type: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: "#DD6B55",
        //     confirmButtonText: "Yes",
        // }, function (isConfirm) {
        // 	alert('here');
        //     $.ajax({
        //         url: href,
        //         method: 'GET',
        //         success: function(result) {
        //             result = jQuery.parseJSON(result);
        //             if(result.status == 1) {
        //                 swal({
        //                     title: 'Done!',
        //                     text: result.message,
        //                     type: 'success'
        //                 }, function() {
        //                     window.location.reload();
        //                 });    
        //             } else {
        //                 swal("Error!", result.message, "error");    
        //             }
        //         }
        //     });
        // });
    });
	$.fn.dataTableExt.sErrMode = 'throw';
	page=window.location.href.split("#")[1];
	view.load(page);
	$(document).on("click",".loadview",function(e){
		page=$(this).attr("href").split("#")[1];
		if($(this).hasClass("modalview")){
			e.preventDefault();
			title=$(this).attr("data-title");
			view.load(page,"popup",title);
			
		}
		else{
			view.load(page);
		}
	})
	$(document).on("change","[name='company_id']",function(e){
		 var companyID = $(this).val();
        $.ajax({
            type:'POST',
            url:base_url+'admin/dashboard/getlocations/',
            data:{id:companyID},
            type:"post",
			dataType:"json",
            success:function(data){
                $('.location_select').html(data);
            }
        }); 
	})
 
	$(document).on("click",".contact_edit_page",function(e){
		 var companyID = $(this).attr('data-company');
        $.ajax({
            type:'POST',
            url:base_url+'admin/dashboard/getlocations_edit/',
            data:{id:companyID},
            type:"post",
			dataType:"json",
            success:function(data){
                $('.location_select').html(data);
            }
        }); 
	})
	
	$(document).on("click",".dependant_edit_page",function(e){
		/*  page=$(this).attr("href").split("#")[1]; 
			e.preventDefault();
			title=$(this).attr("data-title");
			view.load(page,"popup",title); */
			
		 
	});
	$(document).on("change","[name='country_id']",function(e){
		 var countryID = $(this).val();
        $.ajax({
            type:'POST',
            url:base_url+'admin/dashboard/getcountry/',
            data:{id:countryID},
            type:"post",
			dataType:"json",
            success:function(data){
                $('.select_state').html(data);
            }
        }); 
	})
	$(document).on("click",".contact_edit_page",function(e){
		 var countryID = $(this).attr('data-company');
        $.ajax({
            type:'POST',
            url:base_url+'admin/dashboard/getcountry_edit/',
            data:{id:countryID},
            type:"post",
			dataType:"json",
            success:function(data){
                $('.select_state').html(data);
            }
        }); 
	})

	$(document).on("click",".imgSmall",function(){
	$("#imgBig").attr("src",$(this).attr('src'));
    $("#overlay").show();
    $("#overlayContent").show();
});


	$(document).on("click","#overlayContent,#sidebar,#imgBig",function(){
    $("#imgBig").attr("src", "");
    $("#overlay").hide();
    $("#overlayContent").hide();
});
	//$(document).on("click",".editor",function(){
	// CKEDITOR.replace( 'description' ); 
	// })
	$(document).on("click",".profile-img",function(e){
		e.preventDefault();
		$("#exampleInputFile").trigger("click");
	})
	$(document).on("keyup change","textarea,input,select",function(e){
		if($(this).val()!==""){
			$(this).parent().addClass("open"); 
		}
		else{
			$(this).parent().removeClass("open");
			
		}
	})
	$(document).on("submit",".viewform",function(e){
		e.preventDefault();
		if($(this).find(".has-error").length>0){
		}
		else{
			data3=new FormData(this);
			data3.append("submit","submit");
			view.formSubmit(page,data3)
		}
	});
	$(document).on("change","[name='company_id']",function(e){
		table.ajax.reload();
	})
	$(document).on("change","[name='group_id']",function(e){
		table.ajax.reload();
	})
	
	$(document).on("click","[name='filter']",function(e){
		from_datevar=$(".from_date").val();
		to_datevar=$(".to_date").val();
		//console.log(from_datevar);
		
		if($(".from_date").val()==""||$(".to_date").val()==""){
			swal("Failure","from and to date is required","error");
		}
		else{
			table.ajax.reload();
		}
		
	})
	$(document).on("click","[name='filter']", function(e){
	var from_date=$("#fdate").val();
	var to_date=$("#tdate").val();
	if(from_date !='' && to_date !=""){
		$.ajax({
			url:base_url+'admin/dashboard/findsum/',
			data:{from_date:from_date,to_date:to_date},
			type:"post",
			dataType:"json",
			success:function(response){
			$(".totalexp b").html("");
			$(".totalexp b").append(response[0]).html();
			
	       		//console.log(response);
	       		}
	       		
	       })
	       }
	       else{
	       	swal("","Please select date first","warning"); 
	       }
	        
	       	
	       })
	
	
	$(document).on("click",".delete",function(e){
		target=$(this).attr('href');
		thiss=$(this);
		e.preventDefault();
		swal({
		  title: "Are you sure?",
		  text: "You will not be able to recover Record Again!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  closeOnConfirm: false
		}).then(result => {
			// console.log(result);
			if(result.value==true){
				$.ajax({
					url:target,
					dataType:'json',
					success:function(data){
						if(data.success){
							swal("Deleted!", data.success, "success");
							  thiss.parent().parent().remove();
						}
						else{
							swal("Not Deleted!", data.error, "error");
						}
					  
					}
				
				});
			}
		});
	});
	
	$(document).on("click",".change", function(e){
	e.preventDefault();
		var id=($(this).attr("data-id"));
		//console.log(id);
		var thiss=$(this);
		//console.log(thiss);
		swal({
		  title: "Are you sure?",
		  text: "You want to change the status",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, change it!",
		  closeOnConfirm: false
		}).then(result => {
			// console.log(result);
			if(result.value==true){
				$.ajax({
				url:base_url+'admin/dashboard/changestatus/',
				data:{
					id:id
				},
				type:"post",
				dataType:"JSON",
				success:function(response){
					if(response.msg === "<div class='alert alert-success'>status Updated Successfully</div>"){
						swal ("Status!","Status has been changed successfuly","success");
						thiss.parent().parent().children().eq(5).html("<span class='label label-success'>Complete</span>");
					 
					 }else if(response.msg==="<div class='alert alert-danger'>status has already been changed</div>"){
						swal("not change!", "status has already been changed", "error");
					 }
					//console.log(response);
					
				}
			})
		}
	});
});	

	$(document).on("click",".chat_list",function(){
		$(".chat_list").removeClass('active_chat');
		$(this).addClass('active_chat');
		
		
	});
	
	$(document).on("click",".msg_send_btn",function(){
		var message=$('.message').val();
		//var sender_id='1';
		var receiver_id=$('.chat_list.active_chat').attr("data-id");
		if(message!==""){
			$.ajax({
				url:base_url+'admin/dashboard/chat/sendmessage/',
			
				data:{message:message,receiver_id:receiver_id,action:'sendmessage'},
				dataType:"json",
				type:"POST",
				success:function(res){
					//console.log(res);
					$(".message").val("");
					
					if(res.msg=="success"){
					$('.outgoing_msge').append('<div class="sent_msg"><p>'+ message +'</p><span class="time_date"> '+res.sent_time+'</span></div>');
					//$('.sent_msgs').append('<p>'+ message +'</p><span class="time_date"> '+res.sent_time+'</span>');	
						
					}
					
				}
			});
		}
	});
	
		 


});

var view={};
view.refreshJs=function(datatable,page){
	$(".viewform").validator();
	if($(".datepicker").length>0){
		$(".datepicker").datepicker({
			format:"yyyy-mm-dd",
			autoclose:true
		});
	}
	$("input,textarea,select").trigger("keyup");
	if(datatable){
		url=base_url+"admin/dashboard/"+page+"/ajax/";
		table = $('.datatable').DataTable({ 
			"lengthMenu": [[100, 250, 500,1000,-1], [100, 250, 500,1000,"All"]],
			 dom: 'Blfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5'
			],
			"scrollY":        "300px",
			"scrollCollapse": true,
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			"ajax": {
				"url":url ,
				"type": "POST",
				// "data":{
					// "from_date":$(".from_date").val(),
					// "to_date":$(".to_date").val(),
				// }
				"data":function (d) {
					d.from_date = $('.from_date').val();
					d.to_date = $('.to_date').val();
					d.company_id = $('[name="company_id"]').val();
					d.group_id = $('[name="group_id"]').val();
				},
				"initComplete": function(settings, json) {
					 
				}
			},
			"destroy" : true
			
			
			
		// fixedColumns: true,
			
		});
		
	}
	if(datatable&&$(".dt-button").length>0){
		$(".dt-button").addClass("btn btn-secondary btn-sm");
		$(".dt-button").each(function(){
			if($(this).hasClass("buttons-copy"))
				$(this).prepend("<i class='fa fa-copy'></i>&nbsp;");
			else if($(this).hasClass("buttons-excel"))
				$(this).prepend("<i class='fa fa-file-excel-o'></i>&nbsp;");
			else if($(this).hasClass("buttons-csv"))
				$(this).prepend("<i class='fa fa-file-text-o'></i>&nbsp;");
			else if($(this).hasClass("buttons-pdf"))
				$(this).prepend("<i class='fa fa-file-pdf-o'></i>&nbsp;");
			
		});
	}
	
}
view.load=function(page,type,title){
	//console.log(type);
	if(page!==undefined&&page!==""){
	}
	else{
		page="home";
	}
	// $(".loader").show();
	view.showLoader();
	$.ajax({
		url:base_url+"admin/dashboard/"+page,
		success:function(data){
			view.hideLoader();
			if(type=="popup"){
				$(".popuptitle").html(title)
				$(".popupcontent").html(data)
				$('.modalcontent').modal('toggle');
				view.refreshJs(false,page);
			
			}
			else{
				$(".page-content").html(data)
				view.refreshJs(true,page);
			}
			
		}
		
	})
}
view.formSubmit=function(page,formData){
	// console.log(formData);
	view.showLoader();
	$.ajax({
		url:base_url+"admin/dashboard/"+page,
		data:formData,
		dataType:"json",
		contentType: false,
		processData: false,
		method: 'POST',
		type:"post",
		success:function(data){
			view.hideLoader();
			//console.log(data);
			if(data.return){
				$(".modalcontent").modal('hide');
				swal("Success",data.msg,"success");
				page=window.location.href.split("#")[1];
				//console.log(page);
				view.load(page);
				$(document).find('#member_select').val(data.dependent)
	
			}
			else{
				swal("Failure",data.msg,"error");
			
			}
		}
		
	})
}
view.hideLoader=function(){
	value=$('#loader').attr("data-key");
	if(value == "1"){
		 $(".loader").hide();
	}
	
}
view.showLoader=function(){
	value=$('#loader').attr("data-key");
	//alert(value);
	if(value == "1"){
		 $(".loader").show();
	}
	
}
//loader original function
//view.hideLoader=function(){
//	
//		 //$(".loader").hide();
//	}
//	
//view.showLoader=function(){
//	
//		// $(".loader").show();
//	}
	 
function from_date(){
	return $(".page-content").find(".from_date").val();
}
function to_date(){
	return $(".page-content").find(".to_date").val();
}
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
