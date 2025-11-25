    /* Apperçu photo */
    
    const modal = document.getElementById('photoModal');
    const modalImage = document.querySelector('.modal-image');
    const closeBtn = document.querySelector('.fermer');
    const photoThumbnails = document.querySelectorAll('.photo-apercu');

    photoThumbnails.forEach(photo => {
        photo.addEventListener('click', function(e) {
            e.preventDefault();
            const photoUrl = this.getAttribute('data-photo-url');
            modalImage.src = photoUrl;
            modal.style.display = 'flex';
        });
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            modal.style.display = 'none';
        }
    });