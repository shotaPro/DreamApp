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

        <div class="container rounded bg-white mt-5 mb-5">

            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                            class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><input
                            type="file" name="image"></div>
                </div>
                <div class="col-md-9 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">プロフィール</h4>
                        </div>
                        @if($profile->isNotEmpty())
                        @foreach ($profile as $profile)
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">ニックネーム</label>
                                    <p>{{ $profile->username }}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">あなたの夢</label>
                                    <p>{{ $profile->goal }}</p>
                                </div>
                                <div class="col-md-12"><label class="labels">身につけるべきスキル・資格</label>
                                    <p>{{ $profile->skill }}</p>
                                </div>
                                <div class="col-md-12"><label class="labels">達成したい夢の日時</label>
                                    <p>{{ $profile->date }}</p>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="row mt-2">
                            <h2>プロフィール設定がされていません</label></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <h1 class="text-center" style="margin-top: 20px">投稿一覧</h1>
            @foreach ($post as $post)
                <div style="margin-top: 30px;">
                    <div class="card text-center" style="width: 600px; margin: auto;">
                        <img src="/post/{{ $post->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text">{{ $post->message }}</p>
                            <a class="btn btn-primary" href="javascript:void(0);" onclick="reply(this)"
                                data-postid="{{ $post->id }}">返信する</a>
                            @if ($user_id == $post->postBy)
                                <a class="btn btn-danger" onclick="return confirm('本当に削除してもよろしいですか？')"
                                    href="{{ url('delete_post', $post->id) }}">削除する</a>
                                <a class="btn btn-secondary" href="{{ url('edit_show', $post->id) }}">編集する</a>
                            @endif
                        </div>
                        @foreach ($reply as $replys)
                            @if ($replys->reply_id == $post->id)
                                <div style="padding-Left: 3%; padding_bottom: 10px; padding_bottom: 10px;">
                                    <b>{{ $replys->name }}</b>
                                    <p>{{ $replys->reply_message }}</p>
                                    <a style="color: blue"href="javascript::void(0)" onclick="reply(this)"
                                        data-postid="">返信する</a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>
</x-app-layout>
