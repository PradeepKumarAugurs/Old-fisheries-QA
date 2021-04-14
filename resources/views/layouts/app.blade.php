<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" >
      @yield('title')
      @include('includes.head_css')
  </head>
  <body class="wysihtml5-supported skin-blue"  >
      @include('includes.header')
      @include('includes.sidebar')

      @yield('content')
      
      @include('includes.footer')
    
      @include('includes.footer_script')

      @yield('customjs')

  </body>
</html>