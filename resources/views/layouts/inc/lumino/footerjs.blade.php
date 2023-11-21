<script src="{{ asset('lumino/js/jquery-1.11.1.min.js') }}"></script>

<script src="{{ asset('lumino/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('lumino/js/chart.min.js') }}"></script>
<script src="{{ asset('lumino/js/chart-data.js') }}"></script>
<script src="{{ asset('lumino/js/easypiechart.js') }}"></script>
<script src="{{ asset('lumino/js/easypiechart-data.js') }}"></script>
<script src="{{ asset('lumino/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('lumino/js/custom.js?v='.uniqid()) }}"></script>
<script src="{{ asset('lumino/vendors/summernote/summernote.js') }}"></script>
<script type="text/javascript">
let $role = "{{ $role }}";
let site = "{{ url('/') }}";
$(document).ready(function(){
  $('.summernote_editor').summernote();
  $('.summernote_editor_small').summernote({height:250});
});

</script>
