let mix = require('laravel-mix');

mix.js(['resources/assets/js/app.js','./public/js/js/jquery-2.1.1.js','./public/js/js/bootstrap.min.js','./public/js/js/plugins/metisMenu/jquery.metisMenu.js',
   './public/js/js/plugins/slimscroll/jquery.slimscroll.min.js'], 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles(['./public/css/css/style.css', './public/css/css/bootstrap.css','./public/css/css/animate.css','./public/css/css/plugins/ladda/ladda-themeless.min.css',
   './public/css/css/plugins/datapicker/datepicker3.css','./public/css/css/plugins/clockpicker/clockpicker.css','./public/css/css/plugins/chosen/chosen.css',
   './public/css/css/plugins/sweetalert/sweetalert.css','./public/css/font-awesome/css/font-awesome.min.css','./public/css/css/plugins/toastr/toastr.min.css'],'public/css/app.css')
   .disableNotifications();
mix.browserSync('http://localhost:8000');


//
// .scripts(['./public/js/js/jquery-2.1.1.js','./public/js/js/bootstrap.min.js','./public/js/js/plugins/metisMenu/jquery.metisMenu.js',
//     './public/js/js/plugins/slimscroll/jquery.slimscroll.min.js','./public/js/js/plugins/sweetalert/sweetalert.min.js','./public/js/js/plugins/flot/jquery.flot.js',
//     './public/js/js/inspinia.js','./public/js/js/plugins/pace/pace.min.js','./public/js/js/plugins/datapicker/bootstrap-datepicker.js','./public/js/js/plugins/datapicker/bootstrap-datepicker.js',
//     './public/js/js/plugins/ladda/ladda.min.js','./public/js/js/plugins/ladda/ladda.jquery.min.js'], 'public/js')
