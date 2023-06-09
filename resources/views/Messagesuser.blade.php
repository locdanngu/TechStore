<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @extends('layouts.Link')
    <link rel="stylesheet" href="/css/Messageuserpage.css">
    <title>Chat With Admin</title>

    <style>
    .sendbtn {
        padding: .5em;
        border-radius: 5px;
        font-weight: bold;
        height: 3em;
    }

    .sendbtn:hover {
        background-color:
    }

    .textarea {
        width: 90%;
        padding-left: 0.5em;
        resize: none;
        border-radius: 5px;
        height: 3em;
    }

    .hr {
        width: 100%;
        border: .5px solid white;
        margin: 0 !important;
    }

    
    </style>
</head>

<body>
    <div class="body">
        <div class="leftbody">

            <a href="{{ route('user.page') }}" class="logomobile"><img src="/images/logo.png"></a>
            <a class="linkus" href="{{ route('user.page') }}">
                <i class="bi bi-arrow-90deg-left"></i>
                <p class="fixtxt" id="hidemobile">Back to shop</p>
            </a>
            <hr style="border:1px solid #FFFFFF; width:100%">

            @foreach($useradmin as $useradmin)
            <div class="linkus boxchat" href="#" style="">
                <input type="hidden" value="{{ $useradmin->id }}" name="sender_id">
                <img src="{{ $useradmin->avatar }}" style="width:50px; height:50px;border-radius:50%">
                <p class="fixtxt" id="fixmobile">{{ $useradmin->name }}</p>
            </div>

            @endforeach


        </div>
        <div style="display:flex; flex-direction: column; width:80%" id="boxchat">
            <span style="font-size:3em;color:white">Choice 1 admin your want to chat!</span>
        </div>

    </div>
    @extends('layouts.Foot')
    <script>
    // $('.noidungchat').scrollTop($('.noidungchat')[0].scrollHeight);

    $(document).ready(function() {
        function sendMessage() {
            $.ajax({
                type: 'POST',
                url: '{{ route("user.addmessage") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    messagecontent: $('textarea[name="messagecontent"]').val(),
                    sender_id: $('.sender_id').val(),
                },
                success: function(response) {
                    var html = response.html;
                    $('#boxchat').html(html);
                    $('.noidungchat').scrollTop($('.noidungchat')[0].scrollHeight);
                    $('#buttonsend').click(function() {
                        sendMessage();
                    });
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu cần
                }
            });
        }

        function choiceboxchat() {
            $(".linkus.boxchat").removeClass("active");
            $(this).addClass("active");
            var inputVal = $(this).find('input').val();
            $.ajax({
                type: 'POST',
                url: '{{ route("user.boxmessage") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    sender_id: inputVal
                },
                success: function(response) {
                    var html = response.html;
                    $('#boxchat').html(html);
                    $('.noidungchat').scrollTop($('.noidungchat')[0].scrollHeight);
                    $('#buttonsend').click(function() {
                        sendMessage();
                    });
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu cần
                }
            });
        }



        $('.linkus.boxchat').on("click", choiceboxchat);


    });
    </script>
</body>

</html>