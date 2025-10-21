
        <!--final del contenido -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
            
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebar = document.querySelector('.sidebar');
            const linkTexts = document.querySelectorAll('.sidebar .link-text');
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                linkTexts.forEach(span => span.classList.toggle('d-none'));
            });


    const mapModal = document.getElementById('mapModal');

mapModal.addEventListener('shown.bs.modal', function () {
    const mapDiv = document.getElementById('map');
    
    // Evita duplicar iframe
    if (!mapDiv.querySelector('iframe')) {
        const iframe = document.createElement('iframe');
        iframe.src = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3280.151703382456!2d-58.3831004!3d-34.8069437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcc59ed2e3f4c1%3A0xf16a5c18eebcfc04!2sAlmirante%20Brown%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses!2sar!4v1627589099876!5m2!1ses!2sar';
        iframe.width = '100%';
        iframe.height = '400';
        iframe.style.border = '0';
        iframe.allowFullscreen = true;
        iframe.loading = 'lazy';
        iframe.referrerPolicy = 'no-referrer-when-downgrade';
        mapDiv.appendChild(iframe);
    }
});

// Limpia el iframe cuando el modal se cierra
mapModal.addEventListener('hidden.bs.modal', function () {
    const iframe = document.getElementById('map').querySelector('iframe');
    if (iframe) iframe.remove();
});

    
    
</script>


    </body>
</html>

