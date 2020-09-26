{{-- @push('select2') --}}
    <link href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/> 
    <link href="{{ asset('dashboard/plugins/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet"/> 
    <script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js') }}"></script> 
    <script>
      $(function () {
        $('select').select2();
      })
    </script>

    <style>
      .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        border-color: #006fe6;
        color: #fff;
        padding: 0 10px;
        margin-top: .31rem;
      }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
      color: #fff;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 16px;
    }
    </style>
{{-- @endpush --}}
