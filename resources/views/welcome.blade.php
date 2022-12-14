<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>header</h1>
    <a href="{{ url("jobs") }}">Post Job</a>
  </body>
  <script>
    window.onload = function(){
      document.loaction.href = "{{ url('/jobs') }}";
    };
  </script>
</html>
