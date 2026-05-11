<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Experience</title>
    @vite(['resources/css/edit_style.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="edit-container" style="background: url('{{ asset('img/profile_bg.png') }}') no-repeat center center/cover;">
        
        <div class="top-right">
            <a href="#" class="btn-settings">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </div>

        <h1 class="edit-header">Edit Your Vacation Experiences Information</h1>

        <div class="glass-card">
            <form action="{{ url('/experience/update/'.$experience->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="input-group">
                    <label>New Title</label>
                    <input type="text" name="Title" value="{{ $experience->Title }}" required>
                </div>

                <div class="input-group">
                    <label>New Description</label>
                    <textarea name="Description" required>{{ $experience->Description }}</textarea>
                </div>

                <div class="input-group">
                    <label>Add New Tag</label>
                    <input type="text" name="Tag" value="{{ $experience->Tag }}">
                </div>

                <div class="input-group">
                    <label>Upload your New image</label>
                    <input type="file" name="image" accept="image/*">
                    <small style="color: white; font-size: 0.7rem;">*Biarkan kosong jika tidak ingin mengubah gambar</small>
                </div>

                <button type="submit" class="btn-save">SAVE</button>
            </form>
        </div>

        <div class="bottom-left">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Log Out</button>
            </form>
        </div>

    </div>

</body>
</html>