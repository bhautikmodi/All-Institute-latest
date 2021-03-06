<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ALL-Institute | Add Instructor</title>

<head>

	<style type="text/css">
.wrapper {
 //padding-top: 20px;
	padding-top: 50px;
}
input.parsley-error, select.parsley-error, textarea.parsley-error {
	border-color: #843534;
	box-shadow: none;
}
input.parsley-error:focus, select.parsley-error:focus, textarea.parsley-error:focus {
	border-color: #843534;
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 6px #ce8483
}
.parsley-errors-list {
	list-style-type: none;
	opacity: 0;
	transition: all .3s ease-in;
	color: #d16e6c;
	margin-top: 2px;
	margin-bottom: 0;
	padding-left: 220px;
}
.parsley-errors-list.filled {
	opacity: 1;
	color: #C5161D;
}
</style>

<style>
#imagePreview,#imagePreview_select {
    width: 150px;
    height: 150px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
#imagePreview img,#imagePreview_select img
{	width:150px; height:150px;}
.modal img{ border:2px solid #fff;}
.modal img.selected_img{ border:2px solid #c4161c;}


#imagePreview2,#imagePreview_select2 {
    width: 150px;
    height: 150px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
#imagePreview img2,#imagePreview_select2 img
{	width:150px; height:150px;}
</style>

<script src="admin/js_new/main.js" type="text/javascript"></script> 
<script src="admin/js/jquery-1.12.4-jquery.min.js"></script> 
<script src="admin/js/bootstrap.min.js"></script> 
<script src="admin/parsleyjs/dist/parsley.min.js"></script> 
<script>
$(document).ready(function(){
	$('form').parsley();
});
</script>


</head>
<?php
include 'side_bar.php';
include 'header.php';
include 'connect.php';
session_start();
$MODE=MODE;
include 'functions.php';
 error_reporting(0);
if(isset($_POST['save'])) 
{
	
	$InsName=$_POST['InsName'];
    $About=$_POST['About'];
   	
	$InsImg=$_FILES['InsImg']['name'];
	
	$InsImg_2=$_POST['InsImg_2'];
	$p2=$_FILES['InsImg']['tmp_name'];
	//$Image=$_FILES['InsImg']['type']  = 'jpg|png';
	//$path="admin/upload/$Image";
	move_uploaded_file($p2,"upload/instructor/".$_FILES['InsImg']['name']);
	
	$IsActive=$_POST['IsActive'];
	
	
	

	 
 if($InsImg!="")
	{
	 	 $query = "INSERT INTO tblmstinstructor(
		`InsName`,`InsImg`,`About`,`IsActive`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`)
                VALUES('$InsName','$InsImg','$About','$IsActive','0',now(),'0',now())"; 
			//var_dump($query);exit;
	} 
	else if($InsImg_2!="")
	{
	 	 $query = "INSERT INTO tblmstinstructor(
		`InsName`,`InsImg`,`About`,`IsActive`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`)
                VALUES('$InsName','$InsImg_2','$About','$IsActive','0',now(),'0',now())"; 
			//var_dump($query);exit;
	} 
	else 
	{

		 $query = "INSERT INTO tblmstinstructor(
		`InsName`,`InsImg`,`About`,`IsActive`,`CreatedBy`,`CreatedOn`,`UpdatedBy`,`UpdatedOn`)
                VALUES('$InsName','instructor-default.jpg','$About','$IsActive','0',now(),'0',now())"; 
			//var_dump($query);exit;
}
	//exit;
	
	$res = mysql_query($query);
	
	  if($res)
	  {
		session_start();
        
        $_SESSION['check']=2;
    
    echo "<script>window.location.replace('view_Instructor.php');</script>";

	// <!-- <script>
	// 	setTimeout(function() {
	// 	$('#insert_rec').fadeOut('hide');
	// 	}, 10000);
					
	// </script>					 -->
	
	  }
	  else
	  {
		 ?>
						<center><div class="alert alert-danger" id="insert_not" style="width:100%; margin:0px 0px 10px 0px">
									<strong>Your record was not inserted!</strong>
								</div>	  
						</center>
	<script>
		setTimeout(function() {
		$('#insert_not').fadeOut('hide');
		}, 10000);
					
	</script>					
	<?php
	  }




}
?>

<div class="page-content-wrap">
<div class="<?php echo $MODE; ?>"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
         <div class="panel-heading">      
                     <h3 class="panel-title"><b>Add Instructor</b> </h3>  
                     
                     </div>
            </div>
            <div class="box">
           
                
                <form name="form_instructor" id='form_instructor' method="post" class="my_frm"  enctype="multipart/form-data" >
                          
                    <table class="table">

                      <tr>
                            <th width="30%">*Instructor Name:</th>

                            <td><input type="text" name="InsName" id="InsName" class="form-control" placeholder="Type Instructor Name" maxlength="150"/></td>
                        </tr>
                        
                        <tr>
                            <th>Instructor About:</th>

                            <td>
                                <textarea  name="About" id="about1" style="width:100%;height:200px;"  class="form-control" placeholder="Description" /></textarea>
                            </td>
                        </tr>
						
							

						<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>		
						
                     
                       
						
						 <tr>
                                <th width="30%">*Instructor Image:</th>
								<td>
									
									<button type="button" id="select_btn_img2" class="btn btn-info btn-lg"  style="margin-top:20px;" data-toggle="tooltip" data-placement="top" title="Image recommended size for better appearance is 300 X 300 (Width X Height) or above this resolution."><span data-toggle="modal" data-target="#myModal2">Select new image</span></button>
									<span style="padding:0px 15px 0px 15px; margin-top:20px; position:relative; top:10px;">or</span>

										<label type="button" id="upload_btn_img2" for="InsImg" style=" margin-top:20px;" data-toggle="tooltip" data-placement="top" title="Image recommended size for better appearance is 300 X 300 (Width X Height) or above this resolution." class="btn btn-info btn-lg">Upload image <input type="file"  name="InsImg" style="display:none;" id="InsImg" class="img"
										required/></label>
										<br><br>
										<div id="imagePreview_select2" style="display:none;"></div>
										<div id="imagePreview2" style="display:none;"></div>
								</td>
                                
                            </tr>
							<tr>
								<td></td>
								<td>
									
								<input type="hidden" id="InsImg_2" style="border-bottom: 1px solid #e1e1e1; padding-bottom:15px; 
								width: 100%;" class="form-control img" name="InsImg_2" />
											<!-- Modal -->
											<div id="myModal2" class="modal fade" role="dialog">
											  <div class="modal-dialog">

												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Please select an image</h4>
												  </div>
												  <div class="modal-body" style="max-height:230px;  overflow-y:scroll;">
													
													<br>
													<p><?php 
												$sel2=mysql_query("select DISTINCT InsImg from tblmstinstructor");
												$temp_no2 = 0;
												while($r2=mysql_fetch_array($sel2))
												{	
													
													$temp_no2++;
											?>
											  
													
														<img src="upload/instructor/<?php echo $r2['InsImg'];?>" value="<?php echo $r2['InsImg'];?>" height="100px" width="120px" style="margin:5px;" class="img_main_class" id="img_<?php echo $temp_no2; ?>">
																									
											 	
												<?php
													
												}
												?></p>
												  </div>
												  <div class="modal-footer">
												  <button type="button" id="cancel_btn2" class="btn btn-default" data-dismiss="modal">Cancel</button>
													<button type="button" id="submit_btn2" class="btn btn-default" data-dismiss="modal">Submit</button>
												  </div>
												</div>

											  </div>
											</div>
								</td>
								
                            </tr>


							<tr>
                            <th width="30%">Active/Deactive:</th>

                            <td>
								<input type="radio"  name="IsActive" value="1" checked id="IsActive">Active 
								&nbsp;&nbsp;
  								<input type="radio"  name="IsActive" value="0" id="IsActive">Deactive<br>
							</td>
                        </tr>

                        <tr>
                            <th>&nbsp;</th>

                            <td><input type="submit" name="save" class="btn btn-success"  value="Save" /></td>

                        </tr>
                    </table>
                </form>



            </div>
                
        </div>

    </div>


</div>
<!-- END PAGE CONTENT WRAPPER -->                                



<!-- END PAGE CONTENT -->
</div>
<?php
include 'footer.php';
?>
<!-- START PLUGINS -->
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>                
<!-- END PLUGINS -->

<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>

<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>  



<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
<script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
<script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>
<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/base64.js"></script>    


<!-- END PAGE PLUGINS -->

<!-- START TEMPLATE -->



<script type="text/javascript" src="js/plugins.js"></script>        
<script type="text/javascript" src="js/actions.js"></script>    


<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>



<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
<script type="text/javascript" src="nicEdit-latest.js"></script>
<script>
//<![CDATA[
                           bkLib.onDomLoaded(function () {

                               new nicEditor({fullPanel: true, maxHeight: 200}).panelInstance('about1');
                           });
                            //]]>
</script>

<script type="text/javascript">

	$(document).ready(function()
	{
		$("#myModal img").click(function() {
			$("#myModal img.selected_img").removeClass("selected_img");
			var id_class = $(this).attr('id');
			$('#' + id_class).toggleClass("selected_img");
			
			var src = $(this).attr('src');
			$('#imagePreview_select').html("<img src=" + src + ">");
			$('#imagePreview_select').attr('style', 'display:block;');
			$('#imagePreview').attr('style', 'display:none;');
			//alert(src);
			src = src.split("/").pop();
			//alert(src);
			$('#Image_2').val(src);
			
		});

$("#myModal2 img").click(function() {
			$("#myModal2 img.selected_img").removeClass("selected_img");
			var id_class = $(this).attr('id');
			$('#' + id_class).toggleClass("selected_img");
			
			var src = $(this).attr('src');
			$('#imagePreview_select2').html("<img src=" + src + ">");
			$('#imagePreview_select2').attr('style', 'display:block;');
			$('#imagePreview2').attr('style', 'display:none;');
			//alert(src);
			src = src.split("/").pop();
			//alert(src);
			$('#InsImg_2').val(src);
			
		});

		
		$("#cancel_btn").click(function() {
			$("img.selected_img").removeClass("selected_img");
			$('#Image_2').val('');
			$('#imagePreview_select').html('');
			$('#imagePreview_select').attr('style', 'display:none;');
		});

$("#cancel_btn2").click(function() {
			$("img.selected_img").removeClass("selected_img");
			$('#InsImg_2').val('');
			$('#imagePreview_select2').html('');
			$('#imagePreview_select2').attr('style', 'display:none;');
		});
		// $("#upload_btn_img").click(function() {
			// //alert($('#Image').val()bmit);
			// if($('#Image').val() != ''){
				// $('#myModal').modal('hide');
				// $('#select_btn_img').attr('disabled', true); 
			// }
		// });
		$("#submit_btn").click(function() {
			//alert($('#Image_2').val());
			if($('#Image_2').val() != ''){
				$('#upload_btn_img').attr('disabled', true); 
			}
		});

		$("#submit_btn2").click(function() {
			//alert($('#Image_2').val());
			if($('#InsImg_2').val() != ''){
				$('#upload_btn_img2').attr('disabled', true); 
			}
		});


		$('#Image').change(function (e) {
			if($('#Image').val() != ''){
				$('#myModal').modal('hide');
				$('#select_btn_img').attr('disabled', true); 
			}
		});
		
		
		$('#InsImg').change(function (e) {
			if($('#InsImg').val() != ''){
				$('#myModal2').modal('hide');
				$('#select_btn_img2').attr('disabled', true); 
			}
		});
		// $("#update").click(function() {
			 // if ($('#upload_btn_img').val() == '') {
				// $('#message').html("Please Attach File");
				// }else {
                            // alert('not work');
                   // }
		// });
		
		
		  
		
	});











$(function() {
    $("#Image").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
			$('#imagePreview').attr('style', 'display:block;');
			$('#imagePreview_select').attr('style', 'display:none;');
        }
    });
});


$(function() {
    $("#InsImg").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview2").css("background-image", "url("+this.result+")");
            }
			$('#imagePreview2').attr('style', 'display:block;');
			$('#imagePreview_select2').attr('style', 'display:none;');
        }
    });
});

</script>

<!-- END PRELOADS -->                      


<!-- START THIS PAGE PLUGINS-->        

<!-- END THIS PAGE PLUGINS-->  

<!-- START TEMPLATE -->



</body>
<script type="text/javascript">
//<![CDATA[
    $(document).ready(function ()

    {


        $("#form_instructor").validate(
                {

                    rules: {

                        'InsName': {

                            required: true,
                            pattern: /^[a-zA-Z0-9\s\-\'\,\".:, ]+$/,
                            //minlength: 3

                        },

						 'About': {

                            required: true,
                            //pattern: /^[a-zA-Z_0-9@\!#\^%&*()+=\-[]\\\';,\.\/\{\}\|\":<>\?\n ]+$/,
							pattern: /^[a-zA-Z0-9!@#$%^&*()_+-=\n.\/?.,'’ ]+$/,
                            //minlength: 3

                        },
						

				'InsImg': {

                            //required: true,
                            pattern: /^.png|.jpg|.gif/,
							//minlength: 1

                        },	
						
					

                    },

                    messages: {

                        'InsName': {

                            required: "The instructer name is mandatory!",
                            pattern : "Enter only characters and \"space , \" -",
                            //minlength: "Choose a title of at least 3 letters!",

                        },
						
						'About': {

                            required: "The about detail is mandatory!",
                            pattern : "Enter only characters and \"space , \" -",
                            //minlength: "Choose a title of at least 3 letters!",

                        },
						
						

						'InsImg': {

                            //required: "The image is mandatory!",
                            pattern : "Enter only image fromat .png,.jpg,.gif",
                           // minlength: "Choose a image of at least 1!",

                        },
						
						
                    }

                });

    });

//]]>
</script>
<script>
$(function () 
{
    $("#StartDate").datepicker({ dateFormat: 'mm/dd/yyyy' });
    $("#EndDate").datepicker({ dateFormat: 'mm/dd/yyyy' });
        $("#CoursDate").datepicker({ dateFormat: 'mm/dd/yyyy' });
});
</script>
</html>

<?php ob_end_flush(); ?>
