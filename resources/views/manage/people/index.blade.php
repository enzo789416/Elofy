@extends('layouts.app')

@section('content')

    <ul class="list-group">
        <li class="list-group-item">
            <h4 class="text-center">Lista de Pessoas</h3>
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
                        <input onchange="filterme()" type="checkbox" name="lact" value="Sim">&nbsp;&nbsp;Pessoas intolerantes a lactose
                    </div>
                    <div class="col-6">
                        <input onchange="filteratl()" type="checkbox" name="atleta" value="Sim">&nbsp;&nbsp;Pessoas atletas
                    </div>
                  </div>

                    <table id="example" class="table table-bordered table-striped display" cellspacing="0" style="width:100%">
                        <thead>
                            <tr>

                                <th></th>
                                <th>Nome</th>
                                <th>Altura</th>
                                <th>Peso</th>
                                <th>Intolerante a lactose</th>
                                <th>Atleta</th>
                                <th>visualizar</th>
                                <th>Editar</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peoples ?? '' as $people)
                                <tr id="row_{{$people->id}}">
                                    <td></td>
                                    <td>{{ $people->name }}</td>
                                    <td>{{ $people->height }}</td>
                                    <td>{{ $people->weight }}</td>
                                    <td>{{ $people->lactose ? 'Sim' : 'Não' }}</td>
                                    <td>{{ $people->athlete ? 'Sim' : 'Não' }}</td>
                                    <td><a href="javascript:void(0)" class="btn btn-info d-flex justify-content-center" data-id="{{ $people->id }}"
                                        onclick="viewPeople(event.target)" role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td><a href="javascript:void(0)" class="btn btn-warning d-flex justify-content-center" data-id="{{ $people->id }}"
                                        onclick="editPeople(event.target)" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger d-flex justify-content-center" data-id="{{ $people->id }}"
                                            onclick="deletePeople(event.target)" role="button">
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

    <div class="modal fade" id="people-modal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                  <form name="peopleForm" class="form-horizontal">
                     <input type="hidden" name="people_id" id="people_id">
                      <div class="form-group">
                          <label for="name" class="col-sm-2">Name</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                              <span id="nameError" class="alert-message"></span>
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="height" class="col-sm-2">height</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="height" name="height" placeholder="Enter height">
                            <span id="heightError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lactose" class="col-sm-6">lactose (0 - Não // 1 - Sim)</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="lactose" name="lactose" placeholder="Enter lactose">
                            <span id="lactoseError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weight" class="col-sm-2">weight</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter weight">
                            <span id="weightError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="athlete" class="col-sm-6">athlete (0 - Não // 1 - Sim)</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="athlete" name="athlete" placeholder="Enter athlete">
                            <span id="athleteError" class="alert-message"></span>
                        </div>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" onclick="createPeople()">Salvar</button>
              </div>
          </div>
        </div>
      </div>
@endsection
