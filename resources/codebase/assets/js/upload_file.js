$(document).ready(function () {
        $('body').on('click', '#submit_file', function (e) {
         var validation=1;
           var fd = new FormData();
            fd.append('uploadFile',$('.change_file_name')[0].files[0]);
            fd.append('validation',validation);
            $.ajax({
               url         : base_url+'admin/dashboard/upload_file_ajax/',
                beforeSend: function(){
                $('#image1').show();
                },
                complete: function(){
                    $('#image1').hide();
                },
                cache       : false,
                contentType : false,
                processData : false,
                data        : fd,                         
                type        : 'post',
                success     : function(output){
                    $('#file_name').val(output)
                    $('#msg').html('');
                    $('.wizard_validation').show();
                    $('.change_file_name').prop('disabled', true);
                    $('#submit_file').prop('disabled', true);
              }
            })
        });
        $('body').on('change', '.change_file_name', function (e) {
        e.preventDefault();
            var validExtensions = ["xlsx", "xlsm", "csv"]
            var file = $(this).val().split('.').pop();
            if (validExtensions.indexOf(file) == -1) {
                var msg = ("Only formats are allowed : " + validExtensions.join(', '));
                $('.msg').html('');
                $('.msg').html(msg);
                $(this).val('');
                $('#submit_file').hide();
            } else {
                $('.msg').html('');
                $('#submit_file').show();
            }
        });
  $('body').on('click', '.validation', function(e) {
      e.preventDefault();
      var change_file_name=$('#file_name').val();
      $.ajax({
        url: base_url+'admin/dashboard/upload_validation/',
        beforeSend: function(){
          $('#image2').show();
          },
          complete: function(){
              $('#image2').hide();
          },
        type: 'POST',
        data: {bulk_booking:1,change_file_name:change_file_name},
        dataType: 'json',
        success: function(response) {
          if (response.error) {
          	$('.bulk_msg').html(response.alert_msg);
            $('.change_file_name').val('');
            $('.change_file_name').prop('disabled', false);
            $('#submit_file').prop('disabled', false);
            $.ajax({
                type:'POST',
                data:{delete:1,change_file_name:change_file_name},
                url: base_url+'admin/dashboard/delete_excel_file/',
                success:function(fetch){
                }
            });
            return;
          }
          else{
            var percentage=0;
            var timer = setInterval(function(){
                percentage = percentage + 20;
                progress_bar_process(percentage,timer);
            },1000);
          	// $('.validation_process').html(response);
            // $('#submit_step_data1').prop('disabled', false);
          }
        }
      });
    });
    function progress_bar_process(percentage, timer){
    	if(percentage < 101){
		$('#progressbar_validation').css('width',percentage + '%');
        $('.validation_process').html(percentage);
    	}
        if(percentage > 100){
            clearInterval(timer);
             $('.valiation_success').html('Success');
             $('.wizard_upload').show();
        }
    }
    $('body').on('click', '#upload_file_excel', function(e) {
      e.preventDefault();
       var change_file_name=$('#file_name').val();
      $.ajax({
        url: base_url+'admin/dashboard/upload_file_excel/',
         beforeSend: function(){
                $('#image3').show();
            },
            complete: function(){
                $('#image3').hide();
            },
        type: 'POST',
        data: {save_booking:1,change_file_name:change_file_name},
        dataType: 'json',
        success: function(response) {
          	var percentage=0;
            var timer = setInterval(function(){
                percentage = percentage + 10;
                progress_bar_process_submit(percentage,timer);
            },1000);
        }
      });
    });
      function progress_bar_process_submit(percentage, timer){
    	if(percentage < 101){
		$('#progressbar_submit').css('width',percentage + '%');
        $('.submit_process').html(percentage);
    	}
        if(percentage > 100){
            clearInterval(timer);
             $('.valiation_success').html('Success');
            $('#submit_step_data1').prop('disabled', false);
            var change_file_name=$('#file_name').val();
            $.ajax({
                type:'POST',
                data:{delete:1,change_file_name:change_file_name},
                url: base_url+'admin/dashboard/delete_excel_file/',
                success:function(fetch){
                          location.reload();
                }
            });
        }
    }
});
	document.addEventListener('DOMContentLoaded', function(){
		$('title').text($('title').text()+' Bulk Booking')
	}, false);

   // select file




	// input file 


	$("#FileInput").on('change',function (e) {
            var labelVal = $(".title").text();
            var oldfileName = $(this).val();
                fileName = e.target.value.split( '\\' ).pop();

                if (oldfileName == fileName) {return false;}
                var extension = fileName.split('.').pop();

            if ($.inArray(extension,['jpg','jpeg','png']) >= 0) {
                $(".filelabel i").removeClass().addClass('fa fa-file-image-o');
                $(".filelabel i, .filelabel .title").css({'color':'#208440'});
                $(".filelabel").css({'border':' 2px solid #208440'});
            }
            else if(extension == 'pdf'){
                $(".filelabel i").removeClass().addClass('fa fa-file-pdf-o');
                $(".filelabel i, .filelabel .title").css({'color':'red'});
                $(".filelabel").css({'border':' 2px solid red'});

            }
  else if(extension == 'doc' || extension == 'docx'){
            $(".filelabel i").removeClass().addClass('fa fa-file-word-o');
            $(".filelabel i, .filelabel .title").css({'color':'#2388df'});
            $(".filelabel").css({'border':' 2px solid #2388df'});
        }
            else{
                $(".filelabel i").removeClass().addClass('fa fa-file-o');
                $(".filelabel i, .filelabel .title").css({'color':'black'});
                $(".filelabel").css({'border':' 2px solid black'});
            }

            if(fileName ){
                if (fileName.length > 10){
                    $(".filelabel .title").text(fileName.slice(0,4)+'...'+extension);
                }
                else{
                    $(".filelabel .title").text(fileName);
                }
            }
            else{
                $(".filelabel .title").text(labelVal);
            }
        });

	 
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

      var $target = $(e.target);

      if ($target.parent().hasClass('disabled')) {
        return false;
      }
    });

    $(".next-step").click(function (e) {

      var $active = $('.wizard .nav-tabs li.active');
      $active.next().removeClass('disabled');
      nextTab($active);

    });
    $(".prev-step").click(function (e) {

      var $active = $('.wizard .nav-tabs li.active');
      prevTab($active);

    });
    function nextTab(elem) {
  $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
  $(elem).prev().find('a[data-toggle="tab"]').click();
}



$(".change_file_name").change(function(e){
  alert('file_name');
         //submit the form here
         $(".main_box_hide").css({"display": "block"});
        var fileName = e.target.files[0].name;
        $(document).find('#file_name').val('');
        $(document).find('#file_name').val(fileName);
        // $('.bulk_msg').html('');
        // $('#msg').html('');
        // $('.upload_msg').html('');
        // $('.rename_msg').html('');
        // $('.msg').html('');

 

 });

 