document.addEventListener('DOMContentLoaded', () => {
    
    // ==========================================
    // 🎠 PARTE 1: CARRUSEL (Galería)
    // ==========================================
    const track = document.getElementById("carouselTrack");
    const btnLeft = document.querySelector(".carousel-btn.left");
    const btnRight = document.querySelector(".carousel-btn.right");

    // Solo ejecutamos esto si existen los elementos del carrusel
    if (track && btnLeft && btnRight) {
        let offset = 0;

        btnRight.addEventListener("click", () => {
            const card = track.querySelector(".gallery-card");
            // Ancho de la tarjeta + el margen derecho (25px según CSS aprox)
            // Usamos || 220 por seguridad si no lee el ancho
            const cardWidth = card ? (card.offsetWidth + 25) : 220; 
            
            const maxOffset = track.scrollWidth - track.parentElement.offsetWidth;

            offset += cardWidth;
            if (offset > maxOffset) offset = maxOffset;

            track.style.transform = `translateX(-${offset}px)`;
        });

        btnLeft.addEventListener("click", () => {
            const card = track.querySelector(".gallery-card");
            const cardWidth = card ? (card.offsetWidth + 25) : 220;

            offset -= cardWidth;
            if (offset < 0) offset = 0;

            track.style.transform = `translateX(-${offset}px)`;
        });
    }

    // ==========================================
    // 🎬 PARTE 2: VÍDEO
    // ==========================================
    const bideoa = document.getElementById('nireBideoa');
    
    if (bideoa) { // Protección: Solo si existe el vídeo
        const playBtn = document.getElementById('playBtn');
        const pauseBtn = document.getElementById('pauseBtn');
        const stopBtn = document.getElementById('stopBtn');
        const muteBtn = document.getElementById('muteBtn');
        const volplusBtn = document.getElementById('volplusBtn');
        const volminusBtn = document.getElementById('volminusBtn');
        const bideoHautatzailea = document.getElementById('bideoHautatzailea');

        if(playBtn) playBtn.addEventListener('click', () => bideoa.play());
        if(pauseBtn) pauseBtn.addEventListener('click', () => bideoa.pause());
        if(stopBtn) stopBtn.addEventListener('click', () => { bideoa.pause(); bideoa.currentTime = 0; });
        
        if(muteBtn) {
            muteBtn.addEventListener('click', () => {
                bideoa.muted = !bideoa.muted;
                muteBtn.textContent = bideoa.muted ? "UNMUTE" : "MUTE";
            });
        }

        if(volplusBtn) volplusBtn.addEventListener('click', () => { 
            if(bideoa.volume < 1) bideoa.volume = Math.min(1, bideoa.volume + 0.1); 
        });
        
        if(volminusBtn) volminusBtn.addEventListener('click', () => { 
            if(bideoa.volume > 0) bideoa.volume = Math.max(0, bideoa.volume - 0.1); 
        });

        if(bideoHautatzailea) {
            bideoHautatzailea.addEventListener('change', (evento) => {
                bideoa.src = evento.target.value;
                bideoa.load();
                bideoa.play().catch(e => console.log("Autoplay bloqueado hasta interacción"));
            });
        }
    }

    // ==========================================
    // 🎵 PARTE 3: AUDIO (Con tus IDs nuevos)
    // ==========================================
    const audioa = document.getElementById('nireAudioa');

    if (audioa) { // Protección: Solo si existe el audio
        console.log("Sistema de audio detectado.");
        
        const playBtn1 = document.getElementById('playBtn1');
        const pauseBtn1 = document.getElementById('pauseBtn1');
        const stopBtn1 = document.getElementById('stopBtn1');
        const volplusBtn1 = document.getElementById('volplusBtn1');
        const volminusBtn1 = document.getElementById('volminusBtn1');

        if(playBtn1) playBtn1.addEventListener('click', () => audioa.play());
        if(pauseBtn1) pauseBtn1.addEventListener('click', () => audioa.pause());
        if(stopBtn1) stopBtn1.addEventListener('click', () => { audioa.pause(); audioa.currentTime = 0; });
        
        if(volplusBtn1) volplusBtn1.addEventListener('click', () => { 
            if(audioa.volume < 1) audioa.volume = Math.min(1, audioa.volume + 0.1); 
        });
        
        if(volminusBtn1) volminusBtn1.addEventListener('click', () => { 
            if(audioa.volume > 0) audioa.volume = Math.max(0, audioa.volume - 0.1); 
        });

    } else {
        console.log("No se ha encontrado el elemento de audio en esta página.");
    }

});