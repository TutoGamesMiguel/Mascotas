export function addElement(stuff) {
    const clonesExistentes = document.querySelectorAll('.element-clone');
    clonesExistentes.forEach(clone => clone.remove());

    for (const data of stuff) {
        const clone = document.querySelector('.clone').cloneNode(true);
        clone.querySelector('.id').innerHTML = `ID: ${data.id} `;
        clone.querySelector('.nombre').innerHTML = `Nombre ${data.nombre}`;
        clone.querySelector('.raza').innerHTML = `Raza: ${data.raza} `;
        clone.classList.add('element-clone'); 

        const img = document.createElement('img');

        const imageUrl = `/mascotasweb/${data.imagen}`;
        console.log(`URL de la imagen: ${imageUrl}`);
        img.src = imageUrl;
        img.alt = `Imagen de ${data.nombre}`;
        img.classList.add('mascota-imagen');
        clone.appendChild(img);

        clone.classList.add('element-clone');

        const adoptButton = document.createElement('button');
        adoptButton.innerHTML = 'Adoptar';
        adoptButton.classList.add('adoptBtn', 'bg-green-500', 'text-white', 'p-2', 'm-2');
        adoptButton.onclick = function () {
            Adoptar();
        };

        clone.appendChild(adoptButton);
        document.getElementById('content').append(clone);
        clone.style.display = 'block';
    }
}

function listar() {
    fetch('api/listar.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(async result => {
        const data = await result.json();
        addElement(data);
    })
    .catch(error => {
        console.log(error)
    });
}
listar();

function Adoptar() {
    Swal.fire({
        title: "Estás seguro de adoptar esta mascota?",
        text: "No podrás revertir la decisión",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, mascota adoptada!",
        cancelButtonText: "No, cancelar"
        }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Adoptada!",
            text: "La mascota ha sido adoptada.",
            icon: "success"
          });
        }
      });
}