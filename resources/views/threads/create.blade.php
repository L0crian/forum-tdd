@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Forum Threads</div>

                    <div class="panel-body">
                        <form method="POST" action="/threads">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="title">Title: </label>
                                <input type="text" id="title" name="title" class="form-control" placeholder="title"
                                       value="{{old('title')}}"  required>
                             </div>
                            <div class="form-group">
                                <label for="channel_id">Channel: </label>
                                <select class="form-control" id="channel_id" name="channel_id" required>
                                    <option value="">Choose one...</option>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}"
                                        {{old('channel_id') == $channel->id ? 'selected' : ''}}
                                        >{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Body: </label>
                                <textarea rows="8" type="text" id="body" name="body"
                                          class="form-control"
                                          placeholder="title"
                                          value="{{old('body')}}" required>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Publish</button>
                            </div>

                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif

                             </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

