document.addEventListener('DOMContentLoaded', function() {
    let scrollear = true;
    document.getElementById('edit-button').addEventListener('click', function() {
        document.getElementById('formPelicula').classList.toggle('hidden');

        if (scrollear) {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
            scrollear = false;
        }else{
            scrollear = true;
        }
    });
});