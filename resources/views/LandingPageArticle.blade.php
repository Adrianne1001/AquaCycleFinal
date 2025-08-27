<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    @vite(['resources/css/Article.css','resources/css/HomePage.css'])
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('Landing Page')}}">
                <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                </ul>
                <a href="{{ route('register') }}" class="btn btn-brand ms-lg-3">Register</a>
                <a href="{{ route('login') }}" class="btn btn-light ms-2 " style="background-color:rgb(223, 229, 250);">Sign in</a>
            </div>
        </div>
    </nav>

    <article class="ad5-padding-y-lg">
        <header class="ad5-container ad5-max-width-xs ad5-margin-bottom-lg">
      
          <div class="ad5-flex ad5-justify-center">
            <div class="author author--meta">
              <a href="#0" class="author__img-wrapper">
                <img src="{{ Vite::asset('resources/img/Author.png') }}" alt="Author picture">
              </a>
      
              <div class="author__content ad5-text-component ad5-text-gap-2xs">
                <h4 class="ad5-text-base"><a href="#0" rel="author">{{$article->author}}</a></h4>
                <p class="ad5-text-sm ad5-color-contrast-medium"><time>{{$article->created_at->format('F j, Y h:i A')}}</time></p>
              </div>
            </div>
          </div>
        </header>
      
        <figure class="ad5-container ad5-max-width-lg ad5-margin-bottom-lg">
          <img class="ad5-block ad5-width-100% ad5-radius-lg" src="{{Vite::asset('storage/app/public/' . $article->image_url) }}" alt="{{$article->title}}">
        </figure>
      
        <div class="ad5-container ad5-max-width-adaptive-sm">
          <div class="ad5-text-component ad5-line-height-lg ad5-text-gap-md">
            
          <div class="ad5-text-component ad5-text-center ad5-line-height-lg ad5-text-gap-md ad5-margin-bottom-md">
            <h1>{{$article->title}}</h1>
          </div>
            <p>{{$article->intro}}</p>
      
            <p>{{$article->body}}</p>
            
            <p>{{$article->conclusion}}</p>
      
            <h4>References:</h4>
            <ul class="list list--ul">
              <li>{{$article->reference}}</li>
            </ul>
      
      
            
          </div>
        </div>
      </article>
</body>
</html>