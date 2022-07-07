/* Set Background Image */
$('.bg-img').each(function () {
	var imgSrc = $(this).attr('data-background-image');
	if (imgSrc != undefined) {
		$(this).css('background-image', 'url("' + imgSrc + '")');
		//$(this).parent().css('background-position', '50% 0%');
	}
});

$('.custom_nav').on('click', '.fake-prev', function (event) {
	$(this).closest('.slick-w-custom-nav').find('.slick_trigger').slick('slickPrev');
});
$('.custom_nav').on('click', '.fake-next', function (event) {
	$(this).closest('.slick-w-custom-nav').find('.slick_trigger').slick('slickNext');
});

$('.input-inc-dec').on('click', '.increase', function (event) {
	var value = $(this).closest('.input-inc-dec').find('input').val();
	value = isNaN(value) ? 0 : value;
	value++;
	$(this).closest('.input-inc-dec').find('input').val(value);
	
});
$('.input-inc-dec').on('click', '.decrease', function (event) {
	var value = $(this).closest('.input-inc-dec').find('input').val();
	value = isNaN(value) ? 0 : value;
	value < 1 ? value = 1 : '';
	value--;
	$(this).closest('.input-inc-dec').find('input').val(value);
});

/* Popup Edit Answer */
$('.edit-answer').on('click', '.increase', function (event) {
	var value = $(this).closest('.edit-answer-item').find('input').val();
	value = isNaN(value) ? 0 : value;
	value++;
	$(this).closest('.edit-answer-item').find('.item-count').html(value);
	$(this).closest('.edit-answer-item').find('input').val(value);
	
});
$('.edit-answer').on('click', '.decrease', function (event) {
	var value = $(this).closest('.edit-answer-item').find('input').val();
	value = isNaN(value) ? 0 : value;
	value < 1 ? value = 1 : '';
	value--;
	$(this).closest('.edit-answer-item').find('.item-count').html(value);
	$(this).closest('.edit-answer-item').find('input').val(value);
});

$('.want-radiator-yes').on('click', function (e) {
	e.preventDefault();
	$('.choose-radiator').slideDown('fast');
	$('.want-radiator-container').slideUp('fast');
});

$(window).scroll(function () {
	var scroll = $(window).scrollTop();
	if (scroll >= 10) {
		$("body").addClass("nav-sticky");
	} else {
		$("body").removeClass("nav-sticky");
	}
});