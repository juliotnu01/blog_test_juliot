@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Agregar Album</h1>
    <div class="row">
        <div class="col col-12">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Titulo</label>
                    <input id="titulo_album" type="text" class="form-control" placeholder="Agregar Titulo del album">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Ubicación</label>
                    <input id="Ubicacion_album" type="text" class="form-control" placeholder="Agregar ubicació del album">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Descripción</label>
                <textarea id="Descripcion_album" class="form-control" placeholder="Agregar descripción" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" onclick="GuardarAlbum()">Submit</button>
        </div>
        <div class="col col-12">
            <div class="row" id="row_img_album">
                <div class="col-4">
                    <div class="card m-2 p-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img_album" id="img_album" required>
                            <label for="img_album" class="custom-file-label">Seleccionar imagen</label>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="titulo">Titulo</label>
                                    <input id="titulo_photo" name="titulo" type="text" class="form-control" placeholder="Agregar Titulo del album">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion_photo" name="descripcion" class="form-control" placeholder="Agregar descripción" required></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Tags_photo">Tags</label>
                                    <input id="Tags_photo" name="titulo" type="text" class="form-control" placeholder="Agregar Titulo del album">
                                </div>
                                <div class="form-group form-check col-md-12">
                                    <input type="checkbox" class="form-check-input" id="privado">
                                    <label for="privado" class="form-check-label" for="exampleCheck1">privado</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="P()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const Photos = [];
    const P = () => {
        var model = {
            img: document.getElementById('img_album').files[0],
            imgPath: URL.createObjectURL(document.getElementById('img_album').files[0]),
            titulo: document.getElementById('titulo_photo').value,
            descripcion: document.getElementById('descripcion_photo').value,
            privado: document.getElementById('privado').value,
            tags: document.getElementById('Tags_photo').value,
        }
        Photos.push(model);

        addPhotoToRow(model);
    }
    const addPhotoToRow = (item) => {
        var rowImgPhoto = document.getElementById('row_img_album');

        rowImgPhoto.innerHTML += `
        <div class="col-4">
            <div class="card m-2">
                <img src="${item.imgPath}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">${item.titulo}</h5>
                    <p class="card-text">${item.descripcion}</p>
                    <p class="card-text"><small class="text-muted">${item.tags}</small></p>
                </div>
                <div class="card-footer">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Escribe un comentario">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
                                <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z"/>
                                </svg>
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;

    }

    const GuardarAlbum = async () => {
        const model = {
            title: document.getElementById('titulo_album').value,
            ubicacion: document.getElementById('Ubicacion_album').value,
            descripcion: document.getElementById('Descripcion_album').value,
            Photos
        }
        
        var config = { headers: { 'Content-Type': 'multipart/form-data' } };
        var fd = new FormData();

        for (let index = 0; index < model.Photos.length; index++) {
            const element = model.Photos[index];
            fd.append(`photo-${index}`,element.img)
        }

        fd.append('cantidad_photos', model.Photos.length)
        fd.append('title', model.title)
        fd.append('ubicacion', model.ubicacion)
        fd.append('descripcion', model.descripcion)
        let { data } = await axios.post('/api/add-album', fd, config)
        console.log({data})
    }
</script>
@endsection