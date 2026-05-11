<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Your Experience</title>
    @vite(['resources/css/share_style.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="share-container" style="background: url('{{ asset('img/shareExperience_bg.png') }}') no-repeat center center/cover;">
        
        <div class="navbar">
            <a href="{{ url('/profile') }}" class="btn-profile">
                <i class="fa-solid fa-user"></i> My Profile
            </a>
        </div>

        <div class="glass-card">
            <form action="{{ url('/share-experience') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="input-group">
                    <label>Title</label>
                    <input type="text" name="Title" required>
                </div>

                <div class="input-group">
                    <label>Description</label>
                    <textarea name="Description" required></textarea>
                </div>

                <div class="input-group">
                    <label>Add Tag</label>
                    <input type="text" name="Tag" placeholder="#nature, #beach...">
                </div>

                <div class="input-group">
                    <label>Upload your image</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>

                <button type="submit" class="btn-save">SAVE</button>
            </form>
        </div>

    </div>

</body>
</html>