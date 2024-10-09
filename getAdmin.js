export function addElement(stuff) {
    const clonesExistentes = document.querySelectorAll('.element-clone');
    clonesExistentes.forEach(clone => clone.remove());

    for(const data of stuff) {
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

        const editButton = document.createElement('button');
        editButton.innerHTML = 'editar';
        editButton.classList.add('edit-btn', 'bg-blue-500', 'text-white', 'p-2', 'm-2');
        editButton.onclick = function() {
            console.log(`Editar mascota ${data.id}`);
            Editar(data.id)
        };

        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = 'Eliminar';
        deleteButton.classList.add('delete-btn', 'bg-red-500', 'text-white', 'p-2', 'm-2');
        deleteButton.onclick = function() {
            console.log(`Eliminar mascota ${data.id}`);
            Eliminar(data.id);
        };

        clone.appendChild(editButton);
        clone.appendChild(deleteButton);
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

function Eliminar(id) {
    Swal.fire({
        title: "¿Estás Seguro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("api/eliminar.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({id}),
            }).then(response => response.text()).then(response => {
                console.log(response);
                listar();
                Swal.fire({
                    title: "Eliminado!",
                    text: "El producto ha sido eliminado.",
                    icon: "success"
                });
            })
        }
    });
}

function Editar(id) {
    fetch("api/editar.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({id}),
    }).then(response => response.json()).then(data => {
        Swal.fire({
            title: 'Editar Producto',
            html: `<input id="nombre" class="swal2-input" placeholder="Nombre" value="${data.nombre}">
                    <input id="precio" class="swal2-input" placeholder="Precio" value="${data.precio}">
                    <input id="cantidad" class="swal2-input" placeholder="Cantidad" value="${data.cantidad}">`, 
            focusConfirm: false,
            preConfirm: () => {
                const nombre = document.getElementById('nombre').value;
                const precio = document.getElementById('precio').value;
                const cantidad = document.getElementById('cantidad').value; 

                return { nombre: nombre, precio: precio, cantidad: cantidad }; 
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("api/editar.php", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        nombre: result.value.nombre,
                        precio: result.value.precio,
                        cantidad: result.value.cantidad 
                    }),
                }).then(response => response.json()).then(response => {
                    if (response.success) {
                        Swal.fire('¡Actualizado!', 'El producto ha sido actualizado.', 'success');
                    } else {
                        Swal.fire('Error', 'Hubo un problema al actualizar el producto.', 'error');
                    }
                });
            }
        });
    });
}