@extends('shop.layout')
  
@section('content')
 <!-- HERO SECTION-->
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Evenements</h1>
              </div>
              <div class="col-lg-6 text-lg-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                    <li class="breadcrumb-item"><a class="text-dark" href="/">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Evenements</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
 <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP LISTING-->
              <div class="col-lg-12 mb-5 mb-lg-0">
              
                <div class="row d-flex align-items-center justify-content-center">
                  <!-- events-->
                  @foreach($events as $event)
    <div class="row d-flex align-items-center justify-content-center mb-5">
        <div class="col-md-6">
            <div class="card">
                <div class="p-2">
                    <p class="text-justify">{{$event->name}}</p>
                    <p class="text-justify">{{$event->description}}</p>
                    <img src="{{$event->image}}" class="img-fluid"> 
                    <hr>
                    @auth
                    <div class="d-flex justify-content-between align-items-center">
                    <input type="hidden" class="event-id" value="{{$event->id}}">
                      <svg class="like-button heart {{$event->likes()->where('user_id',  auth()->id())->exists() ? 'liked' : ''}}" viewBox="0 0 176.104 176.104" style="enable-background:new 0 0 176.104 176.104;">
                  <g>
                    <path d="M150.383,18.301c-7.13-3.928-15.308-6.187-24.033-6.187c-15.394,0-29.18,7.015-38.283,18.015
                      c-9.146-11-22.919-18.015-38.334-18.015c-8.704,0-16.867,2.259-24.013,6.187C10.388,26.792,0,43.117,0,61.878
                      C0,67.249,0.874,72.4,2.457,77.219c8.537,38.374,85.61,86.771,85.61,86.771s77.022-48.396,85.571-86.771
                      c1.583-4.819,2.466-9.977,2.466-15.341C176.104,43.124,165.716,26.804,150.383,18.301z"/>
                  </g>
                      </svg>
                    </div>
                    <hr>
                      @endauth
                    <div class="comments">
                      @auth
                      <div class="d-flex align-items-center justify-content-center mb-4">
                        <input type="text" id="rating" class="form-control comment" placeholder="Commentaire" name="comment">
                        <button class="btn btn-dark btn-sm btn-block d-flex align-items-center justify-content-center px-3 add-comment" eventId="{{$event->id}}">Envoyer</button>
                      </div>
                      @endauth
                      @foreach($event->comments as $comment)
                        <div class="d-flex flex-row mb-2">
                            <div class="d-flex flex-column ml-2"> <span class="commenter text-black-50">{{$comment->user->fname}} {{$comment->user->name}}</span> <small class="comment-text">{{$comment->content}}</small></div>
                        </div>
                            <hr/>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
</div>
                @endforeach  
                </div>
                
                <div class="d-flex justify-content-center">
                {{ $events->appends(request()->input())->links() }}
                </div>
              </div>
            </div>
          </div>
        </section>

        <style>
          .commenter{
            font-size:0.75rem;
          }
          .comment,.add-comment{
            height:40px;
          }
          .comment-text{
            font-size:0.9rem;
          }
          .heart{
            width:30px;
            fill:white;
            stroke: black;
            stroke-width :4px;
            cursor: pointer;
          }
          .liked{
            fill: red;
          }
        </style>
        @auth
        <script defer>
          function generateComment(content){
            return `<div class="d-flex flex-row mb-2">
                            <div class="d-flex flex-column ml-2"> <span class="commenter text-black-50">{{auth()->user()->fname}} {{auth()->user()->name}}</span> <small class="comment-text">${content}</small></div>
                        </div>
                            <hr/>`;
          }
          document.querySelectorAll('.like-button').forEach(function(heart){
            const eventId=heart.parentElement.querySelector('.event-id').value;
            heart.addEventListener('click', function(){
              let xhr = new XMLHttpRequest();
              xhr.open('GET', `/event/like/${eventId}`, true);
              xhr.onload = function () {
                heart.classList.toggle('liked');              
              };
              xhr.send();
            });
          });
          document.querySelectorAll('.add-comment').forEach(function(comment){
            comment.addEventListener('click', function(){
              console.log("test")
              let xhr = new XMLHttpRequest();
              let data=new FormData();
              let content=comment.parentElement.querySelector('.comment').value
              if(!content) return;
              data.append('content',content );
              data.append('_token', '{{ csrf_token() }}');
              xhr.open('POST', `/event/comment/${comment.getAttribute('eventId')}`, true);
              xhr.addEventListener('load', ()=>{
                comment.closest('.comment').value='';
                comment.closest('.comments').innerHTML =comment.closest('.comments').innerHTML+ generateComment(content) ;
                // document.querySelector('.comments').innerHTML+=generateComment({ content});
              });
              xhr.send(data);
            });
          });
        </script>
        @endauth
      </div>
@endsection
    