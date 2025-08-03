<!-- Modal -->
<div class="modal fade" id="delete{{ $structure->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Dashboard/other_structures_trans.delete_structure') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('other-structures.destroy', $structure->id) }}" method="post">
                {{ method_field('Delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                        <i class="fa fa-exclamation-triangle text-warning fa-3x"></i>
                    </p>
                    <h5 class="text-center">
                        {{ trans('Dashboard/other_structures_trans.Warning') }}
                    </h5>
                    <h6 class="text-center">
                        <span class="text-danger">{{ $structure->name }}</span>
                    </h6>
                    
                    <!-- Structure Details -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>{{ trans('Dashboard/other_structures_trans.code') }}:</strong>
                            <span class="text-muted">{{ $structure->code }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>{{ trans('Dashboard/other_structures_trans.type') }}:</strong>
                            <span class="text-muted">{{ trans('Dashboard/other_structures_trans.' . $structure->type) }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <strong>{{ trans('Dashboard/other_structures_trans.city') }}:</strong>
                            <span class="text-muted">{{ $structure->city }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>{{ trans('Dashboard/other_structures_trans.status') }}:</strong>
                            <span class="badge badge-{{ $structure->status == 'active' ? 'success' : 'warning' }}">
                                {{ trans('Dashboard/other_structures_trans.' . $structure->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('Dashboard/other_structures_trans.close') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ trans('Dashboard/other_structures_trans.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
