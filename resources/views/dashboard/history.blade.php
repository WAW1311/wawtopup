@extends('dashboard.app')
@section('content')
<div class="Container">
<div class="table-responsive p-3 rounded">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">trxid</th>
                <th scope="col">data</th>
                <th scope="col">zone</th>
                <th scope="col">service</th>
                <th scope="col">note</th>
                <th scope="col">price</th>
                <th scope="col">message</th>
                <th scope="col">status</th>
            </tr>
            </thead>
            @foreach ($histories as $history)
                <tbody>
                    <tr>
                        <td>{{$history['trxid']}}</td>
                        <td>{{$history['data']}}</td>
                        <td>{{$history['zone']}}</td>
                        <td>{{$history['service']}}</td>
                        <td>{{$history['note']}}</td>
                        <td>{{$history['price']}}</td>
                        <td>{{$history['message']}}</td>
                        @if ($history['status'] == 'waiting')
                            <td><button type="button" class="btn btn-warning" style="cursor: none;">{{$history['status']}}</button></td>
                        @elseif ($history['status'] == 'success')
                            <td><button type="button" class="btn btn-success" style="cursor: none;">{{$history['status']}}</button></td>
                        @elseif ($history['status'] == 'processing')
                            <td><button type="button" class="btn btn-primary" style="cursor: none;">{{$history['status']}}</button></td>
                        @else
                            <td><button type="button" class="btn btn-danger" style="cursor: none;">{{$history['status']}}</button></td>
                        @endif
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection