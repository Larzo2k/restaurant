<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
@if ($configuracion->logotipo!="")
  <link rel="shortcut icon" href="{{$configuracion->favicon}}" />
@else
  <link rel="shortcut icon" href="{/metronic/assets/media/logos/favicon.ico" />
@endif
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Page Vendor Stylesheets(used by this page)-->
<link href="{{asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Page Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{asset('metronic/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('metronic/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('/css/file-upload.css')}}">
<!--end::Global Stylesheets Bundle-->
<!--FONTAWESOME-->
<script src="https://kit.fontawesome.com/e2c73ec39d.js" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script><!--CK EDITOR-->
@stack('styles')
@stack('javascripts')