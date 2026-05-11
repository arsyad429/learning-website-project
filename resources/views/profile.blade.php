<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    @vite(['resources/css/profile_style.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="profile-container" style="background: url('{{ asset('img/profile_bg.png') }}') no-repeat center bottom/cover;">

        <div class="top-right">
            <a href="#" class="btn-settings">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </div>

        <div class="profile-header">
            <h1>Welcome! {{ Auth::user()->name }}</h1>
            <h2>My VacationExperiences</h2>
        </div>

        <div class="experiences-grid">
    
            @forelse ($experiences as $exp)
                <div class="experience-card">
                    <div class="img-container">
                        @if($exp->image_path)
                            <img src="{{ asset('storage/' . $exp->image_path) }}" alt="Experience Image" class="experience-img">
                        @else
                            <div class="img-placeholder">No Image</div>
                        @endif
                    </div>
    
                <h3 class="experience-title">{{ $exp->Title }}</h3>
    
                <div class="card-actions">
                        <a href="{{ url('/experience/edit/'.$exp->id) }}" class="btn-edit">Edit My Experience</a>

                        <form action="{{ url('/experience/delete/'.$exp->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengalaman ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                         </form>
                </div>
        </div>
            @empty
                <div class="empty-state">
                    <p>Anda belum membagikan pengalaman liburan anda.</p>
                    <a href="{{ url('/share-experience') }}" style="color: #ffffff; text-decoration: underline;">
                        Mulai bagikan sekarang!
                    </a>
                </div>
            @endforelse

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