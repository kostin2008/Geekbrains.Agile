@extends('layouts.main')
@section('content')
  <script type="text/javascript" src="{{ asset('libs/jquery/jquery.min.js')}}"></script>
  <div class="div-box">
    <div class="home-4-new-collections">
    <div class="container container-fluid">
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 calendar-head">
            <h1 class="h3 mb-0 text-gray-800">Календарь ухода за растениями</h1>
            <a href="{{route('catalog')}}" class="btn btn-3"> Добавить растение</a>
        </div>
        @if($dates === null)
            <div class="alert alert-warning" role="alert">
                Ваш список растений пуст. Добавьте растения в Избранное для отображения календаря.
            </div>
        @else
            <div class="row">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="odd-row">
                            <th class="calendar-td-center">Дата</th>
                            <th class="calendar-td-center">Растения</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($dates as $date)
                            <tr class="calendar-row {{$loop->iteration % 2 == 0 ? 'odd-row' : ''}}">
                                <td class="calendar-td-center">{{$date->dayInfo}}
                                    @if(count($date->plantsToDo) > 0)
                                        <div class="progress">
                                            <div id="progress_{{$date->dayNum}}" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$date->percent}}" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: {{$date->percent}}%"  data-total_count="{{$date->totalCount}}" data-done_count="{{$date->doneCount}}"></div>
                                        </div>
                                    @endif
                                </td>
                                    <td class="calendar-td">
                                        @foreach($date->plantsToDo as $do)
                                        <div class="calendar-td-item" title="{{$do->action->info}}">
                                            <img src="/Images/Small/{{$do->plant->photoSmallPath}}" alt="slide" height="20px" width="40px"/>
                                            <p class="calendar-td-name">{{$do->plant->name}}</p>
                                            <label class="form-check">
                                                <input class="calendar-td-check" data-date_id="{{$date->dayNum}}" type="checkbox" data-plantid="{{$do->plant->id}}" data-actionid="{{$do->action->id}}" data-date="{{$date->date}}" {{$do->done?"checked":""}}>
                                                <p id="action_fail_{{$date->dayNum}}{{$do->plant->id}}" @if($do->status == 'fail')class="alert-danger"@endif>{{$do->action->name}}</p>
                                            </label>
                                        </div>
                                        @endforeach
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td calspan="4"> Выбранных растений нет</td>
                            </tr>
                        @endforelse
                        </tbody></table>
                </div>
            </div>
        @endif
    </div>
</div>
</div>
<script>
  $('.calendar-td-check').click(function (e){
      let url = '';
      let progress = $("#progress_" + $(this).data("date_id")).first();
      let actionFail = $("#action_fail_" + $(this).data("date_id") + $(this).data("plantid")).first();
      let total = progress.data("total_count");
      let done = progress.data("done_count");
      let date = new Date();
      console.log(total,done);
      if ($(this).is(':checked')) {
          url = "{{route('plant.setUserPlantDone', ['userId'=> Auth::user()->id, 'plantId'=>'plant_id_val', 'actionId'=>'action_id_val', 'date'=>'date_val'])}}";
          done++;
          actionFail.removeClass('alert-danger');
      }
      else {
          url = "{{route('plant.resetUserPlantDone', ['userId'=> Auth::user()->id, 'plantId'=>'plant_id_val', 'actionId'=>'action_id_val', 'date'=>'date_val'])}}";
          done--;
          if($(this).data("date_id") <= date.getDate()) {
              actionFail.addClass('alert-danger');
          }
      }

      url = url.replace('plant_id_val', $(this).data("plantid"));
      url = url.replace('action_id_val', $(this).data("actionid"));
      url = url.replace('date_val', $(this).data("date"));
      $.ajax({
          url: url,
          success: function(data) {
              progress.data("done_count", done);
              progress.attr("aria-valuenow", done);
              progress.attr("style", "width: "+ 100*done/total + "%");
              console.log(url);
          }
      });
  });
</script>
@endsection

