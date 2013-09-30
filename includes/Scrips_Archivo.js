<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		
$(document).ready(function(){
	$("#marca").change(function(){
		$.ajax({
			url:"procesa.php",
			type: "POST",
			data:"idmarca="+$("#marca").val(),
			success: function(opciones){
				$("#modelo").html(opciones);
			}
		})
	});
});
