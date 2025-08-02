<!-- Modal -->
<div class="modal fade" id="edit{{ $polyclinic->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/polyclinics_trans.edit_polyclinics')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Polyclinics.update', 'test') }}" method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">{{trans('Dashboard/polyclinics_trans.name_polyclinics')}}</label>
                    <input type="hidden" name="id" value="{{ $polyclinic->id }}">
                    <input type="text" name="name" value="{{ $polyclinic->name }}" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/polyclinics_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/polyclinics_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
