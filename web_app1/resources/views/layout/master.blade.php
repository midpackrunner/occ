<!-- Stored in resources/views/layouts/master.blade.php -->

<html>
    <head>
        <title>@yield('title')</title>
         <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

         <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
           <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
           <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

    <script src="js/jQuery.1.12.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
      <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
      <script>
      webshims.setOptions('forms-ext', {types: 'date'});
      webshims.polyfill('forms forms-ext');
      $.webshims.formcfg = {
      en: {
          dFormat: '-',
          dateSigns: '-',
          patterns: {
              d: "mm-dd-yy"
          }
      }
      };
      </script>
    </body>
</html>