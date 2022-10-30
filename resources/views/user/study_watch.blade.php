<x-app-layout>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='utf-8'>
        <title>Stopwatch</title>
        <link rel='stylesheet' type='text/css' href='styles.css'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="text-center mt-5">

            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        x
                    </button>
                    {{ session()->get('message') }}
                </div>
            @endif

            <h1>勉強時間を測る</h1>
            <!-- 計測時間を表示 -->
            <form action="{{ url('record_timer') }}" method="POST">
                @csrf
                <textarea id="time" name="study_time"></textarea>
                <button class="btn btn-link" type="submit" name="record">記録する</button>
            </form>
            <div>
                <!-- スタート・ストップ・リセットボタン -->
                <button class="btn btn-primary" id="start" onclick="start()">Start</button>
                <button class="btn btn-danger" id="stop" onclick="stop()" disabled>Stop</button>
                <button class="btn btn-warning" id="reset" onclick="reset()" disabled>Reset</button>
            </div>

            <h4 style="margin-top: 30px">あなたの総勉強時間</h4>
            <p>{{ $study_total_time }}</p>
        </div>

        <script>
            var startButton; // startボタン
            var stopButton; // stopボタン
            var resetButton; // resetボタン
            var showTime; // 表示時間

            var timer; // setinterval, clearTimeoutで使用
            var startTime; // 開始時間
            var elapsedTime = 0; // 経過時間
            var holdTime = 0; // 一時停止用に時間を保持

            window.onload = function() {
                startButton = document.getElementById("start");
                stopButton = document.getElementById("stop");
                resetButton = document.getElementById("reset");
                showTime = document.getElementById("time");
            }

            // スタートボタン押下時
            function start() {
                // 開始時間を現在の時刻に設定
                startTime = Date.now();

                // 時間計測
                measureTime();

                startButton.disabled = true;
                stopButton.disabled = false;
                resetButton.disabled = false;
            }

            // ストップボタン押下時
            function stop() {
                // タイマー停止
                clearInterval(timer);

                // 停止時間を保持
                holdTime += Date.now() - startTime;

                startButton.disabled = false;
                stopButton.disabled = true;
                resetButton.disabled = false;
            }

            // リセットボタン押下時
            function reset() {
                // タイマー停止
                clearInterval(timer);

                // 変数、表示を初期化
                elapsedTime = 0;
                holdTime = 0;
                showTime.textContent = "00:00.000";

                startButton.disabled = false;
                stopButton.disabled = true;
                resetButton.disabled = true;
            }

            // 時間を計測（再帰関数）
            function measureTime() {
                // タイマーを設定
                timer = setTimeout(function() {
                    // 経過時間を設定し、画面へ表示
                    elapsedTime = Date.now() - startTime + holdTime;
                    showTime.textContent = new Date(elapsedTime).toISOString().slice(14, 23);

                    // 関数を呼び出し、時間計測を継続する
                    measureTime();
                }, 10);
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </body>

    </html>

</x-app-layout>
