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
                        
                        <button type="submit" class="btn btn-primary mt-5" onclick="P()">Agregar Imagen</button>
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
            // titulo: document.getElementById('titulo_photo').value,
            // descripcion: document.getElementById('descripcion_photo').value,
            // privado: document.getElementById('privado').value,
            // tags: document.getElementById('Tags_photo').value,
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
        location.href = "/home"
    }
</script>
@endsection