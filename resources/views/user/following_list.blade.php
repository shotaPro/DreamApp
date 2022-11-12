<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    </head>

    <body>

        <h2 class="text-center mt-20">フォローリスト</h2>
        @foreach ($following_lists as $following_list)
            @php
                $following_list = Auth::user()->following_list($following_list->receiver);
            @endphp
            @foreach ($following_list as $following_list)
                <div class="card" style="width: 300px; margin: auto;">
                    <div class="card-body text-center">
                        <h3>
                            ユーザー名: <a
                                href="{{ url('profiles', $following_list->receiver) }}"><span>{{ $following_list->name }}</span></a>
                        </h3>
                        <br>
                        <a class="btn btn-primary"href="{{ url('unfollow', $following_list->id) }}">フォローをやめる</a>
                    </div>
                </div>
            @endforeach
        @endforeach
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>

</x-app-layout>
