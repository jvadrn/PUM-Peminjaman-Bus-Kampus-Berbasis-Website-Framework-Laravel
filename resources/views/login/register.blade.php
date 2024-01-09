<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.querySelector('form[action="{{ route('registerPost') }}"]');
    
            registerForm.addEventListener('submit', async function(event) {
                event.preventDefault();
    
                // Mendapatkan data dari formulir registrasi
                const formData = new FormData(registerForm);
    
                // Mengirim formulir registrasi ke server menggunakan Fetch API atau metode lainnya
                try {
                    const response = await fetch("{{ route('registerPost') }}", {
                        method: 'POST',
                        body: formData,
                        // Jika perlu menambahkan header tertentu, seperti headers: { 'Content-Type': 'application/json' }
                    });
    
                    if (response.ok) {
                        // Registrasi berhasil, Anda dapat mengambil data pengguna dari respons server
                        const userData = await response.json();
    
                        // Menyimpan data pengguna di local storage
                        localStorage.setItem('userData', JSON.stringify(userData));
    
                        // Redirect atau lakukan langkah berikutnya setelah registrasi
                        // ...
    
                        // Contoh: Redirect ke halaman dashboard setelah registrasi berhasil
                        window.location.href = "{{ route('register') }}";
                    } else {
                        // Registrasi gagal, mungkin ada kesalahan pada sisi server
                        console.error('Registrasi gagal:', response.statusText);
                    }
                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        });
    </script> --}}
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Register</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if ($errors->has('npm'))
                        <div class="alert alert-danger">{{ $errors->first('npm') }}</div>
                    @endif
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                    @endif
                    @if ($errors->has('npm'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                    @endif
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                    @endif
                    @if ($errors->has('npm'))
                    <div class="alert alert-danger">{{ $errors->first('prodi') }}</div>
                    @endif
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">{{ $errors->first('id_major') }}</div>
                    @endif
                    @if ($errors->has('npm'))
                    <div class="alert alert-danger">{{ $errors->first('class_year') }}</div>
                    @endif

                    <form action="{{ route('registerPost') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="npm" class="form-label">NPM</label>
                            <input type="text" name="npm" class="form-control" id="npm" placeholder="21753017" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <input type="text" name="prodi" class="form-control" id="prodi" placeholder="John Doe" required>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="id_major">
                                <option selected>Pilih Jurusan</option>
                                @foreach ($majors as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="class_year" class="form-label">Tahun Angkatan</label>
                            <input type="text" name="class_year" class="form-control" id="class_year" placeholder="2020" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>