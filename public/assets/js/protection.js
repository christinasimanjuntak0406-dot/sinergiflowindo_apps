(() => {
    'use strict';

    // Blok klik kanan
    document.addEventListener('contextmenu', e => {
        e.preventDefault();
    });

    // Blok drag gambar
    document.addEventListener('dragstart', e => {
        if (e.target.tagName === 'IMG') {
            e.preventDefault();
        }
    });

    // Blok copy
    document.addEventListener('copy', e => {
        e.preventDefault();
    });

    // Blok cut
    document.addEventListener('cut', e => {
        e.preventDefault();
    });

    // Blok selectstart (pilih teks)
    document.addEventListener('selectstart', e => {
        if (!e.target.closest('input, textarea')) {
            e.preventDefault();
        }
    });

    // Blok shortcut
    document.addEventListener('keydown', e => {

        const key = e.key.toUpperCase();

        // F12
        if (e.key === 'F12') {
            e.preventDefault();
        }

        // Ctrl+U, Ctrl+S, Ctrl+A
        if (e.ctrlKey && ['U','S','A'].includes(key)) {
            e.preventDefault();
        }

        // Ctrl+Shift+I/J/C
        if (e.ctrlKey && e.shiftKey &&
            ['I','J','C'].includes(key)) {
            e.preventDefault();
        }

    });

})();
