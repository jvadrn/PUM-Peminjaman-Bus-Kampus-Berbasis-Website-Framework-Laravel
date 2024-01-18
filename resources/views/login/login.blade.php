<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <!-- Main Content -->
    <div class="container1 ">
        <div class="row main-content bg-success text-center">
            <div class="col-md-4 text-center company__info">
                <span class="company__logo"><h2><span class="fa fa-android"></span></h2></span>
                <img src="assets/img/busnela.png" alt="" class="mx-auto" height="180" width="300">
            </div>
            <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
                <div class="container">
                    <div class="row">
                        <h2>L O G I N</h2>
                    </div>
                    <div class="row">
                        <form action="{{ route('loginPost') }}" method="POST" id="loginForm">
                            @csrf
                            <div class="row">
                                <input type="text" name="npm" id="npm" class="form__input" placeholder="NPM">
                            </div>
                            <div class="row">
                                <input type="password" name="password" id="password" class="form__input" placeholder="Password">
                            </div>
                            <div class="row">
                                <input type="submit"  value="Login"  class="btn1 ">
                            </div>
                            <div class="row mb-3 mt-2">
                                <a href="" class="text">Lupa Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ini untuk local Storage --}}
    <!-- ... Bagian HTML sebelumnya ... -->
    <script>
       document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const npmValue = document.getElementById('npm').value;
    const passwordValue = document.getElementById('password').value;

    fetch("{{ route('loginPost') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ npm: npmValue, password: passwordValue }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // ... (kode lainnya)
            localStorage.setItem('user_id', data.additional_data.user_id);
                    localStorage.setItem('id_role', data.additional_data.id_role);
                    localStorage.setItem('isLoggedIn', 'true');
                    localStorage.setItem('npm', data.additional_data.npm);
                    localStorage.setItem('name', data.additional_data.name);
    
                    // Hanya menyimpan data yang sesuai untuk admin
                    if (data.additional_data.isAdmin) {
                        localStorage.setItem('isAdmin', 'true');
                    } else {
                        // Menyimpan data tambahan untuk non-admin
                        localStorage.setItem('id_major', data.additional_data.id_major);
                        localStorage.setItem('prodi', data.additional_data.prodi);
                        localStorage.setItem('major_name', data.additional_data.major_name);
                        localStorage.setItem('isUser', 'true');
                    }
            // Redirect ke rute yang sesuai berdasarkan peran (role)
            if (data.additional_data.isAdmin) {
                window.location.href = "{{ route('Admin.index') }}";
            } else {
                window.location.href = "{{ route('dashboard.index') }}";
            }
        } else {
            // Menampilkan SweetAlert untuk pesan kesalahan
            Swal.fire({
                icon: 'error',
                title: 'Login failed',
                text: data.error || 'An error occurred during login.',
            });
        }
    })
    .catch(error => {
        // Menampilkan SweetAlert untuk kesalahan fetch
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while processing your request.',
        });
        console.error('Error:', error);
    });
});

    </script>
    
    

<!-- ... Bagian HTML setelahnya ... -->

	
    {{-- end --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if($message = Session::get('error'))
    <script>
        Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
        footer: '<a href="#">Why do I have this issue?</a>'
        });
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
