<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $publication['title'] }}</title>
</head>

@php($exclude_items=["template_id", "_token", "ebook_title", "ebook_author_name", "ebook_date", "templete_type", "type", "cover_image_id", "circular_id", "submission_type", "method", "slug"])
@php($cover_image = ($publication->cover_image_mave) ? $publication->cover_image_mave->file_path :'media/default_broken.jpg')

<body>
    <section style="page-break-inside:avoid;">
        <h2>Title: {{ $publication['title'] }}</h2>
        <img src="{{ url( $cover_image)  }}" alt="Featured Image" height="75%" width="100%">
        <h3>Author: {{ $publication['author_name'] }}</h3>
        <h3>Category: {{ $publication['templates_mave']->title }}</h3>
        <h3>Date: {{ $publication['form_data']['ebook_date'] }}</h3>
    </section>

    <div style="page-break-before:always">&nbsp;</div> 


    <!-- <img src="{{ url( $cover_image)  }}" alt="Featured Image" height="250px" width="250px"> -->
    <!--<img src="{{ url('media/mave_1SO3Ge.jpg')  }}" alt="Featured Image" height="250px" width="250px">-->

    <!--<h2>Title: {{ url('/') .'/' .(($publication->cover_image_mave) ? $publication->cover_image_mave->file_path :'media/default_broken.jpg')  }}</h2> -->
    <!--<h2>Image: {{ url('media/mave_1SO3Ge.jpg') }}</h2> -->
    <!--<h2>Title: {{ $publication['title'] }}</h2>-->

    @foreach ( $publication['form_data'] as $key => $form_data )
    @if (!in_array($key, $exclude_items))
    <h4>{{ CustomHelper::abbr_to_full_state($key) }}</h4>
    <p>{{ $form_data }}</p>
    @endif

    @endforeach
</body>

</html>