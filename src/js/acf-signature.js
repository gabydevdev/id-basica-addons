import SignaturePad from 'signature_pad';
import '../scss/acf-signature.scss';

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.acf-signature-field').forEach(function(container) {
        var canvas = container.querySelector('canvas');
        if (!canvas) return;
        var input = container.querySelector('input[type="hidden"]');
        var signaturePad = new SignaturePad(canvas);

        // Load existing value
        if (input.value) {
            signaturePad.fromDataURL(input.value);
        }

        // On end, save to input
        canvas.addEventListener('mouseup', function() {
            input.value = signaturePad.toDataURL();
        });

        // Clear button
        var clearButton = container.querySelector('.acf-signature-clear');
        if (clearButton) {
            clearButton.addEventListener('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
                input.value = '';
            });
        }
    });
});
