<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ url('/assets/style.css') }}" rel="stylesheet">

</head>

<body>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Laravel AI ChatGPT Prompts</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">
                Optimize your workflow and enhance productivity by harnessing the immense capabilities of ChatGPT,
                enabling you to work intelligently and achieve more with ease.
            </p>


            <div class="row height d-flex justify-content-center align-items-center mt-5">
                <div class="col-md-8">
                    <form action="" method="POST" id="promtForm">
                        @csrf
                        <div class="search">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                    fill="currentColor" class="bi bi-robot" viewBox="0 0 16 16">
                                    <path
                                        d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5ZM3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.58 26.58 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.933.933 0 0 1-.765.935c-.845.147-2.34.346-4.235.346-1.895 0-3.39-.2-4.235-.346A.933.933 0 0 1 3 9.219V8.062Zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a24.767 24.767 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25.286 25.286 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135Z" />
                                    <path
                                        d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2V1.866ZM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5Z" />
                                </svg>
                            </i>
                            <input type="text" class="form-control" name="message" placeholder="Send a message">
                            <button class="btn btn-primary" type="submit">Start with AI</button>
                        </div>
                    </form>

                    <ul class="list-group my-5" id="responseContainer"></ul>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const form = $('#promtForm');
            form.on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '/chat-gpt',
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response)
                        let html = '';
                        if (!response?.status || response?.data?.error) {
                            const error = response?.data?.error?.message || 'Something went wrong.'
                            html += `<li class="list-group-item">${error}</li>`;
                        }else{
                            html +=
                                `<li class="list-group-item">${response?.data?.choices[0]?.message}</li>`;
                        }
                        if (html) $('#responseContainer').prepend(html);
                        form.trigger("reset")
                    },
                    error: function(xhr, status, error) {
                        console.error(error)
                    },
                });
            });
        });
    </script>

</body>

</html>
