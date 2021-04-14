<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
      @yield('title')
      @include('auth::includes.head_css')
  </head>
  <body class="wysihtml5-supported skin-blue">
      @include('auth::includes.header')
      @include('auth::includes.sidebar')

      @yield('content')
      
      @include('auth::includes.footer')
    
      @include('auth::includes.footer_script')

      @yield('customjs')

  </body>
</html>