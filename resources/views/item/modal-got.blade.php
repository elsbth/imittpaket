
<div class="modal fade js-got-item-modal" id="got-item"
     tabindex="-1" role="dialog"
     aria-labelledby="got-item-label">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="got-item-label">{{ __('Got item!') }}</h2>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirm you got <span class="got-modal__name js-got-item-name">[ITEM NAME]</span></p>

                <form method="POST" action="{{ route('item.got') }}" class="form--narrow">
                    @csrf

                    <div class="form-group{{ $errors->store->has('got_date') ? ' has-error' : '' }}">
                        <label for="got_date">When did you get it? (YYYY-MM-DD)</label>
                        <input type="date"
                               class="form-control"
                               id="got_date"
                               name="got_date"
                               placeholder="Date"
                               autocomplete="off"
                               pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"/>
                        @if($errors->store->has('got_date'))
                            <span class="help-block">{{ $errors->store->first('got_date') }}</span>
                        @endif
                    </div>

                    <div class="form__actions">
                        <input type="hidden" name="item_id" value="" />
                        <button type="submit" class="btn btn--primary">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>