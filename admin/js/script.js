$( document ).ready(function() {
	$('#selectAllBoxes').click(function(event){
		if(this.checked){
			$('.checkAll').each(function(){
				this.checked = true;
			});
		}else{
			$('.checkAll').each(function(){
				this.checked = false;
			});
		}
	});


	ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
        console.error( error );
    });


});
