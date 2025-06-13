<div class="modal fade" id="modalQr" tabindex="-1" aria-labelledby="exampleModalEditarDirectivo"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalEditarDirectivo">Escanear el Qr</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="qrFormCreate" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Imagen del Qr<strong class="required"></strong></label>
                            <div class="text-center">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    id="profileImage">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-250px h-250px image-input-placeholder"></div>
                                    <div class="mt-5">
                                        <div class="">
                                            <button id="download-qr" onclick="downloadQr(event)" type="submit"
                                                class="btn btn-sm btn-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path fill="currentColor"
                                                        d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                                                </svg>
                                                Descargar Qr
                                            </button>
                                        </div>
                                    </div>
                                    <span style="display: none;" id="loadingQrModalVerificar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-dasharray="16" stroke-dashoffset="16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c4.97 0 9 4.03 9 9"><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s" values="16;0"/><animateTransform attributeName="transform" dur="1.5s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg> <strong style="margin-top: 10px"> Una vez realizado el pago recargar la pagina</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer con botones -->
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                        style="padding: 10px 20px; border-radius:20px;">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-success btn-sm"
                        style="padding: 10px 20px; border-radius:20px;">
                        Eliminar y crear uno nuevo
                    </button>
                </div> --}}
            </form>
        </div>
    </div>
</div>