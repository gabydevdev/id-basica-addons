(function ($) {
	function initSignatureField($el) {
		const canvas = $el.find('.acf-signature-canvas')[0];
		const input = $el.find('.acf-signature-input');
		const clearBtn = $el.find('.acf-signature-clear');

		if (!canvas) return;

		const signaturePad = new SignaturePad(canvas);

		const existing = input.val();
		if (existing && existing.startsWith('http')) {
			const image = new Image();
			image.src = existing;
			image.onload = () => {
				const ctx = canvas.getContext('2d');
				ctx.drawImage(image, 0, 0);
			};
		}

		function updateInput() {
			if (signaturePad.isEmpty()) {
				input.val('');
				return;
			}

			signaturePad.toBlob(function (blob) {
				const formData = new FormData();
				formData.append('action', 'save_signature_image');
				formData.append('signature', blob, 'signature.png');

				fetch(ajaxurl, {
					method: 'POST',
					body: formData,
					credentials: 'same-origin',
				})
					.then((response) => response.json())
					.then((data) => {
						if (data.success && data.url) {
							input.val(data.url);
						} else {
							console.error('Error saving signature:', data);
						}
					});
			});
		}

		canvas.addEventListener('mouseup', updateInput);
		canvas.addEventListener('touchend', updateInput);

		clearBtn.on('click', () => {
			signaturePad.clear();
			input.val('');
		});
	}

	if (typeof acf !== 'undefined') {
		acf.add_action('ready append', function ($el) {
			$el.find('.acf-signature-wrapper').each(function () {
				initSignatureField($(this));
			});
		});
	}
})(jQuery);
