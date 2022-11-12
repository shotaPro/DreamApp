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
    </head>

    <body>

        <div class="container rounded  mt-5 mb-5 text">

            <h1 class="text-center" style="margin-bottom: 50px">今週の目標</h1>

            @if (session()->has('message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">
                        x
                    </button>
                    {{ session()->get('message') }}
                </div>
            @endif

            @if($user_goal_infos->isNotEmpty())

            <table class="table">
                <tbody>
                    @php
                    $key = 1;
                @endphp
                    @foreach ($user_goal_infos as $key => $v)
                        <tr>
                            <div class="row">
                                <th class="col-lg-2 col-sm-2" scope="row">{{ $key + 1 }}</th>
                                <td class="col-lg-8 col-sm-8">{{ $v->goal_this_week }}</td>
                                <td class="col-lg-1 col-sm-1"><a class="btn btn-danger"
                                        href="{{ url('delete_goal_this', $v->id) }}">完了</a>
                                </td>
                            </div>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            @else
            <h1 class="text-center">今週の目標がされていません</h1>

            @endif

            <div class="text-center">
                <form action="{{ url('goal_this_week') }}" method="POST">
                    @csrf
                    <input style="width: 400px" name="goal_this_week" type="text" placeholder="例) 英語の勉強を毎日１時間"><br>
                    <button style="margin-top: 20px;" class="btn btn-primary">目標を追加する</button>
                </form>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>
</x-app-layout>
