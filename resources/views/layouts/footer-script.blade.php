<!-- JAVASCRIPT -->
<script src="{{ URL::asset('libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('libs/node-waves/node-waves.min.js')}}"></script>


@yield('script')

<!-- App js -->
<script src="{{ URL::asset('js/app.min.js')}}"></script>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description-ckeditor');
    CKEDITOR.replace('edit-description-ckeditor');
</script>

@yield('script-bottom')
