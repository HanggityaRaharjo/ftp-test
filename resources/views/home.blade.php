<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Transfer File FTP</title>
    <link href="{{ asset('css') }}/styles.css" rel="stylesheet" />
    <!-- <link href="css/cubex.css" rel="stylesheet" /> -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js') }}/jquery.3.5/jquery.3.5.js" crossorigin="anonymous"></script>
    <style>
        .loader {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: start;
            -ms-flex-pack: start;
            justify-content: flex-start;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            width: 200px;
            height: 15px;
            background-color: rgb(240, 240, 240);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            margin-top: 15px;
        }

        .shape {
            width: 50px;
            height: 15px;
            background-image: linear-gradient(144deg,
                    #1f64ef,
                    #5345eb 50%,
                    #2851cd);
            border-radius: 25px;
            position: absolute;
            -webkit-animation: slide 1.9s linear infinite;
            animation: slide 1.9s linear infinite;
            background-size: 200%;
        }

        @-webkit-keyframes slide {
            0% {
                left: 0;
            }

            50% {
                left: calc(100% - 50px);
            }

            100% {
                left: 0;
            }
        }

        @keyframes slide {
            0% {
                left: 0;
            }

            50% {
                left: calc(100% - 50px);
            }

            100% {
                left: 0;
            }
        }

        @-webkit-keyframes gradientChange {

            0%,
            100% {
                background-image: linear-gradient(144deg,
                        #af40ff,
                        #5b42f3 50%,
                        #00ddeb);
            }

            50% {
                background-image: linear-gradient(144deg,
                        #00ddeb,
                        #5b42f3 50%,
                        #af40ff);
            }
        }

        @keyframes gradientChange {

            0%,
            100% {
                background-image: linear-gradient(144deg,
                        #af40ff,
                        #5b42f3 50%,
                        #00ddeb);
            }

            50% {
                background-image: linear-gradient(144deg,
                        #00ddeb,
                        #5b42f3 50%,
                        #af40ff);
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <div class="navbar-brand" id="navbarbrand"></div>
        <!-- <a class="navbar-brand" href="index.html">Start Bootstrap</a> -->
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <div id="navbarsearch" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
        <!-- Navbar-->
        <div id="navbarnav" class="navbar-nav ml-auto ml-md-0"></div>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu" id="sidebarmenu">
                    <p>Sidebar Menu</p>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <!-- Breadcrumbs -->
                    <h1 class="mt-4">Transfer File FTP</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Transfer File FTP</li>
                    </ol>
                    <!-- End Breadcrumbs -->
                    <!-- Main Content -->
                    <div>

                        <div class="d-flex justify-content-between">

                            <div class="d-flex align-items-center" style="gap: 5px">
                                <span>Path : </span>
                                <div class="btn btn-primary text-light px-2 rounded" id="root-path">
                                    <span>/var</span>
                                    <span>/www</span>
                                </div>
                            </div>

                            <div class="d-flex" style="gap:5px">
                                <button class="btn btn-primary" disabled>Edit</button>
                                <button class="btn btn-primary" disabled>Delete</button>
                                <button class="btn btn-primary">Create Folder</button>
                            </div>
                        </div>

                        <div class="card position-relative mb-3 mt-3">


                            <div class="card-body row" id="ftp-content" style="height: 250px;overflow-y: scroll;">
                                {{-- Loader --}}
                                <div class="col-md-12" style="width:100%;height: 250px">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                                        <div class="spinner-border" role="status" id="loader">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Loader --}}
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <!-- Form -->
                                <form id="form-submit" enctype="multipart/form-data"
                                    action="http://localhost:8000/api/file-transfer" method="POST">
                                    <div class="row">
                                        <!-- Code -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="code">Code</label>
                                                <input type="text" class="form-control" id="code"
                                                    aria-describedby="emailHelp" placeholder="Code" name="code" />
                                            </div>
                                        </div>
                                        <!-- End Code -->
                                        <!-- Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="emailHelp" placeholder="name" name="name" />
                                            </div>
                                        </div>
                                        <!-- End Name -->
                                        <!-- Description -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Description">Description</label>
                                                <textarea cols="30" rows="2" class="form-control" id="Description" aria-describedby="emailHelp"
                                                    placeholder="Description" name="description"></textarea>
                                            </div>
                                        </div>
                                        <!-- End Description -->

                                        <!-- Host -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Host</label>
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="emailHelp" placeholder="name" name="name" />
                                            </div>
                                        </div>
                                        <!-- End Host -->

                                        <!-- Username -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Username</label>
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="emailHelp" placeholder="name" name="name" />
                                            </div>
                                        </div>
                                        <!-- End Username -->

                                        <!-- Password -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Password</label>
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="emailHelp" placeholder="name" name="name" />
                                            </div>
                                        </div>
                                        <!-- End Password -->

                                        <!-- Port -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="name">Port</label>
                                                <input type="text" class="form-control" id="name"
                                                    aria-describedby="emailHelp" placeholder="name" name="name" />
                                            </div>
                                        </div>
                                        <!-- End Port -->
                                        <!-- Port -->
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="name">Action</label>
                                                <button type="button" class="btn btn-primary">Connect</button>
                                            </div>
                                        </div>
                                        <!-- End Port -->

                                        <!-- Source -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="source">Source</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="file-upload" name="file" />
                                                        <label class="custom-file-label" for="file-upload">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Source -->

                                    </div>

                                    <button type="submit" class="btn btn-primary" id="submit">
                                        Submit
                                    </button>
                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        Launch static backdrop modal
                                    </button> --}}
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>



                    </div>
                    <!-- End Main Content -->

                    <!-- Modal -->
                    <!-- Button trigger modal -->

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                        Transfering...
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-around align-items-center">
                                        <div class="text-center">
                                            <img src="https://th.bing.com/th/id/R.0f8c4215e4ac0fa2432932e5c11a3850?rik=lpolgeG2lIZx%2bQ&riu=http%3a%2f%2fpngimg.com%2fuploads%2ffolder%2ffolder_PNG8773.png&ehk=KiuqKNjbpm19CNf0Xkol%2fSWohijrYGRZPubwHbWSazA%3d&risl=&pid=ImgRaw&r=0"
                                                alt="" width="70px" />
                                            <h5 class="m-0">Data</h5>
                                        </div>
                                        <div class="loader">
                                            <div class="shape"></div>
                                        </div>
                                        <div class="text-center">
                                            <img src="https://th.bing.com/th/id/R.0f8c4215e4ac0fa2432932e5c11a3850?rik=lpolgeG2lIZx%2bQ&riu=http%3a%2f%2fpngimg.com%2fuploads%2ffolder%2ffolder_PNG8773.png&ehk=KiuqKNjbpm19CNf0Xkol%2fSWohijrYGRZPubwHbWSazA%3d&risl=&pid=ImgRaw&r=0"
                                                alt="" width="70px" />
                                            <h5 class="m-0">Destination</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto" id="footer"></footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js') }}/scripts.js"></script>
    <script>
        let current_path = ['var', 'www']
    </script>

    <script>
        const Loader = () => (`
            <div class="col-md-12" style="width:100%;height: 250px">
                <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                        <div class="spinner-border" role="status" id="loader">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        `)
        const GetAllContentFtp = () => {
            $.ajax({
                    method: "GET",
                    url: "http://localhost:8000/api/ftp-root",
                })
                .done(function(data) {
                    console.log(data);
                    let element = ''
                    data.folder.map((item) => {
                        element +=
                            `
                            <div class="col-md-3" >
                                <button type="button" class="d-flex align-items-center" style="gap:5px;height:50px;background:transparent;border:none" onclick="ShowFolder('${item}')">
                                    <img src="https://th.bing.com/th/id/R.0f8c4215e4ac0fa2432932e5c11a3850?rik=lpolgeG2lIZx%2bQ&riu=http%3a%2f%2fpngimg.com%2fuploads%2ffolder%2ffolder_PNG8773.png&ehk=KiuqKNjbpm19CNf0Xkol%2fSWohijrYGRZPubwHbWSazA%3d&risl=&pid=ImgRaw&r=0" alt="" height="40px" />
                                    <p class="m-0">${item}</p>    
                                </button>
                            </div>
                            `
                    })
                    data.files.map((item) => {
                        element +=
                            `
                            <div class="col-md-3" >
                                <div class="d-flex align-items-center" style="gap:5px;height:50px;background:transparent;border:none">
                                    <img src="https://icon-library.com/images/document-icon-png/document-icon-png-17.jpg" alt="" height="40px" />
                                    <p class="m-0">${item}</p>    
                                </div>
                            </div>
                            `
                    })

                    $('#ftp-content').html(element)
                });
        }
        GetAllContentFtp()

        const ShowFolder = (path) => {
            let loader = Loader();
            $('#ftp-content').html(loader)
            current_path.push(path)
            $.ajax({
                    method: "POST",
                    url: "http://localhost:8000/api/ftp-content",
                    data: {
                        current_path: current_path
                    },
                })
                .done(function(data) {
                    console.log(data);
                    $('#root-path').append(`<span>/${path}</span>`)
                    let element = ''



                    data.folder.map((item) => {
                        element +=
                            `
                            <div class="col-md-3" >
                                <button type="button" class="d-flex align-items-center" style="gap:5px;height:50px;background:transparent;border:none" onclick="ShowFolder('${item}')">
                                    <img src="https://th.bing.com/th/id/R.0f8c4215e4ac0fa2432932e5c11a3850?rik=lpolgeG2lIZx%2bQ&riu=http%3a%2f%2fpngimg.com%2fuploads%2ffolder%2ffolder_PNG8773.png&ehk=KiuqKNjbpm19CNf0Xkol%2fSWohijrYGRZPubwHbWSazA%3d&risl=&pid=ImgRaw&r=0" alt="" height="40px" />
                                    <p class="m-0">${item}</p>    
                                </button>
                            </div>
                            `
                    })
                    data.files.map((item) => {
                        element +=
                            `
                            <div class="col-md-3" >
                                <div class="d-flex align-items-center" style="gap:5px;height:50px;background:transparent;border:none">
                                    <img src="https://icon-library.com/images/document-icon-png/document-icon-png-17.jpg" alt="" height="40px" />
                                    <p class="m-0">${item}</p>    
                                </div>
                            </div>
                            `
                    })

                    $('#ftp-content').html(element)
                });
        }

        const BackFolder = (path) => {
            let loader = Loader();
            $('#ftp-content').html(loader)
            current_path.push(path)
            $.ajax({
                    method: "POST",
                    url: "http://localhost:8000/api/ftp-content",
                    data: {
                        current_path: current_path
                    },
                })
                .done(function(data) {
                    $('#root-path').append(`<span>/${path}</span>`)
                    let element = ''
                    data.folder.map((item) => {
                        element +=
                            `
                            <div class="col-md-3" >
                                <button type="button" class="d-flex align-items-center" style="gap:5px;height:50px;background:transparent;border:none" onclick="ShowFolder('${item}')">
                                    <img src="https://th.bing.com/th/id/R.0f8c4215e4ac0fa2432932e5c11a3850?rik=lpolgeG2lIZx%2bQ&riu=http%3a%2f%2fpngimg.com%2fuploads%2ffolder%2ffolder_PNG8773.png&ehk=KiuqKNjbpm19CNf0Xkol%2fSWohijrYGRZPubwHbWSazA%3d&risl=&pid=ImgRaw&r=0" alt="" height="40px" />
                                    <p class="m-0">${item}</p>    
                                </button>
                            </div>
                            `
                    })
                    data.files.map((item) => {
                        element +=
                            `
                            <div class="col-md-3" >
                                <div class="d-flex align-items-center" style="gap:5px;height:50px;background:transparent;border:none">
                                    <img src="https://icon-library.com/images/document-icon-png/document-icon-png-17.jpg" alt="" height="40px" />
                                    <p class="m-0">${item}</p>    
                                </div>
                            </div>
                            `
                    })

                    $('#ftp-content').html(element)
                });
        }
    </script>
</body>

</html>
