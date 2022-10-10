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

        <div class="container text-center">
            <form action="{{ url('post_message') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <textarea style="width:500px; height:200px;" name="message" placeholder="メッセージを自由に投稿しましょう"></textarea>
                <br>
                ※必須<input name="image" class="btn btn-primary"type="file">
                <button type="submit" class="btn btn-secondary">送信する</button>
            </form>


            <h1 style="margin-top: 20px">全ての投稿</h1>
                <div style="margin-top: 30px;">
                    <div class="card" style="width: 600px; margin: auto;">
                        <img src="/picture/" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text"></p>
                            <a class="btn btn-primary" href="javascript:void(0);" onclick="reply(this)" data-postid="">返信する</a>
                            <a class="btn btn-danger" onclick="return confirm('本当に削除してもよろしいですか？')"
                                href="">削除する</a>
                            <a class="btn btn-secondary" href="">編集する</a>
                        </div>
                        <div style="padding-Left: 3%; padding_bottom: 10px; padding_bottom: 10px;">
                            <b></b>
                            <p></p>
                            <a style="color: blue"href="javascript::void(0)" onclick="reply(this)" data-postid="">返信する</a>
                        </div>
                    </div>
                </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>

</x-app-layout>
