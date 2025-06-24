import SignaturePad from 'signature_pad';

function initSignatureField(wrapper) {
	const canvas = wrapper.querySelector('.acf-signature-canvas');
	const input = wrapper.querySelector('.acf-signature-input');
	const clearBtn = wrapper.querySelector('.acf-signature-clear');

	const signaturePad = new SignaturePad(canvas);

	const existing = input.value;
	if (existing && existing.startsWith('http')) {
		const image = new Image();
		image.src = existing;
		image.onload = () => {
			canvas.getContext('2d').drawImage(image, 0, 0);
		};
	}

	function updateInput() {
		if (signaturePad.isEmpty()) {
			input.value = '';
			return;
		}

		signaturePad.toBlob((blob) => {
			const formData = new FormData();
			formData.append('action', 'save_signature_image');
			formData.append('signature', blob, 'signature.png');

			fetch(window.ajaxurl, {
				method: 'POST',
				body: formData,
				credentials: 'same-origin',
			})
				.then((res) => res.json())
				.then((data) => {
					if (data.success && data.url) {
						input.value = data.url;
					} else {
						console.error('Signature upload failed:', data);
					}
				});
		});
	}

	canvas.addEventListener('mouseup', updateInput);
	canvas.addEventListener('touchend', updateInput);
	clearBtn.addEventListener('click', () => {
		signaturePad.clear();
		input.value = '';
	});
}

if (typeof acf !== 'undefined') {
	acf.add_action('ready append', ($el) => {
		$el[0].querySelectorAll('.acf-signature-wrapper').forEach(initSignatureField);
	});
} else {
	document.addEventListener('DOMContentLoaded', () => {
		document.querySelectorAll('.acf-signature-wrapper').forEach(initSignatureField);
	});
}