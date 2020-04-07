@extends('layout.app')


@section('content')
<div style="top:100px;left:100px; " class="modal-body" id="modalbody">
    <div id="liensPDF" class="pdf-viewer-area pdf-single-pro">
        <a class="media" href="{{asset('comptes-univ-tlemcen.docx')}}"></a>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/pdf/jquery.media.js')}}"></script>
<script src="{{asset('js/pdf/pdf-active-1.js')}}"></script>
@endsection