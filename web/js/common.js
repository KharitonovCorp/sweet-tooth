$(document).ready(function(){
		
	
	//// Menu ////
	$('.nav__button').click(function(){
		$('.nav__menu').removeClass('hidden');
		$('.window-blackout').removeClass('hidden');
		$('body').css('overflow-y', 'hidden');
	});
	$('.menu__close').click(function(){
		$('.nav__menu').addClass('hidden');
		$('.window-blackout').addClass('hidden');
		if($('.sidebar__filter').hasClass('hidden')){
			$('body').css('overflow-y', 'auto');			 
		}
		else{
			$('body').css('overflow-y', 'hidden');			 
		}
	});
	$('.window-blackout').click(function(){
		if(!$('.nav__menu').hasClass('hidden')){
			$('.nav__menu').addClass('hidden');
		}
		$(this).addClass('hidden');
		if($('.sidebar__filter').hasClass('hidden')){
			$('body').css('overflow-y', 'auto');			 
		}
		else{
			$('body').css('overflow-y', 'hidden');			 
		}
	});
	
	
	//// Filter ////
	$('.f-category__title').click(function(){
		$(this).children(".f-category__menu-icon").toggleClass("close")
		$(this).next().slideToggle();
	});
	$('.filter__mobile-btn').click(function(){
		$('.sidebar__filter').toggleClass('hidden');
		if($('.sidebar__filter').hasClass('hidden')){
			$('body').css('overflow-y', 'auto');			 
		}
		else{
			$('body').css('overflow-y', 'hidden');			 
		}
	});
	
	
	//// Statistics ////
	$('.a-statistics__like').click(function(){
		if($(this).children('i').hasClass('accent-color')){
			$('.a-statistics__dislike').children('i').removeClass('accent-color');
			$(this).children('i').removeClass('accent-color');
			//+ удалить лайк из базы (AJAX)
		}
		else{
			$('.a-statistics__dislike').children('i').removeClass('accent-color');
			$(this).children('i').addClass('accent-color');
			//+ добавить лайк в базу (AJAX)
		}
	});
	$('.a-statistics__dislike').click(function(){
		if($(this).children('i').hasClass('accent-color')){
			$('.a-statistics__like').children('i').removeClass('accent-color');
			$(this).children('i').removeClass('accent-color');
			//+ удалить дизлайк из базы (AJAX)
		}
		else{
			$('.a-statistics__like').children('i').removeClass('accent-color');
			$(this).children('i').addClass('accent-color');
			//+ добавить дизлайк в базу (AJAX)
		}
	});
	
	
	//// My Publication ////
	$('.publication__section__title').click(function(){
		if($(this).children('i').hasClass('fa-chevron-down')){
			 $(this).children('i').removeClass('fa-chevron-down');
			 $(this).children('i').addClass('fa-chevron-up');
		}
		else{
			 $(this).children('i').removeClass('fa-chevron-up');
			 $(this).children('i').addClass('fa-chevron-down');
		}
		$(this).parent().children('.publication__section__content').slideToggle();
	});
	// Delete margin top from article
	$($('.article__main-text').find(':first-child')[0]).css({marginTop: '0px'});
	
	
	//// Form ////
	// MaxLength
	$('[data-maxlength]').each(function(){
		var maxlength = $(this).attr('data-maxlength');
		$(this).after('<div style="position: relative">' + $(this)[0].outerHTML + '<div style="position: absolute; top: -21px; right: 0; color: #757575; font-size: 0.8em;"><span class="input_length">0</span>/' + maxlength + '</div></div>');
		$(this).remove();
	});
	$('[data-maxlength]').on('input', function(){
		var maxlength = $(this).attr('data-maxlength');
		var curLength = $(this).val().length;
		if(maxlength <= curLength){
			$(this).val($(this).val().substring(0, maxlength));
			$(this).parent().children('div').css({color: '#ed4d4d'});
		}
		else{
			$(this).parent().children('div').css({color: '#757575'});
		}
		$(this).parent().children('div').children('.input_length').text($(this).val().length);
	});
	// Load formSelectLoadImage
	var formSLI = $('.formSelectLoadImage');
	if(formSLI.length) {
		formSLI.empty();
		formSLI.append('<div class="formSelectLoadImage-btns"><div class="formSelectLoadImage-btn active" data-slimage="url">Ссылка</div><div class="formSelectLoadImage-btn" data-slimage="file">Файл</div></div><div class="selectedItem"><input type="url" name="image" required placeholder="Введите ссылку на картинку"><input type="hidden" name="imageType" value="url"></div>');
	}
	$('.formSelectLoadImage-btn').click(function(){
		$(this).parent().children('.formSelectLoadImage-btn.active').removeClass('active');
		$(this).addClass('active');
		if($(this).attr('data-slimage') == 'url'){
			$(this).parent().parent().children('.selectedItem').empty();
			$(this).parent().parent().children('.selectedItem').append('<input type="url" name="image" required placeholder="Введите ссылку на картинку"><input type="hidden" name="imageType" value="url">');
		}
		else{
			$(this).parent().parent().children('.selectedItem').empty();
			$(this).parent().parent().children('.selectedItem').append('<input type="file" name="image" required><input type="hidden" name="imageType" value="file"/>');
		}
	});
	// Select
	$('.form-select .select-input').click(function(){
		$(this).children('.select-input-icon').toggleClass('close');
		$(this).parent().children('.select-options').toggleClass('active');
	});
	$('.form-select .select-options li').click(function(){
		$(this).parent().parent().children('.select-input').children('p').text($(this).text());
		$(this).parent().parent().children('.select-input').children('p').css({color: '#424242'});
		$(this).parent().parent().children('.select').val($(this).attr('data-value'));
		$(this).parent().removeClass('active');
		
	});
	// Send form ajax (post)
	$('form.ajaxForm').submit(function(){
		tinyMCE.triggerSave();
		var idForm = '#' + $(this).attr('id');
		$(idForm + ' button[type="submit"]').attr('disabled', true);
		var $that = $(idForm);
		var formData = new FormData($that.get(0));
		$.ajax({
			url: $(this).attr('action'),
			type: 'POST',
			dataType: 'text',
			data: formData,
			contentType: false,
			processData: false,
			success: function(result) {
				//	var data = $.parseJSON(result);
				//	if(data.goto){ window.location.href = data.goto; }
				//	if(data.status == 'success'){
				//		alertify.success(data.text);
				//	}
				//	else{
				//		alertify.error(data.text);
				//	}
			},
			complete: function(){
				$(idForm + ' button[type="submit"]').attr('disabled', false);
				$(idForm)[0].reset();
				$(idForm).find('.form-tinymce-editor').empty();
				$(idForm).find('.form-tinymce-editor').append('<p>Введите вашу статью</p>');
			}
		});
		return false;
	});
	// SelectInput
	$('.selectInput .select-options li').click(function(){
		$(this).parent().parent().children('.select-input').val($(this).text());
	});
	$('.selectInput .select-input').focus(function(){
		var elem = $(this);
		$(elem).parent().children('.select-options').css({display: 'block'});
	}).blur(function(){
		var elem = $(this);
		setTimeout(function(){
			$(elem).parent().children('.select-options').css({display: 'none'});
		}, 200);
	});
	$('.selectInput .select-input').on('input', function(){
		$(this).parent().children('.select-options').css({display: 'block'});
		var empty = true;
		$(this).parent().children('.select-options').children('li').each(function(){
			var display = true;
			if($(this).text().toLowerCase().indexOf($(this).parent().parent().children('.select-input').val().toLowerCase()) == -1){
				display = false;
			}
			if(display){
				$(this).css({display: 'block'});
				empty = false;
			}
			else{
				$(this).css({display: 'none'});
			}
		});
		if(empty){
			$(this).parent().children('.select-options').css({display: 'none'});
		}
	});
	
	
	//// Add publication ////
	// Show meta data
	$('.pa__meta__title').click(function(){
		$(this).children('.pa__meta__title-icon').toggleClass('close');
		$(this).parent().children('.pa__meta__content').slideToggle();
	});
	// Add meta title from main title
	$('[name="title"]').on('input',function(){
		if(!$('[name="meta_title"]').hasClass('changed')){
			$('[name="meta_title"]').val($(this).val());
		}
	});
	// Add meta description from main description
	$('[name="description"]').on('input',function(){
		if(!$('[name="meta_description"]').hasClass('changed')){
			$('[name="meta_description"]').val($(this).val());
		}
	});
	// If meta title change then add class 'changed' for input
	$('[name="meta_title"]').on('input',function(){
		$(this).addClass('changed');
	});
	// If meta description change then add class 'changed' for input
	$('[name="meta_description"]').on('input',function(){
		$(this).addClass('changed');
	});
	
	
	//// Add recipe ////
	
	
	
	// Clear console on prodaction
	// console.clear();
});

//// Add recipe ////
// Ingreedient recalculation Ingreedients
function recalculationIngreedient(){
	var id = 0;
	$('.ingredient_block').each(function(){
		$(this).attr('data-groupid', id);	
		$(this).children('.ingredient_content').children('.form__group').children('.input-with-icon').attr('name', 'ingredient[' + id + '][]');	
		id++;
	});
}
// Add ingredients block
function addIngredientsBlock(elem){
	var id = parseInt($(elem).parent().children('.ingredient_block:last-child').attr('data-groupid'));
	$(elem).parent().append('<div class="ingredient_block" data-groupid="' + id + '" ><div class="ingredient_header"><input type="text" name="ingredient_title[]" required placeholder="Введите название группы"><div class="header_action"><i class="fa fa-plus" onclick="addIngredient(this)" title="Добавить ингредиент"></i><i class="fa fa-times" onclick="delIngredientsBlock(this)" title="Удалить группу"></i></div></div><div class="ingredient_content"><div class="form__group"><input type="text" name="ingredient[' + id + '][]" class="input-with-icon" required placeholder="Введите ингредиент"><i class="fa fa-times" onclick="delIngredient(this)" title="Удалить ингредиент"></i></div></div></div>');
	recalculationIngreedient()
}
// Del ingredients block
function delIngredientsBlock(elem){
	$(elem).parent().parent().parent().remove();
	recalculationIngreedient()
}
// Add ingredient
function addIngredient(elem){
	var id = $(elem).parent().parent().parent().attr('data-groupid');
	$(elem).parent().parent().parent().children('.ingredient_content').append('<div class="form__group"><input type="text" name="ingredient[' + id + '][]" class="input-with-icon" required placeholder="Введите ингредиент"><i class="fa fa-times" onclick="delIngredient(this)" title="Удалить ингредиент"></i></div>');
}
// Del ingredient
function delIngredient(elem){
	$(elem).parent().remove();
}

// Step recalculation steps
function recalculationStep(){
	var count = 0;
	$('.step_block').each(function(){
		$(this).attr('data-groupid', count);	
		$(this).children('.step_image').children('label').children('.step_image_input').attr('name', 'step_image[' + count + '][]');
		$(this).children('.form__group').children('label').children('.step_text_input').attr('name', 'step_text[' + count + '][]');
		count++;
		$(this).find('h4').text('Шаг ' + count);
	});
}
// Add steps block
function addStepsBlock(elem){
	var id = parseInt($(elem).parent().children('.step_block:last-child').attr('data-groupid')) + 1;
	$(elem).parent().append('<div class="step_block" data-groupid="' + id + '" style="position: relative;"><i class="fa fa-times del_step" onclick="delStepsBlock(this)" title="Удалить шаг"></i><div class="step_image" style="background: url(/images/no-image.svg) no-repeat; background-size: cover; background-position: center;"><label><input type="file" onchange="recipeEncodeImageFile(this)" data-delwsend style="display: none;"><input type="hidden" class="step_image_input" name="step_image[' + id + '][]" value=""></label></div><div class="form__group" style="margin-top: 0px;"><h4></h4><label><textarea type="text" class="step_text_input" name="step_text[' + id + '][]" required placeholder="Введите текст шага" style="height: 150px"></textarea></label></div></div>');
	recalculationStep()
}
// Del steps block
function delStepsBlock(elem){
	$(elem).parent().remove();
	recalculationStep()
}
// Load image and convert to base64 format
function recipeEncodeImageFile(element) {
	var file = element.files[0];
	var reader = new FileReader();
	reader.onloadend = function() {
		$(element).parent().children('input[type="hidden"]').val(reader.result);
		$(element).parent().attr('style', 'background: url(' + reader.result + ') no-repeat; background-size: cover; background-position: center; border-radius: 3px;');
	}
	reader.readAsDataURL(file);
}