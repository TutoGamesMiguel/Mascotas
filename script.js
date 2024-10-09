const showAlert = () => {
    const alert = document.getElementById('alert');
    const alertText = document.getElementById('alertText');

    alertText.innerHTML = 'Mascota agregada correctamente';
    alert.style.opacity = '1';
}

const form = document.getElementById('form');

form.addEventListener('submit',  function (e)  {

    e.preventDefault();
    if(e.submitter.id === 'botonEnviar') {
        const formData = new FormData(this);
        fetch('api/mascota.php', {
                method: 'POST',
                body: formData,
            })
            .then(async result => {
                const text = await result.text();
                showAlert();
                form.reset()
            })
            .catch(error => {
                console.log(error)
            });
    }
});

document.getElementById('verLista').addEventListener('click', function() {
    window.location.href = 'mascotasAdmin.html';
});