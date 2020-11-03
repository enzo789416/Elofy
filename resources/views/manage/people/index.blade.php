@extends('layouts.app')

@section('content')

    <ul class="list-group">
        <li class="list-group-item">
            <h4 class="text-center">List of People</h3>
        </li>
    </ul>


    <div class="container">
        <div class="row justify-content-center">

            <div class="card-body">

                {{-- <div class="form-group row">
                    <div class="col-md-6 mb-4">
                        <a class="btn btn-success" href="{{ route('admin.poll.create') }}" id="createPoll"
                            role="button">Cadastrar Nova
                            enquete</a>
                    </div>
                </div> --}}
                <div class="" id="">
                    <div class="col-4">
                        <input onchange="filterme()" type="checkbox" name="lact" value="Yes">&nbsp;&nbsp;Pessoas intolerantes a lactose
                    </div>
                    <div class="col-6">
                        <input onchange="filteratl()" type="checkbox" name="atleta" value="Yes">&nbsp;&nbsp;Pessoas atletas
                    </div>
                  </div>

                    <table id="example" class="table table-bordered table-striped display" cellspacing="0" style="width:100%">
                        <thead>
                            <tr class="text-center">

                                <th></th>
                                <th>id</th>
                                <th>name</th>
                                <th>height</th>
                                <th>weight</th>
                                <th>Lactose intolerant</th>
                                <th>athlete</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peoples ?? '' as $people)
                                <tr class="text-center" id="row_{{$people->id}}">
                                    <td></td>
                                    <td >{{ $people->id }}</td>
                                    <td >{{ $people->name }}</td>
                                    <td>{{ $people->height }}</td>
                                    <td>{{ $people->weight }}</td>
                                    <td>{{ $people->lactose ? 'Yes' : 'No' }}</td>
                                    <td>{{ $people->athlete ? 'Yes' : 'No' }}</td>
                                    <td class=""><a href="" class="btn btn-warning editPeople" data-id="{{ $people->id }}"
                                         role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger" id="{{ $people->id }}" data-id="{{ $people->id }}"
                                            onclick="deletePeople()" role="button">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<!-- ADD People Model -->
    <div class="modal fade" id="people-modal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">People</h4>
              </div>
              <div class="modal-body">
                  <form name="peopleForm" class="form-horizontal">
                     <input type="hidden" name="people_id" id="people_id">
                      <div class="form-group">
                          <label for="name" class="col-sm-2">Name</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                              <span id="nameError" class="alert-msg"></span>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="height" class="col-sm-2">height</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="height" name="height" placeholder="Enter height">
                            <span id="heightError" class="alert-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lactose" class="col-sm-6">lactose (0 - No // 1 - Yes)</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lactose" name="lactose" placeholder="Enter lactose">
                            <span id="lactoseError" class="alert-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weight" class="col-sm-2">weight</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter weight">
                            <span id="weightError" class="alert-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="athlete" class="col-sm-6">athlete (0 - No // 1 - Yes)</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="athlete" name="athlete" placeholder="Enter athlete">
                            <span id="athleteError" class="alert-msg"></span>
                        </div>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary float-right" onclick="createPeople()">Save</button>
              </div>
          </div>
        </div>
      </div>

<!-- Edit People Model -->

      <div class="modal fade" id="peopleEditModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Edit People</h4>
              </div>
              <div class="modal-body">
                  <form name="peopleEditForm" id="peopleEditForm" class="form-horizontal">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                     <input type="hidden" name="people_id" id="peopleEdit_id">
                      <div class="form-group">
                          <label for="name" class="col-sm-2">Name</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" id="nameEdit" name="nameEdit" placeholder="Enter Name">
                              <span id="nameError" class="alert-msg"></span>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="height" class="col-sm-2">height</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="heightEdit" name="heightEdit" placeholder="Enter height">
                            <span id="heightError" class="alert-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lactose" class="col-sm-6">lactose (0 - Não // 1 - Sim)</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lactoseEdit" name="lactoseEdit" placeholder="Enter lactose">
                            <span id="lactoseError" class="alert-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weight" class="col-sm-2">weight</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="weightEdit" name="weightEdit" placeholder="Enter weight">
                            <span id="weightError" class="alert-msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="athlete" class="col-sm-6">athlete (0 - Não // 1 - Sim)</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="athleteEdit" name="athleteEdit" placeholder="Enter athlete">
                            <span id="athleteError" class="alert-msg"></span>
                        </div>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary float-right">Update</button>
              </div>
          </div>
        </div>
      </div>
@endsection
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.3/umd/popper.min.js" integrity="sha512-53CQcu9ciJDlqhK7UD8dZZ+TF2PFGZrOngEYM/8qucuQba+a+BXOIRsp9PoMNJI3ZeLMVNIxIfZLbG/CdHI5PA==" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
                $('.editPeople').on('click',function(){
                    $('#peopleEditModal').modal('show');
                    $tr = $(this).closest('tr');
                    debugger
                    var data = $tr.children("td").map(function(){
                        return $(this).text()
                    }).get()
                    var data5 = 0
                    if (data[5] == "Yes") {
                        data5= 1
                    }

                    var data6 = 0
                    if (data[6] == "Yes") {
                        data6 = 1
                    }
                    console.log(data)
                    $("#id").val(data[1]);
                    $("#nameEdit").val(data[2]);
                    $("#heightEdit").val(data[3]);
                    $("#lactoseEdit").val(data[4]);
                    $("#weightEdit").val(data5);
                    $("#athleteEdit").val(data6);
                })

                $('#peopleEditForm').on('submit', function(e){
                    e.preventDefault();

                    var id =$("#id").val();

                    $.ajax({
                        type: "PUT",
                        url: "/manage/people/"+id,
                        data: $('#peopleEditForm').serialize(),
                        success: function (response){
                            console.log(response);
                            $('#peopleEditModal').modal('hide');
                            alert("Update Successfull")
                        },
                        error: function(error){
                            console.log(error)
                        }
                    })
                })



            })
</script>
<script type="text/javascript">
            function addPeople(){
                $("#people").val('');
                $('#people-modal').modal('show');
            }



            function editPeople(id) {
                debugger


                // var id  = $(event).data("id");
                let _url = `/manage/people/${id}/edit`;
                $("#id").text('');
                $("#name").text('');
                $("#height").text('');
                $("#lactose").text('');
                $("#weight").text('');
                $("#athlete").text('');
                $('#people-modal').text('');

                $.ajax({
                url: _url,
                type: "GET",
                    success: function(response) {
                        if(response) {
                            $("#id").val(response.id);
                            $("#name").val(response.name);
                            $("#height").val(response.height);
                            $("#lactose").val(response.lactose);
                            $("#weight").val(response.weight);
                            $("#athlete").val(response.athlete);
                            $('#people-modal').modal('show');
                        }
                    }
                });
            }

            function createPeople() {
                var name = $('#name').val();
                var height = $('#height').val();
                var lactose = $('#lactose').val();
                var weight = $('#weight').val();
                var athlete = $('#athlete').val();
                var id = $('#people_id').val();

                let _url     = `/manage/people`;
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: _url,
                    type: "POST",
                    data: {
                    id: id,
                    name: name,
                    height: height,
                    lactose: lactose,
                    weight: weight,
                    athlete: athlete,
                    _token: _token
                    },
                    success: function(response) {
                        if(response.code == 200) {
                        if(id != ""){
                            $("#row_"+id+" td:nth-child(2)").html(response.data.name);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.height);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.lactose);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.weight);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.athlete);
                        } else {
                            $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td class="dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes"autocomplete="off"></td><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.height+'</td><td>'+response.data.lactose+'</td><td>'+response.data.weight+'</td><td>'+response.data.athlete+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editPeople(event.target)" class="btn btn-warning d-flex justify-content-center"><i class="fas fa-edit"></i></a></td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger d-flex justify-content-center" onclick="deletePeople(event.target)"><i class="fa fa-trash"></i></a></td></tr>');
                        }
                        $("#name").text('');
                        $("#height").text('');
                        $("#lactose").text('');
                        $("#weight").text('');
                        $("#athlete").text('');

                        $('#people-modal').modal('hide');
                        }
                    },
                    error: function(response) {
                    $('#nameError').text(response.responseJSON.errors.name);
                    $('#heightError').text(response.responseJSON.errors.height);
                    $('#lactoseError').text(response.responseJSON.errors.lactose);
                    $('#weightError').text(response.responseJSON.errors.weight);
                    $('#athleteError').text(response.responseJSON.errors.athlete);
                    }
                });
            }

            function deletePeople(event) {
                debugger
                var id  = $(event).data("id");
                let _url =  `/manage/people/${id}`;
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: _url,
                    type: 'DELETE',
                    data: {
                    _token: _token
                    },
                    success: function(response) {
                    $("#row_"+id).remove();
                    }
                });
            }
</script>
