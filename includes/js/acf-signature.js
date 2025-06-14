import SignaturePad from 'signature_pad';
import '../scss/acf-signature.scss';

jQuery(document).ready(function($){
	$('.acf-signature-field').each(function(){
		var $container = $(this);
		var canvas = $container.find('canvas')[0];
		if (!canvas) return;
		var input = $container.find('input[type="hidden"]');
		var signaturePad = new SignaturePad(canvas);

		// Load existing value
		if(input.val()){
			signaturePad.fromDataURL(input.val());
		}

		// On end, save to input
		signaturePad.onEnd = function(){
			input.val(signaturePad.toDataURL());
		};

		// Clear button
		$container.find('.acf-signature-clear').on('click', function(e){
			e.preventDefault();
			signaturePad.clear();
			input.val('');
		});
	});
});
