@extends('layout')

@section('content')
    <div class="feedback_full full">
        <div style="margin-bottom:35px;" class="category">Отзывы</div>
        <div id="vk_comments" class="feedback_container">

            <script type="text/javascript">
                VK.init({apiId: 6825580, onlyWidgets: true});
            </script>

            <div id="vk_comments"></div>
            <script type="text/javascript">
                VK.Widgets.Comments("vk_comments", {
                    limit: 15,
                    width: "665",
                    attach: false,
                    pageUrl: "https://{{$config->namesite}}/feedback/"
                });
            </script>
        </div>
    </div>
@endsection