<!--begin::Javascript-->
<script>
    var hostUrl = "/metronic/assets/";
</script>
{{-- <!--CK EDITOR-->
<script src="{{ asset('node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script> --}}
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('metronic/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('metronic/assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('metronic/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('metronic/assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('metronic/assets/js/custom/utilities/modals/users-search.js') }}"></script>
<!---toold-->

<!--end::Page Custom Javascript-->
<!--pdf--->
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<!--Excel-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

{{-- Animate loading menu --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.0/lottie.min.js"></script>
<!--end::Javascript-->
<script>
    $(document).ready(function() {
        // Inicializa manualmente todos los tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        // LoadingAnimado();
    });
    function LoadingAnimado() {
        console.log('Cargando animacion');
        $('#loadingAnimated').css('display', 'flex'); // Mostrar overlay
        lottie.loadAnimation({
            container: document.getElementById('lottieLoader'), // Contenedor de la animación
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/animate/menuAnimate.json' // Ruta al archivo JSON de tu animación Lottie
        });
    }

    function LoadingAnimadoHiden() {
        console.log('Ocultando animacion');
        $('#loadingAnimated').css('display', 'none');
        $('#lottieLoader').html(''); // Limpiar el contenedor para que no se duplique si vuelves a cargar
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    $('select[name="idcondominio_header"]').on('change', function() {
        actualizarCondominioActual($(this).val());
    });

    function actualizarCondominioActual(condominioSeleccionado) {
        $.ajax({
            type: "POST",
            url: "{{ url('admin/actualizar/condominioactual') }}",
            data: {
                condominio_id: condominioSeleccionado,
                _token: "{{ csrf_token() }}"
            },
            dataType: 'json',
            success: function(response) {
                //console.log(response);
                if (response.Codigo == 0) {

                    window.location.href = window.location.href;

                } else {
                    toastr.error(response.mensaje, 'Ocurrio un error!');
                    toastr.options.closeDuration = 10000;
                    toastr.options.timeOut = 10000;
                    toastr.options.extendedTimeOut = 10000;
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    toastr.error(value[0], 'Datos invalidos!');
                    toastr.options.closeDuration = 10000;
                    toastr.options.timeOut = 10000;
                    toastr.options.extendedTimeOut = 10000;
                });
            }
        });
    }

    function mostrarLoading() {
        $('#loading').css('display', 'flex');
    }

    function ocultarLoading() {
        $('#loading').css('display', 'none');
    }

    function successfull(title, text = '') {
        Swal.fire({
            icon: 'success',
            title: title,
            text: text,
        })
    }

    function confirmar(callback = null, text = '', title = "Estas seguro?") {
        Swal.fire({
            icon: 'info',
            title: title,
            text: text,
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: "Cancelar",
        }).then(function(result) {
            if (callback && result.isConfirmed && typeof callback === 'function') {
                callback(result);
            }
        });
    }

    function swalError(title, text = '') {
        Swal.fire({
            icon: 'error',
            title: title,
            text: text,
        })
    }

    //funcion para saber el tipo de archivo 
    function readDocumento(input, i) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            console.log(file.name);
            const indice = file.name.lastIndexOf('.');
            const extension = file.name.substring(indice + 1).toLowerCase();

            // Reset all display elements
            $('#image-upload-wrap' + i).hide();
            $('#pdfTitulo' + i).hide();
            $('#file-upload-content' + i).show();
            $('#file-upload-image' + i).hide();
            $('#file-upload-video' + i).hide();
            $('#file-upload-pdf' + i).hide();

            if ($.inArray(extension, ['jpg', 'jpeg', 'png']) !== -1) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    const result = e.target.result;
                    $('#file-upload-image' + i).attr('src', result).show();
                }
                reader.readAsDataURL(file);
            } else if ($.inArray(extension, ['mp4', 'avi', 'mov']) !== -1) {
                const videoURL = URL.createObjectURL(file);
                $('#file-upload-video-source' + i).attr('src', videoURL);
                $('#file-upload-video' + i).show()[0].load();
            } else if ($.inArray(extension, ['pdf']) !== -1) {
                const pdfURL = URL.createObjectURL(file);
                // Reemplazar "http" con "https" en la URL del PDF
                //const httpsPDFURL = pdfURL.replace('http:', 'https:');
                $('#file-upload-pdf' + i).attr('src', pdfURL).show();
                if (isMobile()) {
                    $('#file-upload-pdf' + i).hide();
                    $('#file-upload-image' + i).attr('src',
                        'https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg');
                    $('#pdfTitulo' + i).text(file.name);
                    $('#pdfTitulo' + i).show();
                    $('#file-upload-image' + i).show();
                }
            } else {
                removeDocumento(i);
            }
        }
    }

    function isMobile() {
        return $(window).width() <= 768;
    }

    function removeDocumento(i) {
        $('#file-upload-input' + i).val('');
        $('#file-upload-content' + i).hide();
        $('#file-upload-image' + i).attr('src', '#').hide();
        $('#file-upload-video' + i).attr('src', '#').hide();
        $('#file-upload-video-source' + i).attr('src', '');
        $('#file-upload-pdf' + i).attr('src', '').hide();
        $('#image-upload-wrap' + i).show();
    }


    readURL = function(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-upload-wrap' + i).hide();
                $('#file-upload-image' + i).attr('src', e.target.result);
                $('#file-upload-content' + i).show();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload();
        }
    }
    //para subir muchos documentos
    readURLAll = function(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var fileType = input.files[0].type;
            var fileName = input.files[0].name;
            var fileUploadImage = $('#file-upload-image' + i);
            
            reader.onload = function(e) {
                $('#image-upload-wrap' + i).hide();
                var iconSrc = getIconSrc(fileType, fileName);
                fileUploadImage.attr('src', iconSrc);
                $('#file-upload-content' + i).show();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload(i);
        }
    }

    function getIconSrc(fileType, fileName) {
        var iconSrc = '';
        if (fileType.includes('image')) {
            iconSrc = e.target.result; // Display image directly
        } else if (fileType.includes('pdf')) {
            iconSrc = 'https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg'; // Change this to the actual path of your PDF icon
        } else if (fileType.includes('excel') || fileName.endsWith('.xls') || fileName.endsWith('.xlsx')) {
            iconSrc = 'https://w7.pngwing.com/pngs/162/301/png-transparent-microsoft-excel-logo-thumbnail.png'; // Change this to the actual path of your Excel icon
        } else if (fileType.includes('word') || fileName.endsWith('.doc') || fileName.endsWith('.docx')) {
            iconSrc = 'https://w7.pngwing.com/pngs/21/624/png-transparent-word-hd-logo-thumbnail.png'; // Change this to the actual path of your Word icon
        } else if (fileType.includes('presentation') || fileName.endsWith('.ppt') || fileName.endsWith('.pptx')) {
            iconSrc = 'https://cdn.worldvectorlogo.com/logos/microsoft-powerpoint-2013.svg'; // Change this to the actual path of your PowerPoint icon
        } else {
            iconSrc = 'https://w7.pngwing.com/pngs/920/747/png-transparen…ip-computer-icons-zip-miscellaneous-text-logo.png'; // Change this to the actual path of your default icon
        }
        return iconSrc;
    }

    removeUpload = function(i) {
        $('#file-upload-input' + i).replaceWith($('#file-upload-input' + i).clone());
        $('#file-upload-content' + i).hide();
        $('#image-upload-wrap' + i).show();
        $('#file-upload-input' + i).val('');
        $('#image-upload-wrap' + i).removeClass('image-dropping');
        //$('#file-upload-input' + i).prop('required', true);
    }
    //excel
    readExcel = function(input, i) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-upload-wrap' + i).hide();
                $('#file-upload-image' + i).attr('src', 'https://w7.pngwing.com/pngs/162/301/png-transparent-microsoft-excel-logo-thumbnail.png');
                $('#file-upload-content' + i).show();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload();
        }
    }

    function getFileType(fileExtension) {
        var fileType = '';
        switch(fileExtension) {
            case 'png':
            case 'jpg':
            case 'jpeg':
            case 'gif':
                fileType = 'image';
                break;
            case 'pdf':
                fileType = 'application/pdf';
                break;
            case 'xls':
            case 'xlsx':
                fileType = 'application/vnd.ms-excel';
                break;
            case 'doc':
            case 'docx':
                fileType = 'application/msword';
                break;
            case 'ppt':
            case 'pptx':
                fileType = 'application/vnd.ms-powerpoint';
                break;
            default:
                fileType = 'application/octet-stream';
        }
        return fileType;
    }

    $('#image-upload-wrap').bind('dragover', function() {
        $('#image-upload-wrap' + i).addClass('image-dropping');
    });

    $('#image-upload-wrap').bind('dragleave', function() {
        $('#image-upload-wrap' + i).removeClass('image-dropping');
    });
    $('#image-upload-wrap2').bind('dragover', function() {
        $('#image-upload-wrap' + i).addClass('image-dropping');
    });

    $('#image-upload-wrap2').bind('dragleave', function() {
        $('#image-upload-wrap' + i).removeClass('image-dropping');
    });

    //password
    function ocultarOMostrarPassword(){
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('passwordField');

        togglePassword.addEventListener('click', function() {
            // Toggle password type between "password" and "text"
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Change eye icon class between "eye" and "eye-slash"
            this.classList.toggle('fa-eye');
        });
    }
    //iniciar los select de los modal
    function iniciarSelectModal(modalId, selectId) {
        $('#' + selectId).select2({
            dropdownParent: $('#' + modalId)
        });
    }
</script>
@stack('scripts')
