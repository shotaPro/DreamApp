<x-app-layout>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="home/css/style.css">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    </head>

    <body>

        <div class="container text-center">
            <form action="{{ url('edit_message', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h1 style="margin-top: 20px">編集画面</h1>
                <div class="card" style="width: 600px; margin: auto;">
                    <img src="/post/{{ $post->image }}" class="card-img-top" alt="...">
                    <div class="div_design">
                        <label>写真を変更する :</label>
                        <input type="file" name="image">
                    </div>
                    <div class="card-body">
                        <input name="message" type="text" value="{{ $post->message }}">
                        <br>
                        <div style="margin: 20px">
                            <a class="btn btn-secondary" href="/redirect">戻る</a>
                            <button class="btn btn-primary" href="">更新する</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>

</x-app-layout>
