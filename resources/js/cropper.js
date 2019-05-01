//cropper stuff here
function modeCheck(){
	if($('#mode').val() == 'crop'){
		$('.croptions').fadeIn();
		$('.croptions').fadeIn();
	}else{
		$('.croptions').hide();
		$('.croptions').hide();
	}

	if($('#mode').val() == 'fit'){
		$('.fitions').fadeIn();
		$('.fitions').fadeIn();
	}else{
		$('.fitions').hide();
		$('.fitions').hide();
	}

	if($('#mode').val() == 'resize'){
		$('.resizeHint').fadeIn();
		$('.resizeHint').fadeIn();
	}else{
		$('.resizeHint').fadeIn();
		$('.resizeHint').fadeIn();
	}
}

$("#mode").change(function(){
	modeCheck();
});

$("#savePreset").click(function(){
	if(document.getElementById("savePreset").checked){
		$('.preset').fadeIn();
	}else{
		$('.preset').hide();
		$('#presetName').val("")
	}
});

updateList = function(indiv, outdiv) {
  var input = document.getElementById(indiv);
  var output = document.getElementById(outdiv);

  output.innerHTML = '<ul>';
  for (var i = 0; i < input.files.length; ++i) {
    output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
  }
  output.innerHTML += "</ul>";

  $("#fileList").addClass("full");
}

$(document).ready(function() {
  var last_valid_selection = null;
  $('.pres').click(function(event) {
  	event.preventDefault();

  	$(this).attr('data-mode') ? $("#mode").val($(this).attr('data-mode')) : $("#mode").val("");
  	$(this).attr('data-position') ? $("#position").val($(this).attr('data-position')) : $("#position").val("");
  	$(this).attr('data-x') ? $("#xval").val($(this).attr('data-x')) : $("#xval").val("");
  	$(this).attr('data-y') ? $("#yval").val($(this).attr('data-y')) : $("#yval").val("");
  	$(this).attr('data-width') ? $("#width").val($(this).attr('data-width')) : $("#width").val("");
  	$(this).attr('data-height') ? $("#height").val($(this).attr('data-height')) : $("#height").val("");
  	$(this).attr('data-name') ? $("#presetName").val($(this).attr('data-name')) : $("#presetName").val("");

  	modeCheck();
  	

  });
  modeCheck();
});

$("#img").change(function(){
	var totalSize = 0;
	for(var i = 0; i < this.files.length; i++){
		var imageSize = this.files[i].size;
		totalSize = totalSize+imageSize;
	}
	if(totalSize > 8000000){
		alert('Please upload less than 8mb at a time.')
		$("#img").val("");
		$("#fileList").html("");
		$("#fileList").removeClass("full");
	}
});