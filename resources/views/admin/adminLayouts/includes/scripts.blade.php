<script src="{{asset('public/adminpanel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('public/adminpanel/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('public/adminpanel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- apps -->
<script src="{{asset('public/adminpanel/dist/js/app.min.js')}}"></script>
<script src="{{asset('public/adminpanel/dist/js/app.init.js')}}"></script>
<script src="{{asset('public/adminpanel/dist/js/app-style-switcher.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('public/adminpanel/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('public/adminpanel/assets/extra-libs/sparkline/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('public/adminpanel/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('public/adminpanel/dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('public/adminpanel/dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<!--chartis chart-->
<script src="{{asset('public/adminpanel/assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('public/adminpanel/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!--c3 charts -->
<script src="{{asset('public/adminpanel/assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{asset('public/adminpanel/assets/extra-libs/c3/c3.min.js')}}"></script>
<!--chartjs -->
<script src="{{asset('public/adminpanel/assets/libs/raphael/raphael.min.js')}}"></script>
<script src="{{asset('public/adminpanel/assets/libs/morris.js/morris.min.js')}}"></script>

<script src="{{asset('public/adminpanel/dist/js/pages/dashboards/dashboard1.js')}}"></script>

<script src="{{asset('public/adminpanel/assets/libs/summernote/dist/summernote-bs4.min.js')}}"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    /************************************/
    //default editor
    /************************************/
    $('.summernote').summernote({
        height: 350, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false // set focus to editable area after initializing summernote
    });

    /************************************/
    //inline-editor
    /************************************/
    $('.inline-editor').summernote({
        airMode: true
    });

    /************************************/
    //edit and save mode
    /************************************/
    window.edit = function() {
        $(".click2edit").summernote()
    },
        window.save = function() {
            $(".click2edit").summernote('destroy');
        }

    var edit = function() {
        $('.click2edit').summernote({ focus: true });
    };

    var save = function() {
        var markup = $('.click2edit').summernote('code');
        $('.click2edit').summernote('destroy');
    };

    /************************************/
    //airmode editor
    /************************************/
    $('.airmode-summer').summernote({
        airMode: true
    });
</script>

<script>
    $( function() {
        $( "#datepicker" ).datepicker({minDate: 0});
    } );
</script>

@yield('script')
