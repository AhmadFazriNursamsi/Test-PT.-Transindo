<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tiket</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Form Pesan Tiket</h3></div>
                                    <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form  method="post" action="/tiket/create" name="tiketss">
                                                @csrf
                                                <div class="form-floating mb-3">
                                                    <input required class="form-control" name="nama" autocomplete="off" id="nama" type="text" placeholder="Nama" />
                                                    <label for="nama">Nama</label>
                                                </div>
                                            <div class="form-floating mb-3">
                                                <input required class="form-control" id="email" name="email" type="email" autocomplete="off" placeholder="name@example.com" />
                                                <label for="email">Email address</label>
                                            </div>
                                  
                                                <div class="form-floating mb-3">
                                                <select required name="jk" class="form-control input-sm" id="jk" >
                                                    <option value="">-- Jenis Kelamin --</option>
                                                    <option value="laki-laki">Laki-laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                                    <label for="jk">Jenis Kelamin</label>
                                                </div>
                        
                                            <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                                <button type="submit"class="btn btn-primary form-control ">Save</button>
                                            </div class="md-3">
                                            <a href="{{ url('/') }}" class="btn mt-3 btn-secondary form-control">Go Home</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>