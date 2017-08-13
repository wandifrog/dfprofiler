<!DOCTYPE html>
<html lang="en">
  {{ partial('partials/head') }}
  <body>
    {{ partial('partials/navbar') }}
    {{ content() }}
    {{ partial('partials/footer', ['js': js is defined ? js : null]) }}
  </body>
</html>
