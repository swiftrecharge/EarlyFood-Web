jQuery(document).ready(function($){
	//if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
	var MQL = 1170;
	$('.cd-header').removeClass('is-visible is-fixed')

	//open/close primary navigation
	$('.trigger').on('click', function(){
		//show when clicked
		var id = document.getElementById("user_id").value;
        //alert(id);
         if(document.cookie = "user_name=" + id){
            //alert('yes');
         }else{
            //alert('nope');
         }
		$('.cd-header').addClass('is-visible');
		$('.cd-menu-icon').toggleClass('is-clicked'); 
		//$('.cd-header').toggleClass('menu-is-open');
		
		//in firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
		if( $('.cd-primary-nav').hasClass('is-visible') ) {
			$('.cd-primary-nav').removeClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				$('body').removeClass('overflow-hidden');
			});
		} else {
			$('.cd-primary-nav').addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				$('body').addClass('overflow-hidden');
			});	
		}
	});

	$('.trigger_delivery').on('click', function(){
		//show when clicked
		$('.cd-header').addClass('is-visible');
		$('.cd-menu-icon').toggleClass('is-clicked'); 
		//$('.cd-header').toggleClass('menu-is-open');
		
		//in firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
		if( $('.cd-primary-nav').hasClass('is-visible') ) {
			$('.cd-primary-nav').removeClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				$('body').removeClass('overflow-hidden');
			});
		} else {
			$('.cd-primary-nav').addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',function(){
				$('body').addClass('overflow-hidden');
			});	
		}
	});

	//this checks form fields
	/*if(!$('#check_order').is(':visible'))
	{
		$('#check_order').click(function() {
	        var empty = false;
	        $('.form-field').each(function() {
	            if ($(this).val() == '') {
	                empty = true;
	            }
	        });

	        if (empty) {
	            alert('All Fields Are Required')
	            return false;
	            //$('#check_order').attr('disabled', 'disabled'); 
	        } else {
	            
	            return true;
	            //$('#check_order').removeAttr('disabled');
	        }
	    });
	}*/
});