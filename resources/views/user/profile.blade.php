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

    <div class="container rounded mt-5 mb-5">
        @if($profile->user_id == "")
        <form action="{{ url('/edit_profile') }}" method="POST" enctype="multipart/form-data">
        @else
        <form action="{{ url('/update_profile', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="/picture/{{ $profile->image }}"><input type="file" name="image"></div>
                </div>
                <div class="col-md-9 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">ニックネーム</label><input type="text" name="username" class="form-control" placeholder="first name" value="{{ $profile->username }}"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">あなたの夢</label><input type="text" name="goal" class="form-control" placeholder="例）エンジニアになりたい" value="{{ $profile->goal }}"></div>
                            <div class="col-md-12"><label class="labels">身につけるべきスキル・資格</label><input type="text" name="skill" class="form-control" placeholder="例) PHP javascript" value="{{ $profile->skill }}"></div>
                            <div class="col-md-12"><label class="labels">達成したい夢の日時</label><input type="text" name="date" class="form-control" placeholder="" value="{{ $profile->date }}"></div>
                        </div>
                        @if($profile->user_id == "")
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" name="submit" type="submit">保存する</button></div>
                        @else
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" name="update" type="submit">更新する</button></div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>

</x-app-layout>

