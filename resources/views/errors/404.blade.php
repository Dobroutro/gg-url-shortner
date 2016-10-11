<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Error 404</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">     
  </head>

  <body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="error-template text-center">
                    <h1 class="top-buffer">
                        Oops!</h1>
                    <h2 class="top-buffer">
                        404 Not Found</h2>
                    <div class="error-details top-buffer">
                        Sorry, an error has occured, Requested page not found!
                    </div>
                    <div class="error-actions top-buffer">
                        <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                          <span class="fa fa-home"></span>
                          Take Me Home 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </body>
</html>
